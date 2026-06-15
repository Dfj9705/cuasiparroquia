@extends('layouts.public')

@section('title', 'Inicio')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="fw-bold mb-3">Bienvenido</h1>
            <p class="text-muted">
                Sitio web institucional administrable.
            </p>
        </div>
    </section>

    @if($announcements->count())
        <section class="py-5">
            <div class="container">
                <h2 class="mb-4">Anuncios</h2>

                <div class="row g-4">
                    @foreach($announcements as $announcement)
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm">
                                @if($announcement->ann_image)
                                    <img src="{{ Storage::url($announcement->ann_image) }}" class="card-img-top"
                                        alt="{{ $announcement->ann_title }}">
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">{{ $announcement->ann_title }}</h5>
                                    <p class="card-text text-muted">
                                        {{ $announcement->ann_summary }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="mb-4">Últimas noticias</h2>

            <div class="row g-4">
                @forelse($posts as $post)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            @if($post->post_image)
                                <img src="{{ Storage::url($post->post_image) }}" class="card-img-top" alt="{{ $post->post_title }}">
                            @endif

                            <div class="card-body">
                                <h5>{{ $post->post_title }}</h5>

                                <p class="text-muted">
                                    {{ $post->post_excerpt }}
                                </p>

                                <a href="{{ route('public.posts.show', $post) }}" class="btn btn-primary btn-sm">
                                    Leer más
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No hay noticias publicadas.</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection