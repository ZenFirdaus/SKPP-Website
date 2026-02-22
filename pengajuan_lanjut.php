<?php
session_start();
require "koneksi.php";



?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengajuan SIMUDAH</title>

<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/pengajuan_lanjut.css">
<script src="js/pengajuan_lanjut.js" defer></script>

</head>
<body>

<div class="mobile-container">

<div class="header">Pengajuan</div>

<!-- Slip -->
<div class="card">
    <div class="card-title">
        <i class="fa-solid fa-file-lines slip"></i>
        <div>
            Upload Slip Gaji<br>
            <small>PDF max 2MB</small>
        </div>
    </div>
    <input type="file" id="slip" onchange="checkForm()">
</div>

<!-- SK -->
<div class="card">
    <div class="card-title">
        <i class="fa-solid fa-file-lines sk"></i>
        <div>
            Upload SK<br>
            <small>PDF max 2MB</small>
        </div>
    </div>
    <input type="file" id="sk" onchange="checkForm()">
</div>

<!-- Surat -->
<div class="card">
    <div class="card-title">
        <i class="fa-solid fa-file-lines surat"></i>
        <div>
            Upload Surat Pengantar<br>
            <small>PDF max 2MB</small>
        </div>
    </div>
    <input type="file" id="surat" onchange="checkForm()">
</div>

<button class="submit-btn" id="submitBtn" onclick="saveData()" disabled>Kirim</button>

<div class="history" id="history"></div>

<!-- MODAL -->
<!-- <div class="modal" id="successModal">
    <div class="modal-content">
        <div class="success-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <h3>Berhasil!</h3>
        <p>Dokumen berhasil dikirim</p>
    </div>
</div> -->

<div class="bottom-nav">
    <i class="fa-solid fa-house nav-icon"></i>
    <i class="fa-solid fa-plus nav-icon active"></i>
    <i class="fa-solid fa-user nav-icon"></i>
</div>

</div>

<script src="script.js"></script>
</body>
</html>
