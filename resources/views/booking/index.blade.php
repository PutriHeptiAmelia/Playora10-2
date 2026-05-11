@extends('layouts.app')

@section('title', 'Booking Saya')

@section('content')

{{-- HEADER --}}
<section style="background: linear-gradient(135deg, #0f2b1a 0%, #1a4731 100%); padding: 50px 0 70px;">
    <div class="container text-center">
        <span class="badge px-3 py-2 rounded-pill mb-3" style="background:rgba(22,163,74,0.2);color:#4ade80;border:1px solid rgba(22,163,74,0.3);">
            <i class="bi bi-calendar-check me-1"></i>Booking Saya
        </span>
        <h2 class="fw-bold text-white mb-2">Daftar Booking Aktif</h2>
        <p style="color:#94a3b8;">Pantau status reservasi lapangan kamu di sini</p>
    </div>
</section>

<section style="background:#f8fafc; padding: 40px 0; margin-top:-30px;">
    <div class="container">

        @if(session('success'))
            <div class="alert border-0 rounded-4 mb-4 px-4 py-3" style="background:#dcfce7;color:#15803d;">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @forelse($bookings as $booking)
            <div class="card border-0 rounded-4 mb-4 overflow-hidden"
                 style="box-shadow: 0 4px 24px rgba(0,0,0,0.07);">
                <div class="row g-0">
                    {{-- Left accent bar --}}
                    <div class="col-auto" style="width:6px; background:
                        {{ $booking->status === 'confirmed' ? 'linear-gradient(180deg,#16a34a,#15803d)' :
                           ($booking->status === 'pending' ? 'linear-gradient(180deg,#f59e0b,#d97706)' :
                           'linear-gradient(180deg,#ef4444,#dc2626)') }};"></div>

                    <div class="col">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    {{-- Lapangan name --}}
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div style="width:40px;height:40px;background:#dcfce7;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                                            <i class="bi bi-dribbble" style="color:#16a34a;font-size:1.1rem;"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">{{ $booking->lapangan->nama }}</h5>
                                            <small class="text-muted">{{ $booking->lapangan->jenisOlahraga->nama ?? '-' }}</small>
                                        </div>
                                    </div>

                                    {{-- Info --}}
                                    <div class="d-flex flex-wrap gap-3 mt-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:32px;height:32px;background:#f0fdf4;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                                <i class="bi bi-calendar3" style="color:#16a34a;font-size:0.85rem;"></i>
                                            </div>
                                            <span class="small fw-semibold">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:32px;height:32px;background:#f0fdf4;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                                <i class="bi bi-clock" style="color:#16a34a;font-size:0.85rem;"></i>
                                            </div>
                                            <span class="small fw-semibold">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:32px;height:32px;background:#f0fdf4;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                                <i class="bi bi-hourglass-split" style="color:#16a34a;font-size:0.85rem;"></i>
                                            </div>
                                            <span class="small fw-semibold">{{ $booking->durasi_jam }} jam</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5 text-md-end mt-4 mt-md-0">
                                    {{-- Harga --}}
                                    <p class="text-muted small mb-1">Total Harga</p>
                                    <h4 class="fw-bold mb-3" style="color:#16a34a;">
                                        Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                    </h4>

                                    {{-- Status badge --}}
                                    @if($booking->status === 'pending')
                                        <span class="badge rounded-pill px-3 py-2 mb-2 d-inline-block" style="background:#fef3c7;color:#92400e;font-size:0.8rem;">
                                            <i class="bi bi-hourglass me-1"></i>Menunggu Konfirmasi
                                        </span>
                                    @elseif($booking->status === 'confirmed')
                                        <span class="badge rounded-pill px-3 py-2 mb-2 d-inline-block" style="background:#dcfce7;color:#15803d;font-size:0.8rem;">
                                            <i class="bi bi-check-circle me-1"></i>Dikonfirmasi
                                        </span>
                                    @else
                                        <span class="badge rounded-pill px-3 py-2 mb-2 d-inline-block" style="background:#fee2e2;color:#991b1b;font-size:0.8rem;">
                                            <i class="bi bi-x-circle me-1"></i>Dibatalkan
                                        </span>
                                    @endif

                                    {{-- Tombol bayar --}}
                                    @if($booking->status === 'confirmed' && !$booking->pembayaran)
                                        <div>
                                            <a href="{{ route('pembayaran.create', $booking->id) }}"
                                               class="btn fw-semibold px-4 py-2"
                                               style="background:linear-gradient(135deg,#16a34a,#15803d);color:white;border:none;border-radius:12px;font-size:0.85rem;">
                                                <i class="bi bi-credit-card me-1"></i>Bayar Sekarang
                                            </a>
                                        </div>
                                    @endif

                                    {{-- Link detail --}}
                                    <div class="mt-2">
                                        <a href="{{ route('booking.show', $booking->id) }}"
                                           style="color:#16a34a;font-size:0.85rem;text-decoration:none;">
                                            <i class="bi bi-eye me-1"></i>Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5 bg-white rounded-4" style="box-shadow:0 4px 24px rgba(0,0,0,0.07);">
                <div style="width:80px;height:80px;background:#f0fdf4;border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="bi bi-calendar-x" style="color:#16a34a;font-size:2rem;"></i>
                </div>
                <h5 class="fw-bold">Belum Ada Booking</h5>
                <p class="text-muted mb-4">Yuk booking lapangan favoritmu sekarang!</p>
                <a href="{{ route('lapangan.index') }}"
                   class="btn fw-semibold px-5 py-2"
                   style="background:linear-gradient(135deg,#16a34a,#15803d);color:white;border:none;border-radius:12px;">
                    <i class="bi bi-lightning-fill me-1"></i>Booking Sekarang
                </a>
            </div>
        @endforelse

    </div>
</section>

@endsection