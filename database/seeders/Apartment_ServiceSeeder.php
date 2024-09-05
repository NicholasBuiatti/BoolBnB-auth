<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;

class Apartment_ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[];
        $combNum=[];
        while(count($data)<100){
            $apartment_id=rand(1,45);
            $service_id=rand(1,10);
            $concNum=$apartment_id . '_' . $service_id;
            if(!in_array($concNum,$combNum)){

            };
            $data[]=['apartment_id'=>$apartment_id,
                      'service_id'=>$service_id];
            $combArray[]=$concNum;
            // $data->save();
                    
        };
            
        DB::table('apartment_service')->insert($data);
    }
}
