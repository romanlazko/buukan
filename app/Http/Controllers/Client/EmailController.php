<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\WebApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\WebAppEditUser;

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
        $client = $web_app->company->clients->where('email', $request->email)->where('password')->first();

        if ($client) {
            return redirect()->route('user.client.login.create', [
                $web_app,
                'email' => $request->email
            ]);

            // $url = URL::temporarySignedRoute('user.client.register.edit', now()->addMinutes(30), [
            //     'client' => $client,
            //     'web_app' => $web_app,
            // ]);

            // Mail::to($request->email)->send(new WebAppEditUser($url));

            // return back();
        }

        return redirect()->route('user.client.register.create', [
            $web_app,
            'email' => $request->email
        ]);
    }
}
