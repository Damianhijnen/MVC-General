/*Week 1 map dus je main code Dame*/
-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 25 mrt 2022 om 08:25
-- Serverversie: 5.7.31
-- PHP-versie: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvcframework`
--
CREATE DATABASE IF NOT EXISTS `mvc-week1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mvc-week1`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `capitalCity` varchar(300) NOT NULL,
  `continent` enum('Afrika','Antarctica','Azië','Australië/Oceanië','Europa','Noord-Amerika','Zuid-Amerika') NOT NULL,
  `population` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `country`
--

INSERT INTO `country` (`id`, `name`, `capitalCity`, `continent`, `population`) VALUES
(1, 'Nederland1', 'Amsterdam1', 'Zuid-Amerika', 17134873),
(2, 'Rwandas', 'Kigalies', 'Europa', 12952219),
(3, 'Chili', 'Santiago', 'Zuid-Amerika', 19116201),
(4, 'Canada', 'Ottawa', 'Noord-Amerika', 37742154),
(5, 'Australië', 'Canberra', 'Australië/Oceanië', 25499884),
(6, 'China', 'Beijing', 'Azië', 1439323776),
(7, '-', '-', 'Antarctica', 10000);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `fruit`
--

DROP TABLE IF EXISTS `fruit`;
CREATE TABLE IF NOT EXISTS `fruit` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `fruit`
--

INSERT INTO `fruit` (`id`, `name`, `color`, `price`) VALUES
(3, 'Paprikaatje', 'roodbruin', 2.45),
(4, 'Citroen', 'geel', 1.67),
(5, 'Aardbei', 'rood', 2.56),
(6, 'Peer', 'groen', 0.88);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `password`) VALUES
(1, 'rra', 'rra@mboutrecht.nl', 'Geheim!'),
(2, 'hsok', 'hsok@mboutrecht.nl', 'Geheim!');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

use `mvc-week1`;

select * from country;

SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
FROM Orders
INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID;