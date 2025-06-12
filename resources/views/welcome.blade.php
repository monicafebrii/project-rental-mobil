@extends('layouts.app')
@section('content')
<!-- Hero Section -->        <!-- ini tampilan awal -->  
<div class="hero-wrapper">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    Rental Mobil <span class="text-gradient">Terpercaya</span>
                </h1>
                <p class="hero-subtitle">Sewa mobil berkualitas dengan layanan terbaik untuk perjalanan nyaman Anda</p>
                @guest
                    <a class="cta-button" href="{{ route('register') }}">
                        <span>Mulai Rental</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                @endguest
            </div>
        </div>
        <div class="hero-decoration">
            <div class="floating-shape shape-1"></div>
            <div class="floating-shape shape-2"></div>
            <div class="floating-shape shape-3"></div>
        </div>
    </div>
</div>

<!-- Cars Section -->
<div class="cars-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Pilihan Mobil Premium</h2>
            <p class="section-subtitle">Temukan mobil terbaik untuk kebutuhan perjalanan Anda</p>
        </div>
        
        <div class="cars-grid">
            @forelse($mobil as $item)
                <div class="car-card-wrapper">
                    <div class="car-card">
                        <div class="car-image-container">
                            @if($item->foto)
                                <img src="{{ Storage::url($item->foto) }}" class="car-img" alt="{{ $item->nama_mobil }}">
                            @else
                                <div class="car-placeholder">
                                    <i class="bi bi-car-front"></i>
                                </div>
                            @endif
                            <div class="price-tag">
                                <span class="price-amount">Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }}</span>
                                <span class="price-period">/hari</span>
                            </div>
                        </div>
                        
                        <div class="car-info">
                            <h3 class="car-name">{{ $item->nama_mobil }}</h3>
                            
                            <div class="car-details">
                                <div class="detail-item">
                                    <i class="bi bi-award"></i>
                                    <span>{{ $item->merk }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-calendar-check"></i>
                                    <span>{{ $item->tahun }}</span>
                                </div>
                            </div>
                            
                            @auth
                                <a href="{{ route('rental.show', $item) }}" class="car-button detail-btn">
                                    <i class="bi bi-eye"></i>
                                    <span>Lihat Detail</span>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="car-button login-btn">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                    <span>Login untuk Sewa</span>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-car-front-fill"></i>
                    </div>
                    <h3>Belum Ada Mobil Tersedia</h3>
                    <p>Koleksi mobil kami sedang dalam proses penambahan. Silakan cek kembali nanti!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
/* Hero Section */
.hero-wrapper {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    min-height: 60vh;
    position: relative;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.hero-content {
    position: relative;
    z-index: 2;
    padding: 4rem 0;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.text-gradient {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
    max-width: 600px;
}

.cta-button {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    color: #000;
    padding: 1rem 2rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
    transition: all 0.3s ease;
}

.cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(255, 215, 0, 0.4);
    color: #000;
}

/* Floating Shapes */
.hero-decoration {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
}

.floating-shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 100px;
    height: 100px;
    top: 20%;
    right: 10%;
    animation-delay: -2s;
}

.shape-2 {
    width: 60px;
    height: 60px;
    top: 60%;
    right: 20%;
    animation-delay: -4s;
}

.shape-3 {
    width: 80px;
    height: 80px;
    top: 40%;
    right: 5%;
    animation-delay: -1s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* Cars Section */
.cars-section {
    padding: 5rem 0;
    background: linear-gradient(to bottom, #f8f9fa, #ffffff);
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 1rem;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(45deg, #667eea, #764ba2);
    border-radius: 2px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #718096;
    margin-top: 1.5rem;
}

/* Cars Grid */
.cars-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.car-card-wrapper {
    height: 100%;
}

.car-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.car-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.car-image-container {
    position: relative;
    height: 240px;
    overflow: hidden;
}

.car-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.car-card:hover .car-img {
    transform: scale(1.1);
}

.car-placeholder {
    height: 100%;
    background: linear-gradient(135deg, #e2e8f0, #cbd5e0);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: #a0aec0;
}

.price-tag {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    backdrop-filter: blur(10px);
}

.price-amount {
    font-weight: 700;
    font-size: 0.9rem;
}

.price-period {
    font-size: 0.8rem;
    opacity: 0.8;
}

/* Car Info */
.car-info {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.car-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 1rem;
}

.car-details {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #718096;
    font-size: 0.95rem;
}

.detail-item i {
    color: #667eea;
    font-size: 1.1rem;
}

/* Car Buttons */
.car-button {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    margin-top: auto;
}

.detail-btn {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.detail-btn:hover {
    background: linear-gradient(135deg, #5a67d8, #6b46c1);
    transform: translateY(-2px);
    color: white;
}

.login-btn {
    background: transparent;
    color: #667eea;
    border: 2px solid #667eea;
}

.login-btn:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

/* Empty State */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.empty-icon {
    font-size: 4rem;
    color: #cbd5e0;
    margin-bottom: 1rem;
}

.empty-state h3 {
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #718096;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .cars-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .car-details {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .hero-content {
        padding: 2rem 0;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .cars-section {
        padding: 3rem 0;
    }
}
</style>
@endsection