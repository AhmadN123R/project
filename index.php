<?php
// ===== KONFIGURASI HALAMAN =====
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Page configurations
$page_configs = [
    'dashboard' => [
        'title' => 'Dashboard',
        'description' => 'Halaman utama aplikasi dengan ringkasan informasi',
        'file' => 'modul/dashboard/dashboard.php'
    ],
    'apps' => [
        'title' => 'Data Aplikasi',
        'description' => 'Manajemen data aplikasi yang terdaftar',
        'file' => 'modul/data/apps.php'
    ],
    'users' => [
        'title' => 'Data Pengguna',
        'description' => 'Manajemen data pengguna sistem',
        'file' => 'modul/data/users.php'
    ],
    'todos' => [
        'title' => 'Daftar Tugas',
        'description' => 'Manajemen tugas dan aktivitas',
        'file' => 'modul/todos/todos.php'
    ],
    'laporan' => [
        'title' => 'Pelaporan',
        'description' => 'Laporan dan statistik sistem',
        'file' => 'modul/pelaporan/pelaporan.php'
    ],
    'settings' => [
        'title' => 'Pengaturan',
        'description' => 'Konfigurasi dan preferensi aplikasi',
        'file' => 'modul/settings/settings.php'
    ]
];

// Set page variables
$current_config = isset($page_configs[$page]) ? $page_configs[$page] : null;

if ($current_config) {
    $page_title = $current_config['title'];
    $page_description = $current_config['description'];
    $page_file = $current_config['file'];
} else {
    $page_title = 'Halaman Tidak Ditemukan';
    $page_description = 'Halaman yang Anda cari tidak tersedia';
    $page_file = null;
}

// ===== KONFIGURASI APLIKASI =====
$app_title = 'Aplikasi Sederhana';
$app_version = '1.0.0';
$user_name = 'Admin User'; // Dari session atau database
$user_avatar = 'pngegg.png';
$footer_text = 'Belajar PHP Native';

// ===== KONFIGURASI OPTIONAL =====
$show_notifications = true;
$notification_count = 3; // Dari database
$show_version = true;

// CSS dan JS tambahan jika diperlukan
$additional_css = [];
$additional_js = [];

// Script khusus per halaman
$page_script = '';
$page_style = '';

// Contoh: CSS khusus untuk halaman settings
if ($page === 'settings') {
    $page_style = '
        .settings-wrapper {
            animation: fadeInUp 0.5s ease-out;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    ';
}

// Include header
include 'modul/layouts/header.php';
?>

    <div class="d-flex flex-grow-1">
        <!-- Sidebar -->
        <div class="collapse collapse-horizontal show bg-light border-end" id="sidebar">
            <div class="menu p-3 h-100 d-flex flex-column" style="min-width: 250px;">
                <!-- Profile Section -->
                <div class="profile-section text-center mb-4 border-bottom pb-3">
                    <img src="<?php echo $user_avatar; ?>" 
                         alt="Profile" 
                         class="rounded-circle border" 
                         width="100" 
                         height="100">
                    <button class="btn btn-outline-primary w-100 mt-2" onclick="showProfile()">
                        <i class="bi bi-person me-2"></i>Lihat Profil
                    </button>
                </div>

                <!-- Menu Navigation -->
                <?php include 'modul/menu/menu.php'; ?>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content flex-grow-1 d-flex flex-column">
            <main class="flex-grow-1 p-4">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php" class="text-decoration-none">
                                <i class="bi bi-house me-1"></i>Home
                            </a>
                        </li>
                        <?php if ($page !== 'dashboard'): ?>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?php echo $page_title; ?>
                            </li>
                        <?php endif; ?>
                    </ol>
                </nav>

                <!-- Page Content -->
                <?php
                if ($page_file && file_exists($page_file)) {
                    include $page_file;
                } else {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Halaman Tidak Ditemukan!</strong>
                        <?php if ($page_file): ?>
                            <p class="mb-0 mt-2">File <code><?php echo $page_file; ?></code> tidak ditemukan.</p>
                        <?php else: ?>
                            <p class="mb-0 mt-2">Halaman "<?php echo htmlspecialchars($page); ?>" tidak tersedia.</p>
                        <?php endif; ?>
                        <hr>
                        <a href="index.php" class="btn btn-primary btn-sm">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
                        </a>
                    </div>
                    <?php
                }
                ?>
            </main>

<?php
// Set additional page script for profile functionality
$page_script .= '
function showProfile() {
    // Example profile modal or redirect
    alert("Fitur profil akan segera hadir!\n\nNama: ' . $user_name . '\nLevel: Administrator");
    // window.location.href = "profile.php";
}
';

// Include footer (with closing tags and scripts)
include 'modul/layouts/footer.php';
?>