<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'viewHome'])->name('home');
Route::get('/form-pengaduan', [HomeController::class, 'viewFormPengaduan'])->name('form-pengaduan');
Route::post('/form-pengaduan', [HomeController::class, 'addPengaduan'])->name('add-pengaduan');

Route::get('/cari', [HomeController::class, 'viewTrackingPengaduan'])->name('cari');
Route::get('/cari-pengaduan', [HomeController::class, 'trackPengaduan'])->name('cari-pengaduan');

Route::get('/download-bukti/{tracking_id}', [HomeController::class, 'downloadBukti'])
    ->name('download-bukti');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/pengaduan', [DashboardController::class, 'pengaduanDatatables'])->name('pengaduan.datatables');
        Route::post('/pengaduan/{id}', [DashboardController::class, 'addTanggapan'])->name('pengaduan.add');

        Route::get('/tanggapan/{id}', [DashboardController::class, 'viewAddTanggapan'])->name('tanggapan.add');
    });
});
