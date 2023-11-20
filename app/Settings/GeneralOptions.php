<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralOptions extends Settings
{
    public string $site_name;

    public string $site_email;

    public ?string $site_logo;

    public ?string $site_icon;

    public static function group(): string
    {
        return 'general';
    }
}