<?php

namespace App\Providers\Filament;

use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Str;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Teal,
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'indigo' => Color::Indigo,
            ])
            //->font('Mulish')
            //->font('Lexend Deca', url: 'https://fonts.bunny.net/css?family=lexend-deca:300,400,500,600&display=swap')
            // ->font(
            //     'Be Vietnam Pro',
            //     url: 'https://fonts.bunny.net/css?family=be-vietnam-pro:300,400,500,600,700&display=swap'
            // )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->maxContentWidth('full')
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('16rem')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->favicon(asset('images/favico.png'))
            ->brandLogo(asset('images/logo-cro.png'))
            ->brandLogoHeight('3rem')
            ->navigationGroups([
                'Bài viết',
                'Dự án',
                'Phân quyền',
                'Hệ thống'
            ])
            ->navigationItems([
                NavigationItem::make('Log hệ thống')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->url(fn (): string => Str::start(config('log-viewer.route_path'), '/'))
                    ->group('Hệ thống')
                    ->sort(99)
                    ->visible(fn() => auth()->user()->isMasterAdmin()),
            ]);
    }
}
