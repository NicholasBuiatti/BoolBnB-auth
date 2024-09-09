<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
class MessageController extends Controller
{
    
    public function index()

    {
        $user_id = Auth::id();
        $data = 
            [
            'messages' => Message::whereHas('apartment',
             function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get(),
            ];

        return view('admin.apartment.message.index', $data);

    }

   

}
