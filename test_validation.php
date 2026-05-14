<?php
/**
 * Test script untuk verifikasi double-booking validation
 * 
 * Scenario: Coba membuat booking dengan jam yang sama dengan existing booking
 * Expected: Validation harus tolak (return error)
 * Actual: ???
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->boot();

use App\Models\Booking;
use Illuminate\Support\Carbon;

// Ambil booking existing
$existingBooking = Booking::where('lapangan_id', 2) // Futsal A
    ->where('tanggal', '2026-05-12')
    ->where('status', '!=', 'cancelled')
    ->first();

if ($existingBooking) {
    echo "=== EXISTING BOOKING ===\n";
    echo "Lapangan ID: " . $existingBooking->lapangan_id . "\n";
    echo "Tanggal: " . $existingBooking->tanggal . "\n";
    echo "Jam: " . $existingBooking->jam_mulai . " - " . $existingBooking->jam_selesai . "\n";
    echo "Status: " . $existingBooking->status . "\n\n";

    // Simulasi validation yang sama di controller
    echo "=== TESTING VALIDATION ===\n";
    
    $testBooking = Booking::where('lapangan_id', $existingBooking->lapangan_id)
        ->where('tanggal', $existingBooking->tanggal)
        ->where('status', '!=', 'cancelled')
        ->where(function ($query) use ($existingBooking) {
            $query->whereBetween('jam_mulai', [$existingBooking->jam_mulai, $existingBooking->jam_selesai])
                ->orWhereBetween('jam_selesai', [$existingBooking->jam_mulai, $existingBooking->jam_selesai])
                ->orWhere(function ($query) use ($existingBooking) {
                    $query->where('jam_mulai', '<=', $existingBooking->jam_mulai)
                        ->where('jam_selesai', '>=', $existingBooking->jam_selesai);
                });
        })->get();

    echo "Bookings found by validation query: " . count($testBooking) . "\n";
    foreach ($testBooking as $b) {
        echo "  - " . $b->jam_mulai . " - " . $b->jam_selesai . "\n";
    }
} else {
    echo "No existing booking found\n";
}
?>
