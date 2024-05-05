<?php

use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class,'index'])->name('mahasiswa');
Route::get('/mahasiswa/add', [MahasiswaController::class,'add'])->name('mahasiswa.add');
Route::post('/mahasiswa/store', [MahasiswaController::class,'store'])->name('mahasiswa.store');
Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class,'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/update/{id}', [MahasiswaController::class,'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/delete/{id}', [MahasiswaController::class,'delete'])->name('mahasiswa.delete');

// Dosen
Route::get('/dosen', [DosenController::class,'index'])->name('dosen');
Route::get('/add', [DosenController::class,'add'])->name('dosen.add');
Route::post('/store', [DosenController::class,'store'])->name('dosen.store');
Route::get('/edit/{id}', [DosenController::class,'edit'])->name('dosen.edit');
Route::put('/update/{id}', [DosenController::class,'update'])->name('dosen.update');
Route::delete('/delete/{id}', [DosenController::class,'delete'])->name('dosen.delete');

// Berkas
Route::get('/', [BerkasController::class,'index'])->name('berkas');
Route::get('/add', [BerkasController::class,'add'])->name('berkas.add');
Route::post('/store', [BerkasController::class,'store'])->name('berkas.store');
Route::get('/edit/{id}', [BerkasController::class,'edit'])->name('berkas.edit');
Route::put('/update/{id}', [BerkasController::class,'update'])->name('berkas.update');
Route::delete('/delete/{id}', [BerkasController::class,'delete'])->name('berkas.delete');

// Role
Route::get('/', [RoleController::class,'index'])->name('role');
Route::get('/add', [RoleController::class,'add'])->name('role.add');
Route::post('/store', [RoleController::class,'store'])->name('role.store');
Route::get('/edit/{id}', [RoleController::class,'edit'])->name('role.edit');
Route::put('/update/{id}', [RoleController::class,'update'])->name('role.update');
Route::delete('/delete/{id}', [RoleController::class,'delete'])->name('role.delete');
