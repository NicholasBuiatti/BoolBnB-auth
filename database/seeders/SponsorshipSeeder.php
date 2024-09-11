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
        $newSponsorship->description = 'Con il Piano Base, il tuo appartamento ottiene 24 ore di visibilità intensificata. Ideale per un rapido boost di visibilità e per attirare più occhi sul tuo annuncio in poco tempo.';
        $newSponsorship->save();

        $newSponsorship = new Sponsorship();
        $newSponsorship->price = 5.99;
        $newSponsorship->name = "Premium";
        $newSponsorship->duration = 72;
        $newSponsorship->description = 'Il Piano Plus garantisce 72 ore di visibilità prolungata, aumentando le possibilità di attirare potenziali interessati. Ottimo per una maggiore esposizione senza eccessiva durata.';
        $newSponsorship->save();

        $newSponsorship = new Sponsorship();
        $newSponsorship->price = 9.99;
        $newSponsorship->name = "Elite";
        $newSponsorship->duration = 144;
        $newSponsorship->description = "Con il Piano Premium, il tuo annuncio sarà in primo piano per 144 ore. Questa opzione offre la massima visibilità e il miglior risultato per chi cerca un'esposizione duratura e continua.";
        $newSponsorship->save();
    }
}
