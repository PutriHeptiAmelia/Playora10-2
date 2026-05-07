@extends('layouts.app')

@section('title', 'Booking Lapangan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-1">Form Booking</h4>
                <p class="text-muted mb-4">{{ $lapangan->nama }}</p>

                @if(session('error'))
                    <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control rounded-3 @error('tanggal') is-invalid @enderror"
                               min="{{ date('Y-m-d') }}" value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control rounded-3 @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}">
                            @error('jam_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control rounded-3 @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai') }}">
                            @error('jam_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Durasi (jam)</label>
                        <input type="number" name="durasi_jam" class="form-control rounded-3 @error('durasi_jam') is-invalid @enderror"
                               min="1" max="12" value="{{ old('durasi_jam', 1) }}">
                        @error('durasi_jam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="p-3 rounded-3 mb-4" style="background-color:#f0fdf4;">
                        <small class="text-muted">Harga per jam</small>
                        <h5 class="fw-bold mb-0" style="color:#16a34a;">
                            Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / jam
                        </h5>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-calendar-check me-2"></i>Konfirmasi Booking
                    </button>
                    <a href="{{ route('lapangan.show', $lapangan->id) }}" class="btn btn-light w-100 py-2 mt-2 border">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection