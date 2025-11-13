@extends('layouts.master')

@section('title')
    Customers List
@endsection

@section('content')
    <div class="container">
        <h1>Customers List</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario de búsqueda -->
        <div class="mb-4">
            <form action="{{ route('customers.index') }}" method="GET" class="row">
                <div class="col-md-4 col-12 mb-2 mb-md-0">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Search customers by name" 
                           value="{{ request('search') }}"> <!-- Mantener valor de búsqueda -->
                </div>
                <div class="col-md-4 col-12 mb-2 mb-md-0">
                    <select name="state" class="form-select">
                        <option value="">All State</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" {{ request('state') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-12">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>

        <div class="mb-3">
            <a href="{{ route('customers.create') }}" class="btn btn-primary">Create Customer</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>State</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->user ? $customer->user->email : 'No email available' }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->state ? $customer->state->name : 'No state assigned' }}</td>
                            <td>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>

                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure?')">Desactivar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {!! $customers->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
