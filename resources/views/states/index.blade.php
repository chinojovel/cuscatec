@extends('layouts.master')

@section('title', 'States List')

@section('content')

    <div class="container">
        <h1>States List</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('states.create') }}" class="btn btn-primary">Create State</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Abbreviation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($states as $state)
                        <tr>
                            <td>{{ $state->name }}</td>
                            <td>{{ $state->abbreviation }}</td>
                            <td>
                                {{-- <a href="{{ route('states.show', $state->id) }}" class="btn btn-info">Show</a> --}}
                                <a href="{{ route('states.edit', $state->id) }}" class="btn btn-warning">Edit</a>
                                {{-- <form action="{{ route('states.destroy', $state->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $states->withQueryString()->links('pagination::bootstrap-5') !!}

    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection

