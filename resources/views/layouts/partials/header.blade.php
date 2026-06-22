<header class="header py-5">
    <div class="container-xxl py-6">

        <div class="row justify-content-center">
            <div class="d-none col-lg-1 col-md-1 d-md-block">
                @if($siteSettings?->site_logo)
                    <img src="{{ asset('storage/' . $siteSettings->site_logo) }}" alt="Logo" class="w-100">
                @endif
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <h1 class="text-center">{{ $siteSettings?->site_name ?? config('app.name') }}</h1>
            </div>
        </div>
    </div>
    @include('layouts.partials.navbar')
</header>