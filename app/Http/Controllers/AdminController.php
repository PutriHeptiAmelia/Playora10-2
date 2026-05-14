<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\JenisOlahraga;
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
            $pesan = 'Pembayaran kamu telah dikonfirmasi, booking sudah aktif!';
        } else {
            $pembayaran->booking->update(['status' => 'cancelled']);
            $pesan = 'Pembayaran kamu ditolak oleh admin, silakan hubungi admin.';
        }

        $pembayaran->booking->user->notify(new PembayaranNotification($pembayaran, $pesan));

        return redirect()->route('admin.pembayaran')->with('success', 'Status pembayaran berhasil diupdate!');
    }

    // Kelola Lapangan
    public function lapanganIndex()
    {
        $lapangan = Lapangan::with('jenisOlahraga')->get();
        return view('admin.lapangan', compact('lapangan'));
    }

    public function lapanganCreate()
    {
        $jenisOlahraga = JenisOlahraga::all();
        return view('admin.lapangan-create', compact('jenisOlahraga'));
    }

    public function lapanganStore(Request $request)
    {
        $request->validate([
            'jenis_olahraga_id' => 'required|exists:jenis_olahraga,id',
            'nama' => 'required|string|max:100',
            'harga_per_jam' => 'required|numeric',
            'status' => 'in:active,inactive',
            'fasilitas' => 'nullable|string',
        ]);

        Lapangan::create($request->all());

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil ditambahkan!');
    }

    public function lapanganEdit($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        $jenisOlahraga = JenisOlahraga::all();
        return view('admin.lapangan-edit', compact('lapangan', 'jenisOlahraga'));
    }

    public function lapanganUpdate(Request $request, $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        $request->validate([
            'jenis_olahraga_id' => 'required|exists:jenis_olahraga,id',
            'nama' => 'required|string|max:100',
            'harga_per_jam' => 'required|numeric',
            'status' => 'in:active,inactive',
            'fasilitas' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $imageName = lcfirst(str_replace(' ', '', $request->nama)) . '.jpg.jpeg';
            $file->move(public_path('images'), $imageName);
        }

        $lapangan->update($request->except('gambar'));

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil diupdate!');
    }

    public function lapanganDestroy($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        $lapangan->delete();

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil dihapus!');
    }

    // Kelola Jenis Olahraga
    public function jenisOlahragaIndex()
    {
        $jenisOlahraga = JenisOlahraga::withCount('lapangan')->get();
        return view('admin.jenis-olahraga', compact('jenisOlahraga'));
    }

    public function jenisOlahragaCreate()
    {
        return view('admin.jenis-olahraga-create');
    }

    public function jenisOlahragaStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        JenisOlahraga::create($request->all());

        return redirect()->route('admin.jenis-olahraga.index')->with('success', 'Jenis olahraga berhasil ditambahkan!');
    }

    public function jenisOlahragaEdit($id)
    {
        $jenisOlahraga = JenisOlahraga::findOrFail($id);
        return view('admin.jenis-olahraga-edit', compact('jenisOlahraga'));
    }

    public function jenisOlahragaUpdate(Request $request, $id)
    {
        $jenisOlahraga = JenisOlahraga::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $jenisOlahraga->update($request->all());

        return redirect()->route('admin.jenis-olahraga.index')->with('success', 'Jenis olahraga berhasil diupdate!');
    }

    public function jenisOlahragaDestroy($id)
    {
        $jenisOlahraga = JenisOlahraga::findOrFail($id);
        $jenisOlahraga->delete();

        return redirect()->route('admin.jenis-olahraga.index')->with('success', 'Jenis olahraga berhasil dihapus!');
    }

    // Kelola User
    public function users()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus!');
    }
}