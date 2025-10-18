<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Pelita Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background-color: #1E3A8A;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .nav-link.active {
            border-bottom: 2px solid white;
        }
        .hero {
            padding: 80px 0;
        }
        .hero h1 {
            font-weight: 700;
            font-size: 2.5rem;
            line-height: 1.3;
        }
        .hero span {
            color: #2563EB;
        }
        .hero p {
            color: #4B5563;
            font-size: 1rem;
            margin-top: 15px;
            margin-bottom: 25px;
        }
        .btn-primary {
            background-color: #2563EB;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
        }
        .btn-outline-primary {
            border: 1px solid #2563EB;
            color: #2563EB;
            padding: 10px 25px;
            border-radius: 8px;
        }
        .btn-outline-primary:hover {
            background-color: #2563EB;
            color: white;
        }
        .hero img {
            width: 100%;
            max-width: 400px;
        }
        footer {
            background-color: white;
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
            color: #374151;
            box-shadow: 0 -1px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark px-4">
        <a class="navbar-brand fw-bold" href="#">PT. TRAN PRIMA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Melihat Jadwal</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Pesan Tiket</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Riwayat Transaksi</a></li>
            </ul>
            <a href="/login" class="btn btn-primary ms-3">Login</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <!-- Teks Kiri -->
                <div class="col-md-6">
                    <h1>
                        Travel Nyaman, Aman<br>
                        Dan Terpercaya Bersama<br>
                        <span>PT. Tran Prima</span>
                    </h1>
                    <p>
                        Pesan tiket travel dengan mudah dan cepat. Cek jadwal keberangkatan, pilih rute, dan pesan tiket Anda secara online. 
                        Kami siap melayani perjalanan Anda dengan armada yang nyaman dan aman.
                    </p>
                    <a href="#" class="btn btn-primary me-2">Pesan Sekarang</a>
                    <a href="/jadwal" class="btn btn-outline-primary">Cek Jadwal & Tarif</a>
                </div>
                <!-- Gambar Kanan -->
                <div class="col-md-6 text-center">
                    <img src="/images/home.jpg" alt="PT Pelita Transport">
                    <div class="mt-3">
                        <h6 class="fw-bold mb-0">PT. Tran Prima</h6>
                        <small class="text-muted">Travel Terbaik Untuk Anda</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        © 2025 PT. Tran Prima - Semua Hak Dilindungi
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>