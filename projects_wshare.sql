-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2019 at 04:41 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects_wshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_slovak_ci NOT NULL,
  `body` text COLLATE utf8_slovak_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `created_at`) VALUES
(1, 2, 'Post 1', 'This is post 1', '2019-02-26 22:24:39'),
(2, 1, 'Post 2', 'This is post 2', '2019-02-26 22:24:39'),
(4, 4, 'Toj len toli tu', 'MA HA AHA TY MARHA', '2019-02-27 18:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_slovak_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_slovak_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_slovak_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `created_at`) VALUES
(1, 'Wimko', '123', 'wimko@gmail.com', '2019-02-24 20:22:47'),
(2, 'Jaro', '123', 'jaro@gmail.com', '2019-02-24 20:22:47'),
(4, 'Wimko', '$2y$10$VnJcsdwfMS.NJE.MLzdRH.PuRMSD2ab0gAvXpzShi/S7TKr8ftULi', 'wimko.kun@gmail.com', '2019-02-24 20:54:43'),
(5, 'Wimko King 2', '$2y$10$NYylfMQpfoDFE.qPxCZx5.o.u6IgS2eu7nKm9DqikMK3GZaK.8w4u', 'wimko.kun2@gmail.com', '2019-02-24 20:58:52'),
(6, 'Wimko King 2', '$2y$10$jSed6l9BdsbKqWudovyOxeXaGwdM3z7STnQ/ogHhUwMf9qZKLjdZa', 'wimko.kun22@gmail.com', '2019-02-24 21:07:08'),
(7, 'Wimko King 2', '$2y$10$rgeVjGGah02pxObf4HsrOeUsWpQZU81Re7fEYM9iQdUU/2VcBos/y', 'wimko.kun221@gmail.com', '2019-02-24 21:09:29'),
(8, 'Wimko King 2', '$2y$10$/saCar4t5eWXqSNhVeXYy.n0kCXpyJAvDWsOA9EmacSUrTLvNOW/y', 'wimko.kun5221@gmail.com', '2019-02-24 21:12:07'),
(9, 'Matej JurÃ­k', '$2y$10$VKJA4ZMLiV3dDW/FEXdPWeErvK.QGPPT47FFE6DTnpFf.T/rbyZqq', 'jurik.matejw@gmail.com', '2019-02-24 21:25:17'),
(10, 'Wimko King 2', '$2y$10$EvePGBBbRVizzxWEyg7aXOFmCgL5KkUu/2zSrWcZfY6vKWM6Ujo92', 'test@test.com', '2019-02-24 21:33:07'),
(11, 'Filip', '$2y$10$nlnUUKSVTpjxDMUtGMa5JetVLI9Xl8iL9l4FV2R8Mr9vWUiDyJEAi', 'domacasla@azet.sk', '2019-02-24 21:34:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
