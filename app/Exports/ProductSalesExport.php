<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class ProductSalesExport implements FromView
{
    protected $userId;
    protected $startDate;
    protected $endDate;

    public function __construct($userId, $startDate, $endDate)
    {
        $this->userId = $userId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        // Ejecutar la consulta para obtener los datos
        $sales = DB::table('users as u')
            ->join('orders as o', 'u.id', '=', 'o.user_id')
            ->join('order_details as od', 'o.id', '=', 'od.order_id')
            ->join('products as p', 'od.product_id', '=', 'p.id')
            ->select(
                'u.id as user_id',
                'od.product_id',
                'p.name as product_name',
                DB::raw('SUM(od.quantity) as total_products_sold')
            )
            ->whereBetween('o.order_date', [$this->startDate, $this->endDate])
            ->where('u.id', $this->userId)
            ->groupBy('u.id', 'od.product_id', 'p.name')
            ->get();

        // Pasar los datos a una vista para el archivo Excel
        return view('exports.product-sales', [
            'sales' => $sales
        ]);
    }
}