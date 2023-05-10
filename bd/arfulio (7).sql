-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 02 mai 2023 à 17:18
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `arfulio`
--

-- --------------------------------------------------------

--
-- Structure de la table `artist`
--

DROP TABLE IF EXISTS `artist`;
CREATE TABLE IF NOT EXISTS `artist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `roles` json NOT NULL,
  `img_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `artist`
--

INSERT INTO `artist` (`id`, `username`, `password`, `email`, `roles`, `img_user`) VALUES
(31, 'armidea', '$2y$13$QeCfR32gFgu28i/YPfNOHeiozZpKrBrP01XY0qoPpmpjpQNJydTly', '', '[]', ''),
(32, 'sofien', '$2y$13$QeCfR32gFgu28i/YPfNOHeiozZpKrBrP01XY0qoPpmpjpQNJydTly', 'sofien@gmail.com', '[\"ROLE_USER\"]', ''),
(34, 'admin', '$2y$13$Qw3AdRFDF0llZER9hGoX8.J59TpyLtwx4aXZboY3Ijn1dsnkTtQsS', 'admin@gmail.com', '[\"ROLE_USER\"]', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `artiste_collaboration`
--

DROP TABLE IF EXISTS `artiste_collaboration`;
CREATE TABLE IF NOT EXISTS `artiste_collaboration` (
  `id_artiste_fk` int NOT NULL,
  `id_collaboration_fk` int NOT NULL,
  `date_entree` date NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `artiste_collaboration`
--

INSERT INTO `artiste_collaboration` (`id_artiste_fk`, `id_collaboration_fk`, `date_entree`, `id`) VALUES
(9, 16, '2023-03-06', 1),
(9, 17, '2023-03-06', 2),
(9, 18, '2023-03-06', 3),
(9, 19, '2023-03-06', 4),
(9, 20, '2023-03-06', 5),
(9, 21, '2023-03-06', 6),
(9, 22, '2023-03-06', 7),
(9, 23, '2023-03-06', 8),
(9, 24, '2023-03-06', 9),
(9, 25, '2023-03-06', 10),
(9, 26, '2023-03-06', 11),
(9, 27, '2023-03-06', 12),
(9, 28, '2023-03-06', 13),
(37, 37, '2023-05-01', 14),
(38, 38, '2023-05-01', 15),
(39, 39, '2023-05-01', 16);

-- --------------------------------------------------------

--
-- Structure de la table `artwork`
--

DROP TABLE IF EXISTS `artwork`;
CREATE TABLE IF NOT EXISTS `artwork` (
  `id_artwork` int NOT NULL AUTO_INCREMENT,
  `nom_artwork` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description_artwork` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prix_artwork` int NOT NULL,
  `id_type_id` int NOT NULL,
  `date` date NOT NULL,
  `id_artist_id` int NOT NULL,
  `lien_artwork` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dimension_artwork` int NOT NULL,
  `img_artwork` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `likes_count` int NOT NULL,
  PRIMARY KEY (`id_artwork`),
  KEY `fk_id_type` (`id_type_id`),
  KEY `fk_id_artist` (`id_artist_id`),
  KEY `nom_artwork` (`nom_artwork`,`prix_artwork`),
  KEY `prix_artwork` (`prix_artwork`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `artwork`
--

INSERT INTO `artwork` (`id_artwork`, `nom_artwork`, `description_artwork`, `prix_artwork`, `id_type_id`, `date`, `id_artist_id`, `lien_artwork`, `dimension_artwork`, `img_artwork`, `likes_count`) VALUES
(77, 'edesedes', 'mokich', 16, 2, '2018-01-01', 32, 'https://soundcloud.com/fatysh2808/9mn?si=af477cb2963f4b2180fc50f4bcc9d7fe&utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing', 24, '644e2aab4730c.jpg', 4);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_categorie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom_categorie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nom_categorie` (`nom_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `type_categorie`, `nom_categorie`) VALUES
(1, 'digital', 'image'),
(2, 'digital', 'video'),
(3, 'digital', 'audio'),
(4, 'physique', 'image');

-- --------------------------------------------------------

--
-- Structure de la table `collaboration`
--

DROP TABLE IF EXISTS `collaboration`;
CREATE TABLE IF NOT EXISTS `collaboration` (
  `id_collaboration` int NOT NULL AUTO_INCREMENT,
  `type_collaboration` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_sortie` date NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_collaboration`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `collaboration`
--

INSERT INTO `collaboration` (`id_collaboration`, `type_collaboration`, `titre`, `description`, `date_sortie`, `status`, `nom_user`, `email_user`) VALUES
(11, 'musicale', 'longue collaboration', 'la vie demande du travail', '2023-03-02', '3', '', ''),
(12, 'musicale', 'esprit ingenieur', 'la tunisie', '2023-03-13', '0', '', ''),
(13, 'finaciere', 'projet web', 'c\'est un projet travaillé en sprint', '2023-03-23', '2', 'asma', 'michelscoot@gmail.com'),
(14, 'artistique', 'xicii', 'hamma', '2023-03-17', 'en attente', 'lelouche', 'michelscoot@gmail.com'),
(15, 'artistique', 'ima', 'jaw', '2023-03-30', 'en attente', 'sofiene', 'sofiene@esprit.tn'),
(16, 'artistique', 'abstarct', 'faza', '2023-03-07', 'en attente', 'sofiene', 'sofiene@esprit.tn'),
(17, 'artistique', 'edes', 'techno', '2023-03-08', 'en attente', 'sofiene', 'sofiene@esprit.tn'),
(18, 'Financiere', 'ddd', 'dd', '2023-03-03', 'en attente', 'armidea', 'armi@esprit.tn'),
(19, 'artistique', 'hhh', 'twtw', '2023-03-09', 'en attente', 'armidea', 'bahaa2000lol@gmail.com'),
(20, 'Financiere', 'jj', 'kk', '2023-03-16', 'en attente', 'armidea', 'bahaa2000lol@gmail.com'),
(21, 'artistique', 'd', 'f', '2023-03-02', 'en attente', 'armidea', 'bahaa2000lol@gmail.com'),
(22, 'artistique', 'batta', 'batta', '2023-03-09', 'en attente', 'armidea', 'bahaa2000lol@gmail.com'),
(23, 'artistique', 'yaw', 'yaw', '2023-03-07', 'en attente', 'sofiene', 'sofiene@esprit.tn'),
(24, 'Financiere', 'test', 'tets', '2023-03-08', 'en attente', 'sofiene', 'sofiene@esprit.tn'),
(25, 'artistique', 'd', 'd', '2023-03-09', 'en attente', 'sofiene', 'sofiene@esprit.tn'),
(26, 'Financiere', 'xx', 'c', '2023-03-01', 'en attente', 'sofiene', 'sofiene@esprit.tn'),
(27, 'formation', 'f', 'x', '2023-03-02', 'en attente', 'sofiene', 'sofiene@esprit.tn'),
(28, 'égérie', 'f', 'f', '2023-03-09', 'en attente', 'sofiene', 'sofiene@esprit.tn'),
(29, 'financier', 'batta', 'batta', '2026-01-01', 'en attente', 'lelouche', 'lelouche@gmail.com'),
(30, 'financier', 'batta', 'batta', '2026-01-01', 'en attente', 'lelouche', 'lelouche@gmail.com'),
(31, 'financier', 'batta', 'batta', '2026-01-01', 'en attente', 'lelouche', 'lelouche@gmail.com'),
(32, 'financier', 'batta', 'batta', '2026-01-01', 'en attente', 'lelouche', 'lelouche@gmail.com'),
(33, 'financier', 'batta', 'batta', '2026-01-01', 'en attente', 'lelouche', 'lelouche@gmail.com'),
(34, 'financier', 'batta', 'batta', '2026-01-01', 'en attente', 'lelouche', 'lelouche@gmail.com'),
(35, 'financier', 'batta', 'batta', '2026-01-01', 'en attente', 'lelouche', 'lelouche@gmail.com'),
(36, 'financier', 'batta', 'batta', '2026-01-01', 'en attente', 'lelouche', 'lelouche@gmail.com'),
(37, 'financier', 'batta', 'batta', '2026-01-01', 'en attente', 'lelouche', 'lelouche@gmail.com'),
(38, 'financier', 'batta', 'batta', '2023-01-01', 'en attente', 'lelouche', 'lelouche@gmail.com'),
(39, 'Autre', 'dza', 'daz', '2018-01-01', 'en attente', 'lelouche', 'lelouche@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `Id_Vente` int NOT NULL AUTO_INCREMENT,
  `id_produit` int NOT NULL,
  `prix_artwork` float NOT NULL,
  `paiement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Id_Vente`),
  KEY `fl_id_artwork` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_util` int NOT NULL,
  `Texte` varchar(200) NOT NULL,
  `Id_com` int NOT NULL AUTO_INCREMENT,
  `id_artwork` int NOT NULL,
  `Date_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_com`),
  KEY `fk_id_artwork` (`id_artwork`),
  KEY `fk_id_user` (`id_util`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_util`, `Texte`, `Id_com`, `id_artwork`, `Date_post`) VALUES
(32, 'a', 127, 77, '2023-04-30 20:12:04'),
(32, 'a', 128, 77, '2023-04-30 20:36:35'),
(32, 'ncies', 129, 77, '2023-04-30 20:57:46'),
(32, 'x', 130, 77, '2023-04-30 20:58:16'),
(31, 'wow', 132, 77, '2023-04-30 21:01:23');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `titre`, `type`, `description`, `adresse`, `date_debut`, `date_fin`, `image`, `longitude`, `latitude`) VALUES
(149, 'Me.', 'Exposition', 'Marguerite Begue', 'AdamBourg', '2023-04-08', '2023-04-15', NULL, NULL, NULL),
(151, 'Mlle', 'Exposition', 'Arthur Prevost-Petit', 'Roux-sur-Barthelemy', '2023-04-11', '2023-04-11', NULL, 10.218307429913, 36.857673338975),
(152, 'Pr.', 'Théâtre', 'Juliette Poulain-Martins', 'Dupuynec', '2023-04-12', '2023-04-10', NULL, NULL, NULL),
(153, 'M.', 'Théâtre', 'Lucas-Bertrand Laine', 'Lebrundan', '2023-04-27', '2023-05-04', NULL, NULL, NULL),
(154, 'Pr.', 'Cinéma', 'Benoît-Grégoire Courtois', 'Valette-sur-Mer', '2023-04-08', '2023-05-17', NULL, NULL, NULL),
(155, 'Dr.', 'Cinéma', 'Pauline de Francois', 'Richard-la-Forêt', '2023-04-21', '2023-04-16', NULL, NULL, NULL),
(156, 'Dr.', 'Exposition', 'Manon Robert', 'Torres-sur-Marechal', '2023-04-03', '2023-04-25', NULL, NULL, NULL),
(157, 'Mme.', 'Consert ou spectacle', 'Martin-Eugène Vasseur', 'PagesBourg', '2023-04-03', '2023-05-27', NULL, 10.16269712154, 36.873192434242),
(158, 'Pr.', 'Cinéma', 'Manon Regnier', 'Gregoire', '2023-04-09', '2023-04-27', NULL, NULL, NULL),
(159, 'M.', 'Musique', 'Alexandre Ramos', 'Briand', '2023-04-22', '2023-05-25', NULL, NULL, NULL),
(160, 'Dr.', 'Musique', 'Christiane de la Lemonnier', 'Bonneau-la-Forêt', '2023-04-03', '2023-05-11', NULL, NULL, NULL),
(161, 'Mlle', 'Musique', 'Philippe Gautier', 'Raymond', '2023-04-04', '2023-05-04', NULL, NULL, NULL),
(163, 'Mme.', 'Théâtre', 'Roger Michel-Roche', 'Richardboeuf', '2023-04-16', '2023-05-04', NULL, NULL, NULL),
(164, 'Dr.', 'Théâtre', 'Zoé-Maggie Robin', 'Leveque', '2023-04-07', '2023-05-11', NULL, NULL, NULL),
(165, 'Mme.', 'Musique', 'Geneviève Nicolas', 'Rousset', '2023-04-17', '2023-04-25', NULL, NULL, NULL),
(166, 'Me.', 'Cinéma', 'Thierry Pinto', 'Guyonnec', '2023-04-29', '2023-04-24', NULL, NULL, NULL),
(167, 'Mlle', 'Musique', 'Nicolas Fontaine', 'WeberBourg', '2023-04-29', '2023-04-18', NULL, NULL, NULL),
(168, 'M.', 'Théâtre', 'Pierre Legros', 'De OliveiraVille', '2023-04-12', '2023-05-11', NULL, NULL, NULL),
(169, 'Pr.', 'Cinéma', 'Adrien-Laurent Guillaume', 'Guillonnec', '2023-04-26', '2023-05-01', NULL, NULL, NULL),
(170, 'Dr.', 'Cinéma', 'Yves Lopez-Henry', 'Guichard', '2023-05-02', '2023-05-25', NULL, NULL, NULL),
(171, 'Dr.', 'Théâtre', 'Pierre Martineau', 'Lecoq-sur-Dos Santos', '2023-04-30', '2023-04-28', NULL, NULL, NULL),
(172, 'Me.', 'Exposition', 'Guy Parent', 'Da Silvaboeuf', '2023-05-02', '2023-04-15', NULL, NULL, NULL),
(173, 'Pr.', 'Exposition', 'Madeleine Gauthier-Huet', 'Becker-sur-Delorme', '2023-04-16', '2023-04-04', NULL, NULL, NULL),
(174, 'Mme.', 'Théâtre', 'Danielle Charpentier', 'Germain', '2023-04-04', '2023-04-08', NULL, NULL, NULL),
(175, 'Dr.', 'Exposition', 'Émilie Morel', 'Guerin', '2023-04-26', '2023-05-03', NULL, NULL, NULL),
(176, 'Pr.', 'Exposition', 'Auguste Didier', 'BlanchardVille', '2023-04-08', '2023-04-20', NULL, NULL, NULL),
(177, 'M.', 'Théâtre', 'Hugues Renard', 'BesnardBourg', '2023-04-25', '2023-05-26', NULL, NULL, NULL),
(178, 'Mme.', 'Exposition', 'Gérard-Bernard Evrard', 'Chretien', '2023-04-14', '2023-05-26', NULL, NULL, NULL),
(179, 'M.', 'Cinéma', 'Marthe Marie', 'Durand', '2023-04-10', '2023-05-23', NULL, NULL, NULL),
(180, 'Pr.', 'Théâtre', 'Étienne du Picard', 'Simon-la-Forêt', '2023-04-08', '2023-05-15', NULL, NULL, NULL),
(181, 'Me.', 'Exposition', 'Alexandre Gaillard', 'Fouquet', '2023-04-23', '2023-04-03', NULL, NULL, NULL),
(182, 'Dr.', 'Cinéma', 'Vincent-Victor Blot', 'Lebretonboeuf', '2023-04-13', '2023-04-22', NULL, NULL, NULL),
(183, 'Mlle', 'Théâtre', 'Vincent-David Martel', 'Piresnec', '2023-04-11', '2023-05-29', NULL, NULL, NULL),
(184, 'Me.', 'Théâtre', 'Constance de la Techer', 'Delaunay-sur-Mer', '2023-04-07', '2023-05-27', NULL, NULL, NULL),
(185, 'M.', 'Théâtre', 'Claudine Leblanc-Bourdon', 'Letellier', '2023-04-30', '2023-04-07', NULL, NULL, NULL),
(186, 'Pr.', 'Théâtre', 'Daniel Berger', 'Pelletier', '2023-04-10', '2023-05-09', NULL, NULL, NULL),
(187, 'Me.', 'Exposition', 'Andrée Giraud-Valentin', 'Didierdan', '2023-04-12', '2023-05-09', NULL, NULL, NULL),
(188, 'Dr.', 'Cinéma', 'Henriette-Véronique Cousin', 'Michauddan', '2023-04-04', '2023-05-29', NULL, NULL, NULL),
(189, 'M.', 'Musique', 'Grégoire du Perrier', 'Remy', '2023-04-20', '2023-04-12', NULL, NULL, NULL),
(190, 'Mlle', 'Exposition', 'Élisabeth-Inès Petit', 'Menard', '2023-04-20', '2023-05-07', NULL, NULL, NULL),
(191, 'Mme.', 'Théâtre', 'Charles Fontaine', 'MassonVille', '2023-04-18', '2023-04-03', NULL, NULL, NULL),
(192, 'Mme.', 'Cinéma', 'Joseph du Pineau', 'Benard-la-Forêt', '2023-04-17', '2023-04-17', NULL, NULL, NULL),
(193, 'Mlle', 'Exposition', 'Luc Peltier', 'Fernandesdan', '2023-04-20', '2023-04-07', NULL, NULL, NULL),
(194, 'Dr.', 'Musique', 'David Rousseau', 'Albertdan', '2023-04-11', '2023-05-26', NULL, NULL, NULL),
(195, 'Me.', 'Musique', 'Susan Guilbert-Ruiz', 'Launay', '2023-04-09', '2023-05-27', NULL, NULL, NULL),
(196, 'Pr.', 'Cinéma', 'Antoine Pineau', 'Leblanc-la-Forêt', '2023-04-21', '2023-04-28', NULL, NULL, NULL),
(197, 'Pr.', 'Exposition', 'Virginie Pierre', 'LegrandBourg', '2023-04-12', '2023-04-17', NULL, NULL, NULL),
(198, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(199, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(201, 'nice', 'Gala ou dinner', 'nice', 'ariana essoghra', '2018-01-01', '2018-01-01', NULL, 10.129382760678, 36.83959751857),
(202, NULL, 'Consert ou spectacle', NULL, 'geant', '2018-01-01', '2018-01-01', NULL, 10.186786953569, 36.9042318),
(203, 'noice', 'Gala ou dinner', 'noice', 'geant', '2023-11-01', '2023-10-01', '6m10u3qi6m971-6450529c817e2.png', -75.0799911, -14.7454466);

-- --------------------------------------------------------

--
-- Structure de la table `event_like`
--

DROP TABLE IF EXISTS `event_like`;
CREATE TABLE IF NOT EXISTS `event_like` (
  `id` int NOT NULL AUTO_INCREMENT,
  `evenement_id` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B3A80C18FD02F13` (`evenement_id`),
  KEY `IDX_B3A80C186B3CA4B` (`id`),
  KEY `FK_B3A80C186B3CA4B` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parrainage`
--

DROP TABLE IF EXISTS `parrainage`;
CREATE TABLE IF NOT EXISTS `parrainage` (
  `id_parrainage` int NOT NULL AUTO_INCREMENT,
  `id_user_id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_parrainage`),
  KEY `is_user` (`id_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `parrainage`
--

INSERT INTO `parrainage` (`id_parrainage`, `id_user_id`, `email`, `username`) VALUES
(8, 32, 'kfgkazfjha@gmail.com', 'armi'),
(9, 31, '', ''),
(10, 31, '', ''),
(11, 31, '', ''),
(12, 31, '', ''),
(13, 31, '', ''),
(14, 31, '', ''),
(15, 31, '', ''),
(16, 31, '', ''),
(17, 31, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `particip_event`
--

DROP TABLE IF EXISTS `particip_event`;
CREATE TABLE IF NOT EXISTS `particip_event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `evenement_id` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_5BF49BB6B3CA4B` (`id_user`),
  KEY `FK_5BF49BBFD02F13` (`evenement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id_profil` int NOT NULL AUTO_INCREMENT,
  `id_util` int NOT NULL,
  `bio` text NOT NULL,
  `ig` text NOT NULL,
  `fb` text NOT NULL,
  `twitter` text NOT NULL,
  `ytb` text NOT NULL,
  PRIMARY KEY (`id_profil`),
  KEY `id_util` (`id_util`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `profile`
--

INSERT INTO `profile` (`id_profil`, `id_util`, `bio`, `ig`, `fb`, `twitter`, `ytb`) VALUES
(22, 9, 'dev / graphic designer ', '@armi64bit', 'bahaa eddine bouzid', '@armi64bit', 'armi'),
(29, 0, 'aaa', 'aaa', 'a', 'aaa', 'aaa');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

DROP TABLE IF EXISTS `promotion`;
CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_artwork` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prix_artwork` int NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `remise` int NOT NULL,
  `id_artwork` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nom_artwork` (`nom_artwork`,`prix_artwork`,`id_artwork`),
  KEY `fk_idart` (`id_artwork`),
  KEY `fk_prix` (`prix_artwork`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id`, `nom_artwork`, `prix_artwork`, `type`, `remise`, `id_artwork`) VALUES
(2, 'edesedes', 16, 'promo aid', 30, 77);

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

DROP TABLE IF EXISTS `reclamation`;
CREATE TABLE IF NOT EXISTS `reclamation` (
  `id_rec` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `Titre` varchar(10) NOT NULL,
  `Reclamation_sec` varchar(200) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`id_rec`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`id_rec`, `id_user`, `Titre`, `Reclamation_sec`, `email`) VALUES
(88, NULL, 'hammafzefe', 'hammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfz', 'hammafzefezfz'),
(89, NULL, 'hammafzefe', 'hammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfz', 'hammafzefezfz'),
(90, NULL, 'hammafzefe', 'hammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfz', 'bahaa2000lol@gmail.com'),
(91, NULL, 'hammafzefe', 'hammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfz', 'bahaa2000lol@gmail.com'),
(92, 31, 'hammafzefe', 'hammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhammafzefezfzhamma', 'bahaa2000lol@gmail.com'),
(93, 31, 'jjjjjjjjjj', 'jjjjjjjjjjjjjjjjjjjjjjjjjjjj', 'bahaa2000lol@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `type_role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `type_role` (`type_role`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `type_role`) VALUES
(13, 'artiste'),
(14, 'client');

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `id_skill` int NOT NULL AUTO_INCREMENT,
  `titre_skill` varchar(255) NOT NULL,
  `desc_skill` text NOT NULL,
  `id_profile` int NOT NULL,
  PRIMARY KEY (`id_skill`),
  KEY `fk_id_profile` (`id_profile`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `skills`
--

INSERT INTO `skills` (`id_skill`, `titre_skill`, `desc_skill`, `id_profile`) VALUES
(4, 'dev', 'web java sdl c c++', 22),
(5, 'aa', 'aa', 22);

-- --------------------------------------------------------

--
-- Structure de la table `sous_cat`
--

DROP TABLE IF EXISTS `sous_cat`;
CREATE TABLE IF NOT EXISTS `sous_cat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_sous_cat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type_sous_cat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_categorie` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_categorie` (`id_categorie`),
  KEY `type_sous_cat` (`type_sous_cat`),
  KEY `fk_type` (`nom_sous_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sous_cat`
--

INSERT INTO `sous_cat` (`id`, `nom_sous_cat`, `type_sous_cat`, `id_categorie`) VALUES
(2, 'image', 'ILLustraion', 0),
(3, 'video', 'court metrage', 0),
(4, 'audio', 'tehcno', 0),
(5, 'image', '3D', 0),
(6, 'video', 'animation', 0);

-- --------------------------------------------------------

--
-- Structure de la table `store`
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE IF NOT EXISTS `store` (
  `id_produit` int NOT NULL AUTO_INCREMENT,
  `id_piece_art` int NOT NULL,
  `nom_artwork` varchar(11) NOT NULL,
  `prix_artwork` float NOT NULL,
  `img_artwork` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `fk_id_produit` (`id_piece_art`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `store`
--

INSERT INTO `store` (`id_produit`, `id_piece_art`, `nom_artwork`, `prix_artwork`, `img_artwork`) VALUES
(1, 1, 'edesedes', 16, '644e2aab4730c.jpg'),
(8, 1, 'edesedes', 16, '644e2aab4730c.jpg'),
(9, 1, 'edesedes', 16, '644e2aab4730c.jpg'),
(10, 1, 'edesedes', 16, '644e2aab4730c.jpg'),
(11, 1, 'edesedes', 16, '644e2aab4730c.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cin_user` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type_role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_pro` tinyint(1) NOT NULL DEFAULT '0',
  `img_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `roles` json NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role` (`type_role`),
  KEY `email_user` (`email`),
  KEY `is_pro` (`is_pro`),
  KEY `username` (`username`),
  KEY `password` (`password`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `cin_user`, `adresse_user`, `password`, `email`, `type_role`, `is_pro`, `img_user`, `roles`) VALUES
(31, 'armidea', '', '', '$2y$13$3J5RIDvMc9tkkwMlaJYTjO2YVjiGDKF/sut5wfsazAT', 'bahaa2000alol@gmail.com', '', 0, NULL, '[]'),
(32, 'sofien', '', '', '$2y$13$QeCfR32gFgu28i/YPfNOHeiozZpKrBrP01XY0qoPpmp', 'sofien@gmail.com', '', 0, 'michel.jpg', '[]'),
(35, 'admin', NULL, NULL, '$2y$13$Qw3AdRFDF0llZER9hGoX8.J59TpyLtwx4aXZboY3Ijn', 'admin@gmail.com', '', 0, 'admin', '[]');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `artwork`
--
ALTER TABLE `artwork`
  ADD CONSTRAINT `fk_id_artist` FOREIGN KEY (`id_artist_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_sou_cat` FOREIGN KEY (`id_type_id`) REFERENCES `sous_cat` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `event_like`
--
ALTER TABLE `event_like`
  ADD CONSTRAINT `FK_B3A80C186B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_B3A80C18FD02F13` FOREIGN KEY (`evenement_id`) REFERENCES `evenement` (`id`);

--
-- Contraintes pour la table `parrainage`
--
ALTER TABLE `parrainage`
  ADD CONSTRAINT `is_user` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `particip_event`
--
ALTER TABLE `particip_event`
  ADD CONSTRAINT `FK_5BF49BB6B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `artist` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_5BF49BBFD02F13` FOREIGN KEY (`evenement_id`) REFERENCES `evenement` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `fk_idart` FOREIGN KEY (`id_artwork`) REFERENCES `artwork` (`id_artwork`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_nom` FOREIGN KEY (`nom_artwork`) REFERENCES `artwork` (`nom_artwork`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_prix` FOREIGN KEY (`prix_artwork`) REFERENCES `artwork` (`prix_artwork`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `sous_cat`
--
ALTER TABLE `sous_cat`
  ADD CONSTRAINT `fk_type` FOREIGN KEY (`nom_sous_cat`) REFERENCES `categorie` (`nom_categorie`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
