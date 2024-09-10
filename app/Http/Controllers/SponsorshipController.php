<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Services\BraintreeService;

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
            // Calcola le date di inizio e fine per la sponsorizzazione
            $startDate = now();
            $endDate = $startDate->copy()->addHours($sponsorship->duration);

            // Collega l'appartamento con la sponsorizzazione e registra le date
            $apartment->sponsorships()->attach($sponsorship->id, [
                'starting_date' => $startDate,
                'ending_date' => $endDate,
            ]);

            // Pagamento riuscito
            return redirect()->route('apartments.show', $apartment);
        } else {
            return redirect()->back()->with('error', 'Errore durante il pagamento: ' . $result->message);
        }
    }
}
