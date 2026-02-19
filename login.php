<?php
session_start();
require "koneksi.php";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "<script>alert('Username dan password harus diisi!');</script>";
        exit;
    }

    $stmt = mysqli_prepare($conn, "SELECT id_user, username, password FROM user WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) === 1) {
        mysqli_stmt_bind_result($stmt, $id_user, $username_db, $password_db);
        
        if (mysqli_stmt_fetch($stmt)) {
            if (!is_null($password_db) && password_verify($password, $password_db)) {
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username_db;
                $_SESSION['id_user'] = $id_user;
                echo "<script>
                        alert('Login Berhasil!');
                        document.location.href = 'index.php';
                      </script>";
                exit;
            }
        }
    }
    echo "<script>
            alert('Username atau password salah!');
          </script>";

          mysqli_stmt_close($stmt);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <?php


    ?>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username : </label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <button type="submit" name="login">Login</button>
                <a href="regis.php">Registrasi</a>
            </li>
        </ul>
    </form>
</body>

</html>
