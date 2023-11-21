<?php

namespace App\Http\Middleware;

use Closure;

class CheckTemporaryUrl
{
    public function handle($request, Closure $next)
    {
        if (! $request->hasValidSignature()) {
            return redirect()->route('user.client.email', $request->web_app);
        }

        return $next($request);
    }
}