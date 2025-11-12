<?php

namespace App\Http\Controllers;

use App\Models\DocumentDetail;
use App\Models\DocumentHeader;
use App\Models\InventoryTransaction;
use App\Models\LocationMovement;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Supplier;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "edit", "show"]);
    }

    // Mostrar una lista de órdenes de compra
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('supplier')->paginate(10);
        return view('purchase_orders.index', compact('purchaseOrders'));
    }

    // Mostrar el formulario para crear una nueva orden de compra
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all(); // Fetch products for the dropdown
        $warehouses = Warehouse::all(); // Fetch warehouses for the dropdown
        return view('purchase_orders.create', compact('suppliers', 'products', 'warehouses'));
    }


    // Almacenar una nueva orden de compra en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string|max:255|unique:purchase_orders',
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.price' => 'required|numeric|min:0',
            'warehouse_id' => 'required|exists:warehouses,id',
        ]);

        DB::beginTransaction();

        try {
            $userId = Auth::id() ?? 1;
            $warehouseId = $request->warehouse_id;

            // Obtener el documento de entrada de la bodega
            $document = DB::table('warehouse_movements')
                ->where('warehouse_id', $warehouseId)
                ->where('operator', 1) // 1 = Entrada
                ->first();

            if (!$document) {
                throw new \Exception("No se encontró un documento de entrada para la bodega seleccionada.");
            }

            // Crear la orden de compra
            $purchaseOrder = PurchaseOrder::create([
                'order_number' => $request->order_number,
                'supplier_id' => $request->supplier_id,
                'order_date' => $request->order_date,
                'total_amount' => 0,
            ]);

            // Crear encabezado del documento de entrada
            $documentId = DB::table('document_headers')->max('id') + 1;
            $documentHeader = DocumentHeader::create([
                'id'                => $documentId,
                'document_type_code' => $document->document_type_code,
                'warehouse_id'      => $warehouseId,
                'ban_estado'        => true,
                'user_gra'          => $userId,
                'user_mod'          => $userId,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);

            $documentTypeCode = $documentHeader->document_type_code;
            $totalAmount = 0;

            foreach ($request->details as $detail) {
                // Crear detalle de la orden de compra
                PurchaseOrderDetail::create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'product_id' => $detail['product_id'],
                    'quantity' => $detail['quantity'],
                    'price' => $detail['price'],
                ]);

                // Actualizar el stock del producto
                $product = Product::withTrashed()->find($detail['product_id']);
                $product->total_stock += $detail['quantity'];
                $product->save();

                // Registrar la transacción en inventario
                InventoryTransaction::create([
                    'product_id' => $detail['product_id'],
                    'transaction_type' => 'purchase',
                    'quantity' => $detail['quantity'],
                    'unit_price' => $detail['price'],
                ]);

                // Crear detalle del documento
                DocumentDetail::create([
                    'document_id'        => $documentId,
                    'document_type_code' => $documentTypeCode,
                    'product_id'         => $detail['product_id'],
                    'requested_quantity' => $detail['quantity'],
                    'dispatched_quantity' => 0,
                    'ban_estado'         => true,
                    'user_gra'           => $userId,
                    'user_mod'           => $userId,
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ]);

                // Crear movimiento de ubicación
                LocationMovement::create([
                    'document_id'       => $documentId,
                    'document_type_code' => $documentTypeCode,
                    'product_id'        => $detail['product_id'],
                    'warehouse_id'      => $warehouseId,
                    'zone_id'           => 1,
                    'shelf'             => 1,
                    'column'            => 1,
                    'level'             => 1,
                    'quantity'          => $detail['quantity'],
                    'month_year'        => Carbon::now()->format('Ym'),
                    'operation_date'    => Carbon::now(),
                    'user_gra'          => $userId,
                    'user_mod'          => $userId,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);

                $totalAmount += $detail['quantity'] * $detail['price'];
            }

            // Actualizar total de la orden de compra
            $purchaseOrder->total_amount = $totalAmount;
            $purchaseOrder->save();

            DB::commit();

            return redirect()->route('purchase_orders.index')->with('success', 'Purchase Order created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create Purchase Order: ' . $e->getMessage())->withInput();
        }
    }


    public function show($id)
    {
        // Cargar la orden de compra y sus detalles
        $purchaseOrder = PurchaseOrder::with([
            'items.product' => function ($query) {
                $query->withTrashed();
            },
            'supplier'
        ],)->findOrFail($id);

        return view('purchase_orders.show', compact('purchaseOrder'));
    }
}
