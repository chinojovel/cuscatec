@extends('layouts.master')
@section('title') @lang('translation.Customers') @endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection

    @section('content')
    @component('components.breadcrumb')
    @slot('li_1') Ecommerce @endslot
    @slot('title') Customers @endslot
    @endcomponent

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="position-relative">
                                <div class="modal-button mt-2">
                                    <button type="button" class="btn btn-success waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".new-customer"><i class="mdi mdi-plus me-1"></i> New Customer</button>
                                </div>
                            </div>

                            <div id="table-ecommerce-customers"></div>

                        </div>
                    </div>
                </div>
            </div>

            <div id="success-btn" class="modal fade" tabindex="-1" aria-labelledby="success-btnLabel" aria-hidden="true" data-bs-scroll="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-center">
                                <i class="bx bx-check-circle display-1 text-success"></i>
                                <h3 class="mt-3">New Customer Created Successfully</h3>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <div class="modal fade new-customer" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myExtraLargeModalLabel">New Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="NewCustomers-Username">Username</label>
                                        <input type="text" class="form-control" placeholder="Enter Username" id="NewCustomers-Username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="NewCustomers-Email">Email</label>
                                        <input type="text" class="form-control" placeholder="Enter Email" id="NewCustomers-Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="NewCustomers-Phone">Phone</label>
                                        <input type="text" class="form-control" placeholder="Enter Phone" id="NewCustomers-Phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="NewCustomers-Wallet">Wallet</label>
                                        <input type="text" class="form-control" placeholder="0" id="NewCustomers-Wallet">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Date</label>
                                        <input type="text" class="form-control" placeholder="Select Date" id="customers-date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="NewCustomers-Address">Address</label>
                                        <input type="text" class="form-control" placeholder="Enter Address" id="NewCustomers-Address">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i class="bx bx-x me-1"></i> Cancel</button>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-btn" id="btn-save-event"><i class="bx bx-check me-1"></i> Confirm</button>
                            </div>
                        </div>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/ecommerce-customers.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
