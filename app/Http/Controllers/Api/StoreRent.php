<?php

namespace App\Http\Controllers\Api;

use App\Filament\Resources\RentListResource as ResourcesRentListResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\RentListResource;
use App\Models\Clients;
use App\Models\Elements;
use App\Models\RentList;
use Illuminate\Http\Request;

class StoreRent extends Controller
{

    public function show(Request $request)
    {
        $arRentItems = RentList::where('status', '!=', 'S')
            ->with('category:*', 'element:*', 'client:*')->get()->sortBy('category.sort')
            ->groupBy('phone');
        return new RentListResource($arRentItems);
    }
    public function setPause(Request $request)
    {
        $set_pause = json_decode($request['set_pause']);

        $res1 = Elements::where('id', $set_pause->element_id)
            ->update([
                "go" => 0,
            ]);

        $res2 = RentList::where('id', $set_pause->id)
            ->update([
                
                "status" => "P",
                "pause_start" => $set_pause->pause_start
            ]);

        if ($res1 && $res2) {
            return new RentListResource([1]);
        }
    }
    public function delPause(Request $request)
    {
        $del_pause = json_decode($request['del_pause']);
        
        $checkElem = Elements::where('id', $del_pause->element_id)->first();
        if($checkElem->go){
            return new RentListResource([0]);
        }

        $res1 = Elements::where('id', $del_pause->element_id)
            ->update([
                "go" => 1,
            ]);

        $res2 = RentList::where('id', $del_pause->id)
            ->update([
                
                "status" => "D",
                "pause_start" => NULL
            ]);

        if ($res1 && $res2) {
            return new RentListResource([1]);
        }
    }

    public function stop(Request $request)
    {
        $stop_rent = json_decode($request['stop_rent']);
        $res1 = Elements::where('id', $stop_rent->element_id)
            ->update([
                "go" => 0,
            ]);

        $res2 = RentList::where('id', $stop_rent->id)
            ->update([
                "comment_stop" => $stop_rent->comment_stop,
                "sposob_pay_stop" => $stop_rent->sposob_pay_stop,
                "money_pay_stop" => $stop_rent->money_pay_stop == "" ? 0 : $stop_rent->money_pay_stop,
                "status" => "S",
                "money_full_drive" => $stop_rent->money_full_drive,
                "who_stop" => $stop_rent->who_stop,
                'date_stop' => date('Y-m-d'),
                'time_stop' => date("H:i:s"),
            ]);

        if ($res1 && $res2) {
            return new RentListResource([1]);
        }
    }
    public function stopAll(Request $request)
    {
        $stop_rent = json_decode($request['stop_rent_all']);

        foreach ($stop_rent as $key => $val) {

            $res1 = Elements::where('id', $val->element_id)
                ->update([
                    "go" => 0,
                ]);

            $res2 = RentList::where('id', $val->id)
                ->update([
                    "comment_stop" => $val->comment_stop,
                    "sposob_pay_stop" => $val->sposob_pay_stop,
                    "money_pay_stop" => $val->money_pay_stop == "" ? 0 : $val->money_pay_stop,
                    "status" => "S",
                    "money_full_drive" => $val->money_full_drive,
                    "who_stop" => $val->who_stop,
                    'date_stop' => date('Y-m-d'),
                    'time_stop' => date("H:i:s"),
                ]);
        }
        if ($res1 && $res2) {
            return new RentListResource([1]);
        }
    }
    public function update(Request $request)
    {
        $update_rent = json_decode($request['update_rent']);


        if ($update_rent->element_id != $update_rent->element->id) {
            $res1 = Elements::where('id', $update_rent->element_id)
                ->update([
                    "go" => 1,
                ]);
            $res2 = Elements::where('id', $update_rent->element->id)
                ->update([
                    "go" => 0,
                ]);
        } else {
            $res1 = 1;
            $res2 = 1;
        }

        $res3 = RentList::where('id', $update_rent->id)
            ->update([
                "element_id" => $update_rent->element_id,
                "comment_start" => $update_rent->comment_start,
                "sposob_pay_start" => $update_rent->sposob_pay_start,
                "money_pay_start" => $update_rent->money_pay_start,
                "time_start" => $update_rent->time_start,
                "date_start" => $update_rent->date_start,
                "time_rent" => $update_rent->time_rent,
                "who_update" => $update_rent->who_update,
                'time_update' => date("H:i:s"),
            ]);

        if ($res1 && $res2 && $res3) {
            return new RentListResource([1]);
        }
    }

    public function store(Request $request)
    {
        $new_rents = json_decode($request['new_rent']);
        $checkGo = [];

        foreach ((array)$new_rents as $keys => $vall) {
            $check = Elements::where('id', $vall->element_id)->where('go', 1)->first();
            if ($check) {
                $checkGo[] = $vall->name;
            }
        }
        if (count($checkGo)) {
            return new RentListResource([0]);
        } else {
            foreach ((array)$new_rents as $key => $val) {

                $set = RentList::insert([
                    'category_id' => $val->category_id,
                    'element_id' => $val->element_id,
                    'client_id' => $val->client_id,
                    'who_start' => $val->user,
                    'phone' => '8' . $val->phone,
                    'photo' => $val->photo,
                    'sposob_pay_start' => $val->sposob_pay_start,
                    'money_pay_start' => $val->money_pay_start,
                    'time_rent' => $val->time_rent,
                    'comment_start' => $val->comment_start,
                    'date_start' => date('Y-m-d'),
                    'time_start' => $val->other_time ? $val->other_time : date("H:i:s"),
                ]);
            }
            foreach ((array)$new_rents as $keys => $vall) {
                Elements::where('id', $vall->element_id)->update(['go' => 1]);
            }

            return new RentListResource([1]);
        }
    }
    public function add(Request $request)
    {
        $new_rents = json_decode($request['add_rent']);
        $checkGo = [];
        $check = Elements::where('id', $new_rents->element_id)->where('go', 1)->first();
        if ($check) {
            $checkGo[] = $new_rents->element->name;
        }

        if (count($checkGo)) {
            return new RentListResource([0]);
        } else {

            $set = RentList::insert([
                'category_id' => $new_rents->category_id,
                'element_id' => $new_rents->element_id,
                'client_id' => $new_rents->client_id,
                'who_start' => $new_rents->who_start,
                'phone' => $new_rents->phone,
                'photo' => $new_rents->photo,
                'sposob_pay_start' => $new_rents->sposob_pay_start,
                'money_pay_start' => $new_rents->money_pay_start,
                'time_rent' => $new_rents->time_rent,
                'comment_start' => $new_rents->comment_start,
                'date_start' => date('Y-m-d'),
                'time_start' => isset($new_rents->other_time) ? $new_rents->other_time : date("H:i:s"),
            ]);


            Elements::where('id', $new_rents->element_id)->update(['go' => 1]);

            return new RentListResource([1]);
        }
    }
}
