<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\WebApp;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function create(WebApp $web_app) 
    {
        return view('user.client.email', compact(
            'web_app'
        ));
    }

    public function store(Request $request, WebApp $web_app) 
    {
        $client = $web_app->company->clients->where('email', $request->email)->first();

        if ($client) {
            if ($client->password) {
                return redirect()->route('user.client.login.create', [
                    $web_app,
                    'email' => $request->email
                ]);
            }
            return redirect()->route('user.client.register.edit', [
                $web_app,
                $client
            ]);
        }

        return redirect()->route('user.client.register.create', [
            $web_app,
            'email' => $request->email
        ]);
    }
}
