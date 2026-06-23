<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $settings = SiteSetting::query()
            ->where('site_status', 'Activo')
            ->first();
        $announcements = Announcement::query()
            ->where('ann_status', 'publicado')
            ->latest('ann_published_at')
            ->take(3)
            ->get();

        $posts = Post::query()
            ->where('post_status', 'publicado')
            ->latest('post_published_at')
            ->take(3)
            ->get();

        return view('home', compact(
            'settings',
            'announcements',
            'posts'
        ));
    }
}
