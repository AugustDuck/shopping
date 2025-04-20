<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{asset('css/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/animate/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/css-hamburgers/hamburgers.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/animsition/css/animsition.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/MagnificPopup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/custom/app.css') }}">
</head>
<style>
    .body{
        height: 100%;
    }
</style>

<body>

        @include('layout.app.header')
  

        @yield('content')


        @include('layout.app.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
@include('layout.app.modal')
</html>