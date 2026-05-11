@extends('layouts.admin')

@section('title', 'Kelola Users')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1"
                style="color:#16a34a;">
                Kelola Users
            </h3>

            <p class="text-light opacity-75 mb-0">
                Daftar seluruh pengguna Playora
            </p>

        </div>

        <div class="px-4 py-2 rounded-4"
             style="background:rgba(22,163,74,0.15);
             border:1px solid rgba(22,163,74,0.25);">

            <span class="fw-semibold text-success">
                Total:
            </span>

            <span class="text-white">
                {{ $users->count() }} Users
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

                        <th class="border-0 px-4 py-3">#</th>
                        <th class="border-0 px-4 py-3">User</th>
                        <th class="border-0 px-4 py-3">Email</th>
                        <th class="border-0 px-4 py-3">No HP</th>
                        <th class="border-0 px-4 py-3">Bergabung</th>
                        <th class="border-0 px-4 py-3 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $i => $user)

                        <tr style="border-color:rgba(255,255,255,0.05);">

                            <td class="px-4 py-3 fw-semibold">
                                {{ $i + 1 }}
                            </td>

                            <td class="px-4 py-3">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                         style="width:45px;height:45px;
                                         background:rgba(22,163,74,0.15);">

                                        <i class="bi bi-person-fill text-success"></i>

                                    </div>

                                    <div class="d-flex flex-column justify-content-center"
                                         style="height:45px;">

                                        <div class="fw-semibold lh-sm">
                                            {{ $user->name }}
                                        </div>

                                        <small style="color:#94a3b8;">
                                                User Playora
                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td class="px-4 py-3">
                                {{ $user->email }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $user->no_hp ?? '-' }}
                            </td>

                            <td class="px-4 py-3">

                                <span class="badge rounded-pill px-3 py-2"
                                      style="background:rgba(59,130,246,0.15);
                                      color:#60a5fa;">

                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}

                                </span>

                            </td>

                            <td class="px-4 py-3 text-center">

                                <form action="{{ route('admin.users.delete', $user->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus user ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm rounded-3 px-3"
                                            style="background:rgba(239,68,68,0.15);
                                            color:#f87171;
                                            border:1px solid rgba(239,68,68,0.2);">

                                        <i class="bi bi-trash me-1"></i>
                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-5">

                                <i class="bi bi-people"
                                   style="font-size:3rem;color:#64748b;"></i>

                                <p class="mt-3 mb-0 text-light opacity-75">
                                    Belum ada user terdaftar
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