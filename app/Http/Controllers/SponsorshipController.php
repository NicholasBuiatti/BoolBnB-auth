<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BraintreeService;

class SponsorshipController extends Controller
{
    protected $braintree;

    public function __construct(BraintreeService $braintree)
    {
        $this->braintree = $braintree;
    }

    public function showSponsorships()
    {
        // Qui puoi ottenere le sponsorizzazioni, ad esempio, da un modello Sponsorship
        $sponsorships = [
            ['id' => 1, 'name' => 'Base', 'price' => 10],
            ['id' => 2, 'name' => 'Standard', 'price' => 20],
            ['id' => 3, 'name' => 'Premium', 'price' => 30],
        ];

        $clientToken = $this->braintree->clientToken();

        return view('Admin.sponsorship.index', compact('sponsorships', 'clientToken'));
    }

    public function processPayment(Request $request)
    {
        $nonce = $request->payment_method_nonce;
        $amount = $request->amount; // Ottieni l'importo dalla richiesta

        $result = $this->braintree->processPayment($nonce, $amount);

        if ($result->success) {
            // Pagamento riuscito
            return redirect()->back()->with('success', 'Pagamento completato con successo!');
        } else {
            // Pagamento fallito
            return redirect()->back()->with('error', 'Errore durante il pagamento: ' . $result->message);
        }
    }
}
