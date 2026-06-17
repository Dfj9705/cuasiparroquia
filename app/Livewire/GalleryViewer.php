<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Component;

class GalleryViewer extends Component
{
    public ?int $galleryId = null;

    public function updatedGalleryId(): void
    {
        // Solo refresca el filtro
    }

    public function render()
    {
        $galleries = Gallery::query()
            ->where('gal_status', 'publicado')
            ->orderBy('gal_title')
            ->get();

        $filteredGalleries = Gallery::query()
            ->where('gal_status', 'publicado')
            ->when($this->galleryId, function ($query) {
                $query->where('id', $this->galleryId);
            })
            ->with([
                'items' => function ($query) {
                    $query
                        ->where('gitem_status', 'publicado')
                        ->orderBy('gitem_order');
                }
            ])
            ->orderBy('gal_title')
            ->get();

        return view('livewire.gallery-viewer', [
            'galleries' => $galleries,
            'filteredGalleries' => $filteredGalleries,
        ]);
    }
}