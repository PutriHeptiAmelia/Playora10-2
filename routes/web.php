<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Auth\LoginController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth routes
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Public routes
Route::get('/lapangan', [LapanganController::class, 'index'])->name('lapangan.index');
Route::get('/lapangan/{id}', [LapanganController::class, 'show'])->name('lapangan.show');

// Protected routes (harus login)
Route::middleware('auth')->group(function () {
    Route::get('/booking', [BookingController::class, 'indexWeb'])->name('booking.index');
    Route::get('/booking/create/{lapangan_id}', [BookingController::class, 'createWeb'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'storeWeb'])->name('booking.store');
    Route::get('/booking/{id}', [BookingController::class, 'showWeb'])->name('booking.show');
    Route::get('/riwayat', [BookingController::class, 'riwayatWeb'])->name('booking.riwayat');
    Route::post('/pembayaran/{booking_id}', [PembayaranController::class, 'storeWeb'])->name('pembayaran.store');
    Route::get('/notifikasi', function () {
        return view('notifikasi', ['notifikasi' => auth()->user()->notifications]);
    })->name('notifikasi.index');
});