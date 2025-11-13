@extends('layouts.master')

@section('title', 'Create Purchase Order')

@section('content')
    <div class="container">
        <h1>Create Purchase Order</h1>

        <form action="{{ route('purchase_orders.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="order_number" class="form-label">Order Number</label>
                <input type="text" id="order_number" name="order_number" class="form-control"
                    value="{{ old('order_number') }}" required>
                @error('order_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="supplier_id" class="form-label">Supplier</label>
                <select id="supplier_id" name="supplier_id" class="form-select" required>
                    <option value="">Select Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}</option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="warehouse_id" class="form-label">Warehouse</label>
                <select id="warehouse_id" name="warehouse_id" class="form-select" required>
                    <option value="">Select Warehouse</option>
                    @foreach ($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                            {{ $warehouse->name }}</option>
                    @endforeach
                </select>
                @error('warehouse_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="order_date" class="form-label">Order Date</label>
                <input type="date" id="order_date" name="order_date" class="form-control" value="{{ old('order_date') }}"
                    required>
                @error('order_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <table class="table table-bordered" id="order-details-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="order-details">
                        <!-- Dynamically added rows will go here -->
                    </tbody>
                </table>
                <button type="button" id="add-detail" class="btn btn-secondary">Add Detail</button>
            </div>

            <div class="mb-3 mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>


    </div>

    <script>
        document.getElementById('add-detail').addEventListener('click', function() {
            let container = document.getElementById('order-details');
            let index = container.children.length;
            let html = `
                <tr>
                    <td>
                        <select name="details[${index}][product_id]" class="form-select" required>
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="details[${index}][quantity]" class="form-control" required>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="details[${index}][price]" class="form-control" required>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-detail">Remove</button>
                    </td>
                </tr>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });

        // Remove row functionality
        document.getElementById('order-details').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-detail')) {
                event.target.closest('tr').remove();
            }
        });
    </script>
@endsection
