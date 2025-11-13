@extends('customers_ecommerce.layouts.master')
@section('title')
    Cart
@endsection

@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle" style="color: green; font-size: 48px;"></i>
                    <h4 class="mt-3">Order successfully registered!</h4>
                    <p>Your order has been recorded. You will receive a confirmation email shortly.</p>
                
                    <div class="d-flex text-center justify-content-center">
                        <a href="{{ route('customer.ecommerce.categories', $order->id) }}" class="btn m-1 btn-primary">
                            Regresar<i class="mdi mdi-arrow-left"></i>
                        </a>
                        <a href="{{ route('customer.ecommerce.orders.print', $order->id) }}" class="btn m-1 btn-primary">
                            Descargar factura <i class="fas fa-print"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // Limpia todo el contenido del localStorage

            localStorage.clear();


        });
    </script>
@endsection
