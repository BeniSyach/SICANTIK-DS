-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jan 2023 pada 10.32
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cari_surat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_surat`
--

CREATE TABLE `tb_surat` (
  `id` int(11) NOT NULL,
  `unit_kerja_id` int(11) NOT NULL,
  `jenis_naskah_id` int(11) NOT NULL,
  `sifat_naskah_id` int(11) NOT NULL,
  `tingkat_urgensi_id` int(11) NOT NULL,
  `klasifikasi_id` int(11) NOT NULL,
  `nomor_naskah` varchar(100) NOT NULL,
  `hal` varchar(100) NOT NULL,
  `file_naskah` varchar(100) NOT NULL,
  `lampiran_naskah` varchar(100) DEFAULT NULL,
  `tanggal_naskah` date NOT NULL,
  `tujuan_naskah` varchar(100) NOT NULL,
  `tujuan_utama_id` int(11) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_surat`
--

INSERT INTO `tb_surat` (`id`, `unit_kerja_id`, `jenis_naskah_id`, `sifat_naskah_id`, `tingkat_urgensi_id`, `klasifikasi_id`, `nomor_naskah`, `hal`, `file_naskah`, `lampiran_naskah`, `tanggal_naskah`, `tujuan_naskah`, `tujuan_utama_id`, `bidang_id`, `user_id`) VALUES
(46, 1, 1, 1, 1, 1, '343', 'profil desa', 'PROFIL_DESA_MULIOREJO_2022.pdf', 'PROFIL_DESA_MULIOREJO_2022.pdf', '2023-01-17', 'Desa Mulio Rejo', 1, 3, 1),
(47, 1, 1, 1, 1, 1, '1', 'profil desa', 'PROFIL_DESA_MULIOREJO_2022.pdf', NULL, '2023-01-18', 'Desa Mulio Rejo', 1, 1, 2),
(48, 1, 1, 1, 1, 1, '1', 'profil desa', 'PROFIL_DESA_MULIOREJO_2022.pdf', NULL, '2023-01-18', 'Desa Mulio Rejo', 1, 1, 1),
(49, 1, 1, 1, 1, 1, '343', 'profil desa', 'PROFIL_DESA_MULIOREJO_2022.pdf', 'cropped-logo-kominfo.png', '2023-01-18', 'Desa Mulio Rejo', 1, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_surat`
--
ALTER TABLE `tb_surat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_surat`
--
ALTER TABLE `tb_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
