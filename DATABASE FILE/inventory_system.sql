-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 02:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(9, 'Ceramic'),
(11, 'Glass'),
(12, 'Granite'),
(25, 'Limestone'),
(13, 'Marble'),
(28, 'Metal'),
(24, 'Mosaic'),
(27, 'Penny Round'),
(10, 'Porcelain'),
(26, 'Stone');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(4, 'ceramic_glazed_tile.png', 'image/png'),
(5, 'porcelain_seaport_chameleon_tile.png', 'image/png'),
(6, 'glass_orient_bell_glossy_wall_tile.png', 'image/png'),
(7, 'granite_black_forest_tile.png', 'image/png'),
(8, 'marble_tanedos_italian_white_carrara_polished_tile.png', 'image/png'),
(10, 'marble_grigio_carrara_tile.jpg', 'image/jpeg'),
(13, 'limestone_astor_beige_tile.png', 'image/png'),
(14, 'mosaic_Herringbone_tile.png', 'image/png'),
(15, 'stone_silver_grey_tile.png', 'image/png'),
(16, 'penny_round_antiny_tile.png', 'image/png'),
(17, 'metal_satin_brush_tile.png', 'image/png'),
(18, 'marble_white_whisp_dolomiti_tile.png', 'image/png'),
(19, 'marble_thassos_blue_caress_gris_de_bleu_nero_marquina_tile.png', 'image/png'),
(20, 'mosaic_thassos_&_nero_marquina_polished_tile.png', 'image/png'),
(21, 'mosaic_basalt_honed_tile.png', 'image/png'),
(23, 'ceramic_after_blue_gloss_tile.png', 'image/png'),
(24, 'stone_copper_multi_natural_cleft_tile.png', 'image/png'),
(25, 'glass_opal_aqua_turquoise_&_Peacock_gloss_tile.png', 'image/png'),
(27, 'porcelain_coal_lappato_tile.png', 'image/png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tile_size` varchar(100) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT 0,
  `supplier` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `added_stock` int(255) NOT NULL,
  `available_stock` int(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `barcode`, `name`, `tile_size`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `supplier`, `date`, `added_stock`, `available_stock`, `deleted`) VALUES
(116, '', 'Coal Lappato', '2x12', '900', 200.00, 250.00, 10, 27, '1', '2023-06-19 20:41:40', 10, 0, 0),
(117, '', 'Opal Gloss', '12x12', '500', 200.00, 230.00, 11, 25, '2', '2023-06-19 20:42:18', 0, 0, 0),
(118, '', 'Copper Cleft', '12x24', '12', 200.00, 250.00, 26, 24, '9', '2023-06-19 20:43:24', 2, 0, 0),
(120, '', 'After Blue', '2x12', '202', 160.00, 200.00, 9, 23, '2', '2023-06-20 02:19:27', 2, 0, 0),
(121, '', 'Basalt Honed', '12x12', '1000', 190.00, 200.00, 24, 21, '8', '2023-06-20 02:21:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `qty`, `price`, `date`) VALUES
(230, 116, 100, 25000.00, '2023-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `sell_product`
--

CREATE TABLE `sell_product` (
  `item` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `total` int(255) NOT NULL,
  `date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_card`
--

CREATE TABLE `stock_card` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `added_stock` int(255) NOT NULL,
  `stock_out` int(100) NOT NULL,
  `available_stock` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) UNSIGNED NOT NULL,
  `supp_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supp_name`, `company_name`, `address`, `email`, `phone`) VALUES
(1, 'The Scotts', 'Cacti Tiles', 'Houston, Texas', 'cactitiles@email.com', 998877671),
(2, 'La Flame', 'La Tiles', 'Capetown, South Africa', 'latiles@email.com', 9980998091),
(8, 'Cactus Jack', 'Cactus Trail Tiles', 'Los Angeles, California', 'cctiles@email.com', 909988776),
(9, 'Tragic Scott', 'Tragic Tiles', 'Yosemite, California', 'tragic@email.com', 909282711);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Admin Jack', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'x1uiofsg1.png', 1, '2023-06-20 02:17:58'),
(9, 'Employee Jack', 'Employee', 'caf322f0bbed721eac4a36bf7aff1103079faf25', 2, 'ysf90k9l9.png', 0, '2023-06-19 21:49:26'),
(10, 'Admin Astro Jack', 'Admin1', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 1, 'r6cbrfrj10.png', 1, '2023-05-26 05:34:39'),
(16, 'Employee Astro', 'employee1', '73b6475fd5fe4c0750e094f547cd94abfb624351', 2, 'no_image.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'Employee', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stock_card`
--
ALTER TABLE `stock_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `stock_card`
--
ALTER TABLE `stock_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

 

