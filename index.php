<!DOCTYPE html>
<html>
<head>
    <title>Website PHP Native</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style/css.css">
</head>
<body>
<div class="container-fluid p-0 d-flex flex-column min-vh-100">
    <!-- Header -->
    <nav class="navbar navbar-dark bg-primary px-3">
      <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
        ☰
      </button>
      <span class="navbar-brand mb-0 h1">Aplikasi Sederhana</span>
      <img src="pngegg.png" alt="Logo" class="rounded-circle" width="50" height="50">
    </nav>

    <div class="d-flex flex-grow-1">
        <!-- Sidebar -->
        <div class="collapse collapse-horizontal show bg-light border-end" id="sidebar">
            <div class="menu p-3 h-100 d-flex flex-column" style="min-width: 250px;">
    <div class="profile-section text-center mb-4 border-bottom pb-3">
        <img src="profil.jpeg" alt="Profile" class="rounded-circle border" width="100" height="100">
        <button class="btn btn-outline-primary w-100 mt-2">Lihat Profil</button>
    </div>

    <?php include 'modul/menu/menu.php'; ?>
</div>
        </div>

        <!-- Konten -->
        <div class="content flex-grow-1 d-flex flex-column">
            <main class="flex-grow-1 p-4">
                <?php
                // cek apakah ada parameter page
                $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
                
                // mapping halaman ke file
                $pages = [
                    "dashboard" => "modul/dashboard/dashboard.php",
                    "apps"      => "modul/data/apps.php",
                    "users"     => "modul/data/users.php",
                    "todos"     => "modul/todos/todos.php",
                    "laporan"   => "modul/pelaporan/pelaporan.php",
                    "settings"  => "modul/settings/settings.php",
                ];

                // cek apakah page ada di mapping
                if (array_key_exists($page, $pages)) {
                    $file = $pages[$page];
                    if (file_exists($file)) {
                        include $file;
                    } else {
                        echo "<h3>File <code>$file</code> tidak ditemukan!</h3>";
                    }
                } else {
                    echo "<h3>Halaman tidak ditemukan!</h3>";
                }
                ?>
            </main>

            <!-- Footer (hanya selebar konten, tidak sampai sidebar) -->
            <?php include 'modul/layouts/footer.php'; ?>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Auto-hide sidebar pada mobile setelah klik menu
document.querySelectorAll('.menu a').forEach(link => {
    link.addEventListener('click', function() {
        if (window.innerWidth <= 768) {
            const sidebar = document.getElementById('sidebar');
            const bsCollapse = new bootstrap.Collapse(sidebar);
            bsCollapse.hide();
        }
    });
});

// Toggle sidebar dengan smooth animation
document.querySelector('[data-bs-target="#sidebar"]').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    const isShown = sidebar.classList.contains('show');
    
    if (!isShown) {
        sidebar.style.animation = 'slideInLeft 0.3s ease-out';
    } else {
        sidebar.style.animation = 'slideOutLeft 0.3s ease-in';
    }
});
</script>

<style>
@keyframes slideInLeft {
    from {
        transform: translateX(-100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutLeft {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(-100%);
        opacity: 0;
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #sidebar {
        position: absolute;
        z-index: 1050;
        height: calc(100vh - 60px);
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    
    .content {
        width: 100%;
    }
}
</style>

</body>
</html>