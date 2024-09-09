<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newMsg= new Message();
        $newMsg->name="gino";
        $newMsg->email="gino@pippo.com";
        $newMsg->text="ciao, sarei molto molto interessato
         a fare vacanza in codesto appartamento";
        $newMsg->apartment_id=1;
        $newMsg->save();   
    }
}
