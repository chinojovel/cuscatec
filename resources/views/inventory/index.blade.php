@extends('layouts.master')

@section('title', 'Inventory Management')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        <h1 class="mt-4">Inventory by Warehouse</h1>

        <form method="GET" action="{{ route('administration.inventory.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="warehouse_id" class="form-label">Select Warehouse</label>
                    <select name="warehouse_id" id="warehouse_id" class="form-control">
                        <option value="">All Warehouses</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ request('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="product_id" class="form-label">Select Product</label>
                    <select name="product_id" id="product_id" class="form-control select2">
                        <option value="">All Products</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label d-block">&nbsp;</label>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('administration.inventory.export', request()->query()) }}" class="btn btn-success">Download Excel</a>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Warehouse</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stocks as $stock)
                    <tr>
                        <td>{{ $stock->warehouse->name }}</td>
                        <td>{{ $stock->product->name }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>{{ $stock->updated_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No inventory found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select a product",
                allowClear: true
            });
        });
    </script>
@endsection
