<?php
require 'functions.php';

// wajib login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

$user_id = $_SESSION["user_id"];
$user = getUserById($user_id);

// ambil & validasi filter urutan dari URL (GET)
$urutanInput = $_GET["urutan"] ?? "terbaru";
$urutan = ($urutanInput === "terlama") ? "ASC" : "DESC"; // default selalu "terbaru" (DESC)

$keyword = $_GET["judul"] ?? "";

if (isset($_GET["cari"]) && $keyword !== "") {
    $notes = cari(["judul" => $keyword], $urutan);
} else {
    $notes = getSemuaKarya($urutan);
}
?>

<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Karya</title> 
    <link rel="stylesheet" href="style.css"> 
    
</head>
<body> 

    <div class="container-index">   
                
        <header class="header-dashboard"> 
            <h1><span class="a">Arsip</span> <span class="k">Karya</span></h1> 
            <div class="user-info"> 
                Halo, <strong><?= htmlspecialchars($_SESSION["username"]); ?></strong> | <a href="logout.php">Logout</a> 
                <a href="riwayat.php" class="link-riwayat" title="Riwayat aktivitas">🕓</a>
                <button id="btnTheme" class="btn-theme" title="Ganti tema">🌙</button>
                <a href="profil.php" class="link-profil">
                    <?php if (!empty($user["foto"])): ?>
                        <img src="img/<?= htmlspecialchars($user["foto"]); ?>" alt="Foto Profil" class="foto-profil-kecil">
                    <?php else: ?>
                        <img src="img/default-profil.png" alt="Foto Profil" class="foto-profil-kecil">
                    <?php endif; ?>
                </a>
            </div> 
        </header>

        <main class="main-content">

            <div class="action-bar"> 
                <a href="tambah.php" class="btn-tambah">+ Tambah Karya</a> 
                <form action="" method="GET" class="form-cari"> 
                    <input type="text" name="judul" placeholder="Cari judul..." value="<?= htmlspecialchars($keyword); ?>"> 

                    <select name="urutan">
                        <option value="terbaru" <?= $urutanInput === "terbaru" ? "selected" : ""; ?>>Terbaru</option>
                        <option value="terlama" <?= $urutanInput === "terlama" ? "selected" : ""; ?>>Terlama</option>
                    </select>

                    <button type="submit" name="cari" class="btn-cari">Cari</button> 
                    <a href="index.php" class="btn-secondary btn-reset-link">Reset</a>
                </form> 
            </div> 

            <div class="grid-karya"> 
            <?php if (count($notes) == 0): ?> 
                <p class="empty-state">Belum ada karya yang diarsipkan.</p> 
            <?php else: ?> 
                <?php foreach ($notes as $row): ?> 
                    <div class="card-karya"> 
                        <img src="img/<?= $row["foto"]; ?>" alt="<?= $row["judul"]; ?>"> 
                        <div class="card-body"> 
                            <h3><?= $row["judul"]; ?></h3> 
                            <p><?= substr($row["isi"], 0, 80); ?>...</p> 
                            <small>
                                Oleh: <strong><?= htmlspecialchars($row["username"]); ?></strong> · 
                                Diupdate: <?= $row["diupdate_pada"]; ?>
                            </small> 
                            
                            <div class="card-aksi"> 
                                <a href="baca.php?id=<?= $row["id"]; ?>" class="btn-lihat">Lihat</a>

                                <?php if ($row["user_id"] == $user_id): ?>
                                    <a href="ubah.php?id=<?= $row["id"]; ?>" class="btn-ubah">Ubah</a> 
                                    <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Anda ingin menghapus data ini?')" class="btn-hapus">Hapus</a> 
                                <?php endif; ?>
                            </div> 
                        </div> 
                    </div> 
                <?php endforeach; ?>
            <?php endif; ?> 
        </div> 

        </main>

    </div> 

    <script src="theme.js"></script>
</body> 
</html>