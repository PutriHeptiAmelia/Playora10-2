@extends('layouts.app')

@section('title', 'Booking Lapangan Olahraga Jadi Mudah')

@section('content')
<div class="container">
    <div class="row align-items-center py-5" style="min-height: 80vh;">
        <div class="col-lg-6">
            <span class="badge bg-soft-primary text-primary mb-3 px-3 py-2" style="background-color: #e7f0ff;">#1 Sport Reservation in Town</span>
            <h1 class="display-4 fw-bold mb-3">Tap, Book, and <span class="text-primary">Play!</span></h1>
            <p class="lead text-muted mb-4">
                Nikmati kemudahan memesan lapangan olahraga favoritmu mulai dari Futsal, Badminton, hingga Basket hanya dalam hitungan detik.
            </p>
            <div class="d-flex gap-3">
                <a href="#" class="btn btn-primary btn-lg shadow">Pesan Sekarang</a>
                <a href="#" class="btn btn-light btn-lg border">Lihat Lapangan</a>
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block text-center">
            <img src="https://img.freepik.com/free-vector/soccer-players-action-stadium_1150-15367.jpg" alt="Sport Illustration" class="img-fluid rounded-4">
        </div>
    </div>

    <div class="row text-center mt-5">
        <div class="col-md-4 mb-4">
            <div class="p-4 bg-white rounded-4 shadow-sm border-0">
                <h5 class="fw-bold">Pilih Lapangan</h5>
                <p class="text-muted small">Berbagai pilihan lapangan berkualitas di lokasimu.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 bg-white rounded-4 shadow-sm border-0">
                <h5 class="fw-bold">Pilih Jadwal</h5>
                <p class="text-muted small">Cek ketersediaan jam secara real-time tanpa telepon.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 bg-white rounded-4 shadow-sm border-0">
                <h5 class="fw-bold">Bayar Langsung</h5>
                <p class="text-muted small">Metode pembayaran mudah dan verifikasi cepat.</p>
            </div>
        </div>
    </div>
</div>
@endsection