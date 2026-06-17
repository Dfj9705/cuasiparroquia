@extends('layouts.public')

@section('title', 'Inicio')

@section('content')

    <div id="carouselExample" class="carousel slide carousel-fade"
        style="overflow: hidden; min-height: 20vh; max-height: 60vh;">
        <div class="carousel-indicators">
            @if($announcements->count())
                @foreach($announcements as $announcement)
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}"
                        aria-label="Slide {{ $loop->iteration }}"></button>
                @endforeach
            @endif
        </div>
        <div class="carousel-inner">
            @if($announcements->count())


                @foreach($announcements as $announcement)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="background-color: #000000ff;">

                        @if($announcement->ann_image)
                            <img src="{{ Storage::url($announcement->ann_image) }}" class="d-block w-100"
                                style="opacity: 0.5; object-fit: cover; max-height: 60vh" alt="{{ $announcement->ann_title }}">
                        @endif
                        <div class="carousel-caption d-none d-md-block {{ $loop->odd ? 'text-start' : 'text-end' }}">
                            <h2 class="display-4">{{ $announcement->ann_title }}</h2>
                            <p class="fs-5">
                                {{ $announcement->ann_description }}
                            </p>
                        </div>

                    </div>
                @endforeach

            @endif

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


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