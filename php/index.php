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

    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <div class="mobile-container">

        <div class="header">
            <div class="header-top">
                <div class="profile">
                    <div class="profile-icon"></div>
                    <div class="username">Halo, <?php echo $_SESSION['username']; ?></div>
                </div>

                <div class="header-icons">
                    <i class="fa-solid fa-gear"></i>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </div>
            </div>
        </div>

        <div class="welcome-card">
            <h1>Selamat Datang di SIMUDAH</h1>
            <p>Pengajuan, pengecekan, hingga arsip dalam satu aplikasi</p>
            
            <div class="welcome-image">
                <img src="../images/printer.png" alt="Printer Icon">
            </div>
        </div>

        <div class="menu-grid">
            <a href="pengajuan.php" style="text-decoration: none;">
                <div class="menu-item pengajuan">
                    <div class="icon-placeholder">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    Pengajuan
                </div>
            </a>

            <a href="catatdata.php" style="text-decoration: none;">
                <div class="menu-item catat">
                    <div class="icon-placeholder">
                        <i class="fa-solid fa-pen"></i>
                    </div>
                    Catat Data
                </div>
            </a>

            <a href="pengecekan.php" style="text-decoration: none;">
                <div class="menu-item cek">
                    <div class="icon-placeholder">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    Pengecekan
                </div>
            </a>

            <a href="draft.php" style="text-decoration: none;">
                <div class="menu-item draft">
                    <div class="icon-placeholder">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    Draft SKPP
                </div>
            </a>

            <a href="arsip.php" style="text-decoration: none;">
                <div class="menu-item arsip">
                    <div class="icon-placeholder">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    Arsip
                </div>
            </a>

            <a href="unduh.php" style="text-decoration: none;">
                <div class="menu-item unduh">
                    <div class="icon-placeholder">
                        <i class="fa-solid fa-print"></i>
                    </div>
                    Unduh SKPP
                </div>
            </a>
        </div>

    </div>

    <div class="bottom-nav">
        <i class="fa-solid fa-house nav-icon active"></i>
        <i class="fa-solid fa-plus nav-icon"></i>
        <i class="fa-solid fa-user nav-icon"></i>
    </div>

</body>

</html>