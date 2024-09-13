<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SponsorshipController;
use Illuminate\Support\Facades\Route;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Statistic;
use Illuminate\Support\Carbon;
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

    // Recupera il catalogo degli appartamenti dell'utente
    $catalogue = Apartment::where('user_id', $user_id)->with(['services'])->paginate(8);

    // Recupera i messaggi associati agli appartamenti dell'utente
    $messages = Message::whereHas('apartment', function ($query) use ($user_id) {
        $query->where('user_id', $user_id);
    })->with('apartment')->paginate(10);

    // Ottieni la data di inizio e fine del mese corrente
    $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
    $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

    // Recupera gli ID degli appartamenti dell'utente
    $userApartmentsIds = Apartment::where('user_id', $user_id)->pluck('id');

    // Conta le visite agli appartamenti dell'utente nel mese corrente
    $visitCount = Statistic::whereIn('apartment_id', $userApartmentsIds)
        ->whereBetween('date_visit', [$startOfMonth, $endOfMonth])
        ->distinct('ip_address') // Assicurati di contare solo le visite uniche
        ->count('ip_address');
    $visitCount = $visitCount ?? 0;
    // Passa tutti i dati alla vista
    $data = [
        'catalogue' => $catalogue,
        'messages' => $messages,
        'visitCount' => $visitCount,
    ];

    return view('dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/', function () {
//     $user_id = Auth::id();
//     $catalogue = Apartment::where('user_id', $user_id)->with(['services'])->paginate(8);
//     $messages = Message::whereHas('apartment', function ($query) use ($user_id) {
//         $query->where('user_id', $user_id);
//     })->with('apartment')->paginate(10);
//     $data =
//         [
//             'catalogue' => $catalogue,
//             'messages' => $messages,
//         ];
//     return view('dashboard', $data);
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/apartments/force-delete/{id}', [ApartmentController::class, 'forceDelete'])->name('apartments.forceDelete');

    // ROTTE APARTAMENTI E SOFT DELETE

    Route::get('/apartments/bin', [ApartmentController::class, 'bin'])->name('apartments.bin');
    Route::resource('/apartments', ApartmentController::class);
    Route::get('/apartments/restore/{id}', [ApartmentController::class, 'restore'])->name('apartments.restore');

    // ROTTE PER I MESSAGGI

    Route::get('/message', [MessageController::class, 'index'])->name('message.index');
    Route::get('/message/{message}', [MessageController::class, 'show'])->name('message.show');
    Route::post('/message/store', [MessageController::class, 'store'])->name('message.store');

    // ROTTE PER LA SPONSORSHIP

    Route::get('/success/{id}', [SponsorshipController::class, 'success'])->name('success');
    Route::get('/apartments/{apartment}/sponsorships', [ApartmentController::class, 'showSponsorships'])->name('sponsorships.index');
    Route::post('/apartments/{apartment}/sponsorships/payment', [SponsorshipController::class, 'processPayment'])->name('sponsorships.payment');
});

require __DIR__ . '/auth.php';
