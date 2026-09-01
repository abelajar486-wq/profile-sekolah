<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'school_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:50',
            'school_email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'maps_embed' => 'nullable|string',
            'facebook_url' => 'nullable|string|max:255',
            'instagram_url' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,bmp,svg|max:5120',
        ], [
            'school_name.required' => 'Nama sekolah wajib diisi.',
            'school_name.max' => 'Nama sekolah maksimal 255 karakter.',
            'contact_number.required' => 'Nomor kontak / WhatsApp wajib diisi.',
            'contact_number.max' => 'Nomor kontak maksimal 50 karakter.',
            'school_email.email' => 'Format email sekolah tidak valid.',
            'school_email.max' => 'Email sekolah maksimal 255 karakter.',
            'address.required' => 'Alamat lengkap wajib diisi.',
            'logo.image' => 'File logo harus berupa gambar.',
            'logo.mimes' => 'Format logo harus berupa file gambar (JPG, JPEG, PNG, GIF, WEBP, BMP, SVG).',
            'logo.max' => 'Ukuran file logo tidak boleh lebih dari 5MB (5120 KB).',
            'facebook_url.max' => 'URL Facebook maksimal 255 karakter.',
            'instagram_url.max' => 'URL Instagram maksimal 255 karakter.',
            'linkedin_url.max' => 'URL LinkedIn maksimal 255 karakter.',
        ]);

        $currentSettings = Setting::pluck('value', 'key')->toArray();
        $hasChange = false;

        if ($request->hasFile('logo')) {
            $hasChange = true;
        }

        $textKeys = [
            'school_name',
            'contact_number',
            'school_email',
            'address',
            'maps_embed',
            'facebook_url',
            'instagram_url',
            'linkedin_url',
        ];

        foreach ($textKeys as $key) {
            $newVal = isset($data[$key]) ? trim((string) $data[$key]) : '';
            $oldVal = isset($currentSettings[$key]) ? trim((string) $currentSettings[$key]) : '';
            if ($newVal !== $oldVal) {
                $hasChange = true;
                break;
            }
        }

        if (! $hasChange) {
            return redirect()->back()->with('info', 'Tidak ada perubahan dalam pengaturan.');
        }

        if ($request->hasFile('logo')) {
            $oldLogo = Setting::where('key', 'school_logo')->value('value');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $data['school_logo'] = $request->file('logo')->store('settings', 'public');
        }

        foreach ($data as $key => $value) {
            if ($key === 'logo') {
                continue;
            }
            Setting::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
        }

        return redirect()->back()->with('success', 'Pengaturan sekolah berhasil diperbarui!');
    }
}
