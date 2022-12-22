DROP DATABASE IF EXISTS examen;
CREATE DATABASE examen;
USE examen;

-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 12 apr 2022 om 12:13
-- Serverversie: 5.7.31
-- PHP-versie: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magazijn`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tarif`
--

DROP TABLE IF EXISTS `tarif`;
CREATE TABLE IF NOT EXISTS `tarif` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Days` enum('Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag','Zondag') NOT NULL,
  `TIME` TIME NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


insert into `tarif` values(1, 'Maandag', '10:00:00');
insert into `tarif` values(2, 'Maandag', '10:00:00');
select * from tarif;
-- --------------------------------------------------------
--
-- Tabel structuur voor bowling alley
--


DROP TABLE IF EXISTS `BowlingAlley`;
CREATE TABLE IF NOT EXISTS `BowlingAlley` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Days` enum('Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag','Zondag') NOT NULL,
  `TIME` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------
--
--  Extra opties tabel
--


DROP TABLE IF EXISTS `ExtraOpties`;
CREATE TABLE IF NOT EXISTS `ExtraOpties` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Opties` varchar(100),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------------
--
-- Permisions tabel
--
DROP TABLE IF EXISTS `Permision`;
CREATE TABLE IF NOT EXISTS `Permision` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Permision` varchar(100),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Tabelstructuur voor tabel `category_product`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
  `ID` int(11) NOT NULL,
  `FirsName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Contact_gegevens_id` INT(11),
  `Permision` INT(11) NOT NULL,
	PRIMARY KEY (`ID`),
	KEY `FK_Permision` (`Permision`),
    KEY `FK_Contact` (`Contact_gegevens_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Tabelstructuur voor tabel `dashboard_pages`
--

DROP TABLE IF EXISTS `Contact_Gegevens`;
CREATE TABLE IF NOT EXISTS `Contact_Gegevens` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Voornaam` varchar(255) NOT NULL,
  `TussenVoegsel` varchar(100),
  `Achternaam` Varchar(200) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Telefoonnummer` int(15) NOT NULL,
  `GeboorteDatum` Date NOT NULL,
	PRIMARY KEY (`ID`)
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `dashboard_pages`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `password`
--

DROP TABLE IF EXISTS `Reservation`;
CREATE TABLE IF NOT EXISTS `Reservation` (
    `ID` INT(100) NOT NULL auto_increment,
  `UserID` INT(100) NOT NULL,
  `Time` TIME NOT NULL,
  `Tarif` INT NOT NULL,
  `Alley` INT NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateOfReservation` DATE NOT NULL,
  `ExtraOpties` INT(10) NOT NULL,
  PRIMARY KEY (`ID`),
	KEY `FK_ExtraOpties` (`ExtraOpties`),
	KEY `FK_UserID` (`UserID`),
	KEY `FK_Tarif` (`Tarif`),
	KEY `FK_Aley` (`Alley`)
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `password`
--

DROP TABLE IF EXISTS `SpareSoftwareSystem`;
CREATE TABLE IF NOT EXISTS `SpareSoftwareSystem` (
	`ID` INT(100) NOT NULL auto_increment,
	`UserID` INT(100) NOT NULL,
	`ReservationID` INT(10),
    `DATE` DATE NOT NULL,
	`Score` INT(10) NOT NULL,
	`Score_Name` varchar(150) NOT NULL,
    
  PRIMARY KEY (`ID`),
	KEY `FK_UserID` (`UserID`),
	KEY `FK_ReservationID` (`ReservationID`)

  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- -------
--






-- -----------------------------------------------------

--
-- Tabelstructuur voor tabel `warehouse`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `warehouse_category`
--




--
-- Beperkingen voor tabel `user`
-- Foreign Keys `user`

ALTER TABLE `User`
	ADD CONSTRAINT `FK_Permision` FOREIGN KEY (`Permision`) REFERENCES `Permision` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;	
ALTER TABLE `User`
	ADD CONSTRAINT `FK_Contact` FOREIGN KEY (`Contact_gegevens_id`) REFERENCES `Contact_Gegevens` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

--
-- Beperkingen voor tabel `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `FK_ExtraOpties` FOREIGN KEY (`ExtraOpties`) REFERENCES `ExtraOpties` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT; 
ALTER TABLE `Reservation`
  ADD CONSTRAINT `FK_UserID` FOREIGN KEY (`UserID`) REFERENCES `User` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;
ALTER TABLE `Reservation`
  ADD CONSTRAINT `FK_Tarif` FOREIGN KEY (`Tarif`) REFERENCES `Tarif` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;
ALTER TABLE `Reservation`
  ADD CONSTRAINT `FK_Alley` FOREIGN KEY (`Alley`) REFERENCES `BowlingAlley` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;



insert into `SpareSoftwareSystem` values(null, 3, 1, '2022-12-13', 250, 'John' );
insert into `SpareSoftwareSystem` values(null, 3, 1, '2022-12-13', 212, 'Lynn' );
insert into `SpareSoftwareSystem` values(null, 3, 1, '2022-12-13', 115, 'Jack' );
insert into `SpareSoftwareSystem` values(null, 1, 2, '2022-12-14', 143, 'Diana' );
insert into `SpareSoftwareSystem` values(null, 6, 3, '2022-12-14', 143, 'Peter' );
insert into `SpareSoftwareSystem` values(null, 6, 3, '2022-12-14', 112, 'Damian' );
insert into `SpareSoftwareSystem` values(null, 3, 4, '2022-12-14', 298, 'John' );


select * from user;


SET FOREIGN_KEY_CHECKS=0;

insert into `Reservation` values(null, 1, 1100, 1, '1', current_timestamp(), current_timestamp(), '2022-12-14', 0 );
insert into `Reservation` values(null, 2, 1100, 1, '4', current_timestamp(), current_timestamp(), '2022-12-14', 0 );
insert into `Reservation` values(null, 3, 1100, 1, '3', current_timestamp(), current_timestamp(), '2022-12-14', 0 );
insert into `Reservation` values(null, 4, 1100, 1, '2', current_timestamp(), current_timestamp(), '2022-12-14', 0 );


select * from reservation;

select * from `SpareSoftwareSystem`;
select * from `SpareSoftwareSystem` WHERE ReservationID = 3;
select * from Reservation;
select * from `SpareSoftwareSystem` where UserID = 3;


SELECT spareSoftwareSystem.UserID, spareSoftwareSystem.ReservationID, SpareSoftwareSystem.ID, SpareSoftwareSystem.Score, SpareSoftwareSystem.Score_Name, SpareSoftwareSystem.DATE, Reservation.Alley
FROM SpareSoftwareSystem
right JOIN Reservation ON SpareSoftwareSystem.ReservationID=Reservation.ID WHERE SpareSoftwareSystem.UserID = 3;
