<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ElementsResource;
use App\Models\Elements;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function show(string $cat_id)
    {
        
        $listItems = Elements::all()->where('category_id', $cat_id)->where('go',0)
        ->sortBy('sort');
        return new ElementsResource($listItems);
    }
    public function setShield(Request $request)
    {
        $item = json_decode($request['set_shield']);

        $listItems = Elements::where('id', $item->id)
        ->update([
            "shield" => $item->shield
        ]);

        if($listItems){
            return new ElementsResource([1]);
        }
    }
    public function setRepair(Request $request)
    {
        $item = json_decode($request['set_repair']);

        $listItems = Elements::where('id', $item->id)
        ->update([
            "repair" => $item->repair
        ]);

        if($listItems){
            return new ElementsResource([1]);
        }
    }


}
