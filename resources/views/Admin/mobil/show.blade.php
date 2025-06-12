@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Mobil</h2>

    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                @if($mobil->foto)
                    <img src="{{ Storage::url($mobil->foto) }}" class="img-fluid rounded-start">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $mobil->nama_mobil }}</h5>
                    <p class="card-text"><strong>Merk:</strong> {{ $mobil->merk }}</p>
                    <p class="card-text"><strong>Tahun:</strong> {{ $mobil->tahun }}</p>
                    <p class="card-text"><strong>Plat:</strong> {{ $mobil->plat_nomor }}</p>
                    <p class="card-text"><strong>Harga per Hari:</strong> Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ $mobil->status }}</p>
                    <p class="card-text"><strong>Deskripsi:</strong> {{ $mobil->deskripsi }}</p>
                    <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
