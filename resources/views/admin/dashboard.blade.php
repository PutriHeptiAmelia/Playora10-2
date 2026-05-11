@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-5">
    <h4 class="fw-bold mb-4">Dashboard Admin</h4>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 rounded-4 p-4 h-100" style="background:linear-gradient(135deg, #eff6ff, #dbeafe); border: 1px solid #bfdbfe !important; box-shadow: 0 4px 20px rgba(59,130,246,0.1); transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div class="d-flex align-items-center gap-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width:56px;height:56px;background-color:#3b82f6;">
                        <i class="bi bi-people fs-4" style="color:#ffffff;"></i>
                    </span>
                    <div>
                        <small class="fw-semibold" style="color:#3b82f6;">Total User</small>
                        <h4 class="fw-bold mb-0 text-dark">{{ $totalUsers }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 rounded-4 p-4 h-100" style="background:linear-gradient(135deg, #f0fdf4, #dcfce7); border: 1px solid #bbf7d0 !important; box-shadow: 0 4px 20px rgba(22,163,74,0.1); transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div class="d-flex align-items-center gap-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width:56px;height:56px;background-color:#16a34a;">
                        <i class="bi bi-grid fs-4" style="color:#ffffff;"></i>
                    </span>
                    <div>
                        <small class="fw-semibold" style="color:#16a34a;">Total Lapangan</small>
                        <h4 class="fw-bold mb-0 text-dark">{{ $totalLapangan }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 rounded-4 p-4 h-100" style="background:linear-gradient(135deg, #fff7ed, #ffedd5); border: 1px solid #fed7aa !important; box-shadow: 0 4px 20px rgba(249,115,22,0.1); transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div class="d-flex align-items-center gap-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width:56px;height:56px;background-color:#f97316;">
                        <i class="bi bi-calendar-check fs-4" style="color:#ffffff;"></i>
                    </span>
                    <div>
                        <small class="fw-semibold" style="color:#ea580c;">Total Booking</small>
                        <h4 class="fw-bold mb-0 text-dark">{{ $totalBookings }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 rounded-4 p-4 h-100" style="background:linear-gradient(135deg, #fce7f3, #fbcfe8); border: 1px solid #f9a8d4 !important; box-shadow: 0 4px 20px rgba(236,72,153,0.1); transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div class="d-flex align-items-center gap-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width:56px;height:56px;background-color:#ec4899;">
                        <i class="bi bi-cash-stack fs-4" style="color:#ffffff;"></i>
                    </span>
                    <div>
                        <small class="fw-semibold" style="color:#db2777;">Total Pendapatan</small>
                        <h4 class="fw-bold mb-0 text-dark">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Booking Terbaru --}}
    <div class="card border-0 rounded-4 p-4" style="background-color: #ffffff; box-shadow: 0 8px 30px rgba(0,0,0,0.15);">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0 text-dark">Booking Terbaru</h5>
            <a href="{{ route('admin.bookings') }}" class="btn btn-sm px-3 fw-semibold" style="background-color: #f0fdf4; color: #16a34a; border-radius: 20px;">Lihat Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="color: #1e293b;">
                <thead style="background-color:#f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <tr>
                        <th class="text-secondary fw-semibold border-0 py-3">User</th>
                        <th class="text-secondary fw-semibold border-0 py-3">Lapangan</th>
                        <th class="text-secondary fw-semibold border-0 py-3">Tanggal</th>
                        <th class="text-secondary fw-semibold border-0 py-3">Total</th>
                        <th class="text-secondary fw-semibold border-0 py-3">Status</th>
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