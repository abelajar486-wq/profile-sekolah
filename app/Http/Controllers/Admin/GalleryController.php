<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menggunakan paginate agar tampilan tabel tidak terlalu panjang jika data banyak
        $galleries = Gallery::latest()->paginate(10);

        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp,bmp,svg',
            'description' => 'nullable|string',
            'upload_date' => 'nullable|date',
        ]);

        $imagePath = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'title' => $request->title,
            'image' => $imagePath,
            'description' => $request->description,
            'upload_date' => $request->upload_date ?? now(),
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        // Biasanya tidak dipakai di CRUD admin sederhana
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,bmp,svg',
            'description' => 'nullable|string',
            'upload_date' => 'nullable|date',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'upload_date' => $request->upload_date ?? $gallery->upload_date ?? now(),
        ];

        // Cek jika pengguna mengunggah gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage jika ada
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $hasChange = false;

        $textKeys = ['title', 'description', 'upload_date'];

        foreach ($textKeys as $key) {
            $newVal = isset($data[$key]) ? trim((string) $data[$key]) : '';
            $oldVal = isset($gallery->{$key}) ? trim((string) $gallery->{$key}) : '';
            if ($newVal !== $oldVal) {
                $hasChange = true;
                break;
            }
        }

        if ($request->hasFile('image')) {
            $hasChange = true;
        }

        if (! $hasChange) {
            return redirect()->route('admin.gallery.index')->with('info', 'Tidak ada perubahan dalam foto galeri.');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri berhasil dihapus!');
    }
}
