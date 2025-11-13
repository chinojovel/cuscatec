@extends('layouts.master')
@section('title') @lang('translation.Chartjs') @endsection

    @section('content')
        @component('components.breadcrumb')
        @slot('li_1') Charts @endslot
        @slot('title') Chartjs @endslot
        @endcomponent

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Line Chart</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="lineChart" class="chartjs-chart" data-colors='["rgba(57, 128, 192, 0.2)", "#3980c0", "rgba(235, 239, 242, 0.2)", "#ebeff2"]'></canvas>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Bar Chart</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="bar" class="chartjs-chart" data-colors='["rgba(51, 161, 134, 0.8)", "rgba(51, 161, 134, 0.9)"]'></canvas>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Pie Chart</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart" class="chartjs-chart" data-colors='["#33a186", "#ebeff2"]'></canvas>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Donut Chart</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="doughnut" class="chartjs-chart" data-colors='["#3980c0", "#ebeff2"]'></canvas>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Polar Chart</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="polarArea" class="chartjs-chart" data-colors='["#fa6374", "#33a186", "#fc931d", "#3980c0"]'> </canvas>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Radar Chart</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="radar" class="chartjs-chart" data-colors='["rgba(42, 181, 125, 0.2)", "#33a186", "rgba(57, 128, 192, 0.2)", "#3980c0"]'></canvas>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/chart.js/chart.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/chartjs.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
