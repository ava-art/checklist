<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientsResource;
use App\Models\Clients;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class UploadPhoto extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $fileNameToStoreWebp = "photos/" . $filename . "_" . time() . ".webp";
            Image::make($request->file('photo'))->encode('webp', 10)->save($fileNameToStoreWebp);


            $phone = json_decode($request['phone']);

            $client = Clients::wherePhone('8' . $phone)->first();

            if ($client) {
                Clients::where('id', $client->id)
                ->update([
                    'img' => $fileNameToStoreWebp,
                    'who_update' => $request['user'],
                ]);
            } else {

                Clients::insert([
                    'phone' => '8' . $phone,
                    'img' => $fileNameToStoreWebp,
                    'who_add' => $request['user'],
                    'date' => date('Y-m-d'),
                    'count_bonus' => 0,
                    'postoyannik' => 0
                ]);

            }
            $client = Clients::wherePhone('8' . $phone)->first();

            return new ClientsResource($client);
        }
    }
}
