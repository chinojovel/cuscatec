@extends('layouts.master')

@section('title', 'Orders')

@section('content')
    <div class="container">
        <h1>Product Sales Report</h1>

        <!-- Formulario de búsqueda -->
        <form action="{{ route('administration.products.sales.index') }}">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="user_id" class="form-label">Select User</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $userId == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ $startDate }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        @if ($userFind !== null)
            <h3>Vendedora: {{ $userFind->name }}</h3>
        @endif

        <!-- Tabla de resultados -->
        @if (!empty($sales))
            <div class="mb-3">
                <a href="{{ route('administration.products.sales.export', ['user_id' => $userId, 'start_date' => $startDate, 'end_date' => $endDate]) }}"
                    class="btn btn-success">
                    Export to Excel
                </a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Total Products Sold</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->product_id }}</td>
                            <td>{{ $sale->product_name }}</td>
                            <td>{{ $sale->total_products_sold }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection

@section('script')


    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
