<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function store(Request $request)

    {

        $data = $request->validate([
            'name' => "string|nullable",
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
            'text' => "required|string",
            'apartment_id' => "required"
        ]);

        // $data = $request->all();
        $newMsg = new Message();
        $newMsg->fill($data);
        $newMsg->save();
    }
}
