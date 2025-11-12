<?php

namespace App\Http\Controllers\Eco;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductPrice;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EcoProductController extends Controller
{
    public function getProductsByFilters(Request $request)
    {
        // Obtener el estado de la sesión
        $stateId = session('selected_state'); // Aquí obtienes el estado guardado en sesión

        if (!$stateId) {
            return redirect()->to("ecommerce.categories")->with('error', 'No state selected in session.');
        }

        // Buscar el estado por su ID (o podría ser otra forma de identificación)
        $state = State::find($stateId);

        if (!$state) {
            return redirect()->back()->with('error', 'State not found.');
        }

        // Obtener los parámetros de filtro (categoría y nombre de producto)
        $categoryId = $request->input('category_id');
        $productName = $request->input('name');

        // Construir la consulta base para los productos
        $query = Product::with(['prices' => function ($query) use ($state) {
            $query->where('state_id', $state->id);
        }]);

        // Filtrar por category_id si se proporciona
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        // Filtrar por nombre de producto si se proporciona
        if ($productName) {
            $query->where('name', 'like', "%{$productName}%");
        }

        // Obtener los productos filtrados
        $products = $query->get();

        // Filtrar los productos para incluir solo aquellos con precios
        $filteredProducts = $products->filter(function ($product) {
            return $product->prices->isNotEmpty();
        });
        // dd($filteredProducts);
        $categories =  Category::all();

        $states = State::all();
        // Pasar los productos filtrados a la vista
        return view('ecommerce.products.list-products', ['products' => $filteredProducts, 'categories' => $categories, 'states' => $states]);
    }


    public function cart(Request $request)
    {
        $stateId = session('selected_state'); // Aquí obtienes el estado guardado en sesión
        if (isset($stateId)) {
            $customers = Customer::with('state')->where("state_id", $stateId)->get();
        } else {
            $customers = Customer::with('state')->get();
        }
        $states = State::all();

        return view('ecommerce.products.cart', ["customers" => $customers, 'states' => $states]);
    }

    /**
     * Valida el cupón.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateCoupon(Request $request)
    {
        Log::info($request);
        if (!isset($request["code"])) {
            return response()->json([
                'success' => false,
                'message' => 'Cupón inválido o expirado',
            ], 404);
        }
        Log::info("pase validación");

        $coupon = Coupon::where('code', $request->code)
            ->where('status', 'active')
            ->where('start_date', "<=", Carbon::now()->format('Y-m-d'))
            ->where('end_date', ">=", Carbon::now()->format('Y-m-d'))
            ->first();
        Log::info(Carbon::now());
        Log::info($coupon);

        if ($coupon) {
            return response()->json([
                'success' => true,
                'message' => 'Cupón válido',
                'coupon' => $coupon,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Cupón inválido o expirado',
        ], 201);
    }

    public function completePurchase(Request $request)
    {
        $validated = $request->validate([
            'customer'                          => 'required|exists:customers,id',
            'cart'                              => 'required|min:3',
            'paymentStatus'                     => 'required',
            'deliveryOption'                    => 'required',
            'customer'                          => 'required',
            // 'order_details'                     => 'required|array',
            // 'order_details.*.product_id'        => 'required|exists:products,id',
            // 'order_details.*.original_price'    => 'required|numeric',
            // 'order_details.*.final_price'       => 'required|numeric',
            // 'order_details.*.quantity'          => 'required|integer',
        ]);
        $cartArray = json_decode($request->cart, true);

        // Verificar el resultado
        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withErrors("Error al procesar datos de carrito");
        }

        DB::beginTransaction();

        try {
            $totalPrice = 0;
            foreach ($cartArray as $detail) {
                $totalPrice += $detail['unitPrice'] * $detail['quantity'];
            }
            $total = $totalPrice;
            // Aplicar descuento si está presente
            if (isset($request['couponCode']) && $request['discountAmount'] > 0) {
                $discountAmount = $request['discountAmount'];
                $discountEntity = Coupon::where('code', $request['couponCode'])->first();
                if (isset($discountEntity)) {
                    if ($discountEntity->type === 'a') {
                        $discountAmount = $discountEntity->discount_amount;
                    } else if ($discountEntity->type === 'p') {
                        $discountAmount = ($totalPrice * $discountEntity->discount_percentage / 100);
                    }

                    $totalPrice -= $discountAmount;
                }
            }

            if (Order::max('correlative') == null) {
                $correlative = 5000;
            } else {
                $correlative = Order::max('correlative') + 1;
            }

            $state_id = session('selected_state');

            $user = auth()->user();
            $order = Order::create([
                'customer_id'       => $request['customer'],
                'user_id'           => isset($user->id) ? $user->id : null,
                'total_price'       => $totalPrice,
                'order_date'        => now()->format('Y-m-d'),
                'payment_status'    => $request['paymentStatus'],
                'correlative'       => $correlative,
                'coupon_code'       => isset($request['couponCode']) ? $request['couponCode'] : null,
                'coupon_type'       => isset($discountEntity->type) ? $discountEntity->type : null,
                'discount_amount'   => isset($discountAmount) ? $discountAmount : null,
                'type'              => 0,
                'total'             => $total,
                'tracking_status'   => isset($request['deliveryOption']) ? $request['deliveryOption'] : 'N',
                'state_id'          => $state_id,
            ]);

            // Crear los detalles de la orden
            foreach ($cartArray as $detail) {
                $price = ProductPrice::where('product_id', $detail['product_id'])->where('state_id', $state_id)->first();
                $originalPrice = $price->price;
                OrderDetail::create([
                    'order_id'          => $order->id,
                    'product_id'        => $detail['product_id'],
                    'original_price'    => $originalPrice,
                    'final_price'       => $detail['unitPrice'],
                    'quantity'          => $detail['quantity'],
                    'total'             => $detail['unitPrice'] * $detail['quantity'],
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

            $states = State::all();

            //return route('ecommerce.products.order-succesfull', ['order' => $order, 'states' => $states]);
            return redirect()->route('ecommerce.products.order-succesfull', [
                'order' => $order->id,   // Aquí pasas solo el ID de la orden
                'states' => $states       // Aquí pasas los estados, si es una variable simple
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e);
            return back()->withError('Failed to create order');
        }
    }

    public function completePurchaseView(Request $request)
    {
        // Obtener los parámetros pasados por la redirección
        $orderId = $request->input('order'); // El ID de la orden
        $order = Order::find($orderId);
        $states = State::all();
        return view('ecommerce.products.order-succesfull', [
            'order' => $order,
            'states' => $states
        ]);
    }
}
