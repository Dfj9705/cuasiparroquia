@extends('layouts.public')

@section('title', 'Contacto')

@section('content')

    <section class="py-5">
        <div class="container">

            <div class="mb-4">
                <span class="badge bg-label-primary mb-2">Contacto</span>
                <h1 class="h2 mb-0">Comunícate con nosotros</h1>
            </div>

            <div class="row g-4">

                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">

                            <h5 class="mb-4">Información de contacto</h5>

                            @if ($siteSettings?->site_address)
                                <div class="d-flex gap-3 mb-3">
                                    <i class="bx bx-map fs-4 text-primary"></i>
                                    <div>
                                        <h6 class="mb-1">Dirección</h6>
                                        <p class="text-muted mb-0">{{ $siteSettings->site_address }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($siteSettings?->site_phone)
                                <div class="d-flex gap-3 mb-3">
                                    <i class="bx bx-phone fs-4 text-primary"></i>
                                    <div>
                                        <h6 class="mb-1">Teléfono</h6>
                                        <p class="text-muted mb-0">{{ $siteSettings->site_phone }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($siteSettings?->site_email)
                                <div class="d-flex gap-3 mb-3">
                                    <i class="bx bx-envelope fs-4 text-primary"></i>
                                    <div>
                                        <h6 class="mb-1">Correo</h6>
                                        <p class="text-muted mb-0">{{ $siteSettings->site_email }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($siteSettings?->site_whatsapp)
                                <a href="https://wa.me/{{ preg_replace('/\D+/', '', $siteSettings->site_whatsapp) }}"
                                    target="_blank" class="btn btn-primary mt-3">
                                    <i class="bx bxl-whatsapp me-1"></i>
                                    Escribir por WhatsApp
                                </a>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">

                            <h5 class="mb-4">Envíanos un mensaje</h5>

                            <livewire:public.contact-form />

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection