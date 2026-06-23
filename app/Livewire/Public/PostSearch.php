<?php

namespace App\Livewire\Public;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostSearch extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::query()
            ->where('post_status', 'publicado')
            ->when(
                $this->search,
                fn($query) =>
                $query->where(function ($q) {
                    $q->where('post_title', 'like', "%{$this->search}%")
                        ->orWhere('post_content', 'like', "%{$this->search}%");
                })
            )
            ->latest('post_published_at')
            ->paginate(9);

        return view('livewire.public.post-search', compact('posts'));
    }
}