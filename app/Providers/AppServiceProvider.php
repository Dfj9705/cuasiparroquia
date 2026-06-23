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
            $view->with(
                'siteSettings',
                cache()->remember(
                    'site_settings',
                    now()->addHour(),
                    fn() => SiteSetting::first()
                )
            );
        });
    }
}
