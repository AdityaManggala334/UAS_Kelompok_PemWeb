<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Models\LaporanKendala;
use Illuminate\Http\Request;

// LANDING PAGE (PUBLIK)
Route::get('/', [LandingController::class, 'index'])->name('home');

// ==========================================
// ROUTE AUTH (Login & Register) - Publik
// ==========================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/register', [AuthController::class, 'register'])->name('register.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect root ke login jika belum autentikasi

// ==========================================
// ROUTE PROTECTED (Wajib Login)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', function () {
        return view('dashboard.index'); 
    })->name('dashboard');

    // Proses Simpan Laporan Kendala
    Route::post('/laporan/simpan', function (Request $request) {
        $validated = $request->validate([
            'nama_pelapor'  => 'required|string|max:100',
            'lokasi_kendala'=> 'required|string|max:200',
            'jenis_kendala' => 'required|string',
        ]);

        LaporanKendala::create([
            'user_id'       => auth()->id(),
            'nama_pelapor'  => $validated['nama_pelapor'],
            'lokasi'        => $validated['lokasi_kendala'],
            'jenis_kendala' => $validated['jenis_kendala'],
            'status'        => 'baru',
        ]);

        return back()->with([
            'pesan_laporan' => 'Laporan berhasil dikirim! Petugas akan segera menangani.',
            'pesan_warna'   => 'sukses'
        ]);
    })->name('laporan.simpan');

    // Placeholder untuk fitur teman kelompok nanti
    // Route::get('/peta', [PetaController::class, 'index'])->name('peta');
    // Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
});