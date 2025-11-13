@extends('layouts.master')
@section('title')
    Edit Coupon
@endsection

@section('content')

    <div class="container">
        <h1>Edit Coupon</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code"
                    value="{{ old('code', $coupon->code) }}" required>
            </div>

            <div class="mb-3 col-12">
                <label for="type" class="form-label">Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="a" {{ old('type', $coupon->type ?? '') == 'a' ? 'selected' : '' }}>Amount</option>
                    <option value="p" {{ old('type', $coupon->type ?? '') == 'p' ? 'selected' : '' }}>Percentage
                    </option>
                </select>
            </div>

            <div class="mb-3 col-12" id="discount_amount_div">
                <label for="discount_amount" class="form-label">Discount Amount</label>
                <input type="number" class="form-control" id="discount_amount" name="discount_amount"
                    value="{{ old('discount_amount', $coupon->discount_amount ?? '') }}" step="0.01">
            </div>

            <div class="mb-3 col-12" id="discount_percentage_div">
                <label for="discount_percentage" class="form-label">Discount Percentage</label>
                <input type="number" class="form-control" id="discount_percentage" name="discount_percentage"
                    value="{{ old('discount_percentage', $coupon->discount_percentage ?? '') }}" min="0"
                    max="100">
            </div>


            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status-coupon" name="status" required>
                    <option value="active" {{ old('status', $coupon->status) == 'active' ? 'selected' : '' }}>Active
                    </option>
                    <option value="inactive" {{ old('status', $coupon->status) == 'inactive' ? 'selected' : '' }}>Inactive
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date"
                    value="{{ old('start_date', $coupon->start_date) }}" required>
            </div>

            <div class="mb-3"> <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date"
                    value="{{ old('end_date', $coupon->end_date) }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('coupons.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            const typeSelect = $('#type');
            const discountAmountDiv = $('#discount_amount_div');
            const discountPercentageDiv = $('#discount_percentage_div');

            function toggleDiscountFields() {
                if (typeSelect.val() === 'a') {
                    discountAmountDiv.show();
                    discountPercentageDiv.hide();
                } else if (typeSelect.val() === 'p') {
                    discountAmountDiv.hide();
                    discountPercentageDiv.show();
                }
            }

            // Llama a la función al cargar la página para asegurarte de que el campo correcto esté visible
            toggleDiscountFields();

            // Escucha los cambios en el campo select
            typeSelect.change(toggleDiscountFields);
        });
    </script>


    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
