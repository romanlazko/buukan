<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCompany
{
    public function handle($request, Closure $next)
    {
        Company::find($request->company);

        if (auth()->user()->company == $request->company OR auth()->user()->company == $request->company) {
            return $next($request);
        }

        // Если у работника нет требуемой роли, выполните действия по вашему усмотрению, например, перенаправление на страницу с сообщением об ошибке.
        return redirect()->route('dashboard')->with('error', 'У вас нет прав для доступа к этой странице.');
    }
}