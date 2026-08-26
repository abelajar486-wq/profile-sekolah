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
            'school_name'    => 'required|string|max:255',
            'contact_number' => 'required|string|max:50',
            'school_email'   => 'nullable|email|max:255',
            'address'        => 'required|string',
            'maps_embed'     => 'nullable|string',
            'facebook_url'   => 'nullable|string|max:255',
            'instagram_url'  => 'nullable|string|max:255',
            'linkedin_url'   => 'nullable|string|max:255',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,bmp,svg|max:2048',
        ]);

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
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'Pengaturan sekolah berhasil diperbarui!');
    }
}
