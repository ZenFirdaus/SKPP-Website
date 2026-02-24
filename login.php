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
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/login.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="phone-container">

        <!-- Gradient Top -->
        <div class="top-gradient"></div>

        <!-- Login Card -->
        <div class="login-card">
            <h2>Login</h2>

            <form action="" method="post">

                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan Username">

                <label>Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="passInput" placeholder="Masukkan Password">
                    <i class="bi bi-eye eye-icon" id="togglePassword"></i>
                </div>

                <div class="row">
                    <div class="remember">
                        <input type="checkbox">
                        <span>Ingat Saya</span>
                    </div>
                    <a href="#">Lupa Password</a>
                </div>

                <button type="submit" name="login" class="btn-login">
                    Login
                </button>

                <button type="button" class="btn-google">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="google">
                    Masuk dengan Google
                </button>

            </form>
        </div>

    </div>

    <script>
        const passInput = document.getElementById('passInput');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            const type = passInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passInput.setAttribute('type', type);

            // Ganti class icon secara dinamis
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>

</body>

</html>