<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Notifications\BookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // WEB
    public function indexWeb()
    {
        $bookings = Booking::with(['lapangan', 'pembayaran'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('booking.index', compact('bookings'));
    }

    public function createWeb($lapangan_id)
    {
        $lapangan = Lapangan::with('jenisOlahraga')->findOrFail($lapangan_id);
        return view('booking.create', compact('lapangan'));
    }

    public function storeWeb(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required|exists:lapangan,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'durasi_jam' => 'required|integer|min:1|max:12',
        ]);

        $lapangan = Lapangan::findOrFail($request->lapangan_id);

        if ($lapangan->status === 'inactive') {
            return back()->with('error', 'Lapangan tidak tersedia.');
        }

        // Cek bentrok jadwal
        $bentrok = Booking::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })->exists();

        if ($bentrok) {
            return back()->with('error', 'Lapangan sudah dipesan pada jam tersebut, silakan pilih jam lain.');
        }

        $total_harga = $lapangan->harga_per_jam * $request->durasi_jam;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'lapangan_id' => $request->lapangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'durasi_jam' => $request->durasi_jam,
            'total_harga' => $total_harga,
            'status' => 'pending',
        ]);

        // Kirim notifikasi
        Auth::user()->notify(new BookingNotification(
            $booking->load('lapangan'),
            'Booking kamu berhasil dibuat, menunggu konfirmasi admin.'
        ));

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dibuat! Menunggu konfirmasi admin.');
    }

    // API
    public function index(Request $request)
    {
        if ($request->user()->role === 'admin') {
            $data = Booking::with(['user', 'lapangan', 'pembayaran'])->get();
        } else {
            $data = Booking::with(['lapangan', 'pembayaran'])
                ->where('user_id', $request->user()->id)
                ->get();
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required|exists:lapangan,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'durasi_jam' => 'required|integer|min:1',
        ]);

        $lapangan = Lapangan::findOrFail($request->lapangan_id);

        if ($lapangan->status === 'inactive') {
            return response()->json(['message' => 'Lapangan tidak tersedia'], 400);
        }

        $bentrok = Booking::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })->exists();

        if ($bentrok) {
            return response()->json(['message' => 'Lapangan sudah dipesan pada jam tersebut.'], 400);
        }

        $total_harga = $lapangan->harga_per_jam * $request->durasi_jam;

        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'lapangan_id' => $request->lapangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'durasi_jam' => $request->durasi_jam,
            'total_harga' => $total_harga,
            'status' => 'pending',
        ]);

        $request->user()->notify(new BookingNotification(
            $booking->load('lapangan'),
            'Booking kamu berhasil dibuat, menunggu konfirmasi admin.'
        ));

        return response()->json([
            'message' => 'Booking berhasil dibuat',
            'data' => $booking->load(['lapangan', 'pembayaran']),
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $booking = Booking::with(['user', 'lapangan', 'pembayaran'])->findOrFail($id);

        if ($request->user()->role !== 'admin' && $booking->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($booking);
    }

    public function updateStatus(Request $request, $id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $booking = Booking::with(['lapangan', 'user'])->findOrFail($id);

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

        return response()->json([
            'message' => 'Status booking berhasil diupdate',
            'data' => $booking,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $booking = Booking::findOrFail($id);
        $booking->delete();

        return response()->json(['message' => 'Booking berhasil dihapus']);
    }
}