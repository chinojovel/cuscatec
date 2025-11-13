@extends('layouts.master')

@section('title', 'Purchase Orders')

@section('content')
    <div class="container">
        <h1>Purchase Orders</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
            <a href="{{ route('purchase_orders.create') }}" class="btn btn-primary">Add New Order</a>
        </div>
        <div class="table-responsive">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Supplier</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchaseOrders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->supplier->name ?? 'No Supplier' }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <a href="{{ route('purchase_orders.show', $order->id) }}" class="btn btn-info">View</a>
                                <!-- Add additional actions if needed -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $purchaseOrders->withQueryString()->links('pagination::bootstrap-5') !!}

    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection

