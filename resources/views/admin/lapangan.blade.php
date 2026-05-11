@extends('layouts.app')

@section('title', 'Kelola Lapangan')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Kelola Lapangan</h4>
        <a href="{{ route('admin.lapangan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Lapangan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead style="background-color:#f0fdf4;">
                    <tr>
                        <th>Nama</th>
                        <th>Jenis Olahraga</th>
                        <th>Harga/Jam</th>
                        <th>Fasilitas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lapangan as $l)
                        <tr>
                            <td class="fw-semibold">{{ $l->nama }}</td>
                            <td>{{ $l->jenisOlahraga->nama ?? '-' }}</td>
                            <td>Rp {{ number_format($l->harga_per_jam, 0, ',', '.') }}</td>
                            <td>{{ $l->fasilitas ?? '-' }}</td>
                            <td>
                                @if($l->status === 'active')
                                    <span class="badge rounded-pill" style="background-color:#dcfce7; color:#16a34a;">Aktif</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.lapangan.edit', $l->id) }}" class="btn btn-sm btn-outline-secondary me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.lapangan.destroy', $l->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus lapangan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">Belum ada lapangan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection