<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    // Show the registration form
    public function create() {
        return view('register');
    }

    // Handle form submission
    public function store(Request $request) {
        // Validate inputs
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Save to database
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password), // encrypt password
        ]);

        return redirect('/register')->with('success', 'Registered successfully!');
    }
}