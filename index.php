<!DOCTYPE html>
<html>
<head>
    <title>Website PHP Native</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style/css.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Header -->
    <nav class="navbar navbar-dark bg-primary px-3">
        <button class="btn btn-outline-light me-2" data-bs-toggle="collapse" data-bs-target="#sidebar">
            ☰
        </button>
        <span class="navbar-brand mb-0 h1">Aplikasi Sederhana</span>
        <img src="pngegg.png" alt="Logo" class="rounded-circle" width="50" height="50">
    </nav>

    <!-- Main Layout -->
    <div class="d-flex flex-grow-1">
        <!-- Sidebar -->
        <div class="collapse show bg-light border-end" id="sidebar">
            <div class="menu p-3 h-100">
                <div class="profile-section text-center mb-4 border-bottom pb-3">
                    <img src="profil.jpeg" alt="Profile" class="rounded-circle border" width="100" height="100">
                    <button class="btn btn-outline-primary w-100 mt-2">Lihat Profil</button>
                </div>
                <a href="#" class="d-block mb-2"><i class="bi bi-house"></i> Beranda</a>
                <a href="#" class="d-block mb-2"><i class="bi bi-list-task"></i> Daftar Tugas</a>
                <a href="#" class="d-block mb-2"><i class="bi bi-people"></i> Pengguna</a>
                <a href="#" class="d-block mb-2"><i class="bi bi-graph-up"></i> Statistik</a>
            </div>
        </div>

        <!-- Konten -->
        <div class="content flex-grow-1 p-4">
            <h2 class="fw-bold">Daftar Tugas</h2>
            <ul>
                <li>Menyelesaikan laporan</li>
                <li>Mengupdate data aplikasi</li>
                <li>Mengecek progres pengguna</li>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-center py-3 bg-dark text-white mt-auto">
        © 2025 Belajar PHP Native | Dibuat dengan ❤️ dan PHP
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>