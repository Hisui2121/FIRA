<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // I-check kung nilagyan ng check ng user yung box (magiging true o false)
        $remember = $request->has('remember');

        // Idagdag ang $remember variable bilang second parameter
        if (Auth::attempt($request->only('email', 'password'), $remember)) {

            $user = Auth::user();
    
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }
    
            return redirect()->route('staff.dashboard');
        }    

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    public function destroy() {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}