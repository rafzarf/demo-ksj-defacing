-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 20, 2021 at 07:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_notes_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`) VALUES
('admin', '$2y$10$9StiDh4DPhEExtYvdIeIO.OyntxNV4vJE7sAdM5.07XU54n6mG3o.');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `genre` longtext NOT NULL,
  `release_date` date NOT NULL,
  `imdb_rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `genre`, `release_date`, `imdb_rating`) VALUES
(1, 'Kabayan', 'comedy', '2021-12-01', 4.5),
(2, 'Sule', 'action', '2021-11-10', 3.9);

-- --------------------------------------------------------

--
-- Table structure for table `non_works`
--

CREATE TABLE `non_works` (
  `nworks_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `fk_movie_id` int(11) DEFAULT NULL,
  `fk_staycation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `non_works`
--

INSERT INTO `non_works` (`nworks_id`, `username`, `fk_movie_id`, `fk_staycation_id`) VALUES
(36, 'admin', NULL, 1),
(38, 'admin', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `born_date` date DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `username`, `first_name`, `last_name`, `email`, `born_date`, `phone_number`) VALUES
(6, 'admin', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staycation`
--

CREATE TABLE `staycation` (
  `staycation_id` int(11) NOT NULL,
  `province_name` varchar(45) NOT NULL,
  `staycation_place` varchar(45) NOT NULL,
  `hotel_name` varchar(45) NOT NULL,
  `culinary_name` varchar(45) NOT NULL,
  `restaurant_name` varchar(45) NOT NULL,
  `estimated_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staycation`
--

INSERT INTO `staycation` (`staycation_id`, `province_name`, `staycation_place`, `hotel_name`, `culinary_name`, `restaurant_name`, `estimated_time`) VALUES
(1, 'Jawa Barat', 'Jonggol', 'Aston', 'Sate Maranggi', 'Haji Naim', '2021-12-14'),
(2, 'Sumatera Barat', 'Jam Gadang', 'Ibis Padang', 'Rendang', 'Uni Uni', '2022-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `works_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `to_do_list_task` longtext DEFAULT NULL,
  `wish_list_content` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`works_id`, `username`, `to_do_list_task`, `wish_list_content`) VALUES
(14, 'admin', 'bismillah', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `non_works`
--
ALTER TABLE `non_works`
  ADD PRIMARY KEY (`nworks_id`),
  ADD KEY `fk_nworks_username` (`username`),
  ADD KEY `fk_movie` (`fk_movie_id`),
  ADD KEY `fk_staycation` (`fk_staycation_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_username` (`username`);

--
-- Indexes for table `staycation`
--
ALTER TABLE `staycation`
  ADD PRIMARY KEY (`staycation_id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`works_id`),
  ADD KEY `fk_works_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `non_works`
--
ALTER TABLE `non_works`
  MODIFY `nworks_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staycation`
--
ALTER TABLE `staycation`
  MODIFY `staycation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `works_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `non_works`
--
ALTER TABLE `non_works`
  ADD CONSTRAINT `fk_movie` FOREIGN KEY (`fk_movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nworks_username` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_staycation` FOREIGN KEY (`fk_staycation_id`) REFERENCES `staycation` (`staycation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_username` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `fk_works_username` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;