@extends('layouts.master-without_nav')

@section('title')@lang('translation.Coming_Soon')@endsection

@section('content')

    <div class="authentication-bg min-vh-100" style="background: url(./assets/images/auth-bg.jpg) bottom;">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="home-wrapper text-center">
                        <a href="index" class="auth-logo">
                            <span class="logo-lg">
                                <img src="assets/images/logo-sm.svg" alt="" height="22"> <span class="logo-txt">Ecommerce</span>
                            </span>
                        </a>
                        <h3 class="mt-3">Let's get started with Ecommerce</h3>
                        <p class="mb-0">It will be as simple as Occidental in fact it will be Occidental.</p>

                        <div class="row justify-content-center mt-5">
                            <div class="col-lg-6 col-sm-5">
                                <div class="maintenance-img mb-5">
                                    <img src="{{ URL::asset('assets/images/coming-soon-img.png') }}" alt="" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>



                        <div id="countdown" class="countdownlist"></div>

                        <div class="input-group countdown-input-group mx-auto my-5">
                            <input type="email" class="form-control border-light shadow" placeholder="Enter your email address" aria-label="search result" aria-describedby="button-email">
                            <button class="btn btn-primary" type="button" id="button-email">Send <i class="bx bx-paper-plane ms-1"></i></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
