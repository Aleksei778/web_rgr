<?php

// РЕШЕНИЕ 1: Исправленный контроллер
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function switch()
    {
        // Получаем текущую локаль из сессии, а не из app()
        $currentLocale = Session::get('locale', config('app.locale', 'ru'));
        Log::info('Current locale from session: ' . $currentLocale);
        
        $newLocale = $currentLocale === 'ru' ? 'en' : 'ru';
        Log::info('New locale: ' . $newLocale);
        
        // Сохраняем в сессию
        Session::put('locale', $newLocale);
        
        // Применяем локаль немедленно для текущего запроса (опционально)
        App::setLocale($newLocale);
        
        return Redirect::back();
    }
}