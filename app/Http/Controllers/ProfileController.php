<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile');
    }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //     ]);

    //     $user = Auth::user();
    //     $user->update([
    //         'name'  => $request->name,
    //         'email' => $request->email,
    //     ]);

    //     return redirect()->route('profile.edit')->with('status', 'Profile updated!');
    // }
}
