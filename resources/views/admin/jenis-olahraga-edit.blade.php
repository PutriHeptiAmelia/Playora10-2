@extends('layouts.app')

@section('title', 'Edit Jenis Olahraga')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-4">Edit Jenis Olahraga</h4>

                <form action="{{ route('admin.jenis-olahraga.update', $jenisOlahraga->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Jenis Olahraga</label>
                        <input type="text" name="nama" class="form-control rounded-3 @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $jenisOlahraga->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control rounded-3 @error('deskripsi') is-invalid @enderror"
                                  rows="3">{{ old('deskripsi', $jenisOlahraga->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">Update</button>
                    <a href="{{ route('admin.jenis-olahraga.index') }}" class="btn btn-light w-100 py-2 mt-2 border">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection