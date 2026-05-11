@extends('layouts.app')

@section('title', 'Daftar Lapangan')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Pilih Lapangan Olahraga</h2>
            <p class="text-muted mb-0">Temukan lapangan terbaik untuk aktivitasmu</p>
        </div>
    </div>

    {{-- Filter --}}
    <div class="mb-4">
        <form action="{{ route('lapangan.index') }}" method="GET" class="d-flex gap-2 flex-wrap">
            <a href="{{ route('lapangan.index') }}" class="btn {{ !request('jenis') ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-4">
                Semua
            </a>
            @foreach($jenisOlahraga as $j)
                <a href="{{ route('lapangan.index', ['jenis' => $j->id]) }}"
                   class="btn {{ request('jenis') == $j->id ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-4">
                    {{ $j->nama }}
                </a>
            @endforeach
        </form>
    </div>

    <div class="row">
        @forelse($lapangan as $l)
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="https://placehold.co/600x400/16a34a/white?text={{ urlencode($l->nama) }}"
                         class="card-img-top" alt="{{ $l->nama }}">

                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge rounded-pill px-3" style="background-color:#dcfce7; color:#16a34a;">
                                <i class="bi bi-tag me-1"></i>{{ $l->jenisOlahraga->nama ?? 'Umum' }}
                            </span>
                            @if($l->status === 'active')
                                <span class="badge rounded-pill" style="background-color:#dcfce7; color:#16a34a;">
                                    <i class="bi bi-circle-fill me-1" style="font-size:0.5rem;"></i>Tersedia
                                </span>
                            @else
                                <span class="badge rounded-pill bg-danger">
                                    <i class="bi bi-circle-fill me-1" style="font-size:0.5rem;"></i>Tidak Tersedia
                                </span>
                            @endif
                        </div>

                        <h5 class="card-title fw-bold mt-2">{{ $l->nama }}</h5>
                        <p class="text-muted small mb-1">
                            <i class="bi bi-tools me-1"></i>{{ $l->fasilitas ?? '-' }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <small class="text-muted">Mulai dari</small>
                                <h5 class="fw-bold mb-0" style="color:#16a34a;">
                                    Rp {{ number_format($l->harga_per_jam, 0, ',', '.') }}
                                    <span class="text-muted small fw-normal">/jam</span>
                                </h5>
                            </div>
                            @if($l->status === 'active')
                                <a href="{{ route('lapangan.show', $l->id) }}" class="btn btn-primary px-4">
                                    <i class="bi bi-calendar-plus me-1"></i>Booking
                                </a>
                            @else
                                <button class="btn btn-secondary px-4" disabled>Penuh</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-4 shadow-sm">
                    <i class="bi bi-emoji-frown display-4 text-muted"></i>
                    <h5 class="mt-3">Belum Ada Data Lapangan</h5>
                    <p class="text-muted mb-0">Silakan jalankan seeder untuk mengisi data lapangan.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection