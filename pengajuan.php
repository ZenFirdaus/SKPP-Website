<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['login'])) {
    header ("location: login.php");
    exit;
}

if (isset($_POST['lanjut'])) {
    // Ambil data dari form
    $nama = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $ksk = $_POST['ksk'];
    $tanggal = $_POST['tanggal'];
    $no_skpp = $_POST['no_skpp'];
    $jenis_pengajuan = $_POST['jenis_pengajuan'];

    // Simpan data ke database
    $query = "INSERT INTO pengajuan (nama_lengkap, alamat, email, ksk, tanggal, no_skpp, jenis_pengajuan) VALUES ('$nama_lengkap', '$alamat', '$email', '$ksk', '$tanggal', '$no_skpp', '$jenis_pengajuan')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pengajuan berhasil disimpan!');</script>";
        // Redirect ke halaman berikutnya jika diperlukan
        // header("Location: halaman_berikutnya.php");
        exit;
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        exit;
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan</title>
</head>
<body>
    <form action="" method="post">
        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" required><br><br>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required><br><br>

        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email" required><br><br>

        <label for="ksk">Kode Satuan Kerja:</label>
        <input type="text" id="ksk" name="ksk" required><br><br>

        <label for="tanggal">Tanggal Pengajuan:</label>
        <input type="date" id="tanggal" name="tanggal" required><br><br>

        <label for="no_skpp">Nomor SKPP:</label>
        <input type="text" id="no_skpp" name="no_skpp" required><br><br>

        <label for="jenis_pengajuan">Jenis Pengajuan:</label>
        <select id="jenis_pengajuan" name="jenis_pengajuan" required>
            <option value="">Pilih Jenis Pengajuan</option>
            <option value="SKPP Baru">SKPP Baru</option>
            <option value="Perpanjangan SKPP">Perpanjangan SKPP</option>
            <option value="Perubahan Data SKPP">Perubahan Data SKPP</option>
        </select><br><br>

        <button type="submit" name="lanjut">Lanjut</button>
    </form>
</body>
</html>