@extends('layouts.app')

@section('title', 'Daftar Lapangan')

@section('content')

{{-- HEADER SECTION --}}
<section style="background: linear-gradient(135deg, #0f2b1a 0%, #1a4731 100%); padding: 60px 0 80px;">
    <div class="container text-center">
        <span class="badge px-3 py-2 rounded-pill mb-3" style="background:rgba(22,163,74,0.2);color:#4ade80;border:1px solid rgba(22,163,74,0.3);">
            <i class="bi bi-grid me-1"></i>Pilih Lapangan
        </span>
        <h2 class="fw-bold text-white mb-2" style="font-size:2.5rem;">Lapangan Olahraga Terbaik</h2>
        <p style="color:#94a3b8;">Temukan dan booking lapangan favoritmu dengan mudah</p>

        {{-- Filter --}}
        <div class="mt-4 d-flex gap-2 flex-wrap justify-content-center">
            <a href="{{ route('lapangan.index') }}"
               class="btn rounded-pill px-4 py-2 fw-semibold {{ !request('jenis') ? '' : '' }}"
               style="{{ !request('jenis') ? 'background:#16a34a;color:white;border:none;' : 'background:rgba(255,255,255,0.1);color:white;border:1px solid rgba(255,255,255,0.2);' }}">
                Semua
            </a>
            @foreach($jenisOlahraga as $j)
                <a href="{{ route('lapangan.index', ['jenis' => $j->id]) }}"
                   class="btn rounded-pill px-4 py-2 fw-semibold"
                   style="{{ request('jenis') == $j->id ? 'background:#16a34a;color:white;border:none;' : 'background:rgba(255,255,255,0.1);color:white;border:1px solid rgba(255,255,255,0.2);' }}">
                    {{ $j->nama }}
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- LAPANGAN CARDS --}}
<section style="background:#f8fafc; padding: 60px 0; margin-top:-30px;">
    <div class="container">
        <div class="row g-4">
            @forelse($lapangan as $l)
                <div class="col-md-4">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden"
                         style="box-shadow: 0 4px 24px rgba(0,0,0,0.08); transition: transform 0.3s, box-shadow 0.3s;"
                         onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 12px 40px rgba(0,0,0,0.15)'"
                         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 24px rgba(0,0,0,0.08)'">

                        {{-- Image --}}
                        <div style="position:relative; overflow:hidden;">
                            @php
                                $imageName = lcfirst(str_replace(' ', '', $l->nama)) . '.jpg.jpeg';
                                $imagePath = public_path('images/' . $imageName);
                                $imageUrl = file_exists($imagePath) ? asset('images/' . $imageName) : asset('images/hero-lapangan.jpg');
                            @endphp
                            <img src="{{ $imageUrl }}" alt="{{ $l->nama }}"
                                 style="width:100%; height:220px; object-fit:cover; transition:transform 0.4s;"
                                 onmouseover="this.style.transform='scale(1.05)'"
                                 onmouseout="this.style.transform='scale(1)'">

                            {{-- Status badge overlay --}}
                            <div style="position:absolute; top:12px; right:12px;">
                                @if($l->status === 'active')
                                    <span class="badge px-3 py-2 rounded-pill fw-semibold"
                                          style="background:rgba(22,163,74,0.9);color:white;backdrop-filter:blur(4px);">
                                        <i class="bi bi-circle-fill me-1" style="font-size:0.4rem;vertical-align:middle;"></i>Tersedia
                                    </span>
                                @else
                                    <span class="badge px-3 py-2 rounded-pill fw-semibold"
                                          style="background:rgba(220,38,38,0.9);color:white;backdrop-filter:blur(4px);">
                                        <i class="bi bi-circle-fill me-1" style="font-size:0.4rem;vertical-align:middle;"></i>Tidak Tersedia
                                    </span>
                                @endif
                            </div>

                            {{-- Jenis olahraga badge --}}
                            <div style="position:absolute; top:12px; left:12px;">
                                <span class="badge px-3 py-2 rounded-pill fw-semibold"
                                      style="background:rgba(0,0,0,0.6);color:white;backdrop-filter:blur(4px);">
                                    <i class="bi bi-tag me-1"></i>{{ $l->jenisOlahraga->nama ?? 'Umum' }}
                                </span>
                            </div>
                        </div>

                        {{-- Card body --}}
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-1">{{ $l->nama }}</h5>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-tools me-1"></i>{{ $l->fasilitas ?? '-' }}
                            </p>

                            <hr style="border-color:#f0f0f0;">

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <small class="text-muted d-block">Harga sewa</small>
                                    <span class="fw-bold fs-5" style="color:#16a34a;">
                                        Rp {{ number_format($l->harga_per_jam, 0, ',', '.') }}
                                    </span>
                                    <small class="text-muted">/jam</small>
                                </div>
                                @if($l->status === 'active')
                                    <a href="{{ route('lapangan.show', $l->id) }}"
                                       class="btn fw-semibold px-4 py-2"
                                       style="background:linear-gradient(135deg,#16a34a,#15803d);color:white;border:none;border-radius:12px;">
                                        <i class="bi bi-calendar-plus me-1"></i>Booking
                                    </a>
                                @else
                                    <button class="btn px-4 py-2 fw-semibold"
                                            style="background:#f1f5f9;color:#94a3b8;border:none;border-radius:12px;" disabled>
                                        Tidak Tersedia
                                    </button>
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
                        <p class="text-muted mb-0">Belum ada lapangan yang tersedia saat ini.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection