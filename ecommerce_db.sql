-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 10:44 AM
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
-- Database: `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `name`, `password`) VALUES
(2, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 9, 'user4', 'user4@gmail.com', '15615165', 'hello world'),
(2, 9, 'user ', 'user4@gmail.com', '1561516', 'nice website you got here');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 9, 'user4', 156151651, 'user4@gmail.com', 'credit card', '66 rochester road, cape town, wester cape, South Africa, 7925', 'rengoku hoodie (9 x 1) - anime sword (12 x 1) - ', 21, '0000-00-00', 'completed'),
(3, 9, 'user4', 156151651, 'user4@gmail.com', 'credit card', '66 rochester road, cape town, wester cape, South Africa, 7925', 'rengoku hoodie (9 x 6) - ', 54, '0000-00-00', 'pending'),
(4, 9, 'user4', 156151651, 'user4@gmail.com', 'paytm', '66 rochester road, cape town, wester cape, South Africa, 7925', 'devilman manga (6 x 1) - pokemon kirby beanie (5 x 1) - ', 11, '0000-00-00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `name`, `category`, `price`, `image`, `description`) VALUES
(3, 'luffy gear 5 ', 'figurine', 12, 'MDLUFFY.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet \r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet '),
(4, 'rengoku hoodie', 'clothes', 9, 'kmyHoddie.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet \r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet '),
(6, 'nezuko figurine', 'figurine', 11, 'nezukofigurine.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet \r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet '),
(7, 'devilman manga', 'manga', 6, 'devilman crybaby.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet \r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet '),
(8, 'pokemon kirby beanie', 'clothes', 5, '51ZEgsmAfoL._AC_SX342_-removebg-preview.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet \r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula urna id purus tempor, nec tincidunt ligula fermentum. Suspendisse potenti. Ut sit amet '),
(9, 'anime sword', 'merchandise', 12, 'sword.png', NULL),
(10, 'bakugo figurine', 'figurine', 15, 'luffy figurine.png', NULL),
(11, 'Wotakoi: Love Is Hard for Otaku', 'manga', 15, '711Q-Yyzl7L._AC_UL320_-removebg-preview.png', NULL),
(12, 'demon slayer cosplay', 'clothes', 14, '61axRLmTC+L._AC_SX342_SY445_-removebg-preview.png', NULL),
(13, 'my hero academia manga', 'manga', 7, '81G4Gy7S4xL._SL1500_-removebg-preview.png', NULL),
(14, 'hunter x hunter tee', 'clothes', 7, '71MdojEF1cL._AC_UL320_-removebg-preview.png', NULL),
(15, 'akatsuki cloak', 'clothes', 15, 'Naruto-Akatsuki-Black-Cloak-1-removebg-preview.png', NULL),
(16, 'ywach tee', 'clothes', 14, '14789-m4vtsp-removebg-preview.png', NULL),
(17, 'pokemon', 'merchandise', 12, '71D7i5OCifL._AC_UL320_-removebg-preview.png', 'lorem ipsome elie ninnja art');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(1, 4, 9, 5, 'great hoodie', '2024-05-26 07:44:03'),
(5, 4, 9, 2, 'demon slayer', '2024-05-26 07:52:17'),
(6, 4, 9, 5, 'aweseom hoodie', '2024-05-26 08:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` int(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'john doe', 'johndoe@gmail.com', 682415906, '074fe681c9742d991dc00dc287aba5094ff8c678', ''),
(7, 'user1', 'user1@gmail.com', 681245684, '39dfa55283318d31afe5a3ff4a0e3253e2045e43', ''),
(8, 'user2', 'user2@gmail.com', 654841694, '011c945f30ce2cbafc452f39840f025693339c42', '66 rochester road, cape town, wester cape, South Africa, 7925'),
(9, 'user4', 'user4@gmail.com', 156151651, '39dfa55283318d31afe5a3ff4a0e3253e2045e43', '66 rochester road, cape town, wester cape, South Africa, 7925'),
(10, 'user5', 'user5@gmail.com', 247855555, '39dfa55283318d31afe5a3ff4a0e3253e2045e43', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
