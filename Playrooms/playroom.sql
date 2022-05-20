-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17 أبريل 2022 الساعة 04:02
-- إصدار الخادم: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `playroom`
--
CREATE DATABASE IF NOT EXISTS `playroom` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `playroom`;

-- --------------------------------------------------------

--
-- بنية الجدول `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `avatar` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- بنية الجدول `item_status`
--

DROP TABLE IF EXISTS `item_status`;
CREATE TABLE `item_status` (
  `id` int(11) NOT NULL,
  `id_item` int(11) DEFAULT NULL,
  `id_room_status` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- بنية الجدول `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `status` varchar(45) DEFAULT 'B',
  `stop` varchar(45) DEFAULT 'B',
  `avatar` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- بنية الجدول `room_status`
--

DROP TABLE IF EXISTS `room_status`;
CREATE TABLE `room_status` (
  `id` int(11) NOT NULL,
  `id_room` int(11) DEFAULT NULL,
  `datestart` datetime DEFAULT current_timestamp(),
  `datepause` datetime DEFAULT NULL,
  `seconds` int(11) DEFAULT NULL,
  `secondspause` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'B',
  `price` float DEFAULT NULL,
  `mathod` varchar(45) DEFAULT NULL,
  `nterval_time` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `room_status`
--

INSERT INTO `room_status` (`id`, `id_room`, `datestart`, `datepause`, `seconds`, `secondspause`, `status`, `price`, `mathod`, `nterval_time`) VALUES
(166, 40, '2022-04-17 03:55:23', NULL, NULL, NULL, 'B', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `currency` varchar(45) DEFAULT NULL,
  `LockEdit_room` varchar(45) DEFAULT 'B',
  `LockDelete_room` varchar(45) DEFAULT 'A',
  `LockCreate_report` varchar(45) DEFAULT 'B',
  `LockCreate_room` varchar(45) DEFAULT 'B',
  `LockCreate_item` varchar(45) DEFAULT 'B',
  `LockEdit_item` varchar(45) DEFAULT 'B',
  `LockDelete_item` varchar(45) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `settings`
--

INSERT INTO `settings` (`id`, `pass`, `currency`, `LockEdit_room`, `LockDelete_room`, `LockCreate_report`, `LockCreate_room`, `LockCreate_item`, `LockEdit_item`, `LockDelete_item`) VALUES
(1, '1', '$', 'B', 'A', 'A', 'B', 'A', 'B', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_status`
--
ALTER TABLE `item_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_status`
--
ALTER TABLE `room_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `item_status`
--
ALTER TABLE `item_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=657;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `room_status`
--
ALTER TABLE `room_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
