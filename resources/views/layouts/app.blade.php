<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playora - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #16a34a;
            --primary-dark: #15803d;
            --accent: #f97316;
            --bg: #f8fafc;
            --text: #1e293b;
        }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg); color: var(--text); }
        .navbar { background-color: #ffffff; border-bottom: 2px solid #e2e8f0; }
        .navbar-brand { font-weight: 700; color: var(--primary) !important; letter-spacing: 2px; font-size: 1.4rem; }
        .nav-link { font-weight: 500; color: #444 !important; transition: color 0.2s; }
        .nav-link:hover { color: var(--primary) !important; }
        .btn-primary { background-color: var(--primary); border-color: var(--primary); border-radius: 8px; padding: 10px 25px; font-weight: 600; }
        .btn-primary:hover { background-color: var(--primary-dark); border-color: var(--primary-dark); }
        .text-primary { color: var(--primary) !important; }
        .bg-primary { background-color: var(--primary) !important; }
        .footer { background-color: #1e293b; color: #94a3b8; padding: 25px 0; margin-top: 60px; }
        .footer strong { color: var(--primary); }
        .dropdown-item:hover { color: var(--primary); background-color: #f0fdf4; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/"><i class="bi bi-dribbble me-1"></i>PLAYORA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-1"></i>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.lapangan.index') }}"><i class="bi bi-grid me-1"></i>Kelola Lapangan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.bookings') }}"><i class="bi bi-calendar-check me-1"></i>Kelola Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.pembayaran') }}"><i class="bi bi-cash-stack me-1"></i>Kelola Pembayaran</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('lapangan.index') }}"><i class="bi bi-grid me-1"></i>Daftar Lapangan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('booking.index') }}"><i class="bi bi-calendar-check me-1"></i>Booking Saya</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('booking.riwayat') }}"><i class="bi bi-clock-history me-1"></i>Riwayat</a>
                            </li>
                        @endif

                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                @if(Auth::user()->role !== 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profil.index') }}">
                                            <i class="bi bi-person me-2"></i>Profil Saya
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('notifikasi.index') }}">
                                            <i class="bi bi-bell me-2"></i>Notifikasi
                                            @if(Auth::user()->unreadNotifications->count() > 0)
                                                <span class="badge rounded-pill ms-1" style="background-color:#f97316;">
                                                    {{ Auth::user()->unreadNotifications->count() }}
                                                </span>
                                            @endif
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('lapangan.index') }}"><i class="bi bi-grid me-1"></i>Daftar Lapangan</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="btn btn-primary btn-sm" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0">© 2026 <strong>Playora</strong>. Tap, Book, and Play. Made for Web Programming Project.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>