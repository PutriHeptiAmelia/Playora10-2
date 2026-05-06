@extends('layouts.app')

@section('title', 'Daftar Lapangan')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Pilih Lapangan Olahraga</h2>
    </div>

    <div class="row">
        @forelse($lapangan as $l)
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="https://placehold.co/600x400/0d6efd/white?text={{ $l->nama_lapangan }}" class="card-img-top" alt="...">
                    
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge bg-light text-primary">{{ $l->jenisOlahraga->nama_jenis ?? 'Umum' }}</span>
                            <span class="text-muted small">Tersedia</span>
                        </div>
                        <h5 class="card-title fw-bold">{{ $l->nama_lapangan }}</h5>
                        <p class="card-text text-muted small">Lokasi: Area Playora Center</p>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <h5 class="text-primary fw-bold mb-0">Rp {{ number_format($l->harga) }}<span class="text-muted small fw-normal">/jam</span></h5>
                            <a href="#" class="btn btn-primary px-4">Booking</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-warning border-0 shadow-sm">
                    <h5>Belum Ada Data Lapangan</h5>
                    <p class="mb-0">Silakan tambahkan data di database atau minta teman Backend kamu buatkan Seeder.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection