@extends('layouts.app')

@section('content')
<style>
    body {
       
        background: linear-gradient(to right, #74ebd5, #ACB6E5); 
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 24px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        padding: 2rem 2.5rem;
        max-width: 450px;
        width: 100%;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.8) !important;
        border: none;
        font-size: 1.1rem;
        padding: 0.75rem 1rem;
    }

    .form-control:focus {
        box-shadow: none;
        border-color:rgb(33, 94, 159);
    }

    .input-group-text {
        background-color: rgba(255, 255, 255, 0.8) !important;
        border: none;
        font-size: 1.1rem;
    }

    .btn-primary {
        background-color:rgb(9, 80, 155);
        border: none;
        font-size: 1.1rem;
        padding: 0.75rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .login-heading {
        font-size: 2rem;
        font-weight: bold;
    }

    .login-subtext {
        font-size: 1rem;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="glass-card text-white">
            <div class="text-center mb-4">
                <h2 class="login-heading">🔐 Login </h2>
                <p class="login-subtext">Silakan login untuk mengakses dashboard rental mobil.</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold text-white">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold text-white">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Button --}}
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                    </button>
                </div>

                {{-- Register --}}
                <div class="text-center mt-4">
                    <small class="text-white">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-light fw-semibold text-decoration-underline">Daftar di sini</a>
                    </small>
                </div>
            </form>

            <div class="text-center mt-4 text-white small">
                &copy; {{ date('Y') }} SuryaRental. All rights reserved.
            </div>
        </div>
    </div>
</div>
@endsection
