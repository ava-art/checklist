<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RashodResource;
use App\Models\Rashod;
use Illuminate\Http\Request;

class RashoController extends Controller
{
    public function store(Request $request)
    {
        $rashod = json_decode($request['add_rashod']);

        $res = Rashod::insert([
            'what' => $rashod->what,
            'sum' => $rashod->sum,
            'who_add' => $rashod->who_add,
            'time' => date("H:i:s"),
            'date' => date('Y-m-d'),
        ]);
        if ($res){
            return new RashodResource([1]);
        }
    }
}
