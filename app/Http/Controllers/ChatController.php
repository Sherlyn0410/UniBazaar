<?php

namespace App\Http\Controllers;

use App\Models\User;

class ChatController extends Controller
{
    public function show()
    {
        return view('chat');
    }
}
