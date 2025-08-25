<?php
// File: modul/layouts/header.php (MODIFIED VERSION)
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#ffffff">
    <title><?php echo isset($page_title) ? $page_title . ' - Website PHP Native' : 'Website PHP Native'; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Aplikasi sederhana menggunakan PHP Native dengan Bootstrap'; ?>">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom Theme CSS -->
    <link rel="stylesheet" href="style/css.css">
    
    <!-- Additional CSS if needed -->
    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $css): ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
<div class="container-fluid p-0 d-flex flex-column min-vh-100">
    <!-- Header Navigation - MODIFIED -->
    <nav class="navbar navbar-dark bg-primary px-3">
        <!-- Left Side: Only hamburger menu (NO LOGO) -->
        <div class="navbar-left d-flex align-items-center">
            <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
                ☰
            </button>
        </div>
        
        <!-- Center: App Title -->
        <span class="navbar-brand mb-0 h1 position-absolute start-50 translate-middle-x">
            <?php echo isset($app_title) ? $app_title : 'Aplikasi Sederhana'; ?>
        </span>
        
        <!-- Right Side: Notification + Profile -->
        <div class="navbar-right d-flex align-items-center ms-auto">
            <!-- Notification Bell - MOVED TO RIGHT -->
            <?php if (isset($show_notifications) && $show_notifications): ?>
                <button class="btn btn-outline-light me-3 position-relative" type="button" id="notificationBtn" title="Notifikasi">
                    <i class="bi bi-bell"></i>
                    <?php if (isset($notification_count) && $notification_count > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $notification_count; ?>
                        </span>
                    <?php endif; ?>
                </button>
            <?php endif; ?>
            
            <!-- User Avatar - CHANGED TO profil.JPEG -->
            <img src="profil.JPEG" 
                 alt="<?php echo isset($user_name) ? $user_name : 'User'; ?>" 
                 class="rounded-circle" 
                 width="50" 
                 height="50"
                 style="cursor: pointer; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s ease;" 
                 title="<?php echo isset($user_name) ? $user_name : 'Profile'; ?>"
                 onclick="toggleProfileMenu()"
                 onerror="this.src='pngegg.png'">
        </div>
    </nav>