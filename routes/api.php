<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApartmentController as ApiApartmentController;
use App\Http\Controllers\Api\ServiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('apartments', [ApiApartmentController::class, 'index']);
Route::get('apartments/{apartment}', [ApiApartmentController::class, 'show']);

//RICHIESTA DATI DAL FRONT
Route::post('search', [ApiApartmentController::class, 'search']);

Route::get('services', [ServiceController::class, 'index']);

