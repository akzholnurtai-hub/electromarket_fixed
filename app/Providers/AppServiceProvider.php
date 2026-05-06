<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;  // ← жоғарыға қос
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

{
    Schema::defaultStringLength(191);  // ← осыны қос

    Gate::before(function ($user, $ability) {
        return $user->hasRole('super-admin') ? true : null;
    });
}
        Gate::before(function ($user, $ability) {
        return $user->hasRole('super-admin') ? true : null;
    });
    }
}
