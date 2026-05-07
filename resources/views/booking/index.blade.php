@extends('layouts.app')

@section('title', 'Booking Saya')

@section('content')
<div class="container py-5">
    <h4 class="fw-bold mb-4">Booking Saya</h4>

    @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif

    @forelse($bookings as $booking)
        <div class="card border-0 shadow-sm rounded-4 mb-3 p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="fw-bold mb-1">{{ $booking->lapangan->nama }}</h5>
                    <p class="text-muted mb-1">
                        <i class="bi bi-calendar me-1"></i>{{ $booking->tanggal }}
                        &nbsp;|&nbsp;
                        <i class="bi bi-clock me-1"></i>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}
                    </p>
                    <p class="text-muted mb-0">
                        <i class="bi bi-hourglass me-1"></i>{{ $booking->durasi_jam }} jam
                        &nbsp;|&nbsp;
                        <strong style="color:#16a34a;">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</strong>
                    </p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    @if($booking->status === 'pending')
                        <span class="badge rounded-pill bg-warning text-dark px-3 py-2">Menunggu Konfirmasi</span>
                    @elseif($booking->status === 'confirmed')
                        <span class="badge rounded-pill bg-success px-3 py-2">Dikonfirmasi</span>
                    @else
                        <span class="badge rounded-pill bg-danger px-3 py-2">Dibatalkan</span>
                    @endif

                    @if($booking->status === 'confirmed' && !$booking->pembayaran)
                        <a href="{{ route('pembayaran.create', $booking->id) }}" class="btn btn-primary btn-sm mt-2 d-block">
                            <i class="bi bi-credit-card me-1"></i>Bayar Sekarang
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
            <i class="bi bi-calendar-x display-4 text-muted"></i>
            <h5 class="mt-3">Belum Ada Booking</h5>
            <a href="{{ route('lapangan.index') }}" class="btn btn-primary mt-2">Booking Sekarang</a>
        </div>
    @endforelse
</div>
@endsection