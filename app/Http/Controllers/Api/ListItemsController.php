<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ElementsResource;
use App\Http\Controllers\Controller;
use App\Models\Elements;
use Illuminate\Http\Request;

class ListItemsController extends Controller
{

    public function show(string $id)
    {
        //Если ролики то еще и защиту доставать
        if ($id == 6) {
            $listFreeItems = Elements::where('category_id', $id)
                ->with('category:*')->get()->sortBy('sort');
            $listShields = Elements::where('category_id', 7)
                ->with('category:*')->get()->sortBy('sort');
            $arAllItems = [];
            foreach ($listFreeItems as $val) {
                $arAllItems[] = $val;
            }
            foreach ($listShields as $val) {
                $arAllItems[] = $val;
            }
            $listFreeItems = $arAllItems;
        } else {
            $listFreeItems = Elements::where('category_id', $id)
                ->with('category:*')->get()->sortBy('sort');
        }
        return new ElementsResource($listFreeItems);
    }
}
