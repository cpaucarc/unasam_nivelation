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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clasifications`
--

LOCK TABLES `clasifications` WRITE;
/*!40000 ALTER TABLE `clasifications` DISABLE KEYS */;
INSERT INTO `clasifications` VALUES (3,1,1,1),(4,1,2,3),(5,1,3,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'Razonamiento Logico Matematico',1),(2,'Razonamiento Verbal',1),(3,'Aritmetica',2),(4,'Algebra',2),(5,'Lenguaje',3),(6,'Literatura',3),(7,'Historia Universal',4),(8,'Historia del Peru',4);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dimensions`
--

LOCK TABLES `dimensions` WRITE;
/*!40000 ALTER TABLE `dimensions` DISABLE KEYS */;
INSERT INTO `dimensions` VALUES (1,'Aptitud Academica'),(2,'Matematica'),(3,'Comunicacion'),(4,'Ciencias Sociales');
/*!40000 ALTER TABLE `dimensions` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historic`
--

LOCK TABLES `historic` WRITE;
/*!40000 ALTER TABLE `historic` DISABLE KEYS */;
INSERT INTO `historic` VALUES (2,50,67,'2021-04-20 04:24:41',1);
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni_UNIQUE` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES (1,'03234567','Luisa Victoria','McAllister Fauler'),(2,'01234568','David','Huaman'),(3,'91234567','George','Harrison');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process`
--

LOCK TABLES `process` WRITE;
/*!40000 ALTER TABLE `process` DISABLE KEYS */;
INSERT INTO `process` VALUES (2,'2018-I'),(1,'2018-II');
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
  `courses_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_questions_student_data1_idx` (`student_data_id`),
  KEY `fk_questions_responses1_idx` (`responses_id`),
  KEY `fk_questions_courses1_idx` (`courses_id`),
  CONSTRAINT `fk_questions_courses1` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_responses1` FOREIGN KEY (`responses_id`) REFERENCES `responses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_student_data1` FOREIGN KEY (`student_data_id`) REFERENCES `student_data` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,1,1,1),(2,2,1,1,1),(3,3,1,2,1),(4,4,1,1,1),(5,5,1,1,1),(6,6,1,1,1),(7,7,1,2,2),(8,8,1,1,2),(9,9,1,2,2),(10,10,1,3,2),(11,11,1,3,2),(12,12,1,1,2),(13,13,1,1,3),(14,14,1,2,3),(15,15,1,2,3),(16,16,1,1,3),(17,17,1,1,3),(18,18,1,1,3),(19,19,1,1,3),(20,20,1,3,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranks`
--

LOCK TABLES `ranks` WRITE;
/*!40000 ALTER TABLE `ranks` DISABLE KEYS */;
INSERT INTO `ranks` VALUES (1,51,66,1,1,1),(2,48,72,1,2,1),(3,50,70,1,3,1);
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
  PRIMARY KEY (`id`),
  KEY `fk_student_data_students1_idx` (`students_id`),
  KEY `fk_student_data_programs1_idx` (`programs_id`),
  KEY `fk_student_data_process1_idx` (`process_id`),
  CONSTRAINT `fk_student_data_process1` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_data_programs1` FOREIGN KEY (`programs_id`) REFERENCES `programs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_data_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_data`
--

LOCK TABLES `student_data` WRITE;
/*!40000 ALTER TABLE `student_data` DISABLE KEYS */;
INSERT INTO `student_data` VALUES (1,'181.0001.001',5,3,1,2,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,1);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997',3,2),(2,'91234567','1d3ddcd0d2dd6e9a52016b429f0b188dd101d42b',2,3);
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
 1 AS `dni`,
 1 AS `omg`,
 1 AS `omp`,
 1 AS `name`,
 1 AS `lastname`,
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
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `countAllResponsesByCourse`(stdID int, courseID int) RETURNS int(11)
BEGIN

	SET @all_responses = (SELECT count(1) FROM questions WHERE student_data_id = stdID AND courses_id = courseID);

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
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `countCorrectResponsesByCourse`(stdID int, courseID int) RETURNS int(11)
BEGIN

	SET @correct = (SELECT count(1) FROM questions WHERE student_data_id = stdID AND courses_id = courseID AND responses_id = 1);

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
CREATE DEFINER=`root`@`localhost` FUNCTION `getBlankResponses`(stdtID mediumint) RETURNS int(11)
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
CREATE DEFINER=`root`@`localhost` FUNCTION `getCorrectResponses`(stdtID mediumint) RETURNS int(11)
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
CREATE DEFINER=`root`@`localhost` FUNCTION `getIncorrectResponses`(stdtID mediumint) RETURNS int(11)
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
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `createNewUser`(in _username varchar(45), _password varchar(45), _name varchar(45), _lastname varchar(45),_dni varchar(8), _rol varchar(45))
BEGIN

	if (SELECT count(*) FROM people WHERE dni = _dni) = 0 then		
        INSERT INTO people VALUES (null, _dni, _name, _lastname);        
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

DECLARE courses_cursor CURSOR FOR (SELECT DISTINCT courses_id FROM questions WHERE student_data_id = stdataID);

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
/*!50003 DROP PROCEDURE IF EXISTS `spGetUserInfoByUsernameAndPassword` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
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
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spLogin`(in user varchar(45), psw varchar(45))
BEGIN

	SET @existUser = (SELECT count(*) FROM users WHERE username = user);
    
    if ( @existUser = 1 ) then
        SET @existUser = (SELECT count(*) FROM users WHERE username = user AND password = sha1(psw));
        if ( @existUser = 1 ) then
			SELECT 'Credenciales correctas' as 'response', true as 'status';
		else
			SELECT 'Error, revise sus credenciales de acceso.' as 'response', false as 'status';
		end if;
	else
		SELECT 'Error, revise sus credenciales de acceso.' as 'response', false as 'status';
    end if;

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
/*!50001 VIEW `vstudents` AS select `st`.`id` AS `id`,`stdt`.`code` AS `code`,`pl`.`dni` AS `dni`,`stdt`.`omg` AS `omg`,`stdt`.`omp` AS `omp`,`pl`.`name` AS `name`,`pl`.`lastname` AS `lastname`,`pg`.`name` AS `program`,`ar`.`name` AS `area`,`pr`.`name` AS `process`,`getCorrectResponses`(`stdt`.`id`) AS `correct`,`getIncorrectResponses`(`stdt`.`id`) AS `incorrect`,`getBlankResponses`(`stdt`.`id`) AS `blank` from (((((`student_data` `stdt` join `students` `st` on((`st`.`id` = `stdt`.`students_id`))) join `people` `pl` on((`pl`.`id` = `st`.`people_id`))) join `programs` `pg` on((`pg`.`id` = `stdt`.`programs_id`))) join `areas` `ar` on((`ar`.`id` = `pg`.`areas_id`))) join `process` `pr` on((`pr`.`id` = `stdt`.`process_id`))) */;
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
/*!50001 VIEW `vusers` AS select `u`.`id` AS `id`,`p`.`dni` AS `dni`,`p`.`lastname` AS `lastname`,`p`.`name` AS `name`,`ut`.`type` AS `rol`,`u`.`username` AS `username` from ((`users` `u` join `people` `p` on((`p`.`id` = `u`.`people_id`))) join `user_type` `ut` on((`ut`.`id` = `u`.`user_type_id`))) */;
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

-- Dump completed on 2021-04-21 22:54:05
