<!DOCTYPE html>
<html lang="{!! app()->getLocale() !!}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{!! __(env('APP_NAME')) !!} - @yield('title') </title>
    <link rel="icon" href="{!! asset('design/images/favicon.png') !!}" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('design/css/aos.css')!!}">
    <link rel="stylesheet" href="{!! asset('design/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{!! asset('design/css/all.css')!!}">
    <link rel="stylesheet" href="{!! asset('design/css/jquery-ui.css')!!}">
    <link rel="stylesheet" href="{!! asset('design/css/owl.carousel.min.css')!!}">
    <link rel="stylesheet" href="{!! asset('design/css/styles.css')!!}">
    @if(app()->getLocale()=='ar')
        <link rel="stylesheet" href="{!! asset('design/css/styles-ar.css')!!}">

    @endif
    <link rel="stylesheet" href="{!! asset('design/css/colors.css')!!}">
    <script src="{!! asset('design/js/jquery.min.js')!!}"></script>
    <script src="{!! asset('design/js/jquery-ui.js')!!}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="{!! asset('design/js/popper.min.js')!!}"></script>
    <script src="{!! asset('design/js/bootstrap.min.js')!!}"></script>
    <script src="{!! asset('design/js/aos.js')!!}"></script>
    <script src="{!! asset('design/js/owl.carousel.min.js')!!}"></script>
    <script src="{!! asset('design/js/scripts.js')!!}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    @yield('header')
</head>
<body @if(app()->getLocale()=='ar')
      class="rtl" dir="rtl"
    @endif >

<div class="main-wrapper">
    @include('sweetalert::alert')

    @include('website.layouts._header')

    @yield('content')

    @include('website.layouts._footer')


    @stack('footer')
    @stack('scripts')
</div>


</body>
</html>

