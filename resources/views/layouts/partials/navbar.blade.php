<nav class="layout-navbar shadow-none py-0 navbar-active">
    <div class="navbar navbar-expand-lg bg-white shadow-sm landing-navbar ">
        <div class="container-fluid">


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="mainNavbar" class="collapse navbar-collapse ">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('posts.index') ? 'active' : '' }}">
                        <a href="{{ route('posts.index') }}" class="nav-link">Noticias</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('downloads.index') ? 'active' : '' }}">
                        <a href="{{ route('downloads.index') }}" class="nav-link">Descargas</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('galleries.index') ? 'active' : '' }}">
                        <a href="{{ route('galleries.index') }}" class="nav-link">Galería</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                        <a href="{{ route('contact') }}" class="nav-link">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>