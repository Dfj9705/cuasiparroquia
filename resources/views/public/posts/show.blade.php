@extends('layouts.public')

@section('title', $post->post_title)
@section('meta_description', $post->post_excerpt ?? 'Detalle de publicación institucional.')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            @if($post->category)
                <span class="badge bg-label-primary mb-3">
                    {{ $post->category->pcat_name }}
                </span>
            @endif

            <h1 class="fw-bold">{{ $post->post_title }}</h1>

            <p class="text-muted mb-0">
                Publicado el {{ $post->post_published_at?->format('d/m/Y') }}
            </p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @if($post->post_image)
                <img src="{{ Storage::url($post->post_image) }}" class="img-fluid rounded shadow-sm mb-4"
                    alt="{{ $post->post_title }}">
            @endif

            <article class="card shadow-sm">
                <div class="card-body">
                    {!! $post->post_content !!}
                </div>
            </article>
        </div>
    </section>

    @if($relatedPosts->count())
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="mb-4">Noticias relacionadas</h2>

                <div class="row g-4">
                    @foreach($relatedPosts as $related)
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm">
                                @if($related->post_image)
                                    <img src="{{ Storage::url($related->post_image) }}" class="card-img-top"
                                        alt="{{ $related->post_title }}">
                                @endif

                                <div class="card-body">
                                    <h5>{{ $related->post_title }}</h5>

                                    <p class="text-muted">
                                        {{ $related->post_excerpt }}
                                    </p>

                                    <a href="{{ route('public.posts.show', $related) }}" class="btn btn-outline-primary btn-sm">
                                        Leer más
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection