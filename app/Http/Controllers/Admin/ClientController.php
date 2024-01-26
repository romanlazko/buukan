<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use Romanlazko\Telegram\App\Bot;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Company $company)
    {
        $clients = $company->clients()
            ->when($request->has('search'), function ($query) use ($request) {
                return $query->where(function ($subQuery) use ($request) {
                    $subQuery->whereRaw('LOWER(first_name) LIKE ?', ['%' . strtolower($request->search) . '%'])
                        ->orWhereRaw('LOWER(last_name) LIKE ?', ['%' . strtolower($request->search) . '%'])
                        ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($request->search) . '%']);
                });
            })
            ->get();

        return view('admin.company.client.index', compact(
            'clients',
            'company'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, Client $client)
    {   
        $client = $company->clients()->find($client->id);

        if (!$client) {
            return back()->with([
                'ok' => false,
                'description' => 'Client not found'
            ]);
        }
        
        return view('admin.company.client.show', compact(
            'company',
            'client'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function telegram_chat(Company $company, Client $client)
    {
        if ($telegram_bot = $client->telegram_chat?->bot) {
            $bot = new Bot($telegram_bot->token);
    
            $messages = $client->telegram_chat->messages()
                ->orderBy('id', 'DESC')
                ->with(['user', 'callback_query', 'callback_query.user'])
                ->paginate(20);
    
            $messages->map(function ($message) use ($bot){
                if ($message->photo) {
                    $message->photo = $bot::getPhoto(['file_id' => $message->photo]);
                }
            });
    
            return view('admin.company.client.telegram.chat', compact(
                'company',
                'client',
                'messages'
            ));
        }

        return redirect()->route('admin.company.client.show', [
            'company' => $company,
            'client' => $client
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, Client $client)
    {
        $client = $company->clients()->find($client->id);

        if (!$client) {
            return back()->with([
                'ok' => false,
                'description' => 'Client not found'
            ]);
        }

        $client->appointments->each(function ($appointment) {
            $appointment->delete();
        });

        $client->delete();

        return redirect()->back();
    }
}