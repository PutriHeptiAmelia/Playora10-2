@extends('layouts.app')

@section('title', 'Booking Lapangan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-1">Form Booking</h4>
                <p class="text-muted mb-4">{{ $lapangan->nama }}</p>

                @if(session('error'))
                    <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control rounded-3 @error('tanggal') is-invalid @enderror"
                               min="{{ date('Y-m-d') }}" value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control rounded-3 @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}">
                            @error('jam_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control rounded-3 @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai') }}">
                            @error('jam_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Durasi (jam)</label>
                        <input type="number" name="durasi_jam" class="form-control rounded-3 @error('durasi_jam') is-invalid @enderror"
                               min="1" max="12" value="{{ old('durasi_jam', 1) }}">
                        @error('durasi_jam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="p-3 rounded-3 mb-4" style="background-color:#f0fdf4;">
                        <small class="text-muted">Harga per jam</small>
                        <h5 class="fw-bold mb-0" style="color:#16a34a;">
                            Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / jam
                        </h5>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-calendar-check me-2"></i>Konfirmasi Booking
                    </button>
                    <a href="{{ route('lapangan.show', $lapangan->id) }}" class="btn btn-light w-100 py-2 mt-2 border">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jamMulaiInput = document.querySelector('input[name="jam_mulai"]');
        const jamSelesaiInput = document.querySelector('input[name="jam_selesai"]');
        const durasiInput = document.querySelector('input[name="durasi_jam"]');

        function updateJamSelesai() {
            if (jamMulaiInput.value && durasiInput.value) {
                let timeParts = jamMulaiInput.value.split(':');
                let hours = parseInt(timeParts[0], 10);
                let minutes = parseInt(timeParts[1], 10);
                let duration = parseInt(durasiInput.value, 10);

                if (!isNaN(hours) && !isNaN(minutes) && !isNaN(duration)) {
                    hours += duration;
                    hours = hours % 24; // Ensure it stays within 24 hours format
                    
                    let formattedHours = hours.toString().padStart(2, '0');
                    let formattedMinutes = minutes.toString().padStart(2, '0');
                    
                    jamSelesaiInput.value = `${formattedHours}:${formattedMinutes}`;
                }
            }
        }

        // Jalankan perhitungan saat input berubah
        jamMulaiInput.addEventListener('change', function() {
            // Memaksa menit menjadi 00 agar tidak bisa per menit/detik
            if (this.value) {
                let timeParts = this.value.split(':');
                let hour = timeParts[0];
                this.value = `${hour}:00`;
            }
            updateJamSelesai();
        });
        
        durasiInput.addEventListener('input', updateJamSelesai);
        
        // Event listener untuk jam selesai jika pengguna mengubahnya secara manual
        jamSelesaiInput.addEventListener('change', function() {
            // Memaksa menit menjadi 00 agar tidak bisa per menit/detik
            if (this.value) {
                let timeParts = this.value.split(':');
                let hour = timeParts[0];
                this.value = `${hour}:00`;
            }
            
            // Hitung ulang durasi berdasarkan selisih jam mulai dan jam selesai
            if (jamMulaiInput.value && this.value) {
                let startHour = parseInt(jamMulaiInput.value.split(':')[0], 10);
                let endHour = parseInt(this.value.split(':')[0], 10);
                
                let diff = endHour - startHour;
                // Jika jam selesai lebih kecil dari jam mulai, asumsikan melewati tengah malam
                if (diff < 0) {
                    diff += 24;
                }
                
                // Pastikan durasi minimal 1 jam dan tidak NaN
                if (!isNaN(diff) && diff > 0) {
                    durasiInput.value = diff;
                }
            }
        });
    });
</script>
@endsection