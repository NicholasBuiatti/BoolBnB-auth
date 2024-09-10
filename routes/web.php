<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::get('/', function () {
    $user_id = Auth::id();
    $catalogue = Apartment::where('user_id', $user_id)->with(['services'])->paginate(8);
    $data =
        [
            'catalogue' => $catalogue,
        ];
    return view('dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/apartments/force-delete/{id}', [ApartmentController::class, 'forceDelete'])->name('apartments.forceDelete');
    Route::get('/apartments/bin', [ApartmentController::class, 'bin'])->name('apartments.bin');
    Route::resource('/apartments', ApartmentController::class);
    Route::get('/apartments/restore/{id}', [ApartmentController::class, 'restore'])->name('apartments.restore');
    Route::get('/message',[MessageController::class,'index'])->name('message.index');
    Route::post('/message/store',[MessageController::class,'store'])->name('message.store');
    Route::get('/message/{message}',[MessageController::class,'show'])->name('message.show');
});

require __DIR__ . '/auth.php';
