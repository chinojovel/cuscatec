@extends('layouts.master')
@section('title')
    Detail Purchase Order
@endsection

@section('content')
<div class="container">
    <h1>Purchase Order #{{ $purchaseOrder->order_number }}</h1>

    <div class="card mb-3">
        <div class="card-header">
            Supplier Information
        </div>
        <div class="card-body">
            <p><strong>Supplier Name:</strong> {{ $purchaseOrder->supplier->name }}</p>
            <p><strong>Order Date:</strong> {{ $purchaseOrder->order_date }}</p>
            <p><strong>Total Amount:</strong> ${{ number_format($purchaseOrder->total_amount, 2) }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Order Details
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchaseOrder->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Total Amount:</th>
                        <th>${{ number_format($purchaseOrder->total_amount, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
