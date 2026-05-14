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

                {{-- Availability Alert --}}
                <div id="availabilityAlert" class="alert d-none rounded-3 mb-3" role="alert">
                    <small id="availabilityMessage"></small>
                </div>

                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggalInput" class="form-control rounded-3 @error('tanggal') is-invalid @enderror"
                               min="{{ date('Y-m-d') }}" value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Booked Times Display --}}
                    <div id="bookedTimesContainer" class="mb-3 d-none">
                        <div class="p-3 rounded-3" style="background:rgba(220,38,38,0.1); border:1px solid rgba(220,38,38,0.25);">
                            <small class="text-muted d-block mb-2">Jam yang sudah dipesan pada tanggal ini:</small>
                            <div id="bookedTimesList" class="d-flex flex-wrap gap-2">
                                <!-- Booked times akan ditampilkan di sini -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jamMulaiInput" class="form-control rounded-3 @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}">
                            @error('jam_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jamSelesaiInput" class="form-control rounded-3 @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai') }}">
                            @error('jam_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Durasi (jam)</label>
                        <input type="number" name="durasi_jam" id="durasiInput" class="form-control rounded-3 @error('durasi_jam') is-invalid @enderror"
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

                    <button type="submit" class="btn btn-primary w-100 py-2" id="submitBtn">
                        <i class="bi bi-calendar-check me-2"></i>Konfirmasi Booking
                    </button>
                    <a href="{{ route('lapangan.show', $lapangan->id) }}" class="btn btn-light w-100 py-2 mt-2 border">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalInput = document.getElementById('tanggalInput');
        const jamMulaiInput = document.getElementById('jamMulaiInput');
        const jamSelesaiInput = document.getElementById('jamSelesaiInput');
        const durasiInput = document.getElementById('durasiInput');
        const availabilityAlert = document.getElementById('availabilityAlert');
        const availabilityMessage = document.getElementById('availabilityMessage');
        const bookedTimesContainer = document.getElementById('bookedTimesContainer');
        const bookedTimesList = document.getElementById('bookedTimesList');
        const submitBtn = document.getElementById('submitBtn');
        const lapanganId = {{ $lapangan->id }};
        let bookedTimes = [];

        // Fetch booked times when date changes
        tanggalInput.addEventListener('change', async function() {
            if (!this.value) {
                bookedTimesContainer.classList.add('d-none');
                availabilityAlert.classList.add('d-none');
                return;
            }

            try {
                const response = await fetch('/api/booking/check-availability', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        lapangan_id: lapanganId,
                        tanggal: this.value
                    })
                });

                const data = await response.json();
                bookedTimes = data.bookings || [];

                if (bookedTimes.length > 0) {
                    bookedTimesContainer.classList.remove('d-none');
                    bookedTimesList.innerHTML = bookedTimes.map(b => 
                        `<span class="badge px-2 py-1" style="background:rgba(220,38,38,0.8);color:white;">
                            ${b.jam_mulai} - ${b.jam_selesai}
                        </span>`
                    ).join('');
                } else {
                    bookedTimesContainer.classList.add('d-none');
                }
            } catch (error) {
                console.error('Error checking availability:', error);
            }
        });

        // Check for conflicts when time inputs change
        function checkTimeConflict() {
            if (!jamMulaiInput.value || !jamSelesaiInput.value || !tanggalInput.value) {
                availabilityAlert.classList.add('d-none');
                submitBtn.disabled = false;
                return;
            }

            const startTime = jamMulaiInput.value;
            const endTime = jamSelesaiInput.value;

            const hasConflict = bookedTimes.some(booking => {
                return !(endTime <= booking.jam_mulai || startTime >= booking.jam_selesai);
            });

            if (hasConflict) {
                availabilityAlert.classList.remove('d-none');
                availabilityAlert.classList.remove('alert-success');
                availabilityAlert.classList.add('alert-warning');
                availabilityMessage.textContent = '⚠️ Jam yang Anda pilih bentrok dengan booking lain. Silakan pilih jam lain.';
                submitBtn.disabled = true;
            } else {
                availabilityAlert.classList.remove('d-none');
                availabilityAlert.classList.remove('alert-warning');
                availabilityAlert.classList.add('alert-success');
                availabilityMessage.textContent = '✓ Jam ini tersedia dan dapat dipesan.';
                submitBtn.disabled = false;
            }
        }

        jamMulaiInput.addEventListener('change', checkTimeConflict);
        jamSelesaiInput.addEventListener('change', checkTimeConflict);

        function updateJamSelesai() {
            if (jamMulaiInput.value && durasiInput.value) {
                let timeParts = jamMulaiInput.value.split(':');
                let hours = parseInt(timeParts[0], 10);
                let minutes = parseInt(timeParts[1], 10);
                let duration = parseInt(durasiInput.value, 10);

                if (!isNaN(hours) && !isNaN(minutes) && !isNaN(duration)) {
                    hours += duration;
                    hours = hours % 24;
                    
                    let formattedHours = hours.toString().padStart(2, '0');
                    let formattedMinutes = minutes.toString().padStart(2, '0');
                    
                    jamSelesaiInput.value = `${formattedHours}:${formattedMinutes}`;
                    checkTimeConflict();
                }
            }
        }

        jamMulaiInput.addEventListener('change', function() {
            if (this.value) {
                let timeParts = this.value.split(':');
                let hour = timeParts[0];
                this.value = `${hour}:00`;
            }
            updateJamSelesai();
        });
        
        durasiInput.addEventListener('input', updateJamSelesai);
        
        jamSelesaiInput.addEventListener('change', function() {
            if (this.value) {
                let timeParts = this.value.split(':');
                let hour = timeParts[0];
                this.value = `${hour}:00`;
            }
            
            if (jamMulaiInput.value && this.value) {
                let startHour = parseInt(jamMulaiInput.value.split(':')[0], 10);
                let endHour = parseInt(this.value.split(':')[0], 10);
                
                let diff = endHour - startHour;
                if (diff < 0) {
                    diff += 24;
                }
                
                if (!isNaN(diff) && diff > 0) {
                    durasiInput.value = diff;
                }
            }

            checkTimeConflict();
        });
    });
</script>
@endsection