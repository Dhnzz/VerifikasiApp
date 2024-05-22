<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('base');
    Route::get('login', function () {
        return redirect('/')->withErrors('Akses ditolak, silahkan login menggunakan halaman ini');
    });
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('postMethod')->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
