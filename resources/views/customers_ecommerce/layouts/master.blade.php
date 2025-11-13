<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Ecommerce - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
    @include('customers_ecommerce.layouts.head-css')
</head>

<body data-layout="vertical" data-sidebar="dark">
    <div id="layout-wrapper">
        @include('customers_ecommerce.layouts.topbar')
        @include('customers_ecommerce.layouts.sidebar')
        @include('customers_ecommerce.layouts.horizontal')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
            <!-- Modal Bootstrap -->
            <div class="modal fade" id="stateModal" tabindex="-1" role="dialog" aria-labelledby="stateModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="stateModalLabel">Select a state</h5>
                        </div>
                        <div class="modal-body">
                            <form id="stateForm" action="{{ route('customer.ecommerce.save.state') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select class="form-control" name="state" id="state" required>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form="stateForm" class="btn btn-primary">Save State</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('customers_ecommerce.layouts.footer')
        </div>
    </div>
    @include('customers_ecommerce.layouts.right-sidebar')
    @include('customers_ecommerce.layouts.vendor-scripts')
</body>

</html>
