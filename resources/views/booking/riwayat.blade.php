@extends('layouts.app')

@section('title', 'Riwayat Booking')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Riwayat Booking</h4>
        <a href="{{ route('lapangan.index') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Booking Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background-color:#f0fdf4;">
                    <tr>
                        <th>#</th>
                        <th>Lapangan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Durasi</th>
                        <th>Total</th>
                        <th>Status Booking</th>
                        <th>Status Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $i => $booking)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $booking->lapangan->nama ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>
                        <td>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                        <td>{{ $booking->durasi_jam }} jam</td>
                        <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @if($booking->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($booking->status === 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->pembayaran)
                                @if($booking->pembayaran->status === 'unpaid')
                                    <span class="badge bg-warning text-dark">Unpaid</span>
                                @elseif($booking->pembayaran->status === 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            @else
                                <span class="badge bg-secondary">Belum ada</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('booking.show', $booking->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            Belum ada riwayat booking.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection