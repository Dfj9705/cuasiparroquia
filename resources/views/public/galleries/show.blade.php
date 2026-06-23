@extends('layouts.public')

@section('title', $gallery->gal_title)

@section('content')

    <section class="py-5">
        <div class="container">

            <a href="{{ route('galleries.index') }}" class="btn btn-sm btn-outline-primary mb-4">
                ← Volver a galería
            </a>

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

            @if ($gallery->items->isNotEmpty())
                <div class="gallery-masonry">
                    @foreach ($gallery->items as $item)
                        <div class="gallery-masonry-item">
                            <a href="{{ asset('storage/' . $item->gitem_image) }}" data-fancybox="gallery-{{ $gallery->id }}"
                                data-caption="{{ $item->gitem_title }}">
                                <img src="{{ asset('storage/' . $item->gitem_image) }}" alt="{{ $item->gitem_title }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <h5>Esta galería aún no tiene fotografías</h5>
                        <p class="text-muted mb-0">Pronto se agregarán imágenes.</p>
                    </div>
                </div>
            @endif

        </div>
    </section>

@endsection