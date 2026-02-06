-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2026 at 11:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fld_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'kusal@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `district` varchar(20) NOT NULL,
  `ds_div` varchar(20) NOT NULL,
  `gn_div` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `no_of_fmembers` int(10) NOT NULL,
  `sev_level` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `req_date` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `type`, `district`, `ds_div`, `gn_div`, `name`, `telephone`, `address`, `no_of_fmembers`, `sev_level`, `description`, `req_date`, `user_id`, `status`) VALUES
(2, 'medicine', 'kalutara', 'dodangoda', '800-d', 'disal', '222', 'kalutara', 10, 'high', 'test2', '2026-01-23', 0, 'accepted'),
(3, 'food', 'colombo', 'rathmalana', '800-d', 'tharusha', '07899999999', 'kalutara', 10, 'medium', 'test3', '2026-01-23', 0, ''),
(4, 'shelter', 'colombo', 'rathmalana', '800-d', 'disal', '07899999999', 'kalutara', 20, 'low', 'test', '2026-01-23', 0, ''),
(5, 'shelter', 'colombo', 'rathmalana', '800-d', 'disal', '07899999999', 'kalutara', 20, 'low', 'test', '2026-01-23', 0, ''),
(10, 'medical', 'kalutara', 'nagoda', '800-d', 'disal', '0778767787', 'galle', 10, 'High', 'test1', '2026-01-24', 1, ''),
(11, 'shelter', 'kalutara', 'nagoda', '800-d', 'nimal', '0345434543', 'matara', 10, 'Medium', 'test1', '2026-01-24', 1, ''),
(12, 'food', 'kandy', 'nagoda', '800-d', 'Kusal D Ranasinghe', '0345434543', 'kalutara', 10, 'high', 'test1', '2026-02-06', 2, 'accepted'),
(13, 'food', 'kalutara', 'nagoda', '800-d', 'Kusal D Ranasinghe', '0787996831', 'matara', 10, 'low', 'test1', '2026-02-06', 2, 'accepted'),
(14, 'food', 'kalutara', 'nagoda', '800-d', 'Kusal D Ranasinghe', '0778767787', 'kalutara', 10, 'low', 'test1', '2026-02-06', 9, 'accepted'),
(15, 'food', 'Gampaha', 'nagoda', '800-d', 'Kusal D Ranasinghe', '0345434543', 'jjj', 10, 'High', 'test1', '2026-02-06', 9, 'pending'),
(16, 'food', 'galle', 'nagoda', '800-d', 'Kusal D Ranasinghe', '0345434543', 'galle', 10, 'low', 'test1', '2026-02-06', 2, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `name` varchar(25) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `district` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nic`, `email`, `telephone`, `address`, `district`, `password`, `created_date`) VALUES
(1, 'kusal', '2222', 'd', 'wswdw', 'ws', 'ss', 'ss', '2026-01-14'),
(3, 'disal', '1111', 'kusal@gmail.com', '07899999999', 'kalutara', '', '111', '2026-01-23'),
(4, 'disal', '1111', 'kusal@gmail.com', '07899999999', 'kalutara', '', '111', '2026-01-23'),
(5, 'dasun', '1111', 'kusal@gmail.com', '07899999999', 'kalutara', '', '111', '2026-01-23'),
(6, 'dinul', '201831811106', 'd@gmail.com', '0987654321', 'kalutara', '', '111', '2026-02-03'),
(7, 'maleesa', '201831811106', 'm@gmail.com', '0787996831', 'matara', '', '123', '2026-02-03'),
(8, 'sadun', '201831811106', 's@gmail.com', '0778767787', 'kandy', 'kandy', 'sss', '2026-02-05'),
(9, 'Kusal D Ranasinghe', '201831811106', 'p@gmail.com', '0778767787', 'kalutara', 'kalutara', '111', '2026-02-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
