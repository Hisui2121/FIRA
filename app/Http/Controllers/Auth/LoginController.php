<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AuditHelper;

class LoginController extends Controller
{
    public function create() {
        return view('login');
    }

    public function store(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to login
        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();

            AuditHelper::log(
                'LOGIN',
                'Login',
                $user->name.' logged in'
            );
    
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