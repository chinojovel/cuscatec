<?php

namespace App\Exports;

use App\Models\ProductStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InventoryExport implements FromView, ShouldAutoSize{

    protected $warehouseId;
    protected $productId;

    public function __construct($warehouseId, $productId)
    {
        $this->warehouseId = $warehouseId;
        $this->productId = $productId;
    }

    public function view(): View
    {
        $query = ProductStock::with(['product' => function ($query) {
            $query->withTrashed();
        }, 'warehouse']);

        if ($this->warehouseId) {
            $query->where('warehouse_id', $this->warehouseId);
        }

        if ($this->productId) {
            $query->where('product_id', $this->productId);
        }

        $stocks = $query->orderBy('warehouse_id')->get();

        return view('exports.inventory', compact('stocks'));
    }
}
