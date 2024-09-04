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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class,
            function ($attribute, $value, $fail) {
                // Definisci la regex per .com o .it
                if (!preg_match('/^[^\s@]+@[^\s@]+\.(com|org|net|edu|gov|co|io|us|uk|de|jp|fr|it|ru|br|ca|cn|au|in|es
                 )$/', $value)) {
                    $fail('Il campo email deve terminare con un domninio riconosciuto(ad esempio .com o .it)');
                }
            },],

            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            //chi c'ha voglia, c'è da sistemare il messaggio della data di nascita che mostra nell'errore il formato y-m-d
            'birth_date' => ['required', 'date', 'before:' . now()->subYears(18)->toDateString()]
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'birth_date' =>$request->birth_date,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return view('dashboard');
    }
}
