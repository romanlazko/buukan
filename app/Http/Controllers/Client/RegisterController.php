<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use App\Models\WebApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class RegisterController extends Controller
{
    public function create(WebApp $web_app) 
    {
        return view('user.client.register', compact(
            'web_app'
        ));
    }

    public function store(Request $request, WebApp $web_app) 
    {
        $client = $web_app->company->clients()->create([
            'email'         => $request->email,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'password'      => Hash::make($request->password),
        ]);

        $temporaryUrl = URL::temporarySignedRoute('user.client.appointment.create', now()->addMinutes(30), [
            'client' => $client,
            'web_app' => $web_app,
        ]);

        return redirect($temporaryUrl);
    }

    public function edit(WebApp $web_app, Client $client) 
    {
        return view('user.client.edit', compact(
            'client',
            'web_app'
        ));
    }

    // http://127.0.0.1:8002/app/1/15?expires=1699628400&signature=7ad74e7bfee1f1916e0b060774cf3bbbe5335a75139160aa19f1204c48ea7a93

    public function update(Request $request, WebApp $web_app, Client $client) 
    {
        $web_app->company->clients->find($client->id)->update([
            'email'         => $request->email,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'password'      => Hash::make($request->password),
        ]);

        $temporaryUrl = URL::temporarySignedRoute('user.client.appointment.create', now()->addMinutes(30), [
            'client' => $client,
            'web_app' => $web_app,
        ]);

        return redirect($temporaryUrl);
    }
}
