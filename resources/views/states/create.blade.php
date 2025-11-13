@extends('layouts.master')

@section('title', 'Create State')

@section('content')
    <div class="container">
        <h1>Create State</h1>

        <form action="{{ route('states.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="abbreviation">Abbreviation</label>
                <input type="text" name="abbreviation" class="form-control" value="{{ old('abbreviation') }}" required>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Create</button>

            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection