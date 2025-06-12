@extends('layouts.app')
                            <!-- detail mobilnya -->
@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.mobil.index') }}" class="text-decoration-none">Daftar Mobil</a></li>
            <li class="breadcrumb-item active">{{ $mobil->nama_mobil }}</li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Left Column - Image & Gallery -->
        <div class="col-lg-6">
            <div class="image-section">
                <!-- Main Image -->
                <div class="main-image-container">
                    @if($mobil->foto)
                        <img src="{{ Storage::url($mobil->foto) }}" class="main-image" alt="{{ $mobil->nama_mobil }}">
                        <div class="image-overlay">
                            <button class="zoom-btn" onclick="openImageModal()">
                                <i class="bi bi-zoom-in"></i>
                                Perbesar
                            </button>
                        </div>
                    @else
                        <div class="no-image-placeholder">
                            <i class="bi bi-car-front-fill"></i>
                            <span>Foto Tidak Tersedia</span>
                        </div>
                    @endif
                </div>

                    <!-- Features -->
                <div class="features mb-4">
                    <h3 class="section-title">
                        <i class="bi bi-star-fill text-primary"></i>
                        Fitur Unggulan
                    </h3>
                    <div class="features-grid">
                        <div class="feature-item">
                            <i class="bi bi-shield-check"></i>
                            <span>Asuransi Lengkap</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>GPS Navigation</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-music-note-beamed"></i>
                            <span>Audio System</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-snow"></i>
                            <span>Air Conditioning</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-telephone"></i>
                            <span>Support 24/7</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-tools"></i>
                            <span>Emergency Kit</span>
                        </div>
                    </div>
                </div>


                <!-- Additional Info Cards -->
                <div class="info-cards mt-4">
                    <div class="row g-3">
                        <div class="col-6">
                           
                        </div>
                        <div class="col-6">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="col-lg-6">
            <div class="details-section">
                <!-- Header -->
                <div class="car-header mb-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h1 class="car-title">{{ $mobil->nama_mobil }}</h1>
                            <div class="car-subtitle">
                                <span class="brand-badge">{{ $mobil->merk }}</span>
                                <span class="year-badge">{{ $mobil->tahun }}</span>
                            </div>
                        </div>
                        <div class="status-indicator">
                            @if($mobil->status === 'tersedia')
                                <span class="status-available">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Tersedia
                                </span>
                            @else
                                <span class="status-unavailable">
                                    <i class="bi bi-x-circle-fill"></i>
                                    Tidak Tersedia
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Price Section -->
                <div class="price-section mb-4">
                    <div class="price-container">
                        <div class="current-price">
                            <span class="price-currency">Rp</span>
                            <span class="price-amount">{{ number_format($mobil->harga_per_hari, 0, ',', '.') }}</span>
                            <span class="price-period">/hari</span>
                        </div>
                        <div class="price-features">
                            <span class="feature-item">💳 Pembayaran Fleksibel</span>
                            <span class="feature-item">🚗 Antar Jemput Gratis</span>
                        </div>
                    </div>
                </div>

                <!-- Specifications -->
                <div class="specifications mb-4">
                    <h3 class="section-title">
                        <i class="bi bi-gear-fill text-primary"></i>
                        Spesifikasi
                    </h3>
                    <div class="specs-grid">
                        <div class="spec-item">
                            <div class="spec-icon">🏷️</div>
                            <div class="spec-content">
                                <span class="spec-label">Brand</span>
                                <span class="spec-value">{{ $mobil->merk }}</span>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">📅</div>
                            <div class="spec-content">
                                <span class="spec-label">Tahun Produksi</span>
                                <span class="spec-value">{{ $mobil->tahun }}</span>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">🔢</div>
                            <div class="spec-content">
                                <span class="spec-label">Nomor Plat</span>
                                <span class="spec-value">{{ $mobil->plat_nomor }}</span>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">👥</div>
                            <div class="spec-content">
                                <span class="spec-label">Kapasitas</span>
                                <span class="spec-value">5 Penumpang</span>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">⛽</div>
                            <div class="spec-content">
                                <span class="spec-label">Bahan Bakar</span>
                                <span class="spec-value">Bensin</span>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">🔧</div>
                            <div class="spec-content">
                                <span class="spec-label">Transmisi</span>
                                <span class="spec-value">Manual/Matic</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($mobil->deskripsi)
                <div class="description mb-4">
                    <h3 class="section-title">
                        <i class="bi bi-card-text text-primary"></i>
                        Deskripsi
                    </h3>
                    <div class="description-content">
                        <p>{{ $mobil->deskripsi }}</p>
                    </div>
                </div>
                @endif

                

                <!-- Action Buttons -->
                <div class="action-section">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="{{ route('admin.mobil.index') }}" class="btn-back">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                        <div class="col-6">
                            @if($mobil->status === 'tersedia')
                                <a href="{{ route('rental.create', $mobil) }}" class="btn-rent">
                                    <i class="bi bi-lightning-charge-fill"></i>
                                    Sewa Sekarang
                                </a>
                            @else
                                <button class="btn-rent disabled" disabled>
                                    <i class="bi bi-x-circle"></i>
                                    Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">{{ $mobil->nama_mobil }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                @if($mobil->foto)
                    <img src="{{ Storage::url($mobil->foto) }}" class="w-100" alt="{{ $mobil->nama_mobil }}">
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Main Layout */
.container {
    max-width: 1200px;
}

.breadcrumb {
    background: none;
    padding: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "→";
    color: #6c757d;
}

/* Image Section */
.image-section {
    position: sticky;
    top: 20px;
}

.main-image-container {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    background: #f8f9fa;
}

.main-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.main-image:hover {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.main-image-container:hover .image-overlay {
    opacity: 1;
}

.zoom-btn {
    background: white;
    border: none;
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: transform 0.2s ease;
    cursor: pointer;
}

.zoom-btn:hover {
    transform: scale(1.05);
}

.no-image-placeholder {
    height: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 1.2rem;
}

.no-image-placeholder i {
    font-size: 4rem;
    margin-bottom: 15px;
}

/* Info Cards */
.info-cards {
    margin-top: 20px;
}

.info-card {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    gap: 15px;
    transition: transform 0.2s ease;
}

.info-card:hover {
    transform: translateY(-2px);
}

.info-icon {
    font-size: 2rem;
}

.info-text {
    display: flex;
    flex-direction: column;
}

.info-label {
    font-size: 0.8rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    font-weight: 700;
    color: #333;
    font-size: 1.1rem;
}

/* Car Header */
.car-header {
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 20px;
}

.car-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #333;
    margin-bottom: 10px;
}

.car-subtitle {
    display: flex;
    gap: 10px;
    align-items: center;
}

.brand-badge, .year-badge {
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
}

.brand-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.year-badge {
    background: #f8f9fa;
    color: #495057;
    border: 2px solid #e9ecef;
}

/* Status Indicator */
.status-available {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
}

.status-unavailable {
    background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
}

/* Price Section */
.price-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px;
    padding: 25px;
    text-align: center;
}

.current-price {
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 8px;
    margin-bottom: 15px;
}

.price-currency {
    font-size: 1.2rem;
    color: #6c757d;
    font-weight: 600;
}

.price-amount {
    font-size: 3rem;
    font-weight: 800;
    color: #28a745;
}

.price-period {
    font-size: 1.1rem;
    color: #6c757d;
    font-weight: 600;
}

.price-features {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.feature-item {
    font-size: 0.9rem;
    color: #495057;
    font-weight: 500;
}

/* Section Titles */
.section-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Specifications */
.specs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}

.spec-item {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    gap: 15px;
    transition: transform 0.2s ease;
}

.spec-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.spec-icon {
    font-size: 1.5rem;
    width: 40px;
    text-align: center;
}

.spec-content {
    display: flex;
    flex-direction: column;
}

.spec-label {
    font-size: 0.8rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
}

.spec-value {
    font-weight: 700;
    color: #333;
    font-size: 1rem;
}

/* Description */
.description-content {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
}

.description-content p {
    color: #495057;
    line-height: 1.6;
    margin: 0;
}

/* Features */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.features-grid .feature-item {
    background: white;
    padding: 15px 20px;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.2s ease;
    font-weight: 500;
    color: #495057;
}

.features-grid .feature-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    color: #333;
}

.features-grid .feature-item i {
    color: #667eea;
    font-size: 1.2rem;
}

/* Action Buttons */
.action-section {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.btn-back, .btn-rent {
    width: 100%;
    padding: 15px 25px;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}

.btn-back {
    background: #f8f9fa;
    color: #495057;
    border: 2px solid #e9ecef;
}

.btn-back:hover {
    background: #e9ecef;
    color: #333;
    transform: translateY(-2px);
}

.btn-rent {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-rent:hover:not(.disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: white;
}

.btn-rent.disabled {
    background: #6c757d;
    cursor: not-allowed;
    opacity: 0.6;
}

/* Responsive */
@media (max-width: 768px) {
    .car-title {
        font-size: 2rem;
    }
    
    .price-amount {
        font-size: 2.2rem;
    }
    
    .specs-grid {
        grid-template-columns: 1fr;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .car-subtitle {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .price-features {
        flex-direction: column;
        gap: 10px;
    }
}

/* Modal */
.modal-content {
    border: none;
    border-radius: 15px;
    overflow: hidden;
}

.modal-header {
    background: #f8f9fa;
}
</style>

<script>
function openImageModal() {
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}
</script>
@endsection