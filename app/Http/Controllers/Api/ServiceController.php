<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->json([
            'success' => true,
            'results' => $services,
        ]);
        /*http://127.0.0.1:8000/api/services*/
    }
}
