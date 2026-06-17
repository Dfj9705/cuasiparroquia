<?php

namespace App\Providers;

use App\Models\Download;
use App\Models\SiteSetting;
use App\Observers\DownloadObserver;
use Cache;
use Illuminate\Support\ServiceProvider;
use View;

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
        View::composer('*', function ($view) {

            $settings = Cache::rememberForever(
                'site_settings',
                fn() => SiteSetting::first()
            );

            $view->with('siteSettings', $settings);
        });
    }
}
