<?php

namespace App\Http\Middleware\Custom;

use Closure;

class Locale
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
        //Get locale
        $locale = auth()->user()->locale;

        //Set locale
        if(app()->getLocale() != $locale) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
