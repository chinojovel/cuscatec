<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function query()
    {
        // Reutilizamos exactamente la misma lógica de filtrado del controlador
        $ordersQuery = Order::with(['customer' => function ($query) {
            $query->withTrashed(); // Incluir clientes eliminados
        }, 'user']);

        // Filtro por Cliente
        if (!empty($this->filters['customer_id'])) {
            $ordersQuery->where('customer_id', $this->filters['customer_id']);
        }

        // Filtro por Vendedor
        if (!empty($this->filters['seller_id'])) {
            $ordersQuery->where('user_id', $this->filters['seller_id']);
        }

        // Filtro por Fecha
        if (!empty($this->filters['date']) && !empty($this->filters['date_to'])) {
            $ordersQuery->whereBetween('order_date', [$this->filters['date'], $this->filters['date_to']]);
        } elseif (!empty($this->filters['date'])) {
            $ordersQuery->where('order_date', '>=', $this->filters['date']);
        } elseif (!empty($this->filters['date_to'])) {
            $ordersQuery->where('order_date', '<=', $this->filters['date_to']);
        }

        // Filtro por Estado de Pago
        if (!empty($this->filters['payment_status'])) {
            $ordersQuery->where('payment_status', $this->filters['payment_status']);
        }

        // Filtro por Estado de Tracking
        if (!empty($this->filters['tracking_status'])) {
            $ordersQuery->where('tracking_status', $this->filters['tracking_status']);
        }
        
        // Filtro por Origen
        if (isset($this->filters['type']) && $this->filters['type'] !== '') {
            $ordersQuery->where('type', $this->filters['type']);
        }

        return $ordersQuery->orderBy('created_at', 'desc');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define los encabezados de las columnas en el archivo Excel
        return [
            'Order ID',
            'Customer',
            'Seller',
            'Total Price',
            'Order Date',
            'Payment Status',
            'Origin',
            'Tracking Status',
            'Tracking Number',
        ];
    }

    /**
     * @param Order $order
     * @return array
     */
    public function map($order): array
    {
        // Mapea cada orden a una fila del Excel.
        // Es importante transformar los datos aquí para que sean legibles.

        // Mapeo de Payment Status
        $paymentStatus = 'N/A';
        if ($order->payment_status === 'P') $paymentStatus = 'Pending';
        elseif ($order->payment_status === 'C') $paymentStatus = 'Check';
        elseif ($order->payment_status === 'D') $paymentStatus = 'Cash';

        // Mapeo de Origin
        $origin = ($order->type == 1) ? 'Customer App' : 'Seller App';
        
        // Mapeo de Tracking Status
        $trackingStatus = 'Unknown';
        if ($order->tracking_status === 'N') $trackingStatus = 'Processing Order';
        elseif ($order->tracking_status === 'E') $trackingStatus = 'In Transit';
        elseif ($order->tracking_status === 'T') $trackingStatus = 'Delivered';
        elseif ($order->tracking_status === 'I') $trackingStatus = 'Immediate Delivery';

        return [
            $order->id,
            $order->customer->name ?? 'N/A', // Usamos el operador ?? para evitar errores si el cliente no existe
            $order->user->name ?? 'N/A',
            $order->total_price,
            $order->order_date,
            $paymentStatus,
            $origin,
            $trackingStatus,
            $order->tracking_number ?? 'N/A',
        ];
    }
} 