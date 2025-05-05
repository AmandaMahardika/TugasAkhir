<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;

// Rute Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk Pengguna (laporan)
Route::middleware(['auth'])->group(function () {
    Route::resource('laporan', LaporanController::class)->only(['index', 'create', 'store', 'show']);
});

// Rute untuk Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/laporan-diproses', [AdminController::class, 'laporanDiproses'])->name('admin.laporanDiproses');
    Route::get('/admin/laporan-selesai', [AdminController::class, 'laporanSelesai'])->name('admin.laporanSelesai');
    Route::get('/admin/laporanSelesai/pdf', [AdminController::class, 'exportPdf'])->name('admin.exportPdf');
    Route::get('/admin/akun-baru', [AdminController::class, 'akunBaru'])->name('admin.akunBaru');
    Route::get('/admin/semua-akun', [AdminController::class, 'semuaAkun'])->name('admin.semuaAkun');
    Route::get('/admin/tambah-akun/{role}', [AdminController::class, 'tambahAkun'])->name('admin.tambahAkun');
    Route::post('/admin/simpan-akun', [AdminController::class, 'simpanAkun'])->name('admin.simpanAkun');
    Route::delete('/admin/akun/{user}', [AdminController::class, 'hapusAkun'])->name('admin.hapusAkun');
    Route::post('/admin/ubah-role/{user}', [AdminController::class, 'ubahRole'])->name('admin.ubahRole');
    Route::post('/admin/laporan/{id}/selesai', [AdminController::class, 'selesaiLaporanAdmin'])->name('admin.selesaiLaporan');
});

// Rute untuk Petugas (Sesuaikan jika berbeda)
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/dashboard', [PetugasController::class, 'dashboard'])->name('petugas.dashboard');
    Route::get('/petugas/laporan-diproses', [PetugasController::class, 'laporanDiproses'])->name('petugas.laporanDiproses');
    Route::get('/petugas/laporan-selesai', [PetugasController::class, 'laporanSelesai'])->name('petugas.laporanSelesai');
    Route::post('/terima-laporan/{id}', [PetugasController::class, 'terimaLaporan'])->name('terimaLaporan');
    Route::get('/tindak-lanjut/{id}/edit', [PetugasController::class, 'editTindakLanjut'])->name('tindakLanjut.edit');
    Route::put('/tindak-lanjut/{id}', [PetugasController::class, 'updateTindakLanjut'])->name('tindakLanjut.update');
});

// Rute Welcome
Route::get('/', function () {
    return view('welcome');
});
