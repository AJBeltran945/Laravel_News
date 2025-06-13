<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locales = config('locales.locales');
        $default = config('locales.default');

        $locale = $request->get('lang')
            ?? Session::get('locale')
            ?? $default;

        if (in_array($locale, $locales)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        } else {
            App::setLocale($default);
        }

        return $next($request);
    }
}
