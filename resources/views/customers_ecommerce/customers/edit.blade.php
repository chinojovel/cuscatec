@extends('customers_ecommerce.layouts.master')
@section('title')
    Edit Customer
@endsection

@section('content')
    <div class="container">
        <h1>Edit Customer</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('customer.ecommerce.customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $customer->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="{{ old('phone', $customer->phone) }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ old('address', $customer->address) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="{{ old('email', $customer->user->email ?? '') }}" 
                       required>
            </div>

            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <select name="state_id" id="state_id" class="form-control">
                    <option value="" disabled>Select a state</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}" {{ $state->id == $customer->state_id ? 'selected' : '' }}>
                            {{ $state->name }}
                        </option>
                    @endforeach
                </select>
            </div>

             

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection


@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
