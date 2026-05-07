@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-1">Form Pembayaran</h4>
                <p class="text-muted mb-4">Booking #{{ $booking->id }} - {{ $booking->lapangan->nama }}</p>

                @if(session('error'))
                    <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
                @endif

                {{-- Detail Booking --}}
                <div class="p-3 rounded-3 mb-4" style="background-color:#f0fdf4;">
                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted">Tanggal</small>
                            <p class="fw-semibold mb-1">{{ $booking->tanggal }}</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Jam</small>
                            <p class="fw-semibold mb-1">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Durasi</small>
                            <p class="fw-semibold mb-1">{{ $booking->durasi_jam }} jam</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Total Bayar</small>
                            <p class="fw-bold mb-1" style="color:#16a34a;">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <input type="hidden" name="jumlah" value="{{ $booking->total_harga }}">

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Upload Bukti Pembayaran</label>
                        <input type="file" name="bukti_bayar" class="form-control rounded-3 @error('bukti_bayar') is-invalid @enderror"
                               accept="image/jpg,image/jpeg,image/png">
                        <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                        @error('bukti_bayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-upload me-2"></i>Submit Pembayaran
                    </button>
                    <a href="{{ route('booking.index') }}" class="btn btn-light w-100 py-2 mt-2 border">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection