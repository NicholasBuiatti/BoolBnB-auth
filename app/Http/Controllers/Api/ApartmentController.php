<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::with(['user', 'services'])/*aggiungere servizi*/->paginate();
        return response()->json([
            'success' => true,
            'results' => $apartments,
        ]);
        /*http://127.0.0.1:8000/api/apartments*/
    }


    public function show($id)
    {

        $apartment = Apartment::with(['user'])->where('id', $id)->first();

        if ($apartment) {

            return response()->json([

                'success' => true,

                'project' => $apartment

            ]);
        } else {

            return response()->json([

                'success' => false,

                'message' => 'non è stato trovato nulla',

            ]);
        }
    }

    public function search(Request $request)
    {
        $data = $request->all();


        $validate_data = $request->validate(
            [
                'latitude' => 'between:-90,90|numeric|decimal(11,9)',
                'longitude' => 'between:-180,180|numeric|decimal(11,9)',
                'radiusKm' => 'numeric| min:1',
                'beds' => 'numeric|min:1',
                'bathrooms' => 'numeric|min:1',
                'rooms' => 'numeric|min:1',

            ]
        );





        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $latitude = $validate_data['latitude'];
        $longitude = $validate_data['longitude'];
        $radiusKm = $validate_data['radiusKm'];
        $beds = $validate_data['beds'];
        $rooms = $validate_data['rooms'];
        $bathrooms = $validate_data['bathrooms'];

        // $latitude =45.4732;
        // $longitude =9.1895;
        // $radiusKm =20;
        // $beds=2;
        // $rooms=3;
        // $bathrooms=1;

        //da definire come mandare i servizi;
        // $radiusKm = 20;

        if (!$radiusKm) {
            $radiusKm = 20;
        }




        // Se latitudine o longitudine non sono fornite, restituisci tutti gli appartamenti
        if (!$latitude || !$longitude) {
            return response()->json([
                'success' => true,
                'results' => Apartment::with(['user'])->paginate(),
            ]);
        }

        // Prendi tutti gli appartamenti
        $apartments = Apartment::with(['user'])
            ->where('beds', '>=', $beds)
            ->where('rooms', '>=', $rooms)
            ->where('bathrooms', '>=', $bathrooms)
            ->get();
        // Inizializza l'array per gli appartamenti vicini
        $searchApp = [];
        foreach ($apartments as $apartment) {
            // Calcolo della distanza in gradi
            $distLat = $apartment->latitude - $latitude;
            $distLon = $apartment->longitude - $longitude;

            // Converti la differenza di longitudine in chilometri
            $distLonKm = $distLon * 111;
            $distLatKm = $distLat * 111;
            // Distanza in chilometri
            $distance = sqrt($distLatKm * $distLatKm + $distLonKm * $distLonKm);

            // Se la distanza è inferiore a 20 km, aggiungi l'appartamento all'array
            if ($distance <= $radiusKm) {
                $searchApp[] = $apartment;
            }
        }


        return response()->json([
            'success' => true,
            'results' => $searchApp,
        ]);
    }
}
