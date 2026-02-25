<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $first = $request->segment(1);

        if (in_array($first, ['ar', 'en'])) {
            app()->setLocale($first);
            session(['locale' => $first]);
        } else {
            app()->setLocale(session('locale', 'ar'));
        }

        return $next($request);
    }
}
