-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 18 avr. 2024 à 16:32
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `aga`
--

-- --------------------------------------------------------

--
-- Structure de la table `aga_cours`
--

DROP TABLE IF EXISTS `aga_cours`;
CREATE TABLE IF NOT EXISTS `aga_cours` (
  `Id_cours` int NOT NULL AUTO_INCREMENT,
  `Date_cours` date DEFAULT NULL,
  `HeureDebut_cours` time DEFAULT NULL,
  `HeureFin_cours` time NOT NULL,
  `Code_cours` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Id_promo` int NOT NULL,
  PRIMARY KEY (`Id_cours`),
  KEY `aga_Cours_aga_Promo_FK` (`Id_promo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `aga_cours`
--

INSERT INTO `aga_cours` (`Id_cours`, `Date_cours`, `HeureDebut_cours`, `HeureFin_cours`, `Code_cours`, `Id_promo`) VALUES
(1, '2024-04-11', '09:00:00', '12:00:00', NULL, 2),
(2, '2024-04-17', '13:00:00', '17:00:00', '18453', 1),
(3, '2024-04-17', '09:00:00', '12:00:00', '69646', 1),
(4, '2024-04-19', '09:00:00', '12:00:00', NULL, 1),
(5, '2024-04-19', '13:00:00', '17:00:00', NULL, 1),
(12, '2024-04-20', '09:00:00', '12:00:00', NULL, 1),
(13, '2024-04-20', '13:00:00', '17:00:00', NULL, 1),
(14, '2024-04-21', '09:00:00', '12:00:00', NULL, 1),
(15, '2024-04-21', '13:00:00', '17:00:00', NULL, 1),
(16, '2024-04-22', '09:00:00', '12:00:00', NULL, 1),
(17, '2024-04-22', '13:00:00', '17:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `aga_promo`
--

DROP TABLE IF EXISTS `aga_promo`;
CREATE TABLE IF NOT EXISTS `aga_promo` (
  `Id_promo` int NOT NULL AUTO_INCREMENT,
  `Nom_promo` varchar(255) DEFAULT NULL,
  `DateDebut_promo` date DEFAULT NULL,
  `DateFin_promo` date DEFAULT NULL,
  `Place_promo` int DEFAULT NULL,
  PRIMARY KEY (`Id_promo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `aga_promo`
--

INSERT INTO `aga_promo` (`Id_promo`, `Nom_promo`, `DateDebut_promo`, `DateFin_promo`, `Place_promo`) VALUES
(1, 'DWWM2', '2024-01-08', '2024-10-21', 15),
(2, 'DWWM3', '2024-01-08', '2024-10-22', 15);

-- --------------------------------------------------------

--
-- Structure de la table `aga_role`
--

DROP TABLE IF EXISTS `aga_role`;
CREATE TABLE IF NOT EXISTS `aga_role` (
  `Id_role` int NOT NULL AUTO_INCREMENT,
  `Nom_role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `aga_role`
--

INSERT INTO `aga_role` (`Id_role`, `Nom_role`) VALUES
(1, 'Apprenant.e'),
(2, 'Formateur.ice');

-- --------------------------------------------------------

--
-- Structure de la table `aga_utilisateur`
--

DROP TABLE IF EXISTS `aga_utilisateur`;
CREATE TABLE IF NOT EXISTS `aga_utilisateur` (
  `Id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `Nom_utilisateur` varchar(255) DEFAULT NULL,
  `Prenom_utilisateur` varchar(255) DEFAULT NULL,
  `MotDePasse_utilisateur` varchar(255) DEFAULT NULL,
  `Activiation_utilisateur` tinyint(1) DEFAULT NULL,
  `Email_utilisateur` varchar(255) DEFAULT NULL,
  `Id_role` int NOT NULL,
  PRIMARY KEY (`Id_utilisateur`),
  UNIQUE KEY `aga_Utilisateur_AK` (`Email_utilisateur`),
  KEY `aga_Utilisateur_aga_Role_FK` (`Id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `aga_utilisateur`
--

INSERT INTO `aga_utilisateur` (`Id_utilisateur`, `Nom_utilisateur`, `Prenom_utilisateur`, `MotDePasse_utilisateur`, `Activiation_utilisateur`, `Email_utilisateur`, `Id_role`) VALUES
(2, 'Grienay', 'Elio', '$2y$10$voJ6vnxhcCZwra4dXBjuF.eEffQn9VUUEQVBjhjImXN7ZFroQmIVC', 1, 'elodie.grienay@free.fr', 1),
(3, 'Bellintani', 'Théophile', '$2y$10$soz2lDvBqnltHWEGqWNh2uSn2o/mNe6m17D4YH1ZpEQtFR4/kl3y.', 1, 'theophile.bellintani@simplon.com', 2),
(4, 'Terme', 'Clément', '', 1, 'clement.t@simplon.com', 1),
(5, 'Rakotoarison', 'Herivola', '', 1, 'herivola.r@simplon.com', 1),
(30, 'Jambon', 'Yoan', '$2y$10$C4LWSdMS05i5GHX1/OmgP.Olp8ntDK3PzINZgkG2c4ZoQIuNMV/1K', 1, 'yoan@simplon.com', 1),
(31, 'Nachit', 'Amal', NULL, 1, 'amal@simplon.com', 1),
(32, 'Josi', 'Aubin', NULL, 1, 'aubin@simplon.com', 1),
(33, 'Saulle', 'Clément', NULL, 1, 'clement@simplon.com', 1),
(34, 'Maurand', 'Dimitri', NULL, 1, 'dimitri@simplon.com', 1),
(35, 'Ezzouine', 'Sanaa', NULL, 1, 'sanaa@simplon.com', 1),
(36, 'Vanhove', 'Killian', NULL, 1, 'killian@simplon.com', 1),
(37, 'Lanquette', 'Tonie', NULL, 1, 'tonie@simplon.com', 1),
(38, 'Roches', 'Laurent', NULL, 1, 'laurent@simplon.com', 1),
(39, 'Dos Santos Ferreira', 'Rodrigo', NULL, 1, 'rodrigo@simplon.com', 1),
(40, 'Burteaux', 'Salomé', NULL, 1, 'salome@simplon.com', 1),
(41, 'Santos De Souza', 'Bruno', NULL, 1, 'bruno@simplon.com', 1),
(42, 'Pithion', 'Sara', NULL, 1, 'sara@simplon.com', 1),
(43, 'Fedaily', 'Mohammed', NULL, 1, 'mohammed@simplon.com', 1),
(44, 'Altelab', 'Feras', NULL, 1, 'feras@simplon.com', 1),
(45, 'Zulpukharov', 'Arthur', NULL, 1, 'arthur@simplon.com', 1),
(46, 'Malignan', 'Olivier', NULL, 1, 'olivier@simplon.com', 1),
(47, 'Blankenmeister', 'Sonia', NULL, 1, 'sonia@simplon.com', 1),
(48, 'Adodo', 'Timothée', NULL, 1, 'timothee@simplon.com', 1),
(49, 'Formateur', 'Formateur', '$2y$10$rCGi0DN.Y3q2YCC4lOHqQeHcyhuce41RSt8plyr85YFAc6GMG/cCS', 1, 'formateur@simplon.com', 2);

-- --------------------------------------------------------

--
-- Structure de la table `aga_utilisateurpromo`
--

DROP TABLE IF EXISTS `aga_utilisateurpromo`;
CREATE TABLE IF NOT EXISTS `aga_utilisateurpromo` (
  `Id_utilisateur` int NOT NULL,
  `Id_promo` int NOT NULL,
  PRIMARY KEY (`Id_utilisateur`,`Id_promo`),
  KEY `aga_UtilisateurPromo_aga_Promo0_FK` (`Id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `aga_utilisateurpromo`
--

INSERT INTO `aga_utilisateurpromo` (`Id_utilisateur`, `Id_promo`) VALUES
(2, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(49, 1),
(3, 2),
(4, 2),
(5, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2);

-- --------------------------------------------------------

--
-- Structure de la table `aga_utilisateurscours`
--

DROP TABLE IF EXISTS `aga_utilisateurscours`;
CREATE TABLE IF NOT EXISTS `aga_utilisateurscours` (
  `Id_cours` int NOT NULL,
  `Id_utilisateur` int NOT NULL,
  `Absence_UtilisateursCours` tinyint(1) DEFAULT NULL,
  `Retard_UtilisateursCours` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id_cours`,`Id_utilisateur`),
  KEY `aga_UtilisateursCours_aga_Utilisateur0_FK` (`Id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `aga_utilisateurscours`
--

INSERT INTO `aga_utilisateurscours` (`Id_cours`, `Id_utilisateur`, `Absence_UtilisateursCours`, `Retard_UtilisateursCours`) VALUES
(1, 2, NULL, NULL),
(2, 2, 0, 1),
(2, 3, NULL, NULL),
(2, 30, NULL, 1),
(2, 32, 0, 1),
(2, 41, 0, 1),
(2, 48, 0, 1),
(3, 2, 0, 0),
(3, 3, NULL, NULL),
(3, 31, 0, 1),
(3, 37, 0, 1),
(3, 44, 0, 1),
(3, 45, 0, 1),
(3, 46, 0, 1),
(4, 2, NULL, NULL),
(4, 49, 0, 0),
(5, 2, NULL, NULL),
(5, 49, 0, 0),
(12, 2, NULL, NULL),
(12, 49, 0, 0),
(13, 2, NULL, NULL),
(13, 49, 0, 0),
(14, 2, NULL, NULL),
(14, 49, 0, 0),
(15, 2, NULL, NULL),
(15, 49, 0, 0),
(16, 2, NULL, NULL),
(16, 49, 0, 0),
(17, 2, NULL, NULL),
(17, 49, 0, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `aga_cours`
--
ALTER TABLE `aga_cours`
  ADD CONSTRAINT `aga_Cours_aga_Promo_FK` FOREIGN KEY (`Id_promo`) REFERENCES `aga_promo` (`Id_promo`);

--
-- Contraintes pour la table `aga_utilisateur`
--
ALTER TABLE `aga_utilisateur`
  ADD CONSTRAINT `aga_Utilisateur_aga_Role_FK` FOREIGN KEY (`Id_role`) REFERENCES `aga_role` (`Id_role`);

--
-- Contraintes pour la table `aga_utilisateurpromo`
--
ALTER TABLE `aga_utilisateurpromo`
  ADD CONSTRAINT `aga_UtilisateurPromo_aga_Promo0_FK` FOREIGN KEY (`Id_promo`) REFERENCES `aga_promo` (`Id_promo`),
  ADD CONSTRAINT `aga_UtilisateurPromo_aga_Utilisateur_FK` FOREIGN KEY (`Id_utilisateur`) REFERENCES `aga_utilisateur` (`Id_utilisateur`);

--
-- Contraintes pour la table `aga_utilisateurscours`
--
ALTER TABLE `aga_utilisateurscours`
  ADD CONSTRAINT `aga_UtilisateursCours_aga_Cours_FK` FOREIGN KEY (`Id_cours`) REFERENCES `aga_cours` (`Id_cours`),
  ADD CONSTRAINT `aga_UtilisateursCours_aga_Utilisateur0_FK` FOREIGN KEY (`Id_utilisateur`) REFERENCES `aga_utilisateur` (`Id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
