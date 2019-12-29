<!DOCTYPE html>
<html lang="{{ env('APP_LANG') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Victor B. Fiamoncini">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/nucleo/css/nucleo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    {{-- Others --}}
    <link
        rel="icon"
        type="image/png"
        href="{{ asset('assets/images/favicon.png') }}"
    >
    <title>@yield('title')</title>
</head>
<body>
    {{-- Root --}}
    @yield('master')
    {{-- Scripts --}}
    <script src="{{ asset('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=1.1.0') }}"></script>
    {{-- Custom JS --}}
    @yield('scripts')
</body>
</html>
