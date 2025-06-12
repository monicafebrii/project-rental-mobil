@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Mobil</h2>
    <a href="{{ route('admin.mobil.create') }}" class="btn btn-primary mb-3">+ Tambah Mobil</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Merk</th>
                <th>Tahun</th>
                <th>Plat</th>
                <th>Harga/Hari</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mobil as $m)
            <tr>
                <td>
                    @if($m->foto)
                        <img src="{{ Storage::url($m->foto) }}" width="100">
                    @endif
                </td>
                <td>{{ $m->nama_mobil }}</td>
                <td>{{ $m->merk }}</td>
                <td>{{ $m->tahun }}</td>
                <td>{{ $m->plat_nomor }}</td>
                <td>Rp {{ number_format($m->harga_per_hari, 0, ',', '.') }}</td>
                <td>{{ $m->status }}</td>
                <td>
                    <a href="{{ route('admin.mobil.show', $m) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('admin.mobil.edit', $m) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.mobil.destroy', $m) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $mobil->links() }}
</div>
@endsection
