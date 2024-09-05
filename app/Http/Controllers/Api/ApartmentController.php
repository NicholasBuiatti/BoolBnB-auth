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
        // $data = $request->all();


        $validate_data = $request->validate(
            [
                'latitude' => 'required',
                'longitude' => 'required',
                'radius' => 'nullable',
                'beds' => 'nullable',
                'rooms' => 'nullable',
            ]
        );





        // $latitude = $data['latitude'];
        // $longitude = $data['longitude'];
        // $beds = $data['beds'];
        // $rooms = $data['rooms'];
        // $radiusKm = $data['radius'];


        $latitude = $validate_data['latitude'];
        $longitude = $validate_data['longitude'];
        $radiusKm = $validate_data['radius'];
        $beds = $validate_data['beds'];
        $rooms = $validate_data['rooms'];


        // $beds=2;
        // $rooms=3;
        // $bathrooms=1;

        //da definire come mandare i servizi;
        // $radiusKm = 20;

        if (!$radiusKm) {
            $radiusKm = 20;
        }
        if (!$beds) {
            $beds = 1;
        }
        if (!$rooms) {
            $rooms = 1;
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
