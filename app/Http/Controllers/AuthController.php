<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Hanya user dengan role 'admin' yang boleh mengakses dashboard
            if ($user->role === 'admin' && $user->is_active) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }

            // Jika bukan admin, logout dan beri pesan
            Auth::logout();
            return back()->withErrors([
                'email' => 'Anda tidak memiliki akses sebagai admin.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
