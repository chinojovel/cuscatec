@extends('layouts.master')

@section('title', 'Edit State')

@section('content')
    <div class="container">
        <h1>Edit State</h1>

        <form action="{{ route('states.update', $state->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $state->name) }}" required>
            </div>

            <div class="form-group">
                <label for="abbreviation">Abbreviation</label>
                <input type="text" name="abbreviation" class="form-control" value="{{ old('abbreviation', $state->abbreviation) }}" required>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection