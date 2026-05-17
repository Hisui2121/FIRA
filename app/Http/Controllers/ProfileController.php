<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /* =========================================
       SHOW ACCOUNT SETTINGS PAGE
    ========================================= */
    public function edit()
    {
        return view('profile.account');
    }

    /* =========================================
       UPDATE ACCOUNT
    ========================================= */
    public function update(Request $request)
    {
        $user = Auth::user();

        /* =========================
           VALIDATION
        ========================= */

        $request->validate([

            // BASIC INFO
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',

            'email' => 'required|email|max:255|unique:users,email,' . $user->id,

            'phone_number' => 'nullable|string|max:30',

            'birthdate' => 'nullable|date',

            'sex' => 'nullable|in:male,female',

            // ADDRESS
            'house_no' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'barangay' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',

            // PHOTOS
            'profile_photo' => 'nullable|image|max:2048',
            'cover_photo' => 'nullable|image|max:4096',

            // PASSWORD
            'current_password' => 'nullable|required_with:password',

            'password' => 'nullable|min:8|confirmed',
        ]);

        /* =========================
           PASSWORD CHECK
        ========================= */

        if ($request->filled('password')) {

            if (
                !Hash::check(
                    $request->current_password,
                    $user->password
                )
            ) {

                return back()->withErrors([
                    'current_password' => 'Current password is incorrect.'
                ]);
            }

            $user->password = Hash::make($request->password);
        }

        /* =========================
           PROFILE PHOTO
        ========================= */

        if ($request->hasFile('profile_photo')) {

            // DELETE OLD PHOTO
            if ($user->profile_photo) {

                Storage::disk('public')
                    ->delete($user->profile_photo);
            }

            $profilePath = $request
                ->file('profile_photo')
                ->store('profiles', 'public');

            $user->profile_photo = $profilePath;
        }

        /* =========================
           COVER PHOTO
        ========================= */

        if ($request->hasFile('cover_photo')) {

            // DELETE OLD COVER
            if ($user->cover_photo) {

                Storage::disk('public')
                    ->delete($user->cover_photo);
            }

            $coverPath = $request
                ->file('cover_photo')
                ->store('covers', 'public');

            $user->cover_photo = $coverPath;
        }

        /* =========================
           UPDATE USER DATA
        ========================= */

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        $user->email = $request->email;

        $user->phone_number = $request->phone_number;

        $user->birthdate = $request->birthdate;
        $user->sex = $request->sex;

        $user->house_no = $request->house_no;
        $user->street = $request->street;
        $user->barangay = $request->barangay;
        $user->city = $request->city;

        $user->save();

        return back()->with(
            'success',
            'Account settings updated successfully.'
        );
    }

    /* =========================================
       UPDATE PROFILE PHOTO ONLY
    ========================================= */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|max:2048'
        ]);

        $user = Auth::user();

        // DELETE OLD
        if ($user->profile_photo) {

            Storage::disk('public')
                ->delete($user->profile_photo);
        }

        $path = $request->file('profile_photo')
                        ->store('profiles', 'public');

        $user->update([
            'profile_photo' => $path
        ]);

        return back()->with(
            'success',
            'Profile photo updated.'
        );
    }

    /* =========================================
       UPDATE COVER PHOTO ONLY
    ========================================= */
    public function updateCover(Request $request)
    {
        $request->validate([
            'cover_photo' => 'required|image|max:4096'
        ]);

        $user = Auth::user();

        // DELETE OLD
        if ($user->cover_photo) {

            Storage::disk('public')
                ->delete($user->cover_photo);
        }

        $path = $request->file('cover_photo')
                        ->store('covers', 'public');

        $user->update([
            'cover_photo' => $path
        ]);

        return back()->with(
            'success',
            'Cover photo updated.'
        );
    }
}