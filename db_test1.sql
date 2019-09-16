-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 16, 2019 at 02:17 PM
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
-- Table structure for table `d_sales`
--

CREATE TABLE `d_sales` (
  `id` int(20) NOT NULL,
  `date` date NOT NULL,
  `nota` varchar(20) NOT NULL,
  `total` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_sales`
--

INSERT INTO `d_sales` (`id`, `date`, `nota`, `total`) VALUES
(1, '2019-09-16', '001/BRT/IX/2019', 27),
(2, '2019-09-16', '', 4),
(3, '2019-09-16', '', 4),
(4, '2019-09-16', '', 4),
(5, '2019-09-16', '', 4),
(6, '2019-09-16', '', 4),
(7, '2019-09-16', '', 4),
(8, '2019-09-16', '', 15),
(9, '2019-09-16', '', 267),
(10, '2019-09-16', '', 41),
(11, '2019-09-16', '', 30),
(12, '2019-09-16', '', 37),
(13, '2019-09-16', '', 62458),
(14, '2019-09-16', '', 62458),
(15, '2019-09-16', '', 120046);

-- --------------------------------------------------------

--
-- Table structure for table `d_sales_dt`
--

CREATE TABLE `d_sales_dt` (
  `sales_id` int(20) NOT NULL,
  `detail_id` int(20) NOT NULL,
  `item_id` int(20) NOT NULL,
  `qty` int(20) NOT NULL,
  `value` bigint(15) NOT NULL,
  `total_net` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_sales_dt`
--

INSERT INTO `d_sales_dt` (`sales_id`, `detail_id`, `item_id`, `qty`, `value`, `total_net`) VALUES
(14, 0, 2, 6, 5688, 34128),
(14, 1, 2, 5, 5666, 28330),
(15, 0, 2, 877, 98, 85946);

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
-- Indexes for table `d_sales`
--
ALTER TABLE `d_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `d_sales_dt`
--
ALTER TABLE `d_sales_dt`
  ADD PRIMARY KEY (`sales_id`,`detail_id`);

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
-- AUTO_INCREMENT for table `d_sales`
--
ALTER TABLE `d_sales`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
