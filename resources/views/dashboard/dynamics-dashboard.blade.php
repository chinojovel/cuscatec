@extends('layouts.master')
@section('title')
    @lang('translation.Dashboard')
@endsection

@section('content')
    <div class="row">
        <form method="GET" action="{{ route('dynamic.dashboard') }}" class="mb-4">
            <div class="row">
                <!-- Filtro por Cliente -->
                <div class="col-md-4">
                    <label for="state">State:</label>
                    <select name="state" id="state" class="form-control">
                        <option value="">All States</option>
                        @foreach ($statesAll as $state)
                            <option value="{{ $state->id }}" {{ request('state') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por Fecha -->
                <div class="col-md-4">
                    <label for="date">Start Date:</label>
                    <input type="date" name="start_date" id="date" class="form-control"
                        value="{{ request('start_date') }}">
                </div>

                <div class="col-md-4">
                    <label for="date">End Date:</label>
                    <input type="date" name="end_date" id="date" class="form-control"
                        value="{{ request('end_date') }}">
                </div>

            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('dynamic.dashboard') }}" class="btn btn-secondary">Clear</a>
                <!-- Botón para limpiar -->
            </div>
        </form>

    </div>
    <div class="row">

        <div class="col-xl-12">
            <div class="row">
                {{-- TOTAL SALES --}}
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="avatar">
                                <span class="avatar-title bg-primary-subtle rounded">
                                    <i class="mdi mdi-shopping-outline text-primary font-size-24"></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total Sales Last Seven Days</p>
                            <h4 class="mt-1 mb-0">${{ $sumTotalSalesLastSevenDays->total_sales }}
                            </h4>
                            <div>
                                <div class="py-3 my-1">
                                    <div id="totalSalesSevenDay"></div>
                                </div>
                                <ul class="list-inline d-flex justify-content-between justify-content-center mb-0">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- TOTAL ORDERS --}}
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="avatar">
                                <span class="avatar-title bg-success-subtle rounded">
                                    <i class="mdi mdi-eye-outline text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total Orders Last Seven Days</p>
                            <h4 class="mt-1 mb-0">{{ $countTotalOrdersLastSevenDays->total_orders }}

                            </h4>
                            <div>
                                <div class="py-3 my-1">
                                    <div id="countTotalSalesSevenDay" data-colors='["#33a186"]'></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center mb-3">
                        <h5 class="card-title mb-0">Orders by Payment Status</h5>

                    </div>

                    <div class="row align-items-center">
                        <div class="col-xl-8">
                            <div>
                                <div id="order-by-payment-status" data-colors='["#eff1f3","#33a186","#3980c0"]'
                                    class="apex-chart"></div>
                            </div>
                        </div>
                        @php
                            // Inicializamos las variables para asegurarnos de que no haya errores en caso de que falten datos
                            $totalOrdersPending = 0;
                            $totalOrdersCheck = 0;
                            $totalOrdersCancelled = 0;
                            $totalOrdersDelivered = 0;

                            foreach ($paymentStatusOrders as $order) {
                                switch ($order->payment_status) {
                                    case 'P':
                                        $totalOrdersPending = $order->total_orders; // Total de órdenes pendientes
                                        break;
                                    case 'C':
                                        $totalOrdersCheck = $order->total_orders; // Total de órdenes por cheque
                                        break;
                                    case 'D':
                                        $totalOrdersDelivered = $order->total_orders; // Total de órdenes pagadas
                                        break;
                                    // Asumimos que el estado 'Cancelled' puede ser representado por algún valor específico si es necesario
                                    // En este caso, no está en la tabla 'orders' según tu definición
                                    // Puedes añadir otro caso si es necesario
                                }
                            }
                        @endphp

                        <div class="col-xl-4">
                            <div>
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <i class="mdi mdi-circle font-size-10 mt-1 text-primary"></i>
                                            <div class="flex-1 ms-2">
                                                <p class="mb-0">Total Orders (Pending)</p>
                                                <h5 class="mt-1 mb-0 font-size-16">{{ $totalOrdersPending }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 border-top pt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <i class="mdi mdi-circle font-size-10 mt-1 text-primary"></i>
                                            <div class="flex-1 ms-2">
                                                <p class="mb-0">Total Orders (Check)</p>
                                                <h5 class="mt-1 mb-0 font-size-16">{{ $totalOrdersCheck }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 border-top pt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <i class="mdi mdi-circle font-size-10 mt-1 text-success"></i>
                                            <div class="flex-1 ms-2">
                                                <p class="mb-0">Total Orders (Cash)</p>
                                                <h5 class="mt-1 mb-0 font-size-16">{{ $totalOrdersDelivered }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center mb-3">
                        <h5 class="card-title mb-0">Sales by Payment Status</h5>

                    </div>

                    <div class="row align-items-center">
                        <div class="col-xl-8">
                            <div>
                                <div id="sales-by-payment-status" data-colors='["#eff1f3","#33a186","#3980c0"]'
                                    class="apex-chart"></div>
                            </div>
                        </div>
                        @php
                            // Inicializamos las variables para asegurarnos de que no haya errores en caso de que falten datos
                            $totalOrdersPending = 0;
                            $totalOrdersCheck = 0;
                            $totalOrdersCancelled = 0;
                            $totalOrdersDelivered = 0;

                            foreach ($totalSalesByPaymentStatus as $order) {
                                switch ($order->payment_status) {
                                    case 'P':
                                        $totalOrdersPending = $order->total_sales; // Total de órdenes pendientes
                                        break;
                                    case 'C':
                                        $totalOrdersCheck = $order->total_sales; // Total de órdenes por cheque
                                        break;
                                    case 'D':
                                        $totalOrdersDelivered = $order->total_sales; // Total de órdenes pagadas
                                        break;
                                    // Asumimos que el estado 'Cancelled' puede ser representado por algún valor específico si es necesario
                                    // En este caso, no está en la tabla 'orders' según tu definición
                                    // Puedes añadir otro caso si es necesario
                                }
                            }
                        @endphp

                        <div class="col-xl-4">
                            <div>
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <i class="mdi mdi-circle font-size-10 mt-1 text-primary"></i>
                                            <div class="flex-1 ms-2">
                                                <p class="mb-0">Total Orders (Pending)</p>
                                                <h5 class="mt-1 mb-0 font-size-16">${{ $totalOrdersPending }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 border-top pt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <i class="mdi mdi-circle font-size-10 mt-1 text-primary"></i>
                                            <div class="flex-1 ms-2">
                                                <p class="mb-0">Total Orders (Check)</p>
                                                <h5 class="mt-1 mb-0 font-size-16">${{ $totalOrdersCheck }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 border-top pt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <i class="mdi mdi-circle font-size-10 mt-1 text-success"></i>
                                            <div class="flex-1 ms-2">
                                                <p class="mb-0">Total Orders (Cash)</p>
                                                <h5 class="mt-1 mb-0 font-size-16">${{ $totalOrdersDelivered }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center">
                        <h5 class="card-title mb-0">Sales By Category</h5>

                    </div>

                    <div class="text-center mt-4">
                        <canvas class="mx-auto" id="sales-by-category" height="281"></canvas>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <div class="px-2">
                                @foreach ($salesByCategory as $index => $category)
                                    @if ($index % 2 === 0)
                                        <div class="d-flex align-items-center mt-sm-0 mt-2">
                                            <!-- Aquí aplicamos el color al icono -->
                                            <i class="mdi mdi-circle font-size-10 mt-1"
                                                style="color: {{ $salesColors[$index] }}"></i>
                                            <div class="flex-grow-1 ms-2">
                                                <p class="mb-0 text-truncate">
                                                    {{ $category->category_name ?? 'Uncategorized' }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col">
                            <div class="px-2">
                                @foreach ($salesByCategory as $index => $category)
                                    @if ($index % 2 !== 0)
                                        <div class="d-flex align-items-center mt-sm-0 mt-2">
                                            <!-- Aquí aplicamos el color al icono -->
                                            <i class="mdi mdi-circle font-size-10 mt-1"
                                                style="color: {{ $salesColors[$index] }}"></i>
                                            <div class="flex-grow-1 ms-2">
                                                <p class="mb-0 text-truncate">
                                                    {{ $category->category_name ?? 'Uncategorized' }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-12 col-xl-6 ">
            <div class="card">
                <div class="card-header">
                    <div class="align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Sales by State</h4>
                    </div>
                </div>
                <div class="card-body pt-1">
                    <div class="table-responsive">
                        <table id="sellStatesTable"
                            class="sell-states table table-centered align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>State</th>
                                    <th>Sales Cash</th>
                                    <th>Sales Check</th>
                                    <th>Sales Pending</th>
                                    <th>Total Sales</th>
                                    <th>Percentage of variation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($currentPeriodSales as $state)
                                    <tr>
                                        <td>
                                            {{ $state['state_name'] }}
                                        </td>
                                        <td>
                                            {{ number_format($state['total_paid'], 2) }}
                                        </td>
                                        <td>
                                            {{ number_format($state['total_check'], 2) }}
                                        </td>
                                        <td>
                                            {{ number_format($state['total_pending'], 2) }}
                                        </td>
                                        <td>
                                            {{ number_format($state['total_sales'], 2) }}
                                        </td>
                                        <td>
                                            @if ($state['percentage_variation'] > 0)
                                                <sup class="text-success fw-medium font-size-14">
                                                    <i class="bx bx-trending-up text-success"></i>
                                                    {{ $state['percentage_variation'] ? number_format($state['percentage_variation'], 2) . '%' : 'N/A' }}
                                                </sup>
                                            @else
                                                <sup class="text-danger fw-medium font-size-14">
                                                    <i
                                                        class="bx bx-trending-down  text-danger"></i>{{ $state['percentage_variation'] ? number_format($state['percentage_variation'], 2) . '%' : 'N/A' }}
                                                </sup>
                                            @endif

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Top Sales By Seller</h4>
                            </div>
                        </div>

                        <div class="card-body px-0 pt-2">
                            <div class="table-responsive px-3" data-simplebar style="max-height: 393px;">
                                <table id="salesTable"
                                    class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Seller</th>

                                            <th>Sales Cash</th>
                                            <th>Sales Check</th>
                                            <th>Sales Pending</th>
                                            <th>Total Sales</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendedorVentas as $venta)
                                            <tr>
                                                <td>
                                                    <h6 class="font-size-15 mb-1">{{ $venta->user_name }}</h6>
                                                </td>

                                                <td class="text-muted">
                                                    ${{ number_format($venta->total_paid, 2) }}
                                                </td>
                                                <td class="text-muted">
                                                    ${{ number_format($venta->total_check, 2) }}
                                                </td>
                                                <td class="text-muted">
                                                    ${{ number_format($venta->total_pending, 2) }}
                                                </td>
                                                <td class="text-muted">
                                                    ${{ number_format($venta->total_sales, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top Selling Products</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="topSellingProductsTable"
                            class="table table-borderless table-centered align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Total Quantity Sold</th>
                                    <th>Total Sales ($)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topSellingProducts as $product)
                                    <tr>
                                        <td class="font-size-15 mb-1">{{ $product->product_name }}</td>
                                        <td>{{ $product->total_quantity_sold }}</td>
                                        <td>{{ number_format($product->total_sales, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Top Customers By Seller</h4>
                            </div>
                        </div>

                        <div class="card-body px-0 pt-2">
                            <div class="table-responsive px-3" data-simplebar style="max-height: 393px;">
                                <table id="salesCustomerTable"
                                    class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Sales Cash</th>
                                            <th>Sales Check</th>
                                            <th>Sales Pending</th>
                                            <th>Total Sales</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topCustomersOrders as $venta)
                                            <tr>
                                                <td>
                                                    <h6 class="font-size-15 mb-1">{{ $venta->customer_name }}</h6>
                                                </td>

                                                <td class="text-muted">
                                                    ${{ number_format($venta->total_paid, 2) }}
                                                </td>
                                                <td class="text-muted">
                                                    ${{ number_format($venta->total_check, 2) }}
                                                </td>
                                                <td class="text-muted">
                                                    ${{ number_format($venta->total_pending, 2) }}
                                                </td>
                                                <td class="text-muted">
                                                    ${{ number_format($venta->total_sales, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/chartjs.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        /*
         *
         * totalSalesSevenDay
         */
        var totalSalesByDayData = @json($totalSalesLastSevenDays);


        // Asegurarse de que todos los días aparezcan, incluso con 0 ventas
        var formattedData = totalSalesByDayData.map(function(day) {
            return {
                x: day.day, // Usamos el día como X (fecha)
                y: day.total_sales // Si no hay ventas para ese día, usamos 0
            };
        });


        var options = {
            series: [{
                data: formattedData // Pasamos las ventas
            }],
            chart: {
                type: 'line',
                height: 350, // Aumentamos el tamaño para que se vean los ejes
                toolbar: {
                    show: false
                }
            },
            xaxis: {
                type: 'datetime', // El eje X será de tipo fecha
                labels: {
                    format: 'dd/MM/yyyy', // Formato de las etiquetas del eje X
                    style: {
                        colors: "#333", // Color de las etiquetas del eje X
                        fontSize: '12px'
                    }
                },
                title: {
                    text: 'Date',
                    style: {
                        color: '#333'
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toFixed(2); // Formato de las etiquetas del eje Y (número con dos decimales)
                    },
                    style: {
                        colors: "#333", // Color de las etiquetas del eje Y
                        fontSize: '12px'
                    }
                },
                title: {
                    text: 'Sales',
                    style: {
                        color: '#333'
                    }
                }
            },
            colors: ["#33a186"],
            stroke: {
                curve: 'smooth',
                width: 2.5,
            },
            tooltip: {
                fixed: {
                    enabled: true
                },
                x: {
                    show: true,
                    formatter: function(value) {
                        let date = new Date(value);
                        let day = date.getUTCDate();
                        let month = date.getUTCMonth() + 1; // Los meses en JS empiezan desde 0
                        let year = date.getUTCFullYear();
                        return `${day}/${month}/${year}`; // Formato DD/MM/YYYY
                    }
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Total Sales: ';
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#totalSalesSevenDay"), options);
        chart.render();


        /*
         *
         *countTotalSalesSevenDay
         */


        var countTotalSalesByDayData = @json($countListTotalOrdersLastSevenDays);

        // Asegurarse de que todos los días aparezcan, incluso con 0 ventas
        var formattedData = countTotalSalesByDayData.map(function(day) {
            return {
                x: day.day, // Usamos el día como X (fecha)
                y: day.total_orders // Si no hay ventas para ese día, usamos 0
            };
        });

        // Configuración del gráfico
        var options = {
            series: [{
                data: formattedData // Pasamos los datos con los días y ventas
            }],
            chart: {
                type: 'line',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            xaxis: {
                type: 'datetime',
                labels: {
                    format: 'dd/MM/yyyy',
                    style: {
                        colors: "#333",
                        fontSize: '12px'
                    }
                },
                title: {
                    text: 'Date',
                    style: {
                        color: '#333'
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value;
                    },
                    style: {
                        colors: "#333",
                        fontSize: '12px'
                    }
                },
                title: {
                    text: 'Orders',
                    style: {
                        color: '#333'
                    }
                }
            },
            colors: ["#33a186"],
            stroke: {
                curve: 'smooth',
                width: 2.5,
            },
            tooltip: {
                fixed: {
                    enabled: true
                },
                x: {
                    show: true,
                    formatter: function(value) {
                        let date = new Date(value);
                        let day = date.getUTCDate();
                        let month = date.getUTCMonth() + 1; // Los meses en JS empiezan desde 0
                        let year = date.getUTCFullYear();
                        return `${day}/${month}/${year}`; // Formato DD/MM/YYYY
                    }
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Acount Orders: ';
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#countTotalSalesSevenDay"), options);
        chart.render();


        /*
         *
         *Count Ordes by paymentStatus
         */
        var paymentStatusOrders = @json($paymentStatusOrders);
        var colors = ["#3980c0", "#51af98", "#4bafe1"]; // Rojo para Pending, Amarillo para Check, Verde para Paid

        var options = {
            series: [{
                data: paymentStatusOrders.map(item => item.total_orders) // Cantidad de órdenes
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            colors: colors, // Asignar colores personalizados
            xaxis: {
                categories: paymentStatusOrders.map(item => {
                    switch (item.payment_status) {
                        case 'P':
                            return 'Pending';
                        case 'C':
                            return 'Check';
                        case 'D':
                            return 'Cash';
                    }
                })
            },
            yaxis: {
                title: {
                    text: 'Total Orders'
                }
            },
            tooltip: {
                y: {
                    title: {
                        formatter: function() {
                            return 'Orders: '; // Texto personalizado para el tooltip
                        }
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#order-by-payment-status"), options);
        chart.render();

        function getChartColorsArray(chartId, numberOfColors) {
            // Definir una paleta de colores
            var palette = ['#3980c0', '#51af98', '#4bafe1', '#B4B4B5', '#f1f3f4', '#9b59b6', '#1abc9c', '#2ecc71'];

            // Generar colores aleatorios basados en el número de datos que tenga el gráfico
            var randomColors = [];

            for (var i = 0; i < numberOfColors; i++) {
                // Seleccionar un color aleatorio de la paleta
                var randomColor = palette[Math.floor(Math.random() * palette.length)];
                randomColors.push(randomColor);
            }

            return randomColors;
        }
        /*
         *
         *salesByCategoryData
         */
        var salesByCategoryData = @json($salesByCategory);

        var categories = salesByCategoryData.map(function(item) {
            return item.category_name; // Nombre de la categoría
        });

        var percentages = salesByCategoryData.map(function(item) {
            return item.percentage_sales; // Porcentaje de ventas de la categoría
        });

        // Colores de la gráfica
        var salescategorycolors = @json($salesColors);
        // Configuración del gráfico doughnut
        var config = {
            type: 'doughnut',
            data: {
                labels: categories, // Usamos las etiquetas dinámicas extraídas de salesByCategoryData
                datasets: [{
                    data: percentages, // Usamos los porcentajes dinámicos extraídos de salesByCategoryData
                    backgroundColor: salescategorycolors,
                    hoverBackgroundColor: salescategorycolors,
                    borderWidth: 0,
                    borderColor: salescategorycolors,
                    hoverBorderWidth: 0,
                }]
            },
            options: {
                responsive: false,
                legend: {
                    display: false // No mostrar leyenda
                },
                tooltips: {
                    enabled: true, // Habilitar tooltips
                },
                cutoutPercentage: 75,
                rotation: -0.5 * Math.PI,
                circumference: 2 * Math.PI,
                title: {
                    display: false
                },
            }
        };

        // Inicializamos el gráfico doughnut
        var ctx = document.getElementById('sales-by-category');
        window.myDoughnut = new Chart(ctx, config);

        /*
         *
         *Sales Ordes by paymentStatus
         */
        var salesPaymentStatusOrders = @json($totalSalesByPaymentStatus);
        var colors = ["#3980c0", "#51af98", "#4bafe1"]; // Rojo para Pending, Amarillo para Check, Verde para Paid

        var options = {
            series: [{
                data: salesPaymentStatusOrders.map(item => item.total_sales) // Cantidad de órdenes
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            colors: colors, // Asignar colores personalizados
            xaxis: {
                categories: salesPaymentStatusOrders.map(item => {
                    switch (item.payment_status) {
                        case 'P':
                            return 'Pending';
                        case 'C':
                            return 'Check';
                        case 'D':
                            return 'Cash';
                        case 'P to D':
                            return 'P to Cash';
                        case 'P to C':
                            return 'P to Check';
                    }
                })
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return `$` + value.toFixed(2); // Agregar el símbolo de dólar y formatear con dos decimales
                    }
                },
                title: {
                    text: 'Total Orders'
                }
            },
            tooltip: {
                y: {
                    title: {
                        formatter: function() {
                            return 'Orders: '; // Texto personalizado para el tooltip
                        }
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#sales-by-payment-status"), options);
        chart.render();


        /*
         *
         * Top Sales by Seller
         */
        $(document).ready(function() {
            $('#salesTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "pageLength": 5, // Número de filas por página
                "order": [
                    [3, 'desc']
                ] // Ordenar por la primera columna (índice 0) en orden ascendente
            });
        });

        /*
         *
         * Top Sales by Product
         */
        $(document).ready(function() {
            $('#topSellingProductsTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "pageLength": 5, // Número de filas por página
                "order": [
                    [1, 'desc']
                ] // Ordenar por la columna de cantidad vendida en orden descendente
            });
        });

        /*
         *
         * Top Sales by Customer
         */
        $(document).ready(function() {
            $('#salesCustomerTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "pageLength": 5, // Número de filas por página
                "order": [
                    [3, 'desc']
                ] // Ordenar por la primera columna (índice 0) en orden ascendente
            });
        });

        $(document).ready(function() {
            $('#sellStatesTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "pageLength": 5, // Número de filas por página
                "order": [
                    [3, 'desc']
                ] // Ordenar por la primera columna (índice 0) en orden ascendente
            });
        });
    </script>
@endsection
