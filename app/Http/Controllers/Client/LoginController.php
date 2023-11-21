<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\WebApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    public function create(Request $request, WebApp $web_app) 
    {
        return view('user.client.login')->with([
            'web_app' => $web_app,
            'email' => $request->email,
        ]);
    }

    public function store(Request $request, WebApp $web_app) 
    {
        $client = $web_app->company->clients()->where('email', $request->email)->first();

        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                $temporaryUrl = URL::temporarySignedRoute('user.client.appointment.create', now()->addMinutes(30), [
                    'client' => $client,
                    'web_app' => $web_app,
                ]);
        
                return redirect($temporaryUrl);
            }
            return back();
        }
        return redirect()->route('user.client.email', compact(
            'web_app'
        ));
    }
}
