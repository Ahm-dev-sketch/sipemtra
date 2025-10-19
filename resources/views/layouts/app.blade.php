<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. TRAN PRIMA - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #1a56db;
        }
        .btn-primary-custom {
            background-color: #1a56db;
            border-color: #1a56db;
        }
        .footer-custom {
            background-color: #f8f9fa;
            padding: 20px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">PT. TRAN PRIMA</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
                <a class="nav-link" href="{{ route('schedules.index') }}">Melihat Jadwal</a>
                <a class="nav-link" href="{{ route('bookings.create') }}">Pesan Tiket</a>
                <a class="nav-link" href="{{ route('transactions.index') }}">Riwayat Transaksi</a>
                @auth
                    <a class="nav-link" href="{{ route('logout') }}">Logout ({{ Auth::user()->name }})</a>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-custom text-center">
        <div class="container">
            <p class="mb-0">© 2025 PT. Tran Prima - Semua Hak Dilindungi</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>