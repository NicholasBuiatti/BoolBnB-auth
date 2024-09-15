<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use Illuminate\Support\Str;


class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Base coordinates
        $milanBaseLatitude = 45.4732;
        $milanBaseLongitude = 9.1895; // Adjusted to be more accurate for Milano
        $parmaBaseLatitude = 44.801485;
        $parmaBaseLongitude = 10.3279036;

        // Function to generate random coordinates within a certain radius
        function generateRandomCoordinates($lat, $lon, $radiusKm)
        {
            $radius = $radiusKm / 111.32; // Convert radius from kilometers to degrees
            $u = mt_rand() / (float) mt_getrandmax();
            $v = mt_rand() / (float) mt_getrandmax();
            $w = $radius * sqrt($u);
            $t = 2 * pi() * $v;
            $x = $w * cos($t);
            $y = $w * sin($t);

            $new_lat = $lat + $y;
            $new_lon = $lon + $x / cos(deg2rad($lat));

            return [$new_lat, $new_lon];
        }

        // Array of example streets in Milano
        $milanStreets = [
            "Via Roma",
            "Via Dante",
            "Corso Vittorio Emanuele II",
            "Via Montenapoleone",
            "Viale Abruzzi",
            "Via Torino",
            "Viale Monza",
            "Corso Buenos Aires",
            "Via della Moscova",
            "Via Manzoni",
            "Corso Garibaldi",
            "Via Solferino",
            "Via Melchiorre Gioia",
            "Via Paolo Sarpi",
            "Via Vitruvio",
            "Via Ripamonti",
            "Via Novara",
            "Via Lorenteggio",
            "Via Padova",
            "Via Pascoli",
            "Via Pergolesi",
            "Via Larga",
            "Via Lazzaro Spallanzani",
            "Via Tito Livio",
            "Via Washington",
            "Viale Majno",
            "Via Foppa",
            "Via Savona",
            "Via Tortona",
            "Via Pola"
        ];
        $parmaStreets = [
            "Via Farini",
            "Strada della Repubblica",
            "Via Mazzini",
            "Viale Toschi",
            "Viale Mentana",
            "Strada Massimo d'Azeglio",
            "Via Emilio Lepido",
            "Via d'Azeglio",
            "Strada Giuseppe Garibaldi",
            "Via Verdi",
            "Piazza Duomo",
            "Strada Cavour",
            "Strada Nino Bixio",
            "Via Duca Alessandro",
            "Strada al Duomo",
            "Via Garibaldi",
            "Via Emilia Est",
            "Strada XXII Luglio",
            "Via Sauro",
            "Strada Martiri della Libertà",
            "Viale Fratti",
            "Strada della Repubblica",
            "Strada Luigi Carlo Farini",
            "Piazza Ghiaia",
            "Via Università",
            "Via Bixio",
            "Via Zarotto",
            "Strada Luigi Carlo Farini",
            "Via Varese",
            "Strada Nuova"
        ];

        // Aggiungi un array di immagini casuali
        $imageUrls = [
            "https://plus.unsplash.com/premium_photo-1684175656320-5c3f701c082c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1499916078039-922301b0eb9b?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1499955085172-a104c9463ece?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?q=80&w=1980&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://plus.unsplash.com/premium_photo-1674676471104-3c4017645e6f?q=80&w=1940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1527772482340-7895c3f2b3f7?q=80&w=2151&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1496180727794-817822f65950?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://plus.unsplash.com/premium_photo-1683769250375-1bdf0ec9d80f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1515263487990-61b07816b324?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=2074&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://plus.unsplash.com/premium_photo-1683133660598-3ebeb26769ba?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1500307353842-81f527a10685?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1495433324511-bf8e92934d90?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1504624720567-64a41aa25d70?q=80&w=2076&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1520106392146-ef585c111254?q=80&w=2025&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://plus.unsplash.com/premium_photo-1674676471963-4c4643beb12d?q=80&w=1939&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://plus.unsplash.com/premium_photo-1683140513388-4344c8fc2778?q=80&w=2014&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1485819196298-11222a657b31?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1501877008226-4fca48ee50c1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1509660933844-6910e12765a0?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://images.unsplash.com/photo-1528255671579-01b9e182ed1d?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "https://plus.unsplash.com/premium_photo-1674676471447-b893f7aefbd4?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",

        ];

        // ciclo appartamenti Milano
        for ($i = 0; $i < 30; $i++) {
            $newApartment = new Apartment();
            $newApartment->user_id = rand(1, 3);
            $newApartment->title = "Villa " . $milanStreets[$i];
            $newApartment->slug = Str::slug($newApartment->title, '-');
            $newApartment->rooms = rand(1, 5);
            $newApartment->beds = rand(1, 4);
            $newApartment->bathrooms = rand(1, 2);
            $newApartment->dimension_mq = rand(40, 120);

            // Assegna un'immagine casuale
            $newApartment->image = $imageUrls[rand(0, count($imageUrls) - 1)];

            list($newApartment->latitude, $newApartment->longitude) = generateRandomCoordinates($milanBaseLatitude, $milanBaseLongitude, 40);
            $newApartment->address_full = $milanStreets[$i] . ", " . rand(1, 100) . ", 20100, Milano";
            $newApartment->is_visible = true;
            $newApartment->save();
        }

        // ciclo appartamenti Parma
        for ($i = 0; $i < 15; $i++) {
            $newApartment = new Apartment();
            $newApartment->user_id = rand(1, 3);
            $newApartment->title = "Villa " . $parmaStreets[$i];
            $newApartment->slug = Str::slug($newApartment->title, '-');
            $newApartment->rooms = rand(1, 5);
            $newApartment->beds = rand(1, 4);
            $newApartment->bathrooms = rand(1, 2);
            $newApartment->dimension_mq = rand(40, 120);

            // Assegna un'immagine casuale
            $newApartment->image = $imageUrls[rand(0, count($imageUrls) - 1)];

            list($newApartment->latitude, $newApartment->longitude) = generateRandomCoordinates($parmaBaseLatitude, $parmaBaseLongitude, 40);
            $newApartment->address_full = $parmaStreets[$i] . ", " . rand(1, 100) . ", 43125, Parma";
            $newApartment->is_visible = true;
            $newApartment->save();
        }
    }
}
