<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Apartment_SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ottieni tutti gli ID degli appartamenti e delle sponsorizzazioni
        $apartmentIds = DB::table('apartments')->pluck('id')->toArray();
        $sponsorshipIds = DB::table('sponsorships')->pluck('id')->toArray();

        foreach ($apartmentIds as $apartmentId) {
            // Decidi casualmente se associare una sponsorizzazione a questo appartamento
            if (rand(0, 100) / 100 <= 0.3) {
                // Scegli una sponsorizzazione casuale
                $sponsorshipId = $sponsorshipIds[array_rand($sponsorshipIds)];

                // Calcola la ending_date in base al sponsorshipId
                $startingDate = now();
                if ($sponsorshipId == 1) {
                    // Sponsorship di 24 ore
                    $endingDate = $startingDate->copy()->addHours(24);
                } elseif ($sponsorshipId == 2) {
                    // Sponsorship di 72 ore
                    $endingDate = $startingDate->copy()->addHours(72);
                } elseif ($sponsorshipId == 3) {
                    // Sponsorship di 144 ore
                    $endingDate = $startingDate->copy()->addHours(144);
                }

                // Inserisci il record nella tabella ponte
                DB::table('apartment_sponsorship')->insert([
                    'apartment_id' => $apartmentId,
                    'sponsorship_id' => $sponsorshipId,
                    'starting_date' => $startingDate,
                    'ending_date' => $endingDate,
                ]);
            }
        }
    }
}
