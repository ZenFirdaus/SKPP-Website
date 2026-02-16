<?php
session_start();
session_destroy();
?>

<script>
    alert('Logout Berhasil!');
    document.location.href = 'login.php';
</script>