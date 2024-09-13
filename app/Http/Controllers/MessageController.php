<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;

class MessageController extends Controller
{

    public function index()
    {
        $user_id = Auth::id();

        $messages = Message::whereHas('apartment', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->with('apartment')->orderBy('created_at', 'desc')->paginate(10);

        foreach ($messages as $message) {
            $message->created_at = Carbon::parse($message->created_at)->format('d-m-y H:i');
        }

        $data = [
            'messages' => $messages
        ];

        return view('admin.apartment.message.index', $data);
    }

    public function show(Message $message)

    {
        $user_id = Auth::id();
        // Verifica se l'utente autenticato è lo stesso dell'appartamento
        if ($message->apartment->user_id != $user_id) {
            // Se l'utente non è autorizzato, mostra la pagina 403
            abort(403);
        }
        $data = [
            'message' => $message,
        ];

        //dd($message);

        return view('admin.apartment.message.show', $data);
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return to_route('message.index')->with('message', 'Appartamento eliminato.');
    }
}
