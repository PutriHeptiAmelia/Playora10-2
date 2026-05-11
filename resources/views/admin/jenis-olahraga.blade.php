@extends('layouts.app')

@section('title', 'Kelola Jenis Olahraga')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Kelola Jenis Olahraga</h4>
        <a href="{{ route('admin.jenis-olahraga.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Jenis Olahraga
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
                        <th>Deskripsi</th>
                        <th>Jumlah Lapangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisOlahraga as $j)
                        <tr>
                            <td class="fw-semibold">{{ $j->nama }}</td>
                            <td>{{ $j->deskripsi ?? '-' }}</td>
                            <td>{{ $j->lapangan->count() }} lapangan</td>
                            <td>
                                <a href="{{ route('admin.jenis-olahraga.edit', $j->id) }}" class="btn btn-sm btn-outline-secondary me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.jenis-olahraga.destroy', $j->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus jenis olahraga ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted">Belum ada jenis olahraga</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection