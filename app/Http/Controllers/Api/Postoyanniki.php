<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientsResource;
use App\Models\Clients;
use App\Models\RentList;

class Postoyanniki extends Controller
{
    public function show(string $number)
    {
        $client = Clients::wherePhone('8'.$number)->first();
        
        if (isset($client->phone)){
            $client->old_rent = RentList::where('phone',$client->phone)
            ->with('element:*')->get()->sortBy('date_start');
        } 
        return new ClientsResource($client);
    }
}
