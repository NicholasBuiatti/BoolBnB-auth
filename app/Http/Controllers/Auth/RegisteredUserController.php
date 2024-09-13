<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Statistic;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([

            // 'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
                function ($attribute, $value, $fail) {
                    // Definisci la regex per .com o .it
                    if (!preg_match('/^[^\s@]+@[^\s@]+\.(com|org|net|edu|gov|co|io|us|uk|de|jp|fr|it|ru|br|ca|cn|au|in|es
                 )$/', $value)) {
                        $fail('Il campo email deve terminare con un domninio riconosciuto(ad esempio .com o .it)');
                    }
                },
            ],

            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            //chi c'ha voglia, c'è da sistemare il messaggio della data di nascita che mostra nell'errore il formato y-m-d
            'birth_date' => ['required', 'date', 'before:' . now()->subYears(18)->toDateString()]
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

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
    }
}
