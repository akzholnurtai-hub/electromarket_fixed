<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class Localization
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1) Session-дан оқу
        $locale = session('locale');

        // 2) Session бос болса — cookie-ден оқу (backup)
        if (!$locale) {
            $locale = $request->cookie('locale');
        }

        // 3) Дұрыс тіл болса — орнату
        if ($locale && in_array($locale, ['kk', 'ru', 'en'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
