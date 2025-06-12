@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Rental</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <strong>Informasi Mobil</strong>
        </div>
        <div class="card-body">
            <p><strong>Nama Mobil:</strong> {{ $rental->mobil->nama_mobil }}</p>
            <p><strong>Merk:</strong> {{ $rental->mobil->merk }}</p>
            <p><strong>Plat Nomor:</strong> {{ $rental->mobil->plat_nomor }}</p>
            <p><strong>Tahun:</strong> {{ $rental->mobil->tahun }}</p>
            <p><strong>Harga per Hari:</strong> Rp {{ number_format($rental->mobil->harga_per_hari, 0, ',', '.') }}</p>
            @if($rental->mobil->foto)
                <img src="{{ Storage::url($rental->mobil->foto) }}" width="200" alt="Foto Mobil">
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <strong>Informasi Penyewa</strong>
        </div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $rental->user->nama }}</p>
            <p><strong>Email:</strong> {{ $rental->user->email }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <strong>Detail Rental</strong>
        </div>
        <div class="card-body">
            <p><strong>Tanggal Mulai:</strong> {{ $rental->tanggal_mulai->format('d-m-Y') }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ $rental->tanggal_selesai->format('d-m-Y') }}</p>
            <p><strong>Lama Hari:</strong> {{ $rental->lama_hari }} hari</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-{{ $rental->status === 'disetujui' ? 'success' : ($rental->status === 'pending' ? 'warning' : 'secondary') }}">
                    {{ ucfirst($rental->status) }}
                </span>
            </p>
            <p><strong>Catatan:</strong> {{ $rental->catatan ?? '-' }}</p>
        </div>
    </div>

    @if($rental->pembayaran)
    <div class="card mb-4">
        <div class="card-header">
            <strong>Informasi Pembayaran</strong>
        </div>
        <div class="card-body">
            <p><strong>Metode Pembayaran:</strong> {{ $rental->pembayaran->metode }}</p>
            <p><strong>Total Bayar:</strong> Rp {{ number_format($rental->pembayaran->jumlah, 0, ',', '.') }}</p>
            <p><strong>Status Pembayaran:</strong> {{ ucfirst($rental->pembayaran->status) }}</p>
            @if($rental->pembayaran->bukti)
                <p><strong>Bukti Pembayaran:</strong></p>
                <img src="{{ Storage::url($rental->pembayaran->bukti) }}" width="200" alt="Bukti Pembayaran">
            @endif
        </div>
    </div>
    @endif

    <div class="mb-4">
        <form action="{{ route('admin.rental.updateStatus', $rental) }}" method="POST" class="form-inline">
            @csrf
            <div class="form-group">
                <label for="status" class="me-2">Update Status:</label>
                <select name="status" id="status" class="form-select me-2" required>
                    <option value="pending" {{ $rental->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="disetujui" {{ $rental->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="selesai" {{ $rental->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ $rental->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <a href="{{ route('admin.rental.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
