<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        return redirect()->route('settings.appearance');
    }

    public function appearance()
    {
        $setting = auth()->user()->setting;

        if (!$setting) {
            $setting = Setting::create([
                'user_id' => auth()->id(),
                'theme' => 'light',
                'table_density' => 'default',
                'accent_color' => '#f4b942'
            ]);
        }

        return view('settings.appearance', compact('setting'));
    }

    public function updateAppearance(Request $request)
    {
        $request->validate([
            'theme' => 'required|in:light,dark',
            'table_density' => 'required|in:default,compact,spacious',
            'accent_color' => 'required'
        ]);

        $setting = auth()->user()->setting;

        if (!$setting) {
            $setting = new Setting();
            $setting->user_id = auth()->id();
        }

        $setting->theme = $request->theme;
        $setting->table_density = $request->table_density;
        $setting->accent_color = $request->accent_color;

        $setting->save();

        return back()->with('success', 'Appearance settings updated!');
    }

    public function security()
    {
        return view('settings.security');
    }

    public function preferences()
    {
        return view('settings.preferences');
    }

    public function account()
    {
        return view('settings.account');
    }

    public function system()
    {
        return view('settings.system');
    }
}