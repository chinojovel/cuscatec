@extends('layouts.master')
@section('title') @lang('translation.Shops') @endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection

    @section('content')
    @component('components.breadcrumb')
    @slot('li_1') Ecommerce @endslot
    @slot('title') Shops @endslot
    @endcomponent

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="table-ecommerce-shops"></div>
                        </div>
                    </div>
                </div>
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/ecommerce-shops.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
