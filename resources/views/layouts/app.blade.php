<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playora - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .navbar { background-color: #ffffff; border-bottom: 2px solid #eef2f1; }
        .navbar-brand { font-weight: 700; color: #0d6efd !important; letter-spacing: 1px; }
        .nav-link { font-weight: 500; color: #444 !important; }
        .nav-link:hover { color: #0d6efd !important; }
        .footer { background-color: #ffffff; padding: 20px 0; border-top: 1px solid #eef2f1; margin-top: 50px; }
        .btn-primary { border-radius: 8px; padding: 10px 25px; font-weight: 600; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">PLAYORA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link mx-2" href="#">Daftar Lapangan</a></li>
                    <li class="nav-item"><a class="nav-link mx-2" href="#">Cek Booking</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-primary me-2" href="#">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="#">Daftar Sekarang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p class="text-muted mb-0">© 2026 <strong>Playora</strong>. Tap, Book, and Play. Made for Web Programming Project.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>