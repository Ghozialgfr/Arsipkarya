<?php
require 'functions.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil di input');
                document.location.href='index.php';
              </script>";
    } else {
        echo "Data gagal di input";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-tulis">
        <h1>Tambah Karya</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="judul">Judul Karya Tulisan</label>
                    <input type="text" name="judul" id="judul" required>
                </li>
                <li>
                    <label for="isi">Isi Tulisan</label>
                    <textarea name="isi" id="isi" class="textarea-besar" required></textarea>
                </li>
                <li>
                    <label for="foto">Foto Tulisan (max 1mb)</label>
                    <input type="file" name="foto" id="foto">
                </li>
                <li>
                    <button type="submit" name="submit">Simpan Karya</button>
                </li>
            </ul>
            <a href="index.php" class="link-back">← Kembali</a>
        </form>
    </div>

    <script src="theme.js"></script>
</body>
</html>