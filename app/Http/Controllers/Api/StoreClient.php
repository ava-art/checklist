<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientsResource;
use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreClient extends Controller
{
    public function store(Request $request)
    {
        $client = json_decode($request['client']);
        Clients::where('id', $client->id)
            ->update([
                'name' => $client->name,
                'family' => $client->family,
                'comment' => $client->comment,
                'who_update' => $client->user,
                'postoyannik' => 1
            ]);

        $client = Clients::where('id', $client->id)->first();

        return  new ClientsResource($client);
    }
}
