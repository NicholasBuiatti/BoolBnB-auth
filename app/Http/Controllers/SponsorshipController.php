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

    public function showSponsorships(Apartment $apartment)
    {
        // Qui puoi ottenere le sponsorizzazioni, ad esempio, da un modello Sponsorship
        $data = [
            'sponsorships' => Sponsorship::all(),
            'apartment' => $apartment,
            'clientToken' => $this->braintree->clientToken()
        ];

        return view('Admin.sponsorship.index', $data);
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
            $endDate = $startDate->copy()->addHours($sponsorship->duration); // Assumendo che `duration_in_days` sia un campo in Sponsorship
            // dd($startDate, $endDate, $sponsorship->duration);
            // Collega l'appartamento con la sponsorizzazione e registra le date
            $apartment->sponsorships()->attach($sponsorship->id, [
                'starting_date' => $startDate,
                'ending_date' => $endDate,
            ]);

            // dd($apartment);
            // if ($result->success) {
            //     // Pagamento riuscito
            return redirect()->route('apartments.bin');
            // } 
        } else {
            return redirect()->back()->with('error', 'Errore durante il pagamento: ' . $result->message);
        }
    }
}
