@extends('layouts.master')

@section('title', 'Edit Order')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container">
        <h1>Edit and Ship Order #{{ $order->id }}</h1>

        <form action="{{ route('administration.warehouse.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h3>Order Details</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody id="order-details-body">
                    @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td>
                                <input type="number" name="order_details[{{ $loop->index }}][quantity]"
                                    value="{{ $detail->quantity }}" class="form-control" required min="1">
                            </td>
                            <td>
                                <input type="checkbox" name="order_details[{{ $loop->index }}][remove]" value="1">
                            </td>
                            <input type="hidden" name="order_details[{{ $loop->index }}][product_id]"
                                value="{{ $detail->product_id }}">
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <div class="mb-3">
                    <label for="warehouse_id" class="form-label">Seleccionar Bodega</label>
                    <select name="warehouse_id" class="form-control" required>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3" id="trackingNumberField">
                    <label for="tracking_number" class="form-label">Tracking Number</label>
                    <input type="text" name="tracking_number" id="tracking_number" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">ship items</button>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            $(document).on("click", ".remove-product", function() {
                $(this).closest("tr").remove();
            });
           

        });
    </script>
@endsection
