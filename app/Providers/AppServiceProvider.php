<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Mail;

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
        Schema::defaultStringLength(191);

        // Forzar envíos email al desarrollador si el entorno NO es `production`
        if (!app()->environment('production')) {
            Mail::alwaysTo(env('MAIL_TO_DEVELOPER'));
        }
    }
}
