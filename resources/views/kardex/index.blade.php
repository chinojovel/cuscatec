@extends('layouts.master')

@section('title')
    @lang('translation.Product Kardex')
@endsection

{{-- Puedes agregar un permiso específico para esta vista, si lo deseas --}}
{{-- @can('inventory.kardex.view') --}}

@section('content')

    {{-- Título de la página, similar a como lo manejan otras vistas --}}
 

    <div class="row">
        <div class="col-xl-12">
            {{-- FORMULARIO DE FILTROS --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Filtros de Búsqueda</h4>
                    <p class="card-title-desc">Selecciona un producto y el periodo para generar el reporte.</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('administration.kardex.index') }}" method="GET" class="row gx-3 gy-2 align-items-end">
                        <div class="col-sm-5">
                            <label for="product_id" class="form-label">Producto</label>
                            <select name="product_id" id="product_id" class="form-select" required>
                                <option value="">-- Seleccione un Producto --</option>
                                @foreach($allProducts as $prod)
                                    <option value="{{ $prod->id }}" {{ $selectedProduct && $selectedProduct->id == $prod->id ? 'selected' : '' }}>
                                        {{ $prod->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="month" class="form-label">Mes</label>
                            <select name="month" id="month" class="form-select">
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                                        {{-- Usamos isoFormat para mostrar el nombre del mes en el idioma configurado --}}
                                        {{ \Carbon\Carbon::create()->month($m)->isoFormat('MMMM') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="year" class="form-label">Año</label>
                            <select name="year" id="year" class="form-select">
                                @for ($y = now()->year; $y >= 2020; $y--)
                                    <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="mdi mdi-magnify me-1"></i> Consultar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- RESULTADOS DEL KARDEX (Solo se muestra si se ha hecho una consulta) --}}
            @if($selectedProduct)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            Movimientos para: <strong>{{ $selectedProduct->name }}</strong>
                        </h4>
                        <p class="text-muted mb-0">
                            Periodo: {{ \Carbon\Carbon::create()->month($selectedMonth)->isoFormat('MMMM') }} de {{ $selectedYear }}
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="kardex-table" class="table table-bordered table-striped dt-responsive nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 10%;">Fecha</th>
                                        <th style="width: 15%;">Tipo Documento</th>
                                        <th>Descripción de Movimiento</th>
                                        <th style="width: 10%;">Entradas</th>
                                        <th style="width: 10%;">Salidas</th>
                                        <th style="width: 10%;">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Fila para el Saldo Inicial --}}
                                    <tr class="table-info">
                                        <td colspan="5" class="text-end fw-bold">SALDO ANTERIOR</td>
                                        <td class="text-center fw-bold">{{ number_format($initialStock, 2) }}</td>
                                    </tr>

                                    {{-- Filas para los movimientos del mes --}}
                                    @forelse($kardexData as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->date }}</td>
                                            <td class="text-center">{{ $item->document_type }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td class="text-center text-success fw-bold">
                                                {{ $item->entry > 0 ? number_format($item->entry, 2) : '-' }}
                                            </td>
                                            <td class="text-center text-danger fw-bold">
                                                 {{ $item->exit < 0 ? number_format($item->exit, 2) : '-' }}
                                            </td>
                                            <td class="text-center fw-bold">{{ number_format($item->balance, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted p-4">No se encontraron movimientos para este producto en el periodo seleccionado.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    {{-- Fila para el Saldo Final --}}
                                    <tr class="table-info">
                                        <td colspan="5" class="text-end fw-bold">SALDO FINAL</td>
                                        <td class="text-center fw-bold">
                                            {{-- Si no hubo movimientos, el saldo final es el inicial. Si hubo, es el último saldo calculado. --}}
                                            {{ number_format(empty($kardexData) ? $initialStock : end($kardexData)->balance, 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="mdi mdi-information-outline me-2"></i>
                    Por favor, seleccione un producto y un periodo para ver su Kardex.
                </div>
            @endif

        </div>
    </div>
@endsection

@section('script')
    {{-- Tu plantilla maestra ya debería incluir jQuery y DataTables, pero si no, puedes agregarlos aquí --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
    
    {{-- Opcional: Agregar DataTables a la tabla de resultados para paginación y ordenamiento --}}
    <script>
        $(document).ready(function() {
            // Se aplica DataTables a la tabla de resultados solo si existe.
            if ($('#kardex-table').length) {
                $('#kardex-table').DataTable({
                    "paging": true,       // Habilitar paginación
                    "lengthChange": true, // Habilitar cambio de número de registros por página
                    "searching": true,    // Habilitar búsqueda
                    "ordering": true,     // Habilitar ordenamiento de columnas
                    "info": true,         // Mostrar información (Ej: "Mostrando 1 a 10 de 57 registros")
                    "autoWidth": false,
                    "responsive": true,
                    "order": [], // Desactiva el ordenamiento inicial automático
                    "language": { // Opcional: Traducción al español
                        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                    },
                    "columnDefs": [
                        // Evita que la columna de saldo y la fila de saldo inicial/final se ordenen
                        { "orderable": false, "targets": [5] } 
                    ]
                });
            }
        });
    </script>
@endsection

{{-- @endcan --}}