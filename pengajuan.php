<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("location: login.php");
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

    <link rel="stylesheet" href="css/pengajuan.css">
</head>

<body>

    <div class="phone-container">

        <div class="top-gradient"></div>

        <div class="form-card">
            <h2>Form Pengajuan</h2>

            <form action="" method="post">

                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" required>

                <label>Alamat</label>
                <input type="text" name="alamat" required>

                <label>E-mail</label>
                <input type="email" name="email" required>

                <label>Kode Satuan Kerja</label>
                <input type="text" name="ksk" required>

                <label>Tanggal Pengajuan</label>
                <input type="date" name="tanggal" required>

                <label>Nomor SKPP</label>
                <input type="text" name="no_skpp" required>

                <label>Jenis Pengajuan</label>
                <select name="jenis_pengajuan" required>
                    <option value="">Pilih Jenis Pengajuan</option>
                    <option value="SKPP Baru">SKPP Baru</option>
                    <option value="Perpanjangan SKPP">Perpanjangan SKPP</option>
                    <option value="Perubahan Data SKPP">Perubahan Data SKPP</option>
                </select>

                <button type="submit" name="lanjut" class="btn-submit">
                    Lanjut
                </button>

            </form>
        </div>

    </div>

</body>

</html>