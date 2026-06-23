@extends('layouts.public')

@section('title', $post->post_meta_title ?? $post->post_title)
@section('meta_description', $post->post_meta_description ?? Str::limit(strip_tags($post->post_content), 150))

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <a href="{{ route('posts.index') }}" class="btn btn-sm btn-outline-primary mb-4">
                        ← Volver a noticias
                    </a>

                    <div class="card border-0 shadow-sm overflow-hidden">

                        @if ($post->post_image)
                            <img src="{{ asset('storage/' . $post->post_image) }}" class="post-detail-image"
                                alt="{{ $post->post_title }}">
                        @endif

                        <div class="card-body p-4 p-lg-5">
                            <span class="badge bg-label-primary mb-3">
                                {{ $post->category?->cat_name ?? 'Noticia' }}
                            </span>

                            <h1 class="mb-3">
                                {{ $post->post_title }}
                            </h1>

                            @if ($post->post_published_at)
                                <p class="text-muted">
                                    Publicado el {{ $post->post_published_at->format('d/m/Y') }}
                                </p>
                            @endif

                            <div class="post-content mt-4">
                                {!! $post->post_content !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection