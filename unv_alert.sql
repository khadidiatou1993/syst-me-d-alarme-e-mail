-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 25 juil. 2019 à 13:38
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `unv_alert`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

DROP TABLE IF EXISTS `agence`;
CREATE TABLE IF NOT EXISTS `agence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomagc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`id`, `nomagc`) VALUES
(1, 'PNUD'),
(2, 'UNICEF'),
(3, 'ONU FEMMES');

-- --------------------------------------------------------

--
-- Structure de la table `alert`
--

DROP TABLE IF EXISTS `alert`;
CREATE TABLE IF NOT EXISTS `alert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomagt` text NOT NULL,
  `prenoms` text NOT NULL,
  `datedeb` date NOT NULL,
  `datefin` date NOT NULL,
  `aniv` date NOT NULL,
  `agence` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `alert`
--

INSERT INTO `alert` (`id`, `nomagt`, `prenoms`, `datedeb`, `datefin`, `aniv`, `agence`) VALUES
(1, 'DOFFOU', 'Naomi Lorenzi', '2019-07-01', '2019-08-31', '2019-06-30', 1),
(2, 'SAGNA', 'Khadidiatou', '2019-07-01', '2019-09-30', '2019-08-24', 1),
(3, 'DRAMANE', 'Ali', '2019-07-04', '2019-09-04', '2019-07-17', 3),
(4, 'DIAKITE', 'Modou', '2019-07-09', '2019-12-30', '2019-08-14', 3),
(5, 'Grogue', 'Yasmine', '2017-03-25', '2019-10-15', '2019-09-30', 2),
(6, 'Yaya', 'Sanogo', '2018-07-03', '2020-04-25', '2019-07-17', 2),
(7, 'Hamza', 'Eli', '2019-07-23', '2019-10-23', '2019-09-23', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
