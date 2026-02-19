<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMUDAH Dashboard</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="index.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <div class="mobile-container">

        <div class="header">
            <div class="header-top">
                <div class="profile">
                    <div class="profile-icon"></div>
                    <div class="username">Halo, Username</div>
                </div>
                <div>⚙️ ⋮</div>
            </div>
        </div>

        <div class="welcome-card">
            <h1>Selamat Datang di SIMUDAH</h1>
            <p>Pengajuan, pengecekan, hingga arsip dalam satu aplikasi</p>
        </div>

        <div class="menu-grid">
            <div class="menu-item pengajuan">
                <div class="icon-placeholder"></div>
                Pengajuan
            </div>

            <div class="menu-item catat">
                <div class="icon-placeholder"></div>
                Catat Data
            </div>

            <div class="menu-item cek">
                <div class="icon-placeholder"></div>
                Pengecekan
            </div>

            <div class="menu-item draft">
                <div class="icon-placeholder"></div>
                Draft SKPP
            </div>

            <div class="menu-item arsip">
                <div class="icon-placeholder"></div>
                Arsip
            </div>

            <div class="menu-item unduh">
                <div class="icon-placeholder"></div>
                Unduh SKPP
            </div>

        </div>

    </div>

    <div class="bottom-nav">
        <div class="nav-icon active">
            <i class="bi bi-house-door-fill"></i>
        </div>
        <div class="nav-icon">➕</div>
        <div class="nav-icon">👤</div>
    </div>

</body>

</html>
