<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Closure;

class AdminAuthenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {

            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
