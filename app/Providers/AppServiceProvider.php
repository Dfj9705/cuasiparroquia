<?php

namespace App\Providers;

use App\Models\Download;
use App\Observers\DownloadObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Download::observe(DownloadObserver::class);
    }
}
