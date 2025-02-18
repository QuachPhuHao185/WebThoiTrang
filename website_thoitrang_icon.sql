-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2025 at 03:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_thoitrang_icon`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL,
  `cartegory_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `cartegory_id`, `brand_name`) VALUES
(5, 12, 'VÁY'),
(6, 13, 'QUẦN'),
(7, 13, 'ÁO'),
(8, 12, 'QUẦN'),
(10, 13, 'ÁO KHOÁT'),
(15, 19, 'KHẨU TRANG'),
(16, 14, 'ÁO'),
(17, 15, 'ÁO KHOÁT'),
(18, 16, 'Xuân'),
(19, 16, 'Hè'),
(20, 16, 'Thu'),
(21, 16, 'Đông');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cartegory`
--

CREATE TABLE `tbl_cartegory` (
  `cartegory_id` int(11) NOT NULL,
  `cartegory_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_cartegory`
--

INSERT INTO `tbl_cartegory` (`cartegory_id`, `cartegory_name`) VALUES
(12, 'NỮ'),
(13, 'NAM'),
(14, 'TRẺ EM'),
(15, 'SALE UP TO 70%'),
(16, 'BỘ SƯ TẬP');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `cartegory_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_price_new` varchar(255) NOT NULL,
  `product_desc` varchar(5000) NOT NULL,
  `product_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `cartegory_id`, `brand_id`, `product_price`, `product_price_new`, `product_desc`, `product_img`) VALUES
(3, 'ví dụ 31', 13, 6, '123', '123', '<p>1234</p>', '1733620388-slide3.jpg'),
(11, 'sp2', 16, 18, '1200000', '1000000', '<p>đẹp</p>', 'sp8.webp'),
(12, 'sp3', 16, 20, '1300000', '1000000', '<p>123</p>', 'sp1.1.webp'),
(13, 'sp3', 16, 20, '1300000', '1000000', '<p>123</p>', '1733993573-sp4.webp'),
(14, 'sp4', 13, 6, '1200000', '1000000', '<p>123</p>', 'slide3.jpg'),
(15, 'sp4', 16, 19, '1300000', '1000000', '<p>đẹp quá</p>', 'sp5.webp'),
(16, 'ví dụ 5', 16, 20, '1250000', '1050000', '<p>hay</p>', 'sp9.webp'),
(17, 'bộ mùa đông', 16, 21, '1400000', '1200000', '<p>sản phẩm mùa đông ấm cúng và stylish</p>', 'mùa đông.webp'),
(18, 'Mùa đông 2', 16, 21, '1250000', '1000000', '<p>stylis by choice</p>', '1735090277-mua đông 1.2.webp');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_img_desc`
--

CREATE TABLE `tbl_product_img_desc` (
  `product_id` int(11) NOT NULL,
  `product_img_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_product_img_desc`
--

INSERT INTO `tbl_product_img_desc` (`product_id`, `product_img_desc`) VALUES
(6, 'day.jpg'),
(6, 'electro-voice-elx200-10.jpg'),
(6, 'jbl8124.jpg'),
(7, 'day.jpg'),
(7, 'electro-voice-elx200-10.jpg'),
(7, 'jbl8124.jpg'),
(8, 'slide3.jpg'),
(8, 'slide4.jpg'),
(9, 'sp1.1.webp'),
(9, 'sp1.2.webp'),
(9, 'sp1.3.webp'),
(9, 'sp1.webp'),
(8, 'sp1.1.webp'),
(8, 'sp1.3.webp'),
(10, 'sp1.2.webp'),
(10, 'sp1.3.webp'),
(10, 'sp1.webp'),
(4, '1733619557-slide3.jpg'),
(3, '1733620556-sp1.2.webp'),
(3, '1733620556-sp1.3.webp'),
(3, '1733620556-sp1.webp'),
(11, 'sp8.webp'),
(11, 'sp9.webp'),
(12, 'sp1.2.webp'),
(13, 'sp5.webp'),
(13, 'sp6.webp'),
(14, 'slide2.jpg'),
(14, 'slide3.jpg'),
(15, 'sp5.webp'),
(15, 'sp6.webp'),
(16, 'sp8.webp'),
(16, 'sp9.webp'),
(17, 'mùa đông 1.1.webp'),
(17, 'mua đông 1.2.webp'),
(17, 'mùa đông 1.3.webp'),
(17, 'mùa đông.webp'),
(18, 'mua đông 1.2.webp'),
(18, 'mùa đông 1.3.webp'),
(18, 'set-do-mua-dong-1.jpg'),
(19, 'tourDaLat4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(25) NOT NULL,
  `user_birth` varchar(25) NOT NULL,
  `user_gender` varchar(25) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_role` varchar(25) NOT NULL,
  `user_pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_phone`, `user_birth`, `user_gender`, `user_address`, `user_role`, `user_pwd`) VALUES
(7, 'Quách Phú Hào', 'hao', '123', '123', 'nam', '123', 'nhanvien', '$2y$10$Aenp.cG5YOMsi8nx30vYrufqN2WZgNMWRW64jtSQmLRoF1OjMz2h6'),
(9, 'Admin', 'Admin', '123', '123', 'Nam', '123', 'admin', '$2y$10$1MkTx/S9CNkL5erDdffTl.bWnu4EtVjpiWlI4QYe5VfCfChoVjRNu'),
(13, 'minh', 'minh', '123', '123', 'Nam', '123', 'khach', '$2y$10$2/9EqlxSWiAfWEaDiIUzJe5QhrXLP4ycnt6QRbdjwKk6qWyRZuk02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_cart`
--

CREATE TABLE `tbl_user_cart` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_user_cart`
--

INSERT INTO `tbl_user_cart` (`user_id`, `product_id`) VALUES
(13, 11),
(13, 15),
(13, 16),
(13, 13),
(13, 10),
(13, 17),
(13, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_cartegory`
--
ALTER TABLE `tbl_cartegory`
  ADD PRIMARY KEY (`cartegory_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_cartegory`
--
ALTER TABLE `tbl_cartegory`
  MODIFY `cartegory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
