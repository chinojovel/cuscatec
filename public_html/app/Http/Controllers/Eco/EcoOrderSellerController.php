<?php

namespace App\Http\Controllers\Eco;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\State;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EcoOrderSellerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(["index", "show"]);
    }
    // Muestra la lista de órdenes
    public function index(Request $request)
    {
        $ordersQuery = Order::with(['customer' => function ($query) {
            $query->withTrashed(); // Incluir clientes eliminados
        }, 'user']);

        // Filtro por Cliente
        if ($request->filled('customer_id')) {
            $ordersQuery->where('customer_id', $request->customer_id);
        }

        // Filtro por Fecha
        if ($request->filled('date') && $request->filled('date_to')) {
            $ordersQuery->whereBetween('order_date', [$request->date, $request->date_to]);
        } elseif ($request->filled('date')) {
            $ordersQuery->where('order_date', '>=', $request->date);
        } elseif ($request->filled('date_to')) {
            $ordersQuery->where('order_date', '<=', $request->date_to);
        }

        // Filtro por Estado de Pago
        if ($request->filled('payment_status')) {
            $ordersQuery->where('payment_status', $request->payment_status);
        }

        if ($request->filled('tracking_status')) {
            $ordersQuery->where('tracking_status', $request->tracking_status);
        }

        if ($request->filled('type')) {
            $ordersQuery->where('type', $request->type);
        }
        $ordersQuery->where('user_id', Auth::user()->id);

        $orders = $ordersQuery->orderBy('created_at', 'desc')->paginate(10);

        // Obtener todos los clientes, incluidos los eliminados
        $customers = Customer::withTrashed()->get();
        $states = State::all();

        return view('ecommerce.orders.index', compact('orders', 'customers', 'states'));
    }

    // Muestra los detalles de una orden específica
    public function show($id)
    {
        $order = Order::with(['orderDetails.product' => function ($query) {
            $query->withTrashed();
        }])->with('user')->findOrFail($id);
        $states = State::all();

        return view('ecommerce.orders.show', compact('order', 'states'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'                       => 'required|exists:customers,id',
            // 'user_id'                           => 'required|exists:users,id',
            'total_price'                       => 'required|numeric',
            'order_date'                        => 'sometimes|date',
            'payment_status'                    => 'required',
            'order_details'                     => 'required|array',
            'order_details.*.product_id'        => 'required|exists:products,id',
            'order_details.*.original_price'    => 'required|numeric',
            'order_details.*.final_price'       => 'required|numeric',
            'order_details.*.quantity'          => 'required|integer',
        ]);
        DB::beginTransaction();

        try {
            $totalPrice = 0;
            foreach ($validated['order_details'] as $detail) {
                $totalPrice += $detail['final_price'] * $detail['quantity'];
            }
            $total = $totalPrice;
            // Aplicar descuento si está presente
            if (isset($request['coupon']['discount_amount']) && $request['coupon']['discount_amount'] > 0) {
                $discountAmount = $request['coupon']['discount_amount'];
                $totalPrice -= $discountAmount;
            }
            if (!isset($request['type'])) {
                $correlative = Order::max('correlative') + 1;
            } else {
                $correlative = 0;
            }
            $state_id = 1;
            if (isset($request['state_id'])) {
                $state = State::where("abbreviation", $request['state_id'])->first();
                $state_id = $state->id;
            }

            $order = Order::create([
                'customer_id'       => $validated['customer_id'],
                'user_id'           => isset($request['user_id']) ? $request['user_id'] : null,
                'total_price'       => $totalPrice,
                'order_date'        => $validated['order_date'] ?? now()->format('Y-m-d'),
                'payment_status'    => $validated['payment_status'],
                'correlative'       => $correlative,
                'coupon_code'       => isset($request['coupon']['code']) ? $request['coupon']['code'] : null,
                'coupon_type'       => isset($request['coupon']['type']) ? $request['coupon']['type'] : null,
                'discount_amount'   => isset($request['coupon']['discount_amount']) ? $request['coupon']['discount_amount'] : null,
                'type'              => isset($request['type']) ? $request['type'] : 0,
                'total'             => $total,
                'tracking_status'   => isset($request['delivery_status']) ? $request['delivery_status'] : 'N',
                'state_id'          => $state_id,
            ]);

            // Crear los detalles de la orden
            foreach ($validated['order_details'] as $detail) {
                OrderDetail::create([
                    'order_id'          => $order->id,
                    'product_id'        => $detail['product_id'],
                    'original_price'    => $detail['original_price'],
                    'final_price'       => $detail['final_price'],
                    'quantity'          => $detail['quantity'],
                    'total'             => $detail['final_price'] * $detail['quantity'],
                ]);
            }

            DB::commit();

            // Generate PDF using Dompdf based on order data
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('factura.factura', compact('order'));

            // Define the file path in the public directory
            $fileName = 'factura_' . $order->id . '.pdf';
            $filePath = public_path('invoices/' . $fileName);

            // Ensure the directory exists
            if (!file_exists(public_path('invoices'))) {
                mkdir(public_path('invoices'), 0777, true);
            }

            // Save the PDF to the specified path
            $pdf->save($filePath);

            // Return a JSON response with the PDF URL
            $pdfUrl = asset('invoices/' . $fileName);


            return response()->json([
                'message' => 'Order created successfully!',
                'order' => $order,
                'pdf_url' => $pdfUrl
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e);
            return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
        }
    }

    public function printInvoice($id)
    {
        $order = Order::with([
            'customer' => function ($query) {
                $query->withTrashed();
            },
            'orderDetails.product' => function ($query) {
                $query->withTrashed();
            }
        ])->findOrFail($id);

        // Create an instance of the PDF wrapper
        $pdf = app('dompdf.wrapper');

        $pdf->loadView('factura.factura', compact('order'));
        // return $pdf->download('factura_' . $order->id . '.pdf');
        return $pdf->stream('factura_' . $order->id . '.pdf');
    }

    public function indexApi($id)
    {
        $orders = Order::with([
            'customer' => function ($query) {
                $query->withTrashed();
            },
            'orderDetails.product' => function ($query) {
                $query->withTrashed();
            },
            'user'
        ])
            ->where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($orders);
    }

    public function showApi($id)
    {
        $order = Order::with([
            'customer' => function ($query) {
                $query->withTrashed();
            },
            'orderDetails.product' => function ($query) {
                $query->withTrashed();
            },
            'user'
        ])->findOrFail($id);
        return response()->json($order);
    }

    public function indexApiCustomers($id)
    {
        $orders = Order::with('customer', 'user')
            ->where('customer_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($orders);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Update the payment status
        $order->payment_status = $request->payment_status;
        // Save the order
        $order->save();

        // Generate PDF using Dompdf based on order data
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('factura.factura', compact('order'));

        // Define the file path in the public directory
        $fileName = 'factura_' . $order->id . '.pdf';
        $filePath = public_path('invoices/' . $fileName);

        // Ensure the directory exists
        if (!file_exists(public_path('invoices'))) {
            mkdir(public_path('invoices'), 0777, true);
        }

        // Save the PDF to the specified path
        $pdf->save($filePath);

        // Flash success message and redirect back
        return redirect()->back()->with('success', 'Order status updated successfully. PDF generated.');
    }


    public function showUpdateStatusForm($id)
    {
        $order = Order::findOrFail($id);

        $states = State::all();

        return view('ecommerce.orders.update-status', compact('order', 'states'));
    }

    public function edit($id)
    {
        $order =  Order::with(['orderDetails.product' => function ($query) {
            $query->withTrashed();
        }])->findOrFail($id);

        $states = State::all();

        $customers = Customer::with('state')->orderBy('state_id')->get();

        $query = Product::whereHas('prices', function ($query) use ($order) {
            $query->where('state_id', $order->state_id);
        })->with(['prices' => function ($query) use ($order) {
            $query->where('state_id', $order->state_id);
        }]);

        // Obtener los productos filtrados
        $products = $query->orderBy('name', 'asc')->get();

        return view('ecommerce.orders.edit', compact('order', 'states', 'customers', 'products'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'order_details'                     => 'required|array',
            'order_details.*.product_id'        => 'required|exists:products,id',
            'order_details.*.final_price'       => 'required|numeric|min:0',
            'order_details.*.quantity'          => 'required|integer|min:1',
            'order_details.*.remove'            => 'sometimes|boolean',
            'new_products'                      => 'sometimes|array',
            'new_products.*.product_id'         => 'required|exists:products,id',
            'new_products.*.final_price'        => 'required|numeric|min:0',
            'new_products.*.quantity'           => 'required|integer|min:1',
            'discount_amount'                   => 'nullable|numeric|min:0',
            'customer'                          => 'required|exists:customers,id',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::findOrFail($id);

            // Inicializar el total del precio
            $totalPrice = 0;

            // Manejar detalles existentes de la orden
            foreach ($validated['order_details'] as $detail) {
                // Si el producto debe ser eliminado
                if (!empty($detail['remove']) && $detail['remove'] === '1') {
                    OrderDetail::where('order_id', $id)
                        ->where('product_id', $detail['product_id'])
                        ->delete();
                } else {
                    // Actualizar o crear el detalle de la orden
                    OrderDetail::updateOrCreate(
                        ['order_id' => $id, 'product_id' => $detail['product_id']],
                        [
                            'final_price' => $detail['final_price'],
                            'quantity'    => $detail['quantity'],
                            'total'       => $detail['final_price'] * $detail['quantity']
                        ]
                    );

                    // Incrementar el total acumulado
                    $totalPrice += $detail['final_price'] * $detail['quantity'];
                }
            }

            $total = $totalPrice;
            $discountAmount = 0;

            // Manejar nuevos productos
            if (!empty($validated['new_products'])) {
                foreach ($validated['new_products'] as $newProduct) {
                    // Crear detalles para los nuevos productos
                    if (!empty($newProduct['product_id']) && $newProduct['quantity'] > 0 && $newProduct['final_price'] > 0) {
                        OrderDetail::create([
                            'order_id'    => $id,
                            'product_id'  => $newProduct['product_id'],
                            'quantity'    => $newProduct['quantity'],
                            'final_price' => $newProduct['final_price'],
                            'total'       => $newProduct['quantity'] * $newProduct['final_price'],
                            'original_price' => Product::find($newProduct['product_id'])->prices->first()->price
                        ]);

                        // Incrementar el total acumulado
                        $totalPrice += $newProduct['quantity'] * $newProduct['final_price'];
                    }
                }
            }

            // Verificar y aplicar descuento desde el request si está presente y es mayor a 0
            if (isset($request->discount_amount) && $request->discount_amount >= 0) {
                $discountAmount += $request->discount_amount;
            } else {
                // Verificar y aplicar descuento existente en la orden si está presente y es mayor a 0
                if (isset($order->discount_amount) && $order->discount_amount >= 0) {
                    $discountAmount += $order->discount_amount;
                }
            }

            // Aplicar el descuento acumulado al total
            if ($discountAmount > 0) {
                $totalPrice -= $discountAmount;
            }
            // Asegurar que el total no sea negativo
            $total = max($total, 0);

            // Actualizar la orden
            $order->update([
                'total_price'       => $totalPrice,
                'discount_amount'   => $discountAmount,
                'total'             => $total,
                'customer_id'       => $validated['customer'],
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Order updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update order.');
        }
    }


    public function updateTracking(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'tracking_status' => 'required|in:N,E,T',
            'tracking_number' => 'required_if:tracking_status,E,T'
        ]);

        $order =  Order::with([
            'customer' => function ($query) {
                $query->withTrashed();
            },
            'orderDetails.product' => function ($query) {
                $query->withTrashed();
            },
            'user'
        ])->findOrFail($request->order_id);
        $order->tracking_status = $request->tracking_status;
        if ($request->tracking_status === 'E' || $request->tracking_status === 'T') {
            if ($order->correlative == 0) $order->correlative = Order::max('correlative') + 1;
            $order->tracking_number = $request->tracking_number;
        }
        $order->save();

        // Generate PDF using Dompdf based on order data
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('factura.factura', compact('order'));

        // Define the file path in the public directory
        $fileName = 'factura_' . $order->id . '.pdf';
        $filePath = public_path('invoices/' . $fileName);

        // Ensure the directory exists
        if (!file_exists(public_path('invoices'))) {
            mkdir(public_path('invoices'), 0777, true);
        }

        // Save the PDF to the specified path
        $pdf->save($filePath);

        return redirect()->route('administration.ecommerce.orders.index')->with('success', 'Tracking status updated successfully.');
    }

    public function modifiedOrders(Request $request)
    {
        $ordersQuery = Order::with(['customer' => function ($query) {
            $query->withTrashed(); // Incluir clientes eliminados
        }, 'user'])
            ->join('order_details as od', 'orders.id', '=', 'od.order_id')
            ->select('orders.*') // Asegúrate de seleccionar solo las columnas necesarias
            ->distinct()
            ->whereColumn('od.original_price', '!=', 'od.final_price');

        // Filtro por Cliente
        if ($request->filled('customer_id')) {
            $ordersQuery->where('customer_id', $request->customer_id);
        }

        // Filtro por Fecha
        if ($request->filled('date') && $request->filled('date_to')) {
            $ordersQuery->whereBetween('order_date', [$request->date, $request->date_to]);
        } elseif ($request->filled('date')) {
            $ordersQuery->where('order_date', '>=', $request->date);
        } elseif ($request->filled('date_to')) {
            $ordersQuery->where('order_date', '<=', $request->date_to);
        }

        // Filtro por Estado de Pago
        if ($request->filled('payment_status')) {
            $ordersQuery->where('payment_status', $request->payment_status);
        }

        if ($request->filled('tracking_status')) {
            $ordersQuery->where('tracking_status', $request->tracking_status);
        }

        if ($request->filled('type')) {
            $ordersQuery->where('type', $request->type);
        }
        $ordersQuery->where('user_id', Auth::user()->id);

        $orders = $ordersQuery->orderBy('order_date', 'desc')->paginate(10);

        // Obtener todos los clientes, incluidos los eliminados
        $customers = Customer::withTrashed()->get();

        $states = State::all();

        return view('ecommerce.orders.modified', compact('orders', 'customers', 'states'));
    }
}
