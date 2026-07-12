<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
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
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Models\CompanyBranding;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $branding = null;

        try {
            if (!app()->runningInConsole() && Schema::hasTable((new CompanyBranding())->getTable())) {
                $branding = CompanyBranding::first();
            }
        } catch (\Throwable $e) {
            $branding = null;
        }

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName($branding?->company_name ?? config('app.name', 'NyoUniverse'))
            ->brandLogo($branding && $branding->logo_path
                ? Storage::url($branding->logo_path)
                : null)
            ->brandLogoHeight('2rem')
            ->favicon($branding && $branding->logo_path
                ? Storage::url($branding->logo_path)
                : null)
            ->login()
            ->registration()
            ->passwordReset()
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->sidebarCollapsibleOnDesktop()
            ->spa();
    }
}
