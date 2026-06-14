<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login/register
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses login (pengganti proseslogin.php)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Cek apakah input adalah email atau username
        $field = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        if (Auth::attempt([$field => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Username atau password salah. Coba lagi.');
    }

    // Memproses registrasi (pengganti prosesregistrasi.php)
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_depan'    => 'required|string|max:50',
            'nama_belakang' => 'required|string|max:50',
            'username'      => 'required|string|unique:users|min:3',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:6|confirmed',
        ], [
            'password.confirmed' => 'Password dan konfirmasi tidak cocok.',
            'username.unique'    => 'Username sudah digunakan.',
            'email.unique'       => 'Email sudah terdaftar.',
        ]);

        User::create([
            'name'     => trim($validated['nama_depan'] . ' ' . $validated['nama_belakang']),
            'username' => $validated['username'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'petani', //  Ganti 'user' menjadi 'petani' sesuai ENUM di TiDB
        ]);

        return redirect()->route('login')->with('sukses', 'Akun berhasil dibuat! Silakan masuk.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}