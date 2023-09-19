-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2023 at 04:14 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank73`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id_akun` int(3) NOT NULL,
  `nama_akun` varchar(255) NOT NULL,
  `saldo` decimal(7,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id_akun`, `nama_akun`, `saldo`) VALUES
(1, 'salwa', '100000'),
(2, 'salsa', '150000'),
(3, 'nurhamida\r\n', '5000'),
(4, 'kafin', '80909'),
(5, 'elsa', '90900');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(3) NOT NULL,
  `jenis_transaksi` enum('kredit','debit') NOT NULL,
  `jumlah_transaksi` decimal(7,0) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `id_akun` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `jenis_transaksi`, `jumlah_transaksi`, `tanggal_transaksi`, `id_akun`) VALUES
(1, 'kredit', '35000', '2023-09-01', 2),
(2, 'kredit', '5000', '2023-09-08', 2),
(3, 'debit', '25000', '2023-09-06', 1),
(4, 'kredit', '10000', '2023-09-15', 3),
(5, 'debit', '30000', '2023-09-30', 3),
(6, 'kredit', '50000', '2023-09-20', 3),
(7, 'debit', '90000', '2023-09-21', 3),
(8, 'kredit', '50000', '2023-09-07', 2),
(9, 'kredit', '10001', '2023-09-29', 2),
(10, 'kredit', '10001', '2023-09-28', 3),
(12, 'kredit', '500', '2023-09-12', 4),
(13, 'debit', '750', '2023-09-19', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_akun` (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id_akun` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `accounts` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
