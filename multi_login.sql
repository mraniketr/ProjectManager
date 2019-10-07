-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2019 at 03:45 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `members_project`
--

CREATE TABLE `members_project` (
  `pid` int(11) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `disc` varchar(1000) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `user_id1` int(11) DEFAULT NULL,
  `user_id2` int(11) DEFAULT NULL,
  `user_id3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members_project`
--

INSERT INTO `members_project` (`pid`, `pname`, `disc`, `admin_id`, `user_id1`, `user_id2`, `user_id3`) VALUES
(13, 'cryptor', 'Crypto', 1, 2, 3, 4),
(14, 'asdasdasdasdas', 'sadasdas', 1, 2, 3, 4),
(15, 'dom', 'this is some crypto shit', 1, 2, 4, 3),
(16, 'asdasdasdasd', 'gandu', 2, 2, 4, 1),
(17, 'Project 2', 'this is a short discription of the project', 1, 2, 4, 3),
(18, 'my new project', 'tasda ka rkasf kasflakflkasfhkjsahfiuawefkaenfakjfbhajbf', 6, 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`) VALUES
(1, 'aniket', 'aniket@gmail.com', 'user', '185e1a3a41e1463e1a60901060bcfefc'),
(2, 'abhishek', 'abhishek123@gmail.com', 'user', 'e5d1dfdc999e351aaf8861788e340f2c'),
(3, 'bhagyesh123', 'bhagyesh123@gmail.com', 'user', 'eab8e9c44069f91b77e66e56612283fc'),
(4, 'priyash123', 'priyash123@gmail.com', 'user', 'fe8bef9eea3c985210ff0a389d9823ce'),
(5, 'shantanu123', 'shantanu123@gmail.com', 'user', 'b3347abacd45c286a4fdb6154e1dc069'),
(6, 'saurbh123', 'saurbh123@gn.com', 'user', '3a19a14585ce3dc777f2f18397e9e9f9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members_project`
--
ALTER TABLE `members_project`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members_project`
--
ALTER TABLE `members_project`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
