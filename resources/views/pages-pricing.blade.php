@extends('layouts.master')
@section('title') @lang('translation.Pricing') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1') Utility @endslot
    @slot('title') Pricing @endslot
    @endcomponent

            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="text-center mb-5">
                        <h4>Choose your Pricing plan</h4>
                        <p class="text-muted mb-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo veritatis</p>

                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card pricing-box text-center">
                                <div class="card-body p-4">
                                    <div>
                                        <div class="mt-3 mb-2">
                                            <h5 class="mb-1">Starter</h5>
                                            <p class="text-muted pb-2">Starter plans</p>
                                        </div>

                                        <div class="avatar-md mx-auto my-4">
                                            <div class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-22">
                                                <i class="bx bx-edit h2 text-primary mb-0"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="list-unstyled plan-features mt-2">
                                        <li>Users: <span class="text-primary fw-semibold">1</span></li>
                                        <li>Storage: <span class="text-primary fw-semibold">01 GB</span></li>
                                        <li>Domain: <span class="text-primary fw-semibold">No</span></li>
                                        <li>Support: <span class="text-primary fw-semibold">No</span></li>
                                        <li>Setup: <span class="text-primary fw-semibold">No</span></li>
                                    </ul>

                                    <div class="py-4">
                                        <h3><sup><small>$</small></sup> 19/ <span class="font-size-13 text-muted">Per month</span></h3>
                                    </div>
                                    <div class="text-center plan-btn my-2">
                                        <a href="#" class="btn btn-primary waves-effect waves-light">Sign up Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card pricing-box product-box text-center">
                                <div class="product-ribbon">
                                    Popular
                                </div>
                                <div class="card-body p-4">
                                    <div>
                                        <div class="mt-3">
                                            <h5 class="mb-1">Professional</h5>
                                            <p class="text-muted pb-2">Professional plans</p>
                                        </div>

                                        <div class="avatar-md mx-auto my-4">
                                            <div class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-22">
                                                <i class="bx bx-trophy h2 text-primary mb-0"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="list-unstyled plan-features mt-3">
                                        <li>Users: <span class="text-primary fw-semibold">3</span></li>
                                        <li>Storage: <span class="text-primary fw-semibold">10 GB</span></li>
                                        <li>Domain: <span class="text-primary fw-semibold">1</span></li>
                                        <li>Support: <span class="text-primary fw-semibold">Yes</span></li>
                                        <li>Setup: <span class="text-primary fw-semibold">No</span></li>
                                    </ul>

                                    <div class="py-4">
                                        <h3><sup><small>$</small></sup> 29/ <span class="font-size-13 text-muted">Per month</span></h3>
                                    </div>

                                    <div class="text-center plan-btn my-2">
                                        <a href="#" class="btn btn-primary waves-effect waves-light">Sign up Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="card pricing-box text-center">
                                <div class="card-body p-4">
                                    <div>
                                        <div class="mt-3">
                                            <h5 class="mb-1">Unlimited</h5>
                                            <p class="text-muted pb-2">Unlimited plans</p>
                                        </div>

                                        <div class="avatar-md mx-auto my-4">
                                            <div class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-22">
                                                <i class="bx bx-layer h2 text-primary mb-0"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="list-unstyled plan-features mt-3">
                                        <li>Users: <span class="text-primary fw-semibold">5</span></li>
                                        <li>Storage: <span class="text-primary fw-semibold">40 GB</span></li>
                                        <li>Domain: <span class="text-primary fw-semibold">4</span></li>
                                        <li>Support: <span class="text-primary fw-semibold">Yes</span></li>
                                        <li>Setup: <span class="text-primary fw-semibold">Yes</span></li>
                                    </ul>

                                    <div class="py-4">
                                        <h3><sup><small>$</small></sup> 49/ <span class="font-size-13 text-muted">Per month</span></h3>
                                    </div>

                                    <div class="text-center plan-btn my-2">
                                        <a href="#" class="btn btn-primary waves-effect waves-light">Sign up Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="mb-4">
                                    <h4>Compare our plans and find your</h4>
                                    <p class="text-muted mb-0">Simple, transparaent pricing that grows with you. Try any plan free for 30 days.</p>
                                </div>
                                <div>
                                    <ul class="nav nav-pills mb-3 justify-content-center bg-light d-inline-flex p-1 rounded" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link active" id="pills-monthly-tab" data-bs-toggle="pill" data-bs-target="#pills-monthly" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link" id="pills-annualy-tab" data-bs-toggle="pill" data-bs-target="#pills-annualy" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" tabindex="-1">Annualy</button>
                                        </li>
                                      </ul>
                                      <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active table-responsive" id="pills-monthly" role="tabpanel" aria-labelledby="pills-monthly-tab" tabindex="0">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                      <th scope="col"><span class="fs-5">Pricing Table</span></th>
                                                      <th scope="col">
                                                        <span class="text-muted font-size-12">Basic</span>
                                                        <p class="fs-5 mb-0">Free</p>
                                                      </th>
                                                      <th scope="col">
                                                        <span class="text-muted font-size-12">Starndard</span>
                                                        <p class="fs-5 mb-0">$5</p>
                                                    </th>
                                                      <th scope="col">
                                                        <span class="text-muted font-size-12">Premium</span>
                                                        <p class="fs-5 mb-0">$19</p>
                                                    </th>
                                                      <th scope="col">
                                                        <span class="text-muted font-size-12">Special</span>
                                                        <p class="fs-5 mb-0">$49</p>
                                                    </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-15">Basic features</span></th>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-15">Users</span></th>
                                                        <td><span class="text-muted">10</span></td>
                                                        <td><span class="text-muted">20</span></td>
                                                        <td><span class="text-muted">30</span></td>
                                                        <td><span class="text-muted">Unlimited</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-15">Individual data</span></th>
                                                        <td><span class="text-muted">12GB</span></td>
                                                        <td><span class="text-muted">25GB</span></td>
                                                        <td><span class="text-muted">40GB</span></td>
                                                        <td><span class="text-muted">Unlimited</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-15">Support</span></th>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-15">Automated workflows</span></th>
                                                        <td><span class="text-muted fs-4"><i class="mdi mdi-minus-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-15">200+ integrations</span></th>
                                                        <td><span class="text-muted fs-4"><i class="mdi mdi-minus-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade table-responsive" id="pills-annualy" role="tabpanel" aria-labelledby="pills-annualy-tab" tabindex="0">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                      <th scope="col"><span class="fs-5">Pricing Table</span></th>
                                                      <th scope="col">
                                                        <span class="text-muted font-size-12">Basic</span>
                                                        <p class="fs-5 mb-0">Free</p>
                                                      </th>
                                                      <th scope="col">
                                                        <span class="text-muted font-size-12">Starndard</span>
                                                        <p class="fs-5 mb-0">$50</p>
                                                    </th>
                                                      <th scope="col">
                                                        <span class="text-muted font-size-12">Premium</span>
                                                        <p class="fs-5 mb-0">$190</p>
                                                    </th>
                                                      <th scope="col">
                                                        <span class="text-muted font-size-12">Special</span>
                                                        <p class="fs-5 mb-0">$490</p>
                                                    </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-15">Basic features</span></th>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-15">Users</span></th>
                                                        <td><span class="text-muted">100</span></td>
                                                        <td><span class="text-muted">200</span></td>
                                                        <td><span class="text-muted">300</span></td>
                                                        <td><span class="text-muted">Unlimited</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-15">Individual data</span></th>
                                                        <td><span class="text-muted">60GB</span></td>
                                                        <td><span class="text-muted">250GB</span></td>
                                                        <td><span class="text-muted">400GB</span></td>
                                                        <td><span class="text-muted">Unlimited</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-15">Support</span></th>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-15">Automated workflows</span></th>
                                                        <td><span class="text-muted fs-4"><i class="mdi mdi-minus-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><span class="font-size-15">400+ integrations</span></th>
                                                        <td><span class="text-muted fs-4"><i class="mdi mdi-minus-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                        <td><span class="text-success fs-4"><i class="mdi mdi-checkbox-marked-circle"></i></span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection

