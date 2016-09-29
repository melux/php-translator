-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 29 Septembre 2016 à 10:01
-- Version du serveur: 5.1.72
-- Version de PHP: 5.4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bpm`
--

-- --------------------------------------------------------

--
-- Structure de la table `trl_keys`
--

CREATE TABLE IF NOT EXISTS `trl_keys` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `trl_key` varchar(255) NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=584 ;

-- --------------------------------------------------------

--
-- Structure de la table `trl_lng`
--

CREATE TABLE IF NOT EXISTS `trl_lng` (
  `lng_id` int(11) NOT NULL AUTO_INCREMENT,
  `lng_code` varchar(255) NOT NULL,
  PRIMARY KEY (`lng_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `trl_values`
--

CREATE TABLE IF NOT EXISTS `trl_values` (
  `trl_id` int(11) NOT NULL AUTO_INCREMENT,
  `lng_id` int(11) NOT NULL,
  `key_id` int(11) NOT NULL,
  `trl_value` text,
  PRIMARY KEY (`trl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1356 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
