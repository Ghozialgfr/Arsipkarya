    <?php
    require 'functions.php';

    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }

    $user = getUserById($_SESSION["user_id"]);
    $log = getAktivitas(20);

    $iconAksi = [
        'tambah' => '➕',
        'ubah'   => '✏️',
        'hapus'  => '🗑️',
    ];
    $labelAksi = [
        'tambah' => 'Menambahkan karya',
        'ubah'   => 'Mengubah karya',
        'hapus'  => 'Menghapus karya',
    ];
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Riwayat Aktivitas - Arsip Karya</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container-index">
            <header class="header-dashboard">
                <h1><span class="a">Arsip</span> <span class="k">Karya</span></h1>
                <div class="user-info">
                    Halo, <strong><?= htmlspecialchars($_SESSION["username"]); ?></strong> | <a href="logout.php">Logout</a>
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
                    <a href="index.php" class="btn-secondary">&larr; Kembali</a>
                    <h2 style="margin:0;">Riwayat Aktivitas</h2>
                </div>

                <div class="list-riwayat">
                    <?php if (count($log) == 0): ?>
                        <p class="empty-state">Belum ada aktivitas yang tercatat.</p>
                    <?php else: ?>
                        <?php foreach ($log as $item): ?>
                            <div class="item-riwayat item-<?= $item['aksi']; ?>">
                                <div class="info-riwayat">
                                    <span class="icon-riwayat"><?= $iconAksi[$item['aksi']] ?? '•'; ?></span>
                                    <div class="teks-riwayat">
                                        <p><?= $labelAksi[$item['aksi']] ?? $item['aksi']; ?>: <strong><?= htmlspecialchars($item['judul']); ?></strong></p>
                                        <small><?= date('d M Y, H:i', strtotime($item['waktu'])); ?></small>
                                    </div>
                                </div>
                                <a href="hapus_riwayat.php?id=<?= $item['id']; ?>" 
                                onclick="return confirm('Hapus riwayat ini?')" 
                                class="btn-hapus-riwayat" title="Hapus">✕</a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </main>
        </div>

        <script src="theme.js"></script>
    </body>
    </html>