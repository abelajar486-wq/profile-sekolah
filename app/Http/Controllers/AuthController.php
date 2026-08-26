<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                session(['is_admin' => true]);
                return redirect()->route('admin.dashboard');
            } else {
                session()->forget('is_admin');
                return redirect()->route('user.dashboard');
            }
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'username'    => 'nullable|string|max:255|unique:users,username',
            'email'       => 'required|email|unique:users,email',
            'alamat'      => 'nullable|string|max:500',
            'password'    => 'required|min:6|confirmed',
            'role'        => 'required|in:admin,user',
            'is_verified' => 'nullable|in:0,1',
        ]);

        $user = User::create([
            'name'              => $request->name,
            'username'          => $request->username,
            'email'             => $request->email,
            'alamat'            => $request->alamat,
            'password'          => Hash::make($request->password),
            'role'              => $request->role,
            'email_verified_at' => $request->is_verified == '1' ? now() : null,
        ]);

        Auth::login($user);

        if ($user->role === 'admin') {
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Registrasi Admin berhasil!');
        } else {
            session()->forget('is_admin');
            return redirect()->route('user.dashboard')->with('success', 'Registrasi User berhasil!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget('is_admin');

        return redirect()->route('home');
    }
}
