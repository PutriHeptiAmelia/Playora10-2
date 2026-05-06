<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController; // Pindahkan ke atas
use App\Http\Controllers\BookingController;   // Pindahkan ke atas

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk melihat daftar lapangan
Route::get('/lapangan', [LapanganController::class, 'index'])->name('lapangan.index');

// Rute untuk melihat detail booking
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');