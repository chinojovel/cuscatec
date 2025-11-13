    <script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/metismenujs/metismenujs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/feather-icons/feather-icons.min.js') }}"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            updateCartCount();
            $('#stateForm').submit(function(event) {
                // Prevenir el envío del formulario
                event.preventDefault();
                console.log('pase');
                // Limpiar el LocalStorage
                localStorage.clear();

                // Enviar el formulario manualmente después de limpiar el LocalStorage
                this.submit();
            });
        });




        function updateCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart')) || {};
            let totalCount = Object.values(cart).reduce((acc, item) => acc + item.quantity, 0);
            document.getElementById('cart-count').textContent = totalCount;
        }

        document.getElementById('button-cart-redirect').addEventListener('click', function() {
            window.location.href = '/ecommerce/cart';
        });
    </script>
    @yield('script')
