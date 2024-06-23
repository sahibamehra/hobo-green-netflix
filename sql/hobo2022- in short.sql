SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `hobo2022`;
CREATE DATABASE IF NOT EXISTS `hobo2022` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hobo2022`;

CREATE TABLE `abonnement` (
  `AboID` int(10) NOT NULL,
  `AboNaam` varchar(50) DEFAULT NULL,
  `MaxDevices` int(10) DEFAULT NULL,
  `StreamKwaliteit` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `abonnement` (`AboID`, `AboNaam`, `MaxDevices`, `StreamKwaliteit`) VALUES
(1, 'Basis', 1, 10);...

CREATE TABLE `aflevering` (
  `AfleveringID` int(10) NOT NULL,
  `SeizID` int(10) NOT NULL,
  `Rang` int(10) DEFAULT NULL,
  `AflTitel` varchar(100) DEFAULT NULL,
  `Duur` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `aflevering` (`AfleveringID`, `SeizID`, `Rang`, `AflTitel`, `Duur`) VALUES
(15733, 1311, 7, 'Aflevering S1E7', 35);...

CREATE TABLE `genre` (
  `GenreID` int(10) NOT NULL,
  `GenreNaam` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `genre` (`GenreID`, `GenreNaam`) VALUES
(2, 'Science Ficton'),
(3, 'Horror'),
(4, 'Historical'),
(5, 'Crime'),
(6, 'Drama'),
(7, 'Fantasy'),
(8, 'Romance'),
(9, 'Detective'),
(10, 'Teen'),
(11, 'Comedy'),
(12, 'Satire'),
(13, 'Coming of Age'),
(14, 'Biopic'),
(15, 'Suspense'),
(16, 'Children'),
(17, 'Adventure'),
(18, 'Supernatural'),
(19, 'Thriller'),
(20, 'Docu'),
(21, 'Art'),
(22, 'Culinary'),
(23, 'True Crime'),
(24, 'Superhero'),
(25, 'Political'),
(26, 'Travel'),
(27, 'Cooking'),
(28, 'Drug'),
(29, 'Lifestyle'),
(30, 'Sports');

CREATE TABLE `klant` (
  `KlantNr` int(10) NOT NULL,
  `AboID` int(10) NOT NULL,
  `Voornaam` varchar(50) DEFAULT NULL,
  `Tussenvoegsel` varchar(10) DEFAULT NULL,
  `Achternaam` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `Genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klant`
--

INSERT INTO `klant` (`KlantNr`, `AboID`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Email`, `password`, `Genre`) VALUES
(10002, 1, 'Sahiba', '', 'Mehra', 'sahiba@mail.com', 'sahiba', 'Science Ficton');...

CREATE TABLE `seizoen` (
  `SeizoenID` int(10) NOT NULL,
  `SerieID` int(10) NOT NULL,
  `Rang` int(11) DEFAULT NULL,
  `Jaar` int(4) DEFAULT NULL,
  `IMDBRating` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `seizoen` (`SeizoenID`, `SerieID`, `Rang`, `Jaar`, `IMDBRating`) VALUES
(1, 1, 1, 2016, 3);...

CREATE TABLE `serie` (
  `SerieID` int(10) NOT NULL,
  `SerieTitel` varchar(100) DEFAULT NULL,
  `IMDBLink` varchar(100) DEFAULT NULL,
  `Actief` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `serie` (`SerieID`, `SerieTitel`, `IMDBLink`, `Actief`) VALUES
(1, 'Stranger Things', 'https://www.imdb.com/title/tt0903747/', 1);...

CREATE TABLE `serie_genre` (
  `SerieID` int(10) NOT NULL,
  `GenreID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `serie_genre` (`SerieID`, `GenreID`) VALUES
(5, 5);...

CREATE TABLE `stream` (
  `StreamID` int(10) NOT NULL,
  `KlantID` int(10) NOT NULL,
  `AflID` int(10) NOT NULL,
  `d_start` datetime DEFAULT NULL,
  `d_eind` datetime DEFAULT NULL,
  `IP` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `stream` (`StreamID`, `KlantID`, `AflID`, `d_start`, `d_eind`, `IP`) VALUES
(86, 10003, 9970, '2022-01-16 20:00:34', '2022-01-16 20:30:34', '6');...

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@mail.com', 'admin123');

ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`AboID`);


ALTER TABLE `aflevering`
  ADD PRIMARY KEY (`AfleveringID`),
  ADD KEY `FKAflevering938760` (`SeizID`);

ALTER TABLE `genre`
  ADD PRIMARY KEY (`GenreID`);

ALTER TABLE `klant`
  ADD PRIMARY KEY (`KlantNr`),
  ADD KEY `FKKlant` (`AboID`);

ALTER TABLE `seizoen`
  ADD PRIMARY KEY (`SeizoenID`),
  ADD KEY `FKSeizoen` (`SerieID`);

ALTER TABLE `serie`
  ADD PRIMARY KEY (`SerieID`);

ALTER TABLE `serie_genre`
  ADD PRIMARY KEY (`SerieID`,`GenreID`),
  ADD KEY `FKSerie_Genre` (`GenreID`);

ALTER TABLE `stream`
  ADD PRIMARY KEY (`StreamID`),
  ADD KEY `FKStream1` (`AflID`),
  ADD KEY `FKStream2` (`KlantID`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `abonnement`
  MODIFY `AboID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `aflevering`
  MODIFY `AfleveringID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15734;

ALTER TABLE `genre`
  MODIFY `GenreID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `klant`
  MODIFY `KlantNr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11050;

ALTER TABLE `seizoen`
  MODIFY `SeizoenID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1312;

ALTER TABLE `serie`
  MODIFY `SerieID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=642;

ALTER TABLE `stream`
  MODIFY `StreamID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `aflevering`
  ADD CONSTRAINT `FKAflevering938760` FOREIGN KEY (`SeizID`) REFERENCES `seizoen` (`SeizoenID`);

ALTER TABLE `klant`
  ADD CONSTRAINT `FKKlant746383` FOREIGN KEY (`AboID`) REFERENCES `abonnement` (`AboID`);

ALTER TABLE `serie_genre`
  ADD CONSTRAINT `FKSerie_Genr109508` FOREIGN KEY (`GenreID`) REFERENCES `genre` (`GenreID`),
  ADD CONSTRAINT `FKSerie_Genr458403` FOREIGN KEY (`SerieID`) REFERENCES `serie` (`SerieID`);

ALTER TABLE `stream`
  ADD CONSTRAINT `FKStream706155` FOREIGN KEY (`AflID`) REFERENCES `aflevering` (`AfleveringID`),
  ADD CONSTRAINT `FKStream895793` FOREIGN KEY (`KlantID`) REFERENCES `klant` (`KlantNr`);
COMMIT;