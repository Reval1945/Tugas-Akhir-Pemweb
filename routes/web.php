<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisTransaksiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SumberDanaController;
use App\Http\Controllers\DashboardController;
// Route utama langsung ke Dashboard

Route::middleware(['auth'])->group(function () {
    // Route::get('/', function () {
    // return view('dashboard');
    // });
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/jenis', function () {
    return view('jenis');
    });
    Route::get('/pemasukan', function () {
    return view('pemasukan');
    });
    Route::get('/pemasukan', [PemasukanController::class, 'index']);
    Route::post('/pemasukan', [PemasukanController::class, 'store']);

    Route::get('/pengeluaran', function () {
    return view('pengeluaran');
    });
    Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
    Route::post('/pengeluaran', [PengeluaranController::class, 'store']);

    Route::post('/logout', [AuthController::class, 'logout']);
    });
    // auth
    Route::get('/register', [AuthController::class, 'registerPage']);

    Route::post('/post-register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/post-login', [AuthController::class, 'login']);

// Route jenis transaksi
Route::get('/jenis', [JenisTransaksiController::class, 'index'])->name('jenis.transaksi');
Route::post('/add-jenis', [JenisTransaksiController::class, 'addJenisTransaksi']);
Route::get('/jenis/edit/{id}', [JenisTransaksiController::class, 'editJenisTransaksiPage']);
Route::put('/edit-jenis/{id}', [JenisTransaksiController::class, 'editJenisTransaksi']);
Route::delete('/delete-jenis/{id}', [JenisTransaksiController::class, 'deleteJenisTransaksi']);

// Route untuk pemasukan
Route::get('/pemasukan', [TransaksiController::class, 'pemasukanPage']);
Route::post('/add-pemasukan', [TransaksiController::class, 'addPemasukan']);
Route::get('/pemasukan/edit/{id}', [TransaksiController::class, 'editPemasukanPage']);
Route::put('/edit-pemasukan/{id}', [TransaksiController::class, 'editPemasukan']);
Route::delete('/delete-pemasukan/{id}', [TransaksiController::class, 'deletePemasukan']);
Route::post('/pemasukan', [TransaksiController::class, 'storePemasukan'])->name('pemasukan.store');
Route::get('/transaksi/pemasukan/{tipe}', [TransaksiController::class, 'index']);

// Untuk Pengeluaran
Route::post('/pengeluaran', [TransaksiController::class, 'storePengeluaran'])->name('pengeluaran.store');
Route::get('/pengeluaran', [TransaksiController::class, 'pengeluaranPage']);
Route::post('/add-pengeluaran', [TransaksiController::class, 'addPengeluaran']);
Route::get('/pengeluaran/edit/{id}', [TransaksiController::class, 'editPengeluaranPage']);
Route::put('/edit-pengeluaran/{id}', [TransaksiController::class, 'editPengeluaran']);
Route::delete('/delete-pengeluaran/{id}', [TransaksiController::class, 'deletePengeluaran']);
Route::get('/transaksi/pengeluaran/{tipe}', [TransaksiController::class, 'index']);

// Route cetak
Route::get('/cetakpemasukan', [TransaksiController::class, 'cetakPdfPemasukan']);
Route::get('/cetakpengeluaran', [TransaksiController::class, 'cetakPdfPengeluaran']);

// Route untuk excel
Route::get('/wishlist', [WishlistController::class, 'index']);
Route::post('/upload-excel', [WishlistController::class, 'upload']);

Route::get('/sumberdana', [SumberDanaController::class, 'index']);
Route::post('/add-sumber', [SumberDanaController::class, 'addSumber']);



