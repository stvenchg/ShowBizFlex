-- phpMyAdmin SQL Dump
-- version 5.1.1deb3+bionic1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 05 déc. 2022 à 23:58
-- Version du serveur : 5.7.40
-- Version de PHP : 7.2.24-0ubuntu0.18.04.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dutinfopw201637`
--

-- --------------------------------------------------------

--
-- Structure de la table `Belong`
--

CREATE TABLE `Belong` (
  `idShow` bigint(20) UNSIGNED NOT NULL,
  `idGenre` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Belong`
--

INSERT INTO `Belong` (`idShow`, `idGenre`) VALUES
(615, 16),
(890, 16),
(1063, 16),
(1429, 16),
(2808, 16),
(4623, 16),
(11279, 16),
(13916, 16),
(26453, 16),
(30984, 16),
(31910, 16),
(35935, 16),
(37854, 16),
(42705, 16),
(45790, 16),
(46260, 16),
(46261, 16),
(50712, 16),
(57911, 16),
(60625, 16),
(61222, 16),
(65733, 16),
(65942, 16),
(84669, 16),
(94605, 16),
(95479, 16),
(95557, 16),
(98123, 16),
(105897, 16),
(114410, 16),
(120089, 16),
(126437, 16),
(203192, 16),
(890, 18),
(1063, 18),
(1395, 18),
(1396, 18),
(1399, 18),
(1402, 18),
(1981, 18),
(2808, 18),
(4615, 18),
(4616, 18),
(6798, 18),
(7942, 18),
(31586, 18),
(42705, 18),
(46331, 18),
(50712, 18),
(60735, 18),
(61222, 18),
(65942, 18),
(68507, 18),
(84669, 18),
(87049, 18),
(90669, 18),
(94605, 18),
(94997, 18),
(95403, 18),
(95557, 18),
(105897, 18),
(111837, 18),
(126437, 18),
(211239, 18),
(212818, 18),
(214258, 18),
(615, 35),
(1063, 35),
(1981, 35),
(2692, 35),
(2808, 35),
(4327, 35),
(4623, 35),
(37854, 35),
(42705, 35),
(46261, 35),
(50712, 35),
(57911, 35),
(60625, 35),
(61222, 35),
(65733, 35),
(65942, 35),
(84669, 35),
(98123, 35),
(105897, 35),
(114410, 35),
(119051, 35),
(120089, 35),
(126437, 35),
(206112, 35),
(214258, 35),
(31586, 80),
(214180, 80),
(214180, 99),
(1395, 9648),
(1981, 9648),
(4607, 9648),
(13916, 9648),
(46261, 9648),
(46331, 9648),
(50712, 9648),
(90669, 9648),
(119051, 9648),
(212818, 9648),
(2692, 10751),
(4327, 10751),
(132799, 10751),
(206112, 10751),
(211239, 10751),
(615, 10759),
(1063, 10759),
(1399, 10759),
(1402, 10759),
(1429, 10759),
(2808, 10759),
(4607, 10759),
(4615, 10759),
(4616, 10759),
(11279, 10759),
(26453, 10759),
(30984, 10759),
(31910, 10759),
(35935, 10759),
(37854, 10759),
(42705, 10759),
(45790, 10759),
(46260, 10759),
(46261, 10759),
(57911, 10759),
(60625, 10759),
(65733, 10759),
(65942, 10759),
(83867, 10759),
(94605, 10759),
(94997, 10759),
(95479, 10759),
(95557, 10759),
(98123, 10759),
(105897, 10759),
(111837, 10759),
(114410, 10759),
(120089, 10759),
(203192, 10759),
(2808, 10762),
(4623, 10762),
(211660, 10763),
(14814, 10764),
(69021, 10764),
(130392, 10764),
(615, 10765),
(890, 10765),
(1399, 10765),
(1402, 10765),
(1429, 10765),
(1981, 10765),
(4615, 10765),
(4616, 10765),
(11279, 10765),
(13916, 10765),
(26453, 10765),
(30984, 10765),
(31910, 10765),
(35935, 10765),
(45790, 10765),
(46260, 10765),
(46261, 10765),
(46331, 10765),
(50712, 10765),
(57911, 10765),
(60625, 10765),
(60735, 10765),
(65733, 10765),
(65942, 10765),
(68507, 10765),
(83867, 10765),
(94605, 10765),
(94997, 10765),
(95403, 10765),
(95479, 10765),
(95557, 10765),
(98123, 10765),
(105897, 10765),
(111837, 10765),
(114410, 10765),
(119051, 10765),
(203192, 10765),
(212818, 10765),
(1054, 10766),
(206112, 10767),
(211660, 10767),
(83867, 10768);

-- --------------------------------------------------------

--
-- Structure de la table `Comment`
--

CREATE TABLE `Comment` (
  `idCom` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `idShow` bigint(20) UNSIGNED NOT NULL,
  `datePublication` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Comment`
--

INSERT INTO `Comment` (`idCom`, `message`, `id`, `idShow`, `datePublication`) VALUES
(2, ' Vraiment cool la série + la fille est trop canon !', 10, 95403, '2022-11-26 19:38:35'),
(12, ' Non finalement, elle est nul la série c\'est une perte de temps', 10, 90669, '2022-11-26 20:06:25'),
(14, ' Juste une masterclass en fait', 9, 37854, '2022-11-28 09:14:50'),
(16, ' Pue la merde la série !', 12, 95403, '2022-11-28 13:35:39'),
(23, ' Je réitère mon propos, c\'est une masterclass', 9, 37854, '2022-11-30 15:27:58'),
(38, ' Animé de zinzin', 13, 114410, '2022-12-01 17:29:40'),
(63, ' Vraiment fou, regardez ', 9, 45790, '2022-12-02 09:12:30'),
(125, ' Trop cool !', 10, 119051, '2022-12-05 17:37:14'),
(127, ' Rick et Morty ça tue ! ', 9, 60625, '2022-12-05 21:40:36'),
(128, ' Rick et Morty ça tue ! ', 9, 60625, '2022-12-05 21:40:37'),
(129, ' Rick et Morty ça tue ! ', 9, 60625, '2022-12-05 21:40:37'),
(130, ' Rick et Morty ça tue ! ', 9, 60625, '2022-12-05 21:40:38'),
(131, ' Rick et Morty ça tue ! ', 9, 60625, '2022-12-05 21:40:38'),
(132, ' Rick et Morty ça tue ! ', 9, 60625, '2022-12-05 21:40:38'),
(133, ' Rick et Morty ça tue ! ', 9, 60625, '2022-12-05 21:40:38'),
(134, ' Rick et Morty ça tue ! ', 9, 60625, '2022-12-05 21:40:41'),
(135, ' Rick et Morty ça tue ! ', 9, 60625, '2022-12-05 21:40:42'),
(136, ' salut', 9, 95403, '2022-12-05 21:48:05'),
(137, ' test', 15, 1396, '2022-12-05 22:25:31'),
(139, 'salut', 15, 1396, '2022-12-05 22:37:27'),
(140, 'salut', 15, 119051, '2022-12-05 22:50:28'),
(141, 'cc', 15, 119051, '2022-12-05 22:50:34'),
(144, 'Ca fonctionne !', 10, 95403, '2022-12-05 22:57:51');

-- --------------------------------------------------------

--
-- Structure de la table `FavGenres`
--

CREATE TABLE `FavGenres` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idGenre` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `FavGenres`
--

INSERT INTO `FavGenres` (`idUser`, `idGenre`) VALUES
(9, 16),
(10, 16),
(15, 16),
(10, 18),
(9, 35),
(10, 35),
(15, 35),
(9, 10759),
(15, 10759);

-- --------------------------------------------------------

--
-- Structure de la table `FollowedShows`
--

CREATE TABLE `FollowedShows` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idShow` bigint(20) UNSIGNED NOT NULL,
  `addDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `FollowedShows`
--

INSERT INTO `FollowedShows` (`idUser`, `idShow`, `addDate`) VALUES
(9, 1063, '2022-12-05 17:19:15'),
(9, 1396, '2022-12-05 17:19:15'),
(9, 1399, '2022-12-05 17:19:15'),
(9, 1429, '2022-12-05 17:19:15'),
(9, 2692, '2022-12-05 23:18:25'),
(9, 13916, '2022-12-05 17:19:15'),
(9, 26453, '2022-12-05 17:19:15'),
(9, 31910, '2022-12-05 17:19:15'),
(9, 37854, '2022-12-05 17:19:15'),
(9, 45790, '2022-12-05 17:19:15'),
(9, 46260, '2022-12-05 17:19:15'),
(9, 60735, '2022-12-05 17:19:15'),
(9, 68507, '2022-12-05 22:55:29'),
(9, 75006, '2022-12-05 17:19:15'),
(9, 94997, '2022-12-05 17:19:15'),
(9, 95479, '2022-12-05 17:19:15'),
(9, 95557, '2022-12-05 17:19:15'),
(9, 111837, '2022-12-05 17:19:15'),
(9, 114410, '2022-12-05 17:19:15'),
(9, 126437, '2022-12-05 17:19:15'),
(10, 1399, '2022-12-05 17:19:15'),
(10, 1402, '2022-12-05 17:19:15'),
(10, 90669, '2022-12-05 17:19:15'),
(10, 95403, '2022-12-05 17:19:15'),
(13, 45790, '2022-12-05 17:19:15'),
(14, 1395, '2022-12-05 17:19:15'),
(14, 1981, '2022-12-05 17:19:15'),
(14, 6798, '2022-12-05 17:19:15'),
(14, 46261, '2022-12-05 17:19:15'),
(14, 61222, '2022-12-05 17:19:15'),
(14, 69021, '2022-12-05 17:19:15'),
(14, 95403, '2022-12-05 17:19:15'),
(14, 214258, '2022-12-05 17:19:15'),
(15, 95403, '2022-12-05 23:52:47');

-- --------------------------------------------------------

--
-- Structure de la table `FollowedUsers`
--

CREATE TABLE `FollowedUsers` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idUserFollowed` bigint(20) UNSIGNED NOT NULL,
  `dateFollow` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `FollowedUsers`
--

INSERT INTO `FollowedUsers` (`idUser`, `idUserFollowed`, `dateFollow`) VALUES
(10, 12, '2022-12-05 17:38:26');

-- --------------------------------------------------------

--
-- Structure de la table `Genre`
--

CREATE TABLE `Genre` (
  `idGenre` bigint(20) UNSIGNED NOT NULL,
  `nameGenre` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Genre`
--

INSERT INTO `Genre` (`idGenre`, `nameGenre`) VALUES
(16, 'Animation'),
(18, 'Drame'),
(35, 'Comédie'),
(37, 'Western'),
(80, 'Crime'),
(99, 'Documentaire'),
(9648, 'Mystère'),
(10751, 'Familial'),
(10759, 'Action & Adventure'),
(10762, 'Kids'),
(10763, 'News'),
(10764, 'Reality'),
(10765, 'Science-Fiction & Fantastique'),
(10766, 'Soap'),
(10767, 'Talk'),
(10768, 'War & Politics');

-- --------------------------------------------------------

--
-- Structure de la table `Have`
--

CREATE TABLE `Have` (
  `idRight` bigint(20) UNSIGNED NOT NULL,
  `idRole` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Have`
--

INSERT INTO `Have` (`idRight`, `idRole`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ListLikes`
--

CREATE TABLE `ListLikes` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `IdShow` bigint(20) UNSIGNED NOT NULL,
  `dateLike` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ListLikes`
--

INSERT INTO `ListLikes` (`idUser`, `IdShow`, `dateLike`) VALUES
(10, 90669, '2022-12-02 16:58:10'),
(11, 90669, '2022-12-02 16:59:33'),
(12, 95403, '2022-12-02 17:01:55'),
(12, 90669, '2022-12-02 17:02:16'),
(9, 90669, '2022-12-02 17:19:11'),
(10, 83867, '2022-12-03 14:07:35'),
(10, 119051, '2022-12-05 17:37:27'),
(10, 95403, '2022-12-05 21:02:28'),
(9, 95403, '2022-12-05 21:47:58'),
(9, 87049, '2022-12-05 21:51:32'),
(15, 1396, '2022-12-05 22:31:21'),
(15, 119051, '2022-12-05 22:50:44'),
(15, 120089, '2022-12-05 22:50:56'),
(15, 95403, '2022-12-05 22:53:38');

-- --------------------------------------------------------

--
-- Structure de la table `Rights`
--

CREATE TABLE `Rights` (
  `idRight` bigint(20) UNSIGNED NOT NULL,
  `nameRight` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Rights`
--

INSERT INTO `Rights` (`idRight`, `nameRight`) VALUES
(1, 'inserer'),
(2, 'mettreajour'),
(4, 'selectionner'),
(3, 'supprimer');

-- --------------------------------------------------------

--
-- Structure de la table `Role`
--

CREATE TABLE `Role` (
  `idRole` bigint(20) UNSIGNED NOT NULL,
  `nameRole` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Role`
--

INSERT INTO `Role` (`idRole`, `nameRole`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `Show`
--

CREATE TABLE `Show` (
  `idShow` bigint(20) UNSIGNED NOT NULL,
  `rating` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Show`
--

INSERT INTO `Show` (`idShow`, `rating`) VALUES
(12, NULL),
(615, NULL),
(890, NULL),
(1054, NULL),
(1063, NULL),
(1395, NULL),
(1396, NULL),
(1399, NULL),
(1402, NULL),
(1429, NULL),
(1981, NULL),
(2692, NULL),
(2808, NULL),
(4327, NULL),
(4607, NULL),
(4615, NULL),
(4616, NULL),
(4623, NULL),
(4791, NULL),
(6798, NULL),
(7942, NULL),
(11279, NULL),
(13916, NULL),
(14814, NULL),
(14929, NULL),
(26453, NULL),
(30984, NULL),
(31586, NULL),
(31910, NULL),
(35935, NULL),
(37854, NULL),
(42705, NULL),
(45790, NULL),
(46260, NULL),
(46261, NULL),
(46331, NULL),
(50712, NULL),
(57911, NULL),
(60625, NULL),
(60735, NULL),
(61222, NULL),
(64432, NULL),
(65733, NULL),
(65942, NULL),
(67178, NULL),
(68507, NULL),
(69021, NULL),
(74813, NULL),
(75006, NULL),
(83867, NULL),
(84669, NULL),
(85552, NULL),
(87049, NULL),
(90669, NULL),
(94605, NULL),
(94997, NULL),
(95403, NULL),
(95479, NULL),
(95557, NULL),
(98123, NULL),
(105897, NULL),
(111837, NULL),
(114410, NULL),
(119051, NULL),
(120089, NULL),
(126437, NULL),
(130392, NULL),
(132799, NULL),
(133784, NULL),
(154521, NULL),
(203192, NULL),
(206112, NULL),
(211239, NULL),
(211660, NULL),
(212818, NULL),
(214173, NULL),
(214180, NULL),
(214258, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ToWatchLaterShows`
--

CREATE TABLE `ToWatchLaterShows` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idShow` bigint(20) UNSIGNED NOT NULL,
  `addDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ToWatchLaterShows`
--

INSERT INTO `ToWatchLaterShows` (`idUser`, `idShow`, `addDate`) VALUES
(9, 890, '2022-12-05 17:19:47'),
(9, 1402, '2022-12-05 17:19:47'),
(9, 30984, '2022-12-05 17:19:47'),
(9, 37854, '2022-12-05 17:19:47'),
(9, 45790, '2022-12-05 17:19:47'),
(9, 60625, '2022-12-05 17:19:47'),
(9, 94605, '2022-12-05 17:19:47'),
(9, 94997, '2022-12-05 17:19:47'),
(9, 98123, '2022-12-05 22:24:47'),
(9, 119051, '2022-12-05 17:19:47'),
(9, 214258, '2022-12-05 17:19:47'),
(13, 1054, '2022-12-05 17:19:47'),
(13, 45790, '2022-12-05 17:19:47'),
(14, 2808, '2022-12-05 17:19:47'),
(14, 50712, '2022-12-05 17:19:47'),
(15, 95403, '2022-12-05 23:52:47');

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `idRole` bigint(20) UNSIGNED NOT NULL,
  `register_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `show_setup` tinyint(1) NOT NULL,
  `avatar_file` tinytext NOT NULL,
  `banner_file` tinytext NOT NULL,
  `about` text,
  `color` tinytext NOT NULL,
  `forgot_auth` mediumtext,
  `adult` tinyint(1) NOT NULL,
  `private` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`id`, `username`, `email`, `password`, `idRole`, `register_date`, `show_setup`, `avatar_file`, `banner_file`, `about`, `color`, `forgot_auth`, `adult`, `private`) VALUES
(9, 'yanis-', 'yanis.ttc94@gmail.com', '$2y$10$qLE3l6zmkfC3MgcEdV.zoOsNlGvRjxbdsmAoQQ5r4BLf9Q5T4t2Ya', 1, '2022-11-24 10:25:07', 0, '1.png', '1.png', 'oui', 'white', NULL, 1, 0),
(10, 'Rachid', 'rachid.abdoulalime@gmail.com', '$2y$10$JSCbN1V2B5UGK8Dh2xrgiugtcOaIB2NyPLZs2vtC.pTt5qTOIlLJe', 1, '2022-11-24 17:41:04', 0, '1.png', '1.png', 'J\'aime le foot et la mma et les jeux vidéo', 'white', NULL, 0, 0),
(11, 'Rayan', 'abdoulalime.rachid@gmail.com', '$2y$10$AXLBkHfBXigG3rYhDKwbsu5QIPaT1zDIaFOTxyLu1Q/PLM8EkQOW6', 2, '2022-11-26 19:23:11', 1, '1.png', '1.png', NULL, 'white', NULL, 0, 0),
(12, 'BoobaOfficiel', 'azertyuio@gmail.com', '$2y$10$QgVSpZ/Tg6xlI6NNhfVuJOswAJG8rl/6PW0P7tdmtItrZwLURLHcm', 2, '2022-11-26 20:00:30', 1, '1.png', '1.png', 'Je suis un rapti !', 'white', NULL, 0, 0),
(13, 'slimane', 'slimaneofficiel@gmail.com', '$2y$10$iCY2bRAPrAY/TbfnnR.6tufAQ12AL.UG8p7ao8/5XBejw7r642Acy', 2, '2022-12-01 17:19:31', 1, '1.png', '1.png', NULL, 'white', NULL, 1, 0),
(14, 'ryuk94', 'ryukryukryuk@ryuk.com', '$2y$10$nejBsPR7b1LNYAiux2VUUe4CbW41vjqrLEpYGvm2rIfx.61MFTTAC', 2, '2022-12-02 11:05:40', 1, '1.png', '1.png', NULL, 'white', NULL, 0, 0),
(15, 'ttclesouverain', 'deqfqfdqddq@ghmdzjhqd.com', '$2y$10$x2RsxAv8HER458sCN0mSO.EwUkyKaK2Qa1/.H143.HRLuZ4RYC3dG', 2, '2022-12-05 22:55:28', 1, '1.png', '1.png', 'saluttt', '#FC9DD6', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `UserAdmin`
--

CREATE TABLE `UserAdmin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Belong`
--
ALTER TABLE `Belong`
  ADD PRIMARY KEY (`idShow`,`idGenre`),
  ADD KEY `Belong_idfk_1` (`idGenre`);

--
-- Index pour la table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`idCom`),
  ADD UNIQUE KEY `idCom` (`idCom`),
  ADD KEY `id` (`id`),
  ADD KEY `Comment_ibfk_2` (`idShow`);

--
-- Index pour la table `FavGenres`
--
ALTER TABLE `FavGenres`
  ADD PRIMARY KEY (`idUser`,`idGenre`),
  ADD KEY `FavGenres_ibfk_1` (`idGenre`);

--
-- Index pour la table `FollowedShows`
--
ALTER TABLE `FollowedShows`
  ADD PRIMARY KEY (`idUser`,`idShow`),
  ADD KEY `FollowedShows_ibfk_2` (`idShow`);

--
-- Index pour la table `FollowedUsers`
--
ALTER TABLE `FollowedUsers`
  ADD PRIMARY KEY (`idUser`,`idUserFollowed`),
  ADD KEY `id` (`idUser`,`idUserFollowed`) USING BTREE;

--
-- Index pour la table `Genre`
--
ALTER TABLE `Genre`
  ADD PRIMARY KEY (`idGenre`),
  ADD UNIQUE KEY `idGenre` (`idGenre`);

--
-- Index pour la table `Have`
--
ALTER TABLE `Have`
  ADD PRIMARY KEY (`idRight`,`idRole`),
  ADD KEY `idRole` (`idRole`);

--
-- Index pour la table `ListLikes`
--
ALTER TABLE `ListLikes`
  ADD KEY `idShow` (`IdShow`),
  ADD KEY `id` (`idUser`);

--
-- Index pour la table `Rights`
--
ALTER TABLE `Rights`
  ADD PRIMARY KEY (`idRight`),
  ADD UNIQUE KEY `idDroit` (`idRight`),
  ADD UNIQUE KEY `nomDroit` (`nameRight`);

--
-- Index pour la table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`idRole`),
  ADD UNIQUE KEY `idRole` (`idRole`),
  ADD UNIQUE KEY `nomRole` (`nameRole`);

--
-- Index pour la table `Show`
--
ALTER TABLE `Show`
  ADD PRIMARY KEY (`idShow`),
  ADD UNIQUE KEY `idSerie` (`idShow`);

--
-- Index pour la table `ToWatchLaterShows`
--
ALTER TABLE `ToWatchLaterShows`
  ADD PRIMARY KEY (`idUser`,`idShow`),
  ADD KEY `ToWatchLaterShows_ibfk_2` (`idShow`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `idRole` (`idRole`);

--
-- Index pour la table `UserAdmin`
--
ALTER TABLE `UserAdmin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `idCom` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT pour la table `Rights`
--
ALTER TABLE `Rights`
  MODIFY `idRight` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Role`
--
ALTER TABLE `Role`
  MODIFY `idRole` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `UserAdmin`
--
ALTER TABLE `UserAdmin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Belong`
--
ALTER TABLE `Belong`
  ADD CONSTRAINT `Belong_idfk_1` FOREIGN KEY (`idGenre`) REFERENCES `Genre` (`idGenre`),
  ADD CONSTRAINT `Belong_idfk_2` FOREIGN KEY (`idShow`) REFERENCES `Show` (`idShow`);

--
-- Contraintes pour la table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`idShow`) REFERENCES `Show` (`idShow`);

--
-- Contraintes pour la table `FavGenres`
--
ALTER TABLE `FavGenres`
  ADD CONSTRAINT `FavGenres_ibfk_1` FOREIGN KEY (`idGenre`) REFERENCES `Genre` (`idGenre`),
  ADD CONSTRAINT `FavGenres_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`);

--
-- Contraintes pour la table `FollowedShows`
--
ALTER TABLE `FollowedShows`
  ADD CONSTRAINT `FollowedShows_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `FollowedShows_ibfk_2` FOREIGN KEY (`idShow`) REFERENCES `Show` (`idShow`);

--
-- Contraintes pour la table `Have`
--
ALTER TABLE `Have`
  ADD CONSTRAINT `Have_ibfk_1` FOREIGN KEY (`idRight`) REFERENCES `Rights` (`idRight`),
  ADD CONSTRAINT `Have_ibfk_2` FOREIGN KEY (`idRole`) REFERENCES `Role` (`idRole`);

--
-- Contraintes pour la table `ToWatchLaterShows`
--
ALTER TABLE `ToWatchLaterShows`
  ADD CONSTRAINT `ToWatchLaterShows_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `ToWatchLaterShows_ibfk_2` FOREIGN KEY (`idShow`) REFERENCES `Show` (`idShow`);

--
-- Contraintes pour la table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `Role` (`idRole`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
