<footer class="bg-white border-top mt-5">
    <div class="container py-5">

        <div class="row gy-4">

            <div class="col-lg-4">
                <h5>{{ $siteSettings?->site_name }}</h5>

                <p class="text-muted">
                    {{ $siteSettings?->site_slogan }}
                </p>
            </div>

            <div class="col-lg-4">
                <h6>Contacto</h6>

                <ul class="list-unstyled">
                    <li>{{ $siteSettings?->site_phone }}</li>
                    <li>{{ $siteSettings?->site_email }}</li>
                    <li>{{ $siteSettings?->site_address }}</li>
                </ul>
            </div>

            <div class="col-lg-4">
                <h6>Redes sociales</h6>

                <div class="d-flex gap-2">

                    @if($siteSettings?->site_facebook)
                        <a href="{{ $siteSettings->site_facebook }}" target="_blank"
                            class="btn btn-icon btn-outline-primary">
                            <i class="bx bxl-facebook"></i>
                        </a>
                    @endif

                    @if($siteSettings?->site_instagram)
                        <a href="{{ $siteSettings->site_instagram }}" target="_blank"
                            class="btn btn-icon btn-outline-primary">
                            <i class="bx bxl-instagram"></i>
                        </a>
                    @endif

                    @if($siteSettings?->site_youtube)
                        <a href="{{ $siteSettings->site_youtube }}" target="_blank"
                            class="btn btn-icon btn-outline-primary">
                            <i class="bx bxl-youtube"></i>
                        </a>
                    @endif

                </div>
            </div>

        </div>

        <hr>

        <div class="text-center text-muted">
            © {{ date('Y') }} {{ $siteSettings?->site_name }}
        </div>

    </div>
</footer>