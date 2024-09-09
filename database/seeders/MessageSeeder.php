<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use Illuminate\Support\Str;
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
        
        for ($i = 1; $i <= 10; $i++) {
            $newMsg = new Message();
            $newMsg->name = "gino";
            $newMsg->email = "gino" . $i . "@pippo.com";
            $newMsg->text = Str::random(50); // Genera una stringa casuale di 50 caratteri
            $newMsg->apartment_id = rand(1, 44); // Genera un numero casuale tra 1 e 44
            $newMsg->save();
        }

    
    }
}
