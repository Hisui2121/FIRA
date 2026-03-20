<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    // ── STEP 1 ── Show
    public function step1()
    {
        return view('register.step1');
    }

    // ── STEP 1 ── Store
    public function step1Store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:8|confirmed',
            'terms'      => 'accepted',
        ], [
            'terms.accepted'     => 'You must agree to the terms and conditions.',
            'password.confirmed' => 'Passwords do not match.',
            'email.unique'       => 'This email is already registered.',
        ]);

        // Store as single array key — avoids dot notation issues
        session(['register' => [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => $request->password,
        ]]);

        return redirect()->route('register.step2');
    }

    // ── STEP 2 ── Show
    public function step2()
    {
        if (!session('register.email')) {
            return redirect()->route('register.step1');
        }
        return view('register.step2');
    }

    // ── STEP 2 ── Store
    public function step2Store(Request $request)
    {
        $request->validate([
    'birthdate'    => 'required|date|before:today',
    'sex'          => 'required|in:Male,Female',
    'phone_number' => [
        'required',
        'digits:10',                    // exactly 10 digits
        'regex:/^9[0-9]{9}$/',          // must start with 9
    ],
    ],
    [
        'phone_number.digits' => 'Phone number must be exactly 10 digits.',
        'phone_number.regex'  => 'Phone number must start with 9 (e.g. 9XX XXX XXXX).',
    ]);

// Clean phone number before storing
$phone = $request->phone_number;
$phone = ltrim($phone, '+');
$phone = preg_replace('/^63/', '', $phone);

$register = session('register', []);
$register['phone_number'] = $phone;

        // Merge with existing session array
        $register = session('register', []);
        $register['birthdate']    = $request->birthdate;
        $register['sex']          = $request->sex;
        $register['phone_number'] = $request->phone_number;
        $register['city']         = $request->city;
        $register['barangay']     = $request->barangay;
        $register['street']       = $request->street;
        $register['house_no']     = $request->house_no;
        session(['register' => $register]);

        return redirect()->route('register.step3');
    }

    // ── STEP 3 ── Show
    public function step3()
    {
        if (!session('register.email') || !session('register.birthdate')) {
            return redirect()->route('register.step1');
        }
        return view('register.step3');
    }

    // ── STEP 3 ── Final Submit
    public function step3Store(Request $request)
    {
        $data = session('register');

        if (!$data || empty($data['email'])) {
            return redirect()->route('register.step1')
                ->with('error', 'Session expired. Please start again.');
        }

        User::create([
            'first_name'   => $data['first_name'],
            'last_name'    => $data['last_name'],
            'email'        => $data['email'],
            'password'     => bcrypt($data['password']),  // ← manually hash
            'birthdate'    => $data['birthdate'],
            'sex'          => $data['sex'],
            'phone_number' => $data['phone_number'],
            'city'         => $data['city']         ?? null,
            'barangay'     => $data['barangay']     ?? null,
            'street'       => $data['street']       ?? null,
            'house_no'     => $data['house_no']     ?? null,
        ]);

        // Clear registration session
        session()->forget('register');

        return redirect()->route('register.success');
    }

    // ── SUCCESS ──
    public function success()
    {
        return view('register.success');
    }
}