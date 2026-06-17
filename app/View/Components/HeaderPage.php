<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderPage extends Component
{

    public $titlePage;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $site_header_image = \App\Models\SiteSetting::first()->site_header_image;
        return view('components.header-page', compact('site_header_image'));
    }
}
