-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: web20.swisscenter.com    Database: joutes_joutes
-- ------------------------------------------------------
-- Server version	5.6.40-84.0-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contenders`
--

DROP TABLE IF EXISTS `contenders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contenders` (
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
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contenders`
--

LOCK TABLES `contenders` WRITE;
/*!40000 ALTER TABLE `contenders` DISABLE KEYS */;
INSERT INTO `contenders` VALUES (52,NULL,10,141,NULL),(53,NULL,10,151,NULL),(54,NULL,10,153,NULL),(55,NULL,10,156,NULL),(56,NULL,10,157,NULL),(57,NULL,10,158,NULL),(58,NULL,11,160,NULL),(59,NULL,11,162,NULL),(60,NULL,11,163,NULL),(61,NULL,11,167,NULL),(62,NULL,11,173,NULL),(63,NULL,11,179,NULL),(64,1,12,153,10),(65,2,12,151,10),(66,3,12,141,10),(67,1,12,160,11),(68,2,12,167,11),(69,3,12,162,11),(70,4,13,157,10),(71,5,13,156,10),(72,6,13,158,10),(73,4,13,173,11),(74,5,13,163,11),(75,6,13,179,11),(76,NULL,14,142,NULL),(77,NULL,14,147,NULL),(78,NULL,14,164,NULL),(79,NULL,14,168,NULL),(80,NULL,14,176,NULL),(81,NULL,14,185,NULL),(82,NULL,14,187,NULL),(83,NULL,14,189,NULL),(84,NULL,15,132,NULL),(85,NULL,15,148,NULL),(86,NULL,15,152,NULL),(87,NULL,15,172,NULL),(88,NULL,15,182,NULL),(89,NULL,15,198,NULL),(90,NULL,15,202,NULL),(104,NULL,17,166,NULL),(105,NULL,17,174,NULL),(106,NULL,17,181,NULL),(107,NULL,17,184,NULL),(108,NULL,17,186,NULL),(109,NULL,17,191,NULL),(110,NULL,17,192,NULL),(111,NULL,17,196,NULL),(112,NULL,17,199,NULL),(113,NULL,17,203,NULL),(114,NULL,17,204,NULL),(115,NULL,17,206,NULL),(116,NULL,17,207,NULL);
/*!40000 ALTER TABLE `contenders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courts`
--

DROP TABLE IF EXISTS `courts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sport_id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `acronym` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courts_sport_id_foreign` (`sport_id`),
  CONSTRAINT `courts_sport_id_foreign` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courts`
--

LOCK TABLES `courts` WRITE;
/*!40000 ALTER TABLE `courts` DISABLE KEYS */;
INSERT INTO `courts` VALUES (1,2,'Tyrol','TYR'),(2,2,'Ancien-Stand','STA'),(3,3,'Amont','AMO'),(4,3,'Aval','AVA'),(5,5,'Tyrol','TYR'),(6,5,'Ancien-Stand','STA'),(7,6,'Tyrol','TYR'),(8,6,'Ancien-Stand','STA'),(9,7,'CollegeGare','GAR'),(10,9,'Nature','NAT'),(11,1,'Court 1','CO1'),(12,1,'Court 2','CO2'),(13,1,'Court 3','CO3'),(14,1,'Court 4','CO4'),(15,1,'Court 5','CO5'),(16,1,'Court 6','CO6');
/*!40000 ALTER TABLE `courts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Joutes 2018','default.jpg');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_types`
--

DROP TABLE IF EXISTS `game_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `game_type_description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_types`
--

LOCK TABLES `game_types` WRITE;
/*!40000 ALTER TABLE `game_types` DISABLE KEYS */;
INSERT INTO `game_types` VALUES (1,'Modalités de jeu'),(2,'Modalités de jeu'),(3,'Modalités de jeu');
/*!40000 ALTER TABLE `game_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
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
) ENGINE=InnoDB AUTO_INCREMENT=387 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (128,9,15,'2017-06-27','09:30:00',52,53,3),(129,13,7,'2017-06-27','09:40:00',54,55,3),(130,27,8,'2017-06-27','09:50:00',55,57,3),(131,16,17,'2017-06-27','10:00:00',52,54,3),(132,13,15,'2017-06-27','10:10:00',55,56,3),(133,21,10,'2017-06-27','10:20:00',53,57,3),(134,18,12,'2017-06-27','10:30:00',52,55,3),(135,18,14,'2017-06-27','10:40:00',53,56,3),(136,28,4,'2017-06-27','10:50:00',54,57,3),(137,14,18,'2017-06-27','11:00:00',52,56,3),(138,21,13,'2017-06-27','11:10:00',53,54,3),(139,22,6,'2017-06-27','11:20:00',54,57,3),(140,30,12,'2017-06-27','11:30:00',52,57,3),(141,20,9,'2017-06-27','11:40:00',53,55,3),(142,19,16,'2017-06-27','11:50:00',54,56,3),(143,11,12,'2017-06-27','09:30:00',58,59,4),(144,9,10,'2017-06-27','09:40:00',60,61,4),(145,23,13,'2017-06-27','09:50:00',61,63,4),(146,16,11,'2017-06-27','10:00:00',58,60,4),(147,16,10,'2017-06-27','10:10:00',61,62,4),(148,24,10,'2017-06-27','10:20:00',59,63,4),(149,20,10,'2017-06-27','10:30:00',58,61,4),(150,12,15,'2017-06-27','10:40:00',59,62,4),(151,14,9,'2017-06-27','10:50:00',60,63,4),(152,22,13,'2017-06-27','11:00:00',58,62,4),(153,29,10,'2017-06-27','11:10:00',59,60,4),(154,12,9,'2017-06-27','11:20:00',62,63,4),(155,19,4,'2017-06-27','11:30:00',58,63,4),(156,13,14,'2017-06-27','11:40:00',59,61,4),(157,13,20,'2017-06-27','11:50:00',60,62,4),(158,9,12,'2017-06-27','13:00:00',64,65,3),(159,18,17,'2017-06-27','13:10:00',66,67,3),(160,26,10,'2017-06-27','13:20:00',67,69,3),(161,18,16,'2017-06-27','13:30:00',64,66,3),(162,20,12,'2017-06-27','13:40:00',67,68,3),(163,18,15,'2017-06-27','13:50:00',65,69,3),(164,21,9,'2017-06-27','14:00:00',64,67,3),(165,18,13,'2017-06-27','14:10:00',65,68,3),(166,15,21,'2017-06-27','14:20:00',66,69,3),(167,15,12,'2017-06-27','14:30:00',64,68,3),(168,13,14,'2017-06-27','14:40:00',65,66,3),(169,17,13,'2017-06-27','14:50:00',68,69,3),(170,17,12,'2017-06-27','15:00:00',64,69,3),(171,15,13,'2017-06-27','15:10:00',65,67,3),(172,13,11,'2017-06-27','15:20:00',66,68,3),(173,8,5,'2017-06-27','13:00:00',70,71,4),(174,18,7,'2017-06-27','13:10:00',72,73,4),(175,11,12,'2017-06-27','13:20:00',73,75,4),(176,15,13,'2017-06-27','13:30:00',70,72,4),(177,17,12,'2017-06-27','13:40:00',73,74,4),(178,8,16,'2017-06-27','13:50:00',71,75,4),(179,17,13,'2017-06-27','14:00:00',70,73,4),(180,12,15,'2017-06-27','14:10:00',71,74,4),(181,14,12,'2017-06-27','14:20:00',72,75,4),(182,15,12,'2017-06-27','14:30:00',70,74,4),(183,14,11,'2017-06-27','14:40:00',71,72,4),(184,15,9,'2017-06-27','14:50:00',74,75,4),(185,12,13,'2017-06-27','15:00:00',70,75,4),(186,11,18,'2017-06-27','15:10:00',71,73,4),(187,16,14,'2017-06-27','15:20:00',72,74,4),(188,NULL,NULL,'2017-06-27','09:30:00',82,81,1),(189,NULL,NULL,'2017-06-27','09:47:00',76,80,1),(190,NULL,NULL,'2017-06-27','10:04:00',77,79,1),(191,NULL,NULL,'2017-06-27','10:21:00',78,83,1),(192,NULL,NULL,'2017-06-27','10:38:00',81,80,1),(193,NULL,NULL,'2017-06-27','10:55:00',82,79,1),(194,NULL,NULL,'2017-06-27','11:12:00',76,78,1),(195,NULL,NULL,'2017-06-27','11:29:00',77,83,1),(196,NULL,NULL,'2017-06-27','11:46:00',80,79,1),(197,NULL,NULL,'2017-06-27','12:03:00',81,78,1),(198,NULL,NULL,'2017-06-27','12:20:00',82,77,1),(199,NULL,NULL,'2017-06-27','12:37:00',76,83,1),(200,NULL,NULL,'2017-06-27','12:54:00',79,78,1),(201,NULL,NULL,'2017-06-27','13:11:00',80,77,2),(202,NULL,NULL,'2017-06-27','13:28:00',81,76,2),(203,NULL,NULL,'2017-06-27','13:45:00',82,83,2),(204,NULL,NULL,'2017-06-27','14:02:00',78,77,2),(205,NULL,NULL,'2017-06-27','14:19:00',79,76,2),(206,NULL,NULL,'2017-06-27','14:36:00',80,82,2),(207,NULL,NULL,'2017-06-27','14:53:00',81,83,2),(208,NULL,NULL,'2017-06-27','15:10:00',77,76,2),(209,NULL,NULL,'2017-06-27','15:27:00',78,82,2),(210,NULL,NULL,'2017-06-27','15:44:00',79,81,2),(211,NULL,NULL,'2017-06-27','16:01:00',80,83,2),(212,NULL,NULL,'2017-06-27','16:18:00',76,82,2),(213,NULL,NULL,'2017-06-27','16:35:00',77,81,2),(214,NULL,NULL,'2017-06-27','16:52:00',78,80,2),(215,NULL,NULL,'2017-06-27','17:09:00',79,83,2),(216,3,5,'2017-06-27','08:10:00',90,89,7),(217,2,3,'2017-06-27','08:10:00',84,88,8),(218,1,6,'2017-06-27','08:30:00',85,87,7),(219,5,2,'2017-06-27','08:30:00',89,88,8),(220,2,10,'2017-06-27','08:50:00',90,87,7),(221,6,6,'2017-06-27','08:50:00',84,86,8),(222,9,2,'2017-06-27','09:10:00',88,87,7),(223,9,5,'2017-06-27','09:10:00',89,86,8),(224,6,2,'2017-06-27','09:30:00',90,85,7),(225,3,3,'2017-06-27','09:30:00',87,86,8),(226,6,1,'2017-06-27','09:50:00',88,85,7),(227,2,7,'2017-06-27','09:50:00',89,84,8),(228,5,5,'2017-06-27','10:10:00',86,85,7),(229,3,7,'2017-06-27','10:10:00',87,84,8),(230,6,6,'2017-06-27','10:30:00',88,90,7),(231,0,12,'2017-06-27','10:30:00',85,84,8),(232,3,5,'2017-06-27','10:50:00',86,90,7),(233,1,10,'2017-06-27','10:50:00',87,89,8),(234,7,4,'2017-06-27','11:10:00',84,90,7),(235,3,15,'2017-06-27','11:10:00',85,89,8),(236,4,5,'2017-06-27','11:30:00',86,88,7),(237,NULL,NULL,'2017-06-27','09:30:00',92,103,11),(238,NULL,NULL,'2017-06-27','09:30:00',93,102,11),(239,NULL,NULL,'2017-06-27','09:30:00',94,101,11),(240,NULL,NULL,'2017-06-27','09:30:00',95,100,11),(241,NULL,NULL,'2017-06-27','09:30:00',96,99,11),(242,NULL,NULL,'2017-06-27','09:30:00',97,98,11),(243,NULL,NULL,'2017-06-27','10:00:00',93,103,11),(244,NULL,NULL,'2017-06-27','10:00:00',94,91,11),(245,NULL,NULL,'2017-06-27','10:00:00',95,102,11),(246,NULL,NULL,'2017-06-27','10:00:00',96,101,11),(247,NULL,NULL,'2017-06-27','10:00:00',97,100,11),(248,NULL,NULL,'2017-06-27','10:00:00',98,99,11),(249,NULL,NULL,'2017-06-27','10:30:00',94,103,11),(250,NULL,NULL,'2017-06-27','10:30:00',95,92,11),(251,NULL,NULL,'2017-06-27','10:30:00',96,91,11),(252,NULL,NULL,'2017-06-27','10:30:00',97,102,11),(253,NULL,NULL,'2017-06-27','10:30:00',98,101,11),(254,NULL,NULL,'2017-06-27','10:30:00',99,100,11),(255,NULL,NULL,'2017-06-27','11:00:00',95,103,11),(256,NULL,NULL,'2017-06-27','11:00:00',96,93,11),(257,NULL,NULL,'2017-06-27','11:00:00',97,92,11),(258,NULL,NULL,'2017-06-27','11:00:00',98,91,11),(259,NULL,NULL,'2017-06-27','11:00:00',99,102,11),(260,NULL,NULL,'2017-06-27','11:00:00',100,101,11),(261,NULL,NULL,'2017-06-27','11:30:00',96,103,11),(262,NULL,NULL,'2017-06-27','11:30:00',97,94,11),(263,NULL,NULL,'2017-06-27','11:30:00',98,93,11),(264,NULL,NULL,'2017-06-27','11:30:00',99,92,11),(265,NULL,NULL,'2017-06-27','11:30:00',100,91,11),(266,NULL,NULL,'2017-06-27','11:30:00',101,102,11),(267,NULL,NULL,'2017-06-27','13:00:00',97,103,11),(268,NULL,NULL,'2017-06-27','13:00:00',98,95,11),(269,NULL,NULL,'2017-06-27','13:00:00',99,94,11),(270,NULL,NULL,'2017-06-27','13:00:00',100,93,11),(271,NULL,NULL,'2017-06-27','13:00:00',101,92,11),(272,NULL,NULL,'2017-06-27','13:00:00',102,91,11),(273,NULL,NULL,'2017-06-27','13:30:00',98,103,11),(274,NULL,NULL,'2017-06-27','13:30:00',99,96,11),(275,NULL,NULL,'2017-06-27','13:30:00',100,95,11),(276,NULL,NULL,'2017-06-27','13:30:00',101,94,11),(277,NULL,NULL,'2017-06-27','13:30:00',102,93,11),(278,NULL,NULL,'2017-06-27','13:30:00',91,92,11),(279,NULL,NULL,'2017-06-27','14:00:00',99,103,11),(280,NULL,NULL,'2017-06-27','14:00:00',100,97,11),(281,NULL,NULL,'2017-06-27','14:00:00',101,96,11),(282,NULL,NULL,'2017-06-27','14:00:00',102,95,11),(283,NULL,NULL,'2017-06-27','14:00:00',91,94,11),(284,NULL,NULL,'2017-06-27','14:00:00',92,93,11),(285,NULL,NULL,'2017-06-27','14:30:00',100,103,11),(286,NULL,NULL,'2017-06-27','14:30:00',101,98,11),(287,NULL,NULL,'2017-06-27','14:30:00',102,97,11),(288,NULL,NULL,'2017-06-27','14:30:00',91,96,11),(289,NULL,NULL,'2017-06-27','14:30:00',92,95,11),(290,NULL,NULL,'2017-06-27','14:30:00',93,94,11),(291,NULL,NULL,'2017-06-27','15:00:00',101,103,11),(292,NULL,NULL,'2017-06-27','15:00:00',102,99,11),(293,NULL,NULL,'2017-06-27','15:00:00',91,98,11),(294,NULL,NULL,'2017-06-27','15:00:00',92,97,11),(295,NULL,NULL,'2017-06-27','15:00:00',93,96,11),(296,NULL,NULL,'2017-06-27','15:00:00',94,95,11),(297,NULL,NULL,'2017-06-27','15:30:00',102,103,11),(298,NULL,NULL,'2017-06-27','15:30:00',91,100,11),(299,NULL,NULL,'2017-06-27','15:30:00',92,99,11),(300,NULL,NULL,'2017-06-27','15:30:00',93,98,11),(301,NULL,NULL,'2017-06-27','15:30:00',94,97,11),(302,NULL,NULL,'2017-06-27','15:30:00',95,96,11),(303,NULL,NULL,'2017-06-27','16:00:00',91,103,11),(304,NULL,NULL,'2017-06-27','16:00:00',92,101,11),(305,NULL,NULL,'2017-06-27','16:00:00',93,100,11),(306,NULL,NULL,'2017-06-27','16:00:00',94,99,11),(307,NULL,NULL,'2017-06-27','16:00:00',95,98,11),(308,NULL,NULL,'2017-06-27','16:00:00',96,97,11),(309,21,0,'2018-07-03','13:30:00',105,116,11),(310,21,0,'2018-07-03','13:30:00',106,115,12),(311,19,21,'2018-07-03','13:30:00',107,114,13),(312,21,0,'2018-07-03','13:30:00',108,113,14),(313,19,21,'2018-07-03','13:30:00',109,112,15),(314,21,19,'2018-07-03','13:30:00',110,111,16),(315,21,17,'2018-07-03','13:45:00',106,104,16),(316,21,0,'2018-07-03','13:45:00',107,116,15),(317,0,21,'2018-07-03','13:45:00',108,115,14),(318,21,18,'2018-07-03','13:45:00',109,114,13),(319,21,19,'2018-07-03','13:45:00',110,113,12),(320,0,21,'2018-07-03','13:45:00',111,112,11),(321,6,21,'2018-07-03','14:00:00',107,105,16),(322,21,10,'2018-07-03','14:00:00',108,104,15),(323,21,0,'2018-07-03','14:00:00',109,116,14),(324,21,0,'2018-07-03','14:00:00',110,115,13),(325,21,17,'2018-07-03','14:00:00',111,114,12),(326,21,8,'2018-07-03','14:00:00',112,113,11),(327,0,21,'2018-07-03','14:15:00',108,106,11),(328,18,21,'2018-07-03','14:15:00',109,105,15),(329,17,21,'2018-07-03','14:15:00',110,104,14),(330,21,0,'2018-07-03','14:15:00',111,116,13),(331,21,0,'2018-07-03','14:15:00',112,115,12),(332,13,21,'2018-07-03','14:15:00',113,114,11),(333,21,6,'2018-07-03','14:30:00',109,107,11),(334,21,16,'2018-07-03','14:30:00',110,106,11),(335,10,21,'2018-07-03','14:30:00',111,105,11),(336,21,2,'2018-07-03','14:30:00',112,104,11),(337,21,0,'2018-07-03','14:30:00',113,116,11),(338,21,12,'2018-07-03','14:30:00',114,115,11),(339,21,20,'2018-07-03','14:45:00',110,108,11),(340,21,6,'2018-07-03','14:45:00',111,107,11),(341,21,5,'2018-07-03','14:45:00',112,106,11),(342,11,21,'2018-07-03','14:45:00',113,105,11),(343,21,4,'2018-07-03','14:45:00',114,104,11),(344,21,0,'2018-07-03','14:45:00',115,116,11),(345,17,21,'2018-07-03','15:00:00',111,109,11),(346,21,5,'2018-07-03','15:00:00',112,108,11),(347,12,21,'2018-07-03','15:00:00',113,107,11),(348,21,12,'2018-07-03','15:00:00',114,106,11),(349,0,21,'2018-07-03','15:00:00',115,105,11),(350,0,21,'2018-07-03','15:00:00',116,104,11),(351,21,8,'2018-07-03','15:15:00',112,110,11),(352,11,21,'2018-07-03','15:15:00',113,109,11),(353,21,17,'2018-07-03','15:15:00',114,108,11),(354,0,21,'2018-07-03','15:15:00',115,107,11),(355,0,21,'2018-07-03','15:15:00',116,106,11),(356,8,21,'2018-07-03','15:15:00',104,105,11),(357,21,8,'2018-07-03','15:30:00',113,111,11),(358,21,17,'2018-07-03','15:30:00',114,110,11),(359,0,21,'2018-07-03','15:30:00',115,109,11),(360,0,21,'2018-07-03','15:30:00',116,108,11),(361,20,21,'2018-07-03','15:30:00',104,107,11),(362,21,7,'2018-07-03','15:30:00',105,106,11),(363,11,21,'2018-07-03','15:45:00',114,112,11),(364,0,21,'2018-07-03','15:45:00',115,111,11),(365,0,21,'2018-07-03','15:45:00',116,110,11),(366,11,21,'2018-07-03','15:45:00',104,109,11),(367,21,0,'2018-07-03','15:45:00',105,108,11),(368,21,18,'2018-07-03','15:45:00',106,107,11),(369,0,21,'2018-07-03','16:00:00',115,113,11),(370,0,21,'2018-07-03','16:00:00',116,112,11),(371,6,21,'2018-07-03','16:00:00',104,111,11),(372,21,13,'2018-07-03','16:00:00',105,110,11),(373,6,21,'2018-07-03','16:00:00',106,109,11),(374,21,19,'2018-07-03','16:00:00',107,108,11),(375,0,21,'2018-07-03','16:15:00',116,114,11),(376,21,7,'2018-07-03','16:15:00',104,113,11),(377,21,18,'2018-07-03','16:15:00',105,112,11),(378,11,21,'2018-07-03','16:15:00',106,111,11),(379,21,12,'2018-07-03','16:15:00',107,110,11),(380,0,21,'2018-07-03','16:15:00',108,109,11),(381,21,0,'2018-07-03','16:30:00',104,115,11),(382,21,13,'2018-07-03','16:30:00',105,114,11),(383,21,8,'2018-07-03','16:30:00',106,113,11),(384,10,21,'2018-07-03','16:30:00',107,112,11),(385,15,21,'2018-07-03','16:30:00',108,111,11),(386,21,11,'2018-07-03','16:30:00',109,110,11);
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2017_02_15_135303_create_participants_table',1),(2,'2017_02_15_135307_create_users_table',1),(3,'2017_02_15_135312_create_events_table',1),(4,'2017_02_15_135317_create_sports_table',1),(5,'2017_02_15_135518_create_courts_table',1),(6,'2017_02_15_135609_create_tournaments_table',1),(7,'2017_02_15_135923_create_teams_table',1),(8,'2017_02_15_140600_create_poolModes_table',1),(9,'2017_02_15_140605_create_gameTypes_table',1),(10,'2017_02_15_140645_create_pools_table',1),(11,'2017_02_15_141117_create_pools_teams_table',1),(12,'2017_02_15_141520_create_participants_teams_table',1),(13,'2017_02_15_141750_create_games_table',1),(14,'2017_05_02_134217_add_acronym_to_courts',1),(15,'2018_03_21_134108_add_email_to_users_table',1),(16,'2018_06_11_162539_add_user_to_participants_table',1),(17,'2018_06_11_163120_add_validation_to_teams_table',1),(18,'2018_06_11_163134_add_owner_to_teams_table',1),(19,'2018_06_13_090350_add_range_to_sports',2),(20,'2018_06_13_090650_add_endData_to_tournaments',2),(21,'2018_06_13_105332_add_maxTeam_to_tournaments',2),(22,'2017_02_15_140600_create_pool_modes_table',3),(23,'2017_02_15_140605_create_game_types_table',3),(24,'2018_03_02_125945_create_notif_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `participant_id` int(10) unsigned NOT NULL,
  `viewed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_participant_id_foreign` (`participant_id`),
  CONSTRAINT `notifications_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participant_team`
--

DROP TABLE IF EXISTS `participant_team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participant_team` (
  `participant_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `isCaptain` tinyint(1) NOT NULL,
  KEY `participant_team_participant_id_foreign` (`participant_id`),
  KEY `participant_team_team_id_foreign` (`team_id`),
  CONSTRAINT `participant_team_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`),
  CONSTRAINT `participant_team_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participant_team`
--

LOCK TABLES `participant_team` WRITE;
/*!40000 ALTER TABLE `participant_team` DISABLE KEYS */;
INSERT INTO `participant_team` VALUES (8339,126,1),(8345,127,1),(8346,2,0),(8348,128,1),(8346,3,0),(8350,129,1),(8357,127,0),(8352,131,1),(8356,130,1),(8340,133,1),(8364,135,1),(8353,138,1),(8367,135,0),(8365,1,0),(8372,139,1),(8361,141,1),(8349,142,1),(8382,140,1),(8363,143,1),(8349,144,1),(8351,145,1),(8379,146,1),(8377,147,1),(8362,142,0),(8362,144,0),(8378,146,0),(8395,142,0),(8395,144,0),(8388,148,1),(8381,149,1),(8341,150,1),(8383,151,1),(8394,148,0),(8392,145,0),(8399,142,0),(8380,148,0),(8399,144,0),(8377,3,0),(8393,148,0),(8400,151,0),(8404,152,1),(8407,153,1),(8412,147,0),(8415,153,0),(8416,152,0),(8398,156,1),(8418,153,0),(8422,147,0),(8417,153,0),(8424,152,0),(8423,157,1),(8419,152,0),(8344,158,1),(8425,152,0),(8343,158,0),(8427,152,0),(8428,156,0),(8429,152,0),(8431,157,0),(8430,157,0),(8426,1,0),(8432,156,0),(8420,1,0),(8434,1,0),(8433,160,1),(8390,1,0),(8440,160,0),(8441,1,0),(8405,143,0),(8438,1,0),(8446,160,0),(8448,160,0),(8443,162,1),(8370,163,1),(8397,162,0),(8391,162,0),(8452,162,0),(8453,156,0),(8449,164,1),(8409,164,0),(8435,138,0),(8444,164,0),(8455,163,0),(8447,164,0),(8449,165,1),(8439,166,1),(8444,165,0),(8442,166,0),(8447,165,0),(8457,2,0),(8409,165,0),(8419,165,0),(8454,167,1),(8459,168,1),(8404,169,1),(8450,168,0),(8445,168,0),(8427,169,0),(8429,169,0),(8458,167,0),(8403,168,0),(8374,172,1),(8451,173,1),(8463,173,0),(8342,142,0),(8342,144,0),(8402,142,0),(8402,144,0),(8369,133,0),(8465,174,1),(8436,152,0),(8474,167,0),(8436,169,0),(8462,172,0),(8476,167,0),(8475,149,0),(8479,176,1),(8480,176,0),(8479,177,1),(8480,177,0),(8484,176,0),(8484,177,0),(8483,176,0),(8481,176,0),(8483,177,0),(8481,177,0),(8485,176,0),(8485,177,0),(8412,3,0),(8486,162,0),(8488,176,0),(8488,177,0),(8489,172,0),(8490,152,0),(8386,141,0),(8472,132,1),(8477,1,0),(8490,169,0),(8492,1,0),(8478,1,0),(8456,152,0),(8456,169,0),(8493,147,0),(8495,147,0),(8496,147,0),(8497,139,0),(8375,148,0),(8466,172,0),(8467,1,0),(8501,131,0),(8421,163,0),(8473,164,0),(8473,165,0),(8468,126,0),(8374,178,1),(8504,179,1),(8509,162,0),(8510,179,0),(8388,178,0),(8380,178,0),(8506,1,0),(8508,1,0),(8505,1,0),(8489,178,0),(8502,173,0),(8394,178,0),(8466,178,0),(8491,132,0),(8355,132,0),(8375,178,0),(8360,132,0),(8472,180,1),(8512,132,0),(8512,180,0),(8406,142,0),(8406,144,0),(8500,150,0),(8368,181,1),(8515,181,0),(8368,182,1),(8516,181,0),(8516,182,0),(8515,182,0),(8511,1,0),(8373,184,1),(8373,185,1),(8347,184,0),(8347,185,0),(8371,140,0),(8461,132,0),(8518,157,0),(8517,2,0),(8517,3,0),(8393,178,0),(8519,174,0),(8519,2,0),(8513,172,0),(8513,178,0),(8445,186,1),(8450,186,0),(8514,179,0),(8522,1,0),(8461,180,0),(8523,187,1),(8523,188,1),(8524,187,0),(8524,188,0),(8525,187,0),(8525,188,0),(8384,1,0),(8527,1,0),(8528,185,0),(8528,3,0),(8469,2,0),(8530,1,0),(8358,189,1),(8358,190,1),(8355,191,1),(8532,168,0),(8533,189,0),(8533,190,0),(8535,192,1),(8536,189,0),(8536,190,0),(8487,1,0),(8534,189,0),(8534,190,0),(8538,189,0),(8538,190,0),(8539,189,0),(8520,189,0),(8539,190,0),(8520,190,0),(8541,189,0),(8541,190,0),(8540,189,0),(8540,190,0),(8531,185,0),(8491,191,0),(8543,128,0),(8546,151,0),(8547,2,0),(8547,3,0),(8548,1,0),(8550,1,0),(8551,195,1),(8551,196,1),(8413,141,0),(8414,129,0),(8471,197,1),(8471,198,1),(8470,197,0),(8470,198,0),(8553,198,0),(8553,197,0),(8408,187,0),(8408,188,0),(8462,199,1),(8554,199,0),(8554,172,0),(8498,2,0),(8498,3,0),(8557,2,0),(8557,3,0),(8556,198,0),(8556,197,0),(8561,197,0),(8561,198,0),(8545,198,0),(8545,197,0),(8565,1,0),(8360,191,0),(8568,202,1),(8568,203,1),(8569,202,0),(8569,203,0),(8570,202,0),(8535,2,0),(8571,1,0),(8572,1,0),(8558,1,0),(8573,204,1),(8566,1,0),(8575,204,0),(8573,2,0),(8575,2,0),(8563,204,0),(8563,2,0),(8574,1,0),(8442,168,0),(8439,168,0),(8387,1,0),(8366,173,0),(8482,173,0),(8562,187,0),(8562,188,0),(8578,189,0),(8578,190,0),(8526,185,0),(8579,192,0),(8457,3,0),(8389,158,0),(8537,182,0),(8376,2,0),(8376,3,0),(8521,130,0),(8580,202,0),(8580,206,1),(8570,206,0),(8531,207,1),(8401,163,0),(8460,185,0),(8460,207,0),(8581,189,0),(8581,190,0),(8526,196,0),(8424,169,0),(8385,208,1),(8385,209,1),(8337,208,0),(8338,209,0),(8552,209,0),(8396,209,0),(8354,209,0),(8582,210,1),(8582,211,1),(8555,212,1),(8555,148,0);
/*!40000 ALTER TABLE `participant_team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8588 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participants`
--

LOCK TABLES `participants` WRITE;
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
INSERT INTO `participants` VALUES (8336,'Pascal','HURNI',72),(8337,'Davide','CARBONI',73),(8338,'Julien','RICHOZ',74),(8339,'Nathanael','HERMINJARD',75),(8340,'Megane','DEFFERRARD',76),(8341,'Gabriel','DE-BIASE',77),(8342,'Jolan','BARTOLI',78),(8343,'Eva','BULA',79),(8344,'Jeanne','GEBHARDT',80),(8345,'Aurelien','ROBERT',81),(8346,'Jannice','DUPERRIER',82),(8347,'Shannon','RAVESSOUD',83),(8348,'Federico','DEL-GRECO',84),(8349,'Yllies','CUDRE-MAUROUX',85),(8350,'Benjamin','MISCHLER',86),(8351,'Nicolas','BOCHUD',87),(8352,'Loic','GAVIN',88),(8353,'Cyril','GOLDENSCHUE',89),(8354,'Samuel','DELGADO',90),(8355,'Maxime','MOESLE',91),(8356,'Axel','GANS',92),(8357,'Noemie','ROCHAT',93),(8358,'Steven','SAUSSAZ',94),(8359,'Honore','GASSER',95),(8360,'Thierry','KOULBANIS',96),(8361,'Jenithan','SELVARAJAH',97),(8362,'Jaison','RAMOS-ALVES',98),(8363,'Fabien','MASSON',99),(8364,'Camille','FONJALLAZ',100),(8365,'Audrey','MAENDLY',101),(8366,'Keanu','TROSSET',102),(8367,'Benjamin','PORCHET',103),(8368,'Loris','STAUBLI',104),(8369,'Julien','INCOURT',105),(8370,'Guilherme','DE-OLIVEIRA-CALHAU',106),(8371,'Luca','FERRO',107),(8372,'Kylian','MANZINI',108),(8373,'Abel-Natan','GOMEZ',109),(8374,'Rayan','RAMADANI',110),(8375,'Nais','GALLIKER',111),(8376,'Gwennaelle','LAUBER',112),(8377,'Elodie','ANGLADE',113),(8378,'Orges','GUSTURANAJ',114),(8379,'Teo','KOHLER',115),(8380,'Loic','KOSTINGER',116),(8381,'Julien','MARTINELLA',117),(8382,'Dylan','JUTZELER',118),(8383,'Jonathan','FAVRE',119),(8384,'Kevin','AGUILAR',120),(8385,'Kevin','JORDIL',121),(8386,'Arnaud','SCHENEVEY',122),(8387,'Noah','MARBACH',123),(8388,'Adilia','LEITAO-SEPULVEDA',124),(8389,'Nathan','STADER',125),(8390,'Theo','GAUTIER',126),(8391,'Alessandro','ROSSI',127),(8392,'Simon','HUMAIR',128),(8393,'Lorye','GOLAY',129),(8394,'Mathieu','PARRIAUX',130),(8395,'Ryan','MASIRIKA',131),(8396,'Quentin','NEVES',132),(8397,'Samuel-Souka','MEYER',133),(8398,'Niki','ZAAL',134),(8399,'Samuel','GUGGIARI',135),(8400,'Lorys','BUHLER',136),(8401,'Yannick','BAUDRAZ',137),(8402,'Ioris','AIELLO',138),(8403,'Olivier','TISSOT',139),(8404,'Leo','ZMOOS',140),(8405,'Jerome','JAQUEMET',141),(8406,'Florian','SUCHET',142),(8407,'Driton','ILJAZI',143),(8408,'Theo','COOK',144),(8409,'Joao-Paulo','ALIPIO-PENEDO',145),(8410,'Livia','MAYER',146),(8411,'Naima','FAHMY-HANNA',147),(8412,'Aleksandar','SRBINOVSKI',148),(8413,'Cantin','PIGNAT',149),(8414,'Louis','GACHET',150),(8415,'Julie','PROBST',151),(8416,'Quentin','AELLEN',152),(8417,'Jeremy','BOURQUI',153),(8418,'Margaux','ALGE',154),(8419,'Eqbal','JALALY',155),(8420,'Dorian','NICLASS',156),(8421,'Henrique','BALTAREJO-REIS',157),(8422,'Selim','CARREL',158),(8423,'Delphyne','AEBY',159),(8424,'Sylvain','GANDINI',160),(8425,'Jimmy','CATARINO-DINIS',161),(8426,'Benoit','MEYLAN',162),(8427,'Jeremy','JUNGO',163),(8428,'Alec','JACCARD',164),(8429,'Dylan','OLIVEIRA-RAMOS',165),(8430,'Julien','ROSSI',166),(8431,'Romaine','KLAY',167),(8432,'Sebastien','HARTMANN',168),(8433,'Mauro-Alexandre','COSTA-DOS-SANTOS',169),(8434,'Sacha','USAN',170),(8435,'Louis','RICHARD',171),(8436,'Jason','CRISANTE',172),(8437,'Alexandre','BASEIA',173),(8438,'Johan','VOLAND',174),(8439,'Leandro','SARAIVA-MAIA',175),(8440,'Szymon','JAGLA',176),(8441,'Sylvene','WUTHRICH',177),(8442,'Rui-Manuel','MOTA-CARNEIRO',178),(8443,'Luca','GIANNANTONIO',179),(8444,'Lavdim','SADIKAJ',180),(8445,'Zacharie','FAVRE',181),(8446,'Dylan-David','CUNHA-ROCHA',182),(8447,'Yan','PETTER',183),(8448,'Alexandre','FONTES',184),(8449,'Filipe','FERREIRA-DANTAS',185),(8450,'William','HAUSMANN',186),(8451,'Michael','PEDROLETTI',187),(8452,'Bryan','EVANGELISTI',188),(8453,'Lena','BAUWENS',189),(8454,'Justin','THEYTAZ',190),(8455,'Mathieu','RABOT',191),(8456,'Damien','MERCIER',192),(8457,'Catarina','DE-JESUS',193),(8458,'Cynthia','HERTIG',194),(8459,'Kevin','PASTEUR',195),(8460,'Joshua','CRISTOFORI',196),(8461,'Kujtim','SHEHI',197),(8462,'Rafael','DOS-SANTOS',198),(8463,'Dylan','BERNEY',199),(8464,'Patrick','ALTIERI',200),(8465,'Pascal','BENZONANA',201),(8466,'Bastien','EMERY',202),(8467,'Amra','MEMIC',203),(8468,'Gwendal-Alexej','GRABER',204),(8469,'Luckas','SAHLI',205),(8470,'Ian','CLOT',206),(8471,'Gael','AYMONIER',207),(8472,'Sam','LOUREIRO',208),(8473,'Ricardo-Joao','FERREIRA-DANTAS',209),(8474,'Elvedin','HASIC',210),(8475,'Estelle','BOLAY',211),(8476,'Yanick','JACCARD',212),(8477,'Jihane','SEMLALI',213),(8478,'Hiba','AL-QUBLAN',214),(8479,'Hamza','EL-AAMELY',215),(8480,'Miguel','SOARES',216),(8481,'Jan','BLATTER',217),(8482,'Ian','BOEHLER',218),(8483,'Somchai','GRIESSEN',219),(8484,'Jarod','PINTO',220),(8485,'Esteban','GIORGIS',221),(8486,'Theo','ESSEIVA',222),(8487,'Ilan','RUIZ-DE-PORRAS',223),(8488,'David-Manuel','GOMES-VAROSO',224),(8489,'Simon','ZURCHER',225),(8490,'Nyah-Mae','ROGER',226),(8491,'Kevin','BERNEY',227),(8492,'Amanda','PEREIRA-RIOS-RUFINO',228),(8493,'Nicolas','HENRY',229),(8494,'Albert','COURT',230),(8495,'Dario','WILLOMMET',231),(8496,'Gwendal','MOTTAY',232),(8497,'Damiano','MONDAINI',233),(8498,'Marielle','HANGGELI',234),(8499,'Doran','KAYOUMI',235),(8500,'Kendrick','DEBOSSENS',236),(8501,'Robin','SCHMUTZ',237),(8502,'Almir','RAZIC',238),(8503,'Corentin','VON-KAENEL',239),(8504,'Romain','ONRUBIA',240),(8505,'Anthony','JACCARD',241),(8506,'Paul','REEVE',242),(8507,'Tiago-Manuel','FERREIRA-OLIVEIRA',243),(8508,'Robin','REUTELER',244),(8509,'Mathias','RENOULT',245),(8510,'Thomas','HUGUET',246),(8511,'Maurine','BASAIA',247),(8512,'Florent','RYSER',248),(8513,'Diego','HALDI',249),(8514,'Luca','BASSI',250),(8515,'Luca','AMEZ',251),(8516,'Paul','ALLEGRO',252),(8517,'Marc-Andre','NYDEGGER',253),(8518,'Rim','FATHI',254),(8519,'Nicolas','GLASSEY',255),(8520,'Julien','BERSET',256),(8521,'Antoine','PAGE',257),(8522,'Kevin','TEIXEIRA',258),(8523,'Nicolas','KAELIN',259),(8524,'Arben','FERATI',260),(8525,'Nathan','RAYBURN',261),(8526,'Alexandre','ROCHAT',262),(8527,'Thierry','SCHAER',263),(8528,'Giovanni','PERRONE',264),(8529,'Cedric','SILVESTRI',265),(8530,'Onna','LACRABERE',266),(8531,'Alwyn','NICOLLERAT',267),(8532,'Sebastien','GRANDJEAN',268),(8533,'Valdrin','JAKAJ',269),(8534,'Anthony','LEHMANN',270),(8535,'Amandine','JULIA-FLACH',271),(8536,'Axel','DAPIA',272),(8537,'Ewan','GROBET',273),(8538,'Cristopher-Joel','ANGULO-MUNOZ',274),(8539,'Muamer','COHADAREVIC',275),(8540,'Edmilson','MONTEIRO-DA-VEIGA',276),(8541,'Samson','TEKLEHAIMANOT',277),(8542,'William','BROCH',278),(8543,'Hugo','DALLA-PIAZZA',279),(8544,'Ali','NASSER-KASSEM',280),(8545,'Rafael','DUARTE-CORREIA',281),(8546,'Ida-Maeva','MABIKI',282),(8547,'Lisa','GORGERAT',283),(8548,'Mark','LEUZINGER',284),(8549,'Joel','DOS-SANTOS-MATIAS',285),(8550,'Joris','DECOPPET',286),(8551,'Tenzing','GRACI',287),(8552,'Thomas','RICCI',288),(8553,'David','FERREIRA',289),(8554,'Michael','HOFER',290),(8555,'Xavier','CARREL',291),(8556,'Dylan','COSTA-CRISTOFANO',292),(8557,'Gaetan','GENDROZ',293),(8558,'Cassandra-Daisy','ANDREY',294),(8559,'Colette','JACCARD',295),(8560,'Raphael','FAVRE',296),(8561,'Benoit','AUGSBURGER',297),(8562,'Alexandre','RODRIGUEZ',298),(8563,'Sylvain','SIDLER',299),(8564,'Alyssa','PIEREN',300),(8565,'Brian','RODRIGUES-FRAGA',301),(8566,'Sebastien','TRADER',302),(8567,'Yann','ZURBRUGG',303),(8568,'Diamant','HALIMI',304),(8569,'Roberto','GOMES-SEMEDO',305),(8570,'Mohamed','ALI-DUALE',306),(8571,'Damien','JAKOB',307),(8572,'Antony','NEYRET',308),(8573,'Matthias','VESCO',309),(8574,'Maxim','GOLAY',310),(8575,'Yohann','ROGIVUE',311),(8576,'Michael','WYSSA',312),(8577,'Stephane','JUNOD',313),(8578,'Afonso-Miguel','MARTINS-MAIA-CORREIA',314),(8579,'Svan','BASSETTI',315),(8580,'Aron','TESFAZGI',316),(8581,'Loel','ZWIETNIG',317),(8582,'Benjamin','DELACOMBAZ',318),(8583,'Jeremy','GFELLER',319),(8584,'Senistan','JEGARAJASINGAM',320),(8585,'Quentin','ROSSIER',321),(8586,'Niels','GERMANN',322),(8587,'Steven','AVELINO',323);
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pool_modes`
--

DROP TABLE IF EXISTS `pool_modes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pool_modes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mode_description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `planningAlgorithm` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pool_modes`
--

LOCK TABLES `pool_modes` WRITE;
/*!40000 ALTER TABLE `pool_modes` DISABLE KEYS */;
INSERT INTO `pool_modes` VALUES (1,'Matches simples',1),(2,'Aller-retour',2),(3,'Elimination directe',3),(4,'Matches simples',1),(5,'Aller-retour',2),(6,'Elimination directe',3),(7,'Matches simples',1),(8,'Aller-retour',2),(9,'Elimination directe',3);
/*!40000 ALTER TABLE `pool_modes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pools`
--

DROP TABLE IF EXISTS `pools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pools` (
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
  KEY `pools_gametype_id_foreign` (`game_type_id`),
  CONSTRAINT `pools_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pools`
--

LOCK TABLES `pools` WRITE;
/*!40000 ALTER TABLE `pools` DISABLE KEYS */;
INSERT INTO `pools` VALUES (10,'09:30:00','11:45:00','A',1,6,1,3,1,1),(11,'09:30:00','11:45:00','B',1,6,1,3,1,1),(12,'09:30:00','11:45:00','Winners',2,6,0,3,1,1),(13,'09:30:00','11:45:00','Cool',2,6,0,3,1,1),(14,'09:30:00','16:00:00','NBA',1,8,0,2,1,1),(15,'09:30:00','16:00:00','The Championship',1,8,0,6,1,1),(17,'13:30:00','16:00:00','The Battle',1,13,0,1,1,1);
/*!40000 ALTER TABLE `pools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sports`
--

DROP TABLE IF EXISTS `sports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `min_participant` int(11) NOT NULL DEFAULT '0',
  `max_participant` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sports`
--

LOCK TABLES `sports` WRITE;
/*!40000 ALTER TABLE `sports` DISABLE KEYS */;
INSERT INTO `sports` VALUES (1,'Badminton','',2,10000),(2,'Basketball',NULL,5,10000),(3,'Beachvolley',NULL,3,10000),(5,'Ultimate',NULL,6,10000),(6,'Unihockey',NULL,3,10000),(7,'Petanque','',2,2),(9,'Marche',NULL,1,10000),(10,'Gestionnaire de tournoi',NULL,1,10000);
/*!40000 ALTER TABLE `sports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_id` int(10) unsigned DEFAULT NULL,
  `validation` int(10) unsigned NOT NULL DEFAULT '0',
  `owner_id` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `teams_tournament_id_foreign` (`tournament_id`),
  CONSTRAINT `teams_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'La Marche',9,0,1),(2,'Gestionnaire Matin',10,0,1),(3,'Gestionnaire Aprés-midi',11,0,1),(126,'Flambeaux',7,0,75),(127,'Mr & Mrs Pétanque',7,0,81),(128,'Despastiso',7,0,84),(129,'Louis et Benjamin',7,0,86),(130,'Fendt 1050 vario',7,0,92),(131,'Goplaytetris',7,0,88),(132,'Oskis',6,0,208),(133,'Jahseh Dwayne Onfroy',7,0,76),(135,'Jody',7,0,100),(138,'InsérerNomOriginal',7,0,89),(139,'La Boule Magique',7,0,108),(140,'Supercalifragilisticexpialidocious',7,0,118),(141,'Skuuurt',3,0,97),(142,'XXXTENTACION',2,0,85),(143,'bob et boby',7,0,99),(144,'XXXTENTACION<3',5,0,85),(145,'bgswagswag',7,0,87),(146,'LesBeybladesDeLaPetanque',7,0,115),(147,'KriegMachine',2,0,113),(148,'Pikachu',6,0,124),(149,'martybolay',7,0,117),(150,'Mahlzeit petanque',7,0,77),(151,'Les Supers Nanas',3,0,119),(152,'Uni-OK',6,0,140),(153,'Drit dream team',3,0,143),(156,'Le Bayern de Monique',3,0,134),(157,'Tireur des litres',3,0,159),(158,'Les girls',3,0,80),(160,'Sun of Beach',3,0,169),(162,'Wakanda',3,0,179),(163,'Les petits poney',3,0,106),(164,'1deux345six',2,0,185),(165,'1deux345six7',5,0,185),(166,'BadRingtone',1,0,175),(167,'polymédia',3,0,190),(168,'OnAvaitPasDIdée',2,0,195),(169,'Ultime-Mate',5,0,140),(172,'Santa-Cruz United',6,0,110),(173,'Thé à la menthe',3,0,187),(174,'Access',1,0,201),(176,'La Casa de Poubelle',2,0,215),(177,'La Casa de Poubelle 2 ',5,0,215),(178,'Santa-Cruz United UTM',5,0,110),(179,'Les O.U.I !',3,0,240),(180,'VSY Squad',5,0,208),(181,'(づ｡◕‿‿◕｡)づ TAKE MY ENERGY (づ｡◕‿‿◕｡)づ',1,0,104),(182,'(づ｡◕‿‿◕｡)づ TAKE MY POWER (づ｡◕‿‿◕｡)づ',6,0,104),(184,'YourProblem',1,0,109),(185,'YourProblemComeBack2',2,0,109),(186,'TocLabricot',1,0,181),(187,'TheShelbys',2,0,259),(188,'Shelby',5,0,259),(189,'Polymec',2,0,94),(190,'Polymec 2.0',5,0,94),(191,'Kéké Des Plages ',1,0,91),(192,'On a pas d\'idée',1,0,271),(195,'Socrative',2,0,287),(196,'CPNVAJI',1,0,287),(197,'S235-jr',5,0,207),(198,'S235-jr-iso',6,0,207),(199,'Ice T',1,0,198),(202,'les majmun city',6,0,304),(203,'les macaco city',1,0,304),(204,'Hardcopistes',1,0,309),(206,'tipiak team',1,0,316),(207,'Les Supermatazoïdes',1,0,267),(208,'TEST equipe Bad Kevin',1,0,121),(209,'TEST equipe Basket Kevin',2,0,121),(210,'Test team Butoxx',1,0,318),(211,'Kakarotto',6,0,318),(212,'Satanas',1,0,291);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournaments`
--

DROP TABLE IF EXISTS `tournaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournaments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `img` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_id` int(10) unsigned NOT NULL,
  `sport_id` int(10) unsigned NOT NULL,
  `end_date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `max_teams` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tournaments_event_id_foreign` (`event_id`),
  KEY `tournaments_sport_id_foreign` (`sport_id`),
  CONSTRAINT `tournaments_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  CONSTRAINT `tournaments_sport_id_foreign` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournaments`
--

LOCK TABLES `tournaments` WRITE;
/*!40000 ALTER TABLE `tournaments` DISABLE KEYS */;
INSERT INTO `tournaments` VALUES (1,'Badminton','2018-07-03 13:30:00','20180626144706.jpg',1,1,'2018-07-03 16:50:00',10000),(2,'Basketball','2018-07-03 08:00:00','20180626144746.jpg',1,2,'2018-07-03 12:15:00',10000),(3,'Beachvolley','2018-07-03 09:15:00','20180626144651.jpg',1,3,'2018-07-03 16:50:00',12),(5,'Ultimate','2018-07-03 13:30:00','20180626144717.jpg',1,5,'2018-07-03 16:50:00',10000),(6,'Unihockey','2018-07-03 08:00:00','20180626144759.jpg',1,6,'2018-07-03 12:15:00',10000),(7,'Petanque','2018-07-03 08:00:00','20180626144623.jpg',1,7,'2018-07-03 16:50:00',16),(9,'Marche','2018-07-03 09:00:00','20180626144643.jpg',1,9,'2018-07-03 16:50:00',1),(10,'Gestionnaire de tournoi Matin','2018-07-03 08:00:00','20180626144634.jpg',1,10,'2018-07-03 12:15:00',1),(11,'Gestionnaire de tournoi Apres-midi','2018-07-03 13:30:00','20180626144735.jpg',1,10,'2018-07-03 16:50:00',1);
/*!40000 ALTER TABLE `tournaments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=324 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Marc Dafflon','$2y$10$8CYMxdRuIuxMveRQR996EeqwVSFbKb7LvCpQcKN3am20fsbLcNtOC','administrator','marc.dafflon@cpnv.ch','Marc','Dafflon'),(72,'HURNI Pascal','$2y$10$l5taghhoOUNkIWSX0f9n/Oa0/XGN/qLzCp4TwaL2tpjYqvQLfp.nq','administrator','Pascal.HURNI@cpnv.ch','Pascal','HURNI'),(73,'CARBONI Davide','$2y$10$nbvWSvVkMX31t7p8hUQmJONZY8ZWRdCCTmwnqhOZGxvBbs89mohgW','administrator','Davide.CARBONI@cpnv.ch','Davide','CARBONI'),(74,'RICHOZ Julien','$2y$10$7HVkqJ2.Dw8wcy/JbeAycuGEjAGIIgRettuyXAsA70.DhTZy4Kv.W','participant','Julien.RICHOZ@cpnv.ch','Julien','RICHOZ'),(75,'HERMINJARD Nathanael','$2y$10$a.QiOImNrK7ksBPO5lU6kOkWuD5Qv2GoV/h3sZQMCzkDkssBGRPky','participant','Nathanael.HERMINJARD@cpnv.ch','Nathanael','HERMINJARD'),(76,'DEFFERRARD Megane','$2y$10$g8zC2EPSkkUUHcNW/2VCM./3L5cByC9WWd.HsIeRuUoWXbbZRsNHG','participant','Megane.DEFFERRARD@cpnv.ch','Megane','DEFFERRARD'),(77,'DE-BIASE Gabriel','$2y$10$81o055wjuGzjbdmx2MjOoemaliICB8vnSV6uwVC9DkXJP6nN2MHJ2','participant','Gabriel.DE-BIASE@cpnv.ch','Gabriel','DE-BIASE'),(78,'BARTOLI Jolan','$2y$10$q1LOZ9ensS4T/kvNaqll1OaxEWAWWrTSFSwINdM/BeImt4pyTZN1e','participant','Jolan.BARTOLI@cpnv.ch','Jolan','BARTOLI'),(79,'BULA Eva','$2y$10$wgy6kHLPBrVt7E7KJ5af4.4qk0pdtQHvH4WNfjwbCSTmH52p18sn2','participant','Eva.BULA@cpnv.ch','Eva','BULA'),(80,'GEBHARDT Jeanne','$2y$10$yxm.eTiWer9DdKfZtbGEzewh2yDHIqrglFYUNH9RsZTt65qkU9AFi','participant','Jeanne.GEBHARDT@cpnv.ch','Jeanne','GEBHARDT'),(81,'ROBERT Aurelien','$2y$10$oyPeOHGunoTe6lQU0NZdpe6be4Y9t3trZKbg84FTv8XBtIQPmm1m.','participant','Aurelien.ROBERT@cpnv.ch','Aurelien','ROBERT'),(82,'DUPERRIER Jannice','$2y$10$Rpp7Lakr6GbCBn8IRMCNxOPnG0LGL4fkve6htp6/qMppsAeefQfJy','participant','Jannice.DUPERRIER@cpnv.ch','Jannice','DUPERRIER'),(83,'RAVESSOUD Shannon','$2y$10$QqTgULgTUKDHN.YrO64Ld.Xrmfz9rvg.s10KmoHJX3jOlqRvb0q9S','participant','Shannon.RAVESSOUD@cpnv.ch','Shannon','RAVESSOUD'),(84,'DEL-GRECO Federico','$2y$10$Lm5JXHduZX2YlwODma5x1OwvhnN4EEKVa1FAqy8caSZDI.KC46Ddi','participant','Federico.DEL-GRECO@cpnv.ch','Federico','DEL-GRECO'),(85,'CUDRE-MAUROUX Yllies','$2y$10$FlDdRXCEOg8yszsQtQf.a.9F5t0R/IENk6sHcBiNi04YKp9sbQiwe','participant','Yllies.CUDRE-MAUROUX@cpnv.ch','Yllies','CUDRE-MAUROUX'),(86,'MISCHLER Benjamin','$2y$10$l25YeYUOG6TirRlSKEdQkuxMUifaLrUitJHZNT67GgWiuXaTSVk7K','participant','Benjamin.MISCHLER@cpnv.ch','Benjamin','MISCHLER'),(87,'BOCHUD Nicolas','$2y$10$yBilqulAZ3z.1KJHHXxvt.MVlqqVuQmZlfL0WLgmBkPQa3OEAC9Ba','participant','Nicolas.BOCHUD@cpnv.ch','Nicolas','BOCHUD'),(88,'GAVIN Loic','$2y$10$UAbiqzFNoEhIdjp4a/.TfuellqFmqXAy4teBTxhYMjYUtjwCpfwri','participant','Loic.GAVIN@cpnv.ch','Loic','GAVIN'),(89,'GOLDENSCHUE Cyril','$2y$10$nCBxv48sxeWJ/5Y.9f9KPOt6BziAgriNyft7EXd29Bpry.eahzb6u','participant','Cyril.GOLDENSCHUE@cpnv.ch','Cyril','GOLDENSCHUE'),(90,'DELGADO Samuel','$2y$10$rjjXY/OC1vyOtd57FYjaUu30lIxj9VEipsNy86K7jKbrspOSEnkz2','participant','Samuel.DELGADO@cpnv.ch','Samuel','DELGADO'),(91,'MOESLE Maxime','$2y$10$R80jc2dCh3e01qfr2xI.g.OW02DLjwbjP8oOXaHKcjyJS/tdeE/iq','participant','Maxime.MOESLE@cpnv.ch','Maxime','MOESLE'),(92,'GANS Axel','$2y$10$nyyqMrUEng5ShQhm5ZVF8e65JzIamjVqDZ3Zyz0ZSWOvGiTnooKKG','participant','Axel.GANS@cpnv.ch','Axel','GANS'),(93,'ROCHAT Noemie','$2y$10$T1MqTqx/FHZB/PH58CA1Qe/5bVR6KvY4U76NwadUD0dQii/nA8UWK','participant','Noemie.ROCHAT@cpnv.ch','Noemie','ROCHAT'),(94,'SAUSSAZ Steven','$2y$10$pMr8qZW6AbC1..hpQN0mgeJTMiY7KTY8YoYsRdAgt7jrVbCDSmTM2','participant','Steven.SAUSSAZ@cpnv.ch','Steven','SAUSSAZ'),(95,'GASSER Honore','$2y$10$zjNRV3sn4EQuh3vyqTG4ROu6RgtAFVleOB0GGKvHGNbdIZNotirPW','participant','Honore.GASSER@cpnv.ch','Honore','GASSER'),(96,'KOULBANIS Thierry','$2y$10$pGMmCN/9o6VclDgCOcHHfeWUBZBQRXny2s/cBryfZl7BbVszz1Goi','participant','Thierry.KOULBANIS@cpnv.ch','Thierry','KOULBANIS'),(97,'SELVARAJAH Jenithan','$2y$10$MAAhLTXsPDCY2.zXHOr97eUxCG3XaUNVEoJAYEdtT2.UyfWQGC80S','participant','Jenithan.SELVARAJAH@cpnv.ch','Jenithan','SELVARAJAH'),(98,'RAMOS-ALVES Jaison','$2y$10$lvdo1EzX5DNEfABqV4azxO6aoykG5/c8KmnlS7Bug4Pgo9c0KA78i','participant','Jaison.RAMOS-ALVES@cpnv.ch','Jaison','RAMOS-ALVES'),(99,'MASSON Fabien','$2y$10$db1RwHT/CS593BjQliWqiuU63Mbf7yrp/FhLp.eUA5PcJkyIbPEKq','participant','Fabien.MASSON@cpnv.ch','Fabien','MASSON'),(100,'FONJALLAZ Camille','$2y$10$jkHwjqzGVvEAQunlFJfqQeBucipIei2eoYyaLk74a0EmWZzwjebqG','participant','Camille.FONJALLAZ@cpnv.ch','Camille','FONJALLAZ'),(101,'MAENDLY Audrey','$2y$10$sEea7DGlsawxCGTVs/t9Ee7r0iF9VzJ.tJoJe0/dpBtQKti.Nht6e','participant','Audrey.MAENDLY@cpnv.ch','Audrey','MAENDLY'),(102,'TROSSET Keanu','$2y$10$6EnDxC.fXPmH0TxFZJZiKeSMrqHdXXq4hLTcHWwqD7UHikA.jtrQ.','participant','Keanu.TROSSET@cpnv.ch','Keanu','TROSSET'),(103,'PORCHET Benjamin','$2y$10$9vYOgpZPhiQTAp4rliZXH.gQ70k3VAdGgZ/tXWI9xZ6YUIwH769Tu','participant','Benjamin.PORCHET@cpnv.ch','Benjamin','PORCHET'),(104,'STAUBLI Loris','$2y$10$fEK3.JKhPwfZC4OZbL6LPuf66qI2SCh5yltANUWlILPymi9apEpTq','participant','Loris.STAUBLI@cpnv.ch','Loris','STAUBLI'),(105,'INCOURT Julien','$2y$10$2C/6fwnWnAwoAv9DstpCk.sSZofyY.984S7WSo.WIRjo4EnUk3AXC','participant','Julien.INCOURT@cpnv.ch','Julien','INCOURT'),(106,'DE-OLIVEIRA-CALHAU Guilherme','$2y$10$2CGcDgPWAtIz1EdRIyc4F.uCCB3KJAJ0ZgfBG0AO8qUGE1rQylD3m','participant','Guilherme.CALHAU@cpnv.ch','Guilherme','DE-OLIVEIRA-CALHAU'),(107,'FERRO Luca','$2y$10$ZnsayFFBXSIZn8wVb/5/SOWkgVQgvEm1geUwgwNa4PbiGH85Jult2','participant','Luca.FERRO@cpnv.ch','Luca','FERRO'),(108,'MANZINI Kylian','$2y$10$lm246BVUMHlV0RG/u9/pd.lzW.qqU8OWQFpIrG2AnV1.PxaMVgpQe','participant','Kylian.MANZINI@cpnv.ch','Kylian','MANZINI'),(109,'GOMEZ Abel-Natan','$2y$10$wXmbfAVz371s3eONPMx6NeHgmD6EUhE66Z96jCeoPxsn7icYsC29a','participant','Abel-Natan.GOMEZ@cpnv.ch','Abel-Natan','GOMEZ'),(110,'RAMADANI Rayan','$2y$10$Ig3uaAV9bv6dprkDecIpR.Wn7spj9q2q2hBHqmkGwFEUQLDd1/iza','participant','Rayan.RAMADANI@cpnv.ch','Rayan','RAMADANI'),(111,'GALLIKER Nais','$2y$10$nYkKG0OdV4Y5btWNQq93RO/hxJxCMPTvyNWSZkWEjgMn.JIyjQRKG','participant','Nais.GALLIKER@cpnv.ch','Nais','GALLIKER'),(112,'LAUBER Gwennaelle','$2y$10$TyCl5r1X3TukMUgM288HouLVfSh3x3jcus/q3Xn0XPxVSjvmLTPx6','participant','Gwennaelle.LAUBER@cpnv.ch','Gwennaelle','LAUBER'),(113,'ANGLADE Elodie','$2y$10$1uvNOYrKv7eRimKZ5KkSAurlUJ1snQDx3P0kMnCOQsxZgLHP56aqS','participant','Elodie.ANGLADE@cpnv.ch','Elodie','ANGLADE'),(114,'GUSTURANAJ Orges','$2y$10$WPz9T58UjzEPF0QB3yyzT.KYl48HFwQoziOslOHrvsskRV3Oww.kC','participant','Orges.GUSTURANAJ@cpnv.ch','Orges','GUSTURANAJ'),(115,'KOHLER Teo','$2y$10$6fMg59OoqYYTYEiyNo54UeFjpi6OeKS.ixtwArY22LuCCS2fzAZ02','participant','Teo.KOHLER@cpnv.ch','Teo','KOHLER'),(116,'KOSTINGER Loic','$2y$10$Zlq3sBAlYf8oH/JK0rkPSeJYIp836C1W5stG46VQpLTlbeiTzoxcW','participant','Loic.KOSTINGER@cpnv.ch','Loic','KOSTINGER'),(117,'MARTINELLA Julien','$2y$10$CL0FLOsCoXT0eUfGzMqStOkto5kUsWWG9eyjgDDuNuBvyhnHW/uS6','participant','Julien.MARTINELLA@cpnv.ch','Julien','MARTINELLA'),(118,'JUTZELER Dylan','$2y$10$CZKjnq.mFvoJ2f6VKZ7eBuJD4PkOOJZiCzB/ZF88zO5C2F87Dd9oK','participant','Dylan.JUTZELER@cpnv.ch','Dylan','JUTZELER'),(119,'FAVRE Jonathan','$2y$10$oOPrLRGG2vO9qYGFt4..4Of7BJp8FTT6BG0nSctbOM1txP1UCltrG','participant','Jonathan.FAVRE@cpnv.ch','Jonathan','FAVRE'),(120,'AGUILAR Kevin','$2y$10$KWQnFoTWil9mNlESjEsAv.F6dQoYCITZiNH/aqN5EJzNqCLB0HnaG','participant','Kevin.AGUILAR@cpnv.ch','Kevin','AGUILAR'),(121,'JORDIL Kevin','$2y$10$JHWUrsxqVgicZStcV6Kk7Ohm6C1BVxP86dR1TuAD9ehlzdjyn/oWW','participant','Kevin.JORDIL@cpnv.ch','Kevin','JORDIL'),(122,'SCHENEVEY Arnaud','$2y$10$D4wvRabqFV6FPIEB9ZhxkeoHuUPWYC4Gt/KXgTr7H4JUJiPLtxT4e','participant','Arnaud.SCHENEVEY@cpnv.ch','Arnaud','SCHENEVEY'),(123,'MARBACH Noah','$2y$10$hwXctPzoSJFqUqiX00oE..Uh/rbOmweC81oKXZJH75SGwcdczGVHq','participant','Noah.MARBACH@cpnv.ch','Noah','MARBACH'),(124,'LEITAO-SEPULVEDA Adilia','$2y$10$AvTHxgMMDtv1w3LwyJlL5uR4DuE8N2CCa2nCHgY3dXgr1GeDwjska','participant','Adilia.LEITAO-SEPULVEDA@cpnv.ch','Adilia','LEITAO-SEPULVEDA'),(125,'STADER Nathan','$2y$10$2XMUaZvYWUyTbqMCCfDF.OegOH5YMrsBb3MayYzl6QHAtKmpkHqTG','participant','Nathan.STADER@cpnv.ch','Nathan','STADER'),(126,'GAUTIER Theo','$2y$10$t5.5r2v2NF8Ph0GRwwFCduio2ocWgwEQxuivGTRyUm/AMvej/9ha6','participant','Theo.GAUTIER@cpnv.ch','Theo','GAUTIER'),(127,'ROSSI Alessandro','$2y$10$r0QCgdIulItMF0c3s7BRxexsTWZZCWDIZmqtDzGqe4xeJOAeCfnD.','participant','Alessandro.ROSSI@cpnv.ch','Alessandro','ROSSI'),(128,'HUMAIR Simon','$2y$10$kYDnYdBMh0IUbK0eMX/6ieP3mvJogjpilOm4n5Aps5N95yc04Usyq','participant','Simon.HUMAIR@cpnv.ch','Simon','HUMAIR'),(129,'GOLAY Lorye','$2y$10$YuHq8ms/V7wvqajc92fRSuKlmpCqUUru6NzvB6fQKYPcdkKMR.p3S','participant','Lorye.GOLAY@cpnv.ch','Lorye','GOLAY'),(130,'PARRIAUX Mathieu','$2y$10$B5Ec8WdItzmprs.FklCqZeSemKX.POdrMlUyeCigrhyimz04IwSr6','participant','Mathieu.PARRIAUX@cpnv.ch','Mathieu','PARRIAUX'),(131,'MASIRIKA Ryan','$2y$10$JwwMH.38BKsyQRLuZEOKM.hG6LOQ.XcJkSw75oXw5A.R8lL0aWimW','participant','Ryan.MASIRIKA@cpnv.ch','Ryan','MASIRIKA'),(132,'NEVES Quentin','$2y$10$iwfWjDO11O1uYRkhrPGlSeGnOOyQfhmKzePkNpdMetPYxTIrhRjSm','administrator','Quentin.NEVES@cpnv.ch','Quentin','NEVES'),(133,'MEYER Samuel-Souka','$2y$10$4gPESoV9VpyVS0vvXoEG2.aDe6CsVcePbar56BLzFxBkx11dNNnay','participant','Samuel-Souka.MEYER@cpnv.ch','Samuel-Souka','MEYER'),(134,'ZAAL Niki','$2y$10$b38WSGRKH1C4RLDuElTgI.LfLCM29TUaUyTyma5RSMDBWJ6jTqSgu','participant','Niki.ZAAL@cpnv.ch','Niki','ZAAL'),(135,'GUGGIARI Samuel','$2y$10$f8LgiOfDl1.HdBqiwAWDx.XDkZO5P9yon0ccfrlSBOINyrcxRMcZ.','participant','Samuel.GUGGIARI@cpnv.ch','Samuel','GUGGIARI'),(136,'BUHLER Lorys','$2y$10$6a.1MJGXV.UkaVfKCRlqhecvf1KdJGGfa5FOqORNplGTBhztAcCJy','participant','Lorys.BUHLER@cpnv.ch','Lorys','BUHLER'),(137,'BAUDRAZ Yannick','$2y$10$X0W6dJofqJp8lMtKt1TwvOcQ8dMyYpDEdI9UPEsrKhycqGsF8cu0q','participant','Yannick.BAUDRAZ@cpnv.ch','Yannick','BAUDRAZ'),(138,'AIELLO Ioris','$2y$10$4yI3onj7gGHa4Y0kV6PxYO2T5ThOPMRixDm9hrQesdstwTRLYscuG','participant','Ioris.AIELLO@cpnv.ch','Ioris','AIELLO'),(139,'TISSOT Olivier','$2y$10$8Yq16/KFNustiHIcVrfTIe/6fIHGdE60Tdr1uI9cXEtESrT34lGES','participant','Olivier.TISSOT@cpnv.ch','Olivier','TISSOT'),(140,'ZMOOS Leo','$2y$10$1NQ0nshBu.xEHt6I4wUX3ORTk2yz6f1Kd3SC620eXAKGiWcvJVQ.m','participant','Leo.ZMOOS@cpnv.ch','Leo','ZMOOS'),(141,'JAQUEMET Jerome','$2y$10$6kIOm670oPvJS/y10Hu8TOiiUmNiQ.QKmMxfdMN.SLsjPF4OeYTMO','participant','Jerome.JAQUEMET@cpnv.ch','Jerome','JAQUEMET'),(142,'SUCHET Florian','$2y$10$FCSuGza/vnhYb6Loju48ZOfs/Wo7vPKIKzFOQvpxXlLNbD734XBZK','participant','Florian.SUCHET@cpnv.ch','Florian','SUCHET'),(143,'ILJAZI Driton','$2y$10$Kor6OVhjkje6ubf0UuK.T.GqkVe8pqUSZHdDr7GbDz4nPeoQRVJ0K','participant','Driton.ILJAZI@cpnv.ch','Driton','ILJAZI'),(144,'COOK Theo','$2y$10$SH0xgZDUeg8HLeOl4n8ah.HifgZ.kxJ/xV3unZCQmMdB.jBkuGahe','participant','Theo.COOK@cpnv.ch','Theo','COOK'),(145,'ALIPIO-PENEDO Joao-Paulo','$2y$10$k1xNG2xbJCU2sedh58LcQeXnXKxFHG6ZhBtf8i/5xWG.iZUVWaEeS','participant','Joao-Paulo.ALIPIO-PENEDO@cpnv.ch','Joao-Paulo','ALIPIO-PENEDO'),(146,'MAYER Livia','$2y$10$GQhyRQNllAtUvyfnVvsQlOqeZr/j8dke4Asb32DSrULzp5/nex03a','participant','Livia.MAYER@cpnv.ch','Livia','MAYER'),(147,'FAHMY-HANNA Naima','$2y$10$pn8xN5OUb3Wjuk0Mt4MgbuxDR3Js5aaD5qwGq/WDQdtfjDMeapaM.','participant','Naima.FAHMY-HANNA@cpnv.ch','Naima','FAHMY-HANNA'),(148,'SRBINOVSKI Aleksandar','$2y$10$BW8VD1o4vCAxH/f3IifmKOx0Kdi0qy//cQIQkMJJJPzL/Ajnz6sQy','participant','Aleksandar.SRBINOVSKI@cpnv.ch','Aleksandar','SRBINOVSKI'),(149,'PIGNAT Cantin','$2y$10$N4b8J4cZPLSVw7KvoBV1gePyki3mhuu6NFDjViaDfPqhcfkgXrIMa','participant','Cantin.PIGNAT@cpnv.ch','Cantin','PIGNAT'),(150,'GACHET Louis','$2y$10$LildG56ZgnQnVdXUwoWNr.rmWheQ9IetbHoFM78rkpxXjnx2vBZK.','participant','Louis.GACHET@cpnv.ch','Louis','GACHET'),(151,'PROBST Julie','$2y$10$AQVr9B4xhQ.YZ7CKyKm6iOT/Bwlc8thSQ5eIu3ML.q9i55wIZsYhK','participant','Julie.PROBST@cpnv.ch','Julie','PROBST'),(152,'AELLEN Quentin','$2y$10$3RubgFeWZx4DcA8RnWN9ueNXn8e2VRS7kRZ0xX/r9ptNfppi.dOzy','participant','Quentin.AELLEN@cpnv.ch','Quentin','AELLEN'),(153,'BOURQUI Jeremy','$2y$10$7aC1e/AMqFqD7.fPcdJbK.ZYVM7nvp77jLcxc/mQHr6Pt752rqs..','participant','Jeremy.BOURQUI@cpnv.ch','Jeremy','BOURQUI'),(154,'ALGE Margaux','$2y$10$RjLyL2g2qhyPrRL/eGq.huvgFdZG0B7gRBNQoi25gIt5s6DeopyXu','participant','Margaux.ALGE@cpnv.ch','Margaux','ALGE'),(155,'JALALY Eqbal','$2y$10$28AJ3EgQOU2CsHBPaLG./ekFL0VsV7xiyNO/IKcAh6MyWvv6PlqnO','participant','Eqbal.JALALY@cpnv.ch','Eqbal','JALALY'),(156,'NICLASS Dorian','$2y$10$ZBCDYNIM0mHcHB3LK/UdgenOberG2OZI1txMCJMLLT5XgqSs8CMwm','participant','Dorian.NICLASS@cpnv.ch','Dorian','NICLASS'),(157,'BALTAREJO-REIS Henrique','$2y$10$N/BxKLHZYydT.jl.36UgsuLQq.AZt164TpcuISKH396ZED7IOq5I6','participant','Henrique.BALTAREJO-REIS@cpnv.ch','Henrique','BALTAREJO-REIS'),(158,'CARREL Selim','$2y$10$sDPyMD1MHrvdlmZUKz7dkOsGPENjji0/.uGX5sZ8cCKGrsxuQkZ4W','participant','Selim.CARREL@cpnv.ch','Selim','CARREL'),(159,'AEBY Delphyne','$2y$10$anQjVDYPlCVFcYBVzyHWg.G3OZfik7HWtA5IrjIbTOsBUikjDcgIe','participant','Delphyne.AEBY@cpnv.ch','Delphyne','AEBY'),(160,'GANDINI Sylvain','$2y$10$qb451bvdFfs3fECeH3okc.e/ygoOMUNLvC2Ort6JIV4gxUlLUtBRi','participant','Sylvain.GANDINI@cpnv.ch','Sylvain','GANDINI'),(161,'CATARINO-DINIS Jimmy','$2y$10$mvdu5.b.4B/4ilR2RNe/5eaTdVRQA6jVk36OV.aLgf8iMZ.fqGAtW','participant','Jimmy.CATARINO-DINIS@cpnv.ch','Jimmy','CATARINO-DINIS'),(162,'MEYLAN Benoit','$2y$10$GwDQRYi3R7x.fO4xVfmDCOyEhoB/oElShVB6Nb.6KSvReBuANaO/u','participant','Benoit.MEYLAN@cpnv.ch','Benoit','MEYLAN'),(163,'JUNGO Jeremy','$2y$10$uwF/dyyMK.TmaDexIDPrce79z/xVVcPF3b1E55hCZLuALOoK3L.nC','participant','Jeremy.JUNGO@cpnv.ch','Jeremy','JUNGO'),(164,'JACCARD Alec','$2y$10$ALCzfMrQyoXCWmQb/9njRezeUlw89Ig0sb14jL9t5a2t8jL4cvUZK','participant','Alec.JACCARD@cpnv.ch','Alec','JACCARD'),(165,'OLIVEIRA-RAMOS Dylan','$2y$10$zxd3gjBHb91NwnpGtwyoj.7sNGxnRS2ZsE5mUMWHBHrgw23qAGB2e','participant','Dylan.OLIVEIRA-RAMOS@cpnv.ch','Dylan','OLIVEIRA-RAMOS'),(166,'ROSSI Julien','$2y$10$tu5wVuAVajhtjGPccdMgAOnQM1Y58wZst.CQ2Mo.b6cfkIZJrHKe2','participant','Julien.ROSSI@cpnv.ch','Julien','ROSSI'),(167,'KLAY Romaine','$2y$10$fDhJe3u2D0Oy6fWuRHf8suX9Qy99JmbRAl1P28yLakcAiZavZnIkG','participant','Romaine.KLAY@cpnv.ch','Romaine','KLAY'),(168,'HARTMANN Sebastien','$2y$10$BhAoU1TYuzJnJhYd4bRd6uu.HBnc1Pa2D0P6IVpL3Fdny6LF6.53C','participant','Sebastien.HARTMANN@cpnv.ch','Sebastien','HARTMANN'),(169,'COSTA-DOS-SANTOS Mauro-Alexandre','$2y$10$SDqnZbt5NMllDGjkeY/aWOS9EGk1DkyWQ8drenaM9iLSRfT0DTJ6u','participant','Mauro-Alexandre.COSTA-DOS-SANTOS@cpnv.ch','Mauro-Alexandre','COSTA-DOS-SANTOS'),(170,'USAN Sacha','$2y$10$uxe893DuCU.ogzqyKBZvPO39XPsKHx7mXLgrF5fJ5VqoU90vhQLiG','participant','Sacha.USAN@cpnv.ch','Sacha','USAN'),(171,'RICHARD Louis','$2y$10$Z08KjNaMb6z/z5TUHydo0OZ.4djGNQCFQKREw8YYtTqna/cGMHgUq','participant','Louis.RICHARD@cpnv.ch','Louis','RICHARD'),(172,'CRISANTE Jason','$2y$10$7VwNRtgNkuqVQjWPvYhrZeyTGT9Zp1pvjgp6l4.n1I.SH0nDkZ8Ry','participant','Jason.CRISANTE@cpnv.ch','Jason','CRISANTE'),(173,'BASEIA Alexandre','$2y$10$5xD5qZQ8tMSSxVyarrnsXe3GpoTpLkAPFK6XJYprmEx.H4hjSa4wC','participant','Alexandre.BASEIA@cpnv.ch','Alexandre','BASEIA'),(174,'VOLAND Johan','$2y$10$sNBBXGbdHKuE3NtImN8Z6eEGFlxawOCsfuw8wACcWo1tu3wCptaZ2','participant','Johan.VOLAND@cpnv.ch','Johan','VOLAND'),(175,'SARAIVA-MAIA Leandro','$2y$10$NeWXjlPSOogCpK9SA46RwedDb1VFUqSKG82cg/CQ3E6RXLOOMHa4.','participant','Leandro.SARAIVA-MAIA@cpnv.ch','Leandro','SARAIVA-MAIA'),(176,'JAGLA Szymon','$2y$10$B0uOBaulYnVfst88gIYqg.HL38hXhS45oy0HBFfbL7v64xa6HNsee','participant','Szymon.JAGLA@cpnv.ch','Szymon','JAGLA'),(177,'WUTHRICH Sylvene','$2y$10$1uNRVT4u20mGzLVTIk/ryuukMbWCJfQmNcBH7IbOUR6.mjMdj2K1O','participant','Sylvene.WUTHRICH@cpnv.ch','Sylvene','WUTHRICH'),(178,'MOTA-CARNEIRO Rui-Manuel','$2y$10$uSZ96GVzjuJGolDYJ2oLhObOYtUSI/shN.hCwwBK8GN0telcosw4i','participant','Rui-Manuel.MOTA-CARNEIRO@cpnv.ch','Rui-Manuel','MOTA-CARNEIRO'),(179,'GIANNANTONIO Luca','$2y$10$H3xjcdpnTYQ6XDdn27srYOCr5j5r13NDHozMnPjMdv6jNu6BI/HNK','participant','Luca.GIANNANTONIO@cpnv.ch','Luca','GIANNANTONIO'),(180,'SADIKAJ Lavdim','$2y$10$ktQh0A5wODSA3j8JVl7p3esiS.OofIPwZX3X1K6fOR/Thm.b3HJ8y','participant','Lavdim.SADIKAJ@cpnv.ch','Lavdim','SADIKAJ'),(181,'FAVRE Zacharie','$2y$10$cKQt70B18cdR6oJiFW6PAe8z13UG9ZAQylwA5lzlkYew1jrfLGNBy','participant','Zacharie.FAVRE@cpnv.ch','Zacharie','FAVRE'),(182,'CUNHA-ROCHA Dylan-David','$2y$10$i8vEqxixtBvijclUAelBye78ry78wT2DSWhHmsXszKVzz01HQmn0a','participant','Dylan-David.CUNHA-ROCHA@cpnv.ch','Dylan-David','CUNHA-ROCHA'),(183,'PETTER Yan','$2y$10$IEuY2yI4wjt3xtLdvfi15O39Ad2Z3xlwZIr5Kok27akColukbJC8i','participant','Yan.PETTER@cpnv.ch','Yan','PETTER'),(184,'FONTES Alexandre','$2y$10$HAmOF6SH62XCkZg/6tPbqezviTW4Ii3GFGTtUj5yfZQKL4IIzU74C','participant','Alexandre.FONTES@cpnv.ch','Alexandre','FONTES'),(185,'FERREIRA-DANTAS Filipe','$2y$10$byG10MWjr2GvG4SQInWMHuDNgtgRp5bHw6QuIPuBIOnaQXyzOeHi6','participant','Filipe.FERREIRA-DANTAS@cpnv.ch','Filipe','FERREIRA-DANTAS'),(186,'HAUSMANN William','$2y$10$hxXCx1ZDv3WCnWkggzLszu7odbUtB9V1XWFd/PeQYNwz/IVnGCy8i','participant','William.HAUSMANN@cpnv.ch','William','HAUSMANN'),(187,'PEDROLETTI Michael','$2y$10$wD.ETCZ9YWnZDwVJumj/N.jkrY35y2xOFeaNAEHs.w6x.QgSzoqZS','participant','Michael.PEDROLETTI@cpnv.ch','Michael','PEDROLETTI'),(188,'EVANGELISTI Bryan','$2y$10$Iv5qHma6Sy/wkAY2bI9aa.JJGWyyEYvazzDT.yOOsmyKUnCWzHZJm','participant','Bryan.EVANGELISTI@cpnv.ch','Bryan','EVANGELISTI'),(189,'BAUWENS Lena','$2y$10$dJbJ2xf.3ujxYiVsDi/CT.1vDvE3XdkZdOE7nVvitKtXd470yfjhC','participant','Lena.BAUWENS@cpnv.ch','Lena','BAUWENS'),(190,'THEYTAZ Justin','$2y$10$caW3ATAHT..2k3sVcPbWReo.obUfNFunV6jGQ3M1P4427rTdd49u.','participant','Justin.THEYTAZ@cpnv.ch','Justin','THEYTAZ'),(191,'RABOT Mathieu','$2y$10$OPd.8ggLTPEOcIEMP33vtu1WhKz3r//bYJJH380X3MykzQ3pJoC.G','participant','Mathieu.RABOT@cpnv.ch','Mathieu','RABOT'),(192,'MERCIER Damien','$2y$10$ha7O132t1nGL4.7O5mq2Ae6BToTb3mzyIzJxM07tB2F4HcicbdlBG','participant','Damien.MERCIER@cpnv.ch','Damien','MERCIER'),(193,'DE-JESUS Catarina','$2y$10$zhhsWvIRPFh7PxEY6R6K6OUV3zksjAIzGbJO.h63z.1p29g8ZpXTi','participant','Catarina.DE-JESUS@cpnv.ch','Catarina','DE-JESUS'),(194,'HERTIG Cynthia','$2y$10$Bmj1/IZLweak3TCJRogamulIke7yqU5chFCph0zgfbRmX4kBLyhjW','participant','Cynthia.HERTIG@cpnv.ch','Cynthia','HERTIG'),(195,'PASTEUR Kevin','$2y$10$7oyS5auzteizOjTuEt.YtujS09.UyizTFBulVrd1WJswRQXfukrKW','participant','Kevin.PASTEUR@cpnv.ch','Kevin','PASTEUR'),(196,'CRISTOFORI Joshua','$2y$10$rVs4J5hBsIc2dvj.FKRvrOZtMuzehCp9vElbjQNYCCmaADdSKKZ/G','participant','Joshua.CRISTOFORI@cpnv.ch','Joshua','CRISTOFORI'),(197,'SHEHI Kujtim','$2y$10$Jx749Hjp/4uHaYzSyc21EO.ifTZZiEbvG9wdHJK4LcDu2S89MKrGW','participant','Kujtim.SHEHI@cpnv.ch','Kujtim','SHEHI'),(198,'DOS-SANTOS Rafael','$2y$10$Z4Q7UOvFHmKne4RBvfrPreaJtB29VQS6J8Y9zIJ9ByV41lY/btG4u','participant','Rafael.DOS-SANTOS@cpnv.ch','Rafael','DOS-SANTOS'),(199,'BERNEY Dylan','$2y$10$rB7zYOCv6HY2nFNHRhzeKugojrY5WWaq0mT3uldpp0QqWR4iUfEN6','participant','Dylan.BERNEY@cpnv.ch','Dylan','BERNEY'),(200,'ALTIERI Patrick','$2y$10$0xXItyiDupoEFJVAqQDaKuF2fTtntzjTc7AC/X3R/66v4NoEoByte','participant','Patrick.ALTIERI@cpnv.ch','Patrick','ALTIERI'),(201,'BENZONANA Pascal','$2y$10$lE9o3ozOXF9bCCv4arYtGumoiWp6tFAao6m8CQCIV7DSE58G6P9xO','participant','Pascal.BENZONANA@cpnv.ch','Pascal','BENZONANA'),(202,'EMERY Bastien','$2y$10$41t4caxoT6p48RWtXpUGP.aFF2JSiOQIGjcbyJ2Wf42AkeNCEtHkS','participant','Bastien.EMERY@cpnv.ch','Bastien','EMERY'),(203,'MEMIC Amra','$2y$10$/kENvI2oNqn3HQlpYSvssu0UmZo3c1DAveBxgH5FsspxTXJ8GyGTu','participant','Amra.MEMIC@cpnv.ch','Amra','MEMIC'),(204,'GRABER Gwendal-Alexej','$2y$10$JQgKiMcWEVHn5hII.doPiecDN3rPCRBjhU9Jhh19pyYp1n8tGcLk.','participant','Gwendal-Alexej.GRABER@cpnv.ch','Gwendal-Alexej','GRABER'),(205,'SAHLI Luckas','$2y$10$k9.OuUYxxNGF9k91ZwxoqOFICODkHlXDvAbgRcXjDs0U5nci.VwAq','participant','Luckas.SAHLI@cpnv.ch','Luckas','SAHLI'),(206,'CLOT Ian','$2y$10$wqBUybjXQ5gDGjzh/GAPi.S.b8QMPS.7Tx6vxdE6Dl6xuHL3KmJN2','participant','Ian.CLOT@cpnv.ch','Ian','CLOT'),(207,'AYMONIER Gael','$2y$10$EuRA3PybC06wZ6a4/uugDeA2SlNN65d6tJrH.6BCSUupCrT4.tqy6','participant','Gael.AYMONIER@cpnv.ch','Gael','AYMONIER'),(208,'LOUREIRO Sam','$2y$10$AaUM955XXibPkmhZfdgflObzdOXbmXNIy2RJdvbEn8dZ25y4aQ3tq','participant','Sam.LOUREIRO@cpnv.ch','Sam','LOUREIRO'),(209,'FERREIRA-DANTAS Ricardo-Joao','$2y$10$W7y0konBFBTcGYc2frMEX.3WyQoN7pVOtajiEtx7gFHVkYAckHJUW','participant','Ricardo-Joao.FERREIRA-DANTAS@cpnv.ch','Ricardo-Joao','FERREIRA-DANTAS'),(210,'HASIC Elvedin','$2y$10$sJ5WqhLo4BG8hoG5vZ0Vv.Eow0JaB0KPlP.GtlMovqdoRLRqgymQC','participant','Elvedin.HASIC@cpnv.ch','Elvedin','HASIC'),(211,'BOLAY Estelle','$2y$10$wvRfyOI2kE.EsCLwXN/9YOH9hJwTgGaxouaQ1y9qTZcPTlIaEEpE2','participant','Estelle.BOLAY@cpnv.ch','Estelle','BOLAY'),(212,'JACCARD Yanick','$2y$10$klUmHDEYNoMaHftd0q/5A.c0.TmSypAmG6BwkNhiXfv2xyGih9PJm','participant','Yanick.JACCARD@cpnv.ch','Yanick','JACCARD'),(213,'SEMLALI Jihane','$2y$10$bVEs9LdWp5xzyH.JVphhZuIXVC4BZhwknqwRxvEAxz4uid6/eEcwW','participant','Jihane.SEMLALI@cpnv.ch','Jihane','SEMLALI'),(214,'AL-QUBLAN Hiba','$2y$10$BiMPdHG9N8id.E6G.tZNHeh7eyGm47wwY9m7zjuwRLHqJ75SZKnV6','participant','Hiba.AL-QUBLAN@cpnv.ch','Hiba','AL-QUBLAN'),(215,'EL-AAMELY Hamza','$2y$10$iwd6yADxbSdTm1mRDVoO/eg4mOuUzVIWWkXMuOj1QESDFSDETGm1.','participant','Hamza.EL-AAMELY@cpnv.ch','Hamza','EL-AAMELY'),(216,'SOARES Miguel','$2y$10$AlauHk43Dcl/rNixXJGUZeKv0I8B0GTwTFROfGKF8QI8XZnk55zDi','participant','Miguel.SOARES@cpnv.ch','Miguel','SOARES'),(217,'BLATTER Jan','$2y$10$nHBx01J3r8qNPISQawnofu7mVHq.KP6M2f1oeqA3uIhwLulXt/fPO','participant','Jan.BLATTER@cpnv.ch','Jan','BLATTER'),(218,'BOEHLER Ian','$2y$10$4PqMj36bGzYNfDzffmdt1OFwR9EYtAfTJ3/PCI/.o/A06lWfVOhcm','participant','Ian.BOEHLER@cpnv.ch','Ian','BOEHLER'),(219,'GRIESSEN Somchai','$2y$10$BC7UTQliB4u22Dl7uQNgj.wTSm.Y74NaW1ZpAOjwO1pHy9ILq/rSe','participant','Somchai.GRIESSEN@cpnv.ch','Somchai','GRIESSEN'),(220,'PINTO Jarod','$2y$10$2QJQp9O2eHx9esxPrA7pQ.F8Nviw1lzqoZhui5xFbUAOiJl5jcr2.','participant','Jarod.PINTO@cpnv.ch','Jarod','PINTO'),(221,'GIORGIS Esteban','$2y$10$JKZ4/PNFyPRD1dGrrWhMDOLBQgFGzskOPSPzG4xE0aYNDp7s./B1K','participant','Esteban.GIORGIS@cpnv.ch','Esteban','GIORGIS'),(222,'ESSEIVA Theo','$2y$10$ffALNd9oj.kSc9MPv3pzv.cjoeF3r4M93s7yPROLRkmxMLWeOBJHe','participant','Theo.ESSEIVA@cpnv.ch','Theo','ESSEIVA'),(223,'RUIZ-DE-PORRAS Ilan','$2y$10$A92WhnWSSuRMb0T9RXKoUOcwWNIG.KmkSEDWy9vxCS6ggyeIRggRi','participant','Ilan.RUIZ-DE-PORRAS@cpnv.ch','Ilan','RUIZ-DE-PORRAS'),(224,'GOMES-VAROSO David-Manuel','$2y$10$DHz4KUpXB6k2.6exdybzI.R2pGkeQHpv6Pc1zr9iwEeOyMDsCbpqG','participant','David-Manuel.GOMES-VAROSO@cpnv.ch','David-Manuel','GOMES-VAROSO'),(225,'ZURCHER Simon','$2y$10$BJBuwp4Io6xfFsljjTWI5uzcGBfzH3YEwysjZToiQ3VBd7j3746bq','participant','Simon.ZURCHER@cpnv.ch','Simon','ZURCHER'),(226,'ROGER Nyah-Mae','$2y$10$KhAoIfwFcja1YrTjQl20auBnatcfuqIfHjqot8ZilR7j4eUnky1ky','participant','Nyah-Mae.ROGER@cpnv.ch','Nyah-Mae','ROGER'),(227,'BERNEY Kevin','$2y$10$a78SlnfEx1zSQFNNfIPyjeBEFPbLiSULD.33hJa09nGXw.w5i0pwi','participant','Kevin.BERNEY@cpnv.ch','Kevin','BERNEY'),(228,'PEREIRA-RIOS-RUFINO Amanda','$2y$10$DmoDyiuzYyIUjt7orUTuMuL7kD3q5sCyFpUXmDcOB7E35HeaPKTm.','participant','Amanda.PEREIRA-RIOS-RUFINO@cpnv.ch','Amanda','PEREIRA-RIOS-RUFINO'),(229,'HENRY Nicolas','$2y$10$4PiUaMafUyGwV8SXh1lPDeCi3sLa7TeFnyjd2H6Ofdd4ll/fzb2M2','participant','Nicolas.HENRY@cpnv.ch','Nicolas','HENRY'),(230,'COURT Albert','$2y$10$nN8Q9nbnpQtEcic86yr1SefwaAe3QmY2La2lfsG38YdoX1LDxSWba','participant','Albert.COURT@cpnv.ch','Albert','COURT'),(231,'WILLOMMET Dario','$2y$10$wfjG8d4QLu6wmcLBTtavGODT/MHVE.ZyZrbyNYVpGg01wlFiVxC92','participant','Dario.WILLOMMET@cpnv.ch','Dario','WILLOMMET'),(232,'MOTTAY Gwendal','$2y$10$uks6r7XKD.Yksbi2prZXYOzszMEZpXqWxE/t/DbhlsNUNTH870TNe','participant','Gwendal.MOTTAY@cpnv.ch','Gwendal','MOTTAY'),(233,'MONDAINI Damiano','$2y$10$1DYlP09bUd3xENEjnhOJXugzN1wcSHryhM9qWfVJ.i5dWOZ7ckp3e','participant','Damiano.MONDAINI@cpnv.ch','Damiano','MONDAINI'),(234,'HANGGELI Marielle','$2y$10$SJUj.bpmG4bGDUSvzPtoT.3TKSKmGMKMSe6/Lr2yGGcmrbWhgL1Jm','participant','Marielle.HANGGELI@cpnv.ch','Marielle','HANGGELI'),(235,'KAYOUMI Doran','$2y$10$7tWwUEeb1HkBiji.DAk23ePLS3E8AJR.rafuVVcsT.RmPmLHAlOAG','participant','Doran.KAYOUMI@cpnv.ch','Doran','KAYOUMI'),(236,'DEBOSSENS Kendrick','$2y$10$WyVN0EpR3McCP4bmcJah.OXMTS1N.O8sE4x7EmQ.SlPfQUtIPFCwO','participant','Kendrick.DEBOSSENS@cpnv.ch','Kendrick','DEBOSSENS'),(237,'SCHMUTZ Robin','$2y$10$C8hKGQJVcMUbOXQab1uenOAvNADOV6WMkAhXuIfVd/WDnCe8gdIlG','participant','Robin.SCHMUTZ@cpnv.ch','Robin','SCHMUTZ'),(238,'RAZIC Almir','$2y$10$L6cUQUi9/JuHtpt8bzqazuPGX6JEFg0p1dYL.l3Nfhp7s6nbNU4Vu','participant','Almir.RAZIC@cpnv.ch','Almir','RAZIC'),(239,'VON-KAENEL Corentin','$2y$10$a1a2DH5amopPJLKBDYi5LO7tFTueQ5Gj2AoG4xVbKSQP2w1n1ej8e','participant','Corentin.VON-KAENEL@cpnv.ch','Corentin','VON-KAENEL'),(240,'ONRUBIA Romain','$2y$10$p63mXdCP3eqyoVIsxK.C0u6.moJpBd1Ne/iM3U6Jgc9GkXcIitUha','participant','Romain.ONRUBIA@cpnv.ch','Romain','ONRUBIA'),(241,'JACCARD Anthony','$2y$10$.G//Jrpe9NDCpTOIGw84p.wrRuLjEihAtW/SGop8dUsRTEsSURo5O','participant','Anthony.JACCARD@cpnv.ch','Anthony','JACCARD'),(242,'REEVE Paul','$2y$10$3mNP7Fnr4CwJ2E3khF7PguBGMtzcY05xoAUPIPCG/gO.ezwT8Pd5u','participant','Paul.REEVE@cpnv.ch','Paul','REEVE'),(243,'FERREIRA-OLIVEIRA Tiago-Manuel','$2y$10$u3xVvN7vxr0nUrIk7vEjduiCjRoy7qsUkUWETM4oD//faVsRPGXKG','participant','Tiago-Manuel.FERREIRA-OLIVEIRA@cpnv.ch','Tiago-Manuel','FERREIRA-OLIVEIRA'),(244,'REUTELER Robin','$2y$10$y5JSgrEI7RjF/K/SJyezpepZl6scUjZgS235luG0AxmpyAr6tn.Xy','participant','Robin.REUTELER@cpnv.ch','Robin','REUTELER'),(245,'RENOULT Mathias','$2y$10$5A4KTfirVgp3s0Gka1/xrO2PV84UHKFdhzfj8RhIBLqT02T073gdu','participant','Mathias.RENOULT@cpnv.ch','Mathias','RENOULT'),(246,'HUGUET Thomas','$2y$10$/GPGehxpA.mCbnEqbnA8.eplU7JHJ3caGeEQH/EuGL3l0QkoUVYHO','participant','Thomas.HUGUET@cpnv.ch','Thomas','HUGUET'),(247,'BASAIA Maurine','$2y$10$lD5G3S4cI2Gk97SZA9J7GOaOrC43Q2fCIK.aSQz2vOn6I2gzjW95O','participant','Maurine.BASAIA@cpnv.ch','Maurine','BASAIA'),(248,'RYSER Florent','$2y$10$ZGMSPCMxs7taURz9DAWZyueNM8EkO9iGafjWxdfyHSxlJYTfLN/Ba','participant','Florent.RYSER@cpnv.ch','Florent','RYSER'),(249,'HALDI Diego','$2y$10$PZU33yhdcw22MzFEwWqKU.A1bFvvgBz6bHX5FS.W19JFeyaDBQqJ6','participant','Diego.HALDI@cpnv.ch','Diego','HALDI'),(250,'BASSI Luca','$2y$10$bvC8zdL8xgrbCGhjwHuJ3edLJ.ZiYJc.mNgZQUtXkYUgkPSF5u/0y','participant','Luca.BASSI@cpnv.ch','Luca','BASSI'),(251,'AMEZ Luca','$2y$10$8WRNDS33e/pR2WqkXdNFy.dzcDG9kUNaVSle8mttBiy93qphV43kW','participant','Luca.AMEZ@cpnv.ch','Luca','AMEZ'),(252,'ALLEGRO Paul','$2y$10$507Aq.fofjn8Awaml4N9euhf.r.4TQ.TnuT6x6mtkH.lMVk5f1OWq','participant','Paul.ALLEGRO@cpnv.ch','Paul','ALLEGRO'),(253,'NYDEGGER Marc-Andre','$2y$10$rSQ97pfrHpxk.lpiqawf8.IZ5QYZEFvJ6i.nLSMcQQpv0cNMrknU2','participant','Marc-Andre.NYDEGGER@cpnv.ch','Marc-Andre','NYDEGGER'),(254,'FATHI Rim','$2y$10$lHq90mzXOkW69fMOTvP6SOh9jtFy.YOCMUFmuh4RNFUbpysKm03V6','participant','Rim.FATHI@cpnv.ch','Rim','FATHI'),(255,'GLASSEY Nicolas','$2y$10$g6nV2E7HJHqa.ivBcH9H6uNy.fGzOpmP1iGWhQbTk2qiiHiMYWTSi','participant','Nicolas.GLASSEY@cpnv.ch','Nicolas','GLASSEY'),(256,'BERSET Julien','$2y$10$sTCXarctnfk5dTdmbQE/Vu1iTV.JxT4ltptqyTK3Ofu8JKPm40yxG','participant','Julien.BERSET@cpnv.ch','Julien','BERSET'),(257,'PAGE Antoine','$2y$10$hMBneW.LVlSzstGAUsVdDe/VCjDq2iYAUHmWvoQq99//JhXId.9mi','participant','Antoine.PAGE@cpnv.ch','Antoine','PAGE'),(258,'TEIXEIRA Kevin','$2y$10$bT3w7nE4b.baZaSfuF9blOawDcCVbU.BjnMn/Hle2.xOP/iW9Kttu','participant','Kevin.TEIXEIRA@cpnv.ch','Kevin','TEIXEIRA'),(259,'KAELIN Nicolas','$2y$10$9RpZ9jYoaw6DLyrSWOT35eBVJEr/fP51LHQgZOC1OcjDKLrg7awjW','participant','Nicolas.KAELIN@cpnv.ch','Nicolas','KAELIN'),(260,'FERATI Arben','$2y$10$W5/jsKqtA1XbRWdmKzncAuYMkgZkVUVCVgWDHa3hLSaJz1/Oi8wai','participant','Arben.FERATI@cpnv.ch','Arben','FERATI'),(261,'RAYBURN Nathan','$2y$10$qUs0GisAHT2xELV822BToOMzR8HtvG9/uAVCzjkYzN7clGtjHqoG2','participant','Nathan.RAYBURN@cpnv.ch','Nathan','RAYBURN'),(262,'ROCHAT Alexandre','$2y$10$N/sDJbrHOeY6hsMcn3eHRuSymGmBWvItRamB8eoOtIOlZN28ffck2','participant','Alexandre.ROCHAT@cpnv.ch','Alexandre','ROCHAT'),(263,'SCHAER Thierry','$2y$10$Eg9Xx7DZKGUC09AIsnUUue3nzoW.Vg4QeZdGZpyFnCjdXrtyxGI26','participant','Thierry.SCHAER@cpnv.ch','Thierry','SCHAER'),(264,'PERRONE Giovanni','$2y$10$lTKd1WPOyH5..yWfhUaRFOwIqBwffSK1dQJPO2w1ADsZbdVgkWEuS','participant','Giovanni.PERRONE@cpnv.ch','Giovanni','PERRONE'),(265,'SILVESTRI Cedric','$2y$10$p0Q.TmJ39EMiCRlCVaLO2unFNWw.d2cbwxSanIiuMbr/MpMUC5dPe','participant','Cedric.SILVESTRI@cpnv.ch','Cedric','SILVESTRI'),(266,'LACRABERE Onna','$2y$10$IckXmdoaJnR9Xke6yGaek.LxnPjlcQD18R2D4g3ApCw1aAF/zIgCy','participant','Onna.LACRABERE@cpnv.ch','Onna','LACRABERE'),(267,'NICOLLERAT Alwyn','$2y$10$H2wRG.Q0mi7PZ/lnCBw0YeO9BYAVQYu9EztBUaDF7Nfb.pYFPeqUW','participant','Alwyn.NICOLLERAT@cpnv.ch','Alwyn','NICOLLERAT'),(268,'GRANDJEAN Sebastien','$2y$10$wh3hoY0Q5aPc91n0cR455uwk6F3QLKDqFm6FUscRXAxw4srJUqXEy','participant','Sebastien.GRANDJEAN@cpnv.ch','Sebastien','GRANDJEAN'),(269,'JAKAJ Valdrin','$2y$10$OFNce9ltDcEl.EYg2c6hf.GFnjF622XDRuUc7IiwrchNrTkXEmHUW','participant','Valdrin.JAKAJ@cpnv.ch','Valdrin','JAKAJ'),(270,'LEHMANN Anthony','$2y$10$1qud2Dsa98z6EcsZhMzDq..cCqaJwqjlZ1MIck/ZOH.2eL9rdSyk6','participant','Anthony.LEHMANN@cpnv.ch','Anthony','LEHMANN'),(271,'JULIA-FLACH Amandine','$2y$10$/e7TcY2aDK.Osb9OWNblC.j0Ywl5s24IvBUEUhNT.Xvt1TVANpL1e','participant','Amandine.JULIA-FLACH@cpnv.ch','Amandine','JULIA-FLACH'),(272,'DAPIA Axel','$2y$10$TMidAVNo/n99VcjBWlmcCu65rRmqD/XIOo5pDw5EApZf1Nc/Tke9q','participant','Axel.DAPIA@cpnv.ch','Axel','DAPIA'),(273,'GROBET Ewan','$2y$10$P0ruhvZ0bDcIh6Z42UI/lOusEuB6IVkirz0OCwaRWKG3OLB22T7Sa','participant','Ewan.GROBET@cpnv.ch','Ewan','GROBET'),(274,'ANGULO-MUNOZ Cristopher-Joel','$2y$10$U17QAPBYNWy.R7V1K3sNTesQPzRU3ej9.R2c7ZBDwd2loo9qWyq0y','participant','Cristopher-Joel.ANGULO-MUNOZ@cpnv.ch','Cristopher-Joel','ANGULO-MUNOZ'),(275,'COHADAREVIC Muamer','$2y$10$CEoFRnjY7ocDOAAKJhn78eRAOMTSrA./dEyjlt9SrR7pBDMBQFcJS','participant','Muamer.COHADAREVIC@cpnv.ch','Muamer','COHADAREVIC'),(276,'MONTEIRO-DA-VEIGA Edmilson','$2y$10$t/.z8o6krRj6A1/Rm3ktHOs2cXNi7p3aHhSTuBWvXu3B52FyzG.Fu','participant','Edmilson.MONTEIRO-DA-VEIGA@cpnv.ch','Edmilson','MONTEIRO-DA-VEIGA'),(277,'TEKLEHAIMANOT Samson','$2y$10$3YnmvoMmDrIeoKMyOFL4YONFLI1EubU4kwjnWFAJHLxCPO2EPnk2O','participant','Samson.TEKLEHAIMANOT@cpnv.ch','Samson','TEKLEHAIMANOT'),(278,'BROCH William','$2y$10$z7szgSWJ2c/TbN475WgLUubKv18skEUx/jIorDJrnCEhVe/SkpxdK','participant','William.BROCH@cpnv.ch','William','BROCH'),(279,'DALLA-PIAZZA Hugo','$2y$10$TtqdV6yJcMKgmzj6P39iQOe5Zw/WpH1k7VD4HgkQPkAvxeVoD7aqm','participant','Hugo.DALLA-PIAZZA@cpnv.ch','Hugo','DALLA-PIAZZA'),(280,'NASSER-KASSEM Ali','$2y$10$Y/EHHyLCLZlKYuhJb8O8e.1jhUU1l4OgZPEDtp.dAN7stzD6VtAha','participant','Ali.NASSER-KASSEM@cpnv.ch','Ali','NASSER-KASSEM'),(281,'DUARTE-CORREIA Rafael','$2y$10$yPta/RuxyB/2PdE55K9HoOUaI9B7zD9j4oQMBZcv60BaoA/hIApca','participant','Rafael.DUARTE-CORREIA@cpnv.ch','Rafael','DUARTE-CORREIA'),(282,'MABIKI Ida-Maeva','$2y$10$9FDdlZ7YDkLx1iCsovi86eTs1w9KwkMpVhYCyWkJpkEarnfXnkXk.','participant','Ida-Maeva.MABIKI@cpnv.ch','Ida-Maeva','MABIKI'),(283,'GORGERAT Lisa','$2y$10$mBrwfIdyJINubLa5oD.CpO8a7QK7sjWmTBLmPVn3nXxJYfDRryinm','participant','Lisa.GORGERAT@cpnv.ch','Lisa','GORGERAT'),(284,'LEUZINGER Mark','$2y$10$MzOqfGKO7tswVIop2tWdIuFp.W8NSKmXYf7G0V8Alsg/fD5BCl5/m','participant','Mark.LEUZINGER@cpnv.ch','Mark','LEUZINGER'),(285,'DOS-SANTOS-MATIAS Joel','$2y$10$sS/SqakVynB4W8QsVLre7.l3hLrPmnOvfoojW9UT/Ymu5uTCak0r2','participant','Joel.DOS-SANTOS-MATIAS@cpnv.ch','Joel','DOS-SANTOS-MATIAS'),(286,'DECOPPET Joris','$2y$10$9Wmos.jBgDJq1LWgaMbty.CpfLn5r0OZjrCvQ9Hqdqnak8EU2dQ7C','participant','Joris.DECOPPET@cpnv.ch','Joris','DECOPPET'),(287,'GRACI Tenzing','$2y$10$uD6QBX03COmoklLxVONTJOcTqMgTJ.Bih9NZ/SZ.cSk.pOalGYNNy','participant','Tenzing.GRACI@cpnv.ch','Tenzing','GRACI'),(288,'RICCI Thomas','$2y$10$MhHludrw.0CDGd3B0nUnku3elncIuL5rH9DdTIdfc4eQBH1FSAX7i','participant','Thomas.RICCI@cpnv.ch','Thomas','RICCI'),(289,'FERREIRA David','$2y$10$R/fv4vWcqaku.1gHD2vd6uigZ7CF8e9wV52.feVTdsk5jSovid04K','participant','David.FERREIRA@cpnv.ch','David','FERREIRA'),(290,'HOFER Michael','$2y$10$3tESB5PtqoUIt13V/msylesDOTxR2xlerQg11wdBi9wET9vMJbore','participant','Michael.HOFER@cpnv.ch','Michael','HOFER'),(291,'CARREL Xavier','$2y$10$gej1x.1gR8Ct.KNhnrIl5.VXVnZFYWPE4zrAG/YrjGxoO8OV5qCxy','participant','Xavier.CARREL@cpnv.ch','Xavier','CARREL'),(292,'COSTA-CRISTOFANO Dylan','$2y$10$XR4XmPyDMyXBgZfpEMXKrOOvwQE6GZSQXFD1B8d5W6YqNo9xexhMm','participant','Dylan.COSTA-CRISTOFANO@cpnv.ch','Dylan','COSTA-CRISTOFANO'),(293,'GENDROZ Gaetan','$2y$10$E8QBzQbQwAQwdJS.jrxWz.buxUCcqADECOV5CcIrJ6dUCOIo2MS56','participant','Gaetan.GENDROZ@cpnv.ch','Gaetan','GENDROZ'),(294,'ANDREY Cassandra-Daisy','$2y$10$wmPiRhlXp1qKxeNF7MhiHOWA93VQa0uHxs75EL5EpoHjkYXLwV1xa','participant','Cassandra-Daisy.ANDREY@cpnv.ch','Cassandra-Daisy','ANDREY'),(295,'JACCARD Colette','$2y$10$yRcrmhR8sU.1JP6IpRGs7uRWXPZA8O.4vV.WdGba6IXeamO2bjkl2','participant','Colette.JACCARD@cpnv.ch','Colette','JACCARD'),(296,'FAVRE Raphael','$2y$10$BqPKqzw0garElqhyF5ZBJuBj5uB7.baYrVNBcN0MvgETVZYol2m2O','participant','raphael.favre@cpnv.ch','Raphael','FAVRE'),(297,'AUGSBURGER Benoit','$2y$10$moiIy8Wm34rgUH4TtkIaW..QoFRS/u6ejKmlaVcEvbu6lrAcI2.O.','participant','Benoit.AUGSBURGER@cpnv.ch','Benoit','AUGSBURGER'),(298,'RODRIGUEZ Alexandre','$2y$10$bKjXrZbzi5yBF7NrOpkIHOqTnkliE.3aam/4v8DBKymaNikRZcO22','participant','Alexandre.RODRIGUEZ@cpnv.ch','Alexandre','RODRIGUEZ'),(299,'SIDLER Sylvain','$2y$10$rCwIAbCYz4klfwzTy0Y95e.UoFPuobBhbPnnQVHBznYwxW4kz0Y/a','participant','Sylvain.SIDLER@cpnv.ch','Sylvain','SIDLER'),(300,'PIEREN Alyssa','$2y$10$chZp8p1sz8oOfcLdwgV8sOan5g6I8SaTvtSX7o4/zENmOzIMfmFQq','participant','Alyssa.PIEREN@cpnv.ch','Alyssa','PIEREN'),(301,'RODRIGUES-FRAGA Brian','$2y$10$U1JCrHCgptlLJbXPAi/oy.0ZbDdffKpMBSubIRNZneAJUKGPqMRoK','participant','Brian.RODRIGUES-FRAGA@cpnv.ch','Brian','RODRIGUES-FRAGA'),(302,'TRADER Sebastien','$2y$10$Iw8NelcskINNlXGVqf4Ww.xchPgw8WIjCe/zaIIitgFYzB.jr2igC','participant','Sebastien.TRADER@cpnv.ch','Sebastien','TRADER'),(303,'ZURBRUGG Yann','$2y$10$f7UcHG0lKZmCY5cfSCjFM.kBA/skEz0lzOtcKDFOsMhW4hYhv5Avm','participant','Yann.ZURBRUGG@cpnv.ch','Yann','ZURBRUGG'),(304,'HALIMI Diamant','$2y$10$lg6WA61LdzvcwIWA.yUV.uAuQrnOUqZS3KhH1YokuErqVsglqAjRi','participant','Diamant.HALIMI@cpnv.ch','Diamant','HALIMI'),(305,'GOMES-SEMEDO Roberto','$2y$10$ImBoNaiiJy54USoLIXSxqO06Lm7yLkx0Q1MocpOvIG4ZfTW4fGUlu','participant','Roberto.GOMES-SEMEDO@cpnv.ch','Roberto','GOMES-SEMEDO'),(306,'ALI-DUALE Mohamed','$2y$10$xdRx5gjDam3Cf61FL0GEduUORGHX2xsne0wMc8kQOAsz.V7I6wJKq','participant','Mohamed.ALI-DUALE@cpnv.ch','Mohamed','ALI-DUALE'),(307,'JAKOB Damien','$2y$10$gVJsHU9d5DeLs2mPmyhbseE10sDXVXy.UKsanzRRTmg96KnvAK9LC','participant','Damien.JAKOB@cpnv.ch','Damien','JAKOB'),(308,'NEYRET Antony','$2y$10$mCLvVxjMEPJL05JsPVYzv.hOaywKCbuczXjWfB9Jt/SNYnx2QaLki','participant','Antony.NEYRET@cpnv.ch','Antony','NEYRET'),(309,'VESCO Matthias','$2y$10$jlhzhTcQ68/9D90A.4hS2eatx7bZaqLE8yPhTUOiPNhbQsHKNakkG','participant','Matthias.VESCO@cpnv.ch','Matthias','VESCO'),(310,'GOLAY Maxim','$2y$10$zB25EgT/YslstYO5MttC0uENkRHbRjgPI9vcZZi91PTorxOv0LiaK','participant','Maxim.GOLAY@cpnv.ch','Maxim','GOLAY'),(311,'ROGIVUE Yohann','$2y$10$.mvz9aaVEVZUUJwGgYu/aOu6XvHUtmYmmlmqxcEAWMjNK7uvSIVQe','participant','Yohann.ROGIVUE@cpnv.ch','Yohann','ROGIVUE'),(312,'WYSSA Michael','$2y$10$BglSp9YOLwmW6bmBLSeNKeDyUE0iR40kUy34nohxAI2oNUFDSNWZy','participant','Michael.WYSSA@cpnv.ch','Michael','WYSSA'),(313,'JUNOD Stephane','$2y$10$FxB3wSa5XXLJvIaLVkylYu5divaC0b2rt4R2aKHSMoG5VBDJgxS5y','participant','Stephane.JUNOD@cpnv.ch','Stephane','JUNOD'),(314,'MARTINS-MAIA-CORREIA Afonso-Miguel','$2y$10$okPYlupRi7pu2ROBAt5CyOifEcz5vE8KXvi/V3Nmybh4UBwGcoHAS','participant','Afonso-Miguel.MARTINS-MAIA-CORREIA@cpnv.ch','Afonso-Miguel','MARTINS-MAIA-CORREIA'),(315,'BASSETTI Svan','$2y$10$r1zUB2BWWMWcwAz.zcbDt.voFTyR8RYDE5vmVHV/Vo.wsbgQJhM96','participant','Svan.BASSETTI@cpnv.ch','Svan','BASSETTI'),(316,'TESFAZGI Aron','$2y$10$4C5cNR92cHWYelNbt6ELBOETk8rDyyIDPfxVOo77k44yOdJP2RDYu','participant','Aron.TESFAZGI@cpnv.ch','Aron','TESFAZGI'),(317,'ZWIETNIG Loel','$2y$10$ZdWaBMs7.ZWHLu6mO7Ty9u5LHEGKoyQm6fXnu2zJOOlokLXh3PTS2','participant','Loel.ZWIETNIG@cpnv.ch','Loel','ZWIETNIG'),(318,'DELACOMBAZ Benjamin','','participant','Benjamin.DELACOMBAZ@cpnv.ch','Benjamin','DELACOMBAZ'),(319,'GFELLER Jeremy','','participant','Jeremy.GFELLER@cpnv.ch','Jeremy','GFELLER'),(320,'JEGARAJASINGAM Senistan','','participant','Senistan.JEGARAJASINGAM@cpnv.ch','Senistan','JEGARAJASINGAM'),(321,'ROSSIER Quentin','','participant','Quentin.ROSSIER@cpnv.ch','Quentin','ROSSIER'),(322,'GERMANN Niels','','participant','Niels.GERMANN@cpnv.ch','Niels','GERMANN'),(323,'AVELINO Steven','','participant','Steven.AVELINO@cpnv.ch','Steven','AVELINO');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-15 17:56:21
