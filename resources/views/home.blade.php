@extends('layouts.public')

@section('title', $settings?->site_meta_title ?? $settings?->site_name ?? config('app.name'))
@section('meta_description', $settings?->site_meta_description ?? $settings?->site_slogan)

@section('content')

    <section class="hero-section py-5">
        <div class="container py-5">
            <div class="row align-items-center gy-4">
                <div class="col-lg-7">
                    <span class="badge bg-label-primary mb-3">
                        Bienvenido
                    </span>

                    <h1 class="display-4 fw-bold mb-3">
                        {{ $settings?->site_name ?? config('app.name') }}
                    </h1>

                    <p class="lead text-muted mb-4">
                        {{ $settings?->site_slogan ?? 'Comunidad de fe, servicio y encuentro.' }}
                    </p>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('posts.index') }}" class="btn btn-primary">
                            Ver noticias
                        </a>

                        <a href="{{ route('contact') }}" class="btn btn-outline-primary">
                            Contacto
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 text-center">
                    @if ($settings?->site_logo)
                        <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="{{ $settings->site_name }}"
                            class="img-fluid hero-logo">
                    @else
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-5">
                                <i class="bx bx-church display-1 text-primary"></i>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if ($announcements->isNotEmpty())
        <section class="py-5">
            <div class="container-fluid">
                <div class="mb-4">
                    <span class="badge bg-label-primary mb-2">Avisos</span>
                    <h2 class="h3 mb-0">Anuncios importantes</h2>
                </div>

                <div id="announcementsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        @foreach ($announcements as $announcement)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-0">

                                        <img src="{{ asset('storage/' . $announcement->ann_image) }}"
                                            class="card-img-top announcement-image" alt="{{ $announcement->ann_title }}">

                                        <div class="p-4">
                                            <span class="badge text-bg-primary mb-3">
                                                Aviso
                                            </span>

                                            <h3 class="h4 mb-3">
                                                {{ $announcement->ann_title }}
                                            </h3>

                                            <p class="text-muted mb-0">
                                                {{ Str::limit(strip_tags($announcement->ann_description), 220) }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#announcementsCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#announcementsCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>


                    @if ($announcements->count() > 1)
                        <div class="carousel-indicators position-relative mt-4 mb-0">
                            @foreach ($announcements as $announcement)
                                <button type="button" data-bs-target="#announcementsCarousel" data-bs-slide-to="{{ $loop->index }}"
                                    class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $loop->iteration }}">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    @if ($posts->isNotEmpty())
        <section class="py-5 bg-light">
            <div class="container">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div>
                        <span class="badge bg-label-primary mb-2">Noticias</span>
                        <h2 class="h3 mb-0">Últimas publicaciones</h2>
                    </div>

                    <a href="{{ route('posts.index') }}" class="btn btn-sm btn-outline-primary">
                        Ver todas
                    </a>
                </div>

                <div class="row g-4">
                    @foreach ($posts as $post)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @if ($post->post_image)
                                    <img src="{{ asset('storage/' . $post->post_image) }}" class="card-img-top"
                                        alt="{{ $post->post_title }}">
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $post->post_title }}
                                    </h5>

                                    <p class="text-muted">
                                        {{ Str::limit(strip_tags($post->post_content), 120) }}
                                    </p>

                                    <a href="{{ route('posts.show', $post->post_slug) }}" class="btn btn-sm btn-primary">
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