@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            @if(session('success'))
                <div class="alert alert-success rounded-3">{{ session('success') }}</div>
            @endif

            {{-- Edit Profil --}}
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-4">Edit Profil</h5>
                <form action="{{ route('profil.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror"
                               value="{{ old('name', Auth::user()->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control rounded-3 bg-light" value="{{ Auth::user()->email }}" disabled>
                        <small class="text-muted">Email tidak dapat diubah.</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">No. HP</label>
                        <input type="text" name="no_hp" class="form-control rounded-3 @error('no_hp') is-invalid @enderror"
                               value="{{ old('no_hp', Auth::user()->no_hp) }}">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">Simpan Perubahan</button>
                </form>
            </div>

            {{-- Ganti Password --}}
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-4">Ganti Password</h5>
                <form action="{{ route('profil.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Lama</label>
                        <div class="input-group">
                            <input type="password" name="password_lama" id="pw_lama" class="form-control rounded-start-3 @error('password_lama') is-invalid @enderror">
                            <button class="btn btn-outline-secondary rounded-end-3" type="button" onclick="togglePassword('pw_lama', 'eye1')">
                                <i class="bi bi-eye" id="eye1"></i>
                            </button>
                        </div>
                        @error('password_lama')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru</label>
                        <div class="input-group">
                            <input type="password" name="password" id="pw_baru" class="form-control rounded-start-3 @error('password') is-invalid @enderror">
                            <button class="btn btn-outline-secondary rounded-end-3" type="button" onclick="togglePassword('pw_baru', 'eye2')">
                                <i class="bi bi-eye" id="eye2"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="pw_konfirm" class="form-control rounded-start-3">
                            <button class="btn btn-outline-secondary rounded-end-3" type="button" onclick="togglePassword('pw_konfirm', 'eye3')">
                                <i class="bi bi-eye" id="eye3"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">Ganti Password</button>
                </form>
            </div>

        </div>
    </div>
</div>

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