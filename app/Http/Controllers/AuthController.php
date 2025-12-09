<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Assign default role (misalnya 'user')
        $user->assignRole('user');

        // Bisa login langsung
        Auth::login($user);

        // Update last login
        $user->update([
            'last_login_at' => Carbon::now()
        ]);

        // Log registration activity
        ActivityLog::create([
            'user_id' => $user->id,
            'description' => "{$user->name} registered a new account",
            'event' => 'register',
            'properties' => [
                'registration_time' => Carbon::now()->toDateTimeString(),
            ]
        ]);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil');
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Email atau password salah');
        }

        // Update last login
        $user = Auth::user();
        $user->update([
            'last_login_at' => Carbon::now()
        ]);

        // Log login activity
        ActivityLog::create([
            'user_id' => $user->id,
            'description' => "{$user->name} logged in to the system",
            'event' => 'login',
            'properties' => [
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'login_time' => Carbon::now()->toDateTimeString(),
            ]
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        // Log logout activity sebelum logout
        if (Auth::check()) {
            $user = Auth::user();

            ActivityLog::create([
                'user_id' => $user->id,
                'description' => "{$user->name} logged out from the system",
                'event' => 'logout',
                'properties' => [
                    'logout_time' => Carbon::now()->toDateTimeString(),
                ]
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil');
    }
}
