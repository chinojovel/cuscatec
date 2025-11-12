<?php

namespace App\Http\Controllers;

use App\Exports\InventoryExport;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\ProductStock;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $warehouses = Warehouse::all();
        $products = Product::select('id', 'name')->get();

        // Obtener filtros de la solicitud
        $warehouseId = $request->input('warehouse_id');
        $productId = $request->input('product_id');

        $query = ProductStock::with([
            'product' => function ($query) {
                $query->withTrashed(); // Incluir productos eliminados en la relación
            }, 
            'warehouse'
        ]);
    
        if ($warehouseId) {
            $query->where('warehouse_id', $warehouseId);
        }

        if ($productId) {
            $query->where('product_id', $productId);
        }

        $stocks = $query->orderBy('warehouse_id')->orderBy('updated_at', 'desc')->get();
        
        return view('inventory.index', compact('warehouses', 'products', 'stocks'));
    }

    public function export(Request $request)
{
    $warehouseId = $request->input('warehouse_id');
    $productId = $request->input('product_id');

    return Excel::download(new InventoryExport($warehouseId, $productId), 'inventory.xlsx');
}
}
