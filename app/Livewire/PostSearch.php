<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostSearch extends Component
{
    use WithPagination;

    public string $search = '';

    protected string $paginationTheme = 'bootstrap';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::query()
            ->with('category')
            ->where('post_status', 'publicado')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('post_title', 'like', '%' . $this->search . '%')
                        ->orWhere('post_summary', 'like', '%' . $this->search . '%')
                        ->orWhere('post_content', 'like', '%' . $this->search . '%');
                });
            })
            ->where(function ($query) {
                $query->whereNull('post_published_at')
                    ->orWhere('post_published_at', '<=', now());
            })
            ->latest('post_published_at')
            ->paginate(9);

        return view('livewire.post-search', [
            'posts' => $posts,
        ]);
    }
}