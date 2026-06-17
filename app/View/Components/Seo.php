<?php

namespace App\View\Components;

use App\Models\SiteSetting;
use Illuminate\View\Component;

class Seo extends Component
{
    public string $title;
    public string $description;
    public ?string $image;
    public string $url;
    public ?string $favicon;

    public function __construct(
        ?string $title = null,
        ?string $description = null,
        ?string $image = null,
    ) {
        $settings = SiteSetting::query()->first();

        $siteName = $settings?->site_name ?? config('app.name');

        $this->title = $title
            ? $title . ' | ' . $siteName
            : ($settings?->site_meta_title ?? $siteName);

        $this->description = $description
            ?? $settings?->site_meta_description
            ?? $settings?->site_slogan
            ?? '';

        $this->image = $image
            ?? ($settings?->site_og_image
                ? asset('storage/' . $settings->site_og_image)
                : null);

        $this->url = url()->current();
        $this->favicon = $settings?->site_favicon
            ? asset('storage/' . $settings->site_favicon)
            : null;
    }

    public function render()
    {
        return view('components.seo');
    }
}