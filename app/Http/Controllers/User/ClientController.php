<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function email(Request $request, Company $company)
    {
        $client = $company->clients->where('email', $request->email);

        if ($client) {
            return redirect()->route('user.client.password', compact(
                'company',
                'client'
            ));
        }

        return redirect()->route('user.client.register', compact(
            'company'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function password(Request $request, Company $company, Client $client)
    {
        $client = $company->clients->find($client->id);

        if ($client) {
            if ($client->password) {
                if ($client->password == Hash::make($request->password)) {

                }
            }
            
            return redirect()->route('user.web_app.password', compact(
                'company',
                'client'
            ));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request, Company $company)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function authenticate(Request $request, Company $company, Client $client)
    {
        
    }
}
