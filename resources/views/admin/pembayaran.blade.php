@extends('layouts.admin')

@section('title', 'Kelola Pembayaran')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1" style="color:#16a34a;">
                Kelola Pembayaran
            </h3>

            <p class="text-light opacity-75 mb-0">
                Verifikasi dan kelola pembayaran booking pengguna
            </p>
        </div>

        <div class="px-4 py-2 rounded-4"
             style="background:rgba(22,163,74,0.15);
             border:1px solid rgba(22,163,74,0.25);">

            <span class="fw-semibold text-success">
                Total:
            </span>

            <span class="text-white">
                {{ $pembayaran->count() }} Pembayaran
            </span>

        </div>

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

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden"
         style="background:rgba(255,255,255,0.06);
         backdrop-filter:blur(12px);
         border:1px solid rgba(255,255,255,0.05);">

        <div class="table-responsive">

            <table class="table align-middle mb-0 text-white">

                <thead style="background:rgba(22,163,74,0.15);">

                    <tr>

                        <th class="border-0 px-4 py-3">User</th>
                        <th class="border-0 px-4 py-3">Lapangan</th>
                        <th class="border-0 px-4 py-3">Tanggal</th>
                        <th class="border-0 px-4 py-3">Total</th>
                        <th class="border-0 px-4 py-3">Bukti Bayar</th>
                        <th class="border-0 px-4 py-3">Status</th>
                        <th class="border-0 px-4 py-3 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($pembayaran as $item)

                        <tr style="border-color:rgba(255,255,255,0.05);">

                            <td class="px-4 py-3 fw-semibold">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:42px;height:42px;
                                         background:rgba(22,163,74,0.2);">

                                        <i class="bi bi-person-fill text-success"></i>

                                    </div>

                                    {{ $item->booking->user->name }}

                                </div>

                            </td>

                            <td class="px-4 py-3">
                                {{ $item->booking->lapangan->nama }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->booking->tanggal }}
                            </td>

                            <td class="px-4 py-3 fw-semibold text-warning">
                                Rp {{ number_format($item->booking->total_harga, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3">

                                @if($item->bukti_bayar)

                                    <a href="{{ asset('storage/' . $item->bukti_bayar) }}"
                                       target="_blank"
                                       class="btn btn-sm rounded-3 px-3"
                                       style="background:rgba(59,130,246,0.15);
                                       color:#60a5fa;
                                       border:1px solid rgba(59,130,246,0.2);">

                                        <i class="bi bi-image me-1"></i>
                                        Lihat

                                    </a>

                                @else

                                    <span class="text-light opacity-50">
                                        Tidak Ada
                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-3">

                                @if($item->status === 'pending')

                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background:rgba(234,179,8,0.15);
                                          color:#facc15;">

                                        <i class="bi bi-clock-history me-1"></i>
                                        Pending

                                    </span>

                                @elseif($item->status === 'confirmed')

                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background:rgba(22,163,74,0.15);
                                          color:#4ade80;">

                                        <i class="bi bi-check-circle-fill me-1"></i>
                                        Confirmed

                                    </span>

                                @else

                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background:rgba(239,68,68,0.15);
                                          color:#f87171;">

                                        <i class="bi bi-x-circle-fill me-1"></i>
                                        Rejected

                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-3 text-center">

                                @if($item->status === 'pending')

                                    <div class="d-flex gap-2 justify-content-center">

                                        <form action="{{ route('admin.pembayaran.update', $item->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('PUT')

                                            <input type="hidden"
                                                   name="status"
                                                   value="confirmed">

                                            <button type="submit"
                                                    class="btn btn-success btn-sm rounded-3 px-3">

                                                <i class="bi bi-check-lg"></i>

                                            </button>

                                        </form>

                                        <form action="{{ route('admin.pembayaran.update', $item->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('PUT')

                                            <input type="hidden"
                                                   name="status"
                                                   value="rejected">

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm rounded-3 px-3">

                                                <i class="bi bi-x-lg"></i>

                                            </button>

                                        </form>

                                    </div>

                                @else

                                    <span class="text-light opacity-50">
                                        Selesai
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-5">

                                <i class="bi bi-receipt"
                                   style="font-size:3rem;color:#64748b;"></i>

                                <p class="mt-3 mb-0 text-light opacity-75">
                                    Belum ada data pembayaran
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection