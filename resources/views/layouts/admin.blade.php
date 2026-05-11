<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playora Admin - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            font-family:'Poppins',sans-serif;
        }

        body{
    background: linear-gradient(135deg, #0f2b1a 0%, #1a4731 50%, #0f2b1a 100%);
    color:#e2e8f0;
}

        .sidebar{
            width:270px;
            height:100vh;
            position:fixed;
            top:0;
            left:0;
            background:#0f2b1a;
            padding:25px;
        }

        .brand{
            color:#22c55e;
            font-size:28px;
            font-weight:700;
            text-decoration:none;
        }

        .sidebar .nav-link{
            color:#cbd5e1;
            padding:14px;
            border-radius:14px;
            margin-bottom:10px;
            transition:0.3s;
        }

        .sidebar .nav-link:hover{
            background:#1f2937;
            color:#22c55e;
        }

        .sidebar .nav-link.active{
            background:linear-gradient(135deg,#22c55e,#16a34a);
            color:white;
        }

        .main{
            margin-left:270px;
            padding:30px;
        }

        .topbar{
            background:#111827;
            border-radius:20px;
            padding:20px 25px;
            margin-bottom:30px;
        }

        .glass-card{
            background:#111827;
            border-radius:24px;
            border:1px solid rgba(255,255,255,0.05);
        }

        .table{
            color:white;
        }

        .table th,
        .table td{
            border-color:rgba(255,255,255,0.05);
        }

        .btn-success{
            background:linear-gradient(135deg,#22c55e,#16a34a);
            border:none;
        }

    </style>
</head>
<body>

<div class="sidebar">

    <a href="#" class="brand">
        <i class="bi bi-dribbble"></i> Playora
    </a>

    <hr class="border-secondary">

    <ul class="nav flex-column">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link">
                <i class="bi bi-grid-fill me-2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.bookings') }}"
               class="nav-link">
                <i class="bi bi-calendar-check me-2"></i>
                Booking
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.pembayaran') }}"
               class="nav-link">
                <i class="bi bi-cash-stack me-2"></i>
                Pembayaran
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.lapangan.index') }}"
               class="nav-link">
                <i class="bi bi-grid me-2"></i>
                Lapangan
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.users') }}"
               class="nav-link">
                <i class="bi bi-people me-2"></i>
                Users
            </a>
        </li>

    </ul>

</div>

<div class="main">

    <div class="topbar d-flex justify-content-between align-items-center">

        <div>
            <h4 class="fw-bold mb-1">@yield('title')</h4>
            <small class="text-secondary">
                Welcome back, {{ Auth::user()->name }}
            </small>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger">
                Logout
            </button>
        </form>

    </div>

    @yield('content')

</div>

</body>
</html>