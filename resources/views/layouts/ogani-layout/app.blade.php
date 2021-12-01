<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SL2 | @yield('title')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/ogani/css2.css?family=Cairo:wght@200;300;400;600;900&display=swap') }}" rel="stylesheet">

    <!-- custom style -->
    <!--<link rel="stylesheet" href="{{ asset ('assets/dist/css/custom.css') }}">-->

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/toastr/toastr.min.css') }}">

    <!-- Ogani CSS styles-->
    <link rel="stylesheet" href="{{ asset('assets/ogani/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/ogani/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/ogani/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/ogani/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/ogani/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/ogani/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/ogani/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/ogani/css/style.css') }}" type="text/css">

    @stack('css')
</head>
<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

@include('layouts.ogani-layout.partials.humberger')
@include('layouts.ogani-layout.partials.topbar')

<!--Hero Section-->
@yield('content')

<!--Footer Section-->
@include('layouts.ogani-layout.partials.footer')

<!-- Js Plugins -->
<script src="{{ asset('assets/ogani/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/ogani/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/ogani/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/ogani/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/ogani/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('assets/ogani/js/mixitup.min.js') }}"></script>
<script src="{{ asset('assets/ogani/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/ogani/js/main.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset ('assets/plugins/toastr/toastr.min.js') }}"></script>
{!! toastr()->render() !!}

<!-- Global site tag (gtag.js) - Google Analytics -->
<!--<script async="" src="{{ asset('assets/ogani/js/gtag/js.js?id=UA-23581568-13') }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>-->

@stack('js')

</body>

</html>
