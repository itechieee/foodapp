<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleMiddleware
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
        if ($request->user() && $request->user()->role_id == 2 && $request->is('admin')) {
            return \Response(view('errors.unauthorized')->with('role', 'Restaurant'));
        } 
        
        if ($request->user() && $request->user()->role_id == 1 && $request->is('restaurant')) {
            return \Response(view('errors.unauthorized')->with('role', 'Admin'));
        }
        return $next($request);
    }
}
