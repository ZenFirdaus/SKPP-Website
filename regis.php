<?php
require "koneksi.php";

if (isset($_POST['register'])) {

  // Ambil & bersihkan input
  $username = trim($_POST["username"]);
  $email = trim($_POST["email"]);
  $password = $_POST["password"];
  $konfirmasi_password = $_POST["konfirmasi_password"];

  // 1. Cek field kosong
  if (empty($username) || empty($email) || empty($password) || empty($konfirmasi_password)) {
    echo "<script>alert('Semua field harus diisi!');</script>";
    exit;
  }

  // 2. Validasi email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Format email tidak valid!');</script>";
    exit;
  }

  // 3. Validasi panjang password
  if (strlen($password) < 8) {
    echo "<script>alert('Password minimal 8 karakter!');</script>";
    exit;
  }

  // 4. Validasi kompleksitas password
  if (
    !preg_match("/[a-z]/", $password) ||
    !preg_match("/[A-Z]/", $password) ||
    !preg_match("/[0-9]/", $password) ||
    !preg_match("/[!@#$%^&*()_+]/", $password)
  ) {
    echo "<script>alert('Password harus mengandung huruf besar, kecil, angka, dan simbol!');</script>";
    exit;
  }

  // 5. Cek konfirmasi password
  if ($password !== $konfirmasi_password) {
    echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
    exit;
  }

  // 6. Cek username sudah ada atau belum (Prepared Statement)
  $stmt = mysqli_prepare($conn, "SELECT id_user FROM user WHERE username = ?");
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);

  if (mysqli_stmt_num_rows($stmt) > 0) {
    echo "<script>alert('Username sudah terdaftar!');</script>";
    exit;
  }

  mysqli_stmt_close($stmt);

  // 7. Hash password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // 8. Insert user baru
  $stmt = mysqli_prepare($conn, "INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);

  if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Registrasi berhasil!');</script>";
  } else {
    echo "<script>alert('Terjadi kesalahan saat registrasi!');</script>";
  }

  mysqli_stmt_close($stmt);
}
?>




<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/regis.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

  <div class="phone-container">

    <!-- Gradient Top -->
    <div class="top-gradient"></div>

    <!-- Register Card -->
    <div class="login-card">
      <h2>Register</h2>

      <form action="" method="post">

        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan Username">

        <label>E-mail</label>
        <input type="email" name="email" placeholder="Masukkan E-mail">

        <label>Password</label>
        <div class="password-wrapper">
          <input type="password" name="password" id="passInput" placeholder="Masukkan Password">
          <i class="bi bi-eye eye-icon" id="togglePassword"></i>
        </div>

        <label>Konfirmasi Password</label>
        <div class="password-wrapper">
          <input type="password" name="konfirmasi_password" id="konfirmasiPasswordInput" placeholder="Konfirmasi Password">
          <i class="bi bi-eye eye-icon" id="toggleKonfirmasiPassword"></i>
        </div>

        <button type="submit" name="register" class="btn-login">
          Register
        </button>

        <div class="register-link">
          Sudah punya akun? <a href="login.php">Login</a>
        </div>

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
  <script>
    const konfirmasiPasswordInput = document.getElementById('konfirmasiPasswordInput');
    const toggleKonfirmasiPassword = document.getElementById('toggleKonfirmasiPassword');

    toggleKonfirmasiPassword.addEventListener('click', function() {
      const type = konfirmasiPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      konfirmasiPasswordInput.setAttribute('type', type);

      // Ganti class icon secara dinamis
      this.classList.toggle('bi-eye');
      this.classList.toggle('bi-eye-slash');
    });
  </script>
</body>

</html>