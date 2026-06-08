<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\VendorController;



// Google
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('verify-otp', function() { return view('auth.otp'); })->name('otp.view');
Route::post('verify-otp', [LoginController::class, 'verifyOtp'])->name('otp.verify');

Route::resource('/barang', BarangController::class);

Route::get('/', function () {
    return view('dashboard'); 
})->middleware('auth');

// Modul 4
Route::get('/tugas-js', function () {
    return view('tugas_js');
})->name('tugas.js');

Route::get('/tugas-wilayah', function () {
    return view('tugas_wilayah');
})->name('tugas.wilayah');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () { return view('dashboard'); });
    
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    
    // Rute CRUD Buku
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store');
    //Cetak
    Route::get('/cetak-sertifikat', [PdfController::class, 'cetakSertifikat'])->name('pdf.sertifikat');
    Route::get('/cetak-undangan', [PdfController::class, 'cetakUndangan'])->name('pdf.undangan');
    Route::post('/barang/cetak-label', [BarangController::class, 'cetak'])->name('barang.cetak');
    // Route untuk CRUD Barang
    Route::resource('/barang', BarangController::class);
});

// Penjualan
Route::get('/kasir', [PenjualanController::class, 'index'])->name('kasir.index');
Route::post('/kasir/cari', [PenjualanController::class, 'cariBarang'])->name('kasir.cari');
Route::post('/kasir/bayar', [PenjualanController::class, 'simpanTransaksi'])->name('kasir.bayar');

// Route untuk fitur Vendor
Route::get('/vendor/menu', [VendorController::class, 'index'])->name('vendor.menu');
Route::post('/vendor/menu', [VendorController::class, 'storeMenu'])->name('vendor.menu.store');