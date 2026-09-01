<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PpdbExport;
use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
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
                $q->where('nama_lengkap', 'like', '%'.$search.'%')
                    ->orWhere('nisn', 'like', '%'.$search.'%')
                    ->orWhere('asal_sekolah', 'like', '%'.$search.'%')
                    ->orWhere('jurusan_pilihan', 'like', '%'.$search.'%');
            });
        }

        $registrations = $query->latest()->paginate(10);

        return view('admin.ppdb.index', compact('registrations'));
    }

    public function show(PpdbRegistration $ppdb)
    {
        return view('admin.ppdb.show', compact('ppdb'));
    }

    private function getRandomMotivationalQuote(): string
    {
        $quotes = [
            'Jangan berkecil hati! Kegagalan hanyalah batu loncatan menuju keberhasilan yang lebih besar. Tetap semangat dan pantang menyerah!',
            'Satu pintu tertutup, tetapi seribu pintu kesempatan lain sedang terbuka lebar untukmu. Teruslah berjuang dan percaya pada potensi luar biasa dalam dirimu!',
            'Hasil hari ini bukanlah akhir dari segalanya. Jadikan ini pemicu semangat untuk terus belajar, tumbuh, dan meraih impian terbaikmu!',
            'Setiap langkah perjuanganmu sangat berharga. Tetap tegakkan kepala dan tunjukkan bahwa kamu bisa sukses di mana pun kamu berada!',
            'Jangan pernah berhenti bermimpi dan berusaha. Masa depan yang cerah selalu menanti mereka yang pantang menyerah!',
            'Kegagalan terbesar adalah ketika kita berhenti mencoba. Bangkitlah dengan senyuman dan buktikan kemampuan terbaikmu!',
        ];

        return $quotes[array_rand($quotes)];
    }

    private function getRandomCongratulatoryQuote(): string
    {
        $quotes = [
            'Selamat! Anda resmi diterima sebagai calon siswa baru. Selamat bergabung di keluarga besar sekolah kami dan raihlah prestasi setinggi-tingginya!',
            'Selamat atas kelulusan seleksi PPDB! Langkah awal menuju masa depan yang cemerlang dimulai dari sini. Tetap semangat mengukir prestasi!',
            'Selamat! Perjuangan dan kerja kerasmu telah membuahkan hasil membanggakan. Kami sangat bangga dan menyambut hangat kehadiranmu!',
            'Selamat bergabung! Persiapkan dirimu untuk petualangan belajar yang seru, bermakna, dan penuh prestasi di sekolah kami!',
            'Selamat! Kamu berhasil melewati seleksi PPDB dengan sangat baik. Semoga sukses selalu dan bisa membanggakan orang tua serta sekolah!',
        ];

        return $quotes[array_rand($quotes)];
    }

    public function update(Request $request, PpdbRegistration $ppdb)
    {
        $validated = $request->validate([
            'status_pendaftaran' => 'required|in:pending,diterima,ditolak',
            'catatan_admin' => 'nullable|string|max:1000',
        ]);

        // Jika catatan admin kosong, isi secara otomatis dengan kata-kata ucapan / semangat acak
        if (empty($validated['catatan_admin'])) {
            if ($validated['status_pendaftaran'] === 'ditolak') {
                $validated['catatan_admin'] = $this->getRandomMotivationalQuote();
            } elseif ($validated['status_pendaftaran'] === 'diterima') {
                $validated['catatan_admin'] = $this->getRandomCongratulatoryQuote();
            }
        }

        $hasChange = false;

        $textKeys = ['status_pendaftaran', 'catatan_admin'];

        foreach ($textKeys as $key) {
            $newVal = isset($validated[$key]) ? trim((string) $validated[$key]) : '';
            $oldVal = isset($ppdb->{$key}) ? trim((string) $ppdb->{$key}) : '';
            if ($newVal !== $oldVal) {
                $hasChange = true;
                break;
            }
        }

        if (! $hasChange) {
            return redirect()->route('admin.ppdb.index')->with('info', 'Tidak ada perubahan pada data PPDB.');
        }

        $ppdb->update($validated);

        $statusText = $validated['status_pendaftaran'] === 'diterima' ? 'Diterima' : ($validated['status_pendaftaran'] === 'ditolak' ? 'Ditolak' : 'Pending');

        return redirect()->route('admin.ppdb.index')->with('success', "Status pendaftaran {$ppdb->nama_lengkap} berhasil diubah menjadi {$statusText}!");
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
                $q->where('nama_lengkap', 'like', '%'.$search.'%')
                    ->orWhere('nisn', 'like', '%'.$search.'%')
                    ->orWhere('asal_sekolah', 'like', '%'.$search.'%')
                    ->orWhere('jurusan_pilihan', 'like', '%'.$search.'%');
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
                $q->where('nama_lengkap', 'like', '%'.$search.'%')
                    ->orWhere('nisn', 'like', '%'.$search.'%')
                    ->orWhere('asal_sekolah', 'like', '%'.$search.'%')
                    ->orWhere('jurusan_pilihan', 'like', '%'.$search.'%');
            });
        }

        $registrations = $query->latest()->get();
        $settings = Setting::pluck('value', 'key')->toArray();

        return Excel::download(new PpdbExport($registrations, $settings), 'data-pendaftaran-ppdb.xlsx');
    }
}
