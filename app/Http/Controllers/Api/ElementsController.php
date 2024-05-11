<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ElementsResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Element;
use Illuminate\Support\Facades\Auth;

class ElementsController extends Controller
{
    public function add(Request $request)
    {
        function html($var){
            return htmlentities(htmlspecialchars($var));
                }

        $data = json_decode($request['data']);
        $data->name = html($data->name); 
        
        if (!$data->user_id == Auth::user()->id) die() ;
        
        $addCategory = Element::insert([
            'user_id' => Auth::user()->id,
            'category_id' => $data->category_id,
            'name' => $data->name,
            'sort' => 1000,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        
        $allCategories = Element::where('user_id',Auth::user()->id )->orderByDesc('sort')->get();
        
          return new ElementsResource($allCategories);
    }
}
