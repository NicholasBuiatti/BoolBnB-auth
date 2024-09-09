<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    
    public function index()

    {
        $user_id = Auth::id();
        $data =
            [
                
            ];

        return view('admin.apartment.index', $data);

    }

    public function store(Request $request)

    {

    }

    public function show()

    {

    }

    public function destroy()

    {

    }

}
