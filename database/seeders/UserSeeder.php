<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newUser=new User();
        $newUser->name="Gianni";
        $newUser->surname="Fantoni";
        $newUser->birth_date="1991-02-08";
        $newUser->email="admin@admin.com";
        $newUser->password=Hash::make("password");
        $newUser->save();

    }
}
