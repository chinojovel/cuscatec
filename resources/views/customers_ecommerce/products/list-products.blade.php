@extends('customers_ecommerce.layouts.master')
@section('title')
    @lang('translation.Products')
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <style>
        .slick-prev,
        .slick-arrow {
            display: none !important;
        }

        .quantity-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            /* Alinear los botones a la derecha */
            margin-top: 10px;
        }

        .quantity-btn {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e6706d;
            color: white;
            border-radius: 50%;
            font-size: 20px;
            transition: background-color 0.3s;
            margin: 1px;
            border: none;
        }

        .quantity-btn:hover {
            background-color: #c05b55;
            /* Color más oscuro al hacer hover */
        }

        .quantity-display {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e6706d;
            color: white;
            border-radius: 50%;
            font-size: 16px;
            margin: 1px;

        }

        .product-img img {
            width: 100%;
            height: 200px;
            /* Altura fija para dispositivos móviles */
            object-fit: cover;
            /* Asegura que la imagen se mantenga dentro del tamaño establecido */
            border-radius: 8px;
            /* Bordes redondeados para la imagen */
        }

        /* Media query para pantallas más grandes (computadoras y tablets) */
        @media (min-width: 768px) {
            .product-img img {
                height: 300px;
                /* Aumenta la altura en pantallas más grandes */
            }
        }

        /* Media query para pantallas aún más grandes (grandes pantallas de computadoras) */
        @media (min-width: 1200px) {
            .product-img img {
                height: 400px;
                /* Altura más grande en pantallas extra grandes */
            }
        }

        .product-box {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            /* Para que todas las cajas tengan la misma altura */
        }

        /* Ajuste del contenido del producto */
        .product-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }
    </style>
@endsection


@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Ecommerce
        @endslot
        @slot('title')
            Products
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body px-2">
                    <div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-inline float-md-end">
                                    <div class="search-box ms-2">
                                        <div class="position-relative d-flex">
                                            <input type="text" id="searchInput"
                                                class="form-control bg-light border-light rounded" placeholder="Search...">
                                            <button class="btn btn-primary ms-2" id="searchButton">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="category-slider" style="margin-top: 5px;">
                            @foreach ($categories as $category)
                            @if($category->id == 0)
                            <div style="margin-right: 3px!important;">
                                <a href="{{ route('customer.ecommerce.products.list') }}"
                                    class="category-btn btn btn-secondary mr-2">
                                    {{ $category->name }}
                                </a>
                            </div>
                            @else
                                <div style="margin-right: 3px!important;">
                                    <a href="{{ route('customer.ecommerce.products.list', ['category_id' => $category->id]) }}"
                                        class="category-btn btn btn-secondary mr-2">
                                        {{ $category->name }}
                                    </a>
                                </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="p-1 text-muted">
                            <div id="popularity" role="tabpanel">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-6 col-sm-6 col-xl-4 mt-2">
                                            <div class="product-box">
                                                <div class="product-img pt-2 px-2">
                                                    @if ($product->image_url)
                                                        <img src="{{ asset($product->image_url) }}" alt=""
                                                            class="img-fluid mx-auto d-block">
                                                    @else
                                                        No Image
                                                    @endif
                                                </div>

                                                <div class="product-content p-4">
                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1">
                                                                <div href="ecommerce-product-detail"
                                                                    class="text-dark font-size-16">{{ $product->name }}</div>
                                                            </h5>
                                                            <h5 class="mt-3 mb-0">
                                                                <span
                                                                    class="me-2">$</span>{{ $product->prices[0]->price }}
                                                            </h5>
                                                        </div>
                                                    </div>

                                                    <!-- Botones para aumentar/disminuir cantidad -->
                                                    <div class="quantity-container">
                                                        <button class="quantity-btn"
                                                            onclick="updateQuantity('{{ $product->id }}', {{ $product->prices[0]->price }}, '{{ $product->image_url }}', -1,'{{ $product->name }}')">-</button>
                                                        <div class="quantity-display" id="quantity-{{ $product->id }}">0
                                                        </div>
                                                        <button class="quantity-btn"
                                                            onclick="updateQuantity('{{ $product->id }}', {{ $product->prices[0]->price }}, '{{ $product->image_url }}', 1,'{{ $product->name }}')">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.category-slider').slick({
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    variableWidth: true,
                    dots: false
                });

                // Inicializar cantidades desde LocalStorage
                initializeCartQuantities();
                updateCartTotal();


                $('#searchButton').click(function() {
                    // Obtener el valor del campo de búsqueda
                    const searchValue = $('#searchInput').val();

                    // Obtener el parámetro `category_id` de la URL actual, si existe
                    const urlParams = new URLSearchParams(window.location.search);
                    const categoryId = urlParams.get('category_id');

                    // Construir la URL con los parámetros `name` y `category_id` (si existe)
                    let newUrl =
                        `{{ route('customer.ecommerce.products.list') }}?name=${encodeURIComponent(searchValue)}`;
                    if (categoryId) {
                        newUrl += `&category_id=${categoryId}`;
                    }

                    // Redirigir a la nueva URL
                    window.location.href = newUrl;
                });


            });

            // Función para actualizar la cantidad de un producto en el carrito
            function updateQuantity(productId, unitPrice, image, change, name) {
                // Obtener el carrito actual desde LocalStorage
                let cart = JSON.parse(localStorage.getItem('cart')) || {};
                let currentQuantity = cart[productId]?.quantity || 0;

                // Actualizar la cantidad
                let newQuantity = currentQuantity + change;

                // No permitir cantidades negativas
                if (newQuantity < 0) {
                    newQuantity = 0;
                }

                // Calcular el total por producto (cantidad * precio unitario)
                let totalPrice = newQuantity * unitPrice;

                // Guardar o actualizar los detalles del producto en el carrito
                cart[productId] = {
                    quantity: newQuantity,
                    unitPrice: unitPrice,
                    totalPrice: totalPrice,
                    image: image,
                    product_id: productId,
                    name: name
                };

                // Guardar el carrito actualizado en LocalStorage
                localStorage.setItem('cart', JSON.stringify(cart));

                // Actualizar la cantidad y el total en la vista
                document.getElementById('quantity-' + productId).textContent = newQuantity;

                // Opción adicional: actualizar el total general si lo necesitas en la misma página
                updateCartTotal();
            }


            // Inicializar las cantidades de los productos desde el carrito
            function initializeCartQuantities() {
                let cart = JSON.parse(localStorage.getItem('cart')) || {};
                let productId = null;
                let quantity = 0;
                // Inicializar la cantidad y el total de cada producto en la vista
                @foreach ($products as $product)
                    productId = '{{ $product->id }}';
                    quantity = cart[productId]?.quantity || 0;
                    document.getElementById('quantity-' + productId).textContent = quantity;
                @endforeach

                // Inicializar el total general del carrito
                updateCartTotal();
            }

            // Función para actualizar el total general del carrito
            function updateCartTotal() {
                let cart = JSON.parse(localStorage.getItem('cart')) || {};
                let total = 0;
                let itemCount = 0;


                // Sumar el total de todos los productos en el carrito
                for (let productId in cart) {
                    total += cart[productId].totalPrice;
                    itemCount += cart[productId].quantity; // Sumar todas las cantidades
                }

                // Mostrar el total general en la vista (ajusta esto a tu diseño)
                //document.getElementById('cart-total').textContent = total.toFixed(2); // Formateado a 2 decimales
                document.getElementById('cart-count').textContent = itemCount;

            }
        </script>
    @endsection
