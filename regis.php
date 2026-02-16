<?php
session_start();
require "koneksi.php";

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $konfirmasi_password = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar!');
              </script>";
        return false;
    }

    // cek konfirmasi_password
    if ($password !== $konfirmasi_password) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
              </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES(NULL, '$username', '$email', '$password')");

    return mysqli_affected_rows($conn);
}

if (isset($_POST['register'])) {
    if (registrasi($_POST) > 0) {
        header("Location: login.php");
        echo "<script>
                alert('Registrasi Berhasil!');
              </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
</head>

<body>
    <h1>Registrasi</h1>

    <form action="" method="post">

    <ul>
        <li>
            <label for="username">Username : </label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="email">E-mail : </label>
            <input type="text" name="email" id="email">
        </li>
        <li>
            <label for="password">Password : </label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <label for="konfirmasi_password">Konfirmasi Password : </label>
            <input type="password" name="konfirmasi_password" id="konfirmasi_password">
        </li>
        <li>
            <button type="submit" name="register">Register</button>
            <a href="login.php">Login</a>
        </li>
    </ul>
    </form>
</body>

</html>