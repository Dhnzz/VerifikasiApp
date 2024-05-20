<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ItemBerkasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard_admin', [AdminController::class,'index'])->name('admin.dashboard');
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

Route::resource('/berkas', BerkasController::class);
Route::resource('/itmberkas', ItemBerkasController::class);


Route::resource('/periode', PeriodeController::class)->middleware('auth');
Route::resource('/mahasiswa', MahasiswaController::class)->middleware('auth');

require __DIR__ . '/auth.php';
