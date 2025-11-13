@extends('layouts.master')
@section('title')
    Coupons List
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            MyApp
        @endslot
        @slot('title')
            Coupons List
        @endslot
    @endcomponent

    <div class="container">
        <h1>Coupons List</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('coupons.create') }}" class="btn btn-primary">Create Coupon</a>
        </div>
        <div class="table-responsive">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Discount Amount</th>
                        <th>Discount Percentage</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->discount_amount }}</td>
                            <td>{{ $coupon->discount_percentage }}</td>
                            <td>{{ $coupon->type == 'a' ? 'Amount' : 'Percentage' }}</td>
                            <td>{{ $coupon->status == 'active' ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $coupon->start_date }}</td>
                            <td>{{ $coupon->end_date }}</td>
                            <td>
                                <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure?')">Deactivate</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $coupons->withQueryString()->links('pagination::bootstrap-5') !!}

    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection

