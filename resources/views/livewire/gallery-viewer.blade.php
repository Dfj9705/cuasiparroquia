<div>
    <div class="row mb-4">
        <div class="col-md-6">
            <select class="form-select" wire:model.live="galleryId">
                <option value="">
                    Todas las galerías
                </option>

                @foreach($galleries as $gallery)
                    <option value="{{ $gallery->id }}">
                        {{ $gallery->gal_title }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        @forelse($filteredGalleries as $gallery)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100">

                    @if($gallery->items->first())
                        <img src="{{ asset('storage/' . $gallery->items->first()->gitem_image) }}" class="card-img-top"
                            alt="{{ $gallery->gal_title }}" style="height: 220px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $gallery->gal_title }}</h5>

                        <p class="card-text text-muted">
                            {{ $gallery->gal_description }}
                        </p>

                        <a href="{{ route('public.galleries.show', $gallery->gal_slug) }}" class="btn btn-primary mt-auto">
                            Ver galería
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No hay galerías disponibles.
                </div>
            </div>
        @endforelse
    </div>
</div>