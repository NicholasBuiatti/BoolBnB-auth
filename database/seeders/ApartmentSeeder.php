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

        // Base coordinates
        $baseLatitude = 45.4732;
        $baseLongitude = 9.1895; // Adjusted to be more accurate for Milano

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
        $streets = [
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



        for ($i = 0; $i < 30; $i++) {
            $newApartment = new Apartment();
            $newApartment->user_id = rand(1, 3);
            $newApartment->title = "Villa " . $streets[$i];
            $newApartment->rooms = rand(1, 5);
            $newApartment->beds = rand(1, 4);
            $newApartment->bathrooms = rand(1, 2);
            $newApartment->dimension_mq = rand(40, 120);
            $newApartment->image = "http://www.case-in-legno-progettolegno.it/wp-content/uploads/2015/12/Casa-in-legno-a-Fano-0003.jpg";

            list($newApartment->latitude, $newApartment->longitude) = generateRandomCoordinates($baseLatitude, $baseLongitude, 40);

            $newApartment->address_full = $streets[$i] . ", " . rand(1, 100) . ", 20100, Milano";
            $newApartment->is_visible = true;
            $newApartment->save();
        }
    }
}
