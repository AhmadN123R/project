<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title>Website PHP Native</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom Theme CSS -->
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

            <!-- Footer -->
            <?php include 'modul/layouts/footer.php'; ?>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Theme Management Script -->
<script src="js/theme.js"></script>

<script>
// Initialize theme system
document.addEventListener('DOMContentLoaded', function() {
    // Initialize theme manager
    window.themeManager = new ThemeManager();
    
    // Initialize settings theme integration
    if (document.getElementById('darkModeToggle')) {
        initializeSettingsTheme();
    }
    
    // Listen for theme changes to update logout modal
    window.addEventListener('themeChanged', updateLogoutModalTheme);
});

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

// Logout function with theme awareness
function handleLogout(button) {
    // Show loading state
    button.classList.add('btn-loading');
    button.disabled = true;
    
    // Simulate logout process
    setTimeout(() => {
        // Hide logout modal
        const logoutModal = bootstrap.Modal.getInstance(document.getElementById('logoutModal'));
        logoutModal.hide();
        
        // Show success modal
        setTimeout(() => {
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            
            // Redirect to logout.php after showing success
            setTimeout(() => {
                window.location.href = 'logout.php';
            }, 2000);
        }, 300);
        
    }, 1500);
}
</script>

<style>
/* Additional animations for sidebar */
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
        box-shadow: var(--shadow-md);
    }
    
    .content {
        width: 100%;
    }
}
</style>

</body>
</html>