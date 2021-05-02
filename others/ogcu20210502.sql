CREATE DATABASE  IF NOT EXISTS `ogcu` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ogcu`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: ogcu
-- ------------------------------------------------------
-- Server version	5.6.26-log

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
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(2) NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'A','Ciencias e Ingenieria'),(2,'B','Ciencias de la Salud'),(3,'D','Ciencias Sociales y Politicas'),(4,'C','Ciencias Economicas');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clasifications`
--

DROP TABLE IF EXISTS `clasifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clasifications` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `student_data_id` mediumint(9) NOT NULL,
  `courses_id` int(11) NOT NULL,
  `status_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_clasifications_student_data1_idx` (`student_data_id`),
  KEY `fk_clasifications_courses1_idx` (`courses_id`),
  KEY `fk_clasifications_status1_idx` (`status_id`),
  CONSTRAINT `fk_clasifications_courses1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_clasifications_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_clasifications_student_data1` FOREIGN KEY (`student_data_id`) REFERENCES `student_data` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clasifications`
--

LOCK TABLES `clasifications` WRITE;
/*!40000 ALTER TABLE `clasifications` DISABLE KEYS */;
INSERT INTO `clasifications` VALUES (3,1,1,1),(4,1,2,3),(5,1,3,3),(6,2,1,1),(7,2,2,2),(8,2,3,3),(9,2,7,2),(10,2,8,2),(11,3,1,2),(12,3,2,2),(13,3,7,2),(14,3,8,2),(15,3,3,2),(16,4,1,1),(17,4,2,2),(18,4,3,1),(19,4,7,3),(20,4,8,3),(21,5,1,2),(22,5,2,2),(23,5,3,3),(24,5,4,3),(25,5,5,3),(26,5,6,2),(27,6,1,3),(28,6,2,2),(29,6,3,3),(30,6,4,2),(31,6,5,2),(32,6,6,1),(33,7,1,1),(34,7,2,3),(35,7,3,3),(36,7,4,2),(37,7,5,1),(38,7,6,1),(39,8,1,3),(40,8,2,2),(41,8,3,3),(42,8,4,3),(43,8,5,1),(44,8,6,3),(45,9,1,1),(46,9,2,2),(47,9,3,3),(48,9,4,3),(49,9,5,1),(50,9,6,2),(51,10,1,1),(52,10,2,3),(53,10,3,3),(54,10,4,2),(55,10,5,1),(56,10,6,1),(57,11,1,2),(58,11,2,3),(59,11,3,1),(60,11,7,2),(61,11,8,3);
/*!40000 ALTER TABLE `clasifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `dimensions_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_courses_dimensions1_idx` (`dimensions_id`),
  CONSTRAINT `fk_courses_dimensions1` FOREIGN KEY (`dimensions_id`) REFERENCES `dimensions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'Razonamiento Lógico Matemático',1),(2,'Razonamiento Verbal',1),(3,'Aritmética',2),(4,'Algebra',2),(5,'Lenguaje',3),(6,'Literatura',3),(7,'Historia Universal',4),(8,'Historia del Peru',4),(9,'Economía',4),(10,'Gramatica',3),(11,'Geometria',2),(12,'Trigonometria',2),(13,'Geografia',4),(14,'Psicologia',5),(15,'Cultura General',5),(16,'Educacion Civica',5),(17,'Cultura Regional y Local',5),(18,'Fisica',6),(19,'Quimica',6),(20,'Biologia',6),(21,'Educacion Ambiental',6);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dimensions`
--

DROP TABLE IF EXISTS `dimensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dimensions` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dimensions`
--

LOCK TABLES `dimensions` WRITE;
/*!40000 ALTER TABLE `dimensions` DISABLE KEYS */;
INSERT INTO `dimensions` VALUES (1,'Aptitud Academica'),(2,'Matematica'),(3,'Comunicacion'),(4,'Ciencias Sociales'),(5,'Persona Familia'),(6,'CTA');
/*!40000 ALTER TABLE `dimensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distributions`
--

DROP TABLE IF EXISTS `distributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dfrom` tinyint(4) NOT NULL,
  `dto` tinyint(4) NOT NULL,
  `areas_id` tinyint(4) NOT NULL,
  `courses_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `areas_id` (`areas_id`),
  KEY `courses_id` (`courses_id`),
  CONSTRAINT `distributions_ibfk_1` FOREIGN KEY (`areas_id`) REFERENCES `areas` (`id`),
  CONSTRAINT `distributions_ibfk_2` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distributions`
--

LOCK TABLES `distributions` WRITE;
/*!40000 ALTER TABLE `distributions` DISABLE KEYS */;
INSERT INTO `distributions` VALUES (1,1,15,1,1),(2,16,30,1,2),(3,31,36,1,3),(4,37,42,1,4),(5,43,48,1,11),(6,49,53,1,12),(7,54,56,1,5),(8,57,59,1,10),(9,60,61,1,6),(10,62,63,1,14),(11,64,65,1,15),(12,66,66,1,16),(13,67,68,1,17),(14,69,70,1,7),(15,71,72,1,8),(16,73,74,1,13),(17,75,76,1,9),(18,77,84,1,18),(19,85,92,1,19),(20,93,97,1,20),(21,98,100,1,21),(22,1,15,2,1),(23,16,30,2,2),(24,31,33,2,3),(25,34,36,2,4),(26,37,38,2,11),(27,39,40,2,12),(28,41,43,2,5),(29,44,46,2,10),(30,47,48,2,6),(31,49,52,2,14),(32,53,56,2,15),(33,57,58,2,16),(34,59,62,2,17),(35,63,65,2,7),(36,66,68,2,8),(37,69,71,2,13),(38,72,73,2,9),(39,74,75,2,18),(40,76,84,2,19),(41,85,97,2,20),(42,98,100,2,21),(43,1,15,3,1),(44,16,30,3,2),(45,31,36,3,3),(46,37,42,3,4),(47,43,46,3,11),(48,47,48,3,12),(49,49,51,3,5),(50,52,54,3,10),(51,55,56,3,6),(52,57,58,3,14),(53,59,61,3,15),(54,62,64,3,16),(55,65,67,3,17),(56,68,72,3,7),(57,73,77,3,8),(58,78,82,3,13),(59,83,91,3,9),(60,92,93,3,18),(61,94,95,3,19),(62,96,97,3,20),(63,98,100,3,21),(64,1,15,4,1),(65,16,30,4,2),(66,31,32,4,3),(67,33,34,4,4),(68,35,35,4,11),(69,36,36,4,12),(70,37,43,4,5),(71,44,50,4,10),(72,51,57,4,6),(73,58,61,4,14),(74,62,65,4,15),(75,66,69,4,16),(76,70,73,4,17),(77,74,78,4,7),(78,79,83,4,8),(79,84,87,4,13),(80,88,91,4,9),(81,92,93,4,18),(82,94,95,4,19),(83,96,97,4,20),(84,98,100,4,21);
/*!40000 ALTER TABLE `distributions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genders`
--

DROP TABLE IF EXISTS `genders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genders` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `gender` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genders`
--

LOCK TABLES `genders` WRITE;
/*!40000 ALTER TABLE `genders` DISABLE KEYS */;
INSERT INTO `genders` VALUES (1,'Femenino'),(2,'Masculino');
/*!40000 ALTER TABLE `genders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historic`
--

DROP TABLE IF EXISTS `historic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `minimun` tinyint(4) NOT NULL,
  `recommended` tinyint(4) NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ranks_id` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historic_ranks1_idx` (`ranks_id`),
  CONSTRAINT `fk_historic_ranks1` FOREIGN KEY (`ranks_id`) REFERENCES `ranks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historic`
--

LOCK TABLES `historic` WRITE;
/*!40000 ALTER TABLE `historic` DISABLE KEYS */;
INSERT INTO `historic` VALUES (2,50,67,'2021-04-20 04:24:41',1),(3,50,70,'2021-04-22 04:07:45',3);
/*!40000 ALTER TABLE `historic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) NOT NULL,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `genders_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  KEY `fk_people_genders1_idx` (`genders_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES (1,'03234567','Luisa Victoria','McAllister Fauler',1),(2,'12345693','David Enrique','Huaman Leyva',2),(3,'91234567','Lindsey','Harrison',1),(4,'01234567','Juan','Flores',2),(5,'11234567','Carlos','Castillo',2),(6,'21234567','Pedro','Montana',2),(7,'31234567','Andrea','Guerrero',1),(8,'41234567','Paola','Caceres',1),(9,'51234567','Federico','Lopez',2),(10,'61234567','Luciana','Ruiz',1),(11,'71234567','Simon','Sanchez',2),(12,'81234567','Ruperto','Alvarado',2),(14,'02234567','Andre','Guimaraez',2),(15,'78963214','Charly','Harper',2);
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `process`
--

DROP TABLE IF EXISTS `process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `process` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process`
--

LOCK TABLES `process` WRITE;
/*!40000 ALTER TABLE `process` DISABLE KEYS */;
INSERT INTO `process` VALUES (3,'2015-II'),(2,'2018-I'),(1,'2018-II');
/*!40000 ALTER TABLE `process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programs` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `areas_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_programs_areas1_idx` (`areas_id`),
  CONSTRAINT `fk_programs_areas1` FOREIGN KEY (`areas_id`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programs`
--

LOCK TABLES `programs` WRITE;
/*!40000 ALTER TABLE `programs` DISABLE KEYS */;
INSERT INTO `programs` VALUES (1,'Ingenieria Civil',1),(2,'Ingenieria de Sistemas e Informatica',1),(3,'Ingenieria de Minas',1),(4,'Enfermeria',2),(5,'Ingenieria Sanitaria',1);
/*!40000 ALTER TABLE `programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `number` tinyint(4) NOT NULL,
  `student_data_id` mediumint(9) NOT NULL,
  `responses_id` tinyint(4) NOT NULL,
  `distributions_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_questions_student_data1_idx` (`student_data_id`),
  KEY `fk_questions_responses1_idx` (`responses_id`),
  KEY `fk_questions_distributions1_idx` (`distributions_id`),
  CONSTRAINT `fk_questions_responses1` FOREIGN KEY (`responses_id`) REFERENCES `responses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_student_data1` FOREIGN KEY (`student_data_id`) REFERENCES `student_data` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=357 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,1,1,1),(2,2,1,1,1),(3,3,1,2,1),(4,4,1,1,1),(5,5,1,1,1),(6,6,1,1,1),(7,7,1,2,1),(8,8,1,1,1),(9,9,1,2,1),(10,10,1,3,1),(11,11,1,3,1),(12,12,1,1,1),(13,13,1,1,1),(14,14,1,2,1),(15,15,1,2,1),(16,16,1,1,2),(17,17,1,1,2),(18,18,1,1,2),(19,19,1,1,2),(20,20,1,3,2),(21,1,2,1,22),(22,2,2,1,22),(23,3,2,2,22),(24,4,2,1,22),(25,5,2,2,22),(26,6,2,3,22),(27,7,2,1,22),(28,10,2,1,22),(29,11,2,2,22),(30,16,2,3,23),(31,18,2,3,23),(32,19,2,3,23),(33,23,2,3,23),(34,25,2,1,23),(35,26,2,1,23),(36,27,2,1,23),(37,30,2,2,23),(38,31,2,1,24),(39,33,2,2,24),(40,34,2,1,25),(41,100,3,1,42),(42,99,3,1,42),(43,98,3,1,42),(44,97,3,1,41),(45,96,3,1,41),(46,95,3,2,41),(47,94,3,2,41),(48,93,3,3,41),(49,92,3,3,41),(50,91,3,1,41),(51,90,3,3,41),(52,89,3,1,41),(53,88,3,2,41),(54,87,3,1,41),(55,86,3,2,41),(56,85,3,2,41),(57,84,3,3,40),(58,83,3,3,40),(59,82,3,1,40),(60,81,3,1,40),(61,80,3,1,40),(62,79,3,1,40),(63,1,4,1,22),(64,2,4,2,22),(65,3,4,3,22),(66,4,4,1,22),(67,5,4,1,22),(68,6,4,1,22),(69,7,4,1,22),(70,8,4,1,22),(71,9,4,1,22),(72,10,4,1,22),(73,11,4,1,22),(74,12,4,1,22),(75,13,4,1,22),(76,14,4,2,22),(77,15,4,3,22),(78,16,4,1,23),(79,17,4,1,23),(80,18,4,2,23),(81,19,4,3,23),(82,20,4,3,23),(83,21,4,3,23),(84,22,4,2,23),(85,23,4,3,23),(86,24,4,2,23),(87,25,5,1,2),(88,26,5,2,2),(89,27,5,3,2),(90,28,5,1,2),(91,29,5,2,2),(92,30,5,3,2),(93,31,5,1,3),(94,32,5,1,3),(95,33,5,1,3),(96,34,5,2,3),(97,35,5,2,3),(98,36,5,3,3),(99,37,5,1,4),(100,38,5,1,4),(101,39,5,1,4),(102,40,5,2,4),(103,41,5,3,4),(104,42,5,1,4),(105,43,5,2,5),(106,44,5,2,5),(107,45,5,3,5),(108,46,5,1,5),(109,47,5,3,5),(110,48,5,2,5),(111,49,5,3,6),(112,50,5,2,6),(113,55,6,1,7),(114,56,6,1,7),(115,57,6,1,8),(116,58,6,1,8),(117,59,6,1,8),(118,60,6,1,9),(119,61,6,1,9),(120,62,6,1,10),(121,63,6,1,10),(122,64,6,2,11),(123,65,6,2,11),(124,67,6,2,13),(125,68,6,2,13),(126,69,6,3,14),(127,70,6,3,14),(128,71,6,1,15),(129,72,6,1,15),(130,73,6,2,16),(131,74,6,3,16),(132,75,6,1,17),(133,76,6,1,17),(134,77,6,2,18),(135,78,6,3,18),(136,79,6,3,18),(137,80,6,3,18),(138,81,6,1,18),(139,82,6,1,18),(140,83,6,2,18),(141,84,6,3,18),(142,85,6,2,19),(143,86,6,3,19),(144,87,6,1,19),(145,88,6,1,19),(146,89,6,1,19),(147,1,7,1,1),(148,2,7,2,1),(149,3,7,3,1),(150,4,7,1,1),(151,5,7,2,1),(152,6,7,3,1),(153,7,7,1,1),(154,8,7,2,1),(155,9,7,3,1),(156,10,7,1,1),(157,11,7,2,1),(158,12,7,3,1),(159,13,7,1,1),(160,14,7,2,1),(161,15,7,3,1),(162,16,7,1,2),(163,17,7,1,2),(164,18,7,1,2),(165,19,7,1,2),(166,20,7,1,2),(167,21,7,1,2),(168,22,7,1,2),(169,23,7,2,2),(170,24,7,3,2),(171,25,7,2,2),(172,26,7,1,2),(173,27,7,1,2),(174,28,7,1,2),(175,29,7,1,2),(176,30,7,1,2),(177,31,7,1,3),(178,32,8,1,3),(179,33,8,1,3),(180,34,8,1,3),(181,35,8,1,3),(182,36,8,1,3),(183,37,8,2,4),(184,38,8,2,4),(185,39,8,2,4),(186,40,8,3,4),(187,41,8,3,4),(188,42,8,3,4),(189,43,8,3,5),(190,45,8,1,5),(191,46,8,1,5),(192,47,8,1,5),(193,48,8,1,5),(194,49,8,2,6),(195,50,8,2,6),(196,51,8,3,6),(197,52,8,3,6),(198,53,8,1,6),(199,54,8,3,7),(200,55,8,1,7),(201,56,8,2,7),(202,57,8,3,8),(203,58,8,1,8),(204,59,8,2,8),(205,60,8,3,9),(206,61,9,1,9),(207,62,9,2,10),(208,63,9,3,10),(209,64,9,1,11),(210,65,9,1,11),(211,66,9,1,12),(212,67,9,1,13),(213,68,9,1,13),(214,69,9,1,14),(215,70,9,1,14),(216,71,9,2,15),(217,72,9,2,15),(218,73,9,3,16),(219,74,9,3,16),(220,75,9,1,17),(221,76,9,1,17),(222,77,9,1,18),(223,78,9,1,18),(224,79,9,2,18),(225,80,9,2,18),(226,81,9,3,18),(227,82,9,3,18),(228,83,9,3,18),(229,84,9,1,18),(230,85,9,1,19),(231,86,9,1,19),(232,87,9,3,19),(233,88,9,2,19),(234,1,10,1,1),(235,2,10,1,1),(236,3,10,1,1),(237,4,10,1,1),(238,5,10,1,1),(239,6,10,1,1),(240,7,10,1,1),(241,8,10,2,1),(242,9,10,2,1),(243,10,10,2,1),(244,11,10,2,1),(245,12,10,2,1),(246,13,10,3,1),(247,14,10,3,1),(248,15,10,3,1),(249,16,10,3,2),(250,17,10,1,2),(251,18,10,1,2),(252,19,10,1,2),(253,20,10,1,2),(254,21,10,1,2),(255,22,10,1,2),(256,23,10,1,2),(257,24,10,1,2),(258,25,10,2,2),(259,26,10,1,2),(260,27,10,1,2),(261,28,10,2,2),(262,29,10,2,2),(263,30,10,3,2),(264,31,10,1,3),(265,32,10,2,3),(266,33,10,3,3),(267,34,10,1,3),(268,35,10,2,3),(269,36,10,1,3),(328,37,11,2,26),(329,38,11,3,26),(330,39,11,1,27),(331,40,11,2,27),(332,41,11,3,28),(333,42,11,1,28),(334,43,11,1,28),(335,44,11,1,29),(336,45,11,1,29),(337,46,11,1,29),(338,47,11,1,30),(339,48,11,1,30),(340,49,11,1,31),(341,50,11,2,31),(342,51,11,2,31),(343,52,11,3,31),(344,53,11,3,32),(345,54,11,1,32),(346,55,11,1,32),(347,56,11,1,32),(348,57,11,2,33),(349,58,11,2,33),(350,59,11,1,34),(351,60,11,3,34),(352,61,11,1,34),(353,62,11,2,34),(354,63,11,3,35),(355,64,11,1,35),(356,65,11,2,35);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ranks`
--

DROP TABLE IF EXISTS `ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ranks` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `minimum` tinyint(4) NOT NULL DEFAULT '50',
  `recommended` tinyint(4) NOT NULL DEFAULT '70',
  `areas_id` tinyint(4) NOT NULL,
  `courses_id` int(11) NOT NULL,
  `process_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ranks_areas1_idx` (`areas_id`),
  KEY `fk_ranks_courses1_idx` (`courses_id`),
  KEY `fk_ranks_process1_idx` (`process_id`),
  CONSTRAINT `fk_ranks_areas1` FOREIGN KEY (`areas_id`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ranks_courses1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ranks_process1` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranks`
--

LOCK TABLES `ranks` WRITE;
/*!40000 ALTER TABLE `ranks` DISABLE KEYS */;
INSERT INTO `ranks` VALUES (1,51,66,1,1,1),(2,48,72,1,2,1),(3,65,75,1,3,1),(4,30,45,1,5,1),(5,60,90,1,4,1),(6,23,41,1,6,1),(7,60,70,2,1,1),(8,50,70,2,2,1),(9,30,40,2,3,1),(10,50,70,2,7,1),(11,50,70,2,8,1),(12,50,70,1,7,1),(13,50,70,1,8,1),(14,50,70,1,9,1),(15,50,70,1,10,1),(16,50,70,1,11,1),(17,50,70,1,12,1),(18,50,70,1,13,1),(19,50,70,1,14,1),(20,50,70,1,15,1),(21,50,70,1,16,1),(22,50,70,1,17,1),(23,50,70,1,18,1),(24,50,70,1,19,1),(25,50,70,1,21,1),(26,50,70,1,20,1);
/*!40000 ALTER TABLE `ranks` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER tgUpdateCoursesClasification AFTER UPDATE ON ranks FOR EACH ROW    
	BEGIN    
    
    IF ((old.minimum <> new.minimum) or ( old.recommended <> new.recommended)) THEN
        
        CALL spInsertOnHistoric(old.minimum, old.recommended, old.id);
		CALL spUpdateCourseClasification(old.courses_id);
        
    END IF;    
	
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `responses`
--

DROP TABLE IF EXISTS `responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responses` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responses`
--

LOCK TABLES `responses` WRITE;
/*!40000 ALTER TABLE `responses` DISABLE KEYS */;
INSERT INTO `responses` VALUES (1,'Correcto'),(2,'Incorrecto'),(3,'En Blanco');
/*!40000 ALTER TABLE `responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'No requiere nivelacion'),(2,'Puede tomar nivelacion, pero no es obligatorio'),(3,'Requiere nivelacion obligatorio');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_data`
--

DROP TABLE IF EXISTS `student_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_data` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `code` varchar(12) DEFAULT NULL,
  `omg` smallint(6) NOT NULL,
  `omp` smallint(6) NOT NULL,
  `students_id` smallint(6) NOT NULL,
  `programs_id` tinyint(4) NOT NULL,
  `process_id` tinyint(4) NOT NULL,
  `score` decimal(4,1) DEFAULT '0.0',
  `postulant_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_data_students1_idx` (`students_id`),
  KEY `fk_student_data_programs1_idx` (`programs_id`),
  KEY `fk_student_data_process1_idx` (`process_id`),
  CONSTRAINT `fk_student_data_process1` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_data_programs1` FOREIGN KEY (`programs_id`) REFERENCES `programs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_data_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_data`
--

LOCK TABLES `student_data` WRITE;
/*!40000 ALTER TABLE `student_data` DISABLE KEYS */;
INSERT INTO `student_data` VALUES (1,'181.0001.001',5,3,1,2,1,125.0,'123456'),(2,'181.0001.102',1,1,2,4,1,136.5,'654321'),(3,'181.0001.003',2,22,3,4,1,159.0,'587412'),(4,'181.0001.321',3,13,4,4,1,153.0,'369852'),(5,'181.0001.205',4,15,5,3,1,157.5,'147852'),(6,'181.0001.645',6,20,6,1,1,102.0,'325856'),(7,'181.0001.007',7,12,7,2,1,320.0,'159357'),(8,'181.0001.023',8,14,8,3,1,385.5,'157935'),(9,'181.0001.069',9,11,9,5,1,139.0,'124312'),(10,'181.0001.312',10,16,10,2,1,187.0,'123321'),(11,'181.0123.148',11,30,11,4,1,296.5,'741147');
/*!40000 ALTER TABLE `student_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `people_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_students_people1_idx` (`people_id`),
  CONSTRAINT `fk_students_people1` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,1),(2,4),(3,5),(4,6),(5,7),(6,8),(7,9),(8,10),(9,11),(10,12),(11,14);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `studentsxstatus`
--

DROP TABLE IF EXISTS `studentsxstatus`;
/*!50001 DROP VIEW IF EXISTS `studentsxstatus`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `studentsxstatus` AS SELECT 
 1 AS `students`,
 1 AS `status_id`,
 1 AS `status`,
 1 AS `process`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_UNIQUE` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'Administrador'),(3,'Alumno'),(2,'Visor de Recursos');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type_id` tinyint(4) NOT NULL,
  `people_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_user_type_idx` (`user_type_id`),
  KEY `fk_users_people1_idx` (`people_id`),
  CONSTRAINT `fk_users_people1` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_user_type` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997',1,2),(2,'visor','b200f2b0dd538f7f21e8edf5e120dbf2c08c3f96',2,3),(3,'78963214','3f0eb8b3268f9d7848e6b7d3e7a9827e0568abeb',2,15);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vcourses`
--

DROP TABLE IF EXISTS `vcourses`;
/*!50001 DROP VIEW IF EXISTS `vcourses`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vcourses` AS SELECT 
 1 AS `id`,
 1 AS `course`,
 1 AS `dimension`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vnumberofquestions`
--

DROP TABLE IF EXISTS `vnumberofquestions`;
/*!50001 DROP VIEW IF EXISTS `vnumberofquestions`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vnumberofquestions` AS SELECT 
 1 AS `id`,
 1 AS `area`,
 1 AS `course`,
 1 AS `questions`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vranks`
--

DROP TABLE IF EXISTS `vranks`;
/*!50001 DROP VIEW IF EXISTS `vranks`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vranks` AS SELECT 
 1 AS `id`,
 1 AS `courseid`,
 1 AS `areaid`,
 1 AS `processid`,
 1 AS `course`,
 1 AS `area`,
 1 AS `process`,
 1 AS `minimum`,
 1 AS `recommended`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vstudents`
--

DROP TABLE IF EXISTS `vstudents`;
/*!50001 DROP VIEW IF EXISTS `vstudents`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vstudents` AS SELECT 
 1 AS `id`,
 1 AS `code`,
 1 AS `postulant_code`,
 1 AS `dni`,
 1 AS `omg`,
 1 AS `omp`,
 1 AS `score`,
 1 AS `name`,
 1 AS `lastname`,
 1 AS `gender`,
 1 AS `program`,
 1 AS `area`,
 1 AS `process`,
 1 AS `correct`,
 1 AS `incorrect`,
 1 AS `blank`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vusers`
--

DROP TABLE IF EXISTS `vusers`;
/*!50001 DROP VIEW IF EXISTS `vusers`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vusers` AS SELECT 
 1 AS `id`,
 1 AS `dni`,
 1 AS `lastname`,
 1 AS `name`,
 1 AS `gender`,
 1 AS `utid`,
 1 AS `rol`,
 1 AS `username`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'ogcu'
--

--
-- Dumping routines for database 'ogcu'
--
/*!50003 DROP FUNCTION IF EXISTS `countAllResponsesByCourse` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `countAllResponsesByCourse`(stdID int, courseID int) RETURNS int(11)
BEGIN

	SET @areaID = getAreaIDByStudentID(stdID);
	SET @all_responses = (SELECT count(1) FROM questions WHERE student_data_id = stdID AND distributions_id = (SELECT id FROM distributions WHERE areas_id = @areaID AND courses_id = courseID));

RETURN @all_responses;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `countCorrectResponsesByCourse` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `countCorrectResponsesByCourse`(stdID int, courseID int) RETURNS int(11)
BEGIN
    
    SET @areaID = getAreaIDByStudentID(stdID);
    
	SET @correct = (SELECT count(1) FROM questions WHERE student_data_id = stdID AND distributions_id = (SELECT id FROM distributions WHERE areas_id = @areaID AND courses_id = courseID) AND responses_id = 1);

RETURN @correct;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getAreaIDByStudentID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getAreaIDByStudentID`(stdataID int) RETURNS int(11)
BEGIN
	SET @area_id = (SELECT areas_id FROM programs 
		WHERE id = (SELECT programs_id FROM student_data
        WHERE id = stdataID));
RETURN @area_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getBlankResponses` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `GETBLANKRESPONSES`(stdtID mediumint) RETURNS int(11)
BEGIN
SET @blank = (SELECT count(1) FROM questions WHERE student_data_id = stdtID AND responses_id = 3);
RETURN @blank;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getCorrectResponses` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `GETCORRECTRESPONSES`(stdtID mediumint) RETURNS int(11)
BEGIN
	SET @correct = (SELECT count(1) FROM questions WHERE student_data_id = stdtID AND responses_id = 1);
RETURN @correct;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getIncorrectResponses` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `GETINCORRECTRESPONSES`(stdtID mediumint) RETURNS int(11)
BEGIN
SET @incorrect = (SELECT count(1) FROM questions WHERE student_data_id = stdtID AND responses_id = 2);
RETURN @incorrect;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getPercentResponseByCourse` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getPercentResponseByCourse`(stdataID int, coID int) RETURNS tinyint(4)
BEGIN
	SET @percent = round(((countCorrectResponsesByCourse(stdataID, coID) / countAllResponsesByCourse(stdataID, coID)) * 100));
RETURN @percent;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getStatusInCourse` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getStatusInCourse`(stdataID int, courseID int) RETURNS int(11)
BEGIN

DECLARE response INT;

SET @stID = (SELECT students_id FROM student_data WHERE id = stdataID);

SET @percent = getPercentResponseByCourse(stdataID, courseID);

SET @areaID = getAreaIDByStudentID(stdataID);

SET @processID = (SELECT process_id FROM student_data WHERE id = stdataID);

SET @rankID = (SELECT id FROM ranks WHERE areas_id = @areaID AND courses_id = courseID AND process_id = @processID);

if (@rankID IS NULL) THEN
	INSERT INTO ranks VALUES (null, 50, 70, @areaID, courseID, @processID);
    SET @rankID = (SELECT id FROM ranks WHERE areas_id = @areaID AND courses_id = courseID AND process_id = @processID);
END IF;

SET @min = (SELECT minimum FROM ranks WHERE id = @rankID);
SET @max = (SELECT recommended FROM ranks WHERE id = @rankID);

IF (@min IS NOT NULL AND @max IS NOT NULL) THEN
	IF (@percent < @min) THEN
		SET response = 3; -- 'Requiere nivelacion'
	ELSEIF (@percent BETWEEN @min AND @max) THEN
		SET response = 2; -- 'Necesita nivelacion, no urgente'    
	ELSEIF (@percent > @max) THEN
		SET response = 1; -- 'No necesita nivelacion'
	END IF;
ELSE
	SET response = 0;
END IF;

RETURN response;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `createNewUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `createNewUser`(in _username varchar(45), _password varchar(45), _name varchar(45), _lastname varchar(45),_dni varchar(8), _rol varchar(45), genderID tinyint(4))
BEGIN

	if (SELECT count(*) FROM people WHERE dni = _dni) = 0 then	
	
        INSERT INTO people VALUES (null, _dni, _name, _lastname, genderID);  
        
    end if;

	SET @personID = (SELECT id FROM people WHERE dni = _dni);
	SET @rolID = (SELECT id FROM user_type WHERE type = _rol);
        
	INSERT INTO users VALUES (null, _username, sha1(_password), @rolID, @personID);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spCourses` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCourses`(IN `proceso` VARCHAR(10))
BEGIN

SELECT  
	co.name as course, 
    COUNT(stdt.code) as code 
    
FROM clasifications 	AS clf 
JOIN courses 			AS co 	ON co.id = clf.courses_id 
JOIN student_data 		AS stdt ON stdt.id = clf.student_data_id 
	JOIN students 		AS st 	ON st.id = stdt.students_id 
		JOIN people 	AS pe 	ON pe.id = st.people_id 
	JOIN programs 		AS pr 	ON pr.id = stdt.programs_id 
		JOIN areas 		AS ar 	ON ar.id = pr.areas_id 
	JOIN process 		AS pc 	ON pc.id = stdt.process_id 
JOIN status 			AS sts 	ON sts.id = clf.status_id 

WHERE pc.name=proceso GROUP BY co.name ORDER BY sts.id ASC;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spCoursessProcess` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCoursessProcess`(IN `procc` VARCHAR(10))
BEGIN
SELECT DISTINCT
st.name as status,
		COUNT(cl.student_data_id) as students,
        c.name as course,
        p.name as process
        FROM clasifications cl, status st, courses c, process p, student_data s
        WHERE cl.courses_id=c.id AND cl.student_data_id=s.id AND cl.status_id=st.id AND p.id=s.process_id
        AND p.name=procc GROUP BY c.name;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spDoCourseClassification` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spDoCourseClassification`(stdataID SMALLINT)
BEGIN

DECLARE courseID INT;
DECLARE done BOOLEAN DEFAULT FALSE;

DECLARE courses_cursor CURSOR FOR (SELECT courses_id FROM distributions WHERE id IN (SELECT DISTINCT distributions_id FROM questions WHERE student_data_id = stdataID));

DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = TRUE;

OPEN courses_cursor;

	loop1: LOOP
    
		FETCH courses_cursor INTO courseID;

		IF done THEN LEAVE loop1;
		END IF;
		
        SET @statusID = getStatusInCourse(stdataID, courseID);
        IF (@statusID > 0) THEN
			INSERT INTO clasifications VALUES (null, stdataID, courseID, @statusID);
        END IF;
        
	END LOOP loop1;

CLOSE courses_cursor;
  
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spGetUserLoggedInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetUserLoggedInfo`(in user varchar(45), psw varchar(45), ustpID int)
BEGIN

	if ( ustpID = 3 )then  -- Estudiante
		
        SET @stdID = (SELECT id FROM vstudents WHERE code = user AND dni = psw LIMIT 1);
			
		if @stdID IS NOT NULL then
			SELECT id, dni, lastname, name, gender, (ustpID) as utid,  (SELECT type FROM user_type WHERE id = ustpID) as rol, code as username FROM vstudents WHERE id = @stdID; 
			
		end if;
        
    else -- Administrador y Visor
		SET @userID = (SELECT id FROM users WHERE username = user AND password = sha1(psw));
			
		if @userID IS NOT NULL then
			SELECT * FROM vusers WHERE id = @userID; 
			
		end if;
    
    end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spInsertOnHistoric` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spInsertOnHistoric`(in min TINYINT, rec TINYINT, rankID MEDIUMINT)
BEGIN

	INSERT INTO historic VALUES (null, min, rec, now(), rankID);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spLogin` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spLogin`(in user varchar(45), psw varchar(45), usertypeID int)
BEGIN

	IF (usertypeID = 3) THEN -- Student
		SET @existStudent = (SELECT count(1) FROM vstudents WHERE code = user AND dni = psw);
		IF (@existStudent = 1) THEN
			SELECT 'Credenciales correctas' as 'response', true as 'status';
		ELSE
			SELECT 'Error, revise sus credenciales de acceso.' as 'response', false as 'status';
		END IF;
		
	ELSE -- Administrador y Visor de Recursos
		SET @existUser = (SELECT count(*) FROM users WHERE username = user AND password = sha1(psw) AND user_type_id = usertypeID);
		if ( @existUser = 1 ) then
			SELECT 'Credenciales correctas' as 'response', true as 'status';
		else
			SELECT 'Error, revise sus credenciales de acceso.' as 'response', false as 'status';
		end if;
	END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spShowMissingCourses` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spShowMissingCourses`(ar varchar(5))
BEGIN

	SET @areaID = (SELECT id FROM areas WHERE name = ar);
    
    IF (@areaID IS NOT NULL ) THEN
		SET @procID = (SELECT id FROM process ORDER BY name DESC LIMIT 1);
		SET @courses = (SELECT GROUP_CONCAT(name SEPARATOR ', ') FROM courses WHERE id IN (SELECT courses_id FROM distributions WHERE areas_id = @areaID AND courses_id NOT IN (SELECT courses_id FROM ranks WHERE process_id = @procID AND areas_id = @areaID))); 
		SET @stat = IF(length(@courses)  > 0, true, false);
        SELECT @courses as message, @stat as stat;
	ELSE
		SELECT 'Sin Datos' as message, false as stat;
    END IF;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spShowStatusByCourse` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spShowStatusByCourse`(IN `idstatus` INT(11), IN `proc` VARCHAR(10))
BEGIN


SELECT co.name, COUNT(sts.name) FROM clasifications AS clf
        JOIN courses AS co 	ON co.id = clf.courses_id        
        JOIN student_data	AS stdt	ON stdt.id = clf.student_data_id
		JOIN programs	AS pr	ON pr.id = stdt.programs_id
		JOIN process	AS pc	ON pc.id = stdt.process_id
		JOIN status AS sts	ON sts.id = clf.status_id
        WHERE sts.id=idstatus AND pc.name=proc
		GROUP BY co.name  
        ORDER BY sts.id ASC;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spShowStudentCourses` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spShowStudentCourses`(in stdataID int)
BEGIN
	SELECT DISTINCT
		student_data_id as student_id,
		(SELECT name FROM courses WHERE id = courses_id) as course,
		getPercentResponseByCourse(student_data_id, courses_id) as percent,
		(SELECT name FROM status WHERE id = status_id) as stat,
        status_id as num
	
    FROM clasifications 
    
    WHERE student_data_id = stdataID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spShowStudentCoursesByFullName` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spShowStudentCoursesByFullName`(in fullname VARCHAR(90))
BEGIN
	SELECT DISTINCT
		student_data_id as student_id,
		(SELECT name FROM courses WHERE id = courses_id) as course,
		getPercentResponseByCourse(student_data_id, courses_id) as percent,
		(SELECT name FROM status WHERE id = status_id) as stat,
        status_id as num
	
    FROM clasifications 
    
    WHERE student_data_id = (SELECT id FROM student_data WHERE students_id = (SELECT id FROM students WHERE people_id = (SELECT id FROM people WHERE concat(lastname, ' ', name) = fullname)));
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spShowStudentsByCourse` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spShowStudentsByCourse`(_area varchar(45), _course varchar(45), _proc varchar(45))
BEGIN
	
    set @areaID = (SELECT id FROM areas WHERE name = _area);
    set @courseID = (SELECT id FROM courses WHERE name = _course);
    set @procID = (SELECT id FROM process WHERE name = _proc);
    
    if (@areaID IS NOT NULL AND @courseID IS NOT NULL AND @procID IS NOT NULL) then
    
		SELECT     

			st.id as stdID,
			pe.name as name,
			pe.lastname as lastname,
			stdt.code as code,
			pr.name as program,
			ar.name as area,
			pc.name as process,
			co.name as course,
			sts.id as num,
			sts.name as stat
        
        FROM clasifications AS clf
        
        JOIN courses 		AS co 	ON co.id = clf.courses_id        
        JOIN student_data	AS stdt	ON stdt.id = clf.student_data_id
			JOIN students 	AS st	ON st.id = stdt.students_id
				JOIN people AS pe	ON pe.id = st.people_id
			JOIN programs	AS pr	ON pr.id = stdt.programs_id
				JOIN areas 	AS ar	ON ar.id = pr.areas_id
			JOIN process	AS pc	ON pc.id = stdt.process_id
		JOIN status 		AS sts	ON sts.id = clf.status_id
        
        WHERE ar.id = @areaID AND co.id = @courseID and pc.id = @procID
        
        ORDER BY sts.id ASC;
    
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spUpdateCourseClasification` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateCourseClasification`(courseID TINYINT)
BEGIN

DECLARE clasID INT;
DECLARE stID INT;
DECLARE done BOOLEAN DEFAULT FALSE;
DECLARE courses_cursor CURSOR FOR (SELECT DISTINCT id, (SELECT students_id FROM student_data WHERE id = student_data_id) as stID FROM clasifications WHERE courses_id = courseID);
DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = TRUE;


OPEN courses_cursor;

	loop1: LOOP
    
		FETCH courses_cursor INTO clasID, stID;

			IF done THEN LEAVE loop1;
			END IF;
         
        UPDATE clasifications SET status_id = getStatusInCourse(stID, courseID) WHERE id = clasID;
                
	END LOOP loop1;

CLOSE courses_cursor;
  
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spUpdatePersonPersonalInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdatePersonPersonalInfo`(_name Varchar(45), _lastn Varchar(45), _dni Varchar(8), usID int, genderID tinyint(4))
BEGIN

	SET @personID = (SELECT people_id FROM users WHERE id = usID);
	SET @verifDNI = (SELECT count(1) FROM people WHERE dni = _dni AND id <> @personID);
	
    IF (@verifDNI = 0 AND length(_dni) = 8) THEN
		UPDATE people SET name = _name, lastname = _lastn, dni = _dni, genders_id = genderID WHERE id = @personID;
        SELECT true;
	ELSE
		SELECT false;
    END IF;   

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `studentsxstatus`
--

/*!50001 DROP VIEW IF EXISTS `studentsxstatus`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `studentsxstatus` AS select `cl`.`student_data_id` AS `students`,`cl`.`status_id` AS `status_id`,`st`.`name` AS `status`,`p`.`name` AS `process` from (((`clasifications` `cl` join `status` `st`) join `student_data` `sd`) join `process` `p`) where ((`cl`.`status_id` = `st`.`id`) and (`cl`.`student_data_id` = `sd`.`id`) and (`sd`.`process_id` = `p`.`id`)) group by `cl`.`status_id`,`cl`.`student_data_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vcourses`
--

/*!50001 DROP VIEW IF EXISTS `vcourses`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vcourses` AS select `co`.`id` AS `id`,`co`.`name` AS `course`,`dm`.`name` AS `dimension` from (`courses` `co` join `dimensions` `dm` on((`dm`.`id` = `co`.`dimensions_id`))) order by `dm`.`name`,`co`.`name` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vnumberofquestions`
--

/*!50001 DROP VIEW IF EXISTS `vnumberofquestions`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vnumberofquestions` AS select `dt`.`courses_id` AS `id`,`ar`.`name` AS `area`,`co`.`name` AS `course`,((`dt`.`dto` - `dt`.`dfrom`) + 1) AS `questions` from ((`distributions` `dt` join `areas` `ar` on((`ar`.`id` = `dt`.`areas_id`))) join `courses` `co` on((`co`.`id` = `dt`.`courses_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vranks`
--

/*!50001 DROP VIEW IF EXISTS `vranks`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vranks` AS select `rk`.`id` AS `id`,`cs`.`id` AS `courseid`,`ar`.`id` AS `areaid`,`pr`.`id` AS `processid`,`cs`.`name` AS `course`,`ar`.`name` AS `area`,`pr`.`name` AS `process`,`rk`.`minimum` AS `minimum`,`rk`.`recommended` AS `recommended` from (((`ranks` `rk` join `courses` `cs` on((`cs`.`id` = `rk`.`courses_id`))) join `areas` `ar` on((`ar`.`id` = `rk`.`areas_id`))) join `process` `pr` on((`pr`.`id` = `rk`.`process_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vstudents`
--

/*!50001 DROP VIEW IF EXISTS `vstudents`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vstudents` AS select `st`.`id` AS `id`,`stdt`.`code` AS `code`,`stdt`.`postulant_code` AS `postulant_code`,`pl`.`dni` AS `dni`,`stdt`.`omg` AS `omg`,`stdt`.`omp` AS `omp`,`stdt`.`score` AS `score`,`pl`.`name` AS `name`,`pl`.`lastname` AS `lastname`,`gd`.`gender` AS `gender`,`pg`.`name` AS `program`,`ar`.`name` AS `area`,`pr`.`name` AS `process`,`GETCORRECTRESPONSES`(`stdt`.`id`) AS `correct`,`GETINCORRECTRESPONSES`(`stdt`.`id`) AS `incorrect`,`GETBLANKRESPONSES`(`stdt`.`id`) AS `blank` from ((((((`student_data` `stdt` join `students` `st` on((`st`.`id` = `stdt`.`students_id`))) join `people` `pl` on((`pl`.`id` = `st`.`people_id`))) join `genders` `gd` on((`gd`.`id` = `pl`.`genders_id`))) join `programs` `pg` on((`pg`.`id` = `stdt`.`programs_id`))) join `areas` `ar` on((`ar`.`id` = `pg`.`areas_id`))) join `process` `pr` on((`pr`.`id` = `stdt`.`process_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vusers`
--

/*!50001 DROP VIEW IF EXISTS `vusers`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vusers` AS select `u`.`id` AS `id`,`p`.`dni` AS `dni`,`p`.`lastname` AS `lastname`,`p`.`name` AS `name`,`gd`.`gender` AS `gender`,`ut`.`id` AS `utid`,`ut`.`type` AS `rol`,`u`.`username` AS `username` from (((`users` `u` join `people` `p` on((`p`.`id` = `u`.`people_id`))) join `genders` `gd` on((`gd`.`id` = `p`.`genders_id`))) join `user_type` `ut` on((`ut`.`id` = `u`.`user_type_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-02 13:23:15
