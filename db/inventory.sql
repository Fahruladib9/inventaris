-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221031.25fe766a26
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 07:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barangKeluar` int(11) NOT NULL,
  `kode_transaksi` varchar(250) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `jumlah` int(60) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barangKeluar`, `kode_transaksi`, `nama_barang`, `jumlah`, `keterangan`, `tanggal`) VALUES
(9, 'TRK001', 'Meja', 3, 'Rusak ', '2023-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barangMasuk` int(11) NOT NULL,
  `kode_transaksi` varchar(250) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `suplier` varchar(250) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barangMasuk`, `kode_transaksi`, `nama_barang`, `suplier`, `jumlah`, `tanggal`) VALUES
(22, 'TRM001', 'Gitar', 'PT. Tiga Saudara', '9', '2023-07-01'),
(23, 'TRM002', 'P3K', 'PT. Maju Mundur', '7', '2023-07-01'),
(24, 'TRM003', 'Kursi', 'PT. Tiga Saudara', '104', '2023-06-27'),
(25, 'TRM004', 'Bola Volly', 'PT. Tiga Saudara', '10', '2023-06-27'),
(26, 'TRM005', 'Meja', 'PT. Tiga Saudara', '320', '2023-06-25'),
(27, 'TRM006', 'Speaker', 'PT. Maju Mundur', '5', '2023-07-10'),
(28, 'TRM007', 'Komputer', 'PT. Tiga Saudara', '7', '2023-07-10'),
(29, 'TRM008', 'Printer', 'PT. Tiga Saudara', '3', '2023-07-10'),
(30, 'TRM009', 'pena', 'PT. Milenia Multi Prakarsa', '12', '2023-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang`
--

CREATE TABLE `stok_barang` (
  `id_stokBarang` int(11) NOT NULL,
  `kode_barang` varchar(250) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `jenis_barang` varchar(250) NOT NULL,
  `kondisi` varchar(250) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `jumlah_dipinjam` int(50) NOT NULL,
  `satuan` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_barang`
--

INSERT INTO `stok_barang` (`id_stokBarang`, `kode_barang`, `nama_barang`, `jenis_barang`, `kondisi`, `jumlah`, `jumlah_dipinjam`, `satuan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, 'BRG001', 'Printer', 'Elektronik', 'Rusak Ringan', 2, 1, 'Unit', '2023-06-14 08:47:27', '2023-08-06 22:11:16', NULL),
(21, 'BRG003', 'Komputer', 'Elektronik', 'Sangat Baik', 6, 1, 'Unit', '2023-06-14 08:49:30', '2023-08-15 11:04:26', NULL),
(22, 'BRG004', 'Speaker', 'Olahraga', 'Sangat Baik', 5, 0, 'Unit', '2023-06-14 08:50:37', '2023-07-10 08:23:06', NULL),
(23, 'BRG005', 'Meja', 'Peralatan Belajar', 'Sangat Baik', 317, 0, 'Unit', '2023-06-14 10:47:30', '2023-07-10 08:25:06', NULL),
(24, 'BRG006', 'Gitar', 'Musik', 'Baik', 3, 6, 'Unit', '2023-06-14 19:05:20', '2023-08-08 22:39:44', NULL),
(25, 'BRG007', 'Kursi', 'Peralatan Belajar', 'Sangat Baik', 100, 108, 'Unit', '2023-06-19 10:18:05', '2023-07-22 10:27:42', NULL),
(26, 'BRG008', 'Bola Volly', 'Olahraga', 'Sangat Baik', 10, 0, 'Unit', '2023-06-24 13:13:34', '2023-07-10 10:20:25', NULL),
(27, 'BRG009', 'P3K', 'Kesehatan', 'Sangat Baik', 7, 0, 'Unit', '2023-07-05 07:58:34', '2023-07-10 08:03:33', NULL),
(28, 'BRG010', 'pena', 'Peralatan Belajar', 'Baik', 0, 12, 'Pcs', '2023-08-16 11:09:17', '2023-08-16 11:11:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_datasuplier`
--

CREATE TABLE `_datasuplier` (
  `id_dataSuplier` int(11) NOT NULL,
  `suplier` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_datasuplier`
--

INSERT INTO `_datasuplier` (`id_dataSuplier`, `suplier`) VALUES
(1, 'PT. Maju Mundur'),
(5, 'PT. Milenia Multi Prakarsa');

-- --------------------------------------------------------

--
-- Table structure for table `_jenisbarang`
--

CREATE TABLE `_jenisbarang` (
  `id_jenisBarang` int(11) NOT NULL,
  `jenis_barang` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_jenisbarang`
--

INSERT INTO `_jenisbarang` (`id_jenisBarang`, `jenis_barang`) VALUES
(17, 'Olahraga'),
(18, 'Elektronik'),
(19, 'Kesehatan'),
(23, 'Musik'),
(24, 'Makanan'),
(25, 'Peralatan Belajar');

-- --------------------------------------------------------

--
-- Table structure for table `_kondisi`
--

CREATE TABLE `_kondisi` (
  `id_kondisi` int(11) NOT NULL,
  `kondisi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_kondisi`
--

INSERT INTO `_kondisi` (`id_kondisi`, `kondisi`) VALUES
(1, 'Sangat Baik'),
(2, 'Baik'),
(3, 'Rusak Ringan'),
(4, 'Rusak Berat');

-- --------------------------------------------------------

--
-- Table structure for table `_peminjaman`
--

CREATE TABLE `_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(50) NOT NULL,
  `id_stokBarang` int(11) NOT NULL,
  `nama_user` varchar(200) NOT NULL,
  `kode_peminjaman` varchar(250) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_peminjaman`
--

INSERT INTO `_peminjaman` (`id_peminjaman`, `id_user`, `id_stokBarang`, `nama_user`, `kode_peminjaman`, `nama_barang`, `jumlah`, `keterangan`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status`) VALUES
(27, 9, 26, 'Siti Daryani, S.Pd.SD', 'PBR001', 'Bola Volly', 1, 'praktik olahraga', '2023-07-10', '2023-07-10', 'dikembalikan'),
(28, 9, 24, 'Siti Daryani, S.Pd.SD', 'PBR002', 'Gitar', 3, 'mengajar musik', '2023-07-10', '2023-07-10', 'diterima'),
(29, 9, 25, 'Siti Daryani, S.Pd.SD', 'PBR003', 'Kursi', 4, 'test', '2023-07-22', '2023-07-23', 'diterima'),
(30, 9, 24, 'Siti Daryani, S.Pd.SD', 'PBR004', 'Gitar', 2, 'test', '2023-07-22', '2023-07-25', 'dikembalikan'),
(31, 9, 24, 'Siti Daryani, S.Pd.SD', 'PBR005', 'Gitar', 2, 'coba', '2023-07-22', '2023-07-24', 'diterima'),
(32, 4, 19, 'Feby Saputra', 'PBR006', 'Printer', 1, 'buat ngeprint', '2023-08-06', '2023-08-07', 'diterima'),
(33, 10, 24, 'izani', 'PBR007', 'Gitar', 1, 'belajar', '2023-08-08', '2023-08-11', 'diterima'),
(34, 11, 21, 'izzani ahlunadar', 'PBR008', 'Komputer', 1, 'bikin soal uas', '2023-08-15', '2023-08-16', 'diterima'),
(35, 4, 28, 'Feby Saputra', 'PBR009', 'pena', 12, 'asdasd', '2023-12-16', '2023-08-16', 'diterima');

-- --------------------------------------------------------

--
-- Table structure for table `_pengembalian`
--

CREATE TABLE `_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjaman` int(20) NOT NULL,
  `id_stokBarang` int(20) NOT NULL,
  `id_user` int(50) NOT NULL,
  `nama_user` varchar(250) NOT NULL,
  `kode_pengembalian` varchar(250) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_pengembalian`
--

INSERT INTO `_pengembalian` (`id_pengembalian`, `id_peminjaman`, `id_stokBarang`, `id_user`, `nama_user`, `kode_pengembalian`, `nama_barang`, `jumlah`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(18, 27, 26, 9, 'Siti Daryani, S.Pd.SD', 'KBR001', 'Bola Volly', 1, '2023-07-10 10:20:14', '2023-07-10 10:20:25', NULL, 'diterima'),
(19, 30, 24, 9, 'Siti Daryani, S.Pd.SD', 'KBR002', 'Gitar', 2, '2023-07-22 10:31:32', '2023-07-22 10:31:45', NULL, 'diterima');

-- --------------------------------------------------------

--
-- Table structure for table `_satuan`
--

CREATE TABLE `_satuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_satuan`
--

INSERT INTO `_satuan` (`id_satuan`, `satuan`) VALUES
(1, 'Unit'),
(2, 'Pcs'),
(4, 'Kg');

-- --------------------------------------------------------

--
-- Table structure for table `_users`
--

CREATE TABLE `_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `akses` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_users`
--

INSERT INTO `_users` (`id_user`, `username`, `password`, `nama`, `akses`) VALUES
(1, 'ahmat', 'admin', 'Ahmat Sodikin, S.Pd.SD', 'Admin'),
(2, 'suparjan', 'suparjan123', 'Suparjan, S.Pd.SD', 'Kepsek'),
(4, 'fbys', 'feby123', 'Feby Saputra', 'Guru'),
(6, 'pian', 'pian08', 'Muhammad Huzaifah', 'Guru'),
(9, 'sitidaryani', 'siti123', 'Siti Daryani, S.Pd.SD', 'Guru'),
(11, 'izani', 'izani', 'izzani ahlunadar', 'Guru'),
(12, 'aldo', '123', 'aldo', 'Guru'),
(13, 'sudendev', 'admin', 'Fahrul Adib', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barangKeluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barangMasuk`);

--
-- Indexes for table `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`id_stokBarang`);

--
-- Indexes for table `_datasuplier`
--
ALTER TABLE `_datasuplier`
  ADD PRIMARY KEY (`id_dataSuplier`);

--
-- Indexes for table `_jenisbarang`
--
ALTER TABLE `_jenisbarang`
  ADD PRIMARY KEY (`id_jenisBarang`);

--
-- Indexes for table `_kondisi`
--
ALTER TABLE `_kondisi`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indexes for table `_peminjaman`
--
ALTER TABLE `_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `_pengembalian`
--
ALTER TABLE `_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indexes for table `_satuan`
--
ALTER TABLE `_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `_users`
--
ALTER TABLE `_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barangKeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barangMasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `id_stokBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `_datasuplier`
--
ALTER TABLE `_datasuplier`
  MODIFY `id_dataSuplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `_jenisbarang`
--
ALTER TABLE `_jenisbarang`
  MODIFY `id_jenisBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `_kondisi`
--
ALTER TABLE `_kondisi`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `_peminjaman`
--
ALTER TABLE `_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `_pengembalian`
--
ALTER TABLE `_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `_satuan`
--
ALTER TABLE `_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `_users`
--
ALTER TABLE `_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
