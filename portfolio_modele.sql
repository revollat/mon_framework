-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 14 Octobre 2013 à 14:59
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `portfolio_modele`
--
CREATE DATABASE IF NOT EXISTS `portfolio_modele` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `portfolio_modele`;

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) NOT NULL,
  `lien` varchar(250) NOT NULL,
  `index_menu` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `menu`
--

INSERT INTO `menu` (`id_menu`, `designation`, `lien`, `index_menu`) VALUES
(1, 'Accueil', 'accueil', 1),
(21, 'C.V.', 'cv', 2),
(22, 'Réalisations', 'realisations', 3),
(23, 'Me contacter', 'contact', 4);

-- --------------------------------------------------------

--
-- Structure de la table `realisations`
--

CREATE TABLE IF NOT EXISTS `realisations` (
  `id_realisation` int(11) NOT NULL AUTO_INCREMENT,
  `lien_image` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL,
  `lien_realisation` varchar(150) NOT NULL,
  PRIMARY KEY (`id_realisation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `realisations`
--

INSERT INTO `realisations` (`id_realisation`, `lien_image`, `description`, `lien_realisation`) VALUES
(3, 'images/chat1.jpg', 'S''il te plaît !!!', 'http://fr.wiktionary.org/wiki/s%E2%80%99il_te_pla%C3%AEt'),
(4, 'images/nature1.jpg', 'Loin', 'http://www.dailymotion.com/video/x1vs62_u2-stay-faraway-so-close_music'),
(5, 'images/chat2.jpg', 'Je domine la situation !', 'http://www.dailymotion.com/video/x17woh_minus-et-cortex-generique-vf_animals'),
(6, 'images/nature2.jpg', 'Nature', 'http://www.cnrs.fr/cw/dossiers/dosbioville/bioville.html'),
(7, 'images/chat3.jpg', 'Marseillais ?', 'http://www.marseillais-du-monde.org/sardine.php3'),
(8, 'images/nature3.jpg', 'Zen', 'http://fr.wikipedia.org/wiki/Zen'),
(9, 'images/chat4.jpg', 'Gros Calin', 'http://www.google.fr'),
(10, 'images/chat3.jpg', 'Mes vacances à la mer', 'http://www.unpeudetoutetderien.com/wp-content/uploads/2011/08/titanic.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
