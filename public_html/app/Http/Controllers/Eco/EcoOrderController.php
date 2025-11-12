<?php

namespace App\Http\Controllers\Eco;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class EcoOrderController extends Controller
{
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
}
