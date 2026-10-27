<?php
require 'functions.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$user = getUserById($user_id);

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $hapusFoto = isset($_POST["hapus_foto"]); // tambahan ini

    if ($nama === "" || $username === "") {
        echo "<script>alert('Nama dan username wajib diisi!');</script>";
    } elseif (cekUsernameDipakai($username, $user_id)) {
        echo "<script>alert('Username sudah digunakan!');</script>";
    } else {
        $hasil = updateProfil([
            "nama" => $nama,
            "username" => $username,
            "fotoLama" => $user["foto"] ?? null,
            "hapusFoto" => $hapusFoto // tambahan ini
        ]);

        if ($hasil !== false) {
            $_SESSION["username"] = $username;
            $user = getUserById($user_id);
            $success = "Profil berhasil diperbarui.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-index">

        <header class="header-dashboard">
            <h1><span class="a">Profil</span> <span class="k">Saya</span></h1>
            <div class="user-info">
                Halo, <strong><?= htmlspecialchars($_SESSION["username"]); ?></strong> | <a href="index.php">Kembali</a> | <a href="logout.php">Logout</a>
            </div>
        </header>

        <main class="main-content">
            <div class="form-profil">

                <?php if ($success): ?>
                    <p class="alert-success"><?= htmlspecialchars($success); ?></p>
                <?php endif; ?>

                <div class="foto-profil-preview">
                    <?php if (!empty($user["foto"])): ?>
                        <img src="img/<?= htmlspecialchars($user["foto"]); ?>" alt="Foto Profil" width="120">
                    <?php else: ?>
                        <img src="img/default-profil.png" alt="Foto Profil Default" width="120">
                    <?php endif; ?>
                </div>

                <form action="profil.php" method="POST" enctype="multipart/form-data">
                    <label>Upload foto Profil Anda (max 1mb)</label>
                    <input type="file" name="foto" accept="image/jpeg, image/png">

                    <?php if (!empty($user["foto"])): ?>
                        <label class="checkbox-hapus-foto">
                            <input type="checkbox" name="hapus_foto" value="1">
                            Hapus foto profil (kembali ke default)
                        </label>
                    <?php endif; ?>

                    <label>Nama</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($user["nama"] ?? ""); ?>" required>

                    <label>Username</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($user["username"] ?? ""); ?>" required>
                    
                    <button type="submit" class="btn-tambah">Simpan Perubahan</button>
                </form>

            </div>
        </main>

    </div>

    <script src="theme.js"></script>
</body>
</html>