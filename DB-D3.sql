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
-- I
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


--
-- 				Inserts
--
insert into `Reservation` values(null, 1, 1100, 1, '1', current_timestamp(), current_timestamp(), '2022-12-14', 0 );
insert into `Reservation` values(null, 2, 1100, 1, '4', current_timestamp(), current_timestamp(), '2022-12-14', 0 );
insert into `Reservation` values(null, 3, 1100, 1, '3', current_timestamp(), current_timestamp(), '2022-12-14', 0 );
insert into `Reservation` values(null, 4, 1100, 1, '2', current_timestamp(), current_timestamp(), '2022-12-14', 0 );




insert into `SpareSoftwareSystem` values(null, 3, 1, '2022-12-13', 250, 'John' );
insert into `SpareSoftwareSystem` values(null, 3, 1, '2022-12-13', 212, 'Lynn' );
insert into `SpareSoftwareSystem` values(null, 3, 1, '2022-12-13', 115, 'Jack' );
insert into `SpareSoftwareSystem` values(null, 1, 2, '2022-12-14', 143, 'Diana' );
insert into `SpareSoftwareSystem` values(null, 6, 3, '2022-12-14', 143, 'Peter' );
insert into `SpareSoftwareSystem` values(null, 6, 3, '2022-12-14', 112, 'Damian' );
insert into `SpareSoftwareSystem` values(null, 3, 4, '2022-12-14', 298, 'John' );


insert into `SpareSoftwareSystem` values(null, 1, 1, '2022-12-13', 250, 'Mazin' );
insert into `SpareSoftwareSystem` values(null, 1, 1, '2022-12-13', 212, 'Lynn' );
insert into `SpareSoftwareSystem` values(null, 1 ,1, '2022-12-13', 115, 'Jack' );
insert into `SpareSoftwareSystem` values(null, 1, 4, '2022-12-14', 298, 'Mazin' );



-- ----------------------------------------------------------------
-- -----------------------------------------------------------------
-- -----------------------------------------------------------------
-- -----------------------Deel2-------------------------------------
-- -----------------------------------------------------------------
-- -----------------------------------------------------------------
-- -----------------------------------------------------------------
-- -----------------------------------------------------------------


DROP TABLE IF EXISTS `Baan`;
CREATE TABLE IF NOT EXISTS `Baan` (
	`ID` INT(100) NOT NULL auto_increment,
	`Nummer` INT(100) NOT NULL,
	`HeeftHek` Bool,

    
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Reservering`;
CREATE TABLE IF NOT EXISTS `Reservering` (
    `ID` INT(100) NOT NULL auto_increment,
   `persoonID` INT(100) NOT NULL,
   `OpeningstijdId` INT(11) NOT NULL,
   `TariefID` INT NOT NULL,
   `BaanId` INT NOT NULL,
   `PakketOptieId` INT(11),
   `ReserveringStatusId` INT(11) NOT NULL,
   `Reserveringsnummer` bigint(255) NOT NULL,
   `Datum` Date NOT NULL,
   `AantalUren` int(2) NOT NULL,
   `BeginTijd` time not null,
   `EindTijd` time not null,
   `AantalVolwassen` int(2),
   `AantalKinderen` int(2),


  PRIMARY KEY (`ID`)
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `Persoon`;
CREATE TABLE IF NOT EXISTS `Persoon` (
	`ID` INT(100) NOT NULL auto_increment,
	`TypePersoonId` INT(255) NOT NULL,
	`Voornaam` Varchar(255) NOT NULL,
	`Tussenvoegsel` varchar (50),
    `Achternaam` varchar(255) NOT NULL,
    `Roepnaam` varchar(255) NOT NULL,
	`IsVolwassen` bool,


    
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `Spel`;
CREATE TABLE IF NOT EXISTS `Spel` (
	`ID` INT(100) NOT NULL auto_increment,
	`PersoonId` INT(255) NOT NULL,
	`ReseveringID` INT(255) NOT NULL,

  PRIMARY KEY (`ID`),
	KEY `FK_PersoonId` (`PersoonId`),
    KEY `FK_ReseveringID` (`ReseveringID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `uitslag`;
CREATE TABLE IF NOT EXISTS `uitslag` (
	`ID` INT(100) NOT NULL auto_increment,
	`SpelId` INT(255) NOT NULL,
	`Aantalpunten` INT(255) NOT NULL,

  PRIMARY KEY (`ID`),
  	KEY `FK_SpelId` (`SpelId`)

) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
--
-- Contstrains / Keys
--
--
ALTER TABLE `Spel`
	ADD CONSTRAINT `FK_PersoonId` FOREIGN KEY (`PersoonId`) REFERENCES `Persoon` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


ALTER TABLE `uitslag`
	ADD CONSTRAINT `FK_SpelId` FOREIGN KEY (`SpelId`) REFERENCES `Spel` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `spel`
	ADD CONSTRAINT `FK_ReseveringID` FOREIGN KEY (`ReseveringID`) REFERENCES `Reservering` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

--
--
--    Insertions
--
--

insert into `Persoon` values(1, 1, 'Mazin', NULL, 'Jamil', 'Mazin', 1);
insert into `Persoon` values(2, 1, 'Arjan', 'De', 'Ruijer', 'Arjan', 1);
insert into `Persoon` values(3, 1, 'Hans', NULL, 'Odijk', 'Hans', 1);
insert into `Persoon` values(4, 1, 'Dennis', 'van', 'Wakeren', 'Dennis', 1);
insert into `Persoon` values(5, 2, 'Wilco', 'van de', 'Grift', 'Wilco', 1);
insert into `Persoon` values(6, 3, 'Tom', NULL, 'Sanders', 'Tom', 0);
insert into `Persoon` values(7, 2, 'Andrew', NULL, 'Sanders', 'Andrew', 0);
insert into `Persoon` values(8, 2, 'Julian', NULL, 'Kaldenheuvel', 'Julian', 1);

select * from `Reservering`;


insert into `Baan` values(1, 1, 0);
insert into `Baan` values(2, 2, 0);
insert into `Baan` values(3, 3, 0);
insert into `Baan` values(4, 4, 0);
insert into `Baan` values(5, 5, 0);
insert into `Baan` values(6, 6, 0);
insert into `Baan` values(7, 7, 1);
insert into `Baan` values(8, 8, 1);



insert into `Reservering` values(1, 1, 2, 1, 8, 1, 1, 2022122000001, '2022-12-20', 1, '15:00', '16:00', '4', '2');
insert into `Reservering` values(2, 2, 2, 1, 2, 3, 1, 2022122000002, '2022-12-20', 1, '17:00', '18:00', '4', NULL);
insert into `Reservering` values(3, 3, 7, 2, 3, 1, 1, 2022122000003, '2022-12-24', 2, '16:00', '18:00', '4', NULL);
insert into `Reservering` values(4, 1, 2, 1, 6, NULL, 1, 2022122000004, '2022-12-27', 2, '17:00', '19:00', '2', NULL);
insert into `Reservering` values(5, 4, 3, 1, 4, 4, 1, 2022122000005, '2022-12-28', 1, '14:00', '15:00', '3', NULL);
insert into `Reservering` values(6, 5, 10, 3, 5, 4, 1, 2022122000006, '2022-12-28', 2, '19:00', '21:00', '2', NULL);
insert into `Reservering` values(7, 1, 10, 1, 5, 4, 1, 2022122000007, '2022-12-28', 2, '19:00', '21:00', '2', NULL);


insert into `spel` values(1, 1, 1);
insert into `spel` values(2, 2, 2);
insert into `spel` values(3, 3, 3);
insert into `spel` values(4, 4, 4);
insert into `spel` values(5, 5, 5);
insert into `spel` values(6, 6, 4);
insert into `spel` values(7, 7, 4);
insert into `spel` values(8, 8, 4);

insert into `spel` values(9, 1, 5);



insert into `uitslag` values(1, 1, 290);
insert into `uitslag` values(2, 2, 300);
insert into `uitslag` values(3, 3, 120);
insert into `uitslag` values(4, 4, 34);
insert into `uitslag` values(5, 6, 234);
insert into `uitslag` values(6, 7, 299);






select * from `baan`;


select * from `reservering`;



SELECT  Reservering.ID, Reservering.persoonID, Reservering.OpeningstijdId, Reservering.TariefID, Reservering.BaanId, Reservering.PakketOptieId, Reservering.ReserveringStatusId,
                                Reservering.Reserveringsnummer,  Reservering.Datum,  Reservering.AantalUren,  Reservering.BeginTijd, Reservering.EindTijd, Reservering.AantalVolwassen, Reservering.AantalKinderen,
                                Baan.nummer, Baan.Heefthek
        FROM Reservering
        right JOIN Baan ON Reservering.BaanId = Baan.ID where Reservering.ID > 0 ;
     -- 
     --
     --
     --
     --

SELECT uitslag.ID, uitslag.SpelId, spel.ReseveringID, Persoon.ID, Persoon.Voornaam, Persoon.Tussenvoegsel, Persoon.Achternaam, uitslag.Aantalpunten
        FROM uitslag
        right JOIN spel ON spel.ID = uitslag.ID  
        right JOIN Persoon ON spel.PersoonId = Persoon.ID WHERE spel.ReseveringID= 4 order by Aantalpunten DESC;
        


