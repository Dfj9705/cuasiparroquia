<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->where('post_status', 'publicado')
            ->latest('post_published_at')
            ->paginate(9);

        return view('public.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        abort_if($post->post_status !== 'publicado', 404);

        return view('public.posts.show', compact('post'));
    }
}
