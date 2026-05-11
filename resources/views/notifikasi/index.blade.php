@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Notifikasi</h4>
                @if($notifikasi->count() > 0)
                    <form action="{{ route('notifikasi.readAll') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-check-all me-1"></i>Tandai Semua Dibaca
                        </button>
                    </form>
                @endif
            </div>

            @forelse($notifikasi as $notif)
                <div class="card border-0 shadow-sm rounded-4 mb-3 p-4 {{ $notif->read_at ? '' : 'border-start border-4 border-success' }}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex gap-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                  style="width:45px;height:45px;background-color:#dcfce7;">
                                <i class="bi bi-bell fs-5" style="color:#16a34a;"></i>
                            </span>
                            <div>
                                <p class="fw-semibold mb-1">{{ $notif->data['message'] }}</p>
                                @if(isset($notif->data['lapangan']))
                                    <p class="text-muted small mb-1">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $notif->data['lapangan'] }}
                                    </p>
                                @endif
                                @if(isset($notif->data['tanggal']))
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-calendar me-1"></i>{{ $notif->data['tanggal'] }}
                                        @if(isset($notif->data['jam_mulai']))
                                            &nbsp;|&nbsp;<i class="bi bi-clock me-1"></i>{{ $notif->data['jam_mulai'] }} - {{ $notif->data['jam_selesai'] }}
                                        @endif
                                    </p>
                                @endif
                                <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @if(!$notif->read_at)
                            <form action="{{ route('notifikasi.read', $notif->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm" style="color:#16a34a;">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                    <i class="bi bi-bell-slash display-4 text-muted"></i>
                    <h5 class="mt-3">Belum Ada Notifikasi</h5>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection