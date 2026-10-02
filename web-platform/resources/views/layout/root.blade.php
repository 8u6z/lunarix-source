<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head.embed')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @production
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endproduction
    <title>{{ $title ?? 'Lunarix' }}</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,500,600,700">
    <script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
    <script>window.jQuery || document.write("<script src='/js/jquery/jquery-1.11.1.js'><\/script>")</script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js"></script>
    <script>window.jQuery || document.write("<script src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>
    <script src="https://js.lunarix.lol/35442da4b07e6a0ed6b085424d1a52cb.js"></script>
    <script src="https://js.lunarix.lol/10cc00d9523cce67f7bdbbb8805d84e5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-elastic/2.5.1/elastic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-local-storage/0.7.1/angular-local-storage.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="turbo-visit-control" content="reload">
    @stack('css')
</head>
<body>
@yield('content')
@include('layout.discord-notification')
@stack('js')
</body>
</html>
