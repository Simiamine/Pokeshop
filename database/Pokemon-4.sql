-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 14 mai 2024 à 22:14
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Pokemon`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `adresse_livraison` varchar(255) CHARACTER SET armscii8 NOT NULL,
  `ville` varchar(255) CHARACTER SET armscii8 NOT NULL,
  `code_postal` int(11) NOT NULL,
  `livraison` varchar(150) NOT NULL,
  `total` decimal(7,2) NOT NULL,
  `numero_commande` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `id_utilisateur`, `adresse_livraison`, `ville`, `code_postal`, `livraison`, `total`, `numero_commande`, `date_creation`) VALUES
(17, 2, 'oui3', 'Cergy', 95000, '0', '2407.00', '6642a9f93e722', '2024-05-14 02:02:01'),
(18, 2, 'oui4', 'Cergy', 95000, '0', '600.00', '6642ac1ee83c0', '2024-05-14 02:11:10'),
(19, 2, 'oui4', 'Cergy', 95000, '0', '600.00', '6642ac91df91a', '2024-05-14 02:13:05'),
(20, 2, 'oui4', 'Cergy', 95000, '0', '600.00', '6642ac9300e87', '2024-05-10 02:13:07'),
(21, 2, 'oui4', 'Cergy', 95000, '0', '600.00', '6642ac93d5341', '2024-05-10 02:13:07'),
(22, 2, 'oui4', 'Cergy', 95000, '0', '600.00', '6642ac944ff57', '2024-05-12 02:13:08'),
(23, 2, 'oui4', 'Cergy', 95000, '0', '600.00', '6642ac9a9d45b', '2024-05-14 02:13:14'),
(24, 2, 'oui4', 'Cergy', 95000, '0', '600.00', '6642acbdad58d', '2024-05-13 02:13:49'),
(25, 2, 'oui5', 'Cergy', 95000, '0', '17898.00', '6642ad3350916', '2024-05-14 02:15:47'),
(26, 2, 'oui10', 'Cergy', 95000, '0', '1753.00', '6642ad9dcaa83', '2024-05-14 02:17:33'),
(27, 2, 'oui11', 'Cergy', 95000, '0', '1969.00', '6642ae266369d', '2024-05-10 02:19:50'),
(29, 11, '17 boulevard du prot', 'Cergy', 95000, '0', '13.00', '6643b5866dbec', '2024-05-12 21:03:34'),
(31, 11, 'PARIS ', 'PARIS', 75000, '0', '318.00', '6643ba616d67b', '2024-05-13 21:24:17'),
(32, 11, 'azertyuiopsdfgh', 'zerg', 12345, '0', '932.00', '6643be5796d6c', '2024-05-13 21:41:11'),
(33, 11, 'azert iebf p', 'cergy', 95000, '0', '780.00', '6643d52ed97d7', '2024-05-14 23:18:38');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commandes`
--

CREATE TABLE `ligne_commandes` (
  `id` int(11) NOT NULL,
  `id_commande` varchar(255) NOT NULL,
  `pokemon` json NOT NULL COMMENT 'Id_Pokemon : Quantité'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligne_commandes`
--

INSERT INTO `ligne_commandes` (`id`, `id_commande`, `pokemon`) VALUES
(28, '28', '{\"3\": 2, \"6\": 3}'),
(29, '29', '{\"3\": 1}'),
(30, '31', '{\"1\": 1}'),
(31, '32', '{\"65\": 1, \"149\": 1}'),
(32, '33', '{\"5\": 1, \"9\": 1, \"151\": 1}');

-- --------------------------------------------------------

--
-- Structure de la table `pokedex`
--

CREATE TABLE `pokedex` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `type_1` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `type_2` varchar(100) CHARACTER SET armscii8 DEFAULT NULL,
  `generation` int(11) NOT NULL,
  `légendaire` tinyint(1) NOT NULL DEFAULT '0',
  `prix` decimal(5,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `image` varchar(150) CHARACTER SET armscii8 NOT NULL,
  `quantité` int(11) NOT NULL DEFAULT '0',
  `description` varchar(250) CHARACTER SET armscii8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pokedex`
--

INSERT INTO `pokedex` (`id`, `nom`, `type_1`, `type_2`, `generation`, `légendaire`, `prix`, `discount`, `image`, `quantité`, `description`) VALUES
(1, 'Bulbizarre', 'plante', 'poison', 1, 0, '318.00', 0, '../img/001.png', 5, 'Pok&eacute;mon de type Plante et Poison de la premi&egrave;re g&eacute;n&eacute;ration. C&#039;est l&#039;un des Pok&eacute;mon de d&eacute;part de la r&eacute;gion de Kanto.'),
(2, 'Herbizarre', 'plante', 'poison ', 1, 0, '23.00', 1, '../img/002.png', 0, 'Pok&eacute;mon de type Plante et Poison de la premi&egrave;re g&eacute;n&eacute;ration.'),
(3, 'Florizarre', 'plante', 'poison ', 1, 0, '13.00', 0, '../img/003.png', 12, 'Ce Pok&eacute;mon est capable de transformer la lumi&egrave;re du soleil en &eacute;nergie. Il est donc encore plus fort en &eacute;t&eacute;. '),
(4, 'Salameche', 'feu', '', 1, 0, '23.00', 0, '../img/004.png', 2, 'Salam&egrave;che est un Pok&eacute;mon bip&egrave;de et reptilien avec un corps principalement orange, &agrave; l&#039;exception de son ventre et de ses plantes de pieds qui sont beiges'),
(5, 'Reptincel', 'feu', '', 1, 0, '90.00', 0, '../img/005.png', 2, 'Ce Pok&eacute;mon au sang chaud est constamment &agrave; la recherche d&#039;adversaires. Il ne se calme qu&#039;une fois qu&#039;il a gagn&eacute;. '),
(6, 'Dracaufeu', 'feu', 'vol', 1, 0, '34.00', 0, '../img/006.png', 14, 'Dracaufeu est bas&eacute; sur un dragon europ&eacute;en. Contrairement &agrave; ses pr&eacute;-&eacute;volutions, il a deux ailes lui permettant de voler'),
(7, 'Carapuce', 'eau', '', 1, 0, '23.00', 0, '../img/007.png', 0, 'Carapuce est une petite tortue bip&egrave;de de couleur bleue. Il poss&egrave;de une carapace brune au pourtour blanc, beige au niveau du ventre. Ses yeux sont grands et violac&eacute;s.'),
(8, 'Carabaffe', 'eau', '', 1, 0, '50.00', 0, '../img/008.png', 10, 'Carabaffe a une large queue recouverte d&#039;une &eacute;paisse fourrure. Elle devient de plus en plus fonc&eacute;e avec l&#039;&acirc;ge. '),
(9, 'Tortank', 'eau', '', 1, 0, '100.00', 10, '../img/009.png', 6, 'Ce Pok&eacute;mon brutal est arm&eacute; de canons hydrauliques. Ses puissants jets d&#039;eau sont d&eacute;vastateurs. Il &eacute;crase ses adversaires de tout son poids pour leur faire perdre connaissance'),
(65, 'Alakazam', 'psy', '', 1, 0, '500.00', 0, '../img/065.png', 6, 'une description'),
(149, 'Dracolosse', 'dragon', 'vol', 1, 0, '465.00', 7, '../img/149.png', 35, ''),
(151, 'Mew', 'psy', '', 1, 1, '600.00', 0, '../img/151.png', 1, 'waw');

-- --------------------------------------------------------

--
-- Structure de la table `reinitmdp`
--

CREATE TABLE `reinitmdp` (
  `Id` int(11) NOT NULL,
  `Utilisateur` int(11) NOT NULL,
  `DateExp` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Token` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Utilise` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Table pour creer un autre mdp s''il est perdu';

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

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` text NOT NULL,
  `dateNaissance` varchar(100) NOT NULL,
  `mdp` text NOT NULL,
  `statut` varchar(100) NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `prenom`, `nom`, `email`, `telephone`, `dateNaissance`, `mdp`, `statut`) VALUES
(1, 'Aa', 'AA', 'aa@gmail.com', '1234567890', '08/02/2024', '$2y$10$zX7NdUlkHoLQAomJkBGHBuJqT40XP4xrqALrOyyVpuKQ/YgmFlkqS', 'admin'),
(2, 'Ok', 'TEST', 'ok@gmail.com', '1234567890', '06/02/2024', '$2y$12$Dt8WLmOI1aA.PcVwb2/r4uISQyGNFmZaiJS8DFGHpj/JP9fy8DXC.', 'client'),
(3, 'Dad', 'AAD', 'ah@gmail.com', '865757574', '18/02/2024', '$2y$10$9iKg9AAZ4FKxN2igQWQINuNpHsehft7aozg8m7Xg32oU5P8BVkOg2', 'client'),
(4, 'Ae', 'EFFAE', 'faf@gmail.com', '123456789', '06/02/2024', '$2y$10$UUWbo/5KcriCRF7HglUyz.IBcPGtqlwRjgX5xjAbe1NN3cRqWfkM2', 'client'),
(6, 'Test', 'AZDD', 'zz@gmail.com', '123456789', '21/02/2024', '$2y$10$u3gH2SJ1vMYeR8Z/FcL7r.enhTs4WsyLvSh3WPserTz7afOQnaV/6', 'client'),
(7, 'Mat', 'PEREIRA', 'mat@gmail.com', '123456789', '14/02/2024', '$2y$10$ec2tuhc4a/SpDt6Dj56CK.d.tcrbPgHdvA74pEuTKJrPsKwV0Aodi', 'client'),
(8, 'Azerty', 'AZ', 'azerty@gmail.com', '0', '06/03/2024', '$2y$10$1jPg.bkocvifSC1rmR4mcuhWjA.Us21Brgv3TiIo8cMKoqLlmtdLy', 'client'),
(9, 'Amine', 'MZALI', 'mzaliamine@gmail.com', '647890947', '05/05/2003', '$2y$10$GMTFr1JfgvpRVcJVWRbO9.w/qdgndIB1oo48x5yidaGZlvabo7wZq', 'client'),
(10, 'Amine', 'MZALI', 'mzaliamine@hotmail.fr', '0647890947', '05/05/2003', '$2y$10$c1Xh24w9t1IP/X3N3wM4Zuww70hPl.h6xOWufsxkEWbrzlyHG.GO6', 'client'),
(11, 'Sara', 'FLG', 'sar@gmail.com', '0644791116', '04/03/2002', '$2y$10$QQHVmbrVPBjVOdeQpGivp.lDW2xsfwyQZ5l2G3ugdC04ZYnwr/IZi', 'client'),
(12, 'Simon', 'CHAN', 'chan@cy.fr', '06', '08/06/2003', '$2y$10$ZtFZJN76mAMVjbZDQUUkVePGCoT9PzQ0ml.ZTBe57evUdVmStXhDW', 'client');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligne_commandes`
--
ALTER TABLE `ligne_commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pokedex`
--
ALTER TABLE `pokedex`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reinitmdp`
--
ALTER TABLE `reinitmdp`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `ligne_commandes`
--
ALTER TABLE `ligne_commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `pokedex`
--
ALTER TABLE `pokedex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT pour la table `reinitmdp`
--
ALTER TABLE `reinitmdp`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
