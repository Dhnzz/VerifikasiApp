<?php

use App\Http\Controllers\BerkasController;
use App\Http\Controllers\ItemBerkasController;
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
Route::get('/sample', function () {
    return view('admin.dosen.sample');
});
Route::get('/login', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

require __DIR__ . '/auth.php';
