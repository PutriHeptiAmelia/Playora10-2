@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-5">
    <h4 class="fw-bold mb-4">Dashboard Admin</h4>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background-color:#dcfce7;">
                        <i class="bi bi-people fs-4" style="color:#16a34a;"></i>
                    </span>
                    <div>
                        <small class="text-muted">Total User</small>
                        <h4 class="fw-bold mb-0">{{ $totalUsers }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background-color:#dcfce7;">
                        <i class="bi bi-grid fs-4" style="color:#16a34a;"></i>
                    </span>
                    <div>
                        <small class="text-muted">Total Lapangan</small>
                        <h4 class="fw-bold mb-0">{{ $totalLapangan }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background-color:#fff7ed;">
                        <i class="bi bi-calendar-check fs-4" style="color:#f97316;"></i>
                    </span>
                    <div>
                        <small class="text-muted">Total Booking</small>
                        <h4 class="fw-bold mb-0">{{ $totalBookings }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background-color:#fff7ed;">
                        <i class="bi bi-cash-stack fs-4" style="color:#f97316;"></i>
                    </span>
                    <div>
                        <small class="text-muted">Total Pendapatan</small>
                        <h4 class="fw-bold mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Booking Terbaru --}}
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Booking Terbaru</h5>
            <a href="{{ route('admin.bookings') }}" style="color:#16a34a;">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background-color:#f0fdf4;">
                    <tr>
                        <th>User</th>
                        <th>Lapangan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBookings as $booking)
                        <tr>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->lapangan->nama }}</td>
                            <td>{{ $booking->tanggal }}</td>
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
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted">Belum ada booking</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection