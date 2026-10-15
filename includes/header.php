<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrated Hospital Information System (IHIS)</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/css/global.css">
    
    <!-- Page Specific CSS -->
    <?php
    $css_file = "assets/css/{$page}.css";
    if (file_exists($css_file)) {
        echo "<link rel='stylesheet' href='{$css_file}'>";
    }
    ?>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Navigation -->
    <header class="navbar">
        <div class="container navbar-container">
            <div class="navbar-left">
                <a href="index.php?page=home" class="brand">
                    <i class="fa-solid fa-hospital-user"></i> IHIS Siloam-Like
                </a>
                <nav class="nav-links">
                    <a href="index.php?page=home">Home</a>
                    <a href="index.php?page=services">Layanan</a>
                    <a href="index.php?page=doctors">Dokter</a>
                    <a href="index.php?page=hospitals">Cabang RS</a>
                    <a href="index.php?page=promo">Promo</a>
                    <a href="index.php?page=articles">Artikel</a>
                    <a href="index.php?page=infrastructure">Fasilitas</a>
                    <a href="index.php?page=careers">Karir</a>
                    <a href="index.php?page=faq">FAQ</a>
                </nav>
            </div>
            <div class="navbar-right">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <span class="greeting">Halo, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    <a href="index.php?page=dashboard" class="btn btn-primary">Dashboard</a>
                    <a href="index.php?page=logout" class="btn btn-danger">Logout</a>
                <?php else: ?>
                    <a href="index.php?page=login" class="nav-link">Login</a>
                    <a href="index.php?page=register" class="btn btn-light">Buat Janji</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="main-content">
