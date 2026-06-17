@extends('layouts.public')

@section('title', $gallery->gal_title)

@section('content')
    <div class="container py-5">

        <div class="mb-4">
            <a href="{{ route('public.galleries.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
                <i class="bi bi-arrow-left me-2"></i> Volver a galerías
            </a>

            <h1 class="fw-bold mb-2">{{ $gallery->gal_title }}</h1>

            @if($gallery->gal_description)
                <p class="text-muted">{{ $gallery->gal_description }}</p>
            @endif
        </div>

        @if($gallery->items->count())
            <div id="gallery-grid" class="gallery-grid">
                @foreach($gallery->items as $item)
                    <div class="gallery-item">
                        <a href="{{ Storage::url($item->gitem_image) }}" class="gallery-lightbox"
                            data-gallery="gallery-{{ $gallery->id }}" data-title="{{ $item->gitem_title }}">
                            <img src="{{ Storage::url($item->gitem_image) }}" alt="{{ $item->gitem_title ?? $gallery->gal_title }}"
                                loading="lazy">
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                Esta galería aún no tiene fotografías publicadas.
            </div>
        @endif

    </div>
@endsection

@push('scripts')
    @vite('resources/js/gallery.js')
@endpush