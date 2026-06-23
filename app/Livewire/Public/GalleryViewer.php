<?php

namespace App\Livewire\Public;

use App\Models\Gallery;
use Livewire\Component;

class GalleryViewer extends Component
{
    public Gallery $gallery;

    public int $perPage = 24;

    public function loadMore(): void
    {
        $this->perPage += 24;
    }

    public function render()
    {
        $items = $this->gallery
            ->items()
            ->orderBy('gitem_order')
            ->limit($this->perPage)
            ->get();

        $totalItems = $this->gallery->items()->count();

        return view(
            'livewire.public.gallery-viewer',
            compact('items', 'totalItems')
        );
    }
}