@extends('layouts.master')
@section('title')
    Sellers List
@endsection

@section('content')
    <div class="container">
        <h1>Sellers List</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-3">
            <a href="{{ route('sellers.create') }}" class="btn btn-primary">Create Seller</a>
        </div>
        <div class="table-responsive">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellers as $seller)
                        <tr>
                            <td>{{ $seller->name }}</td>
                            <td>{{ $seller->user->email }}</td>
                            <td>{{ $seller->phone }}</td>
                            <td>{{ $seller->address }}</td>
                            <td>
                                {{-- <a href="{{ route('sellers.show', $seller->id) }}" class="btn btn-info">Show</a> --}}
                                {{-- <a href="{{ route('sellers.edit', $seller->id) }}" class="btn btn-warning">Edit</a> --}}
                                <form action="{{ route('sellers.destroy', $seller->id) }}" method="POST"
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
        {!! $sellers->withQueryString()->links('pagination::bootstrap-5') !!}

    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
