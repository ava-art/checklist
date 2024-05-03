<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AcessoryResource;
use App\Models\Acessory;
use App\Models\AcessoryList;
use Illuminate\Http\Request;

class AcessoryController extends Controller
{
    public function show(Request $request)
    {
        $acessory = Acessory::all();
        return new AcessoryResource($acessory);
    }

    public function store(Request $request)
    {

        $arAcessory = json_decode($request['set_acessory']);

        foreach ($arAcessory as $key => $val) {

            AcessoryList::insert([
                'name' => $val->name,
                'count' => $val->count,
                'price' => $val->price,
                'sposob_pay' => $val->sposob_pay,
                'full_price' => $val->full_price,
                'who_add' => $val->who_add,
                'date' => date('Y-m-d'),
                'time' => date("H:i:s"),
            ]);
        }
        

        return new AcessoryResource([1]);
    }
}
