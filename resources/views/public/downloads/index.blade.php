@extends('layouts.public')

@section('title', 'Descargas')
@section('meta_description', 'Documentos y archivos disponibles para descarga.')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="fw-bold mb-2">Descargas</h1>
            <p class="text-muted mb-0">Documentos y archivos disponibles.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <livewire:download-filter />
                </div>
            </div>
        </div>
    </section>

@endsection