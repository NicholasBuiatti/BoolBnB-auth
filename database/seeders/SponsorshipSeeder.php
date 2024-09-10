<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newSponsorship = new Sponsorship();
        $newSponsorship->price = 2.99;
        $newSponsorship->name = "Basic";
        $newSponsorship->duration = 24;
        $newSponsorship->active = true;
        $newSponsorship->save();

        $newSponsorship = new Sponsorship();
        $newSponsorship->price = 5.99;
        $newSponsorship->name = "Premium";
        $newSponsorship->duration = 72;
        $newSponsorship->active = true;
        $newSponsorship->save();

        $newSponsorship = new Sponsorship();
        $newSponsorship->price = 9.99;
        $newSponsorship->name = "Elite";
        $newSponsorship->duration = 144;
        $newSponsorship->active = true;
        $newSponsorship->save();
    }
}
