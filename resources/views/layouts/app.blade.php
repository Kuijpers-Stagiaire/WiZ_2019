<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name=viewport content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8">
    <title>WiZ Kuijpers - Inloggen</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="WiZ Kuijpers - Weggooien is Zonde, een overzicht van alle overgbleven producten van Kuijpers."/>
    <meta name="author" content="Daan Swinkels, Ferdy Hommeles">
    <meta name="keywords" content="Kuijpers,WiZ, Weggooien is Zonde">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/wizicon.png')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />

    {{-- @laravelPWA --}}

</head>
<body>

    @yield('content')

    <script src="/public/js/jquery-3.1.1.max.js"></script>
    <script src="/public/js/bootstrap.js"></script>
    <script src="/public/js/shop.js"></script>
</body>
</html>
