@extends('layouts.public')

@section('title', $gallery->gal_title)

@section('content')

    <section class="py-5">
        <div class="container">

            <a href="{{ route('galleries.index') }}" class="btn btn-sm btn-outline-primary mb-4">
                ← Volver a galería
            </a>
            <nav class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Inicio</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('galleries.index') }}">Galerías</a>
                    </li>

                    <li class="breadcrumb-item active">
                        {{ $gallery->gal_title }}
                    </li>
                </ol>
            </nav>
            <div class="mb-4">
                <span class="badge bg-label-primary mb-2">Galería</span>

                <h1 class="h2 mb-2">
                    {{ $gallery->gal_title }}
                </h1>

                @if ($gallery->gal_description)
                    <p class="text-muted mb-0">
                        {{ $gallery->gal_description }}
                    </p>
                @endif
            </div>

            <livewire:public.gallery-viewer :gallery="$gallery" />

        </div>
    </section>

@endsection