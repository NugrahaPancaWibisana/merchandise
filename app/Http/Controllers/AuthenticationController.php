<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthenticationController extends Controller
{
    public function loginView(): View
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'ADMIN') {
                return redirect()->route('admin.dashboard');
            }

            if (Auth::user()->role === 'OWNER') {
                return redirect()->route('owner.dashboard');
            }

            return redirect()->route('kasir.dashboard');
        }

        return view('pages.auth.login');
    }


    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->status !== 'ACTIVE') {
                Auth::logout();

                return back()->withErrors([
                    'status' => 'Akun anda tidak aktif.'
                ]);
            }

            if (Auth::user()->role !== 'OWNER') {
                Log::create([
                    'user_id' => Auth::id(),
                    'activity' => 'Berhasil Login',
                ]);
            }

            if (Auth::user()->role == 'ADMIN') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang administrator');
            }

            if (Auth::user()->role == 'OWNER') {
                return redirect()->route('owner.dashboard')->with('success', 'Selamat datang owner');
            }

            return redirect()->route('kasir.dashboard')->with('success', 'Selamat datang kasir');
        }

        return back()->withErrors([
            'username' => 'Username atau password tidak valid.',
            'password' => 'Username atau password tidak valid.'
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        if (Auth::user()->role !== 'OWNER') {
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Berhasil Logout',
            ]);
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
