<?php
// modul/menu/menu.php - Updated version with theme support
// Mendapatkan halaman aktif dari parameter URL
$current_page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<a href="index.php?page=dashboard" class="d-block mb-1 <?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>" data-page="dashboard">
    <i class="bi bi-house"></i> Dashboard
</a>
<a href="index.php?page=apps" class="d-block mb-1 <?php echo ($current_page == 'apps') ? 'active' : ''; ?>" data-page="apps">
    <i class="bi bi-app"></i> Apps
</a>
<a href="index.php?page=users" class="d-block mb-1 <?php echo ($current_page == 'users') ? 'active' : ''; ?>" data-page="users">
    <i class="bi bi-people"></i> Users
</a>
<a href="index.php?page=todos" class="d-block mb-1 <?php echo ($current_page == 'todos') ? 'active' : ''; ?>" data-page="todos">
    <i class="bi bi-list-task"></i> Todos
</a>
<a href="index.php?page=laporan" class="d-block mb-1 <?php echo ($current_page == 'laporan') ? 'active' : ''; ?>" data-page="laporan">
    <i class="bi bi-graph-up"></i> Pelaporan
</a>
<a href="index.php?page=settings" class="d-block mb-1 <?php echo ($current_page == 'settings') ? 'active' : ''; ?>" data-page="settings">
    <i class="bi bi-gear"></i> Settings
</a>

<!-- Logout Button with Modal -->
<button type="button" class="btn btn-danger d-block mt-auto w-100" data-bs-toggle="modal" data-bs-target="#logoutModal">
    <i class="bi bi-box-arrow-right"></i> Log OUT
</button>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content logout-modal-content">
            <!-- Modal Header with Warning -->
            <div class="modal-header logout-modal-header">
                <div class="w-100 text-center">
                    <div class="warning-icon">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <h5 class="modal-title" id="logoutModalLabel">
                        Yakin mau logout?
                    </h5>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body text-center">
                <p class="logout-message">Anda akan keluar dari aplikasi!</p>
            </div>

            <!-- Modal Footer with Action Buttons -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-logout" onclick="handleLogout(this)">
                    <i class="bi bi-check-circle me-2"></i>Ya, Logout
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                </div>
                <h5 class="text-theme-primary">Logout Berhasil!</h5>
                <p class="text-theme-muted">Mengarahkan ke halaman login...</p>
            </div>
        </div>
    </div>
</div>