<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\WebApp;
use Illuminate\Http\Request;
use Romanlazko\Telegram\App\Telegram;
use Romanlazko\Telegram\Exceptions\TelegramException;

class WebAppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {
        $web_apps = $company->web_apps;

        return view('admin.company.web_app.index', compact(
            'company',
            'web_apps'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        return view('admin.company.web_app.create', compact(
            'company'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Company $company)
    {
        $web_app = $company->web_apps()->create([
            'url' => $request->url,
            'settings' => $request->settings
        ]);
        
        return redirect()->route('admin.company.web_app.edit', [$company, $web_app])->with([
            'ok' => true, 
            'description' => "WebApp succesfuly created"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, WebApp $web_app)
    {
        return view('admin.company.web_app.show', compact(
            'company',
            'web_app'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company, WebApp $web_app)
    {
        return view('admin.company.web_app.edit', compact(
            'web_app',
            'company'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company, WebApp $web_app)
    {
        $company->web_apps()->find($web_app->id)->update([
            'url' => $request->url,
            'settings' => $request->settings
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebApp $webApp)
    {
        //
    }
}
