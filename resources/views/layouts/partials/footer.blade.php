<footer class="footer bg-footer-theme">
    <div class="container-xxl py-4">
        <div class="row gy-4">

            <div class="col-md-6">
                <h5 class="fw-bold mb-2">
                    @if($siteSettings?->site_logo)
                        <img src="{{ asset('storage/' . $siteSettings->site_logo) }}" alt="Logo" height="50" width="50"
                            class="img-fluid">
                    @endif
                    {{ $siteSettings?->site_name ?? config('app.name') }}
                </h5>

                @if($siteSettings?->site_slogan)
                    <p class="text-muted mb-0">
                        {{ $siteSettings->site_slogan }}
                    </p>
                @endif
            </div>

            <div class="col-md-3">
                <h6 class="fw-semibold mb-3">Enlaces</h6>

                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <a href="{{ route('public.home') }}" class="footer-link">Inicio</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('public.posts.index') }}" class="footer-link">Noticias</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('public.downloads.index') }}" class="footer-link">Descargas</a>
                    </li>
                    <li>
                        <a href="{{ route('public.contact.index') }}" class="footer-link">Contacto</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3">
                <h6 class="fw-semibold mb-3">Redes sociales</h6>

                <div class="d-flex gap-3">
                    @if($siteSettings?->site_facebook)
                        <a href="{{ $siteSettings->site_facebook }}" target="_blank" rel="noopener" class="text-body">
                            <i class="bx bxl-facebook fs-4"></i>
                        </a>
                    @endif

                    @if($siteSettings?->site_instagram)
                        <a href="{{ $siteSettings->site_instagram }}" target="_blank" rel="noopener" class="text-body">
                            <i class="bx bxl-instagram fs-4"></i>
                        </a>
                    @endif

                    @if($siteSettings?->site_youtube)
                        <a href="{{ $siteSettings->site_youtube }}" target="_blank" rel="noopener" class="text-body">
                            <i class="bx bxl-youtube fs-4"></i>
                        </a>
                    @endif

                    @if($siteSettings?->site_twitter)
                        <a href="{{ $siteSettings->site_twitter }}" target="_blank" rel="noopener" class="text-body">
                            <i class="bx bxl-twitter fs-4"></i>
                        </a>
                    @endif

                    @if($siteSettings?->site_whatsapp)
                        <a href="{{ $siteSettings->site_whatsapp }}" target="_blank" rel="noopener" class="text-body">
                            <i class="bx bxl-whatsapp fs-4"></i>
                        </a>
                    @endif
                </div>
            </div>

        </div>

        <hr class="my-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <small class="text-muted">
                © {{ date('Y') }} {{ $siteSettings?->site_name ?? config('app.name') }}. Todos los derechos reservados.
            </small>

            <small class="text-muted">
                Sitio web institucional
            </small>
        </div>
    </div>
</footer>