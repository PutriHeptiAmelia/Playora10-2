@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Buat Akun Baru</h3>
                    <p class="text-muted">Daftar sekarang dan mulai booking lapangan</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
                @endif

                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. HP</label>
                        <input type="text" name="no_hp" class="form-control rounded-3 @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control rounded-start-3 @error('password') is-invalid @enderror">
                            <button class="btn btn-outline-secondary rounded-end-3" type="button" onclick="togglePassword('password', 'eyeIcon1')">
                                <i class="bi bi-eye" id="eyeIcon1"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-start-3">
                            <button class="btn btn-outline-secondary rounded-end-3" type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                                <i class="bi bi-eye" id="eyeIcon2"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">Daftar Sekarang</button>
                </form>

                <hr class="my-4">
                <p class="text-center text-muted mb-0">Sudah punya akun?
                    <a href="{{ route('login') }}" style="color:#16a34a; font-weight:600;">Login di sini</a>
                </p>
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