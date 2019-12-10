-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           10.4.6-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour joutes
CREATE DATABASE IF NOT EXISTS `joutes` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `joutes`;

-- Listage de la structure de la table joutes. backend_targets
CREATE TABLE IF NOT EXISTS `backend_targets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.backend_targets : ~0 rows (environ)
/*!40000 ALTER TABLE `backend_targets` DISABLE KEYS */;
/*!40000 ALTER TABLE `backend_targets` ENABLE KEYS */;

-- Listage de la structure de la table joutes. contenders
CREATE TABLE IF NOT EXISTS `contenders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rank_in_pool` int(11) DEFAULT NULL,
  `pool_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned DEFAULT NULL,
  `pool_from_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contenders_pool_id_foreign` (`pool_id`),
  KEY `contenders_team_id_foreign` (`team_id`),
  KEY `contenders_pool_from_id_foreign` (`pool_from_id`),
  CONSTRAINT `contenders_pool_from_id_foreign` FOREIGN KEY (`pool_from_id`) REFERENCES `pools` (`id`),
  CONSTRAINT `contenders_pool_id_foreign` FOREIGN KEY (`pool_id`) REFERENCES `pools` (`id`),
  CONSTRAINT `contenders_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.contenders : ~88 rows (environ)
/*!40000 ALTER TABLE `contenders` DISABLE KEYS */;
INSERT INTO `contenders` (`id`, `rank_in_pool`, `pool_id`, `team_id`, `pool_from_id`) VALUES
	(1, NULL, 1, 1, NULL),
	(2, NULL, 1, 2, NULL),
	(3, NULL, 1, 3, NULL),
	(4, NULL, 1, 4, NULL),
	(5, NULL, 2, 5, NULL),
	(6, NULL, 2, 6, NULL),
	(7, NULL, 2, 7, NULL),
	(8, NULL, 2, 8, NULL),
	(9, NULL, 3, 9, NULL),
	(10, NULL, 3, 10, NULL),
	(11, NULL, 3, 11, NULL),
	(12, NULL, 3, 12, NULL),
	(13, NULL, 4, 13, NULL),
	(14, NULL, 4, 14, NULL),
	(15, NULL, 4, 15, NULL),
	(16, NULL, 4, 16, NULL),
	(17, NULL, 5, 17, NULL),
	(18, NULL, 5, 18, NULL),
	(19, NULL, 5, 19, NULL),
	(20, NULL, 5, 20, NULL),
	(21, NULL, 6, 21, NULL),
	(22, NULL, 6, 22, NULL),
	(23, NULL, 6, 23, NULL),
	(24, NULL, 6, 24, NULL),
	(25, NULL, 7, 25, NULL),
	(26, NULL, 7, 26, NULL),
	(27, NULL, 7, 27, NULL),
	(28, NULL, 7, 28, NULL),
	(29, NULL, 8, 29, NULL),
	(30, NULL, 8, 30, NULL),
	(31, NULL, 8, 31, NULL),
	(32, NULL, 8, 32, NULL),
	(64, 1, 9, NULL, 1),
	(65, 2, 9, NULL, 1),
	(66, 1, 9, NULL, 2),
	(67, 2, 9, NULL, 2),
	(68, 1, 10, NULL, 3),
	(69, 2, 10, NULL, 3),
	(70, 1, 10, NULL, 4),
	(71, 2, 10, NULL, 4),
	(72, 1, 11, NULL, 5),
	(73, 2, 11, NULL, 5),
	(74, 1, 11, NULL, 6),
	(75, 2, 11, NULL, 6),
	(76, 1, 12, NULL, 7),
	(77, 2, 12, NULL, 7),
	(78, 1, 12, NULL, 8),
	(79, 2, 12, NULL, 8),
	(80, 3, 13, NULL, 1),
	(81, 4, 13, NULL, 1),
	(82, 3, 13, NULL, 2),
	(83, 4, 13, NULL, 2),
	(84, 3, 14, NULL, 3),
	(85, 4, 14, NULL, 3),
	(86, 3, 14, NULL, 4),
	(87, 4, 14, NULL, 4),
	(88, 3, 15, NULL, 5),
	(89, 4, 15, NULL, 5),
	(90, 3, 15, NULL, 6),
	(91, 4, 15, NULL, 6),
	(92, 3, 16, NULL, 7),
	(93, 4, 16, NULL, 7),
	(94, 3, 16, NULL, 8),
	(95, 4, 16, NULL, 8),
	(96, 1, 17, NULL, 9),
	(97, 2, 17, NULL, 9),
	(98, 1, 17, NULL, 10),
	(99, 2, 17, NULL, 10),
	(100, 1, 18, NULL, 11),
	(101, 2, 18, NULL, 11),
	(102, 1, 18, NULL, 12),
	(103, 2, 18, NULL, 12),
	(104, 3, 19, NULL, 13),
	(105, 4, 19, NULL, 13),
	(106, 3, 19, NULL, 14),
	(107, 4, 19, NULL, 14),
	(108, 3, 20, NULL, 15),
	(109, 4, 20, NULL, 15),
	(110, 3, 20, NULL, 16),
	(111, 4, 20, NULL, 16),
	(112, 1, 21, NULL, 17),
	(113, 1, 21, NULL, 17),
	(114, 2, 22, NULL, 18),
	(115, 2, 22, NULL, 18),
	(116, 3, 23, NULL, 19),
	(117, 3, 23, NULL, 19),
	(118, 4, 24, NULL, 20),
	(119, 4, 24, NULL, 20);
/*!40000 ALTER TABLE `contenders` ENABLE KEYS */;

-- Listage de la structure de la table joutes. courts
CREATE TABLE IF NOT EXISTS `courts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sport_id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `acronym` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courts_sport_id_foreign` (`sport_id`),
  CONSTRAINT `courts_sport_id_foreign` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.courts : ~5 rows (environ)
/*!40000 ALTER TABLE `courts` DISABLE KEYS */;
INSERT INTO `courts` (`id`, `sport_id`, `name`, `deleted_at`, `acronym`) VALUES
	(1, 1, 'Terrain A', NULL, NULL),
	(2, 1, 'Terrain B', NULL, NULL),
	(3, 1, 'Terrain C', NULL, NULL),
	(4, 1, 'Terrain D', NULL, NULL),
	(5, 2, 'Test', NULL, 'a');
/*!40000 ALTER TABLE `courts` ENABLE KEYS */;

-- Listage de la structure de la table joutes. events
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.events : ~0 rows (environ)
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`id`, `name`, `img`) VALUES
	(1, 'joutes 2020', NULL);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;

-- Listage de la structure de la table joutes. games
CREATE TABLE IF NOT EXISTS `games` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `score_contender1` int(11) DEFAULT NULL,
  `score_contender2` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `contender1_id` int(10) unsigned DEFAULT NULL,
  `contender2_id` int(10) unsigned DEFAULT NULL,
  `court_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `games_contender1_id_foreign` (`contender1_id`),
  KEY `games_contender2_id_foreign` (`contender2_id`),
  KEY `games_court_id_foreign` (`court_id`),
  CONSTRAINT `games_contender1_id_foreign` FOREIGN KEY (`contender1_id`) REFERENCES `contenders` (`id`),
  CONSTRAINT `games_contender2_id_foreign` FOREIGN KEY (`contender2_id`) REFERENCES `contenders` (`id`),
  CONSTRAINT `games_court_id_foreign` FOREIGN KEY (`court_id`) REFERENCES `courts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.games : ~124 rows (environ)
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` (`id`, `score_contender1`, `score_contender2`, `date`, `start_time`, `contender1_id`, `contender2_id`, `court_id`) VALUES
	(1, 6, 15, '2020-06-11', '08:00:00', 1, 2, 1),
	(2, 9, 15, '2020-06-11', '08:15:00', 1, 3, 1),
	(3, 15, 5, '2020-06-11', '08:30:00', 1, 4, 1),
	(4, 15, 8, '2020-06-11', '08:30:00', 2, 3, 1),
	(5, 15, 8, '2020-06-11', '08:45:00', 2, 4, 1),
	(6, 11, 15, '2020-06-11', '09:00:00', 3, 4, 1),
	(7, 11, 15, '2020-06-11', '08:00:00', 5, 6, 1),
	(8, 15, 5, '2020-06-11', '08:15:00', 5, 7, 1),
	(9, 10, 15, '2020-06-11', '08:30:00', 5, 8, 1),
	(10, 15, 9, '2020-06-11', '08:30:00', 6, 7, 1),
	(11, 6, 15, '2020-06-11', '08:45:00', 6, 8, 1),
	(12, 5, 15, '2020-06-11', '09:00:00', 7, 8, 1),
	(13, 15, 7, '2020-06-11', '08:00:00', 9, 10, 1),
	(14, 15, 8, '2020-06-11', '08:15:00', 9, 11, 1),
	(15, 5, 15, '2020-06-11', '08:30:00', 9, 12, 1),
	(16, 15, 10, '2020-06-11', '08:30:00', 10, 11, 1),
	(17, 15, 11, '2020-06-11', '08:45:00', 10, 12, 1),
	(18, 8, 15, '2020-06-11', '09:00:00', 11, 12, 1),
	(19, 15, 6, '2020-06-11', '08:00:00', 13, 14, 1),
	(20, 12, 15, '2020-06-11', '08:15:00', 13, 15, 1),
	(21, 15, 12, '2020-06-11', '08:30:00', 13, 16, 1),
	(22, 6, 15, '2020-06-11', '08:30:00', 14, 15, 1),
	(23, 15, 5, '2020-06-11', '08:45:00', 14, 16, 1),
	(24, 9, 15, '2020-06-11', '09:00:00', 15, 16, 1),
	(25, 15, 8, '2020-06-11', '08:00:00', 17, 18, 1),
	(26, 15, 9, '2020-06-11', '08:15:00', 17, 19, 1),
	(27, 15, 7, '2020-06-11', '08:30:00', 17, 20, 1),
	(28, 15, 6, '2020-06-11', '08:30:00', 18, 19, 1),
	(29, 15, 6, '2020-06-11', '08:45:00', 18, 20, 1),
	(30, 5, 15, '2020-06-11', '09:00:00', 19, 20, 1),
	(31, 9, 15, '2020-06-11', '08:00:00', 21, 22, 1),
	(32, 7, 15, '2020-06-11', '08:15:00', 21, 23, 1),
	(33, 10, 15, '2020-06-11', '08:30:00', 21, 24, 1),
	(34, 15, 12, '2020-06-11', '08:30:00', 22, 23, 1),
	(35, 15, 10, '2020-06-11', '08:45:00', 22, 24, 1),
	(36, 8, 15, '2020-06-11', '09:00:00', 23, 24, 1),
	(37, 6, 15, '2020-06-11', '08:00:00', 25, 26, 1),
	(38, 9, 15, '2020-06-11', '08:15:00', 25, 27, 1),
	(39, 15, 12, '2020-06-11', '08:30:00', 25, 28, 1),
	(40, 5, 15, '2020-06-11', '08:30:00', 26, 27, 1),
	(41, 11, 15, '2020-06-11', '08:45:00', 26, 28, 1),
	(42, 15, 6, '2020-06-11', '09:00:00', 27, 28, 1),
	(43, 15, 11, '2020-06-11', '08:00:00', 29, 30, 1),
	(44, 15, 11, '2020-06-11', '08:15:00', 29, 31, 1),
	(45, 8, 15, '2020-06-11', '08:30:00', 29, 32, 1),
	(46, 15, 8, '2020-06-11', '08:30:00', 30, 31, 1),
	(47, 15, 5, '2020-06-11', '08:45:00', 30, 32, 1),
	(48, 6, 15, '2020-06-11', '09:00:00', 31, 32, 1),
	(49, 15, 7, '2020-06-11', '10:00:00', 64, 65, 1),
	(50, 15, 10, '2020-06-11', '10:15:00', 64, 66, 1),
	(51, NULL, NULL, '2020-06-11', '10:30:00', 64, 67, 1),
	(52, NULL, NULL, '2020-06-11', '10:30:00', 65, 66, 1),
	(53, NULL, NULL, '2020-06-11', '10:45:00', 65, 67, 1),
	(54, NULL, NULL, '2020-06-11', '11:00:00', 66, 67, 1),
	(55, 10, 15, '2020-06-11', '10:00:00', 68, 69, 1),
	(56, 5, 15, '2020-06-11', '10:15:00', 68, 70, 1),
	(57, NULL, NULL, '2020-06-11', '10:30:00', 68, 71, 1),
	(58, NULL, NULL, '2020-06-11', '10:30:00', 69, 70, 1),
	(59, NULL, NULL, '2020-06-11', '10:45:00', 69, 71, 1),
	(60, NULL, NULL, '2020-06-11', '11:00:00', 70, 71, 1),
	(61, 12, 15, '2020-06-11', '10:00:00', 72, 73, 1),
	(62, 15, 6, '2020-06-11', '10:15:00', 72, 74, 1),
	(63, NULL, NULL, '2020-06-11', '10:30:00', 72, 75, 1),
	(64, NULL, NULL, '2020-06-11', '10:30:00', 73, 74, 1),
	(65, NULL, NULL, '2020-06-11', '10:45:00', 73, 75, 1),
	(66, NULL, NULL, '2020-06-11', '11:00:00', 74, 75, 1),
	(67, 15, 11, '2020-06-11', '10:00:00', 76, 77, 1),
	(68, 15, 7, '2020-06-11', '10:15:00', 76, 78, 1),
	(69, NULL, NULL, '2020-06-11', '10:30:00', 76, 79, 1),
	(70, NULL, NULL, '2020-06-11', '10:30:00', 77, 78, 1),
	(71, NULL, NULL, '2020-06-11', '10:45:00', 77, 79, 1),
	(72, NULL, NULL, '2020-06-11', '11:00:00', 78, 79, 1),
	(73, 15, 5, '2020-06-11', '10:00:00', 80, 81, 1),
	(74, 8, 15, '2020-06-11', '10:15:00', 80, 82, 1),
	(75, NULL, NULL, '2020-06-11', '10:30:00', 80, 83, 1),
	(76, NULL, NULL, '2020-06-11', '10:30:00', 81, 82, 1),
	(77, NULL, NULL, '2020-06-11', '10:45:00', 81, 83, 1),
	(78, NULL, NULL, '2020-06-11', '11:00:00', 82, 83, 1),
	(79, 15, 8, '2020-06-11', '10:00:00', 84, 85, 1),
	(80, 15, 9, '2020-06-11', '10:15:00', 84, 86, 1),
	(81, NULL, NULL, '2020-06-11', '10:30:00', 84, 87, 1),
	(82, NULL, NULL, '2020-06-11', '10:30:00', 85, 86, 1),
	(83, NULL, NULL, '2020-06-11', '10:45:00', 85, 87, 1),
	(84, NULL, NULL, '2020-06-11', '11:00:00', 86, 87, 1),
	(85, 15, 10, '2020-06-11', '10:00:00', 88, 89, 1),
	(86, 15, 11, '2020-06-11', '10:15:00', 88, 90, 1),
	(87, NULL, NULL, '2020-06-11', '10:30:00', 88, 91, 1),
	(88, NULL, NULL, '2020-06-11', '10:30:00', 89, 90, 1),
	(89, NULL, NULL, '2020-06-11', '10:45:00', 89, 91, 1),
	(90, NULL, NULL, '2020-06-11', '11:00:00', 90, 91, 1),
	(91, 15, 6, '2020-06-11', '10:00:00', 92, 93, 1),
	(92, 7, 15, '2020-06-11', '10:15:00', 92, 94, 1),
	(93, NULL, NULL, '2020-06-11', '10:30:00', 92, 95, 1),
	(94, NULL, NULL, '2020-06-11', '10:30:00', 93, 94, 1),
	(95, NULL, NULL, '2020-06-11', '10:45:00', 93, 95, 1),
	(96, NULL, NULL, '2020-06-11', '11:00:00', 94, 95, 1),
	(97, NULL, NULL, '2020-06-11', '13:30:00', 96, 97, 1),
	(98, NULL, NULL, '2020-06-11', '13:45:00', 96, 98, 1),
	(99, NULL, NULL, '2020-06-11', '14:00:00', 96, 99, 1),
	(100, NULL, NULL, '2020-06-11', '14:00:00', 97, 98, 1),
	(101, NULL, NULL, '2020-06-11', '14:15:00', 97, 99, 1),
	(102, NULL, NULL, '2020-06-11', '14:30:00', 98, 99, 1),
	(103, NULL, NULL, '2020-06-11', '13:30:00', 100, 101, 1),
	(104, NULL, NULL, '2020-06-11', '13:45:00', 100, 102, 1),
	(105, NULL, NULL, '2020-06-11', '14:00:00', 100, 103, 1),
	(106, NULL, NULL, '2020-06-11', '14:00:00', 101, 102, 1),
	(107, NULL, NULL, '2020-06-11', '14:15:00', 101, 103, 1),
	(108, NULL, NULL, '2020-06-11', '14:30:00', 102, 103, 1),
	(109, NULL, NULL, '2020-06-11', '13:30:00', 104, 105, 1),
	(110, NULL, NULL, '2020-06-11', '13:45:00', 104, 106, 1),
	(111, NULL, NULL, '2020-06-11', '14:00:00', 104, 107, 1),
	(112, NULL, NULL, '2020-06-11', '14:00:00', 105, 106, 1),
	(113, NULL, NULL, '2020-06-11', '14:15:00', 105, 107, 1),
	(114, NULL, NULL, '2020-06-11', '14:30:00', 106, 107, 1),
	(115, NULL, NULL, '2020-06-11', '13:30:00', 108, 109, 1),
	(116, NULL, NULL, '2020-06-11', '13:45:00', 108, 110, 1),
	(117, NULL, NULL, '2020-06-11', '14:00:00', 108, 111, 1),
	(118, NULL, NULL, '2020-06-11', '14:00:00', 109, 110, 1),
	(119, NULL, NULL, '2020-06-11', '14:15:00', 109, 111, 1),
	(120, NULL, NULL, '2020-06-11', '14:30:00', 110, 111, 1),
	(121, NULL, NULL, '2020-06-11', '15:30:00', 112, 113, 1),
	(122, NULL, NULL, '2020-06-11', '15:30:00', 114, 115, 1),
	(123, NULL, NULL, '2020-06-11', '15:30:00', 116, 117, 1),
	(124, NULL, NULL, '2020-06-11', '15:30:00', 118, 119, 1);
/*!40000 ALTER TABLE `games` ENABLE KEYS */;

-- Listage de la structure de la table joutes. game_types
CREATE TABLE IF NOT EXISTS `game_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `game_type_description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.game_types : ~0 rows (environ)
/*!40000 ALTER TABLE `game_types` DISABLE KEYS */;
INSERT INTO `game_types` (`id`, `game_type_description`) VALUES
	(1, 'Modalités de jeu');
/*!40000 ALTER TABLE `game_types` ENABLE KEYS */;

-- Listage de la structure de la table joutes. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.migrations : ~0 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table joutes. notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `viewed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.notifications : ~0 rows (environ)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Listage de la structure de la table joutes. oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.oauth_access_tokens : ~0 rows (environ)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Listage de la structure de la table joutes. oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.oauth_auth_codes : ~0 rows (environ)
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;

-- Listage de la structure de la table joutes. oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.oauth_clients : ~0 rows (environ)
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Listage de la structure de la table joutes. oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.oauth_personal_access_clients : ~0 rows (environ)
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;

-- Listage de la structure de la table joutes. oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.oauth_refresh_tokens : ~0 rows (environ)
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

-- Listage de la structure de la table joutes. pools
CREATE TABLE IF NOT EXISTS `pools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `poolName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `stage` int(11) NOT NULL,
  `poolSize` int(11) NOT NULL,
  `isFinished` int(11) NOT NULL,
  `tournament_id` int(10) unsigned NOT NULL,
  `mode_id` int(10) unsigned NOT NULL,
  `game_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pools_tournament_id_foreign` (`tournament_id`),
  KEY `pools_mode_id_foreign` (`mode_id`),
  KEY `pools_game_type_id_foreign` (`game_type_id`),
  CONSTRAINT `pools_game_type_id_foreign` FOREIGN KEY (`game_type_id`) REFERENCES `game_types` (`id`),
  CONSTRAINT `pools_mode_id_foreign` FOREIGN KEY (`mode_id`) REFERENCES `pool_modes` (`id`),
  CONSTRAINT `pools_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.pools : ~24 rows (environ)
/*!40000 ALTER TABLE `pools` DISABLE KEYS */;
INSERT INTO `pools` (`id`, `start_time`, `end_time`, `poolName`, `stage`, `poolSize`, `isFinished`, `tournament_id`, `mode_id`, `game_type_id`) VALUES
	(1, '08:00:00', '10:00:00', 'A', 1, 4, 0, 1, 1, 1),
	(2, '08:00:00', '10:00:00', 'B', 1, 4, 0, 1, 1, 1),
	(3, '08:00:00', '10:00:00', 'C', 1, 4, 0, 1, 1, 1),
	(4, '08:00:00', '10:00:00', 'D', 1, 4, 0, 1, 1, 1),
	(5, '08:00:00', '10:00:00', 'E', 1, 4, 0, 1, 1, 1),
	(6, '08:00:00', '10:00:00', 'F', 1, 4, 0, 1, 1, 1),
	(7, '08:00:00', '10:00:00', 'G', 1, 4, 0, 1, 1, 1),
	(8, '08:00:00', '10:00:00', 'H', 1, 4, 0, 1, 1, 1),
	(9, '10:00:00', '12:00:00', 'Win1', 2, 4, 0, 1, 1, 1),
	(10, '10:00:00', '12:00:00', 'Win2', 2, 4, 0, 1, 1, 1),
	(11, '10:00:00', '12:00:00', 'Win3', 2, 4, 0, 1, 1, 1),
	(12, '10:00:00', '12:00:00', 'Win4', 2, 4, 0, 1, 1, 1),
	(13, '10:00:00', '12:00:00', 'Fun1', 2, 4, 0, 1, 1, 1),
	(14, '10:00:00', '12:00:00', 'Fun2', 2, 4, 0, 1, 1, 1),
	(15, '10:00:00', '12:00:00', 'Fun3', 2, 4, 0, 1, 1, 1),
	(16, '10:00:00', '12:00:00', 'Fun4', 2, 4, 0, 1, 1, 1),
	(17, '13:30:00', '15:30:00', 'Best 1', 3, 4, 0, 1, 1, 1),
	(18, '13:30:00', '15:30:00', 'Best 2', 3, 4, 0, 1, 1, 1),
	(19, '13:30:00', '15:30:00', 'Good 1', 3, 4, 0, 1, 1, 1),
	(20, '13:30:00', '15:30:00', 'Good 2', 3, 4, 0, 1, 1, 1),
	(21, '15:30:00', '16:30:00', 'Finale 1-2', 4, 2, 0, 1, 1, 1),
	(22, '15:30:00', '16:30:00', 'Finale 3-4', 4, 2, 0, 1, 1, 1),
	(23, '15:30:00', '16:30:00', 'Finale 5-6', 4, 2, 0, 1, 1, 1),
	(24, '15:30:00', '16:30:00', 'Finale 7-8', 4, 2, 0, 1, 1, 1);
/*!40000 ALTER TABLE `pools` ENABLE KEYS */;

-- Listage de la structure de la table joutes. pool_modes
CREATE TABLE IF NOT EXISTS `pool_modes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mode_description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `planningAlgorithm` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.pool_modes : ~3 rows (environ)
/*!40000 ALTER TABLE `pool_modes` DISABLE KEYS */;
INSERT INTO `pool_modes` (`id`, `mode_description`, `planningAlgorithm`) VALUES
	(1, 'Matches simples', 1),
	(2, 'Aller-retour', 2),
	(3, 'Elimination directe', 3);
/*!40000 ALTER TABLE `pool_modes` ENABLE KEYS */;

-- Listage de la structure de la table joutes. roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(10) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Listage des données de la table joutes.roles : ~3 rows (environ)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `slug`, `name`) VALUES
	(1, 'STUD', 'étudiant'),
	(2, 'GEST', 'gestionnaire'),
	(3, 'ADMIN', 'administrateur');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Listage de la structure de la table joutes. sports
CREATE TABLE IF NOT EXISTS `sports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `min_participant` int(11) NOT NULL DEFAULT 0,
  `max_participant` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.sports : ~1 rows (environ)
/*!40000 ALTER TABLE `sports` DISABLE KEYS */;
INSERT INTO `sports` (`id`, `name`, `description`, `min_participant`, `max_participant`) VALUES
	(1, 'Badminton', 'En double', 0, 0),
	(2, 'Test', 'Test', 1, 12);
/*!40000 ALTER TABLE `sports` ENABLE KEYS */;

-- Listage de la structure de la table joutes. teams
CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_id` int(10) unsigned DEFAULT NULL,
  `validation` int(10) unsigned NOT NULL DEFAULT 0,
  `owner_id` int(11) NOT NULL DEFAULT -1,
  PRIMARY KEY (`id`),
  KEY `teams_tournament_id_foreign` (`tournament_id`),
  CONSTRAINT `teams_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.teams : ~35 rows (environ)
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` (`id`, `name`, `tournament_id`, `validation`, `owner_id`) VALUES
	(1, 'Badboys', 1, 0, -1),
	(2, 'Super Nanas', 1, 0, -1),
	(3, 'CPVN Crew', 1, 0, -1),
	(4, 'Magical Girls', 1, 0, -1),
	(5, 'OliverTwist', 1, 0, -1),
	(6, 'Scarman', 1, 0, -1),
	(7, 'Siomer', 1, 0, -1),
	(8, 'Salsadi', 1, 0, -1),
	(9, 'Monoster', 1, 0, -1),
	(10, 'Picalo', 1, 0, -1),
	(11, 'Dellit', 1, 0, -1),
	(12, 'SuperStar', 1, 0, -1),
	(13, 'Masting', 1, 0, -1),
	(14, 'Clafier', 1, 0, -1),
	(15, 'Robert2Poche', 1, 0, -1),
	(16, 'Alexandri', 1, 0, -1),
	(17, 'FanGirls', 1, 0, -1),
	(18, 'Les Otakus', 1, 0, -1),
	(19, 'Gamers', 1, 0, -1),
	(20, 'Over2000', 1, 0, -1),
	(21, 'Shinigami', 1, 0, -1),
	(22, 'Rocketteurs', 1, 0, -1),
	(23, 'Gilles & 2Sot-Vetage', 1, 0, -1),
	(24, 'Maya Labeille', 1, 0, -1),
	(25, 'Taupes ModL', 1, 0, -1),
	(26, 'Les Pausés', 1, 0, -1),
	(27, 'Absolute Frost', 1, 0, -1),
	(28, 'Dark Side', 1, 0, -1),
	(29, 'Btooom', 1, 0, -1),
	(30, 'Stalgia', 1, 0, -1),
	(31, 'Clattonia', 1, 0, -1),
	(32, 'Danrell', 1, 0, -1),
	(33, 'RunAGround', 1, 0, -1),
	(34, 'Believer', 1, 0, -1),
	(35, 'Warriors', 1, 0, -1);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;

-- Listage de la structure de la table joutes. team_user
CREATE TABLE IF NOT EXISTS `team_user` (
  `user_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `isCaptain` tinyint(1) NOT NULL,
  KEY `team_user_user_id_foreign` (`user_id`),
  KEY `team_user_team_id_foreign` (`team_id`),
  CONSTRAINT `team_user_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  CONSTRAINT `team_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.team_user : ~64 rows (environ)
/*!40000 ALTER TABLE `team_user` DISABLE KEYS */;
INSERT INTO `team_user` (`user_id`, `team_id`, `isCaptain`) VALUES
	(1, 1, 1),
	(2, 1, 0),
	(3, 2, 1),
	(4, 2, 0),
	(5, 3, 1),
	(6, 3, 0),
	(7, 4, 1),
	(8, 4, 0),
	(9, 5, 1),
	(10, 5, 0),
	(11, 6, 1),
	(12, 6, 0),
	(13, 7, 1),
	(14, 7, 0),
	(15, 8, 1),
	(16, 8, 0),
	(17, 9, 1),
	(18, 9, 0),
	(19, 10, 1),
	(20, 10, 0),
	(21, 11, 1),
	(22, 11, 0),
	(23, 12, 1),
	(24, 12, 0),
	(25, 13, 1),
	(26, 13, 0),
	(27, 14, 1),
	(28, 14, 0),
	(29, 15, 1),
	(30, 15, 0),
	(31, 16, 1),
	(32, 16, 0),
	(33, 17, 1),
	(34, 17, 0),
	(35, 18, 1),
	(36, 18, 0),
	(37, 19, 1),
	(38, 19, 0),
	(39, 20, 1),
	(40, 20, 0),
	(41, 21, 1),
	(42, 21, 0),
	(43, 22, 1),
	(44, 22, 0),
	(45, 23, 1),
	(46, 23, 0),
	(47, 24, 1),
	(48, 24, 0),
	(49, 25, 1),
	(50, 25, 0),
	(51, 26, 1),
	(52, 26, 0),
	(53, 27, 1),
	(54, 27, 0),
	(55, 28, 1),
	(56, 28, 0),
	(57, 29, 1),
	(58, 29, 0),
	(59, 30, 1),
	(60, 30, 0),
	(61, 31, 1),
	(62, 31, 0),
	(63, 32, 1),
	(64, 32, 0);
/*!40000 ALTER TABLE `team_user` ENABLE KEYS */;

-- Listage de la structure de la table joutes. tournaments
CREATE TABLE IF NOT EXISTS `tournaments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `img` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_id` int(10) unsigned NOT NULL,
  `sport_id` int(10) unsigned NOT NULL,
  `end_date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `max_teams` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `tournaments_event_id_foreign` (`event_id`),
  KEY `tournaments_sport_id_foreign` (`sport_id`),
  CONSTRAINT `tournaments_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  CONSTRAINT `tournaments_sport_id_foreign` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.tournaments : ~0 rows (environ)
/*!40000 ALTER TABLE `tournaments` DISABLE KEYS */;
INSERT INTO `tournaments` (`id`, `name`, `start_date`, `img`, `event_id`, `sport_id`, `end_date`, `max_teams`) VALUES
	(1, 'Tournoi de Bad', '2020-06-11 00:00:00', NULL, 1, 1, '2000-01-01 00:00:00', 0);
/*!40000 ALTER TABLE `tournaments` ENABLE KEYS */;

-- Listage de la structure de la table joutes. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `email` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_roles1_idx` (`role_id`),
  CONSTRAINT `fk_users_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Listage des données de la table joutes.users : ~73 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `role_id`, `email`, `first_name`, `last_name`) VALUES
	(1, NULL, NULL, 1, NULL, 'Ahmed', 'Casey'),
	(2, NULL, NULL, 1, NULL, 'Chester', 'Day'),
	(3, NULL, NULL, 1, NULL, 'Riley', 'Garrison'),
	(4, NULL, NULL, 1, NULL, 'Duncan', 'Roy'),
	(5, NULL, NULL, 1, NULL, 'Remedios', 'Black'),
	(6, NULL, NULL, 1, NULL, 'Mark', 'Molina'),
	(7, NULL, NULL, 1, NULL, 'Dana', 'Justice'),
	(8, NULL, NULL, 1, NULL, 'Linus', 'Leon'),
	(9, NULL, NULL, 1, NULL, 'Cairo', 'Farmer'),
	(10, NULL, NULL, 1, NULL, 'Nyssa', 'Gallagher'),
	(11, NULL, NULL, 1, NULL, 'Allegra', 'Waller'),
	(12, NULL, NULL, 1, NULL, 'Emery', 'Copeland'),
	(13, NULL, NULL, 1, NULL, 'Illana', 'Mcgowan'),
	(14, NULL, NULL, 1, NULL, 'Magee', 'Bauer'),
	(15, NULL, NULL, 1, NULL, 'Patricia', 'Briggs'),
	(16, NULL, NULL, 1, NULL, 'Samuel', 'Meyers'),
	(17, NULL, NULL, 1, NULL, 'Nelle', 'Holcomb'),
	(18, NULL, NULL, 1, NULL, 'Shay', 'David'),
	(19, NULL, NULL, 1, NULL, 'Kai', 'Quinn'),
	(20, NULL, NULL, 1, NULL, 'Brendan', 'Macdonald'),
	(21, NULL, NULL, 1, NULL, 'Justin', 'Jones'),
	(22, NULL, NULL, 1, NULL, 'Erich', 'Shepherd'),
	(23, NULL, NULL, 1, NULL, 'Joseph', 'Compton'),
	(24, NULL, NULL, 1, NULL, 'Moses', 'Pope'),
	(25, NULL, NULL, 1, NULL, 'Hedley', 'Thornton'),
	(26, NULL, NULL, 1, NULL, 'Deborah', 'Wells'),
	(27, NULL, NULL, 1, NULL, 'Kay', 'Ortega'),
	(28, NULL, NULL, 1, NULL, 'Dorothy', 'Johnston'),
	(29, NULL, NULL, 1, NULL, 'Irene', 'Alston'),
	(30, NULL, NULL, 1, NULL, 'Doris', 'Baird'),
	(31, NULL, NULL, 1, NULL, 'Zorita', 'Ellis'),
	(32, NULL, NULL, 1, NULL, 'Yen', 'Hale'),
	(33, NULL, NULL, 1, NULL, 'Madison', 'Marshall'),
	(34, NULL, NULL, 1, NULL, 'Angela', 'Perry'),
	(35, NULL, NULL, 1, NULL, 'Michael', 'Woodard'),
	(36, NULL, NULL, 1, NULL, 'Karyn', 'Riddle'),
	(37, NULL, NULL, 1, NULL, 'Carol', 'Lang'),
	(38, NULL, NULL, 1, NULL, 'Malik', 'Padilla'),
	(39, NULL, NULL, 1, NULL, 'Maxine', 'Rowland'),
	(40, NULL, NULL, 1, NULL, 'Halee', 'Larson'),
	(41, NULL, NULL, 1, NULL, 'Tatyana', 'Rosario'),
	(42, NULL, NULL, 1, NULL, 'Latifah', 'Jenkins'),
	(43, NULL, NULL, 1, NULL, 'Wynne', 'Rowland'),
	(44, NULL, NULL, 1, NULL, 'Nola', 'Adkins'),
	(45, NULL, NULL, 1, NULL, 'Nicole', 'Wilkerson'),
	(46, NULL, NULL, 1, NULL, 'Sybil', 'Murray'),
	(47, NULL, NULL, 1, NULL, 'Cadman', 'Evans'),
	(48, NULL, NULL, 1, NULL, 'Xenos', 'Kramer'),
	(49, NULL, NULL, 1, NULL, 'Illana', 'Riley'),
	(50, NULL, NULL, 1, NULL, 'Evan', 'Logan'),
	(51, NULL, NULL, 1, NULL, 'Risa', 'Fuller'),
	(52, NULL, NULL, 1, NULL, 'Jenette', 'Alvarado'),
	(53, NULL, NULL, 1, NULL, 'Colorado', 'Moss'),
	(54, NULL, NULL, 1, NULL, 'Bree', 'Velazquez'),
	(55, NULL, NULL, 1, NULL, 'Madonna', 'Preston'),
	(56, NULL, NULL, 1, NULL, 'Daria', 'Pearson'),
	(57, NULL, NULL, 1, NULL, 'Uta', 'Hensley'),
	(58, NULL, NULL, 1, NULL, 'Paul', 'Lambert'),
	(59, NULL, NULL, 1, NULL, 'Declan', 'Ramirez'),
	(60, NULL, NULL, 1, NULL, 'Davis', 'Mcleod'),
	(61, NULL, NULL, 1, NULL, 'Wanda', 'Sears'),
	(62, NULL, NULL, 1, NULL, 'Melvin', 'Bowen'),
	(63, NULL, NULL, 1, NULL, 'Lareina', 'Forbes'),
	(64, NULL, NULL, 1, NULL, 'Dane', 'Holland'),
	(65, NULL, NULL, 1, NULL, 'Norman', 'Mcleod'),
	(66, NULL, NULL, 1, NULL, 'Blythe', 'Cruz'),
	(67, NULL, NULL, 1, NULL, 'Jayme', 'Gill'),
	(68, NULL, NULL, 1, NULL, 'Adele', 'Warren'),
	(69, NULL, NULL, 1, NULL, 'Candace', 'Valenzuela'),
	(70, NULL, NULL, 1, NULL, 'Judith', 'Blake'),
	(71, 'yvann', '$2y$10$N3.inGmrPoTZ.HMps9Lk7u8/xS5Mh7qf1v/DxdBw5us78jLBYBh8.', 3, NULL, 'Yvann', 'Butticaz'),
	(72, 'prof', NULL, 2, NULL, 'prof', 'prof'),
	(73, 'admin', '', 3, NULL, 'Admin', 'Administrateur');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
