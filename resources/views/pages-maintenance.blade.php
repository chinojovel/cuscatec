@extends('layouts.master-without_nav')

@section('title')@lang('translation.Maintenance')@endsection

@section('content')

    <div class="authentication-bg min-vh-100" style="background: url(./assets/images/auth-bg.jpg) bottom;">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="home-wrapper text-center">
                        <a href="index" class="auth-logo">
                            <span class="logo-lg">
                                <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="22"> <span
                                    class="logo-txt">Ecommerce</span>
                            </span>
                        </a>
                        <h3 class="mt-3">Site is Under Maintenance</h3>
                        <p>Please check back in sometime.</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row mt-5 pt-5 align-items-center">
                <div class="col-lg-5">
                    <div class="mt-4">
                        <img src="{{ URL::asset('assets/images/maintenance.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6 ms-lg-auto">
                    <div class="card mt-4 maintenance-box">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="text-primary">01.</h5>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16">Why is the Site Down?</h5>
                                    <p class="text-muted mb-0">There are many variations of passages of
                                        Lorem Ipsum available, but the majority have suffered alteration.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4 maintenance-box">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="text-primary">02.</h5>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16">
                                        What is the Downtime?</h5>
                                    <p class="text-muted mb-0">Contrary to popular belief, Lorem Ipsum is not
                                        simply random text. It has roots in a piece of classical.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4 maintenance-box">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="text-primary">03.</h5>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-16">
                                        Do you need Support?</h5>
                                    <p class="text-muted mb-0">If you are going to use a passage of Lorem
                                        Ipsum, you need to be sure there isn't anything embar.. <a
                                            href="mailto:no-reply@domain.com"
                                            class="text-decoration-underline">no-reply@domain.com</a></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
