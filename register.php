<?php
require 'functions.php';

if (isset($_POST["tbl_register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('Registrasi berhasil, silakan login');
                window.location.href = 'login.php';
              </script>";
    }
}
?>
    
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <form action="" method="POST">
            <h1>Registrasi Akun <br> Arsip Karya</h1>
            <ul>
                <li>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </li>
                <li>
                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" name="password2" id="password2" required>
                </li>
                <li>
                    <button type="submit" name="tbl_register">Registrasi</button>
                </li>
            </ul>
            <a href="login.php" class="link-back">Sudah punya akun? Login</a>
        </form>
    </div>

    <script src="theme.js"></script>
</body>
</html>
