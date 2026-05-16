<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show Step 1
    public function create()
    {
        return view('register', ['step' => 1]);
    }
    // Handle back navigation
    public function back(Request $request)
    {
        $goToStep = $request->input('go_to_step');

        if ($goToStep == 1) {
            return view('register', ['step' => 1]);
        }

        if ($goToStep == 2) {
            return view('register', ['step' => 2]);
        }

        return redirect('/register');
    }

    // Handle all step submissions
    public function store(Request $request)
    {
        $step = $request->input('step');

        if ($step == 1) {
            $request->validate([
                'first_name'           => 'required|string|max:255',
                'last_name'            => 'required|string|max:255',
                'email'                => 'required|email|unique:users,email',
                'password'             => 'required|min:8|confirmed',
            ]);

            session([
                'register.first_name' => $request->first_name,
                'register.last_name'  => $request->last_name,
                'register.email'      => $request->email,
                'register.password'   => $request->password,
            ]);

            return view('register', ['step' => 2]);
        }

        if ($step == 2) {
            $request->validate([
                'birthdate' => 'required|date',
                'sex'       => 'required|in:Male,Female',
                'phone'     => 'required|string|max:20',
                'city'      => 'required|string|max:255',
                'barangay'  => 'required|string|max:255',
                'street'    => 'required|string|max:255',
                'house_no'  => 'required|string|max:50',
            ]);

            session([
                'register.birthdate' => $request->birthdate,
                'register.sex'       => $request->sex,
                'register.phone'     => $request->phone,
                'register.city'      => $request->city,
                'register.barangay'  => $request->barangay,
                'register.street'    => $request->street,
                'register.house_no'  => $request->house_no,
            ]);

            return view('register', ['step' => 3]);
        }

        if ($step == 3) {
            $data = session()->get('register');

            // Safety check — if session expired, restart
            if (!$data) {
                return redirect('/register')->with('error', 'Session expired. Please register again.');
            }

            $user = User::create([
            'first_name'   => $data['first_name'],
            'last_name'    => $data['last_name'],
            'email'        => $data['email'],
            'password'     => Hash::make($data['password']),
            'birthdate'    => $data['birthdate'],
            'sex'          => $data['sex'],
            'phone_number' => $data['phone'],
            'city'         => $data['city'],
            'barangay'     => $data['barangay'],
            'street'       => $data['street'],
            'house_no'     => $data['house_no'],
            ]);

            // Only assign role if the role exists
            if (\Spatie\Permission\Models\Role::where('name', 'staff')->exists()) {
                $user->assignRole('staff');
            }

            session()->forget('register');

            return view('register', ['step' => 'success']);
        }
    }
}