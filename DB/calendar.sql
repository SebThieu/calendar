-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 10 Décembre 2015 à 09:57
-- Version du serveur :  5.6.25
-- Version de PHP :  5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `calendar`
--
CREATE DATABASE IF NOT EXISTS `calendar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `calendar`;

-- --------------------------------------------------------

--
-- Structure de la table `cal_event`
--

CREATE TABLE IF NOT EXISTS `cal_event` (
  `cal_event_id` int(11) NOT NULL,
  `cal_event_link_cal_event_cat_id` int(11) NOT NULL,
  `cal_event_title` varchar(100) NOT NULL,
  `cal_event_description` varchar(150) NOT NULL,
  `cal_event_datedeb` datetime DEFAULT NULL,
  `cal_event_datefin` datetime DEFAULT NULL,
  `cal_event_link_cal_insee_zipcode` int(5) DEFAULT NULL,
  `cal_event_img` varchar(150) NOT NULL,
  `cal_event_price` varchar(10) NOT NULL DEFAULT 'N/C',
  `cal_event_gps` varchar(20) NOT NULL DEFAULT '0 0',
  `cal_event_orglink` varchar(500) CHARACTER SET latin1 NOT NULL,
  `cal_event_map` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `cal_event`:
--

--
-- Contenu de la table `cal_event`
--

INSERT INTO `cal_event` (`cal_event_id`, `cal_event_link_cal_event_cat_id`, `cal_event_title`, `cal_event_description`, `cal_event_datedeb`, `cal_event_datefin`, `cal_event_link_cal_insee_zipcode`, `cal_event_img`, `cal_event_price`, `cal_event_gps`, `cal_event_orglink`, `cal_event_map`) VALUES
(1, 1, 'Muse - Drones Tour', 'FRANCE! The fifth and sixth shows in Paris on the Drones World Tour in 2016 have been announced !', '2016-02-26 00:00:00', NULL, 75001, 'img/img_event1.jpg', '100', '0 0', 'http://muse.mu/tour-dates,paris-france-bercy-arena_1965.htm', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.031312920665!2d2.376395515917241!3d48.8385414100577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6721743fa0af9%3A0x989bfc2771543869!2sAccorHotels+Arena!5e0!3m2!1sfr!2sfr!4v1449658919142" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>'),
(2, 2, 'Random Salon', 'dsgdxsgfdxgdsfgdsgfedsqgfedshbfdg', '2015-12-24 00:00:00', NULL, 27400, 'img/img_event2.jpg', '149', '0 0', '', ''),
(3, 3, 'Random Expo', 'sdwgtfdxhbhdgfdgfdsgffds', '2016-04-14 00:00:00', NULL, 37000, 'img/img_event3.jpg', '1544', '0 0', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `cal_event_cat`
--

CREATE TABLE IF NOT EXISTS `cal_event_cat` (
  `cal_event_cat_id` int(11) NOT NULL,
  `cal_event_cat_title` varchar(100) NOT NULL,
  `cal_event_cat_description` varchar(500) NOT NULL,
  `cal_event_cat_defcolor` varchar(7) NOT NULL,
  `cal_event_cat_defimg` varchar(30) DEFAULT NULL,
  `cal_event_cat_ordre` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `cal_event_cat`:
--

--
-- Contenu de la table `cal_event_cat`
--

INSERT INTO `cal_event_cat` (`cal_event_cat_id`, `cal_event_cat_title`, `cal_event_cat_description`, `cal_event_cat_defcolor`, `cal_event_cat_defimg`, `cal_event_cat_ordre`) VALUES
(1, 'Concert', 'Concerts blabla', 'RED', '', NULL),
(2, 'Salon', 'Salons bla bla', 'GREEN', '', NULL),
(3, 'Exposition', 'Expositions bla bla', 'BLUE', '', NULL),
(4, 'Evenement Public', 'Evenement Public bla bla', 'YELLOW', '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cal_insee`
--

CREATE TABLE IF NOT EXISTS `cal_insee` (
  `cal_insee_insee` int(5) NOT NULL,
  `cal_insee_city` varchar(40) NOT NULL,
  `cal_insee_zipcode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `cal_insee`:
--

-- --------------------------------------------------------

--
-- Structure de la table `cal_membres`
--

CREATE TABLE IF NOT EXISTS `cal_membres` (
  `cal_membres_id` int(11) NOT NULL,
  `cal_membres_nick` varchar(20) NOT NULL,
  `cal_membres_email` varchar(255) NOT NULL,
  `cal_membres_password` varchar(60) NOT NULL,
  `cal_membres_lastname` varchar(60) DEFAULT NULL,
  `cal_membres_firstname` varchar(60) DEFAULT NULL,
  `cal_membres_address` varchar(150) NOT NULL,
  `cal_membres_zipcode` int(5) NOT NULL,
  `cal_membres_city` varchar(40) NOT NULL,
  `cal_membres_avatar` varchar(60) NOT NULL DEFAULT '../img/avatars/default.jpg',
  `cal_membres_active` int(1) NOT NULL DEFAULT '0',
  `cal_membres_registration_date` date NOT NULL,
  `cal_membres_token` varchar(60) DEFAULT NULL,
  `cal_membres_group` int(1) NOT NULL DEFAULT '0',
  `cal_membres_ip` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `cal_membres`:
--

--
-- Contenu de la table `cal_membres`
--

INSERT INTO `cal_membres` (`cal_membres_id`, `cal_membres_nick`, `cal_membres_email`, `cal_membres_password`, `cal_membres_lastname`, `cal_membres_firstname`, `cal_membres_address`, `cal_membres_zipcode`, `cal_membres_city`, `cal_membres_avatar`, `cal_membres_active`, `cal_membres_registration_date`, `cal_membres_token`, `cal_membres_group`, `cal_membres_ip`) VALUES
(1, 'toto', 'toto@free.fr', 'f71dbe52628a3f83a77ab494817525c6', NULL, NULL, 'kwuhbfdgv', 27200, 'Vernon', '../img/avatars/default.jpg', 1, '0000-00-00', NULL, 0, ''),
(3, 'titi', 'titi@free.fr', '5d933eef19aee7da192608de61b6c23d', NULL, NULL, '', 0, '', '../img/avatars/default.jpg', 0, '2015-12-08', NULL, 0, ''),
(4, 'tata', 'tata@free.fr', '49d02d55ad10973b7b9d0dc9eba7fdf0', NULL, NULL, '', 0, '', '../img/avatars/default.jpg', 0, '2015-12-08', NULL, 0, ''),
(8, 'tester', 'tester@free.fr', 'f5d1278e8109edd94e1e4197e04873b9', NULL, NULL, '', 0, '', '../img/avatars/default.jpg', 1, '2015-12-10', 'monsupertoken', 1, '::1'),
(9, 'tester2', 'tester2@free.fr', 'f5d1278e8109edd94e1e4197e04873b9', NULL, NULL, '', 0, '', '../img/avatars/default.jpg', 1, '2015-12-10', 'monsupertoken', 1, '::1');

-- --------------------------------------------------------

--
-- Structure de la table `cal_membres_event`
--

CREATE TABLE IF NOT EXISTS `cal_membres_event` (
  `cal_membres_event_id` int(11) NOT NULL,
  `cal_membres_event_link_cal_membres_id` int(11) NOT NULL,
  `cal_membres_event_link_cal_event_id` int(11) NOT NULL,
  `cal_membres_event_title` varchar(100) NOT NULL,
  `cal_membres_event_description` varchar(500) NOT NULL,
  `cal_membres_event_deb` date DEFAULT NULL,
  `cal_membres_event_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `cal_membres_event`:
--   `cal_membres_event_link_cal_event_id`
--       `cal_event` -> `cal_event_id`
--   `cal_membres_event_link_cal_membres_id`
--       `cal_membres` -> `cal_membres_id`
--

--
-- Contenu de la table `cal_membres_event`
--

INSERT INTO `cal_membres_event` (`cal_membres_event_id`, `cal_membres_event_link_cal_membres_id`, `cal_membres_event_link_cal_event_id`, `cal_membres_event_title`, `cal_membres_event_description`, `cal_membres_event_deb`, `cal_membres_event_fin`) VALUES
(1, 1, 1, 'Chouille Noel', 'Avec la mif', '2015-12-25', '2015-12-26'),
(2, 1, 2, 'truc', 'qdfg', '2015-12-24', NULL),
(3, 2, 1, 'qfdsgdwqfg', 'dwsqfgfdsqg', '2015-12-20', NULL),
(4, 1, 8, 'fdxg', 'wsdfg', '2015-12-25', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cal_membres_group`
--

CREATE TABLE IF NOT EXISTS `cal_membres_group` (
  `cal_membres_group_id` int(11) NOT NULL,
  `cal_membres_group_group` varchar(20) NOT NULL,
  `cal_membres_group_color` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS POUR LA TABLE `cal_membres_group`:
--

--
-- Contenu de la table `cal_membres_group`
--

INSERT INTO `cal_membres_group` (`cal_membres_group_id`, `cal_membres_group_group`, `cal_membres_group_color`) VALUES
(0, 'off', NULL),
(1, 'utilisateur', NULL),
(2, 'premium', NULL),
(6, 'organisateur', NULL),
(8, 'administrateur', NULL),
(9, 'SuperAdmin', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cal_event`
--
ALTER TABLE `cal_event`
  ADD PRIMARY KEY (`cal_event_id`);

--
-- Index pour la table `cal_event_cat`
--
ALTER TABLE `cal_event_cat`
  ADD PRIMARY KEY (`cal_event_cat_id`);

--
-- Index pour la table `cal_insee`
--
ALTER TABLE `cal_insee`
  ADD PRIMARY KEY (`cal_insee_insee`),
  ADD UNIQUE KEY `cal_insee_insee` (`cal_insee_insee`);

--
-- Index pour la table `cal_membres`
--
ALTER TABLE `cal_membres`
  ADD PRIMARY KEY (`cal_membres_id`);

--
-- Index pour la table `cal_membres_event`
--
ALTER TABLE `cal_membres_event`
  ADD PRIMARY KEY (`cal_membres_event_id`);

--
-- Index pour la table `cal_membres_group`
--
ALTER TABLE `cal_membres_group`
  ADD PRIMARY KEY (`cal_membres_group_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cal_event`
--
ALTER TABLE `cal_event`
  MODIFY `cal_event_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `cal_event_cat`
--
ALTER TABLE `cal_event_cat`
  MODIFY `cal_event_cat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `cal_membres`
--
ALTER TABLE `cal_membres`
  MODIFY `cal_membres_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
