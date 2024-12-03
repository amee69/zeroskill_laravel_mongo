<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Ensure the user is authenticated and has the specified role
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Return a 401 Unauthorized response if role check fails
        return abort(401, 'Unauthorized');
    }
}
