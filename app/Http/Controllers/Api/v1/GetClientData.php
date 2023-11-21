<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class GetClientData extends Controller
{
    public function __invoke(Request $request)
    {
        $client = Client::find($request->client);

        if (!$client) {
            return [];
        }

        return $client->toJson();
    }
}
