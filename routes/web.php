<?php

use App\Http\Controllers\BerkasController;
use App\Http\Controllers\ItemBerkasController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
