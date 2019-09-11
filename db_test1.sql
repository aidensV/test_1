-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2019 at 02:31 PM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_test1`
--

-- --------------------------------------------------------

--
-- Table structure for table `d_stock`
--

CREATE TABLE `d_stock` (
  `s_id` int(20) NOT NULL,
  `s_id_owner` int(20) NOT NULL,
  `s_id_item` int(11) NOT NULL,
  `s_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_stock`
--

INSERT INTO `d_stock` (`s_id`, `s_id_owner`, `s_id_item`, `s_qty`) VALUES
(2, 2, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `m_item`
--

CREATE TABLE `m_item` (
  `i_id` int(20) NOT NULL,
  `i_name` varchar(50) NOT NULL,
  `i_id_unit` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_item`
--

INSERT INTO `m_item` (`i_id`, `i_name`, `i_id_unit`) VALUES
(2, 'd', 3);

-- --------------------------------------------------------

--
-- Table structure for table `m_owner`
--

CREATE TABLE `m_owner` (
  `o_id` int(20) NOT NULL,
  `o_name` varchar(50) NOT NULL,
  `o_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_owner`
--

INSERT INTO `m_owner` (`o_id`, `o_name`, `o_address`) VALUES
(2, 'a', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `m_unit`
--

CREATE TABLE `m_unit` (
  `u_id` int(20) NOT NULL,
  `u_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_unit`
--

INSERT INTO `m_unit` (`u_id`, `u_name`) VALUES
(3, 'c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `d_stock`
--
ALTER TABLE `d_stock`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `m_item`
--
ALTER TABLE `m_item`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `m_owner`
--
ALTER TABLE `m_owner`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `m_unit`
--
ALTER TABLE `m_unit`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_stock`
--
ALTER TABLE `d_stock`
  MODIFY `s_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_item`
--
ALTER TABLE `m_item`
  MODIFY `i_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_owner`
--
ALTER TABLE `m_owner`
  MODIFY `o_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_unit`
--
ALTER TABLE `m_unit`
  MODIFY `u_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
