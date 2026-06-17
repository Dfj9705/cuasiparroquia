<nav class="layout-navbar shadow-none py-0 navbar-active">
    <div class="navbar navbar-expand-lg bg-white shadow-sm landing-navbar">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('public.home') }}">

                @if($siteSettings?->site_logo)
                    <img src="{{ Storage::url($siteSettings->site_logo) }}" alt="{{ $siteSettings->site_name }}" height="50"
                        class="me-2">
                @endif
                <span class="">{{ $siteSettings?->site_name ?? config('app.name') }}</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="mainNavbar" class="collapse navbar-collapse landing-navbar-menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('public.home') }}" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('public.posts.index') }}" class="nav-link">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('public.downloads.index') }}" class="nav-link">Descargas</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('public.galleries.index') }}" class="nav-link">Galería</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('public.contact.index') }}" class="nav-link">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>