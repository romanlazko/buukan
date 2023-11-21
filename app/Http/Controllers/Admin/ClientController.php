<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Company $company)
    {
        $clients = $company->clients()
            ->when($request->has('search'), function($query) use($request) {
                return $query->where('first_name', 'like', "%{$request->search}%")
                    ->orWhere('last_name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%")
                    ->orWhere('phone', 'like', "%{$request->search}%");
            })
            ->get();

        return view('admin.company.client.index', compact(
            'clients',
            'company'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        return view('admin.company.client.create', compact(
            'company'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, Client $client)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company, Client $client)
    {
        $client = $company->clients->find($client->id);

        if (!$client) {
            return back()->with([
                'ok' => false,
                'description' => "Client not found"
            ]);
        }

        return view('admin.company.client.edit', compact([
            'company',
            'client'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company, Client $client)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'sometimes', 'string']
        ]);

        $client = $company->clients->find($client->id);

        if (!$client) {
            return back()->with([
                'ok' => false,
                'description' => "Client not found"
            ]); 
        }

        $client->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.company.client.index', compact([
            'company'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, Client $client)
    {
        $client->delete();

        return redirect()->back();
    }
}
