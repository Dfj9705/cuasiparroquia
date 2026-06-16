@extends('layouts.public')

@section('title', 'Galería')
@section('meta_description', 'Galerías de imágenes institucionales.')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="fw-bold mb-2">Galería</h1>
            <p class="text-muted mb-0">Actividades e imágenes institucionales.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <livewire:gallery-viewer />
                </div>
            </div>
        </div>
    </section>

@endsection