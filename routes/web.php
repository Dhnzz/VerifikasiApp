<?php

use App\Http\Controllers\{MahasiswaController, DosenController, DashboardController, PeriodeController, TemplateBerkasController, ItemBerkasController, MahasiswaBerkasController};
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Admin Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('roleCheck:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('dosen', DosenController::class);
    });

    // Mahasiswa Routes 
    Route::middleware('roleCheck:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::name('periode.')->group(function () {
            Route::put('/daftarPeriode/{idMahasiswa}/{idPeriode}', [MahasiswaController::class, 'daftar'])->name('daftar');
        });
        Route::name('berkas_mahasiswa.')->group(function () {
            Route::get('/byTemplateBerkas/{periode_id}', [MahasiswaBerkasController::class, 'byTemplateBerkas'])->name('berkas_mahasiswa.byTemplateBerkas');
            Route::put('/berkas_mahasiswa/store', [MahasiswaBerkasController::class, 'store'])->name('store');
        });
    });

    // Dosen Routes
    Route::middleware('roleCheck:dosen')->prefix('dosen')->name('dosen.')->group(function () {
        Route::name('periode.')->group(function () {
            Route::get('/periode/{id}', [PeriodeController::class, 'showDosen'])->name('show');
            Route::get('/get-peserta/{id}', [periodeController::class, 'getPeserta'])->name('getPesarta');
        });
        Route::name('berkas.')->group(function () {
            Route::put('/approve', [MahasiswaBerkasController::class, 'approve'])->name('approve');
            Route::put('/reject', [MahasiswaBerkasController::class, 'reject'])->name('reject');
        });
        Route::name('mahasiswa.')->group(function () {
            Route::put('/pengajuan', [MahasiswaController::class, 'pengajuan'])->name('pengajuan');
        });
    });

    // Kajur Routes
    Route::middleware('roleCheck:kajur')->prefix('kajur')->name('kajur.')->group(function () {
        Route::name('kaprodi.')->group(function () {
            Route::get('/choose-kaprodi', [DosenController::class, 'chooseKaprodi'])->name('choose');
            Route::put('/select-kaprodi/{id}', [DosenController::class, 'selectKaprodi'])->name('select');
        });
        Route::name('mahasiswa.')->group(function () {
            Route::put('/mahasiswa/reset/{id}', [MahasiswaController::class, 'resetDataMahasiswa'])->name('resetMahasiswa');
        });

        Route::resource('periode', PeriodeController::class);
        Route::get('/periode/{id}', [PeriodeController::class, 'show'])->name('periode.show');
        Route::put('/changeStatus/{id}', [PeriodeController::class, 'changeStatus'])->name('periode.changeStatus');

        Route::resource('template', TemplateBerkasController::class);

        Route::resource('itemberkas', ItemBerkasController::class)->except('create', 'update', 'destroy');
        Route::get('/item-management/{id}', [ItemBerkasController::class, 'create'])->name('item-management.create');
        Route::put('/item-management/update', [ItemBerkasController::class, 'update'])->name('item-management.update');
        Route::delete('/item-management', [ItemBerkasController::class, 'destroy'])->name('item-management.destroy');
    });

    // Kaprodi Routes
    Route::middleware('roleCheck:kaprodi')->prefix('kaprodi')->name('kaprodi.')->group(function () {
        Route::name('mahasiswa.')->group(function () {
            Route::put('/mahasiswa/izin/{id}', [MahasiswaController::class, 'izinPenjadwalan'])->name('izinPenjadwalan');
        });
        Route::name('report.')->group(function () {
            Route::get('/report-kaprodi', [MahasiswaController::class, 'report'])->name('report');
            Route::get('/report-kaprodi/{id}', [MahasiswaController::class, 'detailReport'])->name('detail');
        });
    });
});

Route::get('/sample', function () {
});


require __DIR__ . '/auth.php';
