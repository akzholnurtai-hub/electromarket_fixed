<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    public function setLang($lang)
    {
        $supported = ['kk', 'ru', 'en'];

        if (in_array($lang, $supported)) {
            // Session-ға тілді сақтап, дереу қолданбаға да орнату
            session(['locale' => $lang]);
            App::setLocale($lang);
        }

        $back = request()->headers->get('referer', '/');
        return redirect($back)->withCookie(
            cookie()->forever('locale', $lang)
        );
    }
}
