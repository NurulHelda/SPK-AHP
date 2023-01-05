-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21 Okt 2022 pada 03.59
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spk_ahp_ci`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE IF NOT EXISTS `alternatif` (
`id_alternatif` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama`) VALUES
(1, 'Alternatif 1'),
(2, 'Alternatif 2'),
(3, 'Alternatif 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE IF NOT EXISTS `hasil` (
`id_hasil` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_alternatif`, `nilai`) VALUES
(1, 1, 0.548386),
(2, 2, 0.446808),
(3, 3, 0.602751);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
`id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `kode_kriteria` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `kode_kriteria`) VALUES
(1, 'Kemampuan Nasabah', 'C1'),
(2, 'Nilai Jaminan', 'C2'),
(3, 'Sumber Pelunasan Nasabah ', 'C3'),
(4, 'Legalitas Usaha', 'C4'),
(5, 'Karakter Nasabah', 'C5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_hasil`
--

CREATE TABLE IF NOT EXISTS `kriteria_hasil` (
`id_kriteria_hasil` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria_hasil`
--

INSERT INTO `kriteria_hasil` (`id_kriteria_hasil`, `id_kriteria`, `nilai`) VALUES
(1, 1, 0.339477),
(2, 2, 0.239739),
(3, 3, 0.184183),
(4, 4, 0.14085),
(5, 5, 0.0957516);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_nilai`
--

CREATE TABLE IF NOT EXISTS `kriteria_nilai` (
`id_kriteria_nilai` int(11) NOT NULL,
  `kriteria_id_dari` int(11) NOT NULL,
  `kriteria_id_tujuan` int(11) NOT NULL,
  `nilai` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria_nilai`
--

INSERT INTO `kriteria_nilai` (`id_kriteria_nilai`, `kriteria_id_dari`, `kriteria_id_tujuan`, `nilai`) VALUES
(21, 1, 2, 2),
(22, 1, 3, 2),
(23, 1, 4, 2),
(24, 1, 5, 3),
(25, 2, 3, 2),
(26, 2, 4, 2),
(27, 2, 5, 2),
(28, 3, 4, 2),
(29, 3, 5, 2),
(30, 4, 5, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_kategori`
--

CREATE TABLE IF NOT EXISTS `nilai_kategori` (
`id_nilai` int(11) NOT NULL,
  `nama_nilai` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_kategori`
--

INSERT INTO `nilai_kategori` (`id_nilai`, `nama_nilai`) VALUES
(1, 'Sangat Baik'),
(2, 'Baik'),
(3, 'Cukup'),
(4, 'Kurang'),
(5, 'Sangat Kurang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE IF NOT EXISTS `penilaian` (
`id_penilaian` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_sub_kriteria` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_alternatif`, `id_kriteria`, `id_sub_kriteria`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 7),
(3, 1, 3, 13),
(4, 1, 4, 19),
(5, 1, 5, 23),
(6, 2, 1, 3),
(7, 2, 2, 8),
(8, 2, 3, 12),
(9, 2, 4, 20),
(10, 2, 5, 24),
(11, 3, 1, 2),
(12, 3, 2, 7),
(13, 3, 3, 13),
(14, 3, 4, 19),
(15, 3, 5, 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria_nilai`
--

CREATE TABLE IF NOT EXISTS `subkriteria_nilai` (
`id_subkriteria_nilai` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `subkriteria_id_dari` int(11) NOT NULL,
  `subkriteria_id_tujuan` int(11) NOT NULL,
  `nilai` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subkriteria_nilai`
--

INSERT INTO `subkriteria_nilai` (`id_subkriteria_nilai`, `id_kriteria`, `subkriteria_id_dari`, `subkriteria_id_tujuan`, `nilai`) VALUES
(41, 1, 1, 2, 2),
(42, 1, 1, 3, 2),
(43, 1, 1, 4, 3),
(44, 1, 1, 5, 5),
(45, 1, 2, 3, 2),
(46, 1, 2, 4, 2),
(47, 1, 2, 5, 3),
(48, 1, 3, 4, 2),
(49, 1, 3, 5, 2),
(50, 1, 4, 5, 2),
(51, 2, 6, 7, 2),
(52, 2, 6, 8, 3),
(53, 2, 6, 9, 2),
(54, 2, 6, 10, 5),
(55, 2, 7, 8, 2),
(56, 2, 7, 9, 3),
(57, 2, 7, 10, 2),
(58, 2, 8, 9, 2),
(59, 2, 8, 10, 3),
(60, 2, 9, 10, 2),
(61, 3, 11, 12, 2),
(62, 3, 11, 13, 2),
(63, 3, 11, 14, 3),
(64, 3, 11, 15, 3),
(65, 3, 12, 13, 2),
(66, 3, 12, 14, 2),
(67, 3, 12, 15, 3),
(68, 3, 13, 14, 2),
(69, 3, 13, 15, 2),
(70, 3, 14, 15, 2),
(71, 4, 16, 17, 2),
(72, 4, 16, 18, 2),
(73, 4, 16, 19, 3),
(74, 4, 16, 20, 4),
(75, 4, 17, 18, 2),
(76, 4, 17, 19, 2),
(77, 4, 17, 20, 3),
(78, 4, 18, 19, 2),
(79, 4, 18, 20, 2),
(80, 4, 19, 20, 2),
(81, 5, 21, 22, 2),
(82, 5, 21, 23, 3),
(83, 5, 21, 24, 3),
(84, 5, 21, 25, 4),
(85, 5, 22, 23, 2),
(86, 5, 22, 24, 3),
(87, 5, 22, 25, 3),
(88, 5, 23, 24, 2),
(89, 5, 23, 25, 3),
(90, 5, 24, 25, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria`
--

CREATE TABLE IF NOT EXISTS `sub_kriteria` (
`id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_sub_kriteria` text NOT NULL,
  `id_nilai` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `nama_sub_kriteria`, `id_nilai`) VALUES
(1, 1, 'Lebih dari Rp.12.100.000 / bulan', 1),
(2, 1, 'Rp. 9.100.000 - Rp. 12.000.000 / bulan ', 2),
(3, 1, 'Rp. 7.100.000 - Rp. 9.000.000 /bulan', 3),
(4, 1, 'Rp. 5.100.000 - Rp. 7.000.000 /bulan', 4),
(5, 1, 'Rp. 2.000.000 - Rp. 5.000.000 / bulan ', 5),
(6, 2, 'Sertifikat-sertifikat (Tanah, Bangunan, Rumah, dll), Emas (sesuai kadarnya)', 1),
(7, 2, 'Surat berharga (Deposito, Tabungan dll), Emas (sesuai kadarnya) ', 2),
(8, 2, 'Kendaraan bermotor (Surat BPKB), Emas (sesuai kadarnya) ', 3),
(9, 2, 'Emas (sesuai kadarnya) ', 4),
(10, 2, 'Tidak ada', 5),
(11, 3, 'Berbadan hukum penuh ', 1),
(12, 3, 'Ada ijin usaha ', 2),
(13, 3, 'Absah dan masih dalam masa berlaku', 3),
(14, 3, 'Dalam pendirian ', 4),
(15, 3, 'Tidak ada ', 5),
(16, 4, ' Sangat Lancar (untuk nasabah yang baru mengajukan pinjaman atau belum pernah mengajukan pinjaman lain di Bank manapun dan untuk pengembalian pinjaman rutin setiap bulan atau menunggak 1 bulan) ', 1),
(17, 4, 'Lancar (pengembalian pinjaman rutin setiap bulan atau terlambat 1 bulan)', 2),
(18, 4, 'Kurang Lancar (pengembalian pinjaman terlambat 2-3 bulan) ', 3),
(19, 4, 'Dalam Perhatian Khusus (pengembalian pinjaman terlambat 2-3 bulan)', 4),
(20, 4, 'Kredit Macet Nasabah (pengembalian pinjaman terlambat 6 bulan/black list) ', 5),
(21, 5, 'Amanah', 1),
(22, 5, 'Jujur dan Tanggung Jawab', 2),
(23, 5, 'Ulet dan Pantang Menyerah ', 3),
(24, 5, 'Kreatif', 4),
(25, 5, 'Lain-lain ', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria_hasil`
--

CREATE TABLE IF NOT EXISTS `sub_kriteria_hasil` (
`id_sub_kriteria_hasil` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_sub_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_kriteria_hasil`
--

INSERT INTO `sub_kriteria_hasil` (`id_sub_kriteria_hasil`, `id_kriteria`, `id_sub_kriteria`, `nilai`) VALUES
(66, 1, 1, 1),
(67, 1, 2, 0.636964),
(68, 1, 3, 0.450693),
(69, 1, 4, 0.312267),
(70, 1, 5, 0.194561),
(71, 2, 6, 1),
(72, 2, 7, 0.640979),
(73, 2, 8, 0.448707),
(74, 2, 9, 0.323179),
(75, 2, 10, 0.197816),
(76, 3, 11, 1),
(77, 3, 12, 0.701529),
(78, 3, 13, 0.493814),
(79, 3, 14, 0.347073),
(80, 3, 15, 0.242261),
(81, 4, 16, 1),
(82, 4, 17, 0.665302),
(83, 4, 18, 0.469725),
(84, 4, 19, 0.327615),
(85, 4, 20, 0.21367),
(86, 5, 21, 1),
(87, 5, 22, 0.657434),
(88, 5, 23, 0.432228),
(89, 5, 24, 0.281251),
(90, 5, 25, 0.184933);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_user_level`, `nama`, `email`, `username`, `password`) VALUES
(1, 1, 'Admin', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(7, 2, 'User', 'user@gmail.com', 'user', 'ee11cbb19052e40b07aac0ca060c23ee');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
`id_user_level` int(11) NOT NULL,
  `user_level` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_level`
--

INSERT INTO `user_level` (`id_user_level`, `user_level`) VALUES
(1, 'Administrator'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
 ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
 ADD PRIMARY KEY (`id_hasil`), ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
 ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `kriteria_hasil`
--
ALTER TABLE `kriteria_hasil`
 ADD PRIMARY KEY (`id_kriteria_hasil`), ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `kriteria_nilai`
--
ALTER TABLE `kriteria_nilai`
 ADD PRIMARY KEY (`id_kriteria_nilai`), ADD KEY `kriteria_id_dari` (`kriteria_id_dari`), ADD KEY `kriteria_id_tujuan` (`kriteria_id_tujuan`);

--
-- Indexes for table `nilai_kategori`
--
ALTER TABLE `nilai_kategori`
 ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
 ADD PRIMARY KEY (`id_penilaian`), ADD KEY `id_alternatif` (`id_alternatif`), ADD KEY `id_kriteria` (`id_kriteria`), ADD KEY `id_sub_kriteria` (`id_sub_kriteria`);

--
-- Indexes for table `subkriteria_nilai`
--
ALTER TABLE `subkriteria_nilai`
 ADD PRIMARY KEY (`id_subkriteria_nilai`), ADD KEY `id_kriteria` (`id_kriteria`), ADD KEY `subkriteria_id_dari` (`subkriteria_id_dari`), ADD KEY `subkriteria_id_tujuan` (`subkriteria_id_tujuan`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
 ADD PRIMARY KEY (`id_sub_kriteria`), ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `sub_kriteria_hasil`
--
ALTER TABLE `sub_kriteria_hasil`
 ADD PRIMARY KEY (`id_sub_kriteria_hasil`), ADD KEY `id_kriteria` (`id_kriteria`), ADD KEY `id_sub_kriteria` (`id_sub_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`), ADD KEY `id_user_level` (`id_user_level`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
 ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kriteria_hasil`
--
ALTER TABLE `kriteria_hasil`
MODIFY `id_kriteria_hasil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kriteria_nilai`
--
ALTER TABLE `kriteria_nilai`
MODIFY `id_kriteria_nilai` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `nilai_kategori`
--
ALTER TABLE `nilai_kategori`
MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `subkriteria_nilai`
--
ALTER TABLE `subkriteria_nilai`
MODIFY `id_subkriteria_nilai` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `sub_kriteria_hasil`
--
ALTER TABLE `sub_kriteria_hasil`
MODIFY `id_sub_kriteria_hasil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kriteria_hasil`
--
ALTER TABLE `kriteria_hasil`
ADD CONSTRAINT `kriteria_hasil_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kriteria_nilai`
--
ALTER TABLE `kriteria_nilai`
ADD CONSTRAINT `kriteria_nilai_ibfk_1` FOREIGN KEY (`kriteria_id_dari`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `kriteria_nilai_ibfk_2` FOREIGN KEY (`kriteria_id_tujuan`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `subkriteria_nilai`
--
ALTER TABLE `subkriteria_nilai`
ADD CONSTRAINT `subkriteria_nilai_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `subkriteria_nilai_ibfk_2` FOREIGN KEY (`subkriteria_id_dari`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `subkriteria_nilai_ibfk_3` FOREIGN KEY (`subkriteria_id_tujuan`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kriteria_hasil`
--
ALTER TABLE `sub_kriteria_hasil`
ADD CONSTRAINT `sub_kriteria_hasil_nilai_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `sub_kriteria_hasil_nilai_ibfk_2` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_user_level`) REFERENCES `user_level` (`id_user_level`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
