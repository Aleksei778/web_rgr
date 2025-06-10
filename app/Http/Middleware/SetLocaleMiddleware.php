<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = Session::get('locale', config('app.locale', 'ru'));
        Log::info('SetLocaleMiddleware: Retrieved locale from session: ' . $locale);
        
        if (!in_array($locale, ['ru', 'en'])) {
            $locale = config('app.fallback_locale', 'ru');
            Session::put('locale', $locale);
            Log::info('SetLocaleMiddleware: Fallback to locale: ' . $locale);
        }
        
        App::setLocale($locale);
        Log::info('SetLocaleMiddleware: Applied locale: ' . App::getLocale());
        
        return $next($request);
    }
}