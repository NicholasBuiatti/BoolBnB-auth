<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servizi_bnb = [
            "Wi-Fi",
            "Colazione inclusa",
            "Aria condizionata",
            "Parcheggio gratuito",
            "Piscina",
            "Palestra",
            "Servizio in camera",
            "Reception 24 ore su 24",
            "TV satellitare",
            "Minibar"
        ];
        for($i=0;$i<count($servizi_bnb);$i++){
        $newService=new Service();
            $newService->name=$servizi_bnb[$i];
            $newService->save();
        }



    }
}
