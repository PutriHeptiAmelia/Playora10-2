<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotifikasiController;
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

    Route::get('/pembayaran/create/{booking_id}', [PembayaranController::class, 'createWeb'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'storeWeb'])->name('pembayaran.store');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'read'])->name('notifikasi.read');
    Route::post('/notifikasi/read-all', [NotifikasiController::class, 'readAll'])->name('notifikasi.readAll');
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::put('/bookings/{id}', [AdminController::class, 'updateBooking'])->name('booking.update');

    Route::get('/pembayaran', [AdminController::class, 'pembayaran'])->name('pembayaran');
    Route::put('/pembayaran/{id}/konfirmasi', [AdminController::class, 'konfirmasiPembayaran'])->name('pembayaran.konfirmasi');

    Route::get('/lapangan', [AdminController::class, 'lapanganIndex'])->name('lapangan.index');
    Route::get('/lapangan/create', [AdminController::class, 'lapanganCreate'])->name('lapangan.create');
    Route::post('/lapangan', [AdminController::class, 'lapanganStore'])->name('lapangan.store');
    Route::get('/lapangan/{id}/edit', [AdminController::class, 'lapanganEdit'])->name('lapangan.edit');
    Route::put('/lapangan/{id}', [AdminController::class, 'lapanganUpdate'])->name('lapangan.update');
    Route::delete('/lapangan/{id}', [AdminController::class, 'lapanganDestroy'])->name('lapangan.destroy');
});