@extends('layouts.app')
                            <!-- ini dashboard pelanggan  -->
@section('content')
<div class="container py-4">
    <!-- Header Welcome -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg-gradient-primary text-white rounded-4 p-4 shadow-sm">
                <h2 class="mb-2"><i class="bi bi-speedometer2"></i> Dashboard Pelanggan</h2>
                <p class="mb-0 fs-5">Selamat datang kembali, <strong>{{ Auth::user()->nama }}</strong>! 👋</p>
            </div>
        </div>
    </div>

    <!-- Action Cardss -->
    <div class="row mb-5 g-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center p-4">
                    <div class="text-primary mb-3">
                        <i class="bi bi-car-front fs-1"></i>
                    </div>
                    <h5 class="card-title">Sewa Mobil</h5>
                    <p class="text-muted mb-3">Pilih mobil impian Anda</p>
                    <a href="{{ route('rental.index') }}" class="btn btn-primary btn-lg px-4">
                        Mulai Sewa <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center p-4">
                    <div class="text-info mb-3">
                        <i class="bi bi-clock-history fs-1"></i>
                    </div>
                    <h5 class="card-title">Riwayat Rental</h5>
                    <p class="text-muted mb-3">Lihat semua pemesanan Anda</p>
                    <a href="{{ route('rental.my-rentals') }}" class="btn btn-outline-primary btn-lg px-4">
                        Lihat Riwayat <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="mb-0"><i class="bi bi-list-check text-primary"></i> Pemesanan Terbaru</h4>
                </div>
                <div class="card-body">
                    @if($rental->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-semibold">Mobil</th>
                                        <th class="border-0 fw-semibold">Periode</th>
                                        <th class="border-0 fw-semibold">Durasi</th>
                                        <th class="border-0 fw-semibold">Total</th>
                                        <th class="border-0 fw-semibold">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rental->take(5) as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-car-front-fill text-primary me-2"></i>
                                                    <strong>{{ $item->mobil->nama_mobil }}</strong>
                                                </div>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $item->tanggal_mulai->format('d M Y') }}</small><br>
                                                <small class="text-muted">{{ $item->tanggal_selesai->format('d M Y') }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $item->lama_hari }} hari</span>
                                            </td>
                                            <td>
                                                <strong class="text-success">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</strong>
                                            </td>
                                            <td>
                                                @if($item->status === 'pending')
                                                    <span class="badge bg-warning rounded-pill">
                                                        <i class="bi bi-clock"></i> Pending
                                                    </span>
                                                @elseif($item->status === 'disetujui')
                                                    <span class="badge bg-success rounded-pill">
                                                        <i class="bi bi-check-circle"></i> Disetujui
                                                    </span>
                                                @elseif($item->status === 'selesai')
                                                    <span class="badge bg-primary rounded-pill">
                                                        <i class="bi bi-flag"></i> Selesai
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger rounded-pill">
                                                        <i class="bi bi-x-circle"></i> Dibatalkan
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-car-front fs-1 text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Riwayat Rental</h5>
                            <p class="text-muted mb-3">Anda belum pernah melakukan pemesanan</p>
                            <a href="{{ route('rental.index') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Mulai Sewa Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.hover-lift {
    transition: transform 0.2s ease;
}

.hover-lift:hover {
    transform: translateY(-2px);
}

.card {
    border-radius: 12px;
}

.table th {
    font-weight: 600;
    font-size: 0.9rem;
    color: #495057;
}
</style>
@endsection
