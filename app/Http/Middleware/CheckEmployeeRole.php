<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEmployeeRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            if (auth()->user()->hasRole($role) OR auth()->user()->employee->hasRole($role, 'company')) {
                return $next($request);
            }
        }

        // Если у работника нет требуемой роли, выполните действия по вашему усмотрению, например, перенаправление на страницу с сообщением об ошибке.
        return redirect('/')->with('error', 'У вас нет прав для доступа к этой странице.');
    }
}