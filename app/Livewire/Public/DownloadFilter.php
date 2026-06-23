<?php

namespace App\Livewire\Public;

use App\Models\Download;
use App\Models\DownloadCategory;
use Livewire\Component;
use Livewire\WithPagination;

class DownloadFilter extends Component
{
    use WithPagination;

    public ?int $category = null;

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = DownloadCategory::query()
            ->orderBy('dcat_name')
            ->get();

        $downloads = Download::query()
            ->with('category')
            ->where('down_status', 'publicado')
            ->when(
                $this->category,
                fn($query) => $query->where(
                    'download_category_id',
                    $this->category
                )
            )
            ->latest('down_published_at')
            ->paginate(12);

        return view(
            'livewire.public.download-filter',
            compact('categories', 'downloads')
        );
    }
}