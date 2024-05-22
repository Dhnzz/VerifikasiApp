<?php

use App\Http\Controllers\{MahasiswaController, DosenController, DashboardController, PeriodeController, TemplateBerkasController, ItemBerkasController};
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('dosen', DosenController::class);
        Route::resource('periode', PeriodeController::class);
        Route::resource('template', TemplateBerkasController::class);
        Route::resource('itemberkas', ItemBerkasController::class)->except('create','update','destroy');
        Route::get('/item-management/{id}', [ItemBerkasController::class, 'create'])->name('item-management.create');
        Route::put('/item-management', [ItemBerkasController::class, 'update'])->name('item-management.update');
        Route::delete('/item-management', [ItemBerkasController::class, 'destroy'])->name('item-management.destroy');
    });

    // Dosen Routes

    // Mahasiswa Routes
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
    });
});

Route::get('/sample', function () {});
Route::get('/sample', function () {
    return view('admin.superadmin.template.manajemen_berkas');
});


require __DIR__ . '/auth.php';
