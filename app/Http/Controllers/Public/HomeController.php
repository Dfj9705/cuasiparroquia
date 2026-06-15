<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Post;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::query()
            ->where('ann_status', 'publicado')
            ->where(function ($query) {
                $query->whereNull('ann_published_at')
                    ->orWhere('ann_published_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('ann_expires_at')
                    ->orWhere('ann_expires_at', '>=', now());
            })
            ->orderBy('ann_priority', 'desc')
            ->latest('ann_published_at')
            ->take(5)
            ->get();

        $posts = Post::query()
            ->with('category')
            ->where('post_status', 'publicado')
            ->whereNotNull('post_published_at')
            ->where('post_published_at', '<=', now())
            ->latest('post_published_at')
            ->take(6)
            ->get();

        $galleries = Gallery::query()
            ->where('gal_status', 'publicado')
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact(
            'announcements',
            'posts',
            'galleries'
        ));
    }
}