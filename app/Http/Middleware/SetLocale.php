<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = session('locale', config('app.locale'));

        if (! in_array($locale, config('translation.supported_locales'), true)) {
            $locale = config('translation.source_locale');
            session(['locale' => $locale]);
        }

        App::setLocale($locale);

        return $next($request);
    }
}
