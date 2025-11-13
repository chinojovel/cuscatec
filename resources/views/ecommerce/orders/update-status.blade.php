@extends('ecommerce.layouts.master')

@section('title', 'Orders')

@section('content')
    <div class="container">

        <h2>Update Order Status</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

     
        <form action="{{ route('ecommerce.orders.updateStatus', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="payment_status">Payment Status</label>
                <select name="payment_status" id="payment_status" class="form-control">
                    <option value="P" {{ $order->payment_status == 'P' ? 'selected' : '' }}>Pending</option>
                    <option value="C" {{ $order->payment_status == 'C' ? 'selected' : '' }}>Check</option>
                    <option value="D" {{ $order->payment_status == 'D' ? 'selected' : '' }}>Cash</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Status</button>
        </form>
    </div>
@endsection

