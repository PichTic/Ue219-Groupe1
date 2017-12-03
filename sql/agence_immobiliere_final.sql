-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `motdepasse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identifiant` (`identifiant`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `clients` (`id`, `identifiant`, `motdepasse`) VALUES
(1,	'Administrateur',	'83CCutv8');

DROP TABLE IF EXISTS `logements`;
CREATE TABLE `logements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surface` int(11) NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `logements` (`id`, `adresse`, `type`, `surface`, `client_id`) VALUES
(1,	'12 avenue Albert Thomas, 87000 Limoges',	'appartement',	67,	1),
(2,	'3 avenue de Landouge, 87100 Limoges',	'maison',	13,	1),
(3,	'31 impasse du heron, 57100 THIONVILLE',	'appartement',	86,	1),
(7,	'6 passage des Bains, 74000 Annecy',	'appartement',	66,	10);

-- 2017-12-03 20:15:08
