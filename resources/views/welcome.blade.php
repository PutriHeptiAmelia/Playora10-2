@extends('layouts.app')

@section('title', 'Booking Lapangan Olahraga Jadi Mudah')

@section('content')

{{-- HERO SECTION --}}
<section style="background: linear-gradient(135deg, #0f2b1a 0%, #1a4731 50%, #0f2b1a 100%); min-height: 90vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    {{-- Background decoration --}}
    <div style="position:absolute; top:-100px; right:-100px; width:500px; height:500px; background:radial-gradient(circle, rgba(22,163,74,0.15) 0%, transparent 70%); border-radius:50%;"></div>
    <div style="position:absolute; bottom:-100px; left:-100px; width:400px; height:400px; background:radial-gradient(circle, rgba(249,115,22,0.1) 0%, transparent 70%); border-radius:50%;"></div>

    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge mb-4 px-4 py-2 rounded-pill" style="background: rgba(22,163,74,0.2); color: #4ade80; font-size: 0.85rem; border: 1px solid rgba(22,163,74,0.3);">
                    <i class="bi bi-star-fill me-1"></i>#1 Sport Reservation in Town
                </span>
                <h1 class="fw-bold mb-4" style="font-size: 3.5rem; line-height: 1.1; color: #ffffff;">
                    Tap, Book, and <br><span style="color: #f97316; text-shadow: 0 0 30px rgba(249,115,22,0.5);">Play!</span>
                </h1>
                <p class="mb-5" style="color: #94a3b8; font-size: 1.1rem; line-height: 1.8;">
                    Nikmati kemudahan memesan lapangan olahraga favoritmu mulai dari Futsal, Badminton, hingga Basket hanya dalam hitungan detik.
                </p>
                <div class="d-flex gap-3 flex-wrap mb-5">
                    <a href="{{ route('lapangan.index') }}" class="btn btn-lg px-5 py-3 fw-bold" style="background: linear-gradient(135deg, #16a34a, #15803d); color: white; border: none; border-radius: 50px; box-shadow: 0 8px 25px rgba(22,163,74,0.4);">
                        <i class="bi bi-lightning-fill me-2"></i>Pesan Sekarang
                    </a>
                    <a href="{{ route('lapangan.index') }}" class="btn btn-lg px-5 py-3 fw-bold" style="background: transparent; color: white; border: 2px solid rgba(255,255,255,0.3); border-radius: 50px;">
                        <i class="bi bi-eye me-2"></i>Lihat Lapangan
                    </a>
                </div>

                {{-- Stats --}}
                <div class="row g-4">
                    <div class="col-4">
                        <div style="border-left: 3px solid #16a34a; padding-left: 16px;">
                            <h3 class="fw-bold mb-0" style="color: #4ade80;">15+</h3>
                            <small style="color: #94a3b8;">Lapangan</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div style="border-left: 3px solid #16a34a; padding-left: 16px;">
                            <h3 class="fw-bold mb-0" style="color: #4ade80;">5</h3>
                            <small style="color: #94a3b8;">Jenis Olahraga</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div style="border-left: 3px solid #f97316; padding-left: 16px;">
                            <h3 class="fw-bold mb-0" style="color: #fb923c;">24/7</h3>
                            <small style="color: #94a3b8;">Booking Online</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-none d-lg-block">
                <div style="position: relative;">
                    <div style="position:absolute; inset:-3px; background: linear-gradient(135deg, #16a34a, #f97316); border-radius: 24px; z-index:0;"></div>
                    <img src="{{ asset('images/hero-lapangan.jpg') }}"
                         style="width:100%; height:450px; object-fit:cover; border-radius:22px; position:relative; z-index:1;"
                         alt="Lapangan Playora">
                    {{-- Floating card --}}
                    <div style="position:absolute; bottom:24px; left:-24px; background:white; border-radius:16px; padding:16px 20px; box-shadow:0 20px 40px rgba(0,0,0,0.3); z-index:2; min-width:180px;">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:44px;height:44px;background:#dcfce7;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-calendar-check" style="color:#16a34a;font-size:1.2rem;"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold" style="color:#1e293b;font-size:0.9rem;">Booking Sukses!</p>
                                <small style="color:#64748b;">Lapangan Futsal A</small>
                            </div>
                        </div>
                    </div>
                    {{-- Floating badge --}}
                    <div style="position:absolute; top:24px; right:-16px; background:linear-gradient(135deg,#f97316,#ea580c); border-radius:16px; padding:12px 16px; box-shadow:0 10px 30px rgba(249,115,22,0.4); z-index:2;">
                        <p class="mb-0 fw-bold text-white" style="font-size:0.85rem;">⚡ Real-time</p>
                        <small class="text-white opacity-75">Cek Jadwal</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FITUR SECTION --}}
<section style="background: #f8fafc; padding: 80px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge px-3 py-2 rounded-pill mb-3" style="background:#dcfce7;color:#16a34a;">Kenapa Playora?</span>
            <h2 class="fw-bold" style="font-size:2.2rem;">Platform Terbaik untuk Booking Lapangan</h2>
            <p class="text-muted">Kami hadir untuk memudahkan aktivitas olahragamu</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center p-4 bg-white rounded-4 shadow-sm h-100" style="transition:transform 0.3s;" onmouseover="this.style.transform='translateY(-8px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle" style="width:64px;height:64px;background:linear-gradient(135deg,#dcfce7,#bbf7d0);">
                        <i class="bi bi-clock-history fs-4" style="color:#16a34a;"></i>
                    </div>
                    <h6 class="fw-bold">Real-time Jadwal</h6>
                    <p class="text-muted small mb-0">Cek ketersediaan lapangan secara langsung tanpa perlu telepon</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4 bg-white rounded-4 shadow-sm h-100" style="transition:transform 0.3s;" onmouseover="this.style.transform='translateY(-8px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle" style="width:64px;height:64px;background:linear-gradient(135deg,#fff7ed,#fed7aa);">
                        <i class="bi bi-shield-check fs-4" style="color:#f97316;"></i>
                    </div>
                    <h6 class="fw-bold">Booking Aman</h6>
                    <p class="text-muted small mb-0">Tidak ada double booking, jadwal terjamin dan tercatat rapi</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4 bg-white rounded-4 shadow-sm h-100" style="transition:transform 0.3s;" onmouseover="this.style.transform='translateY(-8px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle" style="width:64px;height:64px;background:linear-gradient(135deg,#dbeafe,#bfdbfe);">
                        <i class="bi bi-credit-card fs-4" style="color:#3b82f6;"></i>
                    </div>
                    <h6 class="fw-bold">Pembayaran Mudah</h6>
                    <p class="text-muted small mb-0">Upload bukti transfer dan konfirmasi cepat dari admin</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4 bg-white rounded-4 shadow-sm h-100" style="transition:transform 0.3s;" onmouseover="this.style.transform='translateY(-8px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle" style="width:64px;height:64px;background:linear-gradient(135deg,#fce7f3,#fbcfe8);">
                        <i class="bi bi-bell fs-4" style="color:#ec4899;"></i>
                    </div>
                    <h6 class="fw-bold">Notifikasi Otomatis</h6>
                    <p class="text-muted small mb-0">Dapat notifikasi langsung saat booking dikonfirmasi admin</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- HOW IT WORKS --}}
<section style="background: white; padding: 80px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge px-3 py-2 rounded-pill mb-3" style="background:#dcfce7;color:#16a34a;">Mudah & Cepat</span>
            <h2 class="fw-bold" style="font-size:2.2rem;">Cara Pemesanan</h2>
            <p class="text-muted">Hanya 3 langkah mudah untuk booking lapangan</p>
        </div>
        <div class="row g-4 align-items-center">
            <div class="col-md-4">
                <div class="p-4 rounded-4 h-100" style="background:linear-gradient(135deg,#f0fdf4,#dcfce7); border: 1px solid #bbf7d0;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;background:#16a34a;color:white;font-size:1.2rem;flex-shrink:0;">1</span>
                        <h5 class="fw-bold mb-0">Pilih Lapangan</h5>
                    </div>
                    <p class="text-muted mb-0">Jelajahi berbagai pilihan lapangan berkualitas — futsal, badminton, basket, dan lainnya.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 h-100" style="background:linear-gradient(135deg,#fff7ed,#ffedd5); border: 1px solid #fed7aa;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;background:#f97316;color:white;font-size:1.2rem;flex-shrink:0;">2</span>
                        <h5 class="fw-bold mb-0">Pilih Jadwal</h5>
                    </div>
                    <p class="text-muted mb-0">Tentukan tanggal, jam mulai, dan durasi bermain. Sistem cek otomatis agar tidak bentrok.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 h-100" style="background:linear-gradient(135deg,#eff6ff,#dbeafe); border: 1px solid #bfdbfe;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;background:#3b82f6;color:white;font-size:1.2rem;flex-shrink:0;">3</span>
                        <h5 class="fw-bold mb-0">Bayar & Main</h5>
                    </div>
                    <p class="text-muted mb-0">Upload bukti transfer, tunggu konfirmasi admin, dan langsung main di lapangan!</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section style="background: linear-gradient(135deg, #0f2b1a 0%, #1a4731 100%); padding: 80px 0;">
    <div class="container text-center">
        <h2 class="fw-bold text-white mb-3" style="font-size:2.2rem;">Siap Berolahraga Hari Ini?</h2>
        <p style="color:#94a3b8;" class="mb-5">Bergabung dengan ratusan pemain yang sudah booking lewat Playora</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            @guest
                <a href="{{ route('register') }}" class="btn btn-lg px-5 py-3 fw-bold" style="background:linear-gradient(135deg,#16a34a,#15803d);color:white;border:none;border-radius:50px;box-shadow:0 8px 25px rgba(22,163,74,0.4);">
                    <i class="bi bi-person-plus me-2"></i>Daftar Gratis
                </a>
                <a href="{{ route('login') }}" class="btn btn-lg px-5 py-3 fw-bold" style="background:transparent;color:white;border:2px solid rgba(255,255,255,0.3);border-radius:50px;">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </a>
            @else
                <a href="{{ route('lapangan.index') }}" class="btn btn-lg px-5 py-3 fw-bold" style="background:linear-gradient(135deg,#16a34a,#15803d);color:white;border:none;border-radius:50px;box-shadow:0 8px 25px rgba(22,163,74,0.4);">
                    <i class="bi bi-lightning-fill me-2"></i>Booking Sekarang
                </a>
            @endguest
        </div>
    </div>
</section>

@endsection