<?php

use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ItemBerkasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard_admin', function () {
    return view('admin.superadmin.dashboard_superadmin');
});
Route::get('/dashboard_student', function () {
    return view('admin.student.dashboard_student');
});
Route::get('/browse_period', function () {
    return view('admin.student.browse_period');
});
Route::get('/period_details', function () {
    return view('admin.dosen.period_details');
});
Route::get('/dosen_form', function () {
    return view('admin.superadmin.dosen_form');
});
Route::get('/sample', function () {
    return view('admin.dosen.sample');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('periode')->group(function () {
    Route::get('/', [PeriodeController::class, 'index'])->name('periode.index');
    Route::get('/show/{id}', [PeriodeController::class, 'show'])->name('periode.show');
    Route::get('/create', [PeriodeController::class, 'create'])->name('periode.create');
    Route::post('/store', [PeriodeController::class, 'store'])->name('periode.store');
    Route::get('/edit/{id}', [PeriodeController::class, 'edit'])->name('periode.edit');
    Route::put('/update/{id}', [PeriodeController::class, 'udpate'])->name('periode.update');
    Route::delete('/delete/{id}', [PeriodeController::class, 'delete'])->name('periode.delete');
});


Route::resource('/berkas', BerkasController::class);
Route::resource('/itmberkas', ItemBerkasController::class);


Route::prefix('dosen')->group(function () {
    Route::get('/', [DosenController::class, 'index'])->name('dosen.index');
    Route::get('/show/{id}', [DosenController::class, 'show'])->name('dosen.show');
    Route::get('/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::post('/store', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/edit/{id}', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/update/{id}', [DosenController::class, 'update'])->name('dosen.update'); // Memperbaiki typo 'udpate' menjadi 'update'
    Route::delete('/delete/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy'); // Mengganti 'delete' dengan 'destroy' untuk konsistensi dengan method di controller
});

Route::resource('/mahasiswa', MahasiswaController::class);

require __DIR__ . '/auth.php';
