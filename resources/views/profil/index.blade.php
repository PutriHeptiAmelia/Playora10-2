@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

{{-- HEADER --}}
<section style="background: linear-gradient(135deg, #0f2b1a 0%, #1a4731 100%); padding: 50px 0 70px;">
    <div class="container">
        <div class="d-flex align-items-center gap-4">
            <div style="width:72px;height:72px;background:rgba(22,163,74,0.2);border-radius:20px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(22,163,74,0.3);">
                <i class="bi bi-person-fill" style="color:#4ade80;font-size:2rem;"></i>
            </div>
            <div>
                <h2 class="fw-bold text-white mb-1">{{ Auth::user()->name }}</h2>
                <p style="color:#94a3b8;" class="mb-0">
                    <i class="bi bi-envelope me-1"></i>{{ Auth::user()->email }}
                </p>
            </div>
        </div>
    </div>
</section>

<section style="background:#f8fafc; padding: 40px 0; margin-top:-30px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(session('success'))
                    <div class="alert border-0 rounded-4 mb-4 px-4 py-3" style="background:#dcfce7;color:#15803d;">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                {{-- Edit Profil --}}
                <div class="card border-0 rounded-4 mb-4 overflow-hidden" style="box-shadow:0 4px 24px rgba(0,0,0,0.07);">
                    <div class="px-4 py-3 d-flex align-items-center gap-3" style="background:linear-gradient(135deg,#0f2b1a,#1a4731);">
                        <div style="width:36px;height:36px;background:rgba(22,163,74,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-person" style="color:#4ade80;"></i>
                        </div>
                        <h6 class="fw-bold text-white mb-0">Edit Profil</h6>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('profil.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Nama Lengkap</label>
                                <input type="text" name="name"
                                       class="form-control rounded-3 @error('name') is-invalid @enderror"
                                       style="border-color:#e2e8f0;padding:10px 14px;"
                                       value="{{ old('name', Auth::user()->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Email</label>
                                <input type="email"
                                       class="form-control rounded-3"
                                       style="border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;"
                                       value="{{ Auth::user()->email }}" disabled>
                                <small class="text-muted">Email tidak dapat diubah.</small>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold small">No. HP</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-3" style="background:#f0fdf4;border-color:#e2e8f0;color:#16a34a;">
                                        <i class="bi bi-telephone"></i>
                                    </span>
                                    <input type="text" name="no_hp"
                                           class="form-control rounded-end-3 @error('no_hp') is-invalid @enderror"
                                           style="border-color:#e2e8f0;padding:10px 14px;"
                                           value="{{ old('no_hp', Auth::user()->no_hp) }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn w-100 py-2 fw-semibold"
                                    style="background:linear-gradient(135deg,#16a34a,#15803d);color:white;border:none;border-radius:12px;">
                                <i class="bi bi-check2 me-1"></i>Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Ganti Password --}}
                <div class="card border-0 rounded-4 overflow-hidden" style="box-shadow:0 4px 24px rgba(0,0,0,0.07);">
                    <div class="px-4 py-3 d-flex align-items-center gap-3" style="background:linear-gradient(135deg,#0f2b1a,#1a4731);">
                        <div style="width:36px;height:36px;background:rgba(22,163,74,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-shield-lock" style="color:#4ade80;"></i>
                        </div>
                        <h6 class="fw-bold text-white mb-0">Ganti Password</h6>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('profil.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Password Lama</label>
                                <div class="input-group">
                                    <input type="password" name="password_lama" id="pw_lama"
                                           class="form-control rounded-start-3 @error('password_lama') is-invalid @enderror"
                                           style="border-color:#e2e8f0;padding:10px 14px;">
                                    <button class="btn rounded-end-3" type="button"
                                            onclick="togglePassword('pw_lama', 'eye1')"
                                            style="border-color:#e2e8f0;background:#f8fafc;">
                                        <i class="bi bi-eye" id="eye1" style="color:#64748b;"></i>
                                    </button>
                                </div>
                                @error('password_lama')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="pw_baru"
                                           class="form-control rounded-start-3 @error('password') is-invalid @enderror"
                                           style="border-color:#e2e8f0;padding:10px 14px;">
                                    <button class="btn rounded-end-3" type="button"
                                            onclick="togglePassword('pw_baru', 'eye2')"
                                            style="border-color:#e2e8f0;background:#f8fafc;">
                                        <i class="bi bi-eye" id="eye2" style="color:#64748b;"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold small">Konfirmasi Password Baru</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" id="pw_konfirm"
                                           class="form-control rounded-start-3"
                                           style="border-color:#e2e8f0;padding:10px 14px;">
                                    <button class="btn rounded-end-3" type="button"
                                            onclick="togglePassword('pw_konfirm', 'eye3')"
                                            style="border-color:#e2e8f0;background:#f8fafc;">
                                        <i class="bi bi-eye" id="eye3" style="color:#64748b;"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn w-100 py-2 fw-semibold"
                                    style="background:linear-gradient(135deg,#16a34a,#15803d);color:white;border:none;border-radius:12px;">
                                <i class="bi bi-shield-check me-1"></i>Ganti Password
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}
</script>

@endsection