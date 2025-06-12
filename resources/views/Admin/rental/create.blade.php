@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Mobil</h2>

    <form action="{{ route('admin.mobil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Mobil</label>
            <input type="text" name="nama_mobil" class="form-control @error('nama_mobil') is-invalid @enderror" value="{{ old('nama_mobil') }}">
            @error('nama_mobil') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Merk</label>
            <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror" value="{{ old('merk') }}">
            @error('merk') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun') }}">
            @error('tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Plat Nomor</label>
            <input type="text" name="plat_nomor" class="form-control @error('plat_nomor') is-invalid @enderror" value="{{ old('plat_nomor') }}">
            @error('plat_nomor') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Harga per Hari</label>
            <input type="number" name="harga_per_hari" class="form-control @error('harga_per_hari') is-invalid @enderror" value="{{ old('harga_per_hari') }}">
            @error('harga_per_hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror">
                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="disewa" {{ old('status') == 'disewa' ? 'selected' : '' }}>Disewa</option>
                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
