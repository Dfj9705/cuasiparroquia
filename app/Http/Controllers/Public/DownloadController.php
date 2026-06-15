<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\DownloadCategory;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::query()
            ->with('category')
            ->where('down_status', 'publicado')
            ->whereNotNull('down_published_at')
            ->where('down_published_at', '<=', now())
            ->latest('down_published_at')
            ->paginate(12);

        $categories = DownloadCategory::query()
            ->where('dcat_status', 'publicado')
            ->orderBy('dcat_name')
            ->get();

        return view('public.downloads.index', compact('downloads', 'categories'));
    }
}