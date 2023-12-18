<?php

namespace App\Http\Controllers\WebApp\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\WebAppLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\WebApp;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(WebApp $web_app): View
    {
        return view('webapp.auth.login', compact('web_app'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(WebAppLoginRequest $request, WebApp $web_app): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('webapp.index', $web_app);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request, WebApp $web_app): RedirectResponse
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('webapp.login', $web_app);
    }
}
