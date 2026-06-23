@extends('layouts.public')

@section('title', 'Noticias')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <span class="badge bg-label-primary mb-2">Noticias</span>
                <h1 class="h2 mb-0">Últimas publicaciones</h1>
            </div>
            @livewire('public.post-search')

        </div>
    </section>

@endsection