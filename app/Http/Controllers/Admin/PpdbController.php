<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use Illuminate\Http\Request;

class PpdbController extends Controller
{
    public function index(Request $request)
    {
        $query = PpdbRegistration::query();

        if ($request->filled('status')) {
            $query->where('status_pendaftaran', $request->status);
        }

        $registrations = $query->latest()->paginate(10);

        return view('admin.ppdb.index', compact('registrations'));
    }

    public function show(PpdbRegistration $ppdb)
    {
        return view('admin.ppdb.show', compact('ppdb'));
    }

    public function update(Request $request, PpdbRegistration $ppdb)
    {
        $validated = $request->validate([
            'status_pendaftaran' => 'required|in:pending,diterima,ditolak',
            'catatan_admin'      => 'nullable|string|max:1000',
        ]);

        $ppdb->update($validated);

        return redirect()->route('admin.ppdb.index')->with('success', 'Status pendaftaran berhasil diperbarui!');
    }
}
