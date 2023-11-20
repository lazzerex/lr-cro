<?php
namespace App\Filament\Traits;

use App\Filament\Pages\GeneralSettings;
use App\Filament\Pages\SeoSettings;
use AymanAlhattami\FilamentPageWithSidebar\FilamentPageSidebar;
use AymanAlhattami\FilamentPageWithSidebar\PageNavigationItem;

trait HasSettingPagesSidebar
{
    public static function sidebar(): FilamentPageSidebar
    {
        return FilamentPageSidebar::make()
            ->setTitle('Cấu hình')
            ->setNavigationItems([
                PageNavigationItem::make('Tổng quan')
                    ->translateLabel()
                    ->url(GeneralSettings::getUrl())
                    ->icon('heroicon-o-cog-6-tooth')
                    ->isActiveWhen(function () {
                        return request()->routeIs(GeneralSettings::getRouteName());
                    })
                    ->visible(true),
                PageNavigationItem::make('SEO')
                    ->translateLabel()
                    ->url(SeoSettings::getUrl())
                    ->icon('heroicon-o-cog-6-tooth')
                    ->isActiveWhen(function () {
                        return request()->routeIs(SeoSettings::getRouteName());
                    })
                    ->visible(true),
            ]);
    }
}