<!DOCTYPE html>
<html lang="{{ env('APP_LANG') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Victor B. Fiamoncini">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/nucleo/css/nucleo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    {{-- Others --}}
    <link
        rel="shortcut icon"
        type='image/x-icon'
        href="{{ asset('assets/images/favicon.png') }}"
    >
    <title>@yield('title')</title>
</head>
<body class="bg-default">
    {{-- Root --}}
    @yield('master')
    {{-- Scripts --}}
    <script src="{{ asset('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    {{-- Custom JS --}}
    @yield('scripts')
</body>
</html>
