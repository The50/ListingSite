-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 10, 2018 at 07:06 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `id` int(11) NOT NULL,
  `text` varchar(280) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `title` varchar(280) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`id`, `text`, `time`, `title`, `user_id`) VALUES
(97, 'testtesttest', '2018-08-10 18:48:32', 'Hello this is my listing edited not', 2),
(98, 'teesdadasdas', '2018-08-10 18:51:18', 'Hello this is my listing edited', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20180808211041'),
('20180808220425'),
('20180810102438');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `full_name`) VALUES
(1, 'erikas50', '$2y$13$KDwcSRunALEB7XvOZy.Rf.8BWrVuZFV4vRuXyUiDrj2ndOOnMH4Ty', 'e50erikas@gmail.com', 'Erikas Tranauskas'),
(2, 'eritra', '$2y$13$3x0rYA3edZ63IulYWU0vW.XE2fgJb2wxGmSprNPOv29LXcv5vBK22', 'erikas@pepperit.net', 'Erikas Tranauskas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
