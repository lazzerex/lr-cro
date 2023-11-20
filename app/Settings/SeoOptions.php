<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SeoOptions extends Settings
{
    public ?string $meta_title;
    public ?string $meta_keyword;
    public ?string $meta_description;

    public ?string $og_title;
    public ?string $og_description;

    public ?string $twitter_title;
    public ?string $twitter_description;

    public static function group(): string
    {
        return 'seo';
    }
}