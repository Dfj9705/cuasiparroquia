@extends('layouts.public')

@section('title', 'Galería')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <span class="badge bg-label-primary mb-2">Galería</span>
                <h1 class="h2 mb-0">Galerías de fotos</h1>
            </div>

            <div class="row g-4">
                @forelse ($galleries as $gallery)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('galleries.show', $gallery) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 border-0 shadow-sm gallery-card">

                                @if ($gallery->items->isNotEmpty())
                                    <img src="{{ asset('storage/' . $gallery->items->first()->gitem_image) }}" class="card-img-top"
                                        a lt="{{ $gallery->gal_title }}">
                                @endif

                                <div class="card-body">
                                    <span class="badge bg-label-primary mb-2">
                                        {{ $gallery->items_count }} fotos
                                    </span>

                                    <h5 class="card-title mb-2">
                                        {{ $gallery->gal_title }}
                                    </h5>

                                    <p class="text-muted mb-0">
                                        {{ Str::limit(strip_tags($gallery->gal_description), 100) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <x-public.empty-state title="No se encontraron galerías" message="Intenta buscar con otros términos" />
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $galleries->links() }}
            </div>
        </div>
    </section>

@endsection