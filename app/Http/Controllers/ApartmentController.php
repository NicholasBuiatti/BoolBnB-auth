<?php

namespace App\Http\Controllers;


use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsorship;
use App\Services\BraintreeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    // creo la funzione per trasformare l'indirizzo in coordinate tramite chiamata api
    public function getCoordinatesFromAddress($address)
    {
        $apiKey = "RUfkTtEK0CYbHBG3YE2RSEslSRGAWZcu";

        $urlAddress = urlencode($address);

        $url = "https://api.tomtom.com/search/2/geocode/{$urlAddress}.json?key={$apiKey}";

        // effettuo la chiamata api,
        $response = Http::withOptions(['verify' => false])->get($url);
        // DA ELIMINARE IN CASO DI DEPLOY (IN PRODUZIONE)

        // controllo che ci sia una risposta e la salvo nelle variabili latitude e longitude FUNZIONA!!!!
        if ($response->successful()) {
            $data = $response->json();

            if (!empty($data['results'])) {
                $latitude = $data['results'][0]['position']['lat'];
                $longitude = $data['results'][0]['position']['lon'];

                return [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                ];
            }
        }
    }

    public function index()
    {
        $user_id = Auth::id();
        $data =
            [
                'catalogue' => Apartment::where('user_id', $user_id)->with(['services'])->paginate(8),
            ];

        return view('admin.apartment.index', $data);
    }

    public function create()
    {

        $data = [
            "services" => Service::all(),
        ];

        return view('admin.apartment.create', $data);
    }

    public function store(Request $request)
    {
        //validating data inserted
        $data = $request->validate([
            "title" => "string|required|min:6",
            "rooms" => "required|numeric|min:1",
            "beds" => "required|numeric|min:1",
            "bathrooms" => "required|numeric|min:1",
            "dimension_mq" => "required|numeric|min:15",
            "address_full" => "required|string|min:8",
            "image" => "required|image|max:5120",
            "services" => "array",
            'services.*' => "exists:services,id",
        ]);

        // mando i dati dell'indirizzo alla mia funzione per le coordinate
        $responseAddress = $this->getCoordinatesFromAddress($data['address_full']);
        //requesting data from form
        //creating new istance of Apartment
        $newApartment = new Apartment();


        $newApartment->user_id = Auth::id();
        if ($request->has('image')) {
            $img_path = Storage::put('uploads', $request->image);
            $data['image'] = $img_path;
        };

        // salvo i dati delle coordinate nel database FUNZIONAAAAAAAA!
        $newApartment->longitude = $responseAddress['longitude'];
        $newApartment->latitude = $responseAddress['latitude'];
        $data['is_visible'] = $request->has('is_visible') ? 1 : 0;

        $newApartment->fill($data);
        $newApartment->save();

        if (isset($data['services'])) {
            $newApartment->services()->attach($data['services']);
        }

        return redirect()->route('apartments.index');
    }


    protected $braintree;

    public function __construct(BraintreeService $braintree)
    {
        $this->braintree = $braintree;
    }

    public function show(Request $request, Apartment $apartment)
    {
        // Ottieni l'utente autenticato
        $user = auth()->user();
        // Verifica se l'utente autenticato è lo stesso dell'appartamento
        if ($apartment->user_id != $user->id) {
            // Se l'utente non è autorizzato, mostra la pagina 404
            abort(403);
        }

        // Se l'utente è autorizzato, passa i dati alla vista
        $data = [
            'apartment' => $apartment,
            'sponsorships' => Sponsorship::all(),
            'clientToken' => $this->braintree->clientToken()
        ];

        return view('admin.apartment.show', $data);
    }

    public function edit(Apartment $apartment)
    {
        // Ottieni l'utente autenticato
        $user = auth()->user();

        // Verifica se l'utente autenticato è lo stesso dell'appartamento
        if ($apartment->user_id != $user->id) {
            // Se l'utente non è autorizzato, mostra la pagina 404
            abort(403);
        }

        $data = [
            'apartment' => $apartment,
            'services' => Service::all(),
            "relations" => $apartment->services->pluck('id')->toArray()
        ];

        return view('admin.apartment.edit', $data);
    }

    public function update(Request $request, Apartment $apartment)
    {

        $data = $request->validate([
            "title" => "string|required|min:6",
            "rooms" => "required|numeric|min:1",
            "beds" => "required|numeric|min:1",
            "bathrooms" => "required|numeric|min:1",
            "dimension_mq" => "required|numeric|min:15",
            "address_full" => "required|string|min:8",
            "image" => "image|max:5120",
            "services" => "array",
            'services.*' => "exists:services,id",

        ]);

        if ($request->has('image')) {
            $img_path = Storage::put('uploads', $request->image);
            $data['image'] = $img_path;
            if ($apartment->image && !Str::startsWith($apartment->image, 'http')) {
                Storage::delete($apartment->image);
            };
        };

        $responseAddress = $this->getCoordinatesFromAddress($data['address_full']);
        $data['longitude'] = $responseAddress['longitude'];
        $data['latitude'] = $responseAddress['latitude'];

        $data['is_visible'] = $request->has('is_visible') ? 1 : 0;

        $apartment->update($data);

        if (isset($data['services'])) {
            $apartment->services()->sync($data['services']);
        }

        return redirect()->route('apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     */






    //--------------------destroy function 
    public function destroy(Apartment $apartment)
    {

        if ($apartment->img && !Str::startsWith($apartment->img, 'http')) {
            Storage::delete($apartment->img);
        }

        $apartment->delete();

        return to_route('apartments.index')->with('message', 'Appartamento eliminato.');
    }
    public function restore($id)
    {
        $apartment = Apartment::withTrashed()->find($id);
        $apartment->restore();
        return to_route('apartments.index')->with('success', 'Appartamento ripristinato!.');
    }
    public function forceDelete($id)
    {
        $apartment = Apartment::onlyTrashed()->find($id);

        if ($apartment) {
            $apartment->forceDelete();
            return redirect()->route('apartments.bin')->with('success', 'apartment permanently deleted');
        }

        return redirect()->route('apartments.index')->with('error', 'Post not found');
    }
    public function bin()
    {
        $user_id = Auth::id();

        // Ottieni solo gli appartamenti soft deleted
        $bin = Apartment::onlyTrashed()->where('user_id', $user_id)->get();

        $data = [
            'bin' => $bin,
        ];

        return view('admin.apartment.bin', $data);
    }
}
