<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use App\Models\Statistic;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inizializza Faker per generare dati casuali
        $faker = Faker::create();

        // L'ID dell'appartamento per cui generare le statistiche
        $apartmentId = 11;

        // Crea 100 statistiche fittizie
        for ($i = 0; $i < 100; $i++) {
            // Genera una data casuale nell'ultimo anno
            $dateVisit = Carbon::now()->subDays(rand(0, 365))->format('Y-m-d');

            // Inserisci una riga nella tabella 'statistics'
            Statistic::create([
                'apartment_id' => $apartmentId,
                'date_visit' => $dateVisit,
                'ip_address' => $faker->ipv4, // Genera un IP fittizio
            ]);
        }
    }
}
