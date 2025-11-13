@extends('ecommerce.layouts.master')
@section('title')
    Categories
@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/nouislider/nouislider.min.css') }}">
    <style>
        .product-img img {
            max-height: 150px;
            min-height: 150px;
            /* Ajusta el tamaño máximo de la imagen */
            object-fit: cover;
            /* Hace que la imagen se recorte si es necesario para llenar el contenedor */
        }
    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Ecommerce
        @endslot
        @slot('title')
            Categories
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="popularity" role="tabpanel">
                                <div class="row">

                                    @foreach ($categories as $category)
                                        <div class="col-6 col-sm-6 col-md-3"> <!-- 4 columnas en md y 2 en sm -->
                                            @if ($category->id == 0)
                                                <a
                                                    href="{{ route('ecommerce.products.list') }}">
                                                    <div class="product-box">
                                                        <div class="product-img pt-4 px-4">
                                                            <img src="{{ asset($category->image) }}" alt=""
                                                                class="img-fluid mx-auto d-block">
                                                        </div>

                                                        <div class="product-content p-4">
                                                            <div class="d-flex justify-content-between align-items-start">
                                                                <div>
                                                                    <h5 class="mb-1">
                                                                        <div href="ecommerce-product-detail"
                                                                            class="text-dark font-size-16">
                                                                            {{ $category->name }}
                                                                        </div>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @else
                                                <a
                                                    href="{{ route('ecommerce.products.list', ['category_id' => $category->id]) }}">
                                                    <div class="product-box">
                                                        <div class="product-img pt-4 px-4">
                                                            <img src="{{ asset($category->image) }}" alt=""
                                                                class="img-fluid mx-auto d-block">
                                                        </div>

                                                        <div class="product-content p-4">
                                                            <div class="d-flex justify-content-between align-items-start">
                                                                <div>
                                                                    <h5 class="mb-1">
                                                                        <div href="ecommerce-product-detail"
                                                                            class="text-dark font-size-16">
                                                                            {{ $category->name }}
                                                                        </div>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div> <!-- End row -->
                            </div> <!-- End tab-pane -->
                        </div> <!-- End tab-content -->
                    </div>
                </div> <!-- End card-body -->
            </div> <!-- End card -->
        </div> <!-- End col-12 -->
    </div> <!-- End row -->

    <!-- Mostrar el modal si no hay estado seleccionado -->
@endsection

@section('script')
    @if (isset($showModal) && $showModal)
        <script>
            $(document).ready(function() {
                $('#stateModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('#stateModal').modal('show');

            });
        </script>
    @endif
    <script>
        $('#stateModal').on('show.bs.modal', function() {
            // Aplicar desenfoque al cuerpo cuando se muestra el modal
            $('.page-content').addClass('blur-background');
        });

        $('#stateModal').on('hidden.bs.modal', function() {
            // Quitar desenfoque cuando se oculta el modal
            $('.page-content').removeClass('blur-background');
        });
    </script>
@endsection
