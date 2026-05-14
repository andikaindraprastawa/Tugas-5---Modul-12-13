<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\VariantController;

// Jalur bawaan Laravel, kita arahkan langsung ke halaman login
Route::get('/', function () {
    return redirect('/login');
});

// Menampilkan halaman form login
Route::get('/login', function () {
    if (Auth::check()) return redirect('/products'); // Kalau sudah login, langsung ke produk
    return view('login');
})->name('login');

// Memproses data dari form login
Route::post('/login', [SiteController::class, 'auth']);

// ==========================================
// INI TAMBAHAN UNTUK REGISTER (LANGKAH 1)
// ==========================================
// Menampilkan halaman form register
Route::get('/register', [SiteController::class, 'register'])->name('register');
// Memproses data dari form register ke database
Route::post('/register', [SiteController::class, 'storeRegister']);
// ==========================================

// Proses logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

// KUNCI UTAMA: Menambahkan middleware('auth') agar CRUD wajib login
Route::resource('products', ProductController::class)->middleware('auth');

// RUTE VARIAN
Route::get('/products/{id}/variants/create', [VariantController::class, 'create'])->name('variants.create')->middleware('auth');
Route::post('/products/{id}/variants', [VariantController::class, 'store'])->name('variants.store')->middleware('auth');