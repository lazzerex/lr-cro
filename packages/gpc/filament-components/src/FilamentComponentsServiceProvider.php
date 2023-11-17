<?php

namespace Gpc\FilamentComponents;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class FilamentComponentsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/gpc-filament-components.php', 'gpc-filament-components');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
              __DIR__.'/../config/config.php' => config_path('gpc-filament-components.php'),
            ], 'config');

            // Publish assets
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/gpc-filament-components'),
            ], 'assets');
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'gpc-filament-components');

        $this->registerTinyMceAssets();
    }

    protected function registerTinyMceAssets()
    {
        FilamentAsset::register([
            Js::make('gpc-filament-components', __DIR__ . '/../resources/js/script.js'),
			Js::make('tinymce', 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.3/tinymce.min.js'),
            Js::make('tinymce-lang-vi', 'https://cdn.jsdelivr.net/npm/tinymce-i18n@23.11.6/langs6/vi.js')->loadedOnRequest(),
		], package: 'gpc/gpc-filament-components');
    }
}
