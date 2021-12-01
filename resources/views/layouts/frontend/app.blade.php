<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
    <link href="{{ asset ('assets/custom/bootstrap-4.1.1.min.css') }}" rel="stylesheet">
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


    <!-- Bootstrap core CSS -->
    <link href="{{ asset ('store/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset ('store/css/shop-homepage.css') }}" rel="stylesheet">
    <link href="{{ asset ('store/css/shop-homepage.css') }}" rel="stylesheet">
    <link href="{{ asset ('assets/custom/slider.css') }}" rel="stylesheet">

    <!--bootstrap js -->
    <script src="{{ asset ('assets/custom/bootstrap.min.js') }}"></script>
    @stack('css')


</head>
<body>

@include('layouts.frontend.partials.topbar')
<!-- Page Content -->
<div class="container">

    <div class="row">
        @include('layouts.frontend.partials.sidebar')
        <!-- Contains Page Content -->
        <div class="col-lg-9 order-first order-md-last">
            @yield('content')
        </div>
        <!--./ End Page Content -->
    </div>
</div>

@include('layouts.frontend.partials.footer')

<!-- Scripts. Contains page JavaScript -->
<script src="{{ asset ('store/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset ('store/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset ('assets/custom/slider.js') }}"></script>
<!-- ./Scripts -->

@stack('js')
</body>
</html>
