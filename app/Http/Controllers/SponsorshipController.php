<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Services\BraintreeService;
use Carbon\Carbon;

class SponsorshipController extends Controller
{
    protected $braintree;

    public function __construct(BraintreeService $braintree)
    {
        $this->braintree = $braintree;
    }

    public function processPayment(Request $request, Apartment $apartment)
    {
        // Carica l'appartamento e la sponsorizzazione dai parametri dinamici
        $sponsorship = Sponsorship::find($request->sponsorship_id);
        $nonce = $request->payment_method_nonce;
        $amount = $sponsorship->price; // Ottieni l'importo dalla richiesta

        $result = $this->braintree->processPayment($nonce, $amount);

        if ($result->success) {
            // Trova l'ultima sponsorizzazione attiva, se esiste
            $currentSponsorship = $apartment->sponsorships()
                ->where('ending_date', '>', now()) // Sponsorizzazioni ancora attive
                ->orderBy('ending_date', 'desc')   // Prendi la più recente
                ->first();
            // Determina la data di inizio e fine per la nuova sponsorizzazione
            if ($currentSponsorship) {
                // Sponsorizzazione già attiva: somma la nuova durata a quella rimanente
                $startDate = Carbon::parse($currentSponsorship->pivot->ending_date); // La nuova inizia alla fine di quella attuale
            } else {
                // Nessuna sponsorizzazione attiva: inizia da ora
                $startDate = now();
            }

            // Calcola la data di fine sommando la durata della nuova sponsorizzazione
            $endDate = $startDate->copy()->addHours($sponsorship->duration);

            // Collega l'appartamento con la nuova sponsorizzazione e registra le date
            $apartment->sponsorships()->attach($sponsorship->id, [
                'starting_date' => $startDate,
                'ending_date' => $endDate,
            ]);

            // Pagamento riuscito
            return redirect()->route('success', ['slug' => $apartment->slug]);
        } else {
            // Pagamento fallito
            return redirect()->back()->with('error', 'Errore durante il pagamento: ' . $result->message);
        }
    }

    public function success($slug)
    {
        $apartment = Apartment::where('slug', $slug)->firstOrFail();

        $data = [
            'apartment' => $apartment,
        ];
        return view('Admin.Sponsorship.success', $data);
    }
}
