@extends('layouts.app')

@section('title', $lapangan->nama)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-7">
            @php
                $imageName = lcfirst(str_replace(' ', '', $lapangan->nama)) . '.jpg.jpeg';
                $imagePath = public_path('images/' . $imageName);
                $imageUrl = file_exists($imagePath) ? asset('images/' . $imageName) : asset('images/hero-lapangan.jpg');
            @endphp
            <img src="{{ $imageUrl }}" class="img-fluid rounded-4 shadow w-100" alt="{{ $lapangan->nama }}" style="max-height: 500px; object-fit: cover;">
        </div>
        <div class="col-lg-5 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <span class="badge rounded-pill px-3 mb-2" style="background-color:#dcfce7; color:#16a34a; width:fit-content;">
                    {{ $lapangan->jenisOlahraga->nama ?? 'Umum' }}
                </span>
                <h3 class="fw-bold">{{ $lapangan->nama }}</h3>

                <p class="text-muted mb-1"><i class="bi bi-tools me-2"></i>{{ $lapangan->fasilitas ?? '-' }}</p>

                @if($lapangan->status === 'active')
                    <span class="badge rounded-pill mb-3" style="background-color:#dcfce7; color:#16a34a; width:fit-content;">
                        <i class="bi bi-circle-fill me-1" style="font-size:0.5rem;"></i>Tersedia
                    </span>
                @else
                    <span class="badge rounded-pill bg-danger mb-3" style="width:fit-content;">Tidak Tersedia</span>
                @endif

                <div class="p-3 rounded-3 mb-4" style="background-color:#f0fdf4;">
                    <small class="text-muted">Harga per jam</small>
                    <h3 class="fw-bold mb-0" style="color:#16a34a;">
                        Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                    </h3>
                </div>

                @auth
                    @if($lapangan->status === 'active')
                        <a href="{{ route('booking.create', $lapangan->id) }}" class="btn btn-primary w-100 py-2">
                            <i class="bi bi-calendar-plus me-2"></i>Booking Sekarang
                        </a>
                    @else
                        <button class="btn btn-secondary w-100 py-2" disabled>Lapangan Tidak Tersedia</button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login untuk Booking
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection