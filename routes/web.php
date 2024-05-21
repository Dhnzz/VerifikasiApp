<?php

use App\Http\Controllers\{MahasiswaController, DosenController, DashboardController, ItemBerkasController, PeriodeController};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('dosen', DosenController::class);
        Route::resource('periode', PeriodeController::class);
    });

    // Dosen Routes

    // Mahasiswa Routes
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sample', function () {
    return view('admin.superadmin.template.manajemen_berkas');
});

Route::resource('itemberkas', ItemBerkasController::class);

require __DIR__ . '/auth.php';
