-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 12 juin 2022 à 08:31
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `CRTZ`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `corps` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `corps`, `created_at`, `updated_at`, `login`) VALUES
(1, 'Découvrez toutes nos idées de voyage en Californie', 'Contenu...', '2022-03-31', NULL, 'test'),
(4, '$ MATRIX $', 'Heyyyy mann !!!!', '2022-06-10', NULL, 'Timal'),
(5, '$ MATRIX 2 : Reloaded $', 'Comment vas tu le gat&eacute; ???', '2022-06-10', NULL, 'Timal'),
(6, '$ MATRIX 3 : Revolutions $', 'Keffaaa ?? ', '2022-06-10', NULL, 'Timal'),
(7, '$ MATRIX 4 : Resurrections !! $', 'Heee ben je vais sur Saturn !!!', '2022-06-10', NULL, 'Timal');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `login` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `est_valide` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`login`, `password`, `mail`, `role`, `est_valide`) VALUES
('test', '$2y$10$1B8GVORwdMSe/pKjo9Vr0upo5rlosY.HL7S4BIfMjygSymCzotAcC', 'test@test.fr', 'administrateur', 1),
('Timal', '$2y$10$g13sGNSnrj5dh06MvsBfMOtAFG6gutGHfjT1M4Qp6VH62G1.x3GNe', 'loydmatthew42@gmail.com', 'utilisateur', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_article_utilisateur` (`login`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_article_utilisateur` FOREIGN KEY (`login`) REFERENCES `utilisateur` (`login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
