<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;

// =============================================
// HALAMAN PUBLIK (Frontend / Tanpa Login)
// =============================================

// Beranda
Route::get('/', [UserController::class, 'index'])->name('user.index');

// Daftar Layanan
Route::get('/layanan', [UserController::class, 'layanan'])->name('user.layanan');

// Cek Status Pesanan
Route::get('/cek-status', [UserController::class, 'cekStatus'])->name('user.cek-status');
Route::post('/cek-status', [UserController::class, 'hasilCekStatus'])->name('user.hasil-cek-status');

// Detail Transaksi (publik)
Route::get('/transaksi/{id}', [UserController::class, 'detailTransaksi'])->name('user.detail-transaksi');

// =============================================
// AUTENTIKASI (Login & Register - Unified)
// =============================================

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// =============================================
// HALAMAN PELANGGAN (Perlu Login + Role pelanggan)
// =============================================

Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [PelangganController::class, 'dashboard'])->name('dashboard');
    Route::get('/pesan', [PelangganController::class, 'pesanForm'])->name('pesan');
    Route::post('/pesan', [PelangganController::class, 'pesanStore'])->name('pesan.store');
    Route::get('/pesanan', [PelangganController::class, 'riwayatPesanan'])->name('pesanan');
    Route::get('/pesanan/{id}', [PelangganController::class, 'detailPesanan'])->name('pesanan.detail');
    Route::get('/profil', [PelangganController::class, 'profil'])->name('profil');
    Route::put('/profil', [PelangganController::class, 'updateProfil'])->name('profil.update');
});
