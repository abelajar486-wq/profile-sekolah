<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%')
                    ->orWhere('username', 'like', '%'.$request->search.'%');
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'alamat' => 'nullable|string|max:500',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,user',
            'is_verified' => 'nullable|in:0,1',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified_at'] = ($request->is_verified == '1') ? now() : null;
        unset($validated['is_verified']);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'alamat' => 'nullable|string|max:500',
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:admin,user',
            'is_verified' => 'nullable|in:0,1',
        ]);

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if (isset($validated['is_verified'])) {
            $validated['email_verified_at'] = ($validated['is_verified'] == '1') ? ($user->email_verified_at ?? now()) : null;
            unset($validated['is_verified']);
        }

        $hasChange = false;

        $textKeys = ['name', 'username', 'email', 'alamat', 'role'];

        foreach ($textKeys as $key) {
            $newVal = isset($validated[$key]) ? trim((string) $validated[$key]) : '';
            $oldVal = isset($user->{$key}) ? trim((string) $user->{$key}) : '';
            if ($newVal !== $oldVal) {
                $hasChange = true;
                break;
            }
        }

        $newVerified = isset($validated['is_verified']) ? ($validated['is_verified'] == '1') : false;
        $oldVerified = ! is_null($user->email_verified_at);
        if ($newVerified !== $oldVerified) {
            $hasChange = true;
        }

        if (! $hasChange) {
            return redirect()->route('admin.users.index')->with('info', 'Tidak ada perubahan pada data user.');
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Toggle status verifikasi email user.
     */
    public function toggleVerification(User $user)
    {
        if ($user->email_verified_at) {
            $user->update(['email_verified_at' => null]);
            $status = 'dibatalkan verifikasinya';
        } else {
            $user->update(['email_verified_at' => now()]);
            $status = 'berhasil diverifikasi';
        }

        return redirect()->back()->with('success', "Status email {$user->name} {$status}!");
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'User dengan role admin tidak dapat dihapus!');
        }

        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}
