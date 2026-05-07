<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\Pembayaran;
use App\Models\User;
use App\Notifications\BookingNotification;
use App\Notifications\PembayaranNotification;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalLapangan = Lapangan::count();
        $totalBookings = Booking::count();
        $totalPendapatan = Pembayaran::where('status', 'paid')->sum('jumlah');
        $recentBookings = Booking::with(['user', 'lapangan'])->latest('created_at')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalLapangan',
            'totalBookings',
            'totalPendapatan',
            'recentBookings'
        ));
    }

    public function bookings()
    {
        $bookings = Booking::with(['user', 'lapangan'])->latest('created_at')->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function updateBooking(Request $request, $id)
    {
        $booking = Booking::with(['user', 'lapangan'])->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking->update(['status' => $request->status]);

        $pesan = match($request->status) {
            'confirmed' => 'Booking kamu telah dikonfirmasi oleh admin!',
            'cancelled' => 'Booking kamu telah dibatalkan oleh admin.',
            default => 'Status booking kamu telah diupdate.',
        };

        $booking->user->notify(new BookingNotification($booking, $pesan));

        return redirect()->route('admin.bookings')->with('success', 'Status booking berhasil diupdate!');
    }

    public function pembayaran()
    {
        $pembayaran = Pembayaran::with(['booking.user', 'booking.lapangan'])->latest('created_at')->get();
        return view('admin.pembayaran', compact('pembayaran'));
    }

    public function konfirmasiPembayaran(Request $request, $id)
    {
        $pembayaran = Pembayaran::with('booking.user')->findOrFail($id);

        $request->validate([
            'status' => 'required|in:paid,rejected',
        ]);

        $pembayaran->update([
            'status' => $request->status,
            'confirmed_at' => now(),
        ]);

        if ($request->status === 'paid') {
            $pembayaran->booking->update(['status' => 'confirmed']);
            $pesan = 'Pembayaran kamu telah dikonfirmasi, booking aktif!';
        } else {
            $pembayaran->booking->update(['status' => 'cancelled']);
            $pesan = 'Pembayaran kamu ditolak oleh admin, silakan hubungi admin.';
        }

        $pembayaran->booking->user->notify(new PembayaranNotification($pembayaran, $pesan));

        return redirect()->route('admin.pembayaran')->with('success', 'Status pembayaran berhasil diupdate!');
    }
}