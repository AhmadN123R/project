<?php

$current_page = isset($_GET['page']) && $_GET['page'] !== '' 
    ? $_GET['page'] 
    : 'dashboard';
?>

<a href="index.php?page=dashboard" class="<?= ($current_page === 'dashboard') ? 'active' : '' ?>">🏠 Dashboard</a>
<a href="index.php?page=apps" class="<?= ($current_page === 'apps') ? 'active' : '' ?>">📦 Apps</a>
<a href="index.php?page=users" class="<?= ($current_page === 'users') ? 'active' : '' ?>">👥 Users</a>
<a href="index.php?page=todos" class="<?= ($current_page === 'todos') ? 'active' : '' ?>">📝 Todos</a>
<a href="index.php?page=pelaporan" class="<?= ($current_page === 'pelaporan') ? 'active' : '' ?>">📊 Pelaporan</a>