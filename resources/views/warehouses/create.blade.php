@extends('layouts.master')

@section('title', 'Create Warehouse')

@section('content')
    <div class="container">
        <h1>Create Warehouse</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('administration.warehouse.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}"
                    required>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="state_id" class="form-label">State</label>
                <select class="form-control" id="state_id" name="state_id">
                    <option value="">Select state</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}"
                            {{ isset($warehouse) && $warehouse->state_id == $state->id ? 'selected' : '' }}>
                            {{ $state->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Warehouse</button>
            <a href="{{ route('administration.warehouse.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
