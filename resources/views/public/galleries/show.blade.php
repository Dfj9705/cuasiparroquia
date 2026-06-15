@extends('layouts.public')

@section('title', $gallery->gall_title)
@section('meta_description', $gallery->gall_description ?? 'Detalle de galería institucional.')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="fw-bold">{{ $gallery->gall_title }}</h1>

            @if($gallery->gall_description)
                <p class="text-muted mb-0">
                    {{ $gallery->gall_description }}
                </p>
            @endif
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                @forelse($gallery->items as $item)
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            @if($item->gitem_image)
                                <img src="{{ Storage::url($item->gitem_image) }}" class="card-img-top"
                                    alt="{{ $item->gitem_title }}">
                            @endif

                            @if($item->gitem_title || $item->gitem_description)
                                <div class="card-body">
                                    @if($item->gitem_title)
                                        <h5>{{ $item->gitem_title }}</h5>
                                    @endif

                                    @if($item->gitem_description)
                                        <p class="text-muted mb-0">
                                            {{ $item->gitem_description }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            Esta galería aún no tiene imágenes publicadas.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection