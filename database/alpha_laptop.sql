-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 04, 2024 at 10:13 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alpha_laptop`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `username`, `password`, `picture`, `admin`) VALUES
(1, 'test@gmail.com', 'Ivan1', '$2y$10$4YQ6jrDy.w2SusqcWkXy5u2RpDRRB0OU41oxzTEFAD1gQ3H3eeQZm', NULL, 0),
(3, 'misho@gmail.com', 'Misho', '$2y$10$q7ecaLjzyVGP.0h8H2idH.wqIn0AFReMqleTgRsI4.N2M2h7Xrlky', NULL, 0),
(4, 'admin@gmail.com', 'Admin', '$2y$10$Xk//XpKsCzZ7p/KvZlL7Y.SAwdBgGd1yUrEt.Xast9X75XkpH6GfK', NULL, 1),
(5, 'todor@abv.bg', 'Todor', '$2y$10$GxCF.E5z2XwGDRX/NMe82etYXxPvncKG.eJDYoL.HFwyBRT/jsOMe', NULL, 0),
(43, 'todor12@abv.bg', 'Tosho', '$2y$10$HdTA2wg04SxUoWESjGKB9uNaS.zjd.yqu7aFhJgL4uBAmE72iCQjS', NULL, 0),
(44, 'misho@sd.com', 'SpasiaNTheDOG', '$2y$10$RYl8J5H0kr8uQ99.8Npbd.AGHn2c3j48SZnC9Knb2Tjj6Ltw0ltkC', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `user_id`, `quantity`) VALUES
(59, 7, 4, 1),
(53, 10, 1, 2),
(48, 14, 4, 1),
(47, 10, 4, 1),
(54, 29, 1, 1),
(57, 19, 4, 3),
(50, 5, 4, 1),
(58, 28, 4, 1),
(56, 35, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `rating`, `user_id`, `product_id`) VALUES
(1, 'Awesome product!', 4, 1, 1),
(7, 'Екстра лаптопче!', 4, 1, 5),
(3, 'Уникален лаптоп! Просто няма равен. Производителността не отстъпва по нищо на външния вид и качеството на изработка. Дисплеят е ярък и цветен, с гладко опресняване. Клавиатурата е като на компютър - голяма и кликаща.', 5, 3, 5),
(4, 'Просто коментар.', 0, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

DROP TABLE IF EXISTS `favourites`;
CREATE TABLE IF NOT EXISTS `favourites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `product_id`, `user_id`) VALUES
(18, 5, 4),
(20, 28, 4),
(19, 19, 4),
(21, 11, 1),
(22, 35, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gpu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ram` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storage` int DEFAULT NULL,
  `screen_size` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subcategory`, `brand`, `model`, `price`, `image`, `gpu`, `cpu`, `ram`, `storage`, `screen_size`) VALUES
(1, 'accessories', 'Headphones', 'HyperX', 'Cloud Alpha', 149, 'hyperx_cloud_alpha.png', '', '', '', 0, 0),
(5, 'laptops', 'Gaming', 'Lenovo', 'Legion 5i Pro', 3099, 'lenovo_legion_5.png', 'NVIDIA RTX 3060', 'Intel Core i5-12500H', '16GB 4800MHz', 512, 16),
(6, 'laptops', 'Business', 'Apple', '14 MacBook Pro', 5209, 'apple_macbook_pro.png', 'Integrated GPU', 'Apple M3 Pro', '18GB 4266MHz', 512, 14),
(7, 'laptops', 'Gaming', 'Asus', 'ROG Strix G16', 3779, 'asus_rog_strix_g16.png', 'NVIDIA RTX 4070', 'Intel Core i9-13900HX', '16GB 5600MHz', 1024, 16),
(9, 'laptops', 'Everyday', 'Acer', 'Aspire 5', 1259, 'acer_aspire_5.png', 'Intel UHD Graphics', 'Intel Core i7-12650H', '16GB 2666MHz', 1024, 15.6),
(10, 'laptops', 'Gaming', 'Asus', 'TUF F15', 1655, 'asus_tuf_f15.png', 'NVIDIA RTX 3050', 'Intel Core i5-12500H', '16GB 3200MHz', 1024, 15.6),
(11, 'laptops', 'Gaming', 'Acer', 'Nitro 5', 2689, 'acer_nitro_5.png', 'NVIDIA RTX 4060', 'Intel Core i5-12450H', '16GB 4800MHz', 512, 15.6),
(12, 'laptops', 'Gaming', 'HP', 'Omen 17', 7409, 'hp_omen_17.png', 'NVIDIA RTX 4080', 'Intel Core i7-13700HX', '16GB 5600MHz', 2048, 17.3),
(13, 'laptops', 'Business', 'Lenovo', 'V15 G3', 699, 'lenovo_v15_g3.png', 'Intel UHD Graphics', 'Intel Core i3-1215U', '8GB 3200MHz', 512, 15.6),
(14, 'laptops', 'Business', 'Asus', 'VivoBook 15X', 1289, 'asus_vivobook_15x.png', 'Intel UHD Graphics', 'Intel Core i5-1340P', '8GB 3200MHz', 1024, 15.6),
(16, 'laptops', 'Business', 'Dell', 'Vostro', 1346, 'dell_vostro.png', 'Intel UHD Graphics', 'Intel Core i5-1235U', '8GB 2666MHz', 512, 15.6),
(17, 'laptops', 'Business', 'Lenovo', 'IdeaPad Slim 5', 1679, 'lenovo_ideapad_slim_5.png', 'Intel UHD Graphics', 'Intel Core i5-13420H', '16GB 5200MHz', 1024, 14),
(18, 'laptops', 'Everyday', 'HP', '250 G9', 839, 'hp_250_g9.png', 'Intel UHD Graphics', 'Intel Core i3-1215U', '8GB 3200MHz', 512, 15.6),
(19, 'laptops', 'Everyday', 'Asus', 'X515', 519, 'asus_x515.png', 'Intel UHD Graphics', 'Intel Celeron N4500', '8GB 2166MHz', 512, 15.6),
(20, 'laptops', 'Everyday', 'Lenovo', 'ThinkBook 16 G6', 1849, 'lenovo_thinkbook_g6.png', 'Intel Iris Xe Graphics', 'Intel Core i7-13700H', '32GB 5200MHz', 1024, 16),
(21, 'laptops', 'Everyday', 'Asus', 'VivoBook 15', 799, 'asus_vivobook_15x.png', 'Intel UHD Graphics', 'Intel Core i3-1215U', '8GB 3200MHz', 512, 15.6),
(22, 'accessories', 'Headphones', 'Razer', 'BlackShark V2 Pro', 439, 'razer_blackshark_v2_pro.png', '', '', '', 0, 0),
(23, 'accessories', 'Headphones', 'Beats', 'Studio 3', 489, 'beats_studio_3.png', '', '', '', 0, 0),
(24, 'accessories', 'Headphones', 'SteelSeries', 'Arctis Nova Pro', 677, 'steelseries_arctis_nova_pro.png', '', '', '', 0, 0),
(25, 'accessories', 'Headphones', 'Logitech', 'G733 Lightspeed', 274, 'logitech_g733_lightspeed.png', '', '', '', 0, 0),
(26, 'accessories', 'Keyboards', 'Razer', 'Huntsman TE', 499, 'razer_huntsman_te.png', '', '', '', 0, 0),
(27, 'accessories', 'Keyboards', 'HyperX', 'Alloy Origins 60', 162, 'hyperx_alloy_origins_60.png', '', '', '', 0, 0),
(28, 'accessories', 'Keyboards', 'Logitech', 'G413 TKL SE', 128, 'logitech_g413_tkl_se.png', '', '', '', 0, 0),
(29, 'accessories', 'Keyboards', 'Logitech', 'G213 Prodigy', 119, 'logitech_g213_prodigy.png', '', '', '', 0, 0),
(30, 'accessories', 'Keyboards', 'Dell', 'KM5221', 62, 'dell_km5221_Wireless.png', '', '', '', 0, 0),
(31, 'accessories', 'Mice', 'Logitech', 'G502 LightSpeed', 259, 'logitech_g502_lightspeed.png', '', '', '', 0, 0),
(32, 'accessories', 'Mice', 'Razer', 'DeathAdder V2', 99, 'razer_deathadder_v2.png', '', '', '', 0, 0),
(33, 'accessories', 'Mice', 'Asus', 'TUF Gaming M4', 127, 'asus_tuf_gaming_m4.png', '', '', '', 0, 0),
(34, 'accessories', 'Mice', 'HyperX', 'Pulsefire Core', 61, 'hyperx_pulsefire_core.png', '', '', '', 0, 0),
(35, 'accessories', 'Mice', 'SteelSeries', 'Aerox 3 Onyx', 189, 'steelseries_aerox_3_onyx.png', '', '', '', 0, 0),
(36, 'laptops', 'Gaming', 'MSI', 'Vector GP68HX', 5745, 'msi_vector_gp68hx.png', 'NVIDIA RTX 4080', 'Intel Core i9-13950HX', '32GB 5600MHz', 1024, 16),
(37, 'laptops', 'Gaming', 'Gigabyte', 'G6X 9KG', 2499, 'gigabyte_g6x_9kg.png', 'NVIDIA RTX 4060', 'Intel Core i7-13650HX', '16GB 5200MHz', 1024, 16),
(38, 'laptops', 'Gaming', 'Razer', 'Blade 15', 5486, 'razer_blade_15.png', 'NVIDIA RTX 3060', 'Intel Core i7-12800H', '16GB 4800MHz', 1024, 15.6),
(39, 'laptops', 'Business', 'Microsoft', 'Surface Pro 9', 2599, 'microsoft_surface_pro_9.png', 'Intel UHD Graphics', 'Intel Core i5-1235U', '8GB 3200MHz', 256, 13),
(40, 'laptops', 'Business', 'Gigabyte', 'Aero 14 OLED', 4093, 'gigabyte_aero_14_oled.png', 'NVIDIA RTX 4050', 'Intel Core i7-13700H', '16GB 4800MHz', 1024, 14),
(41, 'laptops', 'Everyday', 'Acer', 'Swift Go 16', 2089, 'acer_swift_go_16.png', 'Intel UHD Graphics', 'Intel Core i5-13500H', '16GB 4800MHz', 512, 16),
(42, 'laptops', 'Everyday', 'Huawei', 'MateBook D 16', 1849, 'huawei_matebook_d_16.png', 'Intel UHD Graphics', 'Intel Core i5-12450H', '16GB 3200MHz', 512, 16),
(43, 'accessories', 'Headphones', 'Corsair', 'HS65', 199, 'corsair_hs65.png', '', '', '', 0, 0),
(44, 'accessories', 'Headphones', 'Logitech', 'G PRO X', 176, 'logitech_g_pro_x.png', '', '', '', 0, 0),
(45, 'accessories', 'Keyboards', 'Logitech', 'Comfort K280E', 53, 'logitech_comfort_k280e.png', '', '', '', 0, 0),
(46, 'accessories', 'Keyboards', 'SteelSeries', 'Apex Mini', 368, 'steelseries_apex_pro_mini.png', '', '', '', 0, 0),
(47, 'accessories', 'Mice', 'Razer', 'Viper Ultimate', 429, 'razer_viper_ultimate.png', '', '', '', 0, 0),
(48, 'accessories', 'Mice', 'Logitech', 'M220 Silent', 45, 'logitech_m220_silent.png', '', '', '', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
