<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/admin';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Auth routes (login, register, password reset, etc.)
        Route::middleware('web')
            ->prefix('admin')
            ->group(function () {
                require base_path('routes/auth.php');
            });

        // Admin routes (protected by auth)
        Route::middleware(['web', 'auth', 'verified'])
            ->prefix('admin')
            ->group(function () {
                require base_path('routes/admin.php');
            });

        // Main web routes with localization
        Route::middleware([
            'web',
            //'frontend',
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            'localize',
        ])
            ->prefix(LaravelLocalization::setLocale())
            ->group(function () {
                require base_path('routes/web.php');
            });
    }
}
