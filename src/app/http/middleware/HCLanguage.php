<?php

namespace interactivesolutions\honeycomblanguages\app\http\middleware;

use Closure;
use Illuminate\Http\Request;

class HCLanguage
{
    public function handle(Request $request, Closure $next)
    {
        $firstSegment = $request->segment(1);

        $noLanguage = config('hc.noLanguage');
        array_push($noLanguage, config('hc.admin_url'));

        if (in_array($firstSegment, $noLanguage))
            return $next($request);
        elseif (in_array($firstSegment, getHCFrontEndLanguages())) {
            app()->setLocale($firstSegment);
            return $next($request);
        }
        elseif ($firstSegment == null)
            return redirect($request->fullUrl() . '/' . app()->getLocale());

        $segments = $request->segments();

        if (strlen($segments[0]) == 2)
            $segments[0] = app()->getLocale();
        else
            $segments = array_prepend($segments, app()->getLocale());

        return redirect(implode('/', $segments));
    }
}