@extends('layouts.app')

@section('title', 'Kelola Pembayaran')

@section('content')
<div class="container py-5">
    <h4 class="fw-bold mb-4">Kelola Pembayaran</h4>

    @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background-color:#f0fdf4;">
                    <tr>
                        <th>User</th>
                        <th>Lapangan</th>
                        <th>Jumlah</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $p)
                        <tr>
                            <td>{{ $p->booking->user->name }}</td>
                            <td>{{ $p->booking->lapangan->nama }}</td>
                            <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                            <td>
                                @if($p->bukti_bayar)
                                    <a href="{{ Storage::url($p->bukti_bayar) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-image me-1"></i>Lihat
                                    </a>
                                @else
                                    <span class="text-muted small">Belum ada</span>
                                @endif
                            </td>
                            <td>
                                @if($p->status === 'unpaid')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($p->status === 'paid')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                @if($p->status === 'unpaid')
                                    <form action="{{ route('admin.pembayaran.konfirmasi', $p->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="paid">
                                        <button type="submit" class="btn btn-success btn-sm">Terima</button>
                                    </form>
                                    <form action="{{ route('admin.pembayaran.konfirmasi', $p->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">Belum ada pembayaran</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection