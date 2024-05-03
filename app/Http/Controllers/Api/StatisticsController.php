<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatisticsResource;
use App\Models\AcessoryList;
use App\Models\Rashod;
use App\Models\RentList;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function show($start,$stop)
    {
        $arStatisticsElemetns = RentList::whereBetween('date_start', [$start, $stop])
        ->where('status', 'S')
        ->with('category:*', 'element:*', 'client:*')
        ->get()
        ->sortBy('time_start')
        ->groupBy('phone');

        $arRashod = Rashod::whereBetween('date', [$start, $stop])->get();
        $arAccesory = AcessoryList::whereBetween('date', [$start, $stop])->get();

        $arStatistics = [$arStatisticsElemetns, $arRashod, $arAccesory];
        
        return new StatisticsResource($arStatistics);
    }

    public function update(Request $request)
    {
        $item = json_decode($request['change']);
        
        $res = RentList::where('id', $item->id)
            ->update([
                
                "sposob_pay_start" => $item->sposob_pay_start,
                "money_pay_start" => $item->money_pay_start,
                "sposob_pay_stop" => $item->sposob_pay_stop,
                "money_pay_stop" => $item->money_pay_stop,
                
                "who_update" => $item->who_update,
                'time_update' => date("H:i:s"),
            ]);

            if($res){   
                return new StatisticsResource([1]);
            }else{
                return new StatisticsResource([0]);
            }
    }
    public function delete(Request $request)
    {
        $item = json_decode($request['delete']);
        
        $res = RentList::where('id', $item->id)
            ->delete();

            if($res){   
                return new StatisticsResource([1]);
            }else{
                return new StatisticsResource([0]);
            }
    }
    public function deletePhoto(Request $request)
    {
        $item = json_decode($request['delete_photo']);
       
        $res = RentList::where('id', $item)
        ->update([
                
            "photo" => NULL,
          
            'time_update' => date("H:i:s"),
        ]);

            if($res){   
                return new StatisticsResource([1]);
            }else{
                return new StatisticsResource([0]);
            }
    }
}
