<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('user.dashboard', compact('settings'));
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            if (! $request->filled('current_password') || ! Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Password saat ini tidak sesuai!');
            }
            $data['password'] = Hash::make($request->password);
        }

        $hasChange = false;

        $textKeys = ['name', 'email'];

        foreach ($textKeys as $key) {
            $newVal = isset($data[$key]) ? trim((string) $data[$key]) : '';
            $oldVal = isset($user->{$key}) ? trim((string) $user->{$key}) : '';
            if ($newVal !== $oldVal) {
                $hasChange = true;
                break;
            }
        }

        if (! $hasChange) {
            return redirect()->route('user.profile')->with('info', 'Tidak ada perubahan pada profil Anda.');
        }

        $user->update($data);

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
