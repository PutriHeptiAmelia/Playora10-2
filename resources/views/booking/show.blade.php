@extends('layouts.app')

@section('title', 'Detail Booking')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Detail Booking</h4>
        <a href="{{ route('booking.riwayat') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        <!-- Detail Booking -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h6 class="fw-bold mb-3">Info Booking</h6>
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted">Lapangan</td>
                        <td class="fw-semibold">{{ $booking->lapangan->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jenis Olahraga</td>
                        <td>{{ $booking->lapangan->jenisOlahraga->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal</td>
                        <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jam</td>
                        <td>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Durasi</td>
                        <td>{{ $booking->durasi_jam }} jam</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Total Harga</td>
                        <td class="fw-bold text-success">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        <td>
                            @if($booking->status === 'pending')
                                <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                            @elseif($booking->status === 'confirmed')
                                <span class="badge bg-success">Dikonfirmasi</span>
                            @else
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Detail Pembayaran -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h6 class="fw-bold mb-3">Info Pembayaran</h6>

                @if($booking->pembayaran)
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted">Jumlah</td>
                            <td class="fw-bold">Rp {{ number_format($booking->pembayaran->jumlah, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status</td>
                            <td>
                                @if($booking->pembayaran->status === 'unpaid')
                                    <span class="badge bg-warning text-dark">Belum Dibayar</span>
                                @elseif($booking->pembayaran->status === 'paid')
                                    <span class="badge bg-success">Dibayar</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                        @if($booking->pembayaran->bukti_bayar)
                        <tr>
                            <td class="text-muted">Bukti Bayar</td>
                            <td>
                                <a href="{{ asset('storage/' . $booking->pembayaran->bukti_bayar) }}"
                                   target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-image me-1"></i>Lihat Bukti
                                </a>
                            </td>
                        </tr>
                        @endif
                        @if($booking->pembayaran->confirmed_at)
                        <tr>
                            <td class="text-muted">Dikonfirmasi</td>
                            <td>{{ \Carbon\Carbon::parse($booking->pembayaran->confirmed_at)->format('d M Y H:i') }}</td>
                        </tr>
                        @endif
                    </table>
                @else
                    <p class="text-muted">Belum ada data pembayaran.</p>
                @endif

                <!-- Form upload bukti bayar -->
                @if($booking->status === 'confirmed' && (!$booking->pembayaran || $booking->pembayaran->status === 'rejected'))
                <hr>
                <h6 class="fw-bold mb-3">Upload Bukti Pembayaran</h6>
                <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <input type="hidden" name="jumlah" value="{{ $booking->total_harga }}">
                    <div class="mb-3">
                        <label class="form-label">Bukti Transfer</label>
                        <input type="file" name="bukti_bayar" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-upload me-1"></i>Upload Bukti Bayar
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection