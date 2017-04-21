<?php

namespace interactivesolutions\honeycomblanguages\app\http\middleware;

use Closure;

class HCLanguage
{
    public function handle ($request, Closure $next)
    {
        if ($request->segment (1) == 'admin')
            app()->setLocale(session('back-end'));
        else
            app()->setLocale(session('front-end'));


        return $next($request);
    }
}