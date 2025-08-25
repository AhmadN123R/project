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
    <!-- Header Navigation -->
    <nav class="navbar navbar-dark bg-primary px-3">
        <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
            ☰
        </button>
        <span class="navbar-brand mb-0 h1">
            <?php echo isset($app_title) ? $app_title : 'Aplikasi Sederhana'; ?>
        </span>
        
        <!-- Profile/User Info -->
        <div class="d-flex align-items-center">
            <!-- Notification Bell (Optional) -->
            <?php if (isset($show_notifications) && $show_notifications): ?>
                <button class="btn btn-outline-light me-2" type="button" id="notificationBtn" title="Notifikasi">
                    <i class="bi bi-bell"></i>
                    <?php if (isset($notification_count) && $notification_count > 0): ?>
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle badge-sm rounded-pill">
                            <?php echo $notification_count; ?>
                        </span>
                    <?php endif; ?>
                </button>
            <?php endif; ?>
            
            <!-- User Avatar -->
            <img src="<?php echo isset($user_avatar) ? $user_avatar : 'pngegg.png'; ?>" 
                 alt="<?php echo isset($user_name) ? $user_name : 'User'; ?>" 
                 class="rounded-circle" width="50" height="50"
                 style="cursor: pointer;" 
                 title="<?php echo isset($user_name) ? $user_name : 'Profile'; ?>">
        </div>
    </nav>