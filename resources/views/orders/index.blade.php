@extends('layouts.master')

@section('title', 'Orders')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        <h1>Orders</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="GET" action="{{ route('administration.orders.index') }}" class="mb-4">
            <div class="row">
                <!-- Filtro por Cliente -->
                <div class="col-md-4">
                    <label for="customer_id">Customer:</label>
                    <select name="customer_id" id="customer_id" class="form-control select2-customer">
                        <option value="">All Customers</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}"
                                {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="seller_id">Seller:</label>
                    <select name="seller_id" id="seller_id" class="form-control select2-seller">
                        <option value="">All Seller</option>
                        @foreach ($users as $seller)
                            <option value="{{ $seller->id }}" {{ request('seller_id') == $seller->id ? 'selected' : '' }}>
                                {{ $seller->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por Fecha -->
                <div class="col-md-4">
                    <label for="date">From Date:</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
                </div>

                <div class="col-md-4">
                    <label for="date">To Date:</label>
                    <input type="date" name="date_to" id="date_to" class="form-control"
                        value="{{ request('date_to') }}">
                </div>

                <!-- Filtro por Estado de Pago -->
                <div class="col-md-4">
                    <label for="payment_status">Payment Status:</label>
                    <select name="payment_status" id="payment_status" class="form-control">
                        <option value="">All Statuses</option>
                        <option value="P" {{ request('payment_status') == 'P' ? 'selected' : '' }}>Pending</option>
                        <option value="C" {{ request('payment_status') == 'C' ? 'selected' : '' }}>Check</option>
                        <option value="D" {{ request('payment_status') == 'D' ? 'selected' : '' }}>Cash</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="tracking_status">Delivered Status:</label>
                    <select name="tracking_status" id="tracking_status_filter" class="form-control">
                        <option value="">All Statuses</option>
                        <option value="N" {{ request('tracking_status') == 'N' ? 'selected' : '' }}>Processing Order
                        </option>
                        <option value="E" {{ request('tracking_status') == 'E' ? 'selected' : '' }}>In Transit
                        </option>
                        <option value="T" {{ request('tracking_status') == 'T' ? 'selected' : '' }}>Delivered
                        </option>
                        <option value="I" {{ request('tracking_status') == 'I' ? 'selected' : '' }}>Immediate
                            Delivery</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="type">Origin:</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">All Source</option>
                        <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Costumer App
                        </option>
                        <option value="0" {{ request('type') == '0' ? 'selected' : '' }}>Seller app
                        </option>
                    </select>
                </div>

                <div class="col-md-5">
                    <label for="product_id" class="form-label">Producto</label>
                    <select name="product_id" id="product_id" class="form-select">
                        <option value="">-- Seleccione un Producto --</option>
                        @foreach ($products as $prod)
                            <option value="{{ $prod->id }}"
                                {{ request('product_id') == $prod->id ? 'selected' : '' }}>
                                {{ $prod->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('administration.orders.index') }}" class="btn btn-secondary">Clear</a>

                <!-- NUEVO BOTÓN DE EXPORTACIÓN -->
                <a href="{{ route('administration.orders.exportExcel', request()->query()) }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export to Excel
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        @can('orders.totalprice')
                            <th>Total Price</th>
                        @endcan
                        <th>Order Date</th>
                        <th>Payment Status</th> <!-- Columna de estado de pago -->
                        <th>Origin</th>
                        <th>Tracking Status</th> <!-- Nueva columna para estado de tracking -->
                        <th>Tracking Number</th> <!-- Nueva columna para número de tracking -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                @if (isset($order->customer->name))
                                    {{ $order->customer->name }}
                                @endif
                            </td>
                            @can('orders.totalprice')
                                <td>${{ number_format($order->total_price, 2) }}</td>
                            @endcan
                            <td>{{ $order->order_date }}</td>
                            <td>
                                @if ($order->payment_status === 'P')
                                    Pending
                                @elseif ($order->payment_status === 'C')
                                    Check
                                @else
                                    Cash
                                @endif
                            </td>
                            <td>
                                @if ($order->type == 0)
                                    Seller app
                                @else
                                    Costumer App
                                @endif
                            </td>
                            <td>
                                @if ($order->tracking_status === 'N')
                                    Processing Order
                                @elseif ($order->tracking_status === 'E')
                                    In Transit
                                @elseif ($order->tracking_status === 'T')
                                    Delivered
                                @elseif ($order->tracking_status === 'I')
                                    Immediate Delivery
                                @else
                                    Unknown
                                @endif
                            </td>
                            <td>
                                {{ $order->tracking_number ?? 'N/A' }}
                            </td>
                            <td class="text-end" style="white-space: nowrap;">
                                @can('orders.show')
                                    <a href="{{ route('administration.orders.show', $order->id) }}" class="btn  btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('orders.edit')
                                    <a href="{{ route('administration.orders.edit', $order->id) }}" class="btn  btn-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('orders.editwarehouse')
                                    <a href="{{ route('administration.warehouse.orders.edit', $order->id) }}"
                                        class="btn  btn-secondary">
                                        <i class="fas fa-warehouse"></i>
                                    </a>
                                @endcan
                                @can('orders.updatestatus')
                                    <button type="button" class="btn btn-warning " data-bs-toggle="modal"
                                        data-bs-target="#updateStatusModal" data-order-id="{{ $order->id }}"
                                        data-payment-status="{{ $order->payment_status }}">
                                        <i class="fas fa-money-bill-wave"></i> </button>
                                @endcan
                                @can('orders.print')
                                    <a href="{{ route('administration.orders.print', $order->id) }}" class="btn btn-primary">
                                        <i class="fas fa-print"></i>
                                    </a>
                                @endcan
                                @can('orders.tracking')
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#trackingModal" data-order-id="{{ $order->id }}">
                                        <i class="fas fa-truck"></i>
                                    </button>
                                @endcan

                                <form method="POST" action="{{ route('administration.orders.destroy', $order->id) }}"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this order and all its related data?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!}

        <!-- Modal para actualizar el estado de tracking -->
        <div class="modal fade" id="trackingModal" tabindex="-1" aria-labelledby="trackingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="trackingModalLabel">Update Tracking Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('administration.orders.updateTracking') }}" id="trackingForm">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="order_id" id="order_id" value="">
                            <div class="mb-3">
                                <label for="tracking_status" class="form-label">Tracking Status</label>
                                <select name="tracking_status" id="tracking_status" class="form-control" required>
                                    <option value="N">Not Sent</option>
                                    <option value="E">In Transit</option>
                                    <option value="T">Delivered</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="warehouse_id" class="form-label">Seleccionar Bodega</label>
                                <select name="warehouse_id" class="form-control" required>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3" id="trackingNumberField" style="display: none;">
                                <label for="tracking_number" class="form-label">Tracking Number</label>
                                <input type="text" name="tracking_number" id="tracking_number" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal para actualizar el estado de la orden -->
        <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStatusModalLabel">Update Order Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="" id="updateStatusForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <select name="payment_status" id="payment_status_modal" class="form-control">
                                    <option value="P">Pending</option>
                                    <option value="C">Check</option>
                                    <option value="D">Cash</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluir archivos de Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        // Mostrar/ocultar el campo "tracking_number" basado en el estado seleccionado
        $(document).ready(function() {

            $('.select2-customer').select2({
                placeholder: "Select a customer", // Texto de marcador
                allowClear: true // Botón para limpiar selección
            });

            $('.select2-seller').select2({
                placeholder: "Select a seller", // Texto de marcador
                allowClear: true // Botón para limpiar selección
            });



            // Detectar cambio en el select de tracking_status
            $('#tracking_status').on('change', function() {
                console.log('event');
                var trackingNumberField = $('#trackingNumberField');
                if ($(this).val() === 'E' || $(this).val() === 'T') {
                    trackingNumberField.show();
                    $('#tracking_number').prop('required', true);
                    $('#warehouse_id').prop('required', true);
                } else {
                    trackingNumberField.hide();
                    $('#tracking_number').prop('required', false);
                    $('#warehouse_id').prop('required', false);

                }
            });

            // Configurar el ID de la orden al abrir el modal
            $('[data-bs-target="#trackingModal"]').on('click', function() {
                var orderId = $(this).data('order-id');
                $('#order_id').val(orderId);
            });
        });
    </script>

    <script>
        // Abrir el modal y configurar el formulario para la orden seleccionada
        document.querySelectorAll('[data-bs-target="#updateStatusModal"]').forEach(button => {
            button.addEventListener('click', function() {
                var orderId = this.getAttribute('data-order-id');
                var paymentStatus = this.getAttribute('data-payment-status');
                var form = document.getElementById('updateStatusForm');

                // Establecer la acción del formulario para la orden seleccionada
                form.action = `/administration/orders/update-status/${orderId}`;

                // Establecer el estado de pago actual en el select del modal
                document.getElementById('payment_status_modal').value = paymentStatus;
            });
        });
    </script>

    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
