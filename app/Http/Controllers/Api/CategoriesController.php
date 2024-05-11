<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\CategoriesResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    

    public function add(Request $request)
    {

        $data = htmlentities(htmlspecialchars(json_decode($request['data'])));
        // dd(Auth::user()->id);
        
        $addCategory = Categories::insert([
            'user_id' => Auth::user()->id,
            'name' => $data,
            'sort' => 1000,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        
        $allCategories = Categories::where('user_id',Auth::user()->id )->with('elements:*')->get()->sortBy('sort');

          return new CategoriesResource($allCategories);
    }
    public function get()
    {

        
        $addCategory = Categories::where('user_id',Auth::user()->id )->with('elements:*')->get()->sortBy('sort');
        
        
          return $addCategory;
    }


}
