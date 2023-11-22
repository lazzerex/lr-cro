<?php

use App\Settings\GeneralOptions;

if (! function_exists('general_options')) {
    function general_options()
    {
        return app(GeneralOptions::class);
    }
}