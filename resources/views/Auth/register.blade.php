@extends('layouts.app')

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    body, html {
        height: 100%;
        margin: 0;
        font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .register-container {
        display: flex;
        max-width: 1200px;
        width: 100%;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .register-left {
        flex: 1;
        background: linear-gradient(45deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9));
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .register-left::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 20%, transparent 70%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .register-left > * {
        position: relative;
        z-index: 1;
    }

    .welcome-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        background: linear-gradient(45deg, #fff, #f8f9fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 20px rgba(0,0,0,0.3);
    }

    .welcome-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .features-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .features-list li {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        opacity: 0.9;
    }

    .features-list i {
        margin-right: 12px;
        font-size: 1.2rem;
        color: #4ade80;
    }

    .register-right {
        flex: 1;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        text-align: center;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .form-subtitle {
        text-align: center;
        color: #6b7280;
        margin-bottom: 2.5rem;
        font-size: 1.1rem;
    }

    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-group.double {
        display: flex;
        gap: 1rem;
    }

    .form-group.double > div {
        flex: 1;
    }

    .form-label {
        position: absolute;
        top: 50%;
        left: 20px;
        transform: translateY(-50%);
        color: #9ca3af;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: none;
        font-size: 1rem;
    }

    .form-control {
        width: 100%;
        padding: 20px 20px 10px 20px;
        border: 2px solid #e5e7eb;
        border-radius: 15px;
        font-size: 1rem;
        background: rgba(255, 255, 255, 0.8);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        outline: none;
        color: #1f2937;
    }

    .form-control:focus,
    .form-control:not(:placeholder-shown) {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        background: rgba(255, 255, 255, 0.95);
    }

    .form-control:focus + .form-label,
    .form-control:not(:placeholder-shown) + .form-label {
        top: 12px;
        font-size: 0.8rem;
        color: #667eea;
        font-weight: 600;
    }

    .form-control.is-invalid {
        border-color: #ef4444;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .form-control.is-invalid:focus + .form-label,
    .form-control.is-invalid:not(:placeholder-shown) + .form-label {
        color: #ef4444;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 0.9rem;
        font-weight: 500;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        font-size: 1.2rem;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #667eea;
    }

    .btn-register {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        border-radius: 15px;
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        margin-top: 1rem;
    }

    .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-register:hover::before {
        left: 100%;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
    }

    .btn-register:active {
        transform: translateY(0);
    }

    .login-link {
        text-align: center;
        margin-top: 2rem;
        color: #6b7280;
    }

    .login-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .login-link a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .form-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1.2rem;
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .form-control:focus ~ .form-icon {
        color: #667eea;
    }

    .floating-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
    }

    .floating-shapes::before,
    .floating-shapes::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .floating-shapes::before {
        width: 80px;
        height: 80px;
        top: 20%;
        right: 20%;
        animation-delay: -2s;
    }

    .floating-shapes::after {
        width: 120px;
        height: 120px;
        bottom: 20%;
        left: 20%;
        animation-delay: -4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    @media (max-width: 768px) {
        .register-container {
            flex-direction: column;
            max-width: 500px;
            margin: 20px;
        }

        .register-left {
            padding: 40px 30px;
        }

        .register-right {
            padding: 40px 30px;
        }

        .welcome-title {
            font-size: 2.5rem;
        }

        .form-title {
            font-size: 2rem;
        }

        .form-group.double {
            flex-direction: column;
            gap: 0;
        }

        .form-group.double > div {
            margin-bottom: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        body {
            padding: 10px;
        }

        .register-container {
            margin: 10px;
        }

        .register-left,
        .register-right {
            padding: 30px 20px;
        }

        .welcome-title {
            font-size: 2rem;
        }

        .form-title {
            font-size: 1.8rem;
        }
    }
</style>

<div class="register-container">
    <div class="register-left">
        <div class="floating-shapes"></div>
        <h1 class="welcome-title">Bergabung</h1>
        <p class="welcome-subtitle">Mulai perjalanan rental mobil Anda bersama kami</p>
        <ul class="features-list">
            <li><i class="bi bi-check-circle-fill"></i> Proses cepat & mudah</li>
            <li><i class="bi bi-shield-check"></i> Keamanan terjamin</li>
            <li><i class="bi bi-car-front"></i> Koleksi mobil terlengkap</li>
            <li><i class="bi bi-headset"></i> Support 24/7</li>
        </ul>
    </div>

    <div class="register-right">
        <h2 class="form-title">Daftar Akun</h2>
        <p class="form-subtitle">Isi data diri Anda dengan lengkap</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                       id="nama" name="nama" value="{{ old('nama') }}" placeholder=" " required>
                <label for="nama" class="form-label">Nama Lengkap</label>
                <i class="bi bi-person form-icon"></i>
                @error('nama')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" placeholder=" " required>
                <label for="email" class="form-label">Email</label>
                <i class="bi bi-envelope form-icon"></i>
                @error('email')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group double">
                <div>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder=" " required>
                    <label for="password" class="form-label">Password</label>
                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                        <i class="bi bi-eye" id="password-icon"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation" placeholder=" " required>
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                        <i class="bi bi-eye" id="password_confirmation-icon"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" 
                       id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" placeholder=" ">
                <label for="no_telepon" class="form-label">No. Telepon</label>
                <i class="bi bi-telephone form-icon"></i>
                @error('no_telepon')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                          id="alamat" name="alamat" rows="3" placeholder=" ">{{ old('alamat') }}</textarea>
                <label for="alamat" class="form-label">Alamat</label>
                <i class="bi bi-geo-alt form-icon" style="top: 25px;"></i>
                @error('alamat')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn-register">
                <i class="bi bi-person-plus me-2"></i>
                Daftar Sekarang
            </button>

            <div class="login-link">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
            </div>
        </form>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        field.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>

@endsection