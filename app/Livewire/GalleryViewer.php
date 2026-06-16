<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Component;

class GalleryViewer extends Component
{
    public ?int $galleryId = null;

    public int $perPage = 12;

    public function mount(?int $galleryId = null)
    {
        $this->galleryId = $galleryId;
    }

    public function updatedGalleryId()
    {
        $this->perPage = 12;
    }

    public function loadMore()
    {
        $this->perPage += 12;
    }

    public function render()
    {
        $galleries = Gallery::query()
            ->where('gal_status', 'publicado')
            ->orderBy('gal_title')
            ->get();

        $items = collect();

        if ($this->galleryId) {
            $gallery = Gallery::with([
                'items' => function ($query) {
                    $query->orderBy('gitem_order');
                }
            ])->find($this->galleryId);

            if ($gallery) {
                $items = $gallery->items
                    ->take($this->perPage);
            }
        }

        return view('livewire.gallery-viewer', [
            'galleries' => $galleries,
            'items' => $items,
        ]);
    }
}