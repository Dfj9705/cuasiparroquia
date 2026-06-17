@extends('layouts.public')

@section('title', 'Contacto')
@section('meta_description', 'Formulario de contacto institucional.')

@section('content')

    <x-header-page titlePage="Contacto" />

    <section class="py-5">
        <div class="container">
            <div class="row g-4">

                <div class="col-lg-5">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="mb-3">Información de contacto</h5>

                            <p class="text-muted mb-2">
                                {{ $siteSettings?->site_address ?? 'Dirección no disponible' }}
                            </p>

                            <p class="text-muted mb-2">
                                Teléfono: {{ $siteSettings?->site_phone ?? 'Teléfono no disponible' }}
                            </p>

                            <p class="text-muted mb-2">
                                Correo: {{ $siteSettings?->site_email ?? 'Correo no disponible' }}
                            </p>

                            <p class="text-muted mb-0">
                                Horario:
                                {{ $siteSettings?->site_hours ?? 'Lunes a Sábado de 8:00 a 12:00 y de 14:00 a 18:00' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">Formulario de contacto</h5>
                            <div class="">
                                <livewire:contact-form />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection