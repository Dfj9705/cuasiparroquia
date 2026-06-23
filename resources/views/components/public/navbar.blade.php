<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
            @if ($siteSettings?->site_logo)
                <img src="{{ asset('storage/' . $siteSettings->site_logo) }}" alt="{{ $siteSettings->site_name }}"
                    class="img-fluid hero-logo" width="45px">
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <i class="bx bx-church display-1 text-primary"></i>
                    </div>
                </div>
            @endif
            Cuasiparroquia
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar"
            aria-controls="publicNavbar" aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="publicNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link text-dark {{ request()->url() == url('/') ? 'active' : '' }}"
                        href="{{ url('/') }}">Inicio</a>
                </li>

                <li class="nav-item w-100">
                    <a class="nav-link text-dark  {{ request()->url() == route('posts.index') ? 'active' : '' }}"
                        href="{{ route('posts.index') }}">Noticias</a>
                </li>

                <li class="nav-item w-100">
                    <a class="nav-link text-dark {{ request()->url() == url('/downloads') ? 'active' : '' }}"
                        href="{{ route('downloads.index') }}">Descargas</a>
                </li>

                <li class="nav-item w-100">
                    <a class="nav-link text-dark {{ request()->url() == url('/galleries') ? 'active' : '' }}"
                        href="{{ route('galleries.index') }}">Galería</a>
                </li>

                <li class="nav-item w-100">
                    <a class="btn btn-primary w-100{{ request()->url() == url('/contact') ? 'active' : '' }}"
                        href="{{ url('/contact') }}">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>