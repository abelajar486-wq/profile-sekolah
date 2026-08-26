<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PpdbExport;
use App\Models\Setting;
use Maatwebsite\Excel\Facades\Excel;

class PpdbController extends Controller
{
    public function index(Request $request)
    {
        $query = PpdbRegistration::query();

        if ($request->filled('status')) {
            $query->where('status_pendaftaran', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', '%' . $search . '%')
                  ->orWhere('nisn', 'like', '%' . $search . '%')
                  ->orWhere('asal_sekolah', 'like', '%' . $search . '%')
                  ->orWhere('jurusan_pilihan', 'like', '%' . $search . '%');
            });
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

    public function exportPdf(Request $request)
    {
        $query = PpdbRegistration::query();

        if ($request->filled('status')) {
            $query->where('status_pendaftaran', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', '%' . $search . '%')
                  ->orWhere('nisn', 'like', '%' . $search . '%')
                  ->orWhere('asal_sekolah', 'like', '%' . $search . '%')
                  ->orWhere('jurusan_pilihan', 'like', '%' . $search . '%');
            });
        }

        $registrations = $query->latest()->get();
        $settings = Setting::pluck('value', 'key')->toArray();

        $pdf = Pdf::loadView('admin.ppdb.pdf', compact('registrations', 'settings'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('data-pendaftaran-ppdb.pdf');
    }

    public function exportExcel(Request $request)
    {
        $query = PpdbRegistration::query();

        if ($request->filled('status')) {
            $query->where('status_pendaftaran', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', '%' . $search . '%')
                  ->orWhere('nisn', 'like', '%' . $search . '%')
                  ->orWhere('asal_sekolah', 'like', '%' . $search . '%')
                  ->orWhere('jurusan_pilihan', 'like', '%' . $search . '%');
            });
        }

        $registrations = $query->latest()->get();
        $settings = Setting::pluck('value', 'key')->toArray();

        return Excel::download(new PpdbExport($registrations, $settings), 'data-pendaftaran-ppdb.xlsx');
    }
}
