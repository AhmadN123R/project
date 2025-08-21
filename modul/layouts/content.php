<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    // Mapping halaman
    $pages = [
        'dashboard' => 'modul/dashboard/dashboard.php',
        'apps'      => 'modul/data/apps.php',
        'users'     => 'modul/data/users.php',
        'todos'     => 'modul/todos/todos.php',
        'pelaporan' => 'modul/pelaporan/pelaporan.php'
    ];

    if (array_key_exists($page, $pages)) {
        include $pages[$page];
    } else {
        echo "<p>Halaman tidak ditemukan!</p>";
    }
} else {
    include 'modul/dashboard/dashboard.php'; // default
}
?>