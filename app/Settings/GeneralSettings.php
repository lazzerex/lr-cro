<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;

    public array $test_array;

    public array $test_json;

    public string $site_brand;

    public static function group(): string
    {
        return 'general';
    }
}