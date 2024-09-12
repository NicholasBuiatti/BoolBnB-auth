<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Statistic;
use Illuminate\Support\Carbon;

class StatisticController extends Controller
{
    public function store(Request $request)

    {   
        $today=Carbon::today()->toDateString();
        $data = $request->all();

        $ifStat=Statistic::where('ip_address',$data['ip'])
        ->where('apartment_id',$data['apartmentId'])
        ->where('date_visit',$today)
        ->first();
        
        if($ifStat){
            return response()->json([
                'message'=>'indirizzo ip già presente nella giornata'
            ],200);

        }
            $statistic = new Statistic();
            $statistic->apartment_id= $data['apartmentId'];
            $statistic->ip_address= $data['ip'];
            $statistic->date_visit=Carbon::today()->toDateString();
            $statistic->save();

         
    }
}
