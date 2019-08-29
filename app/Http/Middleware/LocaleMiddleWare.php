<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LocaleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = null;

        if (Auth::check() && !Session::has('locale')) {
            $locale = Auth::user()->locale;
            Session::put('locale', $locale);
        }

        if ($request->has('locale')) {
            $locale = $request->get('locale');
            Session::put('locale', $locale);
        }

        $locale = $request->session()->get('locale', config('app.fallback_locale'));

        App::setLocale($locale);

        return $next($request);
    }
}
