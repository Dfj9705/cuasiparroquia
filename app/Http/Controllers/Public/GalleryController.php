<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::query()
            ->withCount('items')
            ->where('gal_status', 'publicado')
            ->latest('gal_published_at')
            ->paginate(9);

        return view('public.galleries.index', compact('galleries'));
    }

    public function show(Gallery $gallery)
    {
        abort_if($gallery->gal_status !== 'publicado', 404);

        $gallery->load([
            'items' => fn($query) => $query->orderBy('gitem_order'),
        ]);

        return view('public.galleries.show', compact('gallery'));
    }
}
