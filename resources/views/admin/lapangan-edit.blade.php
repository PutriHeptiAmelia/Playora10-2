@extends('layouts.app')

@section('title', 'Edit Lapangan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-4">Edit Lapangan</h4>

                @if(session('error'))
                    <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
                @endif

                <form action="{{ route('admin.lapangan.update', $lapangan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Olahraga</label>
                        <select name="jenis_olahraga_id" class="form-select rounded-3 @error('jenis_olahraga_id') is-invalid @enderror">
                            <option value="">Pilih Jenis Olahraga</option>
                            @foreach($jenisOlahraga as $j)
                                <option value="{{ $j->id }}" {{ $lapangan->jenis_olahraga_id == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_olahraga_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lapangan</label>
                        <input type="text" name="nama" class="form-control rounded-3 @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $lapangan->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga per Jam (Rp)</label>
                        <input type="number" name="harga_per_jam" class="form-control rounded-3 @error('harga_per_jam') is-invalid @enderror"
                               value="{{ old('harga_per_jam', $lapangan->harga_per_jam) }}">
                        @error('harga_per_jam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Fasilitas</label>
                        <textarea name="fasilitas" class="form-control rounded-3 @error('fasilitas') is-invalid @enderror"
                                  rows="3">{{ old('fasilitas', $lapangan->fasilitas) }}</textarea>
                        @error('fasilitas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select rounded-3">
                            <option value="active" {{ $lapangan->status == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ $lapangan->status == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Ganti Gambar Lapangan</label>
                        <div class="mb-3">
                            @php
                                $imageName = lcfirst(str_replace(' ', '', $lapangan->nama)) . '.jpg.jpeg';
                                $imagePath = public_path('images/' . $imageName);
                                $imageUrl = file_exists($imagePath) ? asset('images/' . $imageName) : asset('images/hero-lapangan.jpg');
                            @endphp
                            <div style="position:relative; max-width:200px; margin-bottom:15px;">
                                <img src="{{ $imageUrl }}" alt="{{ $lapangan->nama }}"
                                     style="width:100%; height:150px; object-fit:cover; border-radius:8px; border:2px solid #e5e7eb;">
                                <small class="text-muted d-block mt-2">Gambar saat ini</small>
                            </div>
                        </div>
                        <input type="file" name="gambar" class="form-control rounded-3 @error('gambar') is-invalid @enderror"
                               accept="image/*">
                        <small class="text-muted d-block mt-2">Format: JPG, PNG (Max 2MB). Biarkan kosong jika tidak ingin mengganti.</small>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">Update</button>
                    <a href="{{ route('admin.lapangan.index') }}" class="btn btn-light w-100 py-2 mt-2 border">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection