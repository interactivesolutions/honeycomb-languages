<?php

namespace interactivesolutions\honeycomblanguages\app\http\middleware;

use Closure;

class HCLanguage
{
    public function handle ($request, Closure $next)
    {
        $locale = app()->getLocale();

        if ($request->segment (1) == env('HC_ADMIN_URL'))
            app()->setLocale(session('back-end', $locale));
        else
            app()->setLocale(session('front-end', $locale));


        return $next($request);
    }
}