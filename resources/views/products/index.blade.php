@extends('layouts.master')

@section('title', 'Products')

@section('content')
<div class="container">
    <h1>Products</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pestañas para cambiar entre Activos y Borrados --}}
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link {{ !$status ? 'active' : '' }}" href="{{ route('products.index') }}">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status === 'trashed' ? 'active' : '' }}" href="{{ route('products.index', ['status' => 'trashed']) }}">Trashed</a>
        </li>
    </ul>

    <!-- Formulario de acciones (Búsqueda, Paginación, Botones) -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row gy-2 align-items-center">
                <!-- Botones de Acción Condicionales -->
                <div class="col-md-4 col-sm-12">
                    @if($status !== 'trashed')
                        <a href="{{ route('products.create') }}" class="btn btn-primary me-2">Add New Product</a>
                        <button type="submit" form="massActionForm" class="btn btn-danger">Move to Trash</button>
                    @else
                        <button type="submit" form="massActionForm" class="btn btn-success">Restore Selected</button>
                    @endif
                </div>
                
                <!-- Búsqueda -->
                <div class="col-md-4 col-sm-6">
                    <form action="{{ route('products.index') }}" method="GET" class="d-flex">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <input type="hidden" name="per_page" value="{{ $perPage }}">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search by name" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                
                <!-- Selector de Paginación -->
                <div class="col-md-4 col-sm-6">
                    <form action="{{ route('products.index') }}" method="GET" class="d-flex justify-content-end">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <label for="per_page" class="col-form-label me-2">Items:</label>
                        <select name="per_page" id="per_page" class="form-select" style="width: auto;" onchange="this.form.submit()">
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Formulario condicional para acciones masivas --}}
    <form action="{{ $status === 'trashed' ? route('products.massRestore') : route('products.massDestroy') }}" method="POST" id="massActionForm">
        @csrf
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Image</th>
                        @if($status === 'trashed')
                            <th>Deleted At</th>
                        @else
                            <th>Total Stock</th>
                        @endif
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="{{ $status === 'trashed' ? 'table-secondary' : '' }}">
                            <td><input type="checkbox" name="product_ids[]" class="product-checkbox" value="{{ $product->id }}"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->category->name ?? 'No Category' }}</td>
                            <td>
                                @if ($product->image_url)
                                    <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" width="50">
                                @else
                                    No Image
                                @endif
                            </td>
                            @if($status === 'trashed')
                                <td>{{ $product->deleted_at->format('Y-m-d H:i') }}</td>
                            @else
                                <td class="text-center">{{ $product->total_stock }}</td>
                            @endif
                            
                            {{-- Botones de acción condicionales por fila --}}
                            <td>
                                @if($status === 'trashed')
                                    {{-- Acciones para productos borrados --}}
                                    <form action="{{ route('products.restore', $product->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Restore"><i class="fas fa-undo"></i></button>
                                    </form>
                                @else
                                    {{-- Acciones para productos activos --}}
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Move to Trash" onclick="return confirm('Are you sure you want to move this product to trash?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    <a href="{{ route('products.prices.edit', $product->id) }}" class="btn btn-sm btn-secondary" title="Prices"><i class="fas fa-dollar-sign"></i></a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </form>

    {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#select-all').on('click', function() {
        $('.product-checkbox').prop('checked', $(this).is(':checked'));
    });

    $('#massActionForm').on('submit', function(e) {
        const selectedCount = $('.product-checkbox:checked').length;
        if (selectedCount === 0) {
            alert('Please select at least one product.');
            e.preventDefault();
            return;
        }

        const formAction = $(this).attr('action');
        const actionVerb = formAction.includes('restore') ? 'restore' : 'move to trash';
        
        if (!confirm(`Are you sure you want to ${actionVerb} the ${selectedCount} selected products?`)) {
            e.preventDefault();
        }
    });
});
</script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection