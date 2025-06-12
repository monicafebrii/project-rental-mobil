@extends('layouts.app')
 <!-- Ini rental yg kalau klik mulai sewa -->
@section('content')
<div class="container-fluid px-4 py-5">
    <!-- Hero Header -->
    <div class="hero-section text-center mb-5">
        <div class="hero-content">
            <h1 class="hero-title">Temukan Mobil Impian Anda</h1>
            <p class="hero-subtitle">Pilihan terbaik untuk perjalanan tak terlupakan</p>
            <div class="hero-stats">
                <span class="stat-item">🚗 {{ $mobil->total() }}+ Mobil</span>
                <span class="stat-item">⭐ Rating 4.9</span>
                <span class="stat-item">🔒 Aman & Terpercaya</span>
            </div>
        </div>
    </div>

    <!-- Filter Quick Actions -->
    <div class="filter-section mb-4">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="filter-pills">
                    <span class="filter-pill active">🔥 Populer</span>
                    <span class="filter-pill">💰 Ekonomis</span>
                    <span class="filter-pill">🏎️ Sport</span>
                    <span class="filter-pill">👨‍👩‍👧‍👦 Keluarga</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Cars Grid -->
    <div class="cars-grid">
        @forelse($mobil as $item)
            <div class="car-card-wrapper">
                <div class="car-card">
                    <!-- Image Container -->
                    <div class="car-image-container">
                        @if($item->foto)
                            <img src="{{ Storage::url($item->foto) }}" class="car-image" alt="{{ $item->nama_mobil }}">
                        @else
                            <div class="car-placeholder">
                                <i class="bi bi-car-front-fill"></i>
                                <span>Foto Tidak Tersedia</span>
                            </div>
                        @endif
                        
                        <!-- Floating Badges -->
                        <div class="floating-badges">
                            <span class="badge-available">✅ Tersedia</span>
                            <span class="badge-popular">🔥 Populer</span>
                        </div>

                        <!-- Quick View Overlay -->
                        <div class="quick-view-overlay">
                            <a href="{{ route('rental.show', $item) }}" class="quick-view-btn">
                                <i class="bi bi-eye-fill"></i>
                                Quick View
                            </a>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="car-content">
                        <!-- Header -->
                        <div class="car-header">
                            <h3 class="car-name">{{ $item->nama_mobil }}</h3>
                            <div class="car-rating">
                                <span class="rating-stars">⭐⭐⭐⭐⭐</span>
                                <span class="rating-text">(4.8)</span>
                            </div>
                        </div>

                        <!-- Specs Grid -->
                        <div class="specs-grid">
                            <div class="spec-item">
                                <div class="spec-icon">🏷️</div>
                                <div class="spec-details">
                                    <span class="spec-label">Brand</span>
                                    <span class="spec-value">{{ $item->merk }}</span>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">📅</div>
                                <div class="spec-details">
                                    <span class="spec-label">Tahun</span>
                                    <span class="spec-value">{{ $item->tahun }}</span>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">🔢</div>
                                <div class="spec-details">
                                    <span class="spec-label">Plat</span>
                                    <span class="spec-value">{{ $item->plat_nomor }}</span>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-icon">👥</div>
                                <div class="spec-details">
                                    <span class="spec-label">Kapasitas</span>
                                    <span class="spec-value">5 Orang</span>
                                </div>
                            </div>
                        </div>

                        <!-- Price Section -->
                        <div class="price-section">
                            <div class="price-container">
                                <div class="price-main">
                                    <span class="price-currency">Rp</span>
                                    <span class="price-amount">{{ number_format($item->harga_per_hari, 0, ',', '.') }}</span>
                                    <span class="price-period">/hari</span>
                                </div>
                                <div class="price-discount">
                                    <span class="original-price">Rp {{ number_format($item->harga_per_hari * 1.2, 0, ',', '.') }}</span>
                                    <span class="discount-badge">Save 20%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('rental.show', $item) }}" class="btn-secondary">
                                <i class="bi bi-info-circle-fill"></i>
                                Detail
                            </a>
                            <a href="{{ route('rental.create', $item) }}" class="btn-primary">
                                <i class="bi bi-lightning-charge-fill"></i>
                                Sewa Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-content">
                    <div class="empty-icon">🚗💨</div>
                    <h3>Oops! Semua Mobil Sedang Keluar</h3>
                    <p>Jangan khawatir, mobil-mobil keren akan segera kembali!</p>
                    <button class="refresh-btn" onclick="location.reload()">
                        <i class="bi bi-arrow-clockwise"></i>
                        Refresh & Coba Lagi
                    </button>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($mobil->hasPages())
        <div class="pagination-section">
            {{ $mobil->links() }}
        </div>
    @endif
</div>

<style>
/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 60px 20px;
    border-radius: 20px;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.hero-title {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 1.2rem;
    margin-bottom: 30px;
    opacity: 0.9;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.stat-item {
    background: rgba(255,255,255,0.2);
    padding: 10px 20px;
    border-radius: 25px;
    backdrop-filter: blur(10px);
    font-weight: 600;
}

/* Filter Section */
.filter-pills {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: center;
}

.filter-pill {
    background: white;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border: 2px solid transparent;
}

.filter-pill.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    transform: translateY(-2px);
}

.filter-pill:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Cars Grid */
.cars-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 30px;
    margin-bottom: 50px;
}

.car-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.4s ease;
    position: relative;
}

.car-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 50px rgba(0,0,0,0.2);
}

/* Image Container */
.car-image-container {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.car-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.car-card:hover .car-image {
    transform: scale(1.1);
}

.car-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.car-placeholder i {
    font-size: 4rem;
    margin-bottom: 10px;
}

/* Floating Badges */
.floating-badges {
    position: absolute;
    top: 15px;
    right: 15px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.badge-available, .badge-popular {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

.badge-available {
    background: rgba(40, 167, 69, 0.9);
    color: white;
}

.badge-popular {
    background: rgba(255, 193, 7, 0.9);
    color: white;
}

/* Quick View Overlay */
.quick-view-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.car-card:hover .quick-view-overlay {
    opacity: 1;
}

.quick-view-btn {
    background: white;
    color: #333;
    padding: 12px 24px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: transform 0.2s ease;
}

.quick-view-btn:hover {
    transform: scale(1.05);
    color: #667eea;
}

/* Card Content */
.car-content {
    padding: 25px;
}

.car-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
}

.car-name {
    font-size: 1.4rem;
    font-weight: 700;
    color: #333;
    margin: 0;
}

.car-rating {
    text-align: right;
}

.rating-stars {
    font-size: 0.9rem;
}

.rating-text {
    font-size: 0.8rem;
    color: #666;
    margin-left: 5px;
}

/* Specs Grid */
.specs-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 25px;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.spec-icon {
    font-size: 1.2rem;
    width: 30px;
    text-align: center;
}

.spec-details {
    display: flex;
    flex-direction: column;
}

.spec-label {
    font-size: 0.75rem;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.spec-value {
    font-weight: 600;
    color: #333;
}

/* Price Section */
.price-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
}

.price-container {
    text-align: center;
}

.price-main {
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 5px;
    margin-bottom: 8px;
}

.price-currency {
    font-size: 1rem;
    color: #666;
}

.price-amount {
    font-size: 2rem;
    font-weight: 800;
    color: #28a745;
}

.price-period {
    font-size: 0.9rem;
    color: #666;
}

.price-discount {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.original-price {
    text-decoration: line-through;
    color: #999;
    font-size: 0.9rem;
}

.discount-badge {
    background: #ff6b6b;
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

/* Action Buttons */
.action-buttons {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 12px;
}

.btn-primary, .btn-secondary {
    padding: 14px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: white;
}

.btn-secondary {
    background: #f8f9fa;
    color: #666;
    border: 2px solid #e9ecef;
}

.btn-secondary:hover {
    background: #e9ecef;
    color: #333;
    transform: translateY(-2px);
}

/* Empty State */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
}

.empty-content {
    max-width: 400px;
    margin: 0 auto;
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 20px;
}

.empty-content h3 {
    color: #333;
    margin-bottom: 15px;
}

.empty-content p {
    color: #666;
    margin-bottom: 30px;
}

.refresh-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.refresh-btn:hover {
    transform: translateY(-2px);
}

/* Pagination */
.pagination-section {
    display: flex;
    justify-content: center;
    margin-top: 50px;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .cars-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .hero-stats {
        gap: 15px;
    }
    
    .filter-pills {
        gap: 10px;
    }
    
    .specs-grid {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection