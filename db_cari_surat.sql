-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2023 pada 10.37
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
-- Struktur dari tabel `tb_bidang`
--

CREATE TABLE `tb_bidang` (
  `id_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_bidang`
--

INSERT INTO `tb_bidang` (`id_bidang`, `nama_bidang`) VALUES
(1, 'Bidang TIK dan Persandian'),
(2, 'Bidang Statistik'),
(3, 'Bidang Informasi Komunikasi Publik'),
(4, 'Bidang Layanan SPBE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_naskah`
--

CREATE TABLE `tb_jenis_naskah` (
  `id_jenis_naskah` int(11) NOT NULL,
  `jenis_naskah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_jenis_naskah`
--

INSERT INTO `tb_jenis_naskah` (`id_jenis_naskah`, `jenis_naskah`) VALUES
(1, 'Memo'),
(2, 'Notulen'),
(3, 'Undangan'),
(4, 'SPT'),
(5, 'Bimtek'),
(6, 'Surat Keputusan'),
(7, 'Surat Biasa'),
(8, 'Daftar Hadir'),
(9, 'Surat Tanda Tamat Pendidikan dan Pelatihan (STTPP)'),
(10, 'Sertifikat'),
(11, 'Piagam'),
(12, 'Berita Acara'),
(13, 'Berita Daerah'),
(14, 'Lembaran Daerah'),
(15, 'Telegram'),
(16, 'Surat Pengantar'),
(17, 'Rekomendasi'),
(18, 'Laporan'),
(19, 'Pengumuman'),
(20, 'Telaah Staf'),
(21, 'Lembar Disposisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_klasifikasi`
--

CREATE TABLE `tb_klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL,
  `nama_klasifikasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_klasifikasi`
--

INSERT INTO `tb_klasifikasi` (`id_klasifikasi`, `nama_klasifikasi`) VALUES
(1, 'Biasa'),
(2, 'Rahasia'),
(3, 'Terbatas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pendata_tangan`
--

CREATE TABLE `tb_pendata_tangan` (
  `id_tanda_tangan` int(11) NOT NULL,
  `nama_tanda_tangan` varchar(100) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `golongan` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pendata_tangan`
--

INSERT INTO `tb_pendata_tangan` (`id_tanda_tangan`, `nama_tanda_tangan`, `nip`, `jabatan`, `golongan`, `gambar`) VALUES
(1, 'Dr Dra MISKA GEWASARI MM', '197208191997022002', 'KEPALA DINAS KOMUNIKASI, INFORMATIKA, STATISTIK, DAN PERSANDIAN DELI SERDANG', 'IV/C', 'bu_Kadis.png'),
(2, '', '', '', '', 'Screenshot_20230111_164829.png'),
(3, '', '', '', '', 'Screenshot_20230111_164829.png'),
(4, 'Pak Kabid', '123456789', 'Kepala Bidang', 'III/B', 'cropped-logo-kominfo.png'),
(5, 'Kasi', '123456789', 'Kepala Seksi', 'III/C', 'cropped-logo-kominfo.png'),
(6, 'Kasi', '123456789', 'Kepala Seksi', 'III/C', 'cropped-logo-kominfo.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sifat_naskah`
--

CREATE TABLE `tb_sifat_naskah` (
  `id_sifat_naskah` int(11) NOT NULL,
  `sifat_naskah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_sifat_naskah`
--

INSERT INTO `tb_sifat_naskah` (`id_sifat_naskah`, `sifat_naskah`) VALUES
(1, 'Biasa'),
(2, 'Rahasia'),
(3, 'Penting');

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
  `lampiran_naskah` varchar(100) NOT NULL,
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
(45, 1, 1, 2, 1, 1, '001', 'profil desa', 'PROFIL_DESA_MULIOREJO_2022.pdf', 'PROFIL_DESA_MULIOREJO_2022.pdf', '2023-01-17', 'Desa Mulio Rejo', 1, 1, 1),
(46, 1, 1, 1, 1, 1, '343', 'profil desa', 'PROFIL_DESA_MULIOREJO_2022.pdf', 'PROFIL_DESA_MULIOREJO_2022.pdf', '2023-01-17', 'Desa Mulio Rejo', 1, 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tingkat_urgensi`
--

CREATE TABLE `tb_tingkat_urgensi` (
  `id_tingkat_urgensi` int(11) NOT NULL,
  `tingkat_urgensi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_tingkat_urgensi`
--

INSERT INTO `tb_tingkat_urgensi` (`id_tingkat_urgensi`, `tingkat_urgensi`) VALUES
(1, 'Segera'),
(2, 'Penting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit_kerja`
--

CREATE TABLE `tb_unit_kerja` (
  `id_unit_kerja` int(11) NOT NULL,
  `nama_unit_kerja` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_unit_kerja`
--

INSERT INTO `tb_unit_kerja` (`id_unit_kerja`, `nama_unit_kerja`) VALUES
(1, 'Dinas Komunikasi, Informatika, Statistik, Dan Persandian Deli Serdang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `bidang_id`, `created_at`) VALUES
(1, 'admin_surat_keluar', 'surat_keluards!!', 1, '2023-01-01'),
(2, 'citra.kominfostan.ds', 'nkrikeren', 1, '2023-01-17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_bidang`
--
ALTER TABLE `tb_bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indeks untuk tabel `tb_jenis_naskah`
--
ALTER TABLE `tb_jenis_naskah`
  ADD PRIMARY KEY (`id_jenis_naskah`);

--
-- Indeks untuk tabel `tb_klasifikasi`
--
ALTER TABLE `tb_klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indeks untuk tabel `tb_pendata_tangan`
--
ALTER TABLE `tb_pendata_tangan`
  ADD PRIMARY KEY (`id_tanda_tangan`);

--
-- Indeks untuk tabel `tb_sifat_naskah`
--
ALTER TABLE `tb_sifat_naskah`
  ADD PRIMARY KEY (`id_sifat_naskah`);

--
-- Indeks untuk tabel `tb_surat`
--
ALTER TABLE `tb_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_tingkat_urgensi`
--
ALTER TABLE `tb_tingkat_urgensi`
  ADD PRIMARY KEY (`id_tingkat_urgensi`);

--
-- Indeks untuk tabel `tb_unit_kerja`
--
ALTER TABLE `tb_unit_kerja`
  ADD PRIMARY KEY (`id_unit_kerja`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_bidang`
--
ALTER TABLE `tb_bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_jenis_naskah`
--
ALTER TABLE `tb_jenis_naskah`
  MODIFY `id_jenis_naskah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_klasifikasi`
--
ALTER TABLE `tb_klasifikasi`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pendata_tangan`
--
ALTER TABLE `tb_pendata_tangan`
  MODIFY `id_tanda_tangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_sifat_naskah`
--
ALTER TABLE `tb_sifat_naskah`
  MODIFY `id_sifat_naskah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_surat`
--
ALTER TABLE `tb_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tb_tingkat_urgensi`
--
ALTER TABLE `tb_tingkat_urgensi`
  MODIFY `id_tingkat_urgensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_unit_kerja`
--
ALTER TABLE `tb_unit_kerja`
  MODIFY `id_unit_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
