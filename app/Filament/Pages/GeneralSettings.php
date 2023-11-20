<?php

namespace App\Filament\Pages;

use App\Filament\Traits\HasSettingPagesSidebar;
use App\Settings\GeneralOptions;
use AymanAlhattami\FilamentPageWithSidebar\FilamentPageSidebar;
use AymanAlhattami\FilamentPageWithSidebar\PageNavigationItem;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Gpc\FilamentComponents\Forms\Components\ImagePicker;
use Illuminate\Contracts\Support\Htmlable;

class GeneralSettings extends SettingsPage
{
    use HasPageSidebar;
    use HasSettingPagesSidebar;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralOptions::class;

    public static function getNavigationGroup(): ?string
    {
        return __('Hệ thống');
    }

    public static function getNavigationLabel(): string
    {
        return __('Cấu hình');
    }

    public function getTitle(): string | Htmlable
    {
        return __('Tổng quan');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Thông tin chung')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Tên website')
                            ->required(),
                        TextInput::make('site_email')
                            ->label('Email website')
                            ->email()
                            ->required(),
                        ImagePicker::make('site_logo')
                            ->label('Logo'),
                        ImagePicker::make('site_icon')
                            ->label('Website icon')
                    ])->columns(['md' => 2]),
            ]);
    }
}
