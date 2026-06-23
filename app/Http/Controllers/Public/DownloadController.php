<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::query()
            ->with('category')
            ->where('down_status', 'publicado')
            ->latest('down_published_at')
            ->paginate(12);

        return view('public.downloads.index', compact('downloads'));
    }
}
