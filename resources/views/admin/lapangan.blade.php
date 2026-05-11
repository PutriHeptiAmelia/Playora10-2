@extends('layouts.admin')

@section('title', 'Kelola Lapangan')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1"
                style="color:#16a34a;">
                Kelola Lapangan
            </h3>

            <p class="text-light opacity-75 mb-0">
                Atur data lapangan olahraga Playora
            </p>

        </div>

        <a href="{{ route('admin.lapangan.create') }}"
           class="btn rounded-4 px-4 py-2 fw-semibold"
           style="background:linear-gradient(135deg,#16a34a,#15803d);
           border:none;
           color:white;
           box-shadow:0 8px 20px rgba(22,163,74,0.25);">

            <i class="bi bi-plus-circle me-2"></i>
            Tambah Lapangan

        </a>

    </div>

    @if(session('success'))

        <div class="alert border-0 rounded-4 mb-4"
             style="background:rgba(22,163,74,0.15);
             color:#4ade80;
             border:1px solid rgba(22,163,74,0.25) !important;">

            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

        </div>

    @endif

    <div class="row g-4">

        @forelse($lapangan as $item)

            <div class="col-lg-4 col-md-6">

                <div class="card border-0 rounded-4 overflow-hidden h-100 shadow-lg"
                     style="background:rgba(255,255,255,0.06);
                     backdrop-filter:blur(12px);
                     border:1px solid rgba(255,255,255,0.05) !important;">

                    <div style="height:220px; overflow:hidden;">

                        @if($item->foto)

                            <img src="{{ asset('storage/' . $item->foto) }}"
                                 class="w-100 h-100"
                                 style="object-fit:cover;">

                        @else

                            <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                 style="background:rgba(255,255,255,0.04);">

                                <i class="bi bi-image text-light opacity-50"
                                   style="font-size:4rem;"></i>

                            </div>

                        @endif

                    </div>

                    <div class="card-body p-4 text-white">

                        <div class="d-flex justify-content-between align-items-start mb-3">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    {{ $item->nama }}
                                </h5>

                                <small class="text-light opacity-75">
                                    {{ $item->jenisOlahraga->nama ?? '-' }}
                                </small>

                            </div>

                            <span class="badge rounded-pill px-3 py-2"
                                  style="background:rgba(22,163,74,0.15);
                                  color:#4ade80;">

                                Aktif

                            </span>

                        </div>

                        <div class="mb-3">

                            <div class="d-flex align-items-center gap-2 mb-2">

                                <i class="bi bi-geo-alt-fill text-success"></i>

                                <small class="text-light opacity-75">
                                    {{ $item->lokasi }}
                                </small>

                            </div>

                            <div class="d-flex align-items-center gap-2">

                                <i class="bi bi-cash-stack text-warning"></i>

                                <small class="fw-semibold text-warning">
                                    Rp {{ number_format($item->harga_per_jam,0,',','.') }}/jam
                                </small>

                            </div>

                        </div>

                        <div class="d-flex gap-2 mt-4">

                            <a href="{{ route('admin.lapangan.edit', $item->id) }}"
                               class="btn flex-fill rounded-3"
                               style="background:rgba(59,130,246,0.15);
                               color:#60a5fa;
                               border:1px solid rgba(59,130,246,0.2);">

                                <i class="bi bi-pencil-square me-1"></i>
                                Edit

                            </a>

                            <form action="{{ route('admin.lapangan.destroy', $item->id) }}"
                                  method="POST"
                                  class="flex-fill">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus lapangan ini?')"
                                        class="btn w-100 rounded-3"
                                        style="background:rgba(239,68,68,0.15);
                                        color:#f87171;
                                        border:1px solid rgba(239,68,68,0.2);">

                                    <i class="bi bi-trash me-1"></i>
                                    Hapus

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="card border-0 rounded-4 p-5 text-center"
                     style="background:rgba(255,255,255,0.05);
                     border:1px solid rgba(255,255,255,0.05) !important;">

                    <i class="bi bi-grid text-light opacity-50"
                       style="font-size:4rem;"></i>

                    <h5 class="fw-bold mt-4 text-white">
                        Belum Ada Lapangan
                    </h5>

                    <p class="text-light opacity-75 mb-4">
                        Tambahkan lapangan baru untuk mulai menerima booking.
                    </p>

                    <div>

                        <a href="{{ route('admin.lapangan.create') }}"
                           class="btn rounded-4 px-4 py-2 fw-semibold"
                           style="background:linear-gradient(135deg,#16a34a,#15803d);
                           border:none;
                           color:white;">

                            <i class="bi bi-plus-circle me-2"></i>
                            Tambah Lapangan

                        </a>

                    </div>

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection