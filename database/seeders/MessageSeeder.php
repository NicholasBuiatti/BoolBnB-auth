<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            "Giulia",
            "Francesco",
            "Luca",
            "Martina",
            "Simone",
            "Valentina",
            "Marco",
            "Alice",
            "Emanuele",
            "Claudia",
            "Paolo",
            "Sara",
            "Davide",
            "Laura",
            "Andrea",
            "Elisa",
            "Gabriele",
            "Chiara",
            "Alessandro",
            "Federica"
        ];

        $emails = [
            "giulia@email.com",
            "francesco@email.com",
            "luca@email.com",
            "martina@email.com",
            "simone@email.com",
            "valentina@email.com",
            "marco@email.com",
            "alice@email.com",
            "emanuele@email.com",
            "claudia@email.com",
            "paolo@email.com",
            "sara@email.com",
            "davide@email.com",
            "laura@email.com",
            "andrea@email.com",
            "elisa@email.com",
            "gabriele@email.com",
            "chiara@email.com",
            "alessandro@email.com",
            "federica@email.com"
        ];

        $texts = [
            "Salve, sono interessato all'appartamento.",
            "Buongiorno, vorrei informazioni.",
            "Ciao, sono interessato alla vacanza.",
            "Mi piacerebbe sapere di più su questo appartamento.",
            "Vorrei prenotare una vacanza in questo appartamento.",
            "Sarei felice di ricevere maggiori informazioni.",
            "Salve, può darmi dettagli sulla disponibilità?",
            "Sono molto interessato all'appartamento per le vacanze.",
            "Mi piacerebbe prenotare una vacanza.",
            "Buonasera, vorrei sapere se l'appartamento è disponibile.",
            "Ciao, sono interessato per agosto.",
            "Vorrei avere informazioni sull'affitto.",
            "Salve, posso avere maggiori dettagli?",
            "Sono interessato a prenotare l'appartamento per le vacanze.",
            "Ciao, è disponibile l'appartamento?",
            "Buongiorno, vorrei sapere il prezzo per luglio.",
            "Mi piacerebbe sapere di più sulla casa.",
            "Vorrei sapere se l'appartamento è ancora disponibile.",
            "Salve, vorrei avere informazioni sulla disponibilità.",
            "Mi piacerebbe sapere se posso prenotare."
        ];

        // Generazione dei messaggi
        for ($i = 0; $i < 20; $i++) {
            $newMsg = new Message();
            $newMsg->name = $names[$i];
            $newMsg->email = $emails[$i];
            $newMsg->text = $texts[$i];

            // Associazione dell'appartamento (1, 2, 3, 4 o 5)
            $newMsg->apartment_id = ($i % 5) + 1;

            // Generazione di una data casuale nelle ultime 30 giornate
            $newMsg->created_at = Carbon::now()->subDays(rand(0, 30));

            // Salvataggio del messaggio
            $newMsg->save();
        }
    }
}
