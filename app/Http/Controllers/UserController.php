<?php

namespace App\Http\Controllers;

use App\Models\Log;
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

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'ACTIVE',
        ]);

        Log::create([
            'user_id' => Auth::id(),
            'activity' => "Menambahkan user: {$user->name} ({$user->role})",
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

        $oldData = $user->getOriginal();
        $user->update($request->only(['username', 'name', 'role']));

        Log::create([
            'user_id' => Auth::id(),
            'activity' => "Mengedit user: {$oldData['name']} → {$user->name}, Role: {$oldData['role']} → {$user->role}",
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
            Log::create([
                'user_id' => Auth::id(),
                'activity' => "Mengubah password user: {$user->name}",
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    // Aktivasi user
    public function activateUser(User $user): RedirectResponse
    {
        $user->update(['status' => 'ACTIVE']);

        Log::create([
            'user_id' => Auth::id(),
            'activity' => "Mengaktifkan user: {$user->name}",
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diaktifkan.');
    }

    // Nonaktifkan user
    public function deactivateUser(User $user): RedirectResponse
    {
        $user->update(['status' => 'INACTIVE']);

        Log::create([
            'user_id' => Auth::id(),
            'activity' => "Menonaktifkan user: {$user->name}",
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dinonaktifkan.');
    }

    // Menampilkan daftar pengguna
    public function listUsers(): View
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('pages.admin.users', compact('users'));
    }
}
