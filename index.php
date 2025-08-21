<!DOCTYPE html>
<html>
<head>
    <title>Website PHP Native</title>
    <link rel="stylesheet" href="style/css.css">
</head>
<body>
<div class="container">
    <div class="header">
        <img src="pngegg.PNG" alt="Logo" class="logo">
        <?php include 'modul/layouts/header.php'; ?>
    </div>
    <div class="main-layout">
        <div class="menu">
            <div class="profile-section">
                <img src="profil.jpeg" alt="Foto Profil" class="profile-img">
                <button class="profile-btn">Lihat Profil</button>
            </div>
            <?php include 'modul/menu/menu.php'; ?>
        </div>
        <div class="content">
            <?php include 'modul/layouts/content.php'; ?>
        </div>
    </div>
    <div class="footer">
        <?php include 'modul/layouts/footer.php'; ?>
    </div>
</div>
</body>
</html>