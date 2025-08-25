<?php
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
<a href="logout.php" class="d-block mt-auto btn btn-danger">
    <i class="bi bi-box-arrow-right"></i> Log OUT
</a>