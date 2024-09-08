<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

        $apartment = Apartment::with(['user', 'services'])->where('id', $id)->first();

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
        try {
            $validate_data = $request->validate(
                [
                    'latitude' => 'required|numeric|between:-90,90',
                    'longitude' => 'required|numeric|between:-180,180',
                    'radius' => 'nullable|numeric|min:1',
                    'beds' => 'nullable|integer|min:1|max:10',
                    'rooms' => 'nullable|integer|min:1|max:10',
                    'services' => 'array|nullable',
                ]
            );
        } catch (ValidationException $errors) {
            return response()->json([
                'success' => false,
                'errors' => $errors->errors(),
            ]);
        }

        $latitude = $validate_data['latitude'];
        $longitude = $validate_data['longitude'];
        $radiusKm = $validate_data['radius'] ?? 20; // Default 20 km
        $beds = $validate_data['beds'] ?? 1;
        $rooms = $validate_data['rooms'] ?? 1;
        $services = $validate_data['services'];

        // Query di base per gli appartamenti con numero di letti e stanze richiesti
        $apartments = Apartment::with(['user', 'services'])
            ->selectRaw("apartments.*, 
                        ST_Distance_Sphere(         
                        POINT(longitude, latitude), 
                        POINT($longitude, $latitude)
                        ) * 0.001 AS distance")
            ->having("distance", "<=", $radiusKm) //prende tutti gli appartamenti e crea distance con il metodo ST_Distance_Sphere
            ->where('beds', '>=', $beds)
            ->where('rooms', '>=', $rooms)
            ->orderBy('distance', 'desc'); //ordino per distanza

        // Se ci sono servizi, aggiungi un filtro
        if (!empty($services)) {
            $apartments->whereHas('services', function ($q) use ($services) {
                $q->whereIn('services.id', $services);
            }, '=', count($services));
        }

        // // Prendi tutti gli appartamenti
        // $apartments  = Apartment::with(['user', 'services'])
        //     ->where('beds', '>=', $beds)
        //     ->where('rooms', '>=', $rooms)
        //     ->whereHas('services', function ($q) use ($services) {
        //         $q->whereIn('services.id', $services);
        //     }, '=', count($services))
        //     ->get();

        // // Inizializza l'array per gli appartamenti vicini
        // $searchApp = [];
        // foreach ($apartments as $apartment) {
        //     // Calcolo della distanza in gradi
        //     $distLat = $apartment->latitude - $latitude;
        //     $distLon = $apartment->longitude - $longitude;

        //     // Converti la differenza di longitudine in chilometri
        //     $distLonKm = $distLon * 111;
        //     $distLatKm = $distLat * 111;
        //     // Distanza in chilometri
        //     $distance = sqrt($distLatKm * $distLatKm + $distLonKm * $distLonKm);

        //     // Se la distanza è inferiore a 20 km, aggiungi l'appartamento all'array
        //     if ($distance <= $radiusKm) {
        //         $searchApp[] = $apartment;
        //     }
        // }

        $searchApp = $apartments->get();
        return response()->json([
            'success' => true,
            'results' => $searchApp,
        ]);
    }
}
