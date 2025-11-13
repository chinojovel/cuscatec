@extends('layouts.master')

@section('title', 'Manage Product Prices')

@section('content')
    <div class="container">
        <h1>Manage Prices for {{ $product->name }}</h1>

        <form action="{{ route('products.prices.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <table class="table">
                <thead>
                    <tr>
                        <th>State</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($states as $state)
                        <tr>
                            <td>{{ $state->name }}</td>
                            <td>
                                <input type="number" step="0.01" name="prices[{{ $state->id }}][price]" class="form-control"
                                       value="{{ old('prices.' . $state->id . '.price', $prices[$state->id]->price ?? '') }}" required>
                                <input type="hidden" name="prices[{{ $state->id }}][state_id]" value="{{ $state->id }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Update Prices</button>
        </form>
    </div>
@endsection


@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
