<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Booking;
use App\Notifications\PembayaranNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    // WEB
    public function createWeb($booking_id)
    {
        $booking = Booking::with('lapangan')->findOrFail($booking_id);

        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke booking ini.');
        }

        if ($booking->status !== 'confirmed') {
            return back()->with('error', 'Booking harus dikonfirmasi admin terlebih dahulu sebelum Anda dapat melakukan pembayaran.');
        }

        return view('pembayaran.create', compact('booking'));
    }

    public function storeWeb(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'jumlah' => 'required|numeric',
            'bukti_bayar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke booking ini.');
        }

        if ($booking->status !== 'confirmed') {
            return back()->with('error', 'Booking harus dikonfirmasi admin terlebih dahulu sebelum Anda dapat melakukan pembayaran.');
        }

        $bukti_bayar = null;
        if ($request->hasFile('bukti_bayar')) {
            $bukti_bayar = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
        }

        $pembayaran = Pembayaran::create([
            'booking_id' => $request->booking_id,
            'jumlah' => $request->jumlah,
            'bukti_bayar' => $bukti_bayar,
            'status' => 'unpaid',
        ]);

        Auth::user()->notify(new PembayaranNotification(
            $pembayaran,
            'Pembayaran kamu berhasil disubmit, menunggu konfirmasi admin.'
        ));

        return redirect()->route('booking.index')->with('success', 'Pembayaran berhasil disubmit! Menunggu konfirmasi admin.');
    }

    // API
    public function index(Request $request)
    {
        if ($request->user()->role === 'admin') {
            $data = Pembayaran::with(['booking.user', 'booking.lapangan'])->get();
        } else {
            $data = Pembayaran::whereHas('booking', function ($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            })->with(['booking.lapangan'])->get();
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'jumlah' => 'required|numeric',
            'bukti_bayar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        if ($booking->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Anda tidak memiliki akses ke booking ini.'], 403);
        }

        if ($booking->status !== 'confirmed') {
            return response()->json(['message' => 'Booking harus dikonfirmasi admin terlebih dahulu sebelum Anda dapat melakukan pembayaran.'], 400);
        }

        $bukti_bayar = null;
        if ($request->hasFile('bukti_bayar')) {
            $bukti_bayar = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
        }

        $pembayaran = Pembayaran::create([
            'booking_id' => $request->booking_id,
            'jumlah' => $request->jumlah,
            'bukti_bayar' => $bukti_bayar,
            'status' => 'unpaid',
        ]);

        $request->user()->notify(new PembayaranNotification(
            $pembayaran,
            'Pembayaran kamu berhasil disubmit, menunggu konfirmasi admin.'
        ));

        return response()->json([
            'message' => 'Pembayaran berhasil disubmit',
            'data' => $pembayaran,
        ], 201);
    }

    public function konfirmasi(Request $request, $id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Anda tidak memiliki akses untuk konfirmasi pembayaran.'], 403);
        }

        $pembayaran = Pembayaran::with('booking.user')->findOrFail($id);

        $request->validate([
            'status' => 'required|in:paid,rejected',
        ]);

        $pembayaran->update([
            'status' => $request->status,
            'confirmed_at' => now(),
        ]);

        if ($request->status === 'paid') {
            $pesan = 'Pembayaran kamu telah dikonfirmasi, booking sudah aktif!';
        } elseif ($request->status === 'rejected') {
            $pembayaran->booking->update(['status' => 'cancelled']);
            $pesan = 'Pembayaran kamu ditolak oleh admin, silakan hubungi admin.';
        }

        $pembayaran->booking->user->notify(new PembayaranNotification($pembayaran, $pesan));

        return response()->json([
            'message' => 'Status pembayaran berhasil diupdate',
            'data' => $pembayaran,
        ]);
    }

    public function show(Request $request, $id)
    {
        $pembayaran = Pembayaran::with(['booking.user', 'booking.lapangan'])->findOrFail($id);

        if ($request->user()->role !== 'admin' && $pembayaran->booking->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Anda tidak memiliki akses ke pembayaran ini.'], 403);
        }

        return response()->json($pembayaran);
    }
}