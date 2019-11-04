<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Locations
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
        if (!Session::has('locations')) {
            return redirect('/get-location-page');
        }
        return $next($request);
    }
}
