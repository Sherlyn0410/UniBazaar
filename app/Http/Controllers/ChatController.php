<?php

namespace App\Http\Controllers;

use App\Models\User;

class ChatController extends Controller
{
    public function show($sellerId)
    {
        $seller = User::findOrFail($sellerId);
        return view('chat', compact('seller'));
    }
}
