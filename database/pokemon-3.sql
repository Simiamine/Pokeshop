-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 08 avr. 2024 à 12:36
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
-- Base de données : `pokemon`
--

-- --------------------------------------------------------

--
-- Structure de la table `pokedex`
--

DROP TABLE IF EXISTS `pokedex`;
CREATE TABLE IF NOT EXISTS `pokedex` (
  `id` int NOT NULL,
  `nom` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `type_1` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `type_2` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `generation` int NOT NULL,
  `légendaire` tinyint(1) NOT NULL DEFAULT '0',
  `prix` decimal(5,2) NOT NULL,
  `discount` int NOT NULL,
  `image` varchar(150) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `quantité` int NOT NULL DEFAULT '0',
  `description` varchar(250) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `pokedex`
--

INSERT INTO `pokedex` (`id`, `nom`, `type_1`, `type_2`, `generation`, `légendaire`, `prix`, `discount`, `image`, `quantité`, `description`) VALUES
(1, 'Bulbizarre', 'plante', 'poison', 1, 0, 318.00, 5, '../img/001.png', 10, 'Pok&eacute;mon de type Plante et Poison de la premi&egrave;re g&eacute;n&eacute;ration. C&#039;est l&#039;un des Pok&eacute;mon de d&eacute;part de la r&eacute;gion de Kanto.'),
(2, 'Herbizarre', 'plante', 'poison ', 1, 0, 23.00, 1, '../img/002.png', 5, 'Pok&eacute;mon de type Plante et Poison de la premi&egrave;re g&eacute;n&eacute;ration.'),
(3, 'Florizarre', 'plante', 'poison ', 1, 0, 13.00, 0, '../img/003.png', 23, 'Ce Pok&eacute;mon est capable de transformer la lumi&egrave;re du soleil en &eacute;nergie. Il est donc encore plus fort en &eacute;t&eacute;. '),
(4, 'Salameche', 'feu', '', 1, 0, 23.00, 12, '../img/004.png', 9, 'Salam&egrave;che est un Pok&eacute;mon bip&egrave;de et reptilien avec un corps principalement orange, &agrave; l&#039;exception de son ventre et de ses plantes de pieds qui sont beiges'),
(5, 'Reptincel', 'feu', '', 1, 0, 90.00, 64, '../img/005.png', 8, 'Ce Pok&eacute;mon au sang chaud est constamment &agrave; la recherche d&#039;adversaires. Il ne se calme qu&#039;une fois qu&#039;il a gagn&eacute;. '),
(6, 'Dracaufeu', 'feu', 'vol', 1, 0, 34.00, 0, '../img/006.png', 21, 'Dracaufeu est bas&eacute; sur un dragon europ&eacute;en. Contrairement &agrave; ses pr&eacute;-&eacute;volutions, il a deux ailes lui permettant de voler'),
(7, 'Carapuce', 'eau', '', 1, 0, 23.00, 0, '../img/007.png', 3, 'Carapuce est une petite tortue bip&egrave;de de couleur bleue. Il poss&egrave;de une carapace brune au pourtour blanc, beige au niveau du ventre. Ses yeux sont grands et violac&eacute;s.'),
(8, 'Carabaffe', 'eau', '', 1, 0, 50.00, 20, '../img/008.png', 3, 'Carabaffe a une large queue recouverte d&#039;une &eacute;paisse fourrure. Elle devient de plus en plus fonc&eacute;e avec l&#039;&acirc;ge. '),
(9, 'Tortank', 'eau', '', 1, 0, 100.00, 10, '../img/009.png', 7, 'Ce Pok&eacute;mon brutal est arm&eacute; de canons hydrauliques. Ses puissants jets d&#039;eau sont d&eacute;vastateurs. Il &eacute;crase ses adversaires de tout son poids pour leur faire perdre connaissance'),
(65, 'Alakazam', 'psy', '', 1, 0, 500.00, 0, '065.png', 1, ''),
(149, 'Dracolosse', 'dragon', 'vol', 1, 0, 465.00, 7, '149.png', 78, ''),
(151, 'Mew', 'psy', '', 1, 1, 600.00, 0, '151.png', 1, 'waw');

-- --------------------------------------------------------

--
-- Structure de la table `reinitmdp`
--

DROP TABLE IF EXISTS `reinitmdp`;
CREATE TABLE IF NOT EXISTS `reinitmdp` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Utilisateur` int NOT NULL,
  `DateExp` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Token` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Utilise` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table pour creer un autre mdp s''il est perdu';

--
-- Déchargement des données de la table `reinitmdp`
--

INSERT INTO `reinitmdp` (`Id`, `Utilisateur`, `DateExp`, `Token`, `Utilise`) VALUES
(7, 2, '2024-03-31 02:28:59', '24e2a24d2de44f0c0ffd46b1229706232663027631a18410625a3ede7693', 0),
(8, 8, '2024-03-31 02:30:31', '3f9d907479cb3fdb53af90c848ef7f3f86343a1b37a883d103bc3ff8da73', 0),
(10, 1, '2024-03-31 02:36:37', '203ec9cd08df9b9989a9e8b7a4733a723a14ad89b3b9b57ce90068f72f48', 0),
(11, 1, '2024-03-31 03:39:10', '9c1f66992e641a0e90ac175ee1aa338d76a3706b6b354c6af2fc796df908', 1),
(12, 8, '2024-03-31 04:14:08', 'bae87ac4fea52e5015f08cbe42d5f0b33186d76c3b355a4cd933f852927a', 1),
(13, 8, '2024-03-31 04:14:52', '98cffa536a578e756a5b82a8eed32c6b130c07d7fb7dce5b98789c21abc8', 1),
(14, 8, '2024-03-31 04:16:06', 'c0605d7aeef18e8e82fdd2756875d19f3d9205af0358877c46a78f7d9008', 0),
(15, 4, '2024-03-31 21:39:29', '3419358f9df4b757ad806095d62dcc61af4224408c7fa5e8a91e21f172e2', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` text NOT NULL,
  `dateNaissance` varchar(100) NOT NULL,
  `mdp` text NOT NULL,
  `statut` varchar(100) NOT NULL DEFAULT 'client',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `prenom`, `nom`, `email`, `telephone`, `dateNaissance`, `mdp`, `statut`) VALUES
(1, 'Aa', 'AA', 'aa@gmail.com', '1234567890', '08/02/2024', '$2y$10$zX7NdUlkHoLQAomJkBGHBuJqT40XP4xrqALrOyyVpuKQ/YgmFlkqS', 'admin'),
(2, 'Ok', 'TEST', 'ok@gmail.com', '1234567890', '06/02/2024', '$2y$10$bi.A6p7U7gaH9tfkUA36A.4h8afYWjw7uNEZThMN.iwwVJrPrken6', 'client'),
(3, 'Dad', 'AAD', 'ah@gmail.com', '865757574', '18/02/2024', '$2y$10$9iKg9AAZ4FKxN2igQWQINuNpHsehft7aozg8m7Xg32oU5P8BVkOg2', 'client'),
(4, 'Ae', 'EFFAE', 'faf@gmail.com', '123456789', '06/02/2024', '$2y$10$UUWbo/5KcriCRF7HglUyz.IBcPGtqlwRjgX5xjAbe1NN3cRqWfkM2', 'client'),
(6, 'Test', 'AZDD', 'zz@gmail.com', '123456789', '21/02/2024', '$2y$10$u3gH2SJ1vMYeR8Z/FcL7r.enhTs4WsyLvSh3WPserTz7afOQnaV/6', 'client'),
(7, 'Mat', 'PEREIRA', 'mat@gmail.com', '123456789', '14/02/2024', '$2y$10$ec2tuhc4a/SpDt6Dj56CK.d.tcrbPgHdvA74pEuTKJrPsKwV0Aodi', 'client'),
(8, 'Azerty', 'AZ', 'azerty@gmail.com', '0', '06/03/2024', '$2y$10$1jPg.bkocvifSC1rmR4mcuhWjA.Us21Brgv3TiIo8cMKoqLlmtdLy', 'client'),
(9, 'Amine', 'MZALI', 'mzaliamine@gmail.com', '647890947', '05/05/2003', '$2y$10$GMTFr1JfgvpRVcJVWRbO9.w/qdgndIB1oo48x5yidaGZlvabo7wZq', 'client'),
(10, 'Amine', 'MZALI', 'mzaliamine@hotmail.fr', '0647890947', '05/05/2003', '$2y$10$c1Xh24w9t1IP/X3N3wM4Zuww70hPl.h6xOWufsxkEWbrzlyHG.GO6', 'client');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
