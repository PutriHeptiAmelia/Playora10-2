@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')

{{-- HEADER --}}
<section style="background: linear-gradient(135deg, #0f2b1a 0%, #1a4731 100%); padding: 50px 0 70px;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <span class="badge px-3 py-2 rounded-pill mb-3 d-inline-block" style="background:rgba(22,163,74,0.2);color:#4ade80;border:1px solid rgba(22,163,74,0.3);">
                    <i class="bi bi-bell me-1"></i>Notifikasi
                </span>
                <h2 class="fw-bold text-white mb-1">Notifikasi Kamu</h2>

            </div>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <form action="{{ route('notifikasi.readAll') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn fw-semibold px-4 py-2"
                            style="background:rgba(22,163,74,0.2);color:#4ade80;border:1px solid rgba(22,163,74,0.3);border-radius:12px;">
                        <i class="bi bi-check-all me-1"></i>Tandai Semua Dibaca
                    </button>
                </form>
            @endif
        </div>
    </div>
</section>

<section style="background:#f8fafc; padding: 40px 0; margin-top:-30px;">
    <div class="container">

        @if(session('success'))
            <div class="alert border-0 rounded-4 mb-4 px-4 py-3" style="background:#dcfce7;color:#15803d;">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="card border-0 rounded-4 overflow-hidden" style="box-shadow:0 4px 24px rgba(0,0,0,0.07);">
            @forelse($notifikasi as $n)
                <div class="d-flex align-items-start gap-4 p-4"
                     style="border-bottom:1px solid #f1f5f9; background: {{ !$n->read_at ? '#f0fdf4' : 'white' }};">

                    {{-- Icon --}}
                    <div style="width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;
                         background: {{ str_contains($n->type, 'Booking') ? '#dcfce7' : '#fef3c7' }};">
                        @if(str_contains($n->type, 'Booking'))
                            <i class="bi bi-calendar-check" style="color:#16a34a;font-size:1.1rem;"></i>
                        @else
                            <i class="bi bi-cash-stack" style="color:#d97706;font-size:1.1rem;"></i>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-semibold" style="font-size:0.95rem;">
                            {{ $n->data['message'] ?? '-' }}
                        </p>
                        <div class="d-flex align-items-center gap-2">
                            <small style="color:#94a3b8;">
                                <i class="bi bi-clock me-1"></i>{{ $n->created_at->diffForHumans() }}
                            </small>
                            @if(!$n->read_at)
                                <span class="badge rounded-pill px-2" style="background:#dcfce7;color:#15803d;font-size:0.7rem;">Baru</span>
                            @endif
                        </div>
                    </div>

                    {{-- Action --}}
                    @if(!$n->read_at)
                        <form action="{{ route('notifikasi.read', $n->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm fw-semibold px-3"
                                    style="background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0;border-radius:8px;font-size:0.8rem;white-space:nowrap;">
                                <i class="bi bi-check me-1"></i>Tandai Dibaca
                            </button>
                        </form>
                    @else
                        <span class="badge rounded-pill px-3 py-2"
                              style="background:#f1f5f9;color:#94a3b8;font-size:0.75rem;white-space:nowrap;">
                            <i class="bi bi-check2 me-1"></i>Dibaca
                        </span>
                    @endif
                </div>
            @empty
                <div class="text-center py-5">
                    <div style="width:72px;height:72px;background:#f0fdf4;border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                        <i class="bi bi-bell-slash" style="color:#16a34a;font-size:1.8rem;"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Belum Ada Notifikasi</h5>
                    <p class="text-muted mb-0">Notifikasi akan muncul saat ada update booking atau pembayaran</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

@endsection