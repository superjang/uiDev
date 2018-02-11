<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Test') }}</title>
    @yield('css_common')
    @yield('css_application')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/frameworks/materialize/css/materialize.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/jaewon.css') }}">
</head>
<body>
@include('../header')

<div id="content">
    @yield('content')
</div>

{{--https://material.io/icons/--}}

@include('../footer')
@yield('script_common')
@yield('script_application')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('public/frameworks/materialize/js/materialize.min.js') }}"></script>
<script>
    $(function(){
        $(".button-collapse").sideNav();
        $('select').material_select();
    });
</script>
</body>
</html>