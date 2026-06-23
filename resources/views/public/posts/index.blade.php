@extends('layouts.public')

@section('title', 'Noticias')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <span class="badge bg-label-primary mb-2">Noticias</span>
                <h1 class="h2 mb-0">Últimas publicaciones</h1>
            </div>
            <form method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar noticias..."
                        value="{{ request('search') }}">

                    <button class="btn btn-primary">
                        Buscar
                    </button>
                </div>
            </form>
            <div class="row g-4">
                @forelse ($posts as $post)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">

                            @if ($post->post_image)
                                <img src="{{ asset('storage/' . $post->post_image) }}" class="card-img-top"
                                    alt="{{ $post->post_title }}">
                            @endif

                            <div class="card-body">
                                <span class="badge bg-label-primary mb-2">
                                    {{ $post->category?->cat_name ?? 'Noticia' }}
                                </span>

                                <h5 class="card-title">
                                    {{ $post->post_title }}
                                </h5>

                                <p class="text-muted">
                                    {{ Str::limit(strip_tags($post->post_content), 120) }}
                                </p>

                                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary btn-sm">
                                    Leer más
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center py-5">
                                <h5>No hay noticias publicadas</h5>
                                <p class="text-muted mb-0">Pronto encontrarás contenido disponible.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

@endsection