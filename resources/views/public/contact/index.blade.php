@extends('layouts.public')

@section('title', 'Contacto')
@section('meta_description', 'Formulario de contacto institucional.')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="fw-bold mb-2">Contacto</h1>
            <p class="text-muted mb-0">
                Envíanos tus consultas o comentarios.
            </p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">

                <div class="col-lg-5">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="mb-3">Información de contacto</h5>

                            <p class="text-muted mb-2">
                                Dirección institucional
                            </p>

                            <p class="text-muted mb-2">
                                Teléfono: 0000-0000
                            </p>

                            <p class="text-muted mb-2">
                                Correo: info@sitio.com
                            </p>

                            <p class="text-muted mb-0">
                                Horario: lunes a viernes de 8:00 a 16:00
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">Formulario de contacto</h5>

                            <div class="alert alert-info mb-0">
                                El formulario dinámico lo trabajaremos en la Fase 6 con Livewire.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection