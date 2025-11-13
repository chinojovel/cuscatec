@extends('ecommerce.layouts.master')

@section('title', 'Order Details')

@section('content')
    <div class="container">
        <h1>Order Details</h1>

        <div class="mb-3">
            <a href="{{ route('ecommerce.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h3>Order #{{ $order->id }}</h3>
                </div>
                <div class="col-sm-12 col-md-4">
                    <h3 class="number">Invoice N° {{ str_pad($order->correlative, 5, '0', STR_PAD_LEFT) }}</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <p><strong>Seller:</strong>
                        @if (isset($order->user->name))
                            {{ $order->user->name }}
                        @endif
                    </p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
                </div>
                @if ($order->discount_amount)
                    <div class="col-sm-12 col-md-4">
                        <p><strong>Discount Type:</strong> {{ $order->coupon_type }} / <strong>Coupon Code:</strong>
                            {{ $order->coupon_code }}</p>

                    </div>
                @endif
            </div>

        </div>


        <h3>Order Details</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Original Price</th>
                    <th>Final Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
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
                        <td>{{ $detail->product->name }}</td>
                        <td>${{ number_format($detail->original_price, 2) }}</td>
                        <td>${{ number_format($detail->final_price, 2) }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>${{ number_format($detail->final_price * $detail->quantity, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2">
                        <table style="width: 80%; border-collapse: collapse;">
                            <tr>
                                <td><strong>Sub Total:</strong></td>
                                <td>${{ number_format($totalAfterDiscount, 2) }}</td>
                            </tr>
                            @if ($order->discount_amount)
                                <tr>
                                    <td><strong>Discount Amount:</strong></td>
                                    <td>${{ number_format($order->discount_amount, 2) }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td><strong>Total:</strong></td>
                                <td>${{ number_format($order->total_price, 2) }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
@endsection

