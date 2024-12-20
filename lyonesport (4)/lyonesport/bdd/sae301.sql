-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 déc. 2024 à 01:53
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae301`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `Id_compte` int(11) NOT NULL,
  `MotDePasse` varchar(30) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Identifiant` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`Id_compte`, `MotDePasse`, `Role`, `Prenom`, `Nom`, `Identifiant`) VALUES
(1, 'admin', 'admin', 'Lou', 'H', 'admin@gmail.com'),
(5, 'aefdqcv', 'utilisateur', 'vzedgFG', 'pefnjklaz', 'FZEDBIvg@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `Id_Evenement` int(11) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Description` text DEFAULT NULL,
  `Date` date NOT NULL,
  `Statut` varchar(30) NOT NULL,
  `Id_typeEvenement` int(11) DEFAULT NULL,
  `Id_compte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`Id_Evenement`, `Nom`, `Description`, `Date`, `Statut`, `Id_typeEvenement`, `Id_compte`) VALUES
(2, 'Lan 2025', 'On revient!\r\nAprès notre dernière édition en 2022, la LAN de la Lyon e-Sport revient en 2025! Restez connectés sur nos réseaux pour plus d’informations.', '2025-06-18', 'Refuser', 1, 1),
(3, 'Lyon Esport ', 'Prochaine Lyon esport ', '2025-03-14', 'Accepter', 2, 1),
(4, 'Convention', 'Convention 2024', '2025-10-14', 'En attente', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

CREATE TABLE `partenaire` (
  `Id_partenaire` int(11) NOT NULL,
  `NomPartenaire` varchar(30) DEFAULT NULL,
  `TypePartenaire` varchar(30) DEFAULT NULL,
  `Mail` varchar(30) NOT NULL,
  `Telephone` varchar(20) DEFAULT NULL,
  `Id_compte` int(11) DEFAULT NULL,
  `NumeroSiren` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `partenaire`
--

INSERT INTO `partenaire` (`Id_partenaire`, `NomPartenaire`, `TypePartenaire`, `Mail`, `Telephone`, `Id_compte`, `NumeroSiren`) VALUES
(1, 'dcadc', 'Particulier', 'amfnejfcvbnz@gmail.com', '0665000000', 1, '123456789');

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `Id_Evenement` int(11) NOT NULL,
  `Id_partenaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `participe`
--

INSERT INTO `participe` (`Id_Evenement`, `Id_partenaire`) VALUES
(2, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeevenement`
--

CREATE TABLE `typeevenement` (
  `Id_typeEvenement` int(11) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Id_compte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `typeevenement`
--

INSERT INTO `typeevenement` (`Id_typeEvenement`, `Nom`, `Id_compte`) VALUES
(1, 'Tournois', 1),
(2, 'Convention', 1),
(3, 'Sponsor équipe', 1),
(4, 'Conférence ', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`Id_compte`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`Id_Evenement`),
  ADD KEY `FK_TypeEvenement_Evenement` (`Id_typeEvenement`),
  ADD KEY `FK_Compte_Evenement` (`Id_compte`);

--
-- Index pour la table `partenaire`
--
ALTER TABLE `partenaire`
  ADD PRIMARY KEY (`Id_partenaire`),
  ADD KEY `FK_Compte_Partenaire` (`Id_compte`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`Id_Evenement`,`Id_partenaire`),
  ADD KEY `Id_partenaire` (`Id_partenaire`);

--
-- Index pour la table `typeevenement`
--
ALTER TABLE `typeevenement`
  ADD PRIMARY KEY (`Id_typeEvenement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `Id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `Id_Evenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `partenaire`
--
ALTER TABLE `partenaire`
  MODIFY `Id_partenaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `typeevenement`
--
ALTER TABLE `typeevenement`
  MODIFY `Id_typeEvenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_Compte_Evenement` FOREIGN KEY (`Id_compte`) REFERENCES `compte` (`Id_compte`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TypeEvenement_Evenement` FOREIGN KEY (`Id_typeEvenement`) REFERENCES `typeevenement` (`Id_typeEvenement`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `partenaire`
--
ALTER TABLE `partenaire`
  ADD CONSTRAINT `FK_Compte_Partenaire` FOREIGN KEY (`Id_compte`) REFERENCES `compte` (`Id_compte`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `participe_ibfk_1` FOREIGN KEY (`Id_Evenement`) REFERENCES `evenement` (`Id_Evenement`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participe_ibfk_2` FOREIGN KEY (`Id_partenaire`) REFERENCES `partenaire` (`Id_partenaire`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `typeevenement`
--
ALTER TABLE `typeevenement`
  ADD CONSTRAINT `FK_Compte_TypeEvenement` FOREIGN KEY (`Id_compte`) REFERENCES `compte` (`Id_compte`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
