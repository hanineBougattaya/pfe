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
  PRIMARY KEY (`ID_APPRENANT`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `apprenant`

INSERT INTO `apprenant` (`ID_APPRENANT`, `Nom`, `Prenom`, `Date_Naissance`, `Adresse`, `Telephone`, `Email`, `Date_Inscription`) VALUES
(1, 'Ben Ali', 'Ahmed', '1985-12-15', '12 Avenue Habib Bourguiba, Tunis', '+21612345678', 'ahmed.benali@example.tn', '2024-09-05');

-- --------------------------------------------------------

-- Table structure for table `cours`

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `ID_COURS` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_COURS` varchar(255) NOT NULL,
  `DESCRIPTION` text,
  PRIMARY KEY (`ID_COURS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `cours`

INSERT INTO `cours` (`ID_COURS`, `NOM_COURS`, `DESCRIPTION`) VALUES
(1, 'Conduite Moto', 'Cours pour apprendre la conduite des motos.'),
(2, 'Code de la Route', 'Cours sur les règles de conduite et les lois de la route.');

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
(1, 'Khaled', 'khaled.benali@example.tn', 'Bonjour, je suis intéressé par les cours.', '2024-09-06 15:02:53');

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
  PRIMARY KEY (`ID_MONITEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `moniteur`

INSERT INTO `moniteur` (`ID_MONITEUR`, `Nom`, `Prenom`, `Date_Naissance`, `Adresse`, `Telephone`, `Email`, `Date_Embauche`) VALUES
(1, 'Khalil', 'Mohamed', '1978-04-10', '20 Rue de la Liberté, Tunis', '+21687654321', 'mohamed.khalil@example.tn', '2024-09-01');

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
  `STATUT_PAIEMENT` enum('Non payé','Payé') DEFAULT 'Non payé',
  `REMARQUES` text DEFAULT NULL,
  PRIMARY KEY (`ID_RESERVATION`),
  KEY `ID_COURS` (`ID_COURS`),
  KEY `ID_MONITEUR` (`ID_MONITEUR`),
  KEY `ID_APPRENANT` (`ID_APPRENANT`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `reservation`

INSERT INTO `reservation` (`ID_RESERVATION`, `ID_COURS`, `DATE_RESERVATION`, `HEURES`, `ID_MONITEUR`, `PRIX_TOTAL`, `ID_APPRENANT`, `STATUT`, `STATUT_PAIEMENT`, `REMARQUES`) VALUES
(1, 1, '2024-09-21', 1, 1, '150.00', 1, 'En attente', 'Non payé', 'Besoin de confirmer la disponibilité.'),
(2, 2, '2024-09-14', 2, 1, '200.00', 1, 'Acceptée', 'Payé', 'Réservation confirmée.');

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

-- Insert data into the `service_moto` table
INSERT INTO `service_moto` (`Type_moto`, `Marque`, `Modele`, `Immatriculation`, `Prix`) VALUES
('Sportive', 'Yamaha', 'YZF-R1', '1234AB', 1700.00),
('Cruiser', 'Harley-Davidson', 'Iron 883', '5678CD', 800.00),
('Touring', 'Honda', 'Gold Wing', '9101EF', 1200.00),
('Custom', 'Kawasaki', 'Vulcan S', '1122GH', 1000.00),
('Scooter', 'Piaggio', 'Vespa GTS', '3344IJ', 800.00);

-- --------------------------------------------------------

-- Table structure for table `vehicule`

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

-- Insert sample data into the `vehicule` table
INSERT INTO `vehicule` (`Type_Vehicule`, `Marque`, `Modele`, `Immatriculation`) VALUES
('Moto', 'Honda', 'CBR 500R', 'TUN-001'),
('Moto', 'Yamaha', 'YZF-R3', 'TUN-002'),
('Moto', 'Kawasaki', 'Ninja 400', 'TUN-003'),
('Moto', 'Suzuki', 'GSX-R600', 'TUN-004'),
('Scooter', 'Yamaha', 'NMAX 155', 'TUN-005'),
('Scooter', 'Piaggio', 'Vespa GTS 300', 'TUN-006'),
('Scooter', 'Honda', 'SH 125i', 'TUN-007'),
('Scooter', 'Kymco', 'Like 125', 'TUN-008');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
