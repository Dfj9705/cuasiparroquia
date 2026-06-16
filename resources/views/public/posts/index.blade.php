@extends('layouts.public')

@section('title', 'Noticias')
@section('meta_description', 'Noticias y publicaciones institucionales.')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="fw-bold mb-2">Noticias</h1>
            <p class="text-muted mb-0">Últimas publicaciones institucionales.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <livewire:post-search />
                </div>
            </div>
        </div>
    </section>

@endsection