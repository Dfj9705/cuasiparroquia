<div>
    <div class="row mb-4">
        <div class="col-md-6">
            <select class="form-select" wire:model.live="galleryId">
                <option value="">
                    Seleccione una galería
                </option>

                @foreach($galleries as $gallery)
                    <option value="{{ $gallery->id }}">
                        {{ $gallery->gal_title }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    @if($galleryId)

        <div class="row">

            @forelse($items as $item)

                <div class="col-md-3 col-sm-6 mb-4">

                    <a href="{{ asset('storage/' . $item->gitem_image) }}" target="_blank">
                        <img src="{{ asset('storage/' . $item->gitem_image) }}" class="img-fluid rounded"
                            alt="{{ $item->gitem_title }}">
                    </a>

                </div>

            @empty

                <div class="col-12">
                    <div class="alert alert-info">
                        Esta galería no contiene imágenes.
                    </div>
                </div>

            @endforelse

        </div>

        @if($items->count() >= $perPage)

            <div class="text-center mt-4">
                <button class="btn btn-primary" wire:click="loadMore">
                    Cargar más
                </button>
            </div>

        @endif

    @endif
</div>