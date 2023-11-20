<?php

namespace App\Filament\Pages;

use App\Filament\Traits\HasSettingPagesSidebar;
use App\Settings\SeoOptions;
use AymanAlhattami\FilamentPageWithSidebar\FilamentPageSidebar;
use AymanAlhattami\FilamentPageWithSidebar\PageNavigationItem;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;

class SeoSettings extends SettingsPage
{
    use HasPageSidebar;
    use HasSettingPagesSidebar;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SeoOptions::class;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function getTitle(): string | Htmlable
    {
        return __('SEO');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Meta')
                    ->schema([
                        TextInput::make('meta_title'),
                        TextInput::make('meta_keyword'),
                        Textarea::make('meta_description')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(['md' => 2]),

                Section::make('Open Graph')
                    ->schema([
                        TextInput::make('og_title'),
                        Textarea::make('og_description')->rows(4),
                    ]),

                Section::make('Twitter')
                    ->schema([
                        TextInput::make('twitter_title'),
                        Textarea::make('twitter_description')->rows(4),
                    ]),
            ]);
    }
}
