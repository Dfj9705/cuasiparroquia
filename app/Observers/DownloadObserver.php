<?php

namespace App\Observers;

use App\Models\Download;
use Illuminate\Support\Facades\Storage;

class DownloadObserver
{
    public function saving(Download $download): void
    {
        if (!$download->down_file) {
            return;
        }

        $path = Storage::disk('public')->path($download->down_file);

        if (!file_exists($path)) {
            return;
        }

        $download->down_file_size = filesize($path);
        $download->down_file_type = mime_content_type($path);
    }
}