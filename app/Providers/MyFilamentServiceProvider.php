<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Placeholder;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\BaseFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class MyFilamentServiceProvider extends ServiceProvider
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
        $this->autoTranslateLabels();
        Table::$defaultDateTimeDisplayFormat = 'd-m-Y H:i';
        Table::$defaultDateDisplayFormat = 'd-m-Y';

        DateTimePicker::$defaultDateDisplayFormat = 'd-m-Y';
        DateTimePicker::$defaultDateTimeDisplayFormat = 'd-m-Y, H:i';
        DateTimePicker::$defaultDateTimeWithSecondsDisplayFormat = 'd-m-Y, H:i:s';

        Column::configureUsing(function (Column $column): void {
            $column->grow(false);
        });

        Stack::configureUsing(function (Stack $stack): void {
            $stack->grow(false);
        });

        FilamentAsset::register([
            Css::make('admin', asset('css/admin.css')),
        ]);
    }

    private function autoTranslateLabels()
    {
        $this->translateLabels([
            Field::class,
            BaseFilter::class,
            Placeholder::class,
            Column::class,
            // or even `BaseAction::class`,
        ]);
    }

    private function translateLabels(array $components = [])
    {
        foreach($components as $component) {
            $component::configureUsing(function ($c): void {
                $c->translateLabel();
            });
        }
    }
}