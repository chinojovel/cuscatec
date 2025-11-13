@extends('ecommerce.layouts.master')

@section('title', 'Edit Order')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container">
        <h1>Edit Order #{{ $order->id }}</h1>

        <form action="{{ route('ecommerce.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h3>Order Details</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Final Price</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody id="order-details-body">
                    @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td>
                                <input type="number" name="order_details[{{ $loop->index }}][quantity]"
                                    value="{{ $detail->quantity }}" class="form-control" required min="1">
                            </td>
                            <td>
                                <input type="number" name="order_details[{{ $loop->index }}][final_price]"
                                    value="{{ $detail->final_price }}" class="form-control" required step="0.01"
                                    min="0.01">
                            </td>
                            <td>{{ number_format($detail->final_price * $detail->quantity, 2) }}</td>
                            <td>
                                <input type="checkbox" name="order_details[{{ $loop->index }}][remove]" value="1">
                            </td>
                            <input type="hidden" name="order_details[{{ $loop->index }}][product_id]"
                                value="{{ $detail->product_id }}">
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <button type="button" class="btn btn-success" id="add-product">Add Product</button>
                        </td>
                    </tr>
                </tfoot>
            </table>

            <div class="form-group mb-3">
                <label for="customer">Customer</label>
                <select id="customer" class="js-example-basic-single form-control" name="customer" style="width: 100%;"
                    required>
                    <option value="" disabled>Select a customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" @if ($customer->id == $order->customer_id) selected @endif>
                            Name: {{ $customer->name }} - State: {{ $customer->state->name }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Please select a valid customer.</div> <!-- Mensaje de error -->
            </div>

            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price (Before Discount):</label>
                <p id="total_price" class="form-control-static">${{ number_format($order->total_price, 2) }}</p>
            </div>

            <div class="mb-3">
                <label for="discount_amount" class="form-label">Discount Amount:</label>
                <input type="number" id="discount_amount" name="discount_amount" value="{{ $order->discount_amount }}"
                    class="form-control" step="0.01" min="0">
            </div>

            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

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

            let index = {{ count($order->orderDetails) }};
            const orderDetailsBody = $("#order-details-body");
            console.log('index', index);
            $("#add-product").on("click", function() {
                const newRow = `
            <tr>
                <td>
                    <select name="new_products[${index}][product_id]" class="form-control select-product" required>
                        <option value="" disabled selected>Select a product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->prices[0]->price }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="new_products[${index}][quantity]" value="1" class="form-control quantity" required min="1">
                </td>
                <td>
                    <input type="number" name="new_products[${index}][final_price]" value="0" class="form-control price" required step="0.01" min="0.01">
                </td>
                <td class="total-price">0.00</td>
                <td>
                    <button type="button" class="btn btn-danger remove-product">Remove</button>
                </td>
            </tr>
        `;

                orderDetailsBody.append(newRow);
                index++;
            });

            $(document).on("change", ".select-product", function() {
                const selectedOption = $(this).find("option:selected");
                const price = parseFloat(selectedOption.data("price")); // Convertir data-price a número
                const row = $(this).closest("tr");
                const priceField = row.find(".price");

                console.log('selectedOption', selectedOption, 'price',
                    price); // Confirmar el valor de price

                if (!isNaN(price)) { // Verificar que price es un número válido
                    priceField.val(price.toFixed(2)); // Asignar el precio al campo de precio
                } else {
                    priceField.val(""); // Limpiar el campo si no hay precio válido
                }

                updateTotal(row); // Actualizar el total de la fila
            });

            function updateTotal(row) {
                const quantity = parseFloat(row.find(".quantity").val()) || 0;
                const price = parseFloat(row.find(".price").val()) || 0;
                const total = quantity * price;
                row.find(".total-price").text(total.toFixed(2)); // Mostrar el total calculado
            }


            $(document).on("click", ".remove-product", function() {
                $(this).closest("tr").remove();
            });

        });
    </script>
@endsection