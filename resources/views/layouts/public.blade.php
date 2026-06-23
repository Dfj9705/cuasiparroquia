<!DOCTYPE html>
<html lang="es" data-bs-theme="light">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> 
    @yield(
        'title',
        $siteSettings?->site_meta_title
            ?? $siteSettings?->site_name
            ?? config('app.name')
    )
</title>

<meta name="description"
    content="@yield(
        'meta_description',
        $siteSettings?->site_meta_description
            ?? $siteSettings?->site_slogan
    )"
/>

<meta
    property="og:title"
    content="@yield(
        'title',
        $siteSettings?->site_meta_title
            ?? $siteSettings?->site_name
    )"
/>

<meta
    property="og:description"
    content="@yield(
        'meta_description',
        $siteSettings?->site_meta_description
    )"
/>

        <meta name="description" content="@yield('meta_description', '')">
       @if($siteSettings?->site_favicon)
    <link
        rel="icon"
        type="image/png"
        href="{{ asset('storage/'.$siteSettings->site_favicon) }}"
    >
@endif

@if($siteSettings?->site_logo)
    <meta
        property="og:image"
        content="{{ asset('storage/'.$siteSettings->site_logo) }}"
    >
@endif
        @vite([
            'resources/assets/css/demo.css',
            'resources/assets/vendor/fonts/iconify/iconify.css',

            'resources/scss/app.scss',
            'resources/js/app.js'
        ])

        @stack('styles')
    </head>

    <body >

        <x-public.navbar />

        <main class="mt-0">
            @yield('content')
        </main>

        <x-public.footer />
        @stack('scripts')
    </body>

</html>