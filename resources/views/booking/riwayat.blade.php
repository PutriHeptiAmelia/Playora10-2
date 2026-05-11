@extends('layouts.app')

@section('title', 'Riwayat Booking')

@section('content')

{{-- HEADER --}}
<section style="background: linear-gradient(135deg, #0f2b1a 0%, #1a4731 100%); padding: 50px 0 70px;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <span class="badge px-3 py-2 rounded-pill mb-3 d-inline-block" style="background:rgba(22,163,74,0.2);color:#4ade80;border:1px solid rgba(22,163,74,0.3);">
                    <i class="bi bi-clock-history me-1"></i>Riwayat
                </span>
                <h2 class="fw-bold text-white mb-1">Riwayat Booking</h2>
                <p style="color:#94a3b8;" class="mb-0">Semua histori reservasi lapangan kamu</p>
            </div>
            <a href="{{ route('lapangan.index') }}"
               class="btn fw-semibold px-4 py-2"
               style="background:linear-gradient(135deg,#16a34a,#15803d);color:white;border:none;border-radius:12px;">
                <i class="bi bi-plus-lg me-1"></i>Booking Baru
            </a>
        </div>
    </div>
</section>

<section style="background:#f8fafc; padding: 40px 0; margin-top:-30px;">
    <div class="container">

        @if(session('success'))
            <div class="alert border-0 rounded-4 mb-4 px-4 py-3" style="background:#dcfce7;color:#15803d;">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert border-0 rounded-4 mb-4 px-4 py-3" style="background:#fee2e2;color:#991b1b;">
                <i class="bi bi-x-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        <div class="card border-0 rounded-4 overflow-hidden" style="box-shadow:0 4px 24px rgba(0,0,0,0.07);">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr style="background:linear-gradient(135deg,#0f2b1a,#1a4731);">
                            <th class="py-3 px-4 text-white fw-semibold" style="font-size:0.85rem;">#</th>
                            <th class="py-3 px-4 text-white fw-semibold" style="font-size:0.85rem;">Lapangan</th>
                            <th class="py-3 px-4 text-white fw-semibold" style="font-size:0.85rem;">Tanggal</th>
                            <th class="py-3 px-4 text-white fw-semibold" style="font-size:0.85rem;">Jam</th>
                            <th class="py-3 px-4 text-white fw-semibold" style="font-size:0.85rem;">Durasi</th>
                            <th class="py-3 px-4 text-white fw-semibold" style="font-size:0.85rem;">Total</th>
                            <th class="py-3 px-4 text-white fw-semibold" style="font-size:0.85rem;">Status Booking</th>
                            <th class="py-3 px-4 text-white fw-semibold" style="font-size:0.85rem;">Status Bayar</th>
                            <th class="py-3 px-4 text-white fw-semibold" style="font-size:0.85rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $i => $booking)
                        <tr style="border-bottom:1px solid #f1f5f9; background: {{ $i % 2 == 0 ? 'white' : '#fafafa' }};">
                            <td class="py-3 px-4 text-muted" style="font-size:0.85rem;">{{ $i + 1 }}</td>
                            <td class="py-3 px-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:34px;height:34px;background:#dcfce7;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                        <i class="bi bi-dribbble" style="color:#16a34a;font-size:0.9rem;"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-semibold" style="font-size:0.9rem;">{{ $booking->lapangan->nama ?? '-' }}</p>
                                        <small class="text-muted">{{ $booking->lapangan->jenisOlahraga->nama ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4" style="font-size:0.85rem;">
                                <i class="bi bi-calendar3 me-1 text-muted"></i>
                                {{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}
                            </td>
                            <td class="py-3 px-4" style="font-size:0.85rem;">
                                <i class="bi bi-clock me-1 text-muted"></i>
                                {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}
                            </td>
                            <td class="py-3 px-4" style="font-size:0.85rem;">
                                <i class="bi bi-hourglass-split me-1 text-muted"></i>
                                {{ $booking->durasi_jam }} jam
                            </td>
                            <td class="py-3 px-4 fw-bold" style="color:#16a34a;font-size:0.9rem;">
                                Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-4">
                                @if($booking->status === 'pending')
                                    <span class="badge rounded-pill px-3 py-2" style="background:#fef3c7;color:#92400e;font-size:0.75rem;">
                                        <i class="bi bi-hourglass me-1"></i>Pending
                                    </span>
                                @elseif($booking->status === 'confirmed')
                                    <span class="badge rounded-pill px-3 py-2" style="background:#dcfce7;color:#15803d;font-size:0.75rem;">
                                        <i class="bi bi-check-circle me-1"></i>Confirmed
                                    </span>
                                @else
                                    <span class="badge rounded-pill px-3 py-2" style="background:#fee2e2;color:#991b1b;font-size:0.75rem;">
                                        <i class="bi bi-x-circle me-1"></i>Cancelled
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                @if($booking->pembayaran)
                                    @if($booking->pembayaran->status === 'unpaid')
                                        <span class="badge rounded-pill px-3 py-2" style="background:#fef3c7;color:#92400e;font-size:0.75rem;">
                                            <i class="bi bi-clock me-1"></i>Unpaid
                                        </span>
                                    @elseif($booking->pembayaran->status === 'paid')
                                        <span class="badge rounded-pill px-3 py-2" style="background:#dcfce7;color:#15803d;font-size:0.75rem;">
                                            <i class="bi bi-check-circle me-1"></i>Paid
                                        </span>
                                    @else
                                        <span class="badge rounded-pill px-3 py-2" style="background:#fee2e2;color:#991b1b;font-size:0.75rem;">
                                            <i class="bi bi-x-circle me-1"></i>Rejected
                                        </span>
                                    @endif
                                @else
                                    <span class="badge rounded-pill px-3 py-2" style="background:#f1f5f9;color:#64748b;font-size:0.75rem;">
                                        <i class="bi bi-dash me-1"></i>Belum ada
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('booking.show', $booking->id) }}"
                                   class="btn btn-sm fw-semibold px-3"
                                   style="background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0;border-radius:8px;font-size:0.8rem;">
                                    <i class="bi bi-eye me-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <div style="width:64px;height:64px;background:#f0fdf4;border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                                    <i class="bi bi-calendar-x" style="color:#16a34a;font-size:1.5rem;"></i>
                                </div>
                                <p class="text-muted mb-0">Belum ada riwayat booking.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection