<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DataWarehouseController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])
    ->name('landing');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('pelanggan', PelangganController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('transaksi', TransaksiController::class);

    Route::get('/proses-etl', [DataWarehouseController::class, 'etl'])
        ->name('proses-etl.index');

    Route::post('/proses-etl/jalankan', [DataWarehouseController::class, 'prosesEtl'])
        ->name('proses-etl.jalankan');

    Route::get('/data-warehouse', [DataWarehouseController::class, 'index'])
        ->name('data-warehouse.index');

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';