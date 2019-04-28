<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RestaurantMiddleware
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
        if ($request->user() && $request->user()->role_id != 2) {
            return \Response(view('errors.unauthorized')->with('role', 'Restaurant'));
        }
        return $next($request);
    }
}
