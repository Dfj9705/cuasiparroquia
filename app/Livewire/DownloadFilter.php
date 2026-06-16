<?php

namespace App\Livewire;

use App\Models\Download;
use App\Models\DownloadCategory;
use Livewire\Component;
use Livewire\WithPagination;

class DownloadFilter extends Component
{
    use WithPagination;

    public string $search = '';
    public string $category = '';

    protected string $paginationTheme = 'bootstrap';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = DownloadCategory::query()
            ->where('dcat_status', 'publicado')
            ->orderBy('dcat_name')
            ->get();

        $downloads = Download::query()
            ->with('category')
            ->where('down_status', 'publicado')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('down_title', 'like', '%' . $this->search . '%')
                        ->orWhere('down_description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category, function ($query) {
                $query->where('download_category_id', $this->category);
            })
            ->where(function ($query) {
                $query->whereNull('down_published_at')
                    ->orWhere('down_published_at', '<=', now());
            })
            ->latest('down_published_at')
            ->paginate(12);

        return view('livewire.download-filter', [
            'categories' => $categories,
            'downloads' => $downloads,
        ]);
    }
}