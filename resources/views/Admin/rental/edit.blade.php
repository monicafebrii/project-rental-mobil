@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Mobil</h2>

    <form action="{{ route('admin.mobil.update', $mobil) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Mobil</label>
            <input type="text" name="nama_mobil" class="form-control @error('nama_mobil') is-invalid @enderror" value="{{ old('nama_mobil', $mobil->nama_mobil) }}">
            @error('nama_mobil') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Merk</label>
            <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror" value="{{ old('merk', $mobil->merk) }}">
            @error('merk') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun', $mobil->tahun) }}">
            @error('tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Plat Nomor</label>
            <input type="text" name="plat_nomor" class="form-control @error('plat_nomor') is-invalid @enderror" value="{{ old('plat_nomor', $mobil->plat_nomor) }}">
            @error('plat_nomor') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Harga per Hari</label>
            <input type="number" name="harga_per_hari" class="form-control @error('harga_per_hari') is-invalid @enderror" value="{{ old('harga_per_hari', $mobil->harga_per_hari) }}">
            @error('harga_per_hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror">
                 <option value="tersedia" {{ old('status', $mobil->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="tersedia" {{ old('status', $mobil->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="disewa" {{ old('status', $mobil->status) == 'disewa' ? 'selected' : '' }}>Disewa</option>
                <option value="maintenance" {{ old('status', $mobil->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $mobil->deskripsi) }}</textarea>
            @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Foto Baru</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror

            @if($mobil->foto)
                <img src="{{ Storage::url($mobil->foto) }}" width="120" class="mt-2">
            @endif
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
