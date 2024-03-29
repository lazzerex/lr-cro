<?php

namespace App\Providers;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerCarbonMacros();
        $this->registerFilamentMacros();
        $this->registerArrayMacros();
    }

    private function registerCarbonMacros()
    {
        Carbon::macro('formatDateDMY', function () {
            return $this->format('d-m-Y');
        });

        Carbon::macro('formatDateMDY', function () {
            return $this->format('m-d-Y');
        });

        Carbon::macro('formatDateISO', function () {
            return $this->format('Y-m-d');
        });

        Carbon::macro('formatDateTimeDMY', function () {
            return $this->format('d-m-Y H:i');
        });

        Carbon::macro('formatDateTimeMDY', function () {
            return $this->format('m-d-Y H:i');
        });

        Carbon::macro('formatDateTimeISO', function () {
            return $this->format('Y-m-d H:i');
        });

        Carbon::macro('formatTime', function () {
            return $this->format('H:i');
        });
    }

    private function registerFilamentMacros()
    {
        TextColumn::macro('dateDMY', function () {
            return $this->date('d-m-Y');
        });

        TextColumn::macro('dateMDY', function () {
            return $this->date('m-d-Y');
        });

        TextColumn::macro('dateISO', function () {
            return $this->date('Y-m-d');
        });

        TextColumn::macro('dateTimeDMY', function () {
            return $this->dateTime('d-m-Y H:i');
        });

        TextColumn::macro('dateTimeMDY', function () {
            return $this->dateTime('m-d-Y H:i');
        });

        TextColumn::macro('dateTimeISO', function () {
            return $this->dateTime('Y-m-d H:i');
        });
    }

    private function registerArrayMacros()
    {
        Arr::macro('whereRecursive', function ($array, callable $callback) {
            foreach ($array as &$value)
            {
                if (is_array($value))
                {
                    $value = $callback === null ? Arr::whereRecursive($value) : Arr::whereRecursive($value, $callback);
                }
            }

            return $callback === null ? array_filter($array) : array_filter($array, $callback);
        });

        Arr::macro('whereNotNullRecursive', function ($array) {
            return Arr::whereRecursive($array, fn ($value) => ! is_null($value));
        });
    }
}
