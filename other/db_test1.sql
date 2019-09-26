-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 26, 2019 at 09:21 AM
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
(3, '2019-09-24', '001/BRT/IX/2019', 192000),
(4, '2019-09-24', '', 96000),
(5, '2019-09-24', '', 96000),
(6, '2019-09-24', '', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `d_sales_dt`
--

CREATE TABLE `d_sales_dt` (
  `sales_id` int(20) NOT NULL,
  `detail_id` int(20) NOT NULL,
  `item_id` int(20) NOT NULL,
  `qty` int(20) NOT NULL,
  `unit_id` int(20) NOT NULL,
  `value` bigint(15) NOT NULL,
  `total_net` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_sales_dt`
--

INSERT INTO `d_sales_dt` (`sales_id`, `detail_id`, `item_id`, `qty`, `unit_id`, `value`, `total_net`) VALUES
(5, 0, 7, 1, 5, 16000, 96000),
(6, 0, 6, 1, 3, 5000, 5000);

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
(7, 4, 6, 101),
(8, 4, 7, 79),
(9, 4, 8, 45),
(10, 5, 6, -5),
(11, 5, 7, -5),
(12, 5, 8, 27);

-- --------------------------------------------------------

--
-- Table structure for table `d_stock_distribution`
--

CREATE TABLE `d_stock_distribution` (
  `id` int(20) NOT NULL,
  `from` int(20) NOT NULL,
  `destination` int(20) NOT NULL,
  `date` date NOT NULL,
  `nota` varchar(30) NOT NULL,
  `status` enum('o','s','r') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_stock_distribution`
--

INSERT INTO `d_stock_distribution` (`id`, `from`, `destination`, `date`, `nota`, `status`) VALUES
(1, 5, 4, '2019-09-24', '001/DST/IX/2019', 's'),
(2, 5, 4, '2019-09-24', '', 's'),
(3, 5, 4, '2019-09-24', '', 's'),
(4, 5, 4, '2019-09-24', '', 's'),
(5, 5, 4, '2019-09-25', '', 'r'),
(6, 4, 5, '2019-09-25', '', 's'),
(7, 5, 4, '2019-09-25', '', 'r'),
(8, 4, 4, '2019-09-25', '', 'r');

-- --------------------------------------------------------

--
-- Table structure for table `d_stock_distribution_dt`
--

CREATE TABLE `d_stock_distribution_dt` (
  `stock_distribution_id` int(20) NOT NULL,
  `detail_id` int(20) NOT NULL,
  `item_id` int(20) NOT NULL,
  `qty` int(20) NOT NULL,
  `unit` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_stock_distribution_dt`
--

INSERT INTO `d_stock_distribution_dt` (`stock_distribution_id`, `detail_id`, `item_id`, `qty`, `unit`) VALUES
(5, 0, 8, 8, 3),
(5, 1, 6, 7, 3),
(6, 0, 8, 8, 5),
(7, 0, 7, 1, 5),
(8, 0, 6, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `d_users`
--

CREATE TABLE `d_users` (
  `id` int(20) NOT NULL,
  `owner_id` int(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_users`
--

INSERT INTO `d_users` (`id`, `owner_id`, `username`, `password`) VALUES
(1, 2, 'admins', '$2y$10$YH0.Rw1f7TE6BaNRDlnjrueKOpXnsMBLGZlieL4XtROWSGLRToDaa'),
(2, 4, 'admin1', '$2y$10$HN2LltLiot45qx6g.bPdI.oIgAk.Cq8uS.nvIBw576NLTEDcse0bG'),
(3, 5, 'admin2', '$2y$10$.f9i45IDy294apmRx23X0uHkHWBwPRkvxe6mhEC8E9GElGGwXhqWC'),
(4, 6, 'admin3', '$2y$10$gg5VdFfVsg49EF/CespGoe4VQQclZD3OwOq/WMwV8Pg83grItZb76');

-- --------------------------------------------------------

--
-- Table structure for table `m_item`
--

CREATE TABLE `m_item` (
  `i_id` int(20) NOT NULL,
  `i_name` varchar(50) NOT NULL,
  `i_price` bigint(20) NOT NULL,
  `i_unit1` int(20) NOT NULL,
  `i_unit2` int(20) NOT NULL,
  `i_unit3` int(20) NOT NULL,
  `i_unitcompare1` int(20) NOT NULL,
  `i_unitcompare2` int(20) NOT NULL,
  `i_unitcompare3` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_item`
--

INSERT INTO `m_item` (`i_id`, `i_name`, `i_price`, `i_unit1`, `i_unit2`, `i_unit3`, `i_unitcompare1`, `i_unitcompare2`, `i_unitcompare3`) VALUES
(6, 'kaos kaki XL hitam', 5000, 3, 5, 6, 1, 5, 12),
(7, 'Stocking Black Soft', 16000, 3, 5, 6, 1, 6, 12),
(8, 'Kaos Singlet Putih XL', 7000, 3, 5, 6, 1, 5, 12);

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
(4, 'halim', 'jl soekarno hatta nomor 78 - cikarang'),
(5, 'rusdi', 'jalan jatirejo nomor 54 bekasi'),
(6, 'uma', 'jalan cicurug nomor 11 depok');

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
(3, 'Pcs'),
(4, 'rol'),
(5, 'pack'),
(6, 'lusin'),
(7, 'box');

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
-- Indexes for table `d_stock_distribution`
--
ALTER TABLE `d_stock_distribution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `d_stock_distribution_dt`
--
ALTER TABLE `d_stock_distribution_dt`
  ADD PRIMARY KEY (`stock_distribution_id`,`detail_id`);

--
-- Indexes for table `d_users`
--
ALTER TABLE `d_users`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `d_stock`
--
ALTER TABLE `d_stock`
  MODIFY `s_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `d_stock_distribution`
--
ALTER TABLE `d_stock_distribution`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `d_users`
--
ALTER TABLE `d_users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `m_item`
--
ALTER TABLE `m_item`
  MODIFY `i_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `m_owner`
--
ALTER TABLE `m_owner`
  MODIFY `o_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `m_unit`
--
ALTER TABLE `m_unit`
  MODIFY `u_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
