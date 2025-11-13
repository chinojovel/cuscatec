<!DOCTYPE html>
<html>

<head>
    <title>Factura</title>
    <style>
        /* Estilos CSS para la factura */
        body {
            font-family: Arial, sans-serif;
            margin-top: 0px;
            padding-top: 0px;
        }

        .invoice {
            padding: 0px;
        }

        .header-table {
            width: 100%;
            margin-top: 0px;
            padding-top: 0px;
            margin-bottom: 20px;
        }

        .header-table td {
            border: none;
        }

        .header-table .company-info {
            text-align: center;
            vertical-align: top;
        }

        .header-table .invoice-number {
            text-align: center;
            border: 2px solid black;
            padding: 5px;
            border-radius: 10px;
            /* Border radius para esquinas redondeadas */
        }

        .invoice-number h2 {
            margin: 0;
            padding: 0;
        }

        .invoice-number .number {
            color: red;
            padding: 0;
            margin: 0.5em;
        }

        .details-table {
            width: 100%;
            margin-top: 20px;
            border: none;
            /* Sin bordes en la tabla */
        }

        .details-table td {
            padding: 4px;
            vertical-align: top;
            border: none;
            /* Sin bordes en las celdas */
        }

        .details-table .left-column {
            width: 65%;
        }

        .details-table .right-column {
            width: 35%;
        }

        .product-table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: separate;
            border-left: 0;
            border-radius: 4px;
            border-spacing: 0px;
        }

        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
            border-collapse: separate;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        th,
        td {
            padding: 5px 4px 6px 4px;
            text-align: left;
            vertical-align: top;
            border-left: 1px solid #000;
        }

        td {
            border-top: 1px solid #000;
        }

        /* Asignación de anchos específicos a las columnas */
        .product-table th.quantity,
        .product-table td.quantity {
            width: 13%;
        }

        .product-table th.description,
        .product-table td.description {
            width: 59%;
        }

        .product-table th.unit-price,
        .product-table td.unit-price {
            width: 13%;
        }

        .product-table th.affecting-sales,
        .product-table td.affecting-sales {
            width: 15%;
        }

        thead:first-child tr:first-child th:first-child,
        tbody:first-child tr:first-child td:first-child {
            border-radius: 4px 0 0 0;
        }

        thead:last-child tr:last-child th:first-child,
        tbody:last-child tr:last-child td:first-child {
            border-radius: 0 0 0 4px;
        }

        .text-right {
            float: right;
            font-weight: bold;
        }

        .text-right-semi {
            float: right;
            font-weight: 500;
        }

        .head-product-table th {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <table class="header-table">
            <tr>
                <td class="company-info">
                    <strong>IMPORTACIONES GUADALAJARA</strong><br>
                    PHONE: (762) 477 0085<br>
                    E-MAIL: import.guadalajara.sv@gmail.com
                </td>
                <td>
                    @if ($order->correlative != 0)
                        <div class="invoice-number">
                            <h2>INVOICE</h2>
                            <p class="number">N° {{ str_pad($order->correlative, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    @else
                        <div class="invoice-number">
                            <h2>PRE-INVOICE</h2>
                            <p class="number">N° {{ str_pad($order->correlative, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    @endif
                </td>
            </tr>
        </table>

        <table class="details-table">
            <tr>
                <td class="left-column"><strong>NAME:</strong> {{ $order->customer->name }}</td>
                <td class="right-column"><strong>DATE:</strong> {{ $order->order_date }}</td>
            </tr>
            <tr>
                <td class="left-column"><strong>ADDRESS:</strong> {{ $order->customer->address }}</td>
                <td class="right-column">
                    <strong>PAYMENT STATUS:</strong>
                    @switch($order->payment_status)
                        @case('P')
                            Pending
                        @break

                        @case('C')
                            Check
                        @break

                        @case('D')
                            Cash
                        @break

                        @default
                            Unknown
                    @endswitch
                </td>
            </tr>
        </table>

        <table class="product-table">
            <thead>
                <tr class="head-product-table">
                    <th class="quantity">QUANTITY</th>
                    <th class="description">DESCRIPTION</th>
                    <th class="unit-price">UNIT PRICE</th>
                    <th class="affecting-sales">AFFECTING SALES</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalBeforeDiscount = 0;
                    foreach ($order->orderDetails as $detail) {
                        $totalBeforeDiscount += $detail->final_price * $detail->quantity;
                    }

                    $totalAfterDiscount = $totalBeforeDiscount;

                    $totalAfterDiscount = max($totalAfterDiscount, 0); // Ensure the total is not negative
                @endphp
                @foreach ($order->orderDetails as $detail)
                    <tr>
                        <td class="quantity">{{ $detail->quantity }}</td>
                        <td class="description">{{ $detail->product->name }}</td>
                        <td class="unit-price">${{ number_format($detail->final_price, 2) }}</td>
                        <td class="affecting-sales">${{ number_format($detail->total, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3"><span class="text-right-semi">SUB TOTAL</span></td>
                    <td>${{ number_format($totalAfterDiscount, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="3"><span class="text-right-semi">DISCOUNT</span></td>
                    <td>${{ number_format($order->discount_amount, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="3">ARE: <span class="text-right">TOTAL SALES</span></td>
                    <td>${{ number_format($order->total_price, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
