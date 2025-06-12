@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Riwayat Rental Saya</h2>

    @if($rentals->isEmpty())
        <p>Anda belum pernah melakukan rental.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mobil</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rentals as $rental)
                    <tr>
                        <td>{{ $rental->mobil->nama_mobil }}</td>
                        <td>{{ $rental->tanggal_mulai->format('d-m-Y') }}</td>
                        <td>{{ $rental->tanggal_selesai->format('d-m-Y') }}</td>
                        <td>{{ ucfirst($rental->status) }}</td>
                        <td>Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $rentals->links() }}
    @endif
</div>
@endsection
