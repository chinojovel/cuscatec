<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8" />
            <title> @yield('title') | Ecommerce - Admin & Dashboard Template</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
            <meta content="Themesbrand" name="author" />
            <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
            @include('layouts.head-css')
        </head>

    @section('body')
        @include('layouts.body')
    @show
        @yield('content')
        @include('layouts.vendor-scripts')
    </body>
</html>
