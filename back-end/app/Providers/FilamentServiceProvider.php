<?php

namespace App\Providers;

use App\Filament\Resources\SeekerResource;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
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
        Filament::serving(function () {
            $user = Auth::user();
            if ($user && $user->roles()->whereIn('name', ['admin', 'moderator'])->exists()) {
                Filament::registerUserMenuItems([
                    UserMenuItem::make()
                        ->label('Manager Seekers')
                        ->url(SeekerResource::getUrl())
                        ->icon('heroicon-s-users'),
                ]);
            }
        });
        //
    }
}
