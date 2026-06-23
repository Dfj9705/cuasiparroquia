@extends('layouts.public')

@section('title', 'Descargas')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <span class="badge bg-label-primary mb-2">Recursos</span>
                <h1 class="h2 mb-0">Descargas disponibles</h1>
            </div>


            @livewire('public.download-filter')
        </div>
    </section>

@endsection