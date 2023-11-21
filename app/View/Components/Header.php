<?php

namespace App\View\Components;

use App\Settings\GeneralOptions;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(private GeneralOptions $settings)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header', [
            'settings' => $this->settings,
            'logo_url' => url($this->settings->site_logo)
        ]);
    }
}
