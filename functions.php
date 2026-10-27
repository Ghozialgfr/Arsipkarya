<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "arsipkarya");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function catatAktivitas($aksi, $judul) {
    global $conn;
    $user_id = $_SESSION['user_id'];
    $judul = mysqli_real_escape_string($conn, $judul);
    $aksi = mysqli_real_escape_string($conn, $aksi);

    mysqli_query($conn, "INSERT INTO aktivitas (user_id, aksi, judul) VALUES ('$user_id', '$aksi', '$judul')");
}

function getAktivitas($limit = 15) {
    global $conn;
    $user_id = $_SESSION['user_id'];
    $limit = (int) $limit;

    return query("SELECT * FROM aktivitas WHERE user_id = $user_id ORDER BY waktu DESC LIMIT $limit");
}

function hapusAktivitas($id) {
    global $conn;
    $user_id = $_SESSION['user_id'];
    $id = (int) $id;

    mysqli_query($conn, "DELETE FROM aktivitas WHERE id = $id AND user_id = $user_id");
    return mysqli_affected_rows($conn);
}

function upload() {
    $filename = $_FILES['foto']['name'];
    $filesize = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // foto WAJIB, kalau tidak pilih file gagal upload
    if ($error === 4) {
        echo "<script>alert('Foto wajib diupload!');</script>";
        return false;
    }

    $fileExtensionValid = ['jpg', 'jpeg', 'png'];
    $fileExtension = explode('.', $filename);
    $fileExtension = strtolower(end($fileExtension));

    if (!in_array($fileExtension, $fileExtensionValid)) {
        echo "<script>alert('Yang anda upload bukan gambar!');</script>";
        return false;
    }

    if ($filesize > 1000000) {
        echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
        return false;
    }

    $newFileName = uniqid();
    $newFileName .= '.';
    $newFileName .= $fileExtension;

    move_uploaded_file($tmpName, 'img/' . $newFileName);
    return $newFileName;
}

function tambah($data) {
    global $conn;

    $user_id = $_SESSION['user_id'];
    $judul = mysqli_real_escape_string($conn, $data["judul"]);
    $isi = mysqli_real_escape_string($conn, $data["isi"]);

    $foto = upload();
    if ($foto === false) {
        return false;
    }

    $query = "INSERT INTO notes (user_id, judul, isi, foto) VALUES ('$user_id', '$judul', '$isi', '$foto')";

    mysqli_query($conn, $query);
    catatAktivitas('tambah', $judul); 

    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    $id = $data["id"];
    $user_id = $_SESSION['user_id'];
    $judul = mysqli_real_escape_string($conn, $data["judul"]);
    $isi = mysqli_real_escape_string($conn, $data["isi"]);
    $fotoLama = $data["fotoLama"];

    if ($_FILES['foto']['error'] === 4) {
        // tidak upload foto baru, tetap pakai foto lama (karena sudah pasti ada)
        $foto = $fotoLama;
    } else {
        $foto = upload();
        if (!$foto) {
            return false;
        }
        if ($fotoLama && file_exists('img/' . $fotoLama)) {
            unlink('img/' . $fotoLama);
        }
    }

    $query = "UPDATE notes SET 
                judul = '$judul', 
                isi = '$isi', 
                foto = '$foto' 
              WHERE id = $id AND user_id = $user_id";

    mysqli_query($conn, $query);
    catatAktivitas('ubah', $judul);

    return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;
    $user_id = $_SESSION['user_id'];

    // hapus file foto dulu sebelum row-nya dihapus
    $note = query("SELECT * FROM notes WHERE id = $id AND user_id = $user_id");
    if (count($note) > 0 && $note[0]["foto"]) {
        if (file_exists('img/' . $note[0]["foto"])) {
            unlink('img/' . $note[0]["foto"]);
        }
    }

     if (count($note) > 0) {
        catatAktivitas('hapus', $note[0]["judul"]);  
    }

    mysqli_query($conn, "DELETE FROM notes WHERE id = $id AND user_id = $user_id");
    
    return mysqli_affected_rows($conn);
}

function cari($data, $urutan = "DESC") {
    global $conn;
    $judul = mysqli_real_escape_string($conn, $data["judul"]);

    $query = "SELECT notes.*, users.username 
              FROM notes 
              JOIN users ON notes.user_id = users.id 
              WHERE notes.judul LIKE '%$judul%'
              ORDER BY notes.diupdate_pada $urutan";

    return query($query);
}

function getSemuaKarya($urutan = "DESC") {
    global $conn;

    // JOIN ke tabel users supaya tahu siapa pemilik karya
    $query = "SELECT notes.*, users.username 
              FROM notes 
              JOIN users ON notes.user_id = users.id 
              ORDER BY notes.diupdate_pada $urutan";

    return query($query);
}


function registrasi($data) {
    global $conn;

    $username = mysqli_real_escape_string($conn, $data["username"]);
    $password = $data["password"];
    $password2 = $data["password2"];

    $cek = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah digunakan!');</script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
        return false;
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$passwordHash')");

    return mysqli_affected_rows($conn);
}

function getUserById($id) {
    global $conn;
    $id = (int) $id;
    $result = query("SELECT * FROM users WHERE id = $id");
    return $result[0] ?? null;
}

function cekUsernameDipakai($username, $exceptId) {
    global $conn;
    $username = mysqli_real_escape_string($conn, $username);
    $exceptId = (int) $exceptId;

    $result = query("SELECT id FROM users WHERE username = '$username' AND id != $exceptId");
    return count($result) > 0;
}

// upload khusus foto profil, beda dari upload() karena foto disini OPSIONAL
function uploadFotoProfil() {
    // tidak upload foto baru, bukan error
    if (!isset($_FILES['foto']) || $_FILES['foto']['error'] === 4) {
        return null; // artinya: tidak ada foto baru
    }

    $filename = $_FILES['foto']['name'];
    $filesize = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if ($error !== 0) {
        echo "<script>alert('Terjadi kesalahan saat upload foto!');</script>";
        return false;
    }

    $fileExtensionValid = ['jpg', 'jpeg', 'png'];
    $fileExtension = explode('.', $filename);
    $fileExtension = strtolower(end($fileExtension));

    if (!in_array($fileExtension, $fileExtensionValid)) {
        echo "<script>alert('Yang anda upload bukan gambar!');</script>";
        return false;
    }

    if ($filesize > 1000000) {
        echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
        return false;
    }

    $newFileName = uniqid() . '.' . $fileExtension;
    move_uploaded_file($tmpName, 'img/' . $newFileName);
    return $newFileName;
}

function updateProfil($data) {
    global $conn;

    $id = (int) $_SESSION['user_id'];
    $nama = mysqli_real_escape_string($conn, $data["nama"]);
    $username = mysqli_real_escape_string($conn, $data["username"]);
    $fotoLama = $data["fotoLama"];
    $hapusFoto = $data["hapusFoto"] ?? false;

    $foto = uploadFotoProfil();

    if ($foto === false) {
        return false; // gagal upload, pesan sudah ditampilkan di uploadFotoProfil()
    }

    if ($hapusFoto && $foto === null) {
        // user minta hapus foto & tidak upload foto baru
        if ($fotoLama && file_exists('img/' . $fotoLama)) {
            unlink('img/' . $fotoLama);
        }
        $foto = null;
    } elseif ($foto === null) {
        // tidak ganti foto, tetap pakai foto lama
        $foto = $fotoLama;
    } else {
        // ganti foto baru, hapus foto lama kalau ada
        if ($fotoLama && file_exists('img/' . $fotoLama)) {
            unlink('img/' . $fotoLama);
        }
    }

    $fotoSql = $foto ? "'$foto'" : "NULL";

    $query = "UPDATE users SET 
                nama = '$nama', 
                username = '$username', 
                foto = $fotoSql 
              WHERE id = $id";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}