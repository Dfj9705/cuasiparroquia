@extends('layouts.public')

@section('title', 'Galería')
@section('meta_description', 'Galerías de imágenes institucionales.')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="fw-bold mb-2">Galería</h1>
            <p class="text-muted mb-0">Actividades e imágenes institucionales.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                @forelse($galleries as $gallery)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            @if ($gallery->items->first())
                                <img src="{{ Storage::url($gallery->items->first()->gitem_image) }}" class="card-img-top"
                                    alt="{{ $gallery->gall_title }}">
                            @endif

                            <div class="card-body">
                                <h5>{{ $gallery->gall_title }}</h5>

                                <p class="text-muted">
                                    {{ $gallery->gall_description }}
                                </p>

                                <a href="{{ route('public.galleries.show', $gallery) }}" class="btn btn-primary btn-sm">
                                    Ver galería
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No hay galerías publicadas.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $galleries->withQueryString()->links() }}
            </div>
        </div>
    </section>

@endsection