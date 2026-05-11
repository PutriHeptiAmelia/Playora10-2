@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Notifikasi</h4>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <form action="{{ route('notifikasi.readAll') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-check-all me-1"></i>Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 p-4">
        @forelse($notifikasi as $n)
            <div class="d-flex align-items-start gap-3 p-3 mb-2 rounded-3 {{ $n->read_at ? 'bg-white' : 'bg-light' }}">
                <div class="mt-1">
                    @if(str_contains($n->type, 'Booking'))
                        <i class="bi bi-calendar-check fs-5 text-success"></i>
                    @else
                        <i class="bi bi-cash-stack fs-5 text-warning"></i>
                    @endif
                </div>
                <div class="flex-grow-1">
                    <p class="mb-1 fw-semibold">{{ $n->data['message'] ?? '-' }}</p>
                    <small class="text-muted">{{ $n->created_at->diffForHumans() }}</small>
                </div>
                @if(!$n->read_at)
                    <form action="{{ route('notifikasi.read', $n->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-check me-1"></i>Baca
                        </button>
                    </form>
                @else
                    <span class="badge bg-secondary">Dibaca</span>
                @endif
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-bell-slash display-4 text-muted"></i>
                <h5 class="mt-3 text-muted">Belum ada notifikasi</h5>
            </div>
        @endforelse
    </div>
</div>
@endsection