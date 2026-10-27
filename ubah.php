<?php
require 'functions.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = (int) $_GET["id"];
$user_id = $_SESSION["user_id"];

$note = query("SELECT * FROM notes WHERE id = $id AND user_id = $user_id")[0];

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil di ubah');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal di ubah');
                document.location.href = 'index.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Karya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-tulis">
        <h1>Ubah Karya</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $note["id"]; ?>">
            <input type="hidden" name="fotoLama" value="<?= $note["foto"]; ?>">
            <ul>
                <li>
                    <label for="judul">Judul Karya Tulisan</label>
                    <input type="text" name="judul" id="judul" value="<?= htmlspecialchars($note["judul"]); ?>" required>
                </li>
                <li>
                    <label for="isi">Isi Tulisan</label>
                    <textarea name="isi" id="isi" class="textarea-besar" required><?= htmlspecialchars($note["isi"]); ?></textarea>
                </li>
                <li>
                    <label for="foto">Foto Tulisan (max 1mb)</label>
                    <?php if ($note["foto"]): ?>
                        <div class="preview-foto-lama">
                            <img src="img/<?= htmlspecialchars($note["foto"]); ?>" alt="Foto saat ini">
                            <small>Foto saat ini (biarkan kosong jika tidak ingin mengganti)</small>
                        </div>
                    <?php endif; ?>
                    <input type="file" name="foto" id="foto">
                </li>
                <li>
                    <button type="submit" name="submit">Perbarui Karya</button>
                </li>
            </ul>
            <a href="index.php" class="link-back">← Batal</a>
        </form>
    </div>

    <script src="theme.js"></script>
</body>
</html>