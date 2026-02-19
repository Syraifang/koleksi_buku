<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard'); 
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    // Rute untuk Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    
    // Rute untuk Buku (Akan kita buat setelah ini)
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
});
