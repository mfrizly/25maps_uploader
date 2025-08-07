-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2025 at 01:50 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maps_uploader`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_marginal`


CREATE TABLE `data_marginal` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nama_peta` varchar(255) NOT NULL,
  `tanggal_upload` date NOT NULL,
  `excel_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `users` (`username`, `password` , `role`) VALUES 
('admin', '$2y$10$AtkLi4jnVpyBh5Gi3ctnwuBTrt17kOV.bEgqUjwT8bhgeAZJ3ZJFq', 'admin'),
('user', '$2y$10$9WdsrhoxKL5gA2dX/.S/x.FNHz/1ClvsFvB5GG.RbA2tA/2KLqKzq', 'user'); 

ALTER TABLE `users` MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 1;
ALTER TABLE `data_marginal` MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 1;


COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
