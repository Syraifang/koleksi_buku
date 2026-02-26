<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;

Route::get('/', function () {
    return view('dashboard'); 
})->middleware('auth');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
});
