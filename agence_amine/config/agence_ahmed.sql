-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 12, 2024 at 07:29 PM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `agence_ahmed`

-- --------------------------------------------------------

-- Table structure for table `apprenant`

DROP TABLE IF EXISTS `apprenant`;
CREATE TABLE IF NOT EXISTS `apprenant` (
  `ID_APPRENANT` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Date_Naissance` date NOT NULL,
  `Adresse` varchar(100) NOT NULL,
  `Telephone` varchar(15) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Date_Inscription` date NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_APPRENANT`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `apprenant`

INSERT INTO `apprenant` (`ID_APPRENANT`, `Nom`, `Prenom`, `Date_Naissance`, `Adresse`, `Telephone`, `Email`, `Date_Inscription`, `login`, `password`) VALUES
(1, 'hbez', 'gho', '2024-09-25', 'ghucuxch', 'chv', 'vhvhghgchc@jv.com', '2024-09-05', 'admin', '$2y$10$d5kz4QuxKvxGIVTe1zof3O220NUo5dyLe3.J2YgissGifK6CM2QS2');

-- --------------------------------------------------------

-- Table structure for table `cours`

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `ID_COURS` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_COURS` varchar(255) NOT NULL,
  `DESCRIPTION` text,
  PRIMARY KEY (`ID_COURS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `messages`

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `messages`

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `date`) VALUES
(1, 'jhe', 'hezvjehv@yahoo.com', 'ezbkfbkjbkbkekf', '2024-09-06 15:02:53');

-- --------------------------------------------------------

-- Table structure for table `moniteur`

DROP TABLE IF EXISTS `moniteur`;
CREATE TABLE IF NOT EXISTS `moniteur` (
  `ID_MONITEUR` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Date_Naissance` date NOT NULL,
  `Adresse` varchar(100) NOT NULL,
  `Telephone` varchar(15) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Date_Embauche` date DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_MONITEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `moniteur`

INSERT INTO `moniteur` (`ID_MONITEUR`, `Nom`, `Prenom`, `Date_Naissance`, `Adresse`, `Telephone`, `Email`, `Date_Embauche`, `login`, `password`) VALUES
(1, 'ahmed', 'ahmed', '2024-09-27', 'rades', '11244432', 'RVFE@ZBZEIFVB.com', NULL, 'rehkbak', '$2y$10$IZKsXV3ns49EfH6ROnoMC.cgEgUp4hpxrAee/3ynXtGEgv2Vaqb3.'),
(2, 'ahmed', 'ahmed', '2024-09-27', 'rades', '11244432', 'RVFE@ZBZEIFVB.com', '2024-09-22', 'rehkbak', '$2y$10$uQtqS/29J1/wtRRJRIv1nuGJBynjtpUrcI6tQ/TmZpg38RCrngF/a');

-- --------------------------------------------------------

-- Table structure for table `reservation`

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `ID_RESERVATION` int(11) NOT NULL AUTO_INCREMENT,
  `ID_COURS` int(11) DEFAULT NULL,
  `DATE_RESERVATION` date DEFAULT NULL,
  `HEURES` int(11) DEFAULT NULL,
  `ID_MONITEUR` int(11) DEFAULT NULL,
  `PRIX_TOTAL` decimal(10,2) DEFAULT NULL,
  `ID_APPRENANT` int(11) DEFAULT NULL,
  `STATUT` enum('En attente','Acceptée','Refusée') DEFAULT 'En attente',
  PRIMARY KEY (`ID_RESERVATION`),
  KEY `ID_COURS` (`ID_COURS`),
  KEY `ID_MONITEUR` (`ID_MONITEUR`),
  KEY `ID_APPRENANT` (`ID_APPRENANT`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `reservation`

INSERT INTO `reservation` (`ID_RESERVATION`, `ID_COURS`, `DATE_RESERVATION`, `HEURES`, `ID_MONITEUR`, `PRIX_TOTAL`, `ID_APPRENANT`, `STATUT`) VALUES
(1, NULL, '2024-09-21', 123, 1, '2460.00', 1, 'En attente'),
(2, 1, '2024-09-14', 122, 1, '2440.00', 1, 'En attente'),
(3, 1, '2024-09-19', 12, 1, '240.00', NULL, 'En attente');

-- --------------------------------------------------------

-- Table structure for table `reservation_cours`

DROP TABLE IF EXISTS `reservation_cours`;
CREATE TABLE IF NOT EXISTS `reservation_cours` (
  `ID_RESERVATION_COURS` int(11) NOT NULL AUTO_INCREMENT,
  `ID_RESERVATION` int(11) NOT NULL,
  `ID_COURS` int(11) NOT NULL,
  PRIMARY KEY (`ID_RESERVATION_COURS`),
  KEY `ID_RESERVATION` (`ID_RESERVATION`),
  KEY `ID_COURS` (`ID_COURS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `service_moto`

DROP TABLE IF EXISTS `service_moto`;
CREATE TABLE IF NOT EXISTS `service_moto` (
  `ID_moto` int(11) NOT NULL AUTO_INCREMENT,
  `Type_moto` varchar(255) NOT NULL,
  `Marque` varchar(255) NOT NULL,
  `Modele` varchar(255) NOT NULL,
  `Immatriculation` varchar(255) NOT NULL,
  `Prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_moto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into the `service_moto` table
INSERT INTO `service_moto` (`Type_moto`, `Marque`, `Modele`, `Immatriculation`, `Prix`) VALUES
('Sportive', 'Yamaha', 'YZF-R1', 'AB123CD', 1700.00),
('Cruiser', 'Harley-Davidson', 'Iron 883', 'EF456GH', 800.00),
('Touring', 'Honda', 'Gold Wing', 'IJ789KL', 1200.00),
('Custom', 'Kawasaki', 'Vulcan S', 'MN012OP', 1000.00),
('Scooter', 'Piaggio', 'Vespa GTS', 'QR345ST', 800.00);

-- --------------------------------------------------------

-- Table structure for table `vehicule`

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `ID_VEHICULE` int(11) NOT NULL AUTO_INCREMENT,
  `Type_Vehicule` varchar(255) DEFAULT NULL,
  `Marque` varchar(50) NOT NULL,
  `Modele` varchar(50) NOT NULL,
  `Immatriculation` varchar(15) NOT NULL,
  PRIMARY KEY (`ID_VEHICULE`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
