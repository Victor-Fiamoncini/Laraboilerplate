<!DOCTYPE html>
<html lang="{{ env('APP_LANG') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    {{-- CSS --}}
    <link
        rel="stylesheet"
        href="{{ asset('assets/css/index.css') }}"
    >
    <title>Argon - @yield('title')</title>
</head>
<body class="bg-default">
    {{-- Root --}}
    @yield('content')
    {{-- Scripts --}}
    <script src="{{ asset('assets/js/index.js') }}"></script>
    @yield('scripts')
</body>
</html>
