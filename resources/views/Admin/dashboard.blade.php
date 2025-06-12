@extends('layouts.app')

@section('content')
<div class="container p-4 main-wrapper">
    <h2 class="mb-5 text-center fw-bold dashboard-title">Dashboard Admin</h2>

    <!-- Statistik -->
    <div class="row g-4 mb-5">
        @php
            $cards = [
                ['count' => $totalMobil, 'label' => 'Total Mobil', 'icon' => 'car-front', 'color' => 'primary', 'shape' => 'hexagon'],
                ['count' => $mobilTersedia, 'label' => 'Mobil Tersedia', 'icon' => 'check-circle', 'color' => 'success', 'shape' => 'rounded'],
                ['count' => $totalPelanggan, 'label' => 'Total Pelanggan', 'icon' => 'people', 'color' => 'info', 'shape' => 'skew'],
                ['count' => $rentalPending, 'label' => 'Rental Pending', 'icon' => 'clock', 'color' => 'warning', 'shape' => 'diamond'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-6 col-lg-3">
                <div class="stat-card stat-card-{{ $card['shape'] }} stat-card-{{ $card['color'] }} position-relative overflow-hidden">
                    <div class="stat-content d-flex flex-column justify-content-center align-items-center text-center h-100">
                        <div class="stat-icon-wrapper mb-3">
                            <i class="bi bi-{{ $card['icon'] }} stat-icon"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number fw-bold mb-1">{{ $card['count'] }}</h3>
                            <p class="stat-label mb-0">{{ $card['label'] }}</p>
                        </div>
                    </div>
                    <div class="stat-overlay"></div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Manajemen Sistem -->
    <div class="management-card mb-4">
        <div class="management-header">
            <h5 class="mb-0 fw-semibold text-white">
                <i class="bi bi-tools me-2"></i>Manajemen Sistem
            </h5>
        </div>
        <div class="management-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <a href="{{ route('admin.mobil.create') }}" class="action-btn action-btn-create">
                        <div class="action-icon">
                            <i class="bi bi-plus-circle"></i>
                        </div>
                        <span>Tambah Mobil</span>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.mobil.index') }}" class="action-btn action-btn-manage">
                        <div class="action-icon">
                            <i class="bi bi-list-ul"></i>
                        </div>
                        <span>Kelola Mobil</span>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.rental.index') }}" class="action-btn action-btn-rental">
                        <div class="action-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <span>Kelola Rental</span>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.rental.index') }}?status=pending" class="action-btn action-btn-pending">
                        <div class="action-icon">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                        <span>Rental Pending</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Rental Terbaru -->
    <div class="recent-rentals-card">
        <div class="rentals-header">
            <h5 class="mb-0 text-white">
                <i class="bi bi-clock-history me-2"></i>Rental Terbaru
            </h5>
        </div>
        <div class="rentals-body">
            @if($recentRentals->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle custom-table">
                        <thead>
                            <tr>
                                <th>Pelanggan</th>
                                <th>Mobil</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentRentals as $rental)
                                <tr class="table-row">
                                    <td class="fw-medium">{{ $rental->user->nama }}</td>
                                    <td>{{ $rental->mobil->nama_mobil }}</td>
                                    <td>{{ $rental->tanggal_mulai->format('d/m/Y') }}</td>
                                    <td>{{ $rental->tanggal_selesai->format('d/m/Y') }}</td>
                                    <td class="fw-bold text-success">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $rental->status }}">
                                            {{ ucfirst($rental->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.rental.show', $rental) }}" class="action-view-btn" title="Lihat Detail">
                                            <i class="bi bi-eye-fill"></i>
                            
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('admin.rental.index') }}" class="view-all-btn">
                        <span>Lihat Semua Rental</span>
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                    <p class="text-muted mb-0">Belum ada rental yang masuk.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Enhanced Styles -->
<style>
    .main-wrapper {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        border-radius: 20px;
        position: relative;
    }

    .main-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        backdrop-filter: blur(10px);
    }

    .main-wrapper > * {
        position: relative;
        z-index: 1;
    }

    .dashboard-title {
        background: linear-gradient(45deg, #fff, #f8f9fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        font-size: 2.5rem;
    }

    /* Stat Cards Variations */
    .stat-card {
        height: 160px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
    }

    .stat-card-hexagon {
        clip-path: polygon(20% 0%, 80% 0%, 100% 50%, 80% 100%, 20% 100%, 0% 50%);
        background: linear-gradient(45deg, #667eea, #764ba2);
    }

    .stat-card-rounded {
        border-radius: 30px;
        background: linear-gradient(45deg, #11998e, #38ef7d);
    }

    .stat-card-skew {
        transform: skewX(-10deg);
        border-radius: 15px;
        background: linear-gradient(45deg, #3730a3, #06b6d4);
    }

    .stat-card-skew .stat-content {
        transform: skewX(10deg);
    }

    .stat-card-diamond {
        border-radius: 15px;
        transform: rotate(5deg);
        background: linear-gradient(45deg, #f59e0b, #ef4444);
    }

    .stat-card-diamond .stat-content {
        transform: rotate(-5deg);
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }

    .stat-card-skew:hover {
        transform: skewX(-10deg) translateY(-8px) scale(1.02);
    }

    .stat-card-diamond:hover {
        transform: rotate(5deg) translateY(-8px) scale(1.02);
    }

    .stat-content {
        padding: 20px;
    }

    .stat-icon {
        font-size: 2.5rem;
        color: rgba(255,255,255,0.9);
    }

    .stat-number {
        font-size: 2rem;
        color: white;
    }

    .stat-label {
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
    }

    .stat-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at top right, rgba(255,255,255,0.2), transparent);
        pointer-events: none;
    }

    /* Management Card */
    .management-card {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .management-header {
        background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        padding: 20px 25px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .management-body {
        padding: 25px;
    }

    .action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px 15px;
        border-radius: 15px;
        text-decoration: none;
        transition: all 0.3s ease;
        min-height: 120px;
        position: relative;
        overflow: hidden;
    }

    .action-btn-create {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .action-btn-manage {
        background: linear-gradient(135deg, #f093fb, #f5576c);
        color: white;
    }

    .action-btn-rental {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        color: white;
    }

    .action-btn-pending {
        background: linear-gradient(135deg, #ffecd2, #fcb69f);
        color: #333;
    }

    .action-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        color: inherit;
    }

    .action-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    /* Recent Rentals Card */
    .recent-rentals-card {
        background: linear-gradient(135deg, #2c3e50, #34495e);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .rentals-header {
        background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        padding: 20px 25px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .rentals-body {
        padding: 25px;
        background: rgba(255,255,255,0.95);
    }

    .custom-table {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .custom-table thead th {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 15px;
        font-weight: 600;
    }

    .table-row {
        background: white;
        transition: all 0.3s ease;
    }

    .table-row:hover {
        background: linear-gradient(45deg, #f8f9ff, #fff5f5);
        transform: scale(1.01);
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-pending {
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: white;
    }

    .status-disetujui {
        background: linear-gradient(45deg, #10b981, #059669);
        color: white;
    }

    .status-selesai {
        background: linear-gradient(45deg, #3b82f6, #2563eb);
        color: white;
    }

    .status-ditolak {
        background: linear-gradient(45deg, #ef4444, #dc2626);
        color: white;
    }

    .action-view-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .action-view-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .view-all-btn {
        display: inline-flex;
        align-items: center;
        padding: 12px 30px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .view-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #6c757d;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stat-card-skew {
            transform: none;
        }
        
        .stat-card-diamond {
            transform: none;
        }
        
        .stat-card-skew .stat-content,
        .stat-card-diamond .stat-content {
            transform: none;
        }
        
        .dashboard-title {
            font-size: 2rem;
        }
    }
</style>
@endsection