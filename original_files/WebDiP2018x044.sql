-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 10 Juin 2019 à 19:43
-- Version du serveur :  5.5.62-0+deb8u1
-- Version de PHP :  7.2.17-1+0~20190412070953.20+jessie~1.gbp23a36d

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `WebDiP2018x044`
--
CREATE DATABASE IF NOT EXISTS `WebDiP2018x044` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `WebDiP2018x044`;

-- --------------------------------------------------------

--
-- Structure de la table `Categories_Project`
--

CREATE TABLE `Categories_Project` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Categories_Project`
--

INSERT INTO `Categories_Project` (`name`) VALUES
('A2'),
('A4'),
('A5'),
('A6'),
('A3'),
('A1');

-- --------------------------------------------------------

--
-- Structure de la table `Moderators_Permissions`
--

CREATE TABLE `Moderators_Permissions` (
  `id` int(11) NOT NULL,
  `categorie` varchar(64) NOT NULL,
  `moderator` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Moderators_Permissions`
--

INSERT INTO `Moderators_Permissions` (`id`, `categorie`, `moderator`) VALUES
(1, 'A2', 'modo1'),
(2, 'A4', 'modo2'),
(3, 'A5', 'modo3'),
(6, 'A2', 'modo2'),
(7, 'A3', 'modo2'),
(8, 'A6', 'modo3'),
(9, 'A1', 'modo1');

-- --------------------------------------------------------

--
-- Structure de la table `Purchases_Project`
--

CREATE TABLE `Purchases_Project` (
  `Id` int(11) NOT NULL,
  `Status` int(11) DEFAULT NULL,
  `Customer_Name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Designer_Name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `Template_Name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Date` date NOT NULL,
  `Customer_Title` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Customer_Tagline` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Customer_Content` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `Purchases_Project`
--

INSERT INTO `Purchases_Project` (`Id`, `Status`, `Customer_Name`, `Designer_Name`, `quantity`, `Template_Name`, `Date`, `Customer_Title`, `Customer_Tagline`, `Customer_Content`) VALUES
(1, 1, 'tintin', 'modo1', 500, 'WelcomeParty', '2019-05-09', 'Welcome at FOI !', 'Student Party', 'Come on to the student party at 8 PM  on Mars 29th !'),
(2, 0, 'damien', 'modo1', 10, 'CompanyReport', '2019-06-02', 'ESIEA', 'report of Year', 'This is the ESIEA Report blablabla'),
(4, 0, 'toto', 'modo2', 250, 'Thereisnotlimit', '2019-06-02', 'No Limit', 'Trust in yourself', 'You are the only one that can make your dreams come true !'),
(5, 0, 'modo1', 'modo2', 34, 'Thereisnotlimit', '2019-06-02', 'Do it', 'Just to try', 'I you don\'t know I don\'t know'),
(6, 1, 'damien', 'modo3', 13, 'CuteDesign', '2019-06-08', 'BienvenueChez nous', 'onestbienici', 'Alphabet : abcdefghijklmnopqrstuvwxyz'),
(7, 0, 'tintin', 'modo3', 99, 'CuteDesign', '2019-06-08', 'coucou', 'wesh', 'bien ou bien ?'),
(8, 0, 'Papa', 'modo3', 17, 'ModernHeadline', '2019-06-08', 'ModernTest', 'we are near the end', '(^-^)'),
(9, 0, 'Popopopop', 'modo3', 3, 'TopHeadlines', '2019-06-08', 'Rolup', 'Vhh', 'Poster to boost your self confiance');

-- --------------------------------------------------------

--
-- Structure de la table `Templates_Project`
--

CREATE TABLE `Templates_Project` (
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(255) NOT NULL,
  `template_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creator` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `Templates_Project`
--

INSERT INTO `Templates_Project` (`name`, `description`, `price`, `template_path`, `categorie`, `creator`) VALUES
('BusinessYellow', 'Yellow version of business report', 76, '../multimedia/templates/CorporateBusiness.png', 'A1', 'modo1'),
('CompanyReport', 'This is a flat design template for annual  report', 25, '../multimedia/templates/CompanyReport.png', 'A2', 'modo1'),
('CorporateReport', 'annual template for compagny report', 50, '../multimedia/templates/CorporateFlyer.png', 'A4', 'modo2'),
('CuteDesign', 'Cute Creative Red Design', 15, '../multimedia/templates/CreativeCuteDesign.png', 'A5', 'modo3'),
('ModernHeadline', 'Modern Template for entertainment', 25, '../multimedia/templates/Headline2.png', 'A1', 'modo3'),
('Rollup', 'Modern Rollup template', 25, '../multimedia/templates/RollupModern.png', 'A5', 'modo3'),
('Thereisnotlimit', 'Poster to boost your self confiance', 10, '../multimedia/templates/NoLimit.png', 'A4', 'modo2'),
('TheWebsiteTemplate!', 'This is the Business Template of the Website , A6 Format , made by Administration with <3', 500, '../multimedia/templates/BusinessPosterTemplate.png', 'A6', 'root'),
('TopHeadlines', 'Headline for A6 templates', 99, '../multimedia/templates/Headline.png', 'A6', 'modo3'),
('WelcomeParty', 'This is a simple template for advertising a party', 15, '../multimedia/templates/WelcomeParty.png', 'A2', 'modo1');

-- --------------------------------------------------------

--
-- Structure de la table `Users_Project`
--

CREATE TABLE `Users_Project` (
  `username` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encrypted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `spend_points` int(255) NOT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `error` int(255) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `Users_Project`
--

INSERT INTO `Users_Project` (`username`, `email`, `password`, `encrypted`, `type`, `status`, `points`, `spend_points`, `hash`, `error`, `time`) VALUES
('Barbu', 'roadtobarbu@gmail.com', 'bb', '21ad0bd836b90d08f4cf640b4c298e7c', 3, 1, 100, 0, '47d1e990583c9c67424d369f3414728e', 0, '2019-06-08 14:37:58'),
('damien', 'gounot.damien@gmail.com', '123', '202cb962ac59075b964b07152d234b70', 3, 1, 58, 48, '93db85ed909c13838ff95ccfa94cebd9', 0, '2019-06-17 22:00:00'),
('dorian', 'cazodojalo@top-mailer.net', '23', '37693cfc748049e45d87b8c7d8b9aacd', 3, 1, 100, 0, '19bc916108fc6938f52cb96f7e087941', 0, '2019-06-08 13:28:50'),
('Marko', 'xarigo@crypto-net.club', 'aq', 'b2b04af9f8f3ab06229e03ac8d3c24ca', 3, 1, 100, 0, '64223ccf70bbb65a3a4aceac37e21016', 0, '2019-06-08 08:32:02'),
('modo1', 'modo1@gmail.com', 'modo1', '7e220261f2f2d24ba9ae4bc59b81872b', 2, 1, 23, 89, '2f55707d4193dc27118a0f19a1985716', 0, '2019-03-02 23:23:00'),
('modo2', 'modo2@gmail.com', 'modo2', '47ab7a1bb52b1623a5d5e7e7df3c2b3e', 2, 1, 71, 93, 'f1b6f2857fb6d44dd73c7041e0aa0f19', 0, '2019-02-05 02:24:39'),
('modo3', 'modo3@gmail.com', 'modo3', 'b6621e47968829805745f672c771ebab', 2, 1, 54, 189, 'e7b24b112a44fdd9ee93bdf998c6ca0e', 0, '2018-12-17 18:00:00'),
('Papa', 'nogitinafu@coin-link.com', 'papa', '0ac6cd34e2fac333bf0ee3cd06bdcf96', 3, 1, 100, 0, '4d5b995358e7798bc7e9d9db83c612a5', 0, '2019-06-08 13:44:18'),
('Popopopop', 'les_gounot@libertysurf.fr', 'Egounot01', '926a4bb5167655a7f505ee638c35b170', 3, 1, 100, 0, '6ea9ab1baa0efb9e19094440c317e21b', 0, '2019-06-08 15:02:19'),
('PouetPouet', 'Pouet@free.fr', 'totototo', 'c33ca5e7eae116138d1d1b61158d58f9', 3, 0, 100, 0, '37a749d808e46495a8da1e5352d03cae', 0, '2019-06-08 15:00:45'),
('root', 'root@root.com', 'root', '63a9f0ea7bb98050796b649e85481845', 1, 1, 142, 136, '28dd2c7955ce926456240b2ff0100bde', 0, '2018-12-21 13:23:10'),
('superman', 'yenuxe@top-mailer.net', 'super', '1b3231655cebb7a1f783eddf27d254ca', 3, 1, 100, 0, '2a9d121cd9c3a1832bb6d2cc6bd7a8a7', 0, '2019-06-09 08:10:14'),
('tintin', 'tintin@gmail.com', 'tintin', '069a6a9ccaaca7967a0c43cb5e161187', 3, 1, 98, 6, '1c9ac0159c94d8d0cbedc973445af2da', 0, '2019-05-14 15:53:42'),
('toto', 'guriyu@safe-planet.com', 'toto', 'f71dbe52628a3f83a77ab494817525c6', 3, 1, 6, 154, '51d92be1c60d1db1d2e5e7a07da55b26', 0, '2019-06-24 04:40:20');

-- --------------------------------------------------------

--
-- Structure de la table `Users_Vouchers`
--

CREATE TABLE `Users_Vouchers` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `userVoucher` varchar(128) NOT NULL,
  `isUsed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Users_Vouchers`
--

INSERT INTO `Users_Vouchers` (`id`, `username`, `userVoucher`, `isUsed`) VALUES
(2, 'modo2', 'PROMO15', 1),
(12, 'damien', 'PROMO100', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Vouchers_Project`
--

CREATE TABLE `Vouchers_Project` (
  `code` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points_needed` int(11) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `Vouchers_Project`
--

INSERT INTO `Vouchers_Project` (`code`, `description`, `categorie`, `points_needed`, `expiration`, `active`, `image_path`) VALUES
('PROMO10', '10 $ discount for A2 templates', 'A2', 10, '2019-08-18', 1, '../multimedia/vouchers/PROMO10.png'),
('PROMO100', '100$ discount for A3 templates', 'A3', 12, '2019-08-08', 1, '../multimedia/vouchers/PROMO100.png'),
('PROMO15', '15 $ discount for A6 templates', 'A6', 1000, NULL, 1, '../multimedia/vouchers/PROMO15.png'),
('PROMO25', '25$ discount for  A4 templates', 'A4', 45, '2019-07-13', 1, '../multimedia/vouchers/PROMO25.png'),
('PROMO5', '5 $ discount for A1 templates', 'A1', NULL, NULL, 1, '../multimedia/vouchers/PROMO5.png'),
('PROMO50', '50$ Discount for A5 categorie', 'A5', 30, '2019-07-19', 1, '../multimedia/vouchers/PROMO50.png');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Moderators_Permissions`
--
ALTER TABLE `Moderators_Permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Purchases_Project`
--
ALTER TABLE `Purchases_Project`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id_UNIQUE` (`Id`);

--
-- Index pour la table `Templates_Project`
--
ALTER TABLE `Templates_Project`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `Name_UNIQUE` (`name`);

--
-- Index pour la table `Users_Project`
--
ALTER TABLE `Users_Project`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `Username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Index pour la table `Users_Vouchers`
--
ALTER TABLE `Users_Vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Vouchers_Project`
--
ALTER TABLE `Vouchers_Project`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `Code_UNIQUE` (`code`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Moderators_Permissions`
--
ALTER TABLE `Moderators_Permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `Purchases_Project`
--
ALTER TABLE `Purchases_Project`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `Users_Vouchers`
--
ALTER TABLE `Users_Vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
