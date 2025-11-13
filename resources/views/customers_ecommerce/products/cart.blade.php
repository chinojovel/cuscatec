@extends('customers_ecommerce.layouts.master')
@section('title')
    Cart
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <style>
        .avatar-lg {
            width: 100%;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
@endsection

@section('content')
    <form id="orderForm" action="{{ route('customer.ecommerce.complete.purchase') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xl-8">
                <h2 class="mt-2">Cart</h2>
                <div id="cartContainer" class="container mt-2">
                    <!-- Los productos del carrito se cargarán aquí -->
                </div>
            </div>

            <div class="col-xl-4">
                <div class="mt-5 mt-lg-0">
                    <div class="card border shadow-none">
                        <div class="card-header bg-transparent border-bottom py-3 px-4">
                            <h5 class="font-size-16 mb-0">Order Summary</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table mb-0" id="summary-table">
                                    <tbody>
                                        <tr>
                                            <td>Sub Total :</td>
                                            <td class="text-end" id="subtotal"></td>
                                        </tr>
                                        <tr>
                                            <td>Discount :</td>
                                            <td class="text-end" id="discount">$0</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Charge :</td>
                                            <td class="text-end" id="shipping">$0.00</td>
                                        </tr>
                                        <tr class="bg-light">
                                            <th>Total :</th>
                                            <td class="text-end">
                                                <span class="fw-bold" id="total"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    <input type="text" id="couponCode" class="form-control"
                                        placeholder="Enter coupon code">
                                    <button type="button" class="btn btn-primary mt-2" onclick="applyCoupon()">Apply
                                        Coupon</button>
                                    <div id="couponMessage" class="mt-2 text-success"></div>
                                    <div id="couponMessageError" class="mt-2 text-danger"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col-sm-6">
                        <a href="{{ route('customer.ecommerce.products.list') }}" class="btn btn-link text-muted">
                            <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-2 mt-sm-0">
                            <button type="submit" class="btn btn-success">
                                <i class="mdi mdi-cart-outline me-1"></i> Complete Purchase
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            const cart = JSON.parse(localStorage.getItem('cart')) || {};

            // Si el carrito está vacío, redirige a la ruta deseada
            if (Object.keys(cart).length === 0) {
                window.location.href = "{{ route('customer.ecommerce.products.list') }}";
            }

            $('.js-example-basic-single').select2({
                placeholder: "Select an option", // Texto de marcador de posición
                width: '100%' // Define el ancho al 100%
            });

            $("#customer").on("change", function() {
                const customerSelect = $(this);

                if (customerSelect.val()) {
                    customerSelect.removeClass("is-invalid");
                }
            });

            const form = $("#orderForm");

            form.on("submit", function(event) {
                // Prevenir el envío normal del formulario para agregar los datos de localStorage
                event.preventDefault();
                // Obtener datos de localStorage
                const cartData = localStorage.getItem("cart") || "{}";
                const discountAmount = localStorage.getItem("discountAmount") || 0;
                const couponCode = localStorage.getItem("couponCode") || "";

                // Agregar campos ocultos para datos del carrito y los selects
                form.append(`<input type="hidden" name="cart" value='${cartData}'>`);
                form.append(`<input type="hidden" name="discountAmount" value="${discountAmount}">`);
                form.append(`<input type="hidden" name="couponCode" value="${couponCode}">`);

                // Enviar el formulario después de agregar los campos ocultos
                form.off("submit").submit();
            });
        });
        let discountAmount = 0;
        let subtotal = 0;
        let cartData = JSON.parse(localStorage.getItem('cart') || '{}');
        const cartContainer = document.getElementById("cartContainer");

        function updateTotals() {
            const discountedTotal = subtotal - discountAmount;
            document.getElementById("subtotal").textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById("discount").textContent = `$${discountAmount.toFixed(2)}`;
            document.getElementById("total").textContent = `$${discountedTotal.toFixed(2)}`;
        }

        document.addEventListener("DOMContentLoaded", function() {
            discountAmount = parseFloat(localStorage.getItem("discountAmount")) || 0;
            const savedCouponCode = localStorage.getItem("couponCode") || "";


            function renderCart() {
                cartContainer.innerHTML = '';
                subtotal = 0;

                Object.entries(cartData).forEach(([productId, product]) => {
                    if (product.image != null) {
                        subtotal += parseFloat(product.totalPrice);

                        const productCard = `
                                        <div class="card border shadow-none mb-4">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start border-bottom pb-3">
                                                    <div class="me-4">
                                                        <img src="{{ url('${product.image}') }}" alt="" class="avatar-lg">
                                                    </div>
                                                    <div class="flex-grow-1 align-self-center overflow-hidden">
                                                        <h5 class="text-truncate font-size-16">Product ID: ${productId}</h5> <span>${product.name}</span>
                                                        <p class="mb-1">Quantity: 
                                                            <input class="form-control" type="number" min="1" value="${product.quantity}" 
                                                                onchange="updateProduct('${productId}', 'quantity', this.value)">
                                                        </p>
                                                        <p>Unit Price: $ 
                                                            <input disabled style="background-color: #c9d1d9!important;" class="form-control" type="number" min="0" step="0.01" value="${product.unitPrice}" 
                                                                onchange="updateProduct('${productId}', 'unitPrice', this.value)">
                                                        </p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <button class="btn btn-link text-danger" onclick="removeFromCart(${productId})">Remove</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-4 col-md-4">
                                                            <div class="mt-3">
                                                                <p class="text-muted mb-2">Price</p>
                                                                <h5 class="font-size-16">$${product.unitPrice}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 col-md-4">
                                                            <div class="mt-3">
                                                                <p class="text-muted mb-2">Quantity</p>
                                                                <h5 class="font-size-16">${product.quantity}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 col-md-4">
                                                            <div class="mt-3">
                                                                <p class="text-muted mb-2">Total</p>
                                                                <h5 class="font-size-16">$${product.totalPrice}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;

                        cartContainer.insertAdjacentHTML("beforeend", productCard);
                    }

                });
                // Verificar si el carrito está vacío
                if (Object.keys(cartData).length === 0) {
                    document.querySelector('button[type="submit"]').disabled = true;
                } else {
                    document.querySelector('button[type="submit"]').disabled = false;
                }
                updateTotals();

            }

            window.updateProduct = (productId, field, value) => {
                if (field === 'quantity' || field === 'unitPrice') {
                    value = parseFloat(value);
                }
                cartData[productId][field] = value;

                // Recalcular el total del producto
                const product = cartData[productId];
                product.totalPrice = (product.quantity * product.unitPrice).toFixed(2);

                // Guardar cambios en el LocalStorage
                localStorage.setItem('cart', JSON.stringify(cartData));
                renderCart();
            };

            window.removeFromCart = (productId) => {
                delete cartData[productId];
                localStorage.setItem('cart', JSON.stringify(cartData));
                renderCart();
            };

            renderCart();
        });



        window.applyCoupon = function() {
            const couponCode = document.getElementById("couponCode").value;
            fetch("{{ route('customer.ecommerce.validate-coupon') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        code: couponCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const coupon = data.coupon;
                        if (coupon.type === 'a') {
                            discountAmount = parseFloat(coupon.discount_amount);
                        } else if (coupon.type === 'p') {
                            discountAmount = (subtotal * coupon.discount_percentage / 100);
                        }

                        // Guardar el descuento y el cupón en LocalStorage
                        localStorage.setItem("discountAmount", discountAmount);
                        localStorage.setItem("couponCode", couponCode);

                        document.getElementById("couponMessage").textContent = data.message;
                        updateTotals();
                    } else {
                        document.getElementById("couponMessageError").textContent = data.message;
                        discountAmount = 0;
                        localStorage.removeItem("discountAmount");
                        localStorage.removeItem("couponCode");
                        updateTotals();
                    }
                })
                .catch(error => console.error("Error:", error));
        };
    </script>
@endsection
