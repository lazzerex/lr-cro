<?php

namespace App\Http\Controllers;

use App\Settings\GeneralSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __invoke(GeneralSettings $settings)
    {
        return view('settings', [
            'site_name' => $settings->site_name,
            'test_array' => $settings->test_array,
            'test_json' => $settings->test_json,
        ]);
    }
}
