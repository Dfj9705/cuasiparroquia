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
            <div class="row g-4">
                @forelse($posts as $post)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            @if($post->post_image)
                                <img src="{{ Storage::url($post->post_image) }}" class="card-img-top" alt="{{ $post->post_title }}">
                            @endif

                            <div class="card-body">
                                @if($post->category)
                                    <span class="badge bg-label-primary mb-2">
                                        {{ $post->category->pcat_name }}
                                    </span>
                                @endif

                                <h5 class="card-title">{{ $post->post_title }}</h5>

                                <p class="text-muted">
                                    {{ $post->post_excerpt }}
                                </p>

                                <a href="{{ route('public.posts.show', $post) }}" class="btn btn-primary btn-sm">
                                    Leer más
                                </a>
                            </div>

                            <div class="card-footer bg-white text-muted small">
                                {{ $post->post_published_at?->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No hay noticias publicadas.
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