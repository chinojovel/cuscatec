@extends('layouts.master')

@section('title', 'Create State')

@section('content')
<div class="container">
    <h2>Cargar Excel de Ingresos de productos</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('administration.warehouse.import') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="warehouse_id" class="form-label">Seleccionar Bodega</label>
            <select name="warehouse_id" class="form-control" required>
                @foreach($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Seleccionar archivo Excel</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Cargar</button>
        <a href="{{ route('administration.warehouse.export') }}" class="btn btn-success">Descargar Plantilla Excel</a> 

    </form>
</div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection