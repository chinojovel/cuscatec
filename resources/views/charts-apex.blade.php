@extends('layouts.master')
@section('title') @lang('translation.Apex_Charts') @endsection

    @section('content')
        @component('components.breadcrumb')
        @slot('li_1') Charts @endslot
        @slot('title') Apex Charts @endslot
        @endcomponent

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Line with Data Labels</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="line_chart_datalabel" data-colors='["#3980c0", "#fa6374"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Dashed Line</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="line_chart_dashed" data-colors='["#3980c0", "#fa6374","#33a186"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Basic Area Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="area_chart_basic" data-colors='["#3980c0", "#33a186"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Spline Area Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="area_chart_spline" data-colors='["#fa6374", "#3980c0","#33a186"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Basic Column Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="column_chart" data-colors='["#fa6374", "#3980c0","#33a186"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Column with Data Labels</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="column_chart_datalabel" data-colors='["#3980c0"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Basic Bar Chart</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div id="bar_chart" data-colors='["#33a186"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Custom DataLabels Bar</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="custom_datalabels_bar" data-colors='["#5fd0f3", "#495057", "#e83e8c", "#13d8aa", "#f34e4e", "#2b908f", "#f9a3a4", "#564ab1",
                                "#fa6374", "#3980c0"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Line & Column Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="line_column_chart" data-colors='["#3980c0","#33a186"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Multiple Y-Axis Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="multi_chart" data-colors='["#3980c0","#76d6f4","#33a186"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Basic TimeLine Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="basic_timeline" data-colors='["#3980c0"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Different Color For Each Bar</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="color_timeline" data-colors='["#3980c0","#f34e4e","#33a186","#fc931d","#5fd0f3"]' dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Simple Bubble Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="simple_bubble" data-colors='["#3980c0","#5fd0f3","#fc931d","#33a186"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">3D Bubble Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="bubble_chart" data-colors='["#564ab1","#5fd0f3","#33a186","#fc931d"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Simple Pie Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="simple_pie_chart" data-colors='["#3980c0","#33a186","#fc931d","#f34e4e","#564ab1"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Simple Donut Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="simple_dount_chart" data-colors='["#3980c0", "#33a186", "#fc931d", "#f34e4e", "#564ab1"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Basic Radialbar Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="basic_radialbar" data-colors='["#3980c0"]'  class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Multiple Radialbar</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="multiple_radialbar" data-colors='["#3980c0", "#33a186", "#fc931d", "#f34e4e"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Basic Radar Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="basic_radar" data-colors='["#3980c0"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Radar Chart - Multiple series</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="multi_radar" data-colors='["#3980c0","#5FD0F5","#4fad96"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Basic-Polar Area Chart</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="basic_polar_area" data-colors='["#3980c0", "#33a186", "#fc931d", "#f34e4e", "#564ab1", "#5fd0f3"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Polar-Area Monochrome</h4>
                                </div><!-- end card header -->
                            <div class="card-body">
                                <div id="monochrome_polar_area" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!-- end col -->
                </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
    <script src="{{ URL::asset('assets/libs/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/apexcharts.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
