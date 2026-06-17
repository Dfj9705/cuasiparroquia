<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'Cuasiparroquia')</title>

        <x-seo />
        <link rel="stylesheet" href="{{ asset('sneat/vendor/css/core.css') }}">
        <link rel="stylesheet" href="{{ asset('sneat/vendor/css/theme-default.css') }}">
        <link rel="stylesheet" href="{{ asset('sneat/css/demo.css') }}">
        <link rel="stylesheet" href="{{ asset('sneat/vendor/fonts/boxicons.css') }}">
        @livewireStyles
    </head>

    <body>

        @include('layouts.partials.navbar')

        <main>
            @yield('content')
        </main>

        @include('layouts.partials.footer')

        <script src="{{ asset('sneat/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('sneat/js/main.js') }}"></script>

        @livewireScripts

    </body>

</html>