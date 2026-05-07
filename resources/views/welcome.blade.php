@extends('layouts.app')

@section('title', 'Booking Lapangan Olahraga Jadi Mudah')

@section('content')
<div class="container">
    {{-- Hero Section --}}
    <div class="row align-items-center py-5" style="min-height: 80vh;">
        <div class="col-lg-6">
            <span class="badge mb-3 px-3 py-2 rounded-pill" style="background-color: #dcfce7; color: #16a34a; font-size: 0.85rem;">
                <i class="bi bi-star-fill me-1"></i>#1 Sport Reservation in Town
            </span>
            <h1 class="display-4 fw-bold mb-3" style="line-height: 1.2;">
                Tap, Book, and <span style="color: #f97316;">Play!</span>
            </h1>
            <p class="lead text-muted mb-4">
                Nikmati kemudahan memesan lapangan olahraga favoritmu mulai dari Futsal, Badminton, hingga Basket hanya dalam hitungan detik.
            </p>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('lapangan.index') }}" class="btn btn-primary btn-lg shadow">
                    <i class="bi bi-lightning-fill me-2"></i>Pesan Sekarang
                </a>
                <a href="{{ route('lapangan.index') }}" class="btn btn-light btn-lg border">
                    <i class="bi bi-eye me-2"></i>Lihat Lapangan
                </a>
            </div>

            {{-- Stats --}}
            <div class="row mt-5 g-3">
                <div class="col-4">
                    <h4 class="fw-bold mb-0" style="color: #16a34a;">15+</h4>
                    <small class="text-muted">Lapangan</small>
                </div>
                <div class="col-4">
                    <h4 class="fw-bold mb-0" style="color: #16a34a;">5</h4>
                    <small class="text-muted">Jenis Olahraga</small>
                </div>
                <div class="col-4">
                    <h4 class="fw-bold mb-0" style="color: #16a34a;">24/7</h4>
                    <small class="text-muted">Booking Online</small>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block text-center">
            <img src="{{ asset('images/hero-lapangan.jpg') }}" class="card-img-top" alt="Lapangan Futsal Playora" style="object-fit: cover; height: 400px;">
        </div>
    </div>

    {{-- How It Works --}}
    <div class="row text-center mt-3 mb-5">
        <div class="col-12 mb-4">
            <h2 class="fw-bold">Cara Pemesanan</h2>
            <p class="text-muted">Hanya 3 langkah mudah untuk booking lapangan</p>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                <div class="mb-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background-color:#dcfce7;">
                        <i class="bi bi-search fs-4" style="color:#16a34a;"></i>
                    </span>
                </div>
                <h5 class="fw-bold">1. Pilih Lapangan</h5>
                <p class="text-muted small">Berbagai pilihan lapangan berkualitas di lokasimu.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                <div class="mb-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background-color:#dcfce7;">
                        <i class="bi bi-calendar2-check fs-4" style="color:#16a34a;"></i>
                    </span>
                </div>
                <h5 class="fw-bold">2. Pilih Jadwal</h5>
                <p class="text-muted small">Cek ketersediaan jam secara real-time tanpa telepon.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                <div class="mb-3">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background-color:#fff7ed;">
                        <i class="bi bi-credit-card fs-4" style="color:#f97316;"></i>
                    </span>
                </div>
                <h5 class="fw-bold">3. Bayar Langsung</h5>
                <p class="text-muted small">Metode pembayaran mudah dan verifikasi cepat.</p>
            </div>
        </div>
    </div>
</div>
@endsection