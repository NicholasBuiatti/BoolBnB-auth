<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;



class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newApartment=new Apartment();
        $newApartment->user_id=1;
        $newApartment->title="villetta 1";
        $newApartment->rooms=3;
        $newApartment->beds=2;
        $newApartment->bathrooms=1;
        $newApartment->dimension_mq=50;
        $newApartment->image="https://discord.com/channels/1214170188271063060/1229384659755073597/1279099524782227581  ";
        $newApartment->latitude=45.4642;
        $newApartment->longitude=45.4642;
        $newApartment->address_full="via dei matti,0,11111,Milano";
        $newApartment->is_visible=true;
        $newApartment->save(); 

    }
}
