-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2020 at 07:36 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fiicode`
--

-- --------------------------------------------------------

--
-- Table structure for table `carti`
--

CREATE TABLE `carti` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `likes` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carti`
--

INSERT INTO `carti` (`id`, `title`, `author`, `img`, `description`, `likes`, `available`) VALUES
(12, 'A Brief History Of Time: From Big Bang To Black Holes', 'Stephen Hawking', 'https://images-na.ssl-images-amazon.com/images/I/51P8miZZ6OL.jpg', '            It begins by reviewing the great theories of the cosmos from Newton to Einstein, before delving into the secrets which still lie at the heart of space and time, from the Big Bang to black holes, via spiral galaxies and strong theory. To this day A Brief History of Time remains a staple of the scientific canon, and its succinct and clear language continues to introduce millions to the universe and its wonders    ', 1, 1),
(13, 'Ed Futures: A Collection of Short Stories on the Future of Education', 'Stavros Yiannouka ', 'https://images-na.ssl-images-amazon.com/images/I/516kUGLwuTL.jpg', 'Ordered steak. The menu item blinked in red twice in my digital lens but I didn’t care. I was very hungry and I love meat. Since it became possible to merge our genomic data with health records in the cloud synchronized with each and every digital device, choosing food has turned into a stressful activity. They wanted to tell me what and when to eat and it has made me crazy. They knew better what me and especialy.', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bookid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `userid`, `bookid`) VALUES
(7, 34, 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `token` longtext NOT NULL,
  `expire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `phone` int(20) NOT NULL,
  `book` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `termen` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `phone`, `book`, `date`, `termen`, `email`, `status`) VALUES
(4, 744233098, 'ion', '2020-03-23', 2, 'martinescunicolaee3@gmail.com', 1),
(5, 744233098, 'KWFKQW', '2020-03-24', 0, 'admin@gmail.com', 1),
(6, 744233098, 'KWFKQW', '2020-03-24', 0, 'admin@gmail.com', 1),
(7, 744233098, 'ion', '2020-03-25', 0, 'martinescunicolaee3@gmail.com', -1),
(8, 755555555, 'A Brief History Of Time: From Big Bang To Black Holes', '2020-03-25', 0, 'admin@gmail.com', 1),
(9, 744233098, 'A Brief History Of Time: From Big Bang To Black Holes', '2020-03-25', 4, 'martinescunicolaee3@gmail.com', 1),
(10, 744233098, 'A Brief History Of Time: From Big Bang To Black Holes', '2020-03-25', 4, 'martinescunicolaee3@gmail.com', 1),
(11, 744233098, 'Ed Futures: A Collection of Short Stories on the Future of Education', '2020-03-25', 0, 'martinescunicolaee3@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `first_name`, `last_name`, `email`, `address`, `password`, `admin`) VALUES
(30, 'Elena', 'Martinescu', 'elena.martinescu@yahoo.com', 'str dis nr 995', '$2y$10$Hrh0ncYnlI9CeUvval9YVOjLu8yW8J3GjPj2JSwLh2aJEXNVbjJYW', 0),
(31, 'Nicolae', 'Martinescu', 'martinescu@gmail.com', 'strada principala marginea nr995', '$2y$10$I.3ZOsuADdGwTNOY.nWvCeYj18mQHQ/.aH8P2JX6KfsKuShGVxmNC', 0),
(32, 'Nicolae', 'Martinescu', 'martinescu@gmail.comW', 'strada principala marginea nr995', '$2y$10$9Z25Bhk9jyg1/bZC4dRjReOJVEhopqmaj2W/d5szmHCnWNkjjdChq', 0),
(33, 'Nicolae', 'Martinescu', 'martinescu.nico@hotmail.com', 'adr', '$2y$10$hcEWqfMyCHEN0HHKdO95jeloYPiO0tFo4zuLi30hfPASwvvSI359C', 0),
(34, 'Nicolae', 'Martinescu', 'martinescunicolaee3@gmail.com', 'addr', '$2y$10$rv9D.ymJ1brafc7MaBmuYeXymGuFw60Z804E.m1aMT.qV8fymBaqu', 0),
(35, 'Nicu', 'Martinescu', 'admin@gmail.com', 'addr', '$2y$10$irCGN1ZcAuG1D0uGU/5myeYxNEpswXGpSOPcBTSpV/dc7HoOkXVYC', 1),
(36, 'nicolae', 'martinescu', 'elena.martinescu@yahoo.comaaa', 'addr', '$2y$10$2UgMuofpBghIimQaxKPKQOTuEsDyLSXNGZJvICQ2rxp7yXDlQjKEC', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carti`
--
ALTER TABLE `carti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carti`
--
ALTER TABLE `carti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
