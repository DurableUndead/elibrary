-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 06:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elibrary_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `created_at`, `pin`) VALUES
(18, 'Alfiansyah Achmad', 'admin@admin.com', '$2y$10$.rUwmfiSCtgOgm7DXl0KE.EgDf9o7i8iM12Sxo5dWXybEBYK9/FNW', '2023-06-18 12:03:12', 123123),
(22, 'Alfiansyah Achmad 2', 'kulkas123@gmail.com', '$2y$10$VNgQ24V02l/hk5.v44Ex5eaG7D.TdgsL.YTnMQmm71E3vLa4H9ypG', '2023-06-27 00:34:04', 123123);

-- --------------------------------------------------------

--
-- Table structure for table `admin_token`
--

CREATE TABLE `admin_token` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `auth_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `jumlah_buku` int(11) NOT NULL,
  `gambar_buku` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `kategori`, `jumlah_buku`, `gambar_buku`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 'asd2', 'asd3', 2004, 'Sains', 33, 'asd1asd11687162155_86b7da71740010eaf79f.jpg'),
(4, 'Sepeda', 'asdasd', 'asdasd', 2003, 'Sains', 20, 'SepedaSepeda1687335238_103ecbf55eb91f673d78.jpg'),
(5, 'Sepeda2', 'asdasd', 'asdasd', 2003, 'Matematika', 25, 'SepedaSepeda1687337971_767ab231dd32796ae0e8.jpg'),
(6, 'Sepeda3', 'asdasd', 'asdasd', 2003, 'Sains', 10, 'SepedaSepeda1687338468_8c048839a1c511fa0d27.jpg'),
(17, 'asd123', 'asd123', 'asd123', 1111111111, 'asd123', 109, 'default.jpg'),
(18, 'asdasdasd', 'asdasdasd', 'asdasdasd', 2012, 'Sains', 123123121, 'asdasdasdasdasdasd1687531293_ac32b9cfb1894fba21ce.jpg'),
(19, 'wowo', 'wowo', 'wowo', 22, 'Matematika', 1, 'wowowowo1687155703_078c357b1d5883d45315.jpg'),
(20, 'asd2', 'asd', 'asd', 2004, 'asd', 122, 'default.jpg'),
(22, 'baru12', 'baru12', 'baru12', 2022, 'Matematika', 1200, 'baru12baru121687920058_3ad660a47590cc5def0c.png');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_murid`
--

CREATE TABLE `daftar_murid` (
  `id` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `kelompok_kelas` varchar(1) DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `wali_kelas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_murid`
--

INSERT INTO `daftar_murid` (`id`, `nisn`, `nama`, `kelas`, `kelompok_kelas`, `jenis_kelamin`, `tanggal_lahir`, `wali_kelas`) VALUES
(1, '1231231231', 'John Doeaaea', '1', 'D', 'P', '2008-01-28', 'Bapak Agusaeaaa'),
(2, '987654321', 'Jane Smith', '2', 'B', 'P', '2006-03-15', 'Ibu Lisa'),
(3, '654321987', 'Michael Johnson', '3', 'C', 'L', '2004-07-20', 'Bapak Rahman'),
(4, '123456789', 'John Doe', '1', 'A', 'L', '2005-01-01', 'Bapak Agus'),
(5, '987654321', 'Jane Smith', '2', 'B', 'P', '2006-03-15', 'Ibu Lisa'),
(7, '111222333', 'Emily Davis', '1', 'D', 'P', '2005-09-12', 'Ibu Maria'),
(8, '444555666', 'Andrew Wilson', '2', 'E', 'L', '2006-05-30', 'Bapak Joko'),
(9, '777888999', 'Jessica Brown', '1', 'F', 'P', '2004-11-02', 'Ibu Siti'),
(10, '222333444', 'David Miller', '2', 'G', 'L', '2005-04-17', 'Bapak Rudi'),
(11, '555666777', 'Sophia Johnson', '2', 'H', 'P', '2006-07-09', 'Ibu Indah'),
(12, '888999000', 'Michael Wilson', '3', 'I', 'L', '2004-12-25', 'Bapak Surya'),
(13, '333444555', 'Olivia Davis', '1', 'H', 'P', '2005-02-28', 'Ibu Anita'),
(14, '666777888', 'James Smith', '2', 'G', 'L', '2006-06-15', 'Bapak Adi'),
(15, '999000111', 'Emma Johnson', '3', 'F', 'P', '2004-09-20', 'Ibu Maya'),
(16, '444333222', 'Ava Wilson', '1', 'D', 'P', '2005-07-13', 'Ibu Rina'),
(17, '777666555', 'Matthew Brown', '2', 'E', 'L', '2006-01-26', 'Bapak Samsul'),
(18, '222111000', 'Isabella Davis', '3', 'E', 'P', '2004-10-10', 'Ibu Yanti'),
(19, '555444333', 'Daniel Wilson', '1', 'F', 'L', '2005-03-25', 'Bapak Rahmat'),
(20, '8887776661', 'Mia Johnsons', '3', 'F', 'L', '2006-08-08', 'Ibu Rikas'),
(21, '333222111', 'Sophia Miller', '2', 'C', 'P', '2004-12-11', 'Ibu Desi'),
(22, '666555444', 'Liam Smith', '1', 'B', 'L', '2005-06-18', 'Bapak Dodi'),
(29, '1111111111', 'awww', '3', 'F', 'L', '2004-05-28', 'adddddddddd');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id`, `nama_kategori`) VALUES
(3, 'Sains'),
(4, 'Matematika'),
(5, 'Agama'),
(8, 'Bahasa Indonesia'),
(9, 'Bahasa Inggris'),
(10, 'IPA (Ilmu Pengetahuan Alam)'),
(11, 'IPS (Ilmu Pengetahuan Sosial)'),
(12, 'Pendidikan Agama'),
(13, 'Pendidikan Kewarganegaraan'),
(14, 'Seni Budaya'),
(15, 'Pendidikan Jasmani'),
(16, 'Sejarah'),
(17, 'Geografi'),
(18, 'Ekonomi'),
(19, 'Sosiologi'),
(20, 'Fisika'),
(21, 'Kimia'),
(22, 'Biologi'),
(23, 'Ekonomi Islam'),
(24, 'Akuntansi'),
(25, 'Manajemen Bisnis'),
(26, 'Komputer dan Informatika'),
(27, 'Pemrograman'),
(28, 'Kewirausahaan'),
(29, 'Teknik Mesin'),
(30, 'Teknik Sipil'),
(31, 'Teknik Elektro'),
(32, 'Farmasi'),
(33, 'Kedokteran'),
(34, 'Psikologi'),
(35, 'Antropologi'),
(36, 'Ilmu Politik'),
(37, 'Sastra Indonesia'),
(38, 'Sastra Inggris'),
(39, 'Kewarganegaraan'),
(40, 'Bahasa Jepang'),
(41, 'Bahasa Mandarin'),
(42, 'Sosiologi'),
(43, 'Geografi'),
(44, 'Seni Rupa'),
(45, 'Seni Musik'),
(46, 'Seni Tari'),
(47, 'Kewirausahaan'),
(48, 'Pendidikan Pancasila'),
(49, 'Kalkulus'),
(50, 'Aljabar'),
(51, 'Statistika'),
(52, 'Biokimia'),
(53, 'Genetika'),
(54, 'Mikrobiologi'),
(55, 'Pendidikan Kewarganegaraan'),
(56, 'Fisika'),
(57, 'Kimia'),
(58, 'Biologi'),
(59, 'Ekonomi'),
(60, 'Akuntansi'),
(61, 'Sejarah'),
(62, 'Geografi'),
(63, 'Sosiologi'),
(64, 'Pemrograman'),
(65, 'Teknik Sipil'),
(66, 'Teknik Elektro'),
(67, 'Psikologi'),
(68, 'Sastra'),
(69, 'Hukum'),
(70, 'Ilmu Politik'),
(71, 'Farmasi');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_buku`
--

CREATE TABLE `peminjaman_buku` (
  `id` int(11) NOT NULL,
  `nama_admin_peminjam_buku` varchar(255) NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `kelas_peminjam` varchar(255) NOT NULL,
  `kelompok_kelas_peminjam` varchar(255) NOT NULL,
  `buku_dipinjam` varchar(255) NOT NULL,
  `jumlah_buku_dipinjam` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `gambar_buku_dipinjam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman_buku`
--

INSERT INTO `peminjaman_buku` (`id`, `nama_admin_peminjam_buku`, `nama_peminjam`, `kelas_peminjam`, `kelompok_kelas_peminjam`, `buku_dipinjam`, `jumlah_buku_dipinjam`, `tanggal_peminjaman`, `gambar_buku_dipinjam`) VALUES
(11, 'Alfiansyah Achmad', 'Jessica Brown', '1', 'F', 'baru12', 34, '2023-06-29', ''),
(12, 'Alfiansyah Achmad', 'Michael Johnson', '3', 'C', 'wowo', 1, '2023-06-12', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian_buku`
--

CREATE TABLE `pengembalian_buku` (
  `id` int(11) NOT NULL,
  `nama_admin_penerima_buku` varchar(255) DEFAULT NULL,
  `nama_pengembali` varchar(255) DEFAULT NULL,
  `kelas_pengembali` varchar(255) DEFAULT NULL,
  `kelompok_kelas_pengembali` varchar(255) DEFAULT NULL,
  `nama_buku_dikembalikan` varchar(255) DEFAULT NULL,
  `jumlah_buku_dipinjamkan` int(11) DEFAULT NULL,
  `jumlah_buku_dikembalikan` int(11) DEFAULT NULL,
  `tanggal_peminjaman_buku` date NOT NULL,
  `tanggal_pengembalian_buku` date DEFAULT NULL,
  `gambar_buku_dikembalikan` varchar(255) DEFAULT NULL,
  `status_buku` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian_buku`
--

INSERT INTO `pengembalian_buku` (`id`, `nama_admin_penerima_buku`, `nama_pengembali`, `kelas_pengembali`, `kelompok_kelas_pengembali`, `nama_buku_dikembalikan`, `jumlah_buku_dipinjamkan`, `jumlah_buku_dikembalikan`, `tanggal_peminjaman_buku`, `tanggal_pengembalian_buku`, `gambar_buku_dikembalikan`, `status_buku`) VALUES
(1, 'Alfiansyah Achmad', 'John Doeaaea', 'Kelas 1', 'D', 'Sepeda', 1, 1, '2020-01-20', '2023-06-25', NULL, 'Lunas'),
(2, 'Alfiansyah Achmad', 'John Doe', 'Kelas 1', 'A', 'asd2', 100, 100, '2023-05-25', '2023-06-25', NULL, 'Lunas'),
(3, 'Alfiansyah Achmad', 'Andrew Wilson', 'Kelas 2', 'E', 'Sepeda3', 15, 2, '2023-06-22', '2023-06-26', NULL, 'Belum Lunas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_token`
--
ALTER TABLE `admin_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`admin_id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_murid`
--
ALTER TABLE `daftar_murid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengembalian_buku`
--
ALTER TABLE `pengembalian_buku`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `admin_token`
--
ALTER TABLE `admin_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `daftar_murid`
--
ALTER TABLE `daftar_murid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengembalian_buku`
--
ALTER TABLE `pengembalian_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_token`
--
ALTER TABLE `admin_token`
  ADD CONSTRAINT `admin_token_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
