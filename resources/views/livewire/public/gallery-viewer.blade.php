<div>

    <div class="gallery-masonry">

        @foreach ($items as $item)
            <div class="gallery-masonry-item">

                <a href="{{ asset('storage/' . $item->gitem_image) }}" data-fancybox="gallery-{{ $gallery->id }}"
                    data-caption="{{ $item->gitem_title }}">
                    <img src="{{ asset('storage/' . $item->gitem_image) }}" alt="{{ $item->gitem_title }}">
                </a>

            </div>
        @endforeach

    </div>

    @if ($items->count() < $totalItems)
        <div class="text-center mt-4">
            <button class="btn btn-primary" wire:click="loadMore">
                Ver más fotografías
            </button>
        </div>
    @endif

</div>