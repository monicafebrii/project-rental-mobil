@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Rental Mobil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mobil</th>
                <th>Nama Penyewa</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Lama Hari</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rentals as $r)
            <tr>
                <td>
                    {{ $r->mobil->nama_mobil ?? 'Mobil tidak tersedia' }}
                </td>
                <td>{{ $r->user->nama ?? 'Pengguna tidak ditemukan' }}</td>
                <td>{{ $r->tanggal_mulai->format('d-m-Y') }}</td>
                <td>{{ $r->tanggal_selesai->format('d-m-Y') }}</td>
                <td>{{ $r->lama_hari }} hari</td>
                <td>Rp {{ number_format($r->total_harga, 0, ',', '.') }}</td>
                <td>
                    <span class="badge bg-{{ $r->status === 'disetujui' ? 'success' : ($r->status === 'pending' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($r->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.rental.show', $r) }}" class="btn btn-info btn-sm">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Data rental belum tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $rentals->links() }}
</div>
@endsection
