<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class GeneralConfigs extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('site_name')
                    ->label('Site name')
                    ->required(),
                TextInput::make('site_brand')
                    ->label('Site brand')
                    ->required(),
                Repeater::make('test_array')
                    ->schema([
                        TextInput::make('label')->required(),
                        TextInput::make('url')
                            ->required(),
                    ]),
                Group::make([
                    TextInput::make('logo_url'),
                    TextInput::make('logo_image'),
                    TextInput::make('icon_url'),
                ])->statePath('test_json'),
            ]);
    }
}
