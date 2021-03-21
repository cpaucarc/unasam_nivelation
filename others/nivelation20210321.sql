-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: nivelation
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
  `name` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (5,'A'),(6,'B'),(7,'C'),(8,'D');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (4,'Matematica'),(5,'Raz matematico'),(6,'Raz verbal'),(7,'Lenguaje'),(8,'Fisica'),(9,'Biologia');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persons`
--

DROP TABLE IF EXISTS `persons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persons` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `dni` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persons`
--

LOCK TABLES `persons` WRITE;
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
INSERT INTO `persons` VALUES (1,'Pedro','Hernandez','77458745'),(2,'Jaime','López','96587412'),(3,'Pedro Fernando','Sanchez Duran','74125896'),(4,'Carlos','Dominguez','74125476'),(5,'José','Huaman','41741528'),(6,'Julio','Quispe','74857963'),(7,'Luis','Mamani','71254639'),(8,'Fernando','Ramírez','06325874'),(9,'Gabriela','Huaman','25241523'),(10,'Angel','Pagola','25478147'),(11,'Pedro Fidencio','Mamani Lopez','69857412'),(12,'Luisa','Campos Huaman','25558147'),(13,'Angela','Poma','95115141'),(14,'Pedro','Saenz','41999457'),(15,'Juan','Flores Ramos','04977410'),(16,'James','Franco','00125896'),(17,'Raquel','Castillo Lopez','61257784'),(18,'Barack','Obama','01471005'),(19,'Jorge','Del Solar','12332100'),(20,'Martin','Vizcarra','63636310'),(21,'Clarence','Revival','84332009'),(22,'Pedro','Flores','65215474'),(23,'Amadeo','Pinzon','96587411'),(24,'Luis','Sanches','96587993'),(25,'Sandra','Monserat','96325879'),(26,'Paolo','Guerrero','14521452'),(27,'Carlos','Ramirez','95145602'),(28,'Alan','Garcia','95159874'),(29,'John Darel','Stevenson Fallman','41040549'),(30,'John','Doe','70100054'),(31,'Darlene Maryella','Caldas Cueva','02112103'),(32,'Guillermo Damian','Flores Vega','49780019');
/*!40000 ALTER TABLE `persons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `process`
--

DROP TABLE IF EXISTS `process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `process` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `denomination` varchar(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process`
--

LOCK TABLES `process` WRITE;
/*!40000 ALTER TABLE `process` DISABLE KEYS */;
INSERT INTO `process` VALUES (2,'2019-I'),(3,'2019-II'),(4,'2018-I'),(5,'2018-II'),(6,'2015-II'),(7,'2013-I'),(8,'2009-II'),(9,'2010-II'),(10,'2014-II'),(11,'2020-I');
/*!40000 ALTER TABLE `process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `number` tinyint(4) NOT NULL,
  `response` tinyint(1) NOT NULL,
  `courses_id` tinyint(4) NOT NULL,
  `students_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_questions_courses1_idx` (`courses_id`),
  KEY `fk_questions_students1_idx` (`students_id`),
  CONSTRAINT `fk_questions_courses1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,0,4,1),(2,2,1,8,1),(3,3,0,9,1),(4,1,1,4,7),(5,1,1,4,8),(6,2,0,7,8),(7,100,1,8,8),(8,1,1,4,9),(9,5,0,9,9),(10,58,0,8,9),(11,49,0,4,10),(12,69,1,7,10),(13,89,1,8,10),(14,11,1,4,11),(15,39,0,9,11),(16,49,0,8,11),(17,50,1,8,11),(18,51,1,8,11),(19,52,1,8,11),(20,1,1,6,12),(21,2,1,6,12),(22,3,0,6,12),(23,4,0,6,12),(24,5,1,6,12),(25,6,1,6,12),(26,7,1,6,12),(27,8,0,6,12),(28,25,0,7,12),(29,26,0,7,12),(30,27,0,7,12),(31,28,1,7,12),(32,29,0,7,12),(33,30,1,7,12),(34,31,0,7,12),(35,89,1,8,12),(36,90,0,8,12),(37,91,1,8,12),(38,92,0,8,12),(39,93,1,8,12),(40,94,1,8,12),(41,95,1,8,12),(42,96,1,8,12),(43,97,1,8,12),(44,98,0,8,12),(45,99,1,8,12),(46,100,1,8,12),(47,1,1,6,13),(48,2,1,6,13),(49,3,0,6,13),(50,4,0,6,13),(51,5,1,6,13),(52,6,1,6,13),(53,7,1,6,13),(54,8,0,6,13),(55,25,0,7,13),(56,26,0,7,13),(57,27,0,7,13),(58,28,1,7,13),(59,29,0,7,13),(60,30,1,7,13),(61,31,0,7,13),(62,89,1,8,13),(63,90,0,8,13),(64,91,1,8,13),(65,92,0,8,13),(66,93,1,8,13),(67,94,1,8,13),(68,95,1,8,13),(69,96,1,8,13),(70,97,1,8,13),(71,98,0,8,13),(72,99,1,8,13),(73,100,1,8,13),(74,1,1,4,14),(75,2,1,4,14),(76,3,1,4,14),(77,4,0,4,14),(78,5,0,9,14),(79,6,1,9,14),(80,7,0,9,14),(81,8,0,9,14),(82,9,0,9,14),(83,10,0,9,14),(84,85,0,8,14),(85,86,0,8,14),(86,87,1,8,14),(87,89,0,8,14),(88,90,1,8,14),(89,1,1,6,15),(90,2,1,6,15),(91,3,0,6,15),(92,4,0,6,15),(93,5,1,6,15),(94,6,1,6,15),(95,7,1,6,15),(96,8,0,6,15),(97,9,1,6,15),(98,10,0,6,15),(99,11,0,6,15),(100,12,1,6,15),(101,25,0,7,15),(102,26,0,7,15),(103,27,0,7,15),(104,28,1,7,15),(105,29,0,7,15),(106,30,1,7,15),(107,31,0,7,15),(108,32,1,7,15),(109,33,0,7,15),(110,34,0,7,15),(111,35,0,7,15),(112,36,0,7,15),(113,86,0,9,15),(114,87,1,9,15),(115,88,0,9,15),(116,89,1,9,15),(117,90,0,9,15),(118,91,1,9,15),(119,92,0,9,15),(120,93,1,9,15),(121,94,1,9,15),(122,95,1,9,15),(123,96,0,9,15),(124,97,1,9,15),(125,98,0,9,15),(126,99,1,9,15),(127,100,0,9,15);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ranks`
--

DROP TABLE IF EXISTS `ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ranks` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `courses_id` tinyint(4) NOT NULL,
  `areas_id` tinyint(4) NOT NULL,
  `process_id` tinyint(3) unsigned NOT NULL,
  `minimal` tinyint(4) NOT NULL,
  `maximun` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_table1_courses1_idx` (`courses_id`),
  KEY `fk_table1_areas1_idx` (`areas_id`),
  KEY `fk_table1_process1_idx` (`process_id`),
  CONSTRAINT `fk_table1_areas1` FOREIGN KEY (`areas_id`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_table1_courses1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_table1_process1` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranks`
--

LOCK TABLES `ranks` WRITE;
/*!40000 ALTER TABLE `ranks` DISABLE KEYS */;
INSERT INTO `ranks` VALUES (4,4,5,2,41,56),(5,8,8,2,50,60),(6,9,8,2,25,43),(7,4,8,2,30,50),(8,8,8,3,52,71),(9,4,5,3,50,70),(10,7,5,3,60,80),(11,8,5,3,40,60),(12,6,5,11,40,60),(13,7,5,11,51,59),(14,8,5,11,23,84),(15,4,8,11,29,45),(16,9,8,11,36,65),(17,8,8,11,61,78);
/*!40000 ALTER TABLE `ranks` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER tgUpdateCoursesClasify AFTER UPDATE ON ranks FOR EACH ROW    
	BEGIN    
    
    IF ((old.minimal <> new.minimal) or ( old.maximun <> new.maximun)) THEN
        
		CALL spUpdateCourseClasify(old.courses_id);
        
    END IF;    
	
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'System Administrator'),(2,'Resource Viewer');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schools` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `areas_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_schools_areas1_idx` (`areas_id`),
  CONSTRAINT `fk_schools_areas1` FOREIGN KEY (`areas_id`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (5,'Ingenieria de Sistemas',5),(6,'Ingenieria Civil',5),(7,'Enfermeria',8);
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'No requiere nivelacion'),(2,'Requiere nivelacion, no obligatoria'),(3,'Requiere nivelacion obligatoriamente');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(12) DEFAULT NULL,
  `persons_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_students_persons1_idx` (`persons_id`),
  CONSTRAINT `fk_students_persons1` FOREIGN KEY (`persons_id`) REFERENCES `persons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'125.1245.147',1),(2,'125.1475.366',2),(3,'171.2056.014',3),(4,'161.2974.064',4),(5,'191.2007.007',5),(6,'181.2374.044',6),(7,'121.2987.621',7),(8,'161.2417.364',8),(9,'131.2607.071',9),(10,'171.2017.369',10),(11,'131.2607.071',11),(12,'103.4640.010',29),(13,'123.4562.789',30),(14,'101.2007.031',31),(15,'133.9514.730',32);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students_courses`
--

DROP TABLE IF EXISTS `students_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students_courses` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `courses_id` tinyint(4) NOT NULL,
  `status_id` tinyint(4) NOT NULL,
  `students_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_students_courses_courses1_idx` (`courses_id`),
  KEY `fk_students_courses_nivelation_status1_idx` (`status_id`),
  KEY `fk_students_courses_students1_idx` (`students_id`),
  CONSTRAINT `fk_students_courses_courses1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_courses_nivelation_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_courses_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students_courses`
--

LOCK TABLES `students_courses` WRITE;
/*!40000 ALTER TABLE `students_courses` DISABLE KEYS */;
INSERT INTO `students_courses` VALUES (1,5,1,1),(2,4,1,8),(3,7,3,8),(4,8,1,8),(5,6,1,13),(6,7,3,13),(7,8,2,13),(8,4,1,14),(9,9,3,14),(10,8,3,14),(11,6,2,15),(12,7,3,15);
/*!40000 ALTER TABLE `students_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students_process`
--

DROP TABLE IF EXISTS `students_process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students_process` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `process_id` tinyint(3) unsigned NOT NULL,
  `students_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_students_process_process1_idx` (`process_id`),
  KEY `fk_students_process_students1_idx` (`students_id`),
  CONSTRAINT `fk_students_process_process1` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_process_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students_process`
--

LOCK TABLES `students_process` WRITE;
/*!40000 ALTER TABLE `students_process` DISABLE KEYS */;
INSERT INTO `students_process` VALUES (1,2,1),(2,2,2),(3,2,3),(4,2,4),(5,2,5),(6,2,6),(7,2,7),(8,3,8),(9,3,9),(10,3,10),(11,3,11),(12,11,12),(13,11,13),(14,11,14),(15,11,15);
/*!40000 ALTER TABLE `students_process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students_schools`
--

DROP TABLE IF EXISTS `students_schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students_schools` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `schools_id` tinyint(4) NOT NULL,
  `students_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_students_schools_schools1_idx` (`schools_id`),
  KEY `fk_students_schools_students1_idx` (`students_id`),
  CONSTRAINT `fk_students_schools_schools1` FOREIGN KEY (`schools_id`) REFERENCES `schools` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_schools_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students_schools`
--

LOCK TABLES `students_schools` WRITE;
/*!40000 ALTER TABLE `students_schools` DISABLE KEYS */;
INSERT INTO `students_schools` VALUES (1,5,2),(2,6,1),(3,5,4),(4,7,5),(5,5,6),(6,6,7),(7,6,8),(8,7,9),(9,6,10),(10,7,11),(11,6,12),(12,6,13),(13,7,14),(14,5,15);
/*!40000 ALTER TABLE `students_schools` ENABLE KEYS */;
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
  `persons_id` smallint(5) unsigned NOT NULL,
  `roles_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_persons1_idx` (`persons_id`),
  KEY `fk_users_roles1_idx` (`roles_id`),
  CONSTRAINT `fk_users_persons1` FOREIGN KEY (`persons_id`) REFERENCES `persons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'pedro','4410d99cefe57ec2c2cdbd3f1d5cf862bb4fb6f8',14,1),(2,'juan','b49a5780a99ea81284fc0746a78f84a30e4d5c73',15,2),(4,'raquel','523fd98c83528188555f43a5a82b4b2e6ea61ebf',17,1),(5,'barack','f2d64a9beed83cb642940577f9cd1aefcf08011b',18,2),(7,'martin','54669547a225ff20cba8b75a4adca540eef25858',20,1),(8,'clarence','4f45131825b8172c84020d8f60b8bb4e2cd25d85',21,2),(11,'luis','faea5242a00c52da62a0f00df168c199b7ab748d',24,2),(13,'paolo','f5973ee9c413d0967b98e0944688acb235fd48bf',26,1),(14,'carlos123','ff0edd646698f65fa2c8680d00391e368b6d4315',27,1),(15,'garcia','3f0f370ff13ccce90eedf165d24e49da1a69f845',28,2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

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
 1 AS `minimal`,
 1 AS `maximun`*/;
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
 1 AS `dni`,
 1 AS `name`,
 1 AS `lastname`,
 1 AS `school`,
 1 AS `area`,
 1 AS `process`*/;
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
 1 AS `rol`,
 1 AS `username`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'nivelation'
--

--
-- Dumping routines for database 'nivelation'
--
/*!50003 DROP FUNCTION IF EXISTS `countAllResponsesOfTheCourse` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `countAllResponsesOfTheCourse`(_student_id int, _course_id int) RETURNS int(11)
BEGIN

	SET @all_responses = (SELECT count(response) FROM questions WHERE students_id = _student_id AND courses_id = _course_id);

RETURN @all_responses;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `countTrueResponsesOfTheCourse` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `countTrueResponsesOfTheCourse`(_student_id int, _course_id int) RETURNS int(11)
BEGIN

	SET @true_responses = (SELECT count(response) FROM questions WHERE students_id = _student_id AND courses_id = _course_id AND response = 1);

RETURN @true_responses;
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
CREATE DEFINER=`root`@`localhost` FUNCTION `getAreaIDByStudentID`(stID int) RETURNS int(11)
BEGIN
	SET @area_id = (SELECT areas_id FROM schools WHERE id = (SELECT schools_id FROM students_schools WHERE students_id = stID));
RETURN @area_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getLastProcess` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getLastProcess`() RETURNS varchar(9) CHARSET utf8
BEGIN
	SET @lastProcess = (SELECT denomination FROM process ORDER BY denomination DESC LIMIT 1);
RETURN @lastProcess;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getResponsesPercent` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getResponsesPercent`(stID int, coID int) RETURNS tinyint(4)
BEGIN
	SET @percent = round(((countTrueResponsesOfTheCourse(stID, coID) / countAllResponsesOfTheCourse(stID, coID)) * 100));
RETURN @percent;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getStudentID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getStudentID`(_dni varchar(8)) RETURNS int(11)
BEGIN

SET @student_id = (SELECT id FROM students WHERE persons_id = (SELECT id FROM persons WHERE dni = _dni));

if (@student_id IS NULL) then
	SET @student_id = 0;
end if; 

RETURN @student_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getStudentStatusInCourse` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getStudentStatusInCourse`(stID int, coID int) RETURNS int(11)
BEGIN

DECLARE response INT;

SET @percent = getResponsesPercent(stID, coID);

SET @areaID = getAreaIDByStudentID(stID);

SET @processID = (SELECT process_id FROM students_process WHERE students_id = stID ORDER BY process_id DESC LIMIT 1);

SET @min = (SELECT minimal FROM ranks WHERE areas_id = @areaID AND courses_id = coID AND process_id = @processID);
SET @max = (SELECT maximun FROM ranks WHERE areas_id = @areaID AND courses_id = coID AND process_id = @processID);

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `createNewUser`(in _username varchar(45), _password varchar(45), _name varchar(45), _lastname varchar(45),_dni varchar(8), _rol varchar(45))
BEGIN

	if (SELECT count(*) FROM persons WHERE dni = _dni) = 0 then		
        INSERT INTO persons VALUES (null, _name, _lastname, _dni);        
    end if;

	SET @personID = (SELECT id FROM persons WHERE dni = _dni);
	SET @rolID = (SELECT id FROM roles WHERE name = _rol);
        
	INSERT INTO users VALUES (null, _username, sha1(_password), @personID, @rolID);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `saveNewRankByID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `saveNewRankByID`(in courseID int, areaID int, procID int, min tinyint, max tinyint)
BEGIN

	set @existCourseID = if ((SELECT count(id) FROM courses WHERE id = courseID) = 1, true, false);
	set @existAreaID = if ((SELECT count(id) FROM areas WHERE id = areaID) = 1, true, false);
	set @existProcID = if ((SELECT count(id) FROM process WHERE id = procID) = 1, true, false);
	
    if (@existCourseID and @existAreaID and @existProcID and (min BETWEEN 0 and 100) and (max BETWEEN 0 and 100) and max >= min) then
		INSERT INTO ranks VALUES (null, courseID, areaID, procID, min, max);
	end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `saveNewRankByName` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `saveNewRankByName`(in course varchar(45), area varchar(45), proc varchar(45), min tinyint, max tinyint)
BEGIN

	set @courseID = (SELECT id FROM courses WHERE name = course);
	set @areaID = (SELECT id FROM areas WHERE name = area);
	set @procID = (SELECT id FROM process WHERE denomination = proc);
    
	
	if (@courseID IS NOT NULL and @areaID IS NOT NULL and @procID  IS NOT NULL and (min BETWEEN 0 and 100) and (max BETWEEN 0 and 100) and max >= min) then
		-- INSERT INTO ranks VALUES (null, courseID, areaID, procID, min, max);
        select 'true';
	end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `simple_loop` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `simple_loop`(param_categoria INT)
BEGIN
  
-- Se declara variable donde se va a guardar el valor total
DECLARE TOTAL INT default 0;
DECLARE curID INT;
DECLARE done BOOLEAN DEFAULT FALSE;

-- Se declara el cursor con el select con cuyos datos se va a iterar
DECLARE articulos_categoria_cursor CURSOR FOR (select DISTINCT courses_id from questions where students_id = param_categoria);

-- Declaración de un manejador de error tipo NOT FOUND
-- DECLARE CONTINUE HANDLER FOR NOT FOUND SET @hecho = TRUE;
DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = TRUE;

-- Se abre el cursor. Al abrir el cursor este sitúa un puntero a la primera fila del resultado de la consulta.
OPEN articulos_categoria_cursor;

	-- Empieza el bucle de lectura
	loop1: LOOP
		-- Se guarda el resultado en la variable, hay una variable y un campo en el SELECT de la declaración del cursor
		FETCH articulos_categoria_cursor INTO curID;

		-- Se sale del bucle cuando no hay elementos por recorrer
		 IF done THEN
			LEAVE loop1;
		 END IF;
         
		SET TOTAL = TOTAL + curID;

	END LOOP loop1;

-- Se cierra el cursor
CLOSE articulos_categoria_cursor;

-- Se muestra el resultado
SELECT TOTAL, curID;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spCreateAndAssignCourse` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCreateAndAssignCourse`(in _course varchar(45), schoolID TINYINT, procID TINYINT)
BEGIN

	SET @courseID = (SELECT id FROM courses WHERE name = _course);
    SET @areaID = (SELECT areas_id FROM schools WHERE id = schoolID);
        
    IF (@courseID IS NULL) THEN 
		INSERT INTO courses VALUES (null, _course);
        SET @courseID = (SELECT id FROM courses WHERE name = _course);
    end if;

	SET @existInRanks = (SELECT id FROM ranks WHERE courses_id = @courseID AND areas_id = @areaID AND process_id = procID);
    
    IF (@existInRanks IS NULL) THEN
		INSERT INTO ranks VALUES (null, @courseID, @areaID, procID, 50, 80);
    END IF;    

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spDoCourseClasify` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spDoCourseClasify`(stID SMALLINT)
BEGIN

DECLARE courseID INT;
DECLARE done BOOLEAN DEFAULT FALSE;

DECLARE courses_cursor CURSOR FOR (SELECT DISTINCT courses_id FROM questions WHERE students_id = stID);

DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = TRUE;

OPEN courses_cursor;

	loop1: LOOP
    
		FETCH courses_cursor INTO courseID;

		IF done THEN LEAVE loop1;
		END IF;
		
        SET @statusID = getStudentStatusInCourse(stID, courseID);
        IF (@statusID > 0) THEN
			INSERT INTO students_courses VALUES (null, courseID, @statusID, stID);
        END IF;
        
	END LOOP loop1;

CLOSE courses_cursor;
  
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spGetUserInfoByUsernameAndPassword` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetUserInfoByUsernameAndPassword`(in user varchar(45), psw varchar(45))
BEGIN

	SET @userID = (SELECT id FROM users WHERE username = user AND password = sha1(psw));
    
    
    if @userID IS NOT NULL then
		
        SELECT * FROM vusers WHERE id = @userID; 
        
    end if;


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
CREATE DEFINER=`root`@`localhost` PROCEDURE `spLogin`(in user varchar(45), psw varchar(45))
BEGIN

	SET @existUser = (SELECT count(*) FROM users WHERE username = user);
    
    if ( @existUser = 1 ) then
        SET @existUser = (SELECT count(*) FROM users WHERE username = user AND password = sha1(psw));
        if ( @existUser = 1 ) then
			SELECT 'Credenciales correctas' as 'response', true as 'status';
		else
			SELECT 'Error, credenciales incorrectas.' as 'response', false as 'status';
		end if;
	else
		SELECT 'Error, credenciales incorrectas.' as 'response', false as 'status';
    end if;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spSaveQuestionsByStudent` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSaveQuestionsByStudent`(_number TINYINT, _response BINARY, _course varchar(45), _student_id SMALLINT)
BEGIN

	SET @courseID = (SELECT id FROM courses WHERE name = _course);
	
    IF (@courseID IS NULL) THEN
		SET @schoolID = (SELECT schools_id FROM students_schools WHERE students_id = _student_id);
		SET @procID = (SELECT process_id FROM students_process WHERE students_id = _student_id);
		CALL spCreateAndAssignCourse(_course, @schoolID, @procID);
		SET @courseID = (SELECT id FROM courses WHERE name = _course);
    END IF;	
    
    SET @existQuestion = (SELECT id FROM questions WHERE number = _number and students_id = _student_id);
    
    IF (@existQuestion IS NULL) THEN
		INSERT INTO questions VALUES (null, _number, _response, @courseID, _student_id);
	ELSE
		UPDATE questions SET response = _response, courses_id = @courseID WHERE id = @existQuestion;
    END IF;
	

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spSaveStudent` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spSaveStudent`(_name varchar(45), _lastname  varchar(45), _dni varchar(8), _code varchar(12), _school varchar(50))
BEGIN

	SET @person_id = (SELECT id FROM persons WHERE dni = _dni);
    
    if (@person_id IS NULL) THEN
		INSERT INTO persons VALUES (null, _name, _lastname, _dni);		
		SET @person_id = (SELECT id FROM persons WHERE dni = _dni);
    end if;
    
    SET @student_id = (SELECT id FROM students WHERE persons_id = @person_id);
    
    if (@student_id IS NULL) THEN
		INSERT INTO students VALUES (null, _code, @person_id);
		SET @student_id = (SELECT id FROM students WHERE persons_id = @person_id);
    end if;
    
    SET @schoolID = (SELECT id FROM schools WHERE name = _school);
    SET @isRegisteredInStSc = (SELECT id FROM students_schools WHERE schools_id = @schoolID AND students_id = @student_id);
    
    IF (@isRegisteredInStSc IS NULL) THEN
		INSERT INTO students_schools VALUES (null, @schoolID, @student_id);
    end if;
    
    SET @procID = (SELECT id FROM process WHERE denomination = getLastProcess());
    SET @isRegisteredInStPc = (SELECT id FROM students_process WHERE process_id = @procID AND students_id = @student_id);
    
    if(@isRegisteredInStPc IS NULL) then
		INSERT INTO students_process VALUES (null, @procID, @student_id);
    end if;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spShowCourses` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spShowCourses`(stID SMALLINT)
BEGIN

SELECT
	sc.students_id as student_id,
	co.name as course,
	st.id as num,
	getResponsesPercent(sc.students_id, sc.courses_id) as percent, 
	st.status as stat
FROM students_courses as sc

JOIN courses as co ON co.id = sc.courses_id
JOIN status as st ON st.id = sc.status_id
JOIN students as std on std.id = sc.students_id

WHERE sc.students_id = stID

ORDER BY 
	st.id DESC, 
    co.name ASC;

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `spShowStudentCoursesByFullName`(in _fullname varchar(90))
BEGIN
	SELECT DISTINCT
		students_id student_id,
		(SELECT name FROM courses WHERE id = courses_id) course,
		getResponsesPercent(students_id, courses_id) percent,
		(SELECT status FROM status WHERE id = getStudentStatusInCourse(students_id, courses_id)) as stat,
        getStudentStatusInCourse(students_id, courses_id) as num
	FROM questions 
    
    WHERE students_id = (SELECT id FROM students 
		WHERE persons_id = (SELECT id FROM persons 
			WHERE concat(lastname, ' ', name) = _fullname));
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spShowStudentCurses` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spShowStudentCurses`(in stID int)
BEGIN
	SELECT DISTINCT
		students_id as student_id,
		(SELECT name FROM courses WHERE id = courses_id) as course,
		getResponsesPercent(students_id, courses_id) as percent,
		(SELECT status FROM status WHERE id = getStudentStatusInCourse(students_id, courses_id)) as stat,
        getStudentStatusInCourse(students_id, courses_id) as num
	FROM questions 
    
    WHERE students_id = stID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spShowStudentInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spShowStudentInfo`(stID int)
BEGIN
	
    SELECT
		st.id AS student_id,
        st.code AS code,
        ps.dni AS dni,
        concat_ws(' ', ps.name, ps.lastname) as student,
        sc.name as school,
        ar.name as area
    FROM students_schools AS stsc
    JOIN students AS st ON st.id = stsc.students_id
    JOIN persons AS ps ON ps.id = st.persons_id
    JOIN schools AS sc ON sc.id = stsc.schools_id
    JOIN areas AS ar ON ar.id = sc.areas_id
    
    WHERE stsc.students_id = stID;
    
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
    set @procID = (SELECT id FROM process WHERE denomination = _proc);
    
    if (@areaID IS NOT NULL AND @courseID IS NOT NULL AND @procID IS NOT NULL) then
    
		SELECT     

		st.id as stdID,
		ps.dni as dni,
        ps.name as name,
        ps.lastname as lastname,
        st.code as code,
        ch.name as school,
        ar.name as area,
        pr.denomination as process,
        co.name as course,
        sts.id as num,
        sts.status as stat
        
        FROM students_courses AS stco
        JOIN courses 		  AS co 	ON co.id = stco.courses_id
        JOIN students 		  AS st 	ON st.id =  stco.students_id
        JOIN persons 		  AS ps 	ON ps.id =  st.persons_id
        JOIN students_process AS stpr 	ON stpr.students_id =  st.id
        JOIN process 		  AS pr 	ON pr.id =  stpr.process_id        
        JOIN students_schools AS stch 	ON stch.students_id =  st.id
        JOIN schools 		  AS ch 	ON ch.id =  stch.schools_id
        JOIN areas 		  	  AS ar 	ON ar.id =  ch.areas_id
        JOIN status 		  AS sts 	ON sts.id =  stco.status_id
        
        WHERE ar.id = @areaID AND co.id = @courseID and pr.id = @procID
        
        ORDER BY sts.id ASC;
    
    end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spUpdateCourseClasify` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateCourseClasify`(courseID TINYINT)
BEGIN

DECLARE stcoID INT;
DECLARE stID INT;
DECLARE done BOOLEAN DEFAULT FALSE;
DECLARE courses_cursor CURSOR FOR (SELECT DISTINCT id, students_id FROM students_courses WHERE courses_id = courseID);
DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = TRUE;


OPEN courses_cursor;

	loop1: LOOP
    
		FETCH courses_cursor INTO stcoID, stID;

			IF done THEN LEAVE loop1;
			END IF;
         
        UPDATE students_courses SET status_id = getStudentStatusInCourse(stID, courseID) WHERE id = stcoID;
                
	END LOOP loop1;

CLOSE courses_cursor;
  
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
/*!50001 VIEW `vranks` AS select `rk`.`id` AS `id`,`cs`.`id` AS `courseid`,`ar`.`id` AS `areaid`,`pr`.`id` AS `processid`,`cs`.`name` AS `course`,`ar`.`name` AS `area`,`pr`.`denomination` AS `process`,`rk`.`minimal` AS `minimal`,`rk`.`maximun` AS `maximun` from (((`ranks` `rk` join `courses` `cs` on((`cs`.`id` = `rk`.`courses_id`))) join `areas` `ar` on((`ar`.`id` = `rk`.`areas_id`))) join `process` `pr` on((`pr`.`id` = `rk`.`process_id`))) */;
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
/*!50001 VIEW `vstudents` AS select `st`.`id` AS `id`,`st`.`code` AS `code`,`ps`.`dni` AS `dni`,`ps`.`name` AS `name`,`ps`.`lastname` AS `lastname`,`sc`.`name` AS `school`,`ar`.`name` AS `area`,`prc`.`denomination` AS `process` from ((((((`students_schools` `ss` join `schools` `sc` on((`sc`.`id` = `ss`.`schools_id`))) join `areas` `ar` on((`ar`.`id` = `sc`.`areas_id`))) join `students` `st` on((`st`.`id` = `ss`.`students_id`))) join `persons` `ps` on((`ps`.`id` = `st`.`persons_id`))) join `students_process` `stpr` on((`ss`.`id` = `stpr`.`students_id`))) join `process` `prc` on((`prc`.`id` = `stpr`.`process_id`))) */;
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
/*!50001 VIEW `vusers` AS select `u`.`id` AS `id`,`p`.`dni` AS `dni`,`p`.`lastname` AS `lastname`,`p`.`name` AS `name`,`r`.`name` AS `rol`,`u`.`username` AS `username` from ((`users` `u` join `persons` `p` on((`p`.`id` = `u`.`persons_id`))) join `roles` `r` on((`r`.`id` = `u`.`roles_id`))) */;
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

-- Dump completed on 2021-03-21 14:22:34
