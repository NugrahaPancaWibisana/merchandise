<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createUserView(): View
    {
        return view('pages.admin.create-user');
    }

    // Proses tambah pengguna
    public function createUser(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:ADMIN,KASIR,OWNER'],
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Menampilkan halaman edit pengguna
    public function editUserView(User $user): View
    {
        return view('pages.admin.edit-user', compact('user'));
    }

    // Proses update pengguna
    public function editUser(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:ADMIN,KASIR,OWNER'],
        ]);

        $user->update($request->only(['username', 'name', 'role']));

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    // Proses hapus pengguna
    public function deleteUser(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    // Menampilkan daftar pengguna
    public function listUsers(): View
{
    $users = User::where('id', '!=', Auth::id())->get();

    return view('pages.admin.users', compact('users'));
}

}
