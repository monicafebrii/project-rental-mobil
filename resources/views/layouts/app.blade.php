<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{ config('app.name', 'Rental Mobil') }}</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      /* Background gradient halus */ 
      background: linear-gradient(135deg, #e0f7fa, #80deea);
    }
    #sidebar {
      width: 64px;
      background: linear-gradient(180deg, #34495e, #2c3e50);
      color: white;
      min-height: 100vh;
      transition: width 0.3s ease;
      position: fixed;
      top: 0;
      left: 0;
      overflow: hidden;
      z-index: 1000;
    }
    #sidebar.expanded {
      width: 200px;
    }
    #sidebar .toggle-btn {
      background: none;
      border: none;
      color: #fff;
      font-size: 1.5rem;
      margin: 1rem auto;
      display: block;
      cursor: pointer;
    }
    #sidebar ul {
      padding-left: 0;
      list-style: none;
      width: 100%;
      display: flex;
      flex-direction: column;
      height: 100%;
    }
    #sidebar a {
      display: flex;
      align-items: center;
      color: #ccc;
      padding: 0.75rem 1rem;
      text-decoration: none;
      user-select: none;
    }
    #sidebar a.active,
    #sidebar a:hover {
      background-color: #16a085;
      color: white;
    }
    #sidebar a .icon {
      width: 32px;
      text-align: center;
      font-size: 1.4rem;
    }
    #sidebar.expanded a span {
      margin-left: 0.5rem;
      opacity: 1;
    }
    #sidebar a span {
      opacity: 0;
      white-space: nowrap;
      transition: opacity 0.3s;
    }
    .main-content {
      margin-left: 64px;
      padding: 1rem;
      transition: margin-left 0.3s ease;
    }
    #sidebar.expanded ~ .main-content {
      margin-left: 200px;
    }
    .navbar-custom {
      background: linear-gradient(to right, #4e54c8, #8f94fb);
    }
    .navbar-custom .navbar-brand,
    .navbar-custom .nav-link {
      color: white !important;
    }
    .navbar-custom .nav-link:hover {
      color: #ffc107 !important;
    }
    .flash-message {
      transition: opacity 0.3s ease-in-out;
    }
  </style>

  @stack('styles')
</head>
<body>

@auth
  @if(Auth::user()->isAdmin())
    {{-- SIDEBAR UNTUK ADMIN --}}
    <nav id="sidebar" onmouseover="this.classList.add('expanded')" onmouseout="this.classList.remove('expanded')">
      <button class="toggle-btn" onclick="document.getElementById('sidebar').classList.toggle('expanded')">
        <i class="bi bi-list"></i>
      </button>
      <ul>
        <li>
          <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="icon bi bi-speedometer"></i><span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.pelanggan.index') }}" class="{{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
            <i class="icon bi bi-people-fill"></i><span>Pelanggan</span>
          </a>
        </li>
        <li style="margin-top:auto">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="text-danger">
              <i class="icon bi bi-box-arrow-right"></i><span>Logout</span>
            </a>
          </form>
        </li>
      </ul>
    </nav>
  @else
    {{-- NAVBAR UNTUK PELANGGAN --}}
    <nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
          <i class="bi bi-car-front-fill me-1"></i>Rental Mobil
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav gap-2">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="bi bi-house-door-fill"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('rental.index') }}">
                <i class="bi bi-calendar-plus-fill"></i> Sewa Mobil
              </a>
            </li>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-link nav-link" type="submit">
                  <i class="bi bi-box-arrow-right"></i> Logout
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  @endif
@endauth

<div class="main-content">
  @auth
    @if(Auth::user()->isAdmin())
      <div class="d-flex justify-content-between align-items-center mb-3">
       <h2 class="text-primary" style="font-size: 24px;">
        <i class="bi bi-car-front" style="margin-right: 8px; font-size: 28px;"></i> Rental Mobil
        </h2>
        <!-- <h2 class="text-primary">Rental Mobil</h2> ini teks yg lama -->
        <div>Hai, {{ Auth::user()->nama }}</div>
      </div>
    @endif
  @endauth

  @if(session('success'))
    <div class="alert alert-success flash-message">
      <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger flash-message">
      <i class="bi bi-x-circle-fill me-1"></i> {{ session('error') }}
    </div>
  @endif

  @yield('content')
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  setTimeout(() => {
    document.querySelectorAll('.flash-message').forEach(el => {
      el.style.opacity = '0';
      setTimeout(() => el.remove(), 500);
    });
  }, 3000);
</script>

@stack('scripts')
</body>
</html>
