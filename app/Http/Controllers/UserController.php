<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Tampilkan semua user
    public function index()
    {
        $users = User::latest()->get();
        return view('user.index', compact('users'));
    }

    // Tampilkan form tambah user
    public function create()
    {
        return view('user.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Tampilkan form edit user
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'string', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
