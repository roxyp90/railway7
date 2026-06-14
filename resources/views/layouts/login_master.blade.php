<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Layout ligero usado por las pantallas de acceso cuando no hace falta mostrar el menu lateral. --}}
    <title>{{ config('app.name', 'Sistema Bibliotecario PRO') }}</title>

    {{-- Recursos visuales minimos para login / registro con estilo AdminLTE. --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.css') }}">

    @stack('css')
</head>
<body class="hold-transition login-page">
    {{-- Las vistas de autenticacion insertan aqui su formulario. --}}
    @yield('content')
</body>
{{-- Scripts base para que funcionen los componentes visuales del login. --}}
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
@stack('scripts')
</html>
