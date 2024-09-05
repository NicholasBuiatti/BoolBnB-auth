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
        $apartments = Apartment::with(['user'])/*aggiungere servizi*/->paginate();
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
}

// namespace App\Http\Controllers;

// use League\Geotools\Coordinate\Coordinate;
// use League\Geotools\Distance\Distance;
// use League\Geotools\Geotools;

// class LocationController extends Controller
// {
//     public function calculateDistance()
//     {
//         $geotools = new Geotools();

//         // Coordinate di Milano (esempio)
//         $coord1 = new Coordinate([45.464211, 9.191383]); // latitudine, longitudine

//         // Coordinate di un altro punto
//         $coord2 = new Coordinate([45.560, 9.210]);

//         // Calcolo della distanza
//         $distance = $geotools->distance()->setFrom($coord1)->setTo($coord2);

//         // Distanza in chilometri
//         $distanceInKm = $distance->flat(); // Puoi anche usare vincenty() o haversine() per altre metodologie

//         return response()->json([
//             'distance_km' => $distanceInKm
//         ]);
//     }
// }
