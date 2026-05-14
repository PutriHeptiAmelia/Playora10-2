<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$app->boot();

use App\Models\Booking;

// Get all bookings for Futsal A on 2026-05-12
$bookings = Booking::with(['lapangan', 'user'])
    ->where('tanggal', '2026-05-12')
    ->whereHas('lapangan', function($q) {
        $q->where('nama', 'LIKE', '%Futsal%');
    })
    ->get();

echo "=== BOOKINGS FOR FUTSAL A ON 2026-05-12 ===\n\n";

foreach ($bookings as $booking) {
    echo "User: {$booking->user->name}\n";
    echo "Lapangan: {$booking->lapangan->nama}\n";
    echo "Tanggal: {$booking->tanggal}\n";
    echo "Jam: {$booking->jam_mulai} - {$booking->jam_selesai}\n";
    echo "Durasi: {$booking->durasi_jam} jam\n";
    echo "Status: {$booking->status}\n";
    echo "---\n\n";
}

echo "Total bookings: " . count($bookings) . "\n";
