@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    
    body {
        font-family: 'Poppins', sans-serif;
    }

    .card-custom {
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        padding: 30px; /* Reduced padding */
        background-color: #fefefe;
        max-height: 600px; /* Set a max height */
        overflow-y: auto; /* Allow scrolling if content exceeds height */
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 10px 14px; /* Reduced padding */
        border: 1px solid #ced4da;
        transition: 0.3s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.1rem rgba(0, 123, 255, 0.25);
    }

    .btn-primary-custom {
        background: linear-gradient(to right, #4facfe, #00f2fe);
        border: none;
        color: #fff;
        padding: 10px 28px;
        border-radius: 12px;
        font-weight: 600;
        transition: 0.3s ease-in-out;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(to right, #00f2fe, #4facfe);
    }

    .btn-secondary-custom {
        border-radius: 12px;
        padding: 10px 24px;
        font-weight: 500;
    }

    .img-preview {
        border-radius: 10px;
        margin-top: 10px;
        max-width: 150px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 20px; /* Reduced margin */
        text-align: center;
        color: #343a40;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-custom {
            padding: 20px; /* Adjust padding for smaller screens */
        }

        h2 {
            font-size: 24px; /* Adjust heading size for smaller screens */
        }
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-custom">

                <h2>Edit Data Mobil</h2>

                <form action="{{ route('admin.mobil.update', $mobil) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Mobil</label>
                        <input type="text" name="nama_mobil" class="form-control @error('nama_mobil') is-invalid @enderror" value="{{ old('nama_mobil', $mobil->nama_mobil) }}">
                        @error('nama_mobil') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Merk</label>
                        <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror" value="{{ old('merk', $mobil->merk) }}">
                        @error('merk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun', $mobil->tahun) }}">
                        @error('tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Plat Nomor</label>
                        <input type="text" name="plat_nomor" class="form-control @error('plat_nomor') is-invalid @enderror" value="{{ old('plat_nomor', $mobil->plat_nomor) }}">
                        @error('plat_nomor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga per Hari</label>
                        <input type="number" name="harga_per_hari" class="form-control @error('harga_per_hari') is-invalid @enderror" value="{{ old('harga_per_hari', $mobil->harga_per_hari) }}">
                        @error('harga_per_hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="tersedia" {{ old('status', $mobil->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="disewa" {{ old('status', $mobil->status) == 'disewa' ? 'selected' : '' }}>Disewa</option>
                            <option value="maintenance" {{ old('status', $mobil->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi', $mobil->deskripsi) }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Baru</label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                        @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        @if($mobil->foto)
                            <img src="{{ Storage::url($mobil->foto) }}" class="img-preview">
                        @endif
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.mobil.index') }}" class="btn btn-outline-secondary btn-secondary-custom">
                            Batal
                        </a>
                        <button class="btn btn-primary-custom">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
