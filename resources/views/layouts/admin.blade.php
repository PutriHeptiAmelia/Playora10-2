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

        :root {
            --primary: #16a34a;
            --primary-dark: #15803d;
            --bg: #f8fafc;
            --text: #1e293b;
            --card-bg: #ffffff;
            --border: #e2e8f0;
        }

        body{
            background: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
        }

        .sidebar{
            width:270px;
            height:100vh;
            position:fixed;
            top:0;
            left:0;
            background: linear-gradient(135deg, #0f2b1a 0%, #1a4731 50%, #0f2b1a 100%);
            border-right: none;
            padding:25px;
            z-index: 1000;
        }

        .brand{
            color: #ffffff;
            font-size:28px;
            font-weight:700;
            text-decoration:none;
        }

        .sidebar .nav-link{
            color: #cbd5e1;
            padding:14px;
            border-radius:14px;
            margin-bottom:10px;
            transition:0.3s;
            font-weight: 500;
        }

        .sidebar .nav-link:hover{
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
        }

        .sidebar .nav-link.active{
            background: rgba(22, 163, 74, 0.2);
            color: #4ade80;
            border: 1px solid rgba(22, 163, 74, 0.3);
            box-shadow: 0 4px 15px rgba(22, 163, 74, 0.1);
        }

        .main{
            margin-left:270px;
            padding:30px;
        }

        .topbar{
            background: #ffffff;
            border-radius:20px;
            padding:20px 25px;
            margin-bottom:30px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .topbar h4 {
            color: #1e293b;
        }

        .topbar .text-secondary {
            color: #64748b !important;
        }

        .glass-card{
            background: var(--card-bg);
            border-radius:24px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            padding: 20px;
        }

        .table{
            color: var(--text);
        }

        .table th,
        .table td{
            border-color: var(--border);
            padding: 15px 10px;
            vertical-align: middle;
        }

        .table th {
            font-weight: 600;
            color: #475569;
        }

        .btn-success{
            background: var(--primary);
            border:none;
        }

        .btn-success:hover {
            background: var(--primary-dark);
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