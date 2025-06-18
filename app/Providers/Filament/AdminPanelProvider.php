<?php

namespace App\Providers\Filament;

use Filament\Facades\Filament;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
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
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\Authenticate as FilamentAuthenticate;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\Facades\Auth;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->homeUrl('/admin')
            ->colors([
                'primary' => Color::Amber,
                'secondary' => Color::Gray,
                'success' => Color::Green,
                'danger' => Color::Red,
                'warning' => Color::Yellow,
                'info' => Color::Blue,
            ])
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
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                FilamentAuthenticate::class,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                $user = Auth::user();
                if (!$user) return $builder;

                $groups = [];

                // Dashboard (ungrouped or neutral group)
                $groups[] = NavigationGroup::make()->items([
                    NavigationItem::make('Dashboard')
                        ->icon('heroicon-o-home')
                        ->url(route('filament.admin.pages.dashboard'))
                        ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.pages.dashboard')),
                ]);

                if ($user->role === 'admin') {
                    $groups[] = NavigationGroup::make('Layanan')->items([
                        NavigationItem::make('Layanan')
                            ->icon('heroicon-o-cog')
                            ->url(route('filament.admin.resources.layanans.index'))
                            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.layanans.*')),
                        NavigationItem::make('Detail Layanan')
                            ->icon('heroicon-o-document-text')
                            ->url(route('filament.admin.resources.detail-layanans.index'))
                            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.detail-layanans.*')),
                    ]);

                    $groups[] = NavigationGroup::make('Management')->items([
                        NavigationItem::make('Users')
                            ->icon('heroicon-o-users')
                            ->url(route('filament.admin.resources.users.index'))
                            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.users.*')),
                    ]);

                    $groups[] = NavigationGroup::make('Master Data')->items([
                        NavigationItem::make('Montir')
                            ->icon('heroicon-o-wrench')
                            ->url(route('filament.admin.resources.montirs.index'))
                            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.montirs.*')),

                        NavigationItem::make('Jenis Layanan')
                            ->icon('heroicon-o-rectangle-stack')
                            ->url(route('filament.admin.resources.jenis-layanans.index'))
                            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.jenis-layanans.*')),

                        NavigationItem::make('Kategori Montir')
                            ->icon('heroicon-o-briefcase')
                            ->url(route('filament.admin.resources.kategori-montirs.index'))
                            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.kategori-montirs.*')),
                    ]);
                } elseif ($user->role === 'manager') {
                    $groups[] = NavigationGroup::make('Master Data')->items([
                        NavigationItem::make('Montir')
                            ->icon('heroicon-o-wrench')
                            ->url(route('filament.admin.resources.montirs.index'))
                            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.montirs.*')),
                    ]);

                    $groups[] = NavigationGroup::make('Layanan')->items([
                        NavigationItem::make('Layanan')
                            ->icon('heroicon-o-cog')
                            ->url(route('filament.admin.resources.layanans.index'))
                            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.layanans.*')),
                    ]);
                } elseif ($user->role === 'montir') {
                    $groups[] = NavigationGroup::make('Layanan')->items([
                        NavigationItem::make('Layanan')
                            ->icon('heroicon-o-cog')
                            ->url(route('filament.admin.resources.layanans.index'))
                            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.layanans.*')),
                    ]);
                }

                return $builder->groups($groups);
            });
    }
}
