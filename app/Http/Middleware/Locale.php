<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Locale {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = auth()?->user()?->locale ?? session('locale', config('app.locale'));

        app()->setLocale($locale);

        return $next($request);
    }

}