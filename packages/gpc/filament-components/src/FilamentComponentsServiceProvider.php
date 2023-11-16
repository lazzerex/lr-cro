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
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'gpc-filament-components');

        $this->registerTinyMceAssets();
    }

    protected function registerTinyMceAssets()
    {
        // $tiny_languages = [
        //     'tinymce-lang-vi' => 'https://cdn.jsdelivr.net/npm/tinymce-i18n@23.11.6/langs6/vi.js',
		// ];

        // $languages = [];
        // $optional_languages = config('gpc-filament-components.tinymce.languages', []);
        // if (!is_array($optional_languages))
        // {
        //     $optional_languages = [];
        // }

        // foreach ($tiny_languages as $locale => $language) {
        //     $locale = str_replace('tinymce-lang-', '', $locale);
        //     $languages[] = Js::make(
        //         'tinymce-lang-' . $locale,
        //         array_key_exists($locale, $optional_languages) ? $optional_languages[$locale] : $language
        //     )->loadedOnRequest();
        // }
        // dd($languages);
        FilamentAsset::register([
			Js::make('tinymce', 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.3/tinymce.min.js'),
            Js::make('tinymce-lang-vi', 'https://cdn.jsdelivr.net/npm/tinymce-i18n@23.11.6/langs6/vi.js')->loadedOnRequest(),
            //...$languages
		], package: 'gpc/gpc-filament-components');
    }
}
