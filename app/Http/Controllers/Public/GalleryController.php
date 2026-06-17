<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::query()
            ->where('gal_status', 'publicado')
            ->latest()
            ->paginate(9);

        return view('public.galleries.index', compact('galleries'));
    }

    public function show(Gallery $gallery)
    {
        abort_if($gallery->gal_status !== 'publicado', 404);

        $gallery->load([
            'items' => function ($query) {
                $query
                    ->where('gitem_status', 'publicado')
                    ->orderBy('gitem_order')
                    ->orderByDesc('created_at');
            }
        ]);

        return view('public.galleries.show', compact('gallery'));
    }
}