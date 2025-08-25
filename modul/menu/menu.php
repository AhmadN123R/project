<?php
// modul/menu/menu.php - Updated version
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

<!-- Logout Button - Changed from direct link to modal trigger -->
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
                <h5>Logout Berhasil!</h5>
                <p class="text-muted">Mengarahkan ke halaman login...</p>
            </div>
        </div>
    </div>
</div>

<style>
/* Logout Modal Styling */
.logout-modal-content {
    border: none;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

.logout-modal-header {
    background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    color: white;
    border: none;
    padding: 2rem;
    position: relative;
}

.logout-modal-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.1);
    opacity: 0.5;
}

.warning-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    border: 3px solid rgba(255, 255, 255, 0.3);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.warning-icon i {
    font-size: 2.5rem;
    color: white;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.logout-modal-header .modal-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.logout-message {
    font-size: 1.1rem;
    color: #555;
    margin: 0;
    line-height: 1.6;
}

.modal-footer {
    background: #f8f9fa;
    border: none;
    padding: 1.5rem 2rem;
    gap: 1rem;
}

/* Custom Button Styling for Logout Modal */
.btn-logout {
    background: linear-gradient(135deg, #3742fa, #2f3542);
    border: none;
    color: white;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(55, 66, 250, 0.3);
    min-width: 120px;
}

.btn-logout:hover {
    background: linear-gradient(135deg, #2f3542, #3742fa);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(55, 66, 250, 0.4);
    color: white;
}

.btn-cancel {
    background: linear-gradient(135deg, #ff3838, #ff6b6b);
    border: none;
    color: white;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 56, 56, 0.3);
    min-width: 120px;
}

.btn-cancel:hover {
    background: linear-gradient(135deg, #ff6b6b, #ff3838);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 56, 56, 0.4);
    color: white;
}

/* Loading Animation */
.btn-loading {
    position: relative;
    color: transparent !important;
}

.btn-loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Modal Animation */
.modal.fade .modal-dialog {
    transition: transform 0.4s ease-out, opacity 0.4s ease-out;
    transform: scale(0.8) translateY(-100px);
    opacity: 0;
}

.modal.show .modal-dialog {
    transform: scale(1) translateY(0);
    opacity: 1;
}

/* Responsive */
@media (max-width: 576px) {
    .logout-modal-header,
    .modal-body {
        padding: 1.5rem;
    }
    
    .warning-icon {
        width: 60px;
        height: 60px;
    }
    
    .warning-icon i {
        font-size: 2rem;
    }
    
    .logout-modal-header .modal-title {
        font-size: 1.5rem;
    }
}
</style>

<script>
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