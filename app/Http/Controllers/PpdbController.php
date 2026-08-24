<?php

namespace App\Http\Controllers;

use App\Models\PpdbRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PpdbController extends Controller
{
    public function info()
    {
        return view('public.ppdb-info');
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mendaftar PPDB.');
        }

        $user = Auth::user();
        $existing = PpdbRegistration::where('user_id', $user->id)->first();

        if ($existing) {
            return redirect()->route('user.ppdb.status')->with('info', 'Anda sudah mengisi formulir pendaftaran PPDB.');
        }

        return view('public.ppdb-daftar', compact('user'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mendaftar PPDB.');
        }

        $user = Auth::user();

        $validated = $request->validate([
            'nisn'           => 'required|string|size:10|unique:ppdb_registrations,nisn',
            'nama_lengkap'   => 'required|string|max:255',
            'tempat_lahir'   => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'alamat'         => 'required|string',
            'asal_sekolah'   => 'required|string|max:255',
            'nama_ortu'      => 'required|string|max:255',
            'no_hp_ortu'     => 'required|string|max:20',
            'jurusan_pilihan'=> 'required|string|max:100',
        ]);

        $validated['user_id'] = $user->id;
        $validated['tanggal_daftar'] = now();

        PpdbRegistration::create($validated);

        return redirect()->route('user.ppdb.status')->with('success', 'Pendaftaran PPDB berhasil! Silakan cek status pendaftaran Anda.');
    }

    public function status()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        $registration = PpdbRegistration::where('user_id', $user->id)->first();

        return view('user.ppdb', compact('user', 'registration'));
    }
}
