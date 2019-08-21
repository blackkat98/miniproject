-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 21, 2019 at 08:54 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photosharing`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblArticle`
--

CREATE TABLE `tblArticle` (
  `id` int(11) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblArticle`
--

INSERT INTO `tblArticle` (`id`, `summary`, `content`, `created_at`) VALUES
(1, 'Hello', 'World', '2019-08-19 18:30:32'),
(2, '123', '  456', '2019-08-21 05:10:26'),
(3, '1234', '  1234', '2019-08-21 05:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `tblUser`
--

CREATE TABLE `tblUser` (
  `id` int(11) NOT NULL,
  `uname` varchar(12) NOT NULL,
  `upass` varchar(255) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblUser`
--

INSERT INTO `tblUser` (`id`, `uname`, `upass`, `is_admin`, `remember_token`, `created_at`) VALUES
(1, 'nam', '62429b8219194f0722dfea6509875729', 1, 'ufhridfssf', '2019-08-16 08:01:47'),
(2, 'nam1', '62429b8219194f0722dfea6509875729', 0, 'cbcflina2m', '2019-08-16 08:08:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblArticle`
--
ALTER TABLE `tblArticle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblUser`
--
ALTER TABLE `tblUser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblArticle`
--
ALTER TABLE `tblArticle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblUser`
--
ALTER TABLE `tblUser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
