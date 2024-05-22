<?php

use App\Http\Controllers\{MahasiswaController, DosenController, DashboardController, PeriodeController, TemplateBerkasController, ItemBerkasController};
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Admin Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::middleware('roleCheck:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('dosen', DosenController::class);
        Route::resource('periode', PeriodeController::class);
        Route::get('/periode/{id}', [PeriodeController::class, 'show'])->name('periode.show');
        Route::resource('template', TemplateBerkasController::class);
        Route::resource('itemberkas', ItemBerkasController::class)->except('create', 'update', 'destroy');
        Route::get('/item-management/{id}', [ItemBerkasController::class, 'create'])->name('item-management.create');
        Route::put('/item-management', [ItemBerkasController::class, 'update'])->name('item-management.update');
        Route::delete('/item-management', [ItemBerkasController::class, 'destroy'])->name('item-management.destroy');
    });

    // Mahasiswa Routes
    Route::middleware('roleCheck:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::name('periode.')->group(function () {
            Route::get('/periode', [PeriodeController::class, 'periodeAktif'])->name('index');
        });
    });
});

Route::get('/sample', function () {
    return view('admin.student.dashboard_student');
});


require __DIR__ . '/auth.php';
