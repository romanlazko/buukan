<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEmployeeRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // dd(auth()->user());
        foreach ($roles as $role) {
            if (auth()->user()->hasRole($role)) {
                if (auth()->user()->company?->id == $request->company->id OR auth()->user()->employee?->company->id == $request->company->id OR auth()->user()->hasRole('super-duper-admin')) {
                    return $next($request);
                }
            }
        }

        return redirect()->route('admin.dashboard');
    }
}