-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2026 pada 11.09
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsipkarya`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `aksi` varchar(20) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `waktu` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aktivitas`
--

INSERT INTO `aktivitas` (`id`, `user_id`, `aksi`, `judul`, `waktu`) VALUES
(16, 1, 'tambah', 'Kita Gagal', '2026-07-15 15:46:11'),
(17, 1, 'tambah', 'Anakmu Gagal', '2026-07-15 15:51:55'),
(18, 1, 'tambah', 'Barangkali kau tak layak', '2026-07-15 16:05:04'),
(19, 1, 'tambah', 'Yang tak pernah menjadi nyata', '2026-07-15 16:07:55'),
(34, 6, 'tambah', 'anak bager', '2026-07-16 01:15:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `dibuat_pada` datetime DEFAULT current_timestamp(),
  `diupdate_pada` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `judul`, `isi`, `foto`, `dibuat_pada`, `diupdate_pada`) VALUES
(7, 1, 'Kita Gagal', 'Kita telah gagal, aku gagal dalam memahamimu, begitupun seballiknya, kaupun gagal, kau gagal bagaimana cara mengerti aku. sedari awal, kita memang selalu bertentangan tentang banyak hal, kita selalu tidak pernah mengerti satu sama lain. dan benar saja, kita tidak lama, kita berakhir, dan kita telah gagal.    ', '6a5748d30bf0b.jpg', '2026-07-15 15:46:11', '2026-07-15 15:46:11'),
(8, 1, 'Anakmu Gagal', 'Bu, maaf ketika bahku sudah lebih tinggi daripada bahumu, tapi aku tak kunjung membahagiakanmu. ayah maaf ketika kebangganmu ini tak pernah kunjung membanggakanmu. aku takut yah, ternyata aku tak sekuat itu menghadapi semuanya sendiri. bu, aku tak pernah tau ketika harus tanpamu aku akan menjadi seperti apa. maaf selalu mengecewakan, maaf selalu gagal, dan maaf tak punya banyak pencapaian. yah, bu, dunia ini banyak sekali orang. tapi karna aku sampah, jadinya aku hanya sendirian. aku gagal yah, bu. aku gagal jadi diri aku sendiri, aku gagal jadi kebanggan kalian, aku tak punya pencapaian, aku tak punya sesuatu  yang bisa dibanggakan. terimakasih dan maaf yah, bu. semoga suatu hari aku bisa mewujudkan segalanya. tentang mimpi-mimpi kalian, tentang harapan-harapan kalian yang telah diberikan kepadaku. maaf, belum bisa membanggakan', '6a574a2bac0a9.jpg', '2026-07-15 15:51:55', '2026-07-15 15:51:55'),
(9, 1, 'Barangkali kau tak layak', 'Barangkali dimatanya kau tak lagi layal, bukan kau  tidak terlihat, tapi, karna kau bukan lagi seseorang yang memenuhi ekspektasinya. dan barangkali juga saatnya kau berkata cukup, kepada hal - hal yang membuat kau merasa diabaikan. karna kau, tak lagi layak di matanya.', '6a574d404e3d4.jpg', '2026-07-15 16:05:04', '2026-07-15 16:05:04'),
(10, 1, 'Yang tak pernah menjadi nyata', 'Teruntuk seseorang yang tak pernah menjadi nyata\r\nManusia yang sudah lama tidak berkabar, kau di mana sekarang? Sedang apa? Apa kau bahagia dengan pilihanmu? Aku berdoa semoga kau bahagia, selalu. Di malam tertentu aku berbaring di tempat tidur sembari sadar bahwa kita sudah lama tidak saling bertemu, tidak saling bertegur, dan bahkan tidak saling berkabar, lebih parahnya lagi tidak saling melihat satu sama lain, kita sudah terlalu jauh, sangat teramat jauh. Kau adalah manusia paling indah yang pernah aku lihat juga paling menyakitkan yang pernah aku rasa. Menyedihkan sekali ketika kau membuat aku sangat bahagia sekaligus terluka. Sempurna sekali, seperti dirimu. Bolehkah aku berharap bahwa kita akan kembali bersama? Aku rindu.\r\nKau tahu, aku tersenyum ketika mengingatmu, mengingat bahwa kita pernah tersenyum di atas motor berdua, mengingat bahwa kau dulu sangat peduli aku, mengingat bahwa kau dan aku dulu begitu dekat. Sekarat aku kehilanganmu, kapan kau kembali? Kembali mencintai aku seperti dulu? Atau dulu kau tak pernah mencintaiku? Aku ingin menceritakan lebih banyak tentangmu, izinkan aku. Aku rasa manusia seindah dirimu memang harus diabadikan, walaupun kau adalah pemberi luka yang paling dalam. Tapi aku selalu ingin menceritakan semua tentangmu, melalui ketikan ini, melalui malam-malam sepi yang aku lalui. Beruntung sekali dulu aku pernah mengenalmu, manusia pemberi pelajaran hidup paling manis juga luka paling pahit. Aku ingin selalu mengenangmu, selamanya, selama-lamanya.\r\nKau adalah manusia yang tak pernah menjadi kenyataan, kenyataan untuk dimiliki. Kau terlalu mustahil untuk digapai, kau terlalu tinggi untuk aku daki. Namun, aku akan selalu menyukai semua tentangmu, senyummu, tawamu, sedihmu, sukamu, juga bahagiamu. Aku selalu menyukainya, aku selalu rindu terhadap semuanya. Semua tentangmu. Suatu hari, aku bermimpi ingin membuat buku yang didalamnya berisi semua tentangmu, tentang manusia yang paling indah yang pernah aku kenal. Doakan aku semoga mimpiku kesampaian. Dan diantara hal-hal yang paling menyakitkan di dunia ini, yang paling menyedihkan adalah ketika aku harus kehilangan manusia terindah sepertimu, kau tak akan bisa dijelaskan dengan kata-kata. Kau lebih indah daripada itu, terlalu indah. Sungguh. Semoga aku kuat, semoga aku ikhlas, dan semoga aku bisa melupakanmu.\r\nTapi kenapa tuhan? Kenapa di kehidupan yang cuma satu kali ini aku tidak bisa memiliki manusia terindah sepertinya. Kenapa tuhan? Aku ingin menjadi alasannya bahagia, aku ingin menjadi sesuatu yang paling berharga di hidupnya. Tapi lagi-lagi kenyataan menyadarkan bahwa itu tidak akan pernah mungkin, bahwa itu tidak akan pernah menjadi nyata. Mungkin memang sudah jalannya begini, mau tidak mau, suka tidak suka, dia hanya sesorang pemberi pelajaran yang paling berharga dalam hidup ini. Dan setelah lama tidak melihatmu, tuhan mempertemukan kita kembali. Kau nampak sudah jauh berbeda, kau nampak sudah sangat jauh bertumbuh. Semakin cantik, semakin indah. Senang sekali melihatmu bahagia seperti itu. Kau sangat bahagia sekarang, bersama pilihanmu. Aku sakit, tapi aku bahagia ketika melihatmu bahagia juga. Kini tak ada kesempatan lagi untukku memilikimu sekarang, benar bahwa cinta bukan hanya soal kepemilikan saja, cinta lebih daripada itu. Melihat dia bahagia dengan pilihannya juga termasuk cinta kan?\r\nUntukmu, tolong sehat selalu, tolong bahagia selalu, tolong bertumbuh selalu, tolong. Aku selalu ingin melihatmu baik-baik saja. Aku selalu ingin melihatmu tersenyum manis, senyummu, tawamu sudah cukup membuat aku merasa bahwa cintaku baik-baik saja. Sekalipun aku tidak baik-baik karena kehilanganmu, karena tak lagi bersamamu. Tapi tak apa, tak usah pedulikan aku, aku hanyalah manusia yang sendirian tanpa arah, tanpa harapan setelah berpisah denganmu. Tolong bahagia selalu, aku mengetik tulisan ini hanya untukmu, hanya karenamu, hanya karena aku selalu ingin mengenangmu, juga menceritakanmu kepada dunia, bahwa aku mencintai seseorang yang paling terindah di dunia. Perlu kau tau, dari miliaran manusia di dunia ini, aku memilih kamu. Sekalipun kau tak memilih aku.\r\nDariku, ghozialgfr.\r\nGhozi al gifari, seorang mahasiswa teknik informatika yang sedang belajar mengabadikan perasaan melalui aksara, ia percaya bahwa mencintai tidak harus memiliki, tapi tentang menghargai setiap kenangan yang ada. Saat ini ia sedang suka menulis di sela-sela kesibukannya. ', '6a574deba6ecb.jpeg', '2026-07-15 16:07:55', '2026-07-15 16:09:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `foto`, `password`) VALUES
(1, 'ghozialgfr', 'Ghozi Al Gifari', '6a571a8378e4f.jpg', '$2y$10$6AnAWTSfjVyOl9BtPN8TOeK4kQOvCfrvZEtFlCogPNFuSd2QLdmP.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
