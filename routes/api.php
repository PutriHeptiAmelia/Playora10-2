<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisOlahragaController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PembayaranController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Jenis Olahraga
    Route::get('/jenis-olahraga', [JenisOlahragaController::class, 'index']);
    Route::get('/jenis-olahraga/{id}', [JenisOlahragaController::class, 'show']);
    Route::post('/jenis-olahraga', [JenisOlahragaController::class, 'store']);
    Route::put('/jenis-olahraga/{id}', [JenisOlahragaController::class, 'update']);
    Route::delete('/jenis-olahraga/{id}', [JenisOlahragaController::class, 'destroy']);

    // Lapangan
    Route::get('/lapangan', [LapanganController::class, 'index']);
    Route::get('/lapangan/{id}', [LapanganController::class, 'show']);
    Route::post('/lapangan', [LapanganController::class, 'store']);
    Route::put('/lapangan/{id}', [LapanganController::class, 'update']);
    Route::delete('/lapangan/{id}', [LapanganController::class, 'destroy']);

    // Booking
    Route::get('/booking', [BookingController::class, 'index']);
    Route::post('/booking', [BookingController::class, 'store']);
    Route::get('/booking/{id}', [BookingController::class, 'show']);
    Route::put('/booking/{id}/status', [BookingController::class, 'updateStatus']);
    Route::delete('/booking/{id}', [BookingController::class, 'destroy']);

    // Pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index']);
    Route::post('/pembayaran', [PembayaranController::class, 'store']);
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show']);
    Route::put('/pembayaran/{id}/konfirmasi', [PembayaranController::class, 'konfirmasi']);

    // Notifikasi
    Route::get('/notifikasi', function (Request $request) {
        return response()->json($request->user()->notifications);
    });

    Route::put('/notifikasi/{id}/read', function (Request $request, $id) {
        $notif = $request->user()->notifications()->findOrFail($id);
        $notif->markAsRead();
        return response()->json(['message' => 'Notifikasi ditandai sudah dibaca']);
    });

    Route::put('/notifikasi/read-all', function (Request $request) {
        $request->user()->unreadNotifications->markAsRead();
        return response()->json(['message' => 'Semua notifikasi ditandai sudah dibaca']);
    });
});