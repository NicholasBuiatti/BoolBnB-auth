<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;
class MessageController extends Controller
{
    
    public function index()

    {
        $user_id = Auth::id();
        $data = 
            [
            'messages' => Message::whereHas('apartment',
             function ($query) use ($user_id) {
            $query->where('user_id', $user_id);})->get(),
            ];

        return view('admin.apartment.message.index', $data);

    }

   
    public function store(Request $request)

    {

        $data = $request->validate([
            'name'=>"string",
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class,
            function ($attribute, $value, $fail) {
                // Definisci la regex per .com o .it
                if (!preg_match('/^[^\s@]+@[^\s@]+\.(com|org|net|edu|gov|co|io|us|uk|de|jp|fr|it|ru|br|ca|cn|au|in|es
                 )$/', $value)) {
                    $fail('Il campo email deve terminare con un domninio riconosciuto(ad esempio .com o .it)');
                }
            },],
            'text'=>"required|string",
        ]);
        $newMsg=new Message();
        $newMsg->fill($data);
        $newMsg->save();

        return redirect()->route('message.index');

    }

}
