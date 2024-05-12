<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Element;
use App\Models\Statistic;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function __construct(){
        $this->userId = Auth::user()->id;
    }

    public function add(Request $request)
    {

        $data = htmlentities(htmlspecialchars(json_decode($request['data'])));
        // dd(Auth::user()->id);
        
        $addCategory = Category::insert([
            'user_id' => Auth::user()->id,
            'name' => $data,
            'sort' => 1000,
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d")
        ]);
        
        $allCategories = Category::where('user_id',$this->userId )->with('elements:*')->get()->sortBy('sort');

          return new CategoryResource($allCategories);
    }
    public function get()
    {

        $user = User::where('id', $this->userId)->first();
        $connect = $user->connect;
        if (date('Y-m-d') != $connect){
            $arElements = Element::where('user_id',$this->userId)->get();
            
            $ar =[];
            foreach($arElements as $key => $val){
                // dd($val);
                Statistic::insert([
                    "category_id" => $val['category_id'],
                    "user_id" => $val['user_id'],
                    "name" => $val['name'],
                    "sort" => $val['sort'],
                    "comment" => $val['comment'],
                    "checked" => $val['checked'],
                    "date" => date('Y-m-d', strtotime('yesterday')),
                ]);
            }

            Category::where('user_id',$this->userId)->update([
                'comment' => '',
                'checked' => 0
            ]);
            
        }else{
            // echo 'Cовпадает';
        }

        User::where('id', $this->userId)->update(['connect' => date('Y-m-d')]);
        $allCategories = Category::where('user_id',$this->userId)->with('elements:*')->get()->sortBy('sort');

        return new CategoryResource($allCategories);
        
    }


}
