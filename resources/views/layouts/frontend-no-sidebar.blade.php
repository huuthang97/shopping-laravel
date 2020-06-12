<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>@yield('title')</title>
        <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
        @yield('css')
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        
    </head><!--/head-->
<body>

    @include('partials.frontend.header')
    @yield('content')
    @include('partials.frontend.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/header/main.js') }}"></script>
    <script src="{{ asset('frontend/js/sidebar/main.js') }}"></script>
    <script src="{{ asset('frontend/js/cart/main.js') }}"></script>
    @yield('js')
</body>
</html>