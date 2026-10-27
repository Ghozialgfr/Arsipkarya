<?php
require 'functions.php';

$username_cookie = $_COOKIE["remember_username"] ?? "";

if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];

    // username boleh sama antar user, jadi ambil SEMUA yang cocok
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    $loginBerhasil = false;

    while ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $loginBerhasil = true;
            break; // sudah ketemu, tidak perlu lanjut cek baris lain
        }
    }

    if ($loginBerhasil) {
        // kalau centang "ingat saya", simpan username di cookie 7 hari
        if (isset($_POST["ingat_saya"])) {
            setcookie("remember_username", $_POST["username"], time() + (86400 * 7), "/");
        } else {
            setcookie("remember_username", "", time() - 3600, "/");
        }

        header("Location: index.php");
        exit;
    } else {
        $errorMessage = "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container"> 
        <form action="" method="POST">
            <h1>Login Akun <br> Arsip Karya</h1>
            <?php if (isset($errorMessage)) : ?>
                <p style="color: red; text-align:center; margin-bottom: 10px;"><?= $errorMessage; ?></p>
            <?php endif; ?>
            <ul>
                <li>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?= htmlspecialchars($username_cookie); ?>" required>
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </li>
                <li style="display: flex; align-items: center; gap: 5px;">
                    <input type="checkbox" name="ingat_saya" id="ingat_saya" <?= $username_cookie ? "checked" : ""; ?>> 
                    <label for="ingat_saya" style="margin-bottom: 0; cursor: pointer;">Ingat saya</label>
                </li>
                <li>
                    <button type="submit" name="login">Login</button>
                </li>
            </ul>
            <a href="register.php" class="link-back">Belum punya akun? Daftar</a>
        </form>
    </div>

    <script src="theme.js"></script>
</body>
</html>
