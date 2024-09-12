<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Mail\NewContact;
use Dotenv\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class MessageController extends Controller
{
    public function store(Request $request)

    {
        dd($request->all);
        // $data = $request->validate([
        //     'name' => "string",
        //     'email' => [
        //         'required',
        //         'string',
        //         'lowercase',
        //         'email',
        //         'max:255',
        //         'unique:' . User::class,
        //         function ($attribute, $value, $fail) {
        //             // Definisci la regex per .com o .it
        //             if (!preg_match('/^[^\s@]+@[^\s@]+\.(com|org|net|edu|gov|co|io|us|uk|de|jp|fr|it|ru|br|ca|cn|au|in|es
        //          )$/', $value)) {
        //                 $fail('Il campo email deve terminare con un domninio riconosciuto(ad esempio .com o .it)');
        //             }
        //         },
        //     ],
        //     'text' => "required|string",
        //     'apartment_id' => "required"
        // ]);

        $data = $request->all();

        $validator=FacadesValidator::make($data,[
                'name' => "string",
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
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        
        $newMsg = new Message();
        $newMsg->fill($data);
        $newMsg->save();
        //Mail::to('info@boolbnb.com')->send(new NewContact($newMsg));
        // Mail::send('emails.new-email', $data, function ($message) {
        //     $message->to('info@boolbnb.com ');
        //     $message->subject('Oggetto della mail');
        // });
        

    }
}
