<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->with('category')
            ->where('post_status', 'publicado')
            ->whereNotNull('post_published_at')
            ->where('post_published_at', '<=', now())
            ->latest('post_published_at')
            ->paginate(9);


        $categories = PostCategory::query()
            ->where('pcat_status', 'publicado')
            ->orderBy('pcat_name')
            ->get();

        return view('public.posts.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        abort_if(
            $post->post_status !== 'publicado' ||
            is_null($post->post_published_at) ||
            $post->post_published_at->isFuture(),
            404
        );

        $post->load('category');

        $relatedPosts = Post::query()
            ->where('id', '!=', $post->id)
            ->where('post_category_id', $post->post_category_id)
            ->where('post_status', 'publicado')
            ->whereNotNull('post_published_at')
            ->where('post_published_at', '<=', now())
            ->latest('post_published_at')
            ->take(3)
            ->get();

        return view('public.posts.show', compact('post', 'relatedPosts'));
    }
}
