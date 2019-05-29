-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour chatox
CREATE DATABASE IF NOT EXISTS `chatox` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `chatox`;

-- Listage de la structure de la table chatox. messagerie
CREATE TABLE IF NOT EXISTS `messagerie` (
  `messagerie_ID` int(11) NOT NULL AUTO_INCREMENT,
  `users_ID` int(11) DEFAULT NULL,
  `message` text,
  `date_message` datetime DEFAULT NULL,
  PRIMARY KEY (`messagerie_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Listage de la structure de la table chatox. users
CREATE TABLE IF NOT EXISTS `users` (
  `users_ID` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` char(50) NOT NULL,
  `motDePasse` text NOT NULL,
  PRIMARY KEY (`users_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
