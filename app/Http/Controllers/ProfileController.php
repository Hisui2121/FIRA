<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    // SHOW ACCOUNT PAGE
    public function edit()
    {
        return view('profile.account');
    }

    // UPDATE ACCOUNT
    public function update(Request $request)
    {

        $user = Auth::user();

        // VALIDATION
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',

            'password' => 'nullable|min:8|confirmed',
        ]);

        // UPDATE BASIC INFO
        $user->name = $request->name;
        $user->email = $request->email;

        // UPDATE PASSWORD ONLY IF FILLED
        if ($request->filled('password')) {

            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}