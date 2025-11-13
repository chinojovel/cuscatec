@extends('customers_ecommerce.layouts.master')
@section('title', 'Orders')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container">
        <h1>Orders</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="GET" action="{{ route('customer.ecommerce.orders.index') }}" class="mb-4">
            <div class="row">
                <!-- Filtro por Fecha -->
                <div class="col-md-4">
                    <label for="date">From Date:</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
                </div>

                <div class="col-md-4">
                    <label for="date">To Date:</label>
                    <input type="date" name="date_to" id="date_to" class="form-control"
                        value="{{ request('date_to') }}">
                </div>

                <!-- Filtro por Estado de Pago -->
                <div class="col-md-4">
                    <label for="payment_status">Payment Status:</label>
                    <select name="payment_status" id="payment_status" class="form-control">
                        <option value="">All Statuses</option>
                        <option value="P" {{ request('payment_status') == 'P' ? 'selected' : '' }}>Pending</option>
                        <option value="C" {{ request('payment_status') == 'C' ? 'selected' : '' }}>Check</option>
                        <option value="D" {{ request('payment_status') == 'D' ? 'selected' : '' }}>Cash</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="tracking_status">Delivered Status:</label>
                    <select name="tracking_status" id="tracking_status_filter" class="form-control">
                        <option value="">All Statuses</option>
                        <option value="N" {{ request('tracking_status') == 'N' ? 'selected' : '' }}>Processing Order
                        </option>
                        <option value="E" {{ request('tracking_status') == 'E' ? 'selected' : '' }}>In Transit
                        </option>
                        <option value="T" {{ request('tracking_status') == 'T' ? 'selected' : '' }}>Delivered
                        </option>
                        <option value="I" {{ request('tracking_status') == 'I' ? 'selected' : '' }}>Immediate
                            Delivery</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="type">Origin:</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">All Source</option>
                        <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Costumer App
                        </option>
                        <option value="0" {{ request('type') == '0' ? 'selected' : '' }}>Seller app
                        </option>
                    </select>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('customer.ecommerce.orders.index') }}" class="btn btn-secondary">Clear</a>
                <!-- Botón para limpiar -->
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                        <th>Payment Status</th> <!-- Columna de estado de pago -->
                        <th>Origin</th>
                        <th>Tracking Status</th> <!-- Nueva columna para estado de tracking -->
                        <th>Tracking Number</th> <!-- Nueva columna para número de tracking -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                @if (isset($order->customer->name))
                                    {{ $order->customer->name }}
                                @endif
                            </td>
                            <td>${{ number_format($order->total_price, 2) }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>
                                @if ($order->payment_status === 'P')
                                    Pending
                                @elseif ($order->payment_status === 'C')
                                    Check
                                @else
                                    Cash
                                @endif
                            </td>
                            <td>
                                @if ($order->type == 0)
                                    Seller app
                                @else
                                    Costumer App
                                @endif
                            </td>
                            <td>
                                @if ($order->tracking_status === 'N')
                                    Processing Order
                                @elseif ($order->tracking_status === 'E')
                                    In Transit
                                @elseif ($order->tracking_status === 'T')
                                    Delivered
                                @elseif ($order->tracking_status === 'I')
                                    Immediate Delivery
                                @else
                                    Unknown
                                @endif
                            </td>
                            <td>
                                {{ $order->tracking_number ?? 'N/A' }}
                            </td>
                            <td class="text-end" style="white-space: nowrap;">
                                <a href="{{ route('customer.ecommerce.orders.show', $order->id) }}" class="btn  btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!}

        



    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



@endsection
