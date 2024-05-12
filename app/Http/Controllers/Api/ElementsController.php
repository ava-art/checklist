<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ElementsResource;
use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Element;
use App\Models\Category;
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
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d")
        ]);
        
        $allCategories = Category::where('user_id',Auth::user()->id )->with('elements:*')->get()->sortBy('sort');

        return new CategoryResource($allCategories);
    }

    public function checked(Request $request)
    {
        $data = json_decode($request['data']);
        Element::where('id', $data->id)->update(['checked' => $data->check]);
        
    }
    public function comment(Request $request)
    {
        $data = json_decode($request['data']);
        Element::where('id', $data->id)->update(['comment' => $data->comment]);
        
    }
    public function change(Request $request)
    {
        function html($var){
            return htmlentities(htmlspecialchars($var));
                }

        $data = json_decode($request['data']);
        Element::where('id', $data->id)->update(['name' => html($data->name)]);   
    }
}
