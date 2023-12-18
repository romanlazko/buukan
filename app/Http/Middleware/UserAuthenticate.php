<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Closure;

class UserAuthenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('user')->check()) {
            return redirect()->route('webapp.login', $request->web_app);
        }

        Auth::shouldUse('user');

        return $next($request);
    }
}

