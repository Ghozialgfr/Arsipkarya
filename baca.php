<?php 
require 'functions.php'; 

// Wajib login 
if (!isset($_SESSION["user_id"])) { 
    header("Location: login.php"); 
    exit; 
} 

// Ambil ID dari URL
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET["id"];
$user_id = $_SESSION["user_id"];

// Ambil data karya siapa saja (tidak dibatasi user_id), plus nama pemiliknya
$karya = query("SELECT notes.*, users.username 
                FROM notes 
                JOIN users ON notes.user_id = users.id 
                WHERE notes.id = $id");

// Jika karya tidak ditemukan atau bukan milik user tersebut, tendang kembali
if (empty($karya)) {
    header("Location: index.php");
    exit;
}

$row = $karya[0];
?> 
<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row["judul"]; ?> - Detail Karya</title> 
    <link rel="stylesheet" href="style.css"> 
</head> 
<body> 

    <div class="container-baca"> 
        
        <!-- Tombol Kembali -->
        <div style="margin-bottom: 20px;">
            <a href="index.php" class="btn-kembali">← Kembali ke Dashboard</a>
        </div>

        <!-- Artikel Konten Utama -->
        <article class="baca-content">
            <?php if (!empty($row["foto"])): ?>
                <div class="baca-banner">
                    <img src="img/<?= $row["foto"]; ?>" alt="<?= $row["judul"]; ?>">
                </div>
            <?php endif; ?>

            <div class="baca-body">
                <h1><?= $row["judul"]; ?></h1>
                <div class="baca-meta">
                    <span>Oleh: <strong><?= htmlspecialchars($row["username"]); ?></strong></span> · 
                    <span>Dipublikasikan pada: <strong><?= $row["diupdate_pada"]; ?></strong></span>
                </div>
                <hr class="baca-pembatas">
                <!-- nl2br menjaga spasi paragraf/enter tulisan dari database -->
                <div class="baca-isi">
                    <?= nl2br(htmlspecialchars($row["isi"])); ?>
                </div>
            </div>
        </article>

    </div> 

    <script src="theme.js"></script>
</body> 
</html>
