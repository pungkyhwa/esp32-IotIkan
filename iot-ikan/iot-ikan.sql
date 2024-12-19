-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 146.196.98.251
-- Generation Time: Dec 19, 2024 at 01:15 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iot-ikan`
--

-- --------------------------------------------------------

--
-- Table structure for table `makan`
--

CREATE TABLE `makan` (
  `id_makan` int NOT NULL,
  `id_user` int NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `makan`
--

INSERT INTO `makan` (`id_makan`, `id_user`, `jam`) VALUES
(1, 1, '11:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `id_sensor` int NOT NULL,
  `nm_sensor` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`id_sensor`, `nm_sensor`) VALUES
(1, 'sensor ph'),
(2, 'sensor turbinity'),
(3, 'sensor ultrasonik');

-- --------------------------------------------------------

--
-- Table structure for table `t_sensor`
--

CREATE TABLE `t_sensor` (
  `id_tSensor` int NOT NULL,
  `id_sensor` int NOT NULL,
  `id_user` int NOT NULL,
  `tgl` date NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_sensor`
--

INSERT INTO `t_sensor` (`id_tSensor`, `id_sensor`, `id_user`, `tgl`, `value`) VALUES
(1, 1, 1, '2024-11-29', 25),
(2, 2, 1, '2024-11-29', 50),
(3, 3, 1, '2024-11-29', 45),
(4, 1, 1, '2024-11-30', 4),
(5, 2, 1, '2024-11-30', 4359.17),
(6, 3, 1, '2024-11-30', 0),
(7, 1, 1, '2024-12-03', 4),
(8, 2, 1, '2024-12-03', 2080.9),
(9, 3, 1, '2024-12-03', 214),
(10, 1, 1, '2024-12-04', 4),
(11, 2, 1, '2024-12-04', 1052.51),
(12, 3, 1, '2024-12-04', 3),
(13, 1, 1, '2024-12-05', 4),
(14, 2, 1, '2024-12-05', 2055.62),
(15, 3, 1, '2024-12-05', 3),
(16, 1, 1, '2024-12-06', 4),
(17, 2, 1, '2024-12-06', 1698.32),
(18, 3, 1, '2024-12-06', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nm_user` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nm_user`, `email`, `password`) VALUES
(1, 'pungky', 'pungky@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `makan`
--
ALTER TABLE `makan`
  ADD PRIMARY KEY (`id_makan`);

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id_sensor`);

--
-- Indexes for table `t_sensor`
--
ALTER TABLE `t_sensor`
  ADD PRIMARY KEY (`id_tSensor`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `makan`
--
ALTER TABLE `makan`
  MODIFY `id_makan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sensor`
--
ALTER TABLE `sensor`
  MODIFY `id_sensor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_sensor`
--
ALTER TABLE `t_sensor`
  MODIFY `id_tSensor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
