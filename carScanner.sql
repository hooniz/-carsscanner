-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: carScanner
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cars` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `manufacturedYear` year NOT NULL,
  `model` int unsigned NOT NULL,
  `engineType` int unsigned NOT NULL,
  `fuelType` int NOT NULL DEFAULT '92',
  PRIMARY KEY (`id`,`model`,`engineType`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_cars_models1_idx` (`model`),
  KEY `fk_cars_engineTypes1_idx` (`engineType`),
  CONSTRAINT `fk_cars_engineTypes1` FOREIGN KEY (`engineType`) REFERENCES `engineTypes` (`id`),
  CONSTRAINT `fk_cars_models1` FOREIGN KEY (`model`) REFERENCES `models` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (9,2019,1,1,98),(29,2019,2,1,0),(30,2019,2,1,0),(31,2019,2,1,0),(32,2019,2,1,0),(33,2019,2,1,0),(34,2019,2,1,0),(35,2019,2,1,0),(44,2020,1,2,95),(45,2020,2,2,92),(46,2020,1,2,92),(47,2020,1,2,92),(48,2020,2,2,92);
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engineTypes`
--

DROP TABLE IF EXISTS `engineTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `engineTypes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engineTypes`
--

LOCK TABLES `engineTypes` WRITE;
/*!40000 ALTER TABLE `engineTypes` DISABLE KEYS */;
INSERT INTO `engineTypes` VALUES (1,'Бензиновый'),(2,'Дизельный');
/*!40000 ALTER TABLE `engineTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `models` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `models`
--

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,'Россия','УАЗ Патриот 3163'),(2,'Япония','Toyota Land Cruiser 200');
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `normalValues`
--

DROP TABLE IF EXISTS `normalValues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `normalValues` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `minValue` float NOT NULL,
  `maxValue` float NOT NULL,
  `sensorProperty` int unsigned NOT NULL,
  `engineType` int unsigned NOT NULL,
  PRIMARY KEY (`id`,`sensorProperty`,`engineType`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_normalValues_sensorProperties1_idx` (`sensorProperty`),
  KEY `fk_normalValues_engineTypes1_idx` (`engineType`),
  CONSTRAINT `fk_normalValues_engineTypes1` FOREIGN KEY (`engineType`) REFERENCES `engineTypes` (`id`),
  CONSTRAINT `fk_normalValues_sensorProperties1` FOREIGN KEY (`sensorProperty`) REFERENCES `sensorProperties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `normalValues`
--

LOCK TABLES `normalValues` WRITE;
/*!40000 ALTER TABLE `normalValues` DISABLE KEYS */;
INSERT INTO `normalValues` VALUES (1,11,20,1,1),(2,6,12,2,1),(3,0,200,3,1),(4,0,9,4,1),(5,100,300,5,1),(6,0,130,6,1),(7,11,20,1,2),(8,6,12,2,2),(9,0,200,3,2),(10,0,9,4,2),(11,100,300,5,2),(12,0,130,6,2);
/*!40000 ALTER TABLE `normalValues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `options` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `value` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` varchar(120) NOT NULL,
  `user` int unsigned NOT NULL,
  `email` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_idx` (`user`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(45) NOT NULL DEFAULT 'U',
  `user` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `user_UNIQUE` (`user`),
  CONSTRAINT `fk_roles_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'A',1),(2,'U',27),(40,'U',46);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sensorProperties`
--

DROP TABLE IF EXISTS `sensorProperties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sensorProperties` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `code` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sensorProperties`
--

LOCK TABLES `sensorProperties` WRITE;
/*!40000 ALTER TABLE `sensorProperties` DISABLE KEYS */;
INSERT INTO `sensorProperties` VALUES (1,'Расход топлива в городе','CITY_FUEL'),(2,'Расход топлива на трассе','HIGHWAY_FUEL'),(3,'Расход масла','OIL'),(4,'Отклик двигателя на нажатие педали газа  ','THROTTLE_DELAY'),(5,'Оценка качества топлива в бензобаке','FUEL_QUALITY'),(6,'Выброс CO2 в окружающую среду','CO2');
/*!40000 ALTER TABLE `sensorProperties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sensorPropertiesValues`
--

DROP TABLE IF EXISTS `sensorPropertiesValues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sensorPropertiesValues` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(45) NOT NULL,
  `property` int unsigned NOT NULL,
  `sensor` int unsigned NOT NULL,
  PRIMARY KEY (`id`,`property`,`sensor`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_property_idx` (`property`),
  KEY `fk_sensor_idx` (`sensor`),
  CONSTRAINT `fk_property` FOREIGN KEY (`property`) REFERENCES `sensorProperties` (`id`),
  CONSTRAINT `fk_sensor` FOREIGN KEY (`sensor`) REFERENCES `sensors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sensorPropertiesValues`
--

LOCK TABLES `sensorPropertiesValues` WRITE;
/*!40000 ALTER TABLE `sensorPropertiesValues` DISABLE KEYS */;
INSERT INTO `sensorPropertiesValues` VALUES (60,'500',1,1),(61,'7',2,1),(62,'1000',3,1),(63,'8',4,1),(64,'100',5,1),(65,'132.2',6,1),(66,'1200',1,2),(67,'1200',2,2),(68,'1200',3,2),(69,'1200',4,2),(70,'1200',5,2),(71,'1200',6,2),(72,'23',1,4),(73,'2',2,4),(74,'543',3,4),(75,'43',4,4),(76,'543',5,4),(77,'23',6,4);
/*!40000 ALTER TABLE `sensorPropertiesValues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sensors`
--

DROP TABLE IF EXISTS `sensors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sensors` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` char(8) NOT NULL,
  `manufacturingDate` date NOT NULL,
  `lastReloadDate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sensors`
--

LOCK TABLES `sensors` WRITE;
/*!40000 ALTER TABLE `sensors` DISABLE KEYS */;
INSERT INTO `sensors` VALUES (1,'298NEI23','2004-10-23','2023-04-16'),(2,'232NEI96','2004-10-23','2004-10-23'),(3,'918ORJ76','2004-10-23','2004-10-23'),(4,'109YZQ87','2004-10-23','2004-10-23');
/*!40000 ALTER TABLE `sensors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userFieldValues`
--

DROP TABLE IF EXISTS `userFieldValues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userFieldValues` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(45) NOT NULL,
  `user` int unsigned NOT NULL,
  `field` int unsigned NOT NULL,
  PRIMARY KEY (`id`,`user`,`field`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_userFieldValues_users1_idx` (`user`),
  KEY `fk_userFieldValues_userFields1_idx` (`field`),
  CONSTRAINT `fk_userFieldValues_userFields1` FOREIGN KEY (`field`) REFERENCES `userFields` (`id`),
  CONSTRAINT `fk_userFieldValues_users1` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userFieldValues`
--

LOCK TABLES `userFieldValues` WRITE;
/*!40000 ALTER TABLE `userFieldValues` DISABLE KEYS */;
/*!40000 ALTER TABLE `userFieldValues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userFields`
--

DROP TABLE IF EXISTS `userFields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userFields` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userFields`
--

LOCK TABLES `userFields` WRITE;
/*!40000 ALTER TABLE `userFields` DISABLE KEYS */;
/*!40000 ALTER TABLE `userFields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(70) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastLogin` timestamp NULL DEFAULT NULL,
  `adEmailingAgreement` tinyint NOT NULL DEFAULT '0',
  `car` int unsigned NOT NULL,
  `sensor` int unsigned NOT NULL,
  PRIMARY KEY (`id`,`car`,`sensor`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `sensor_UNIQUE` (`sensor`),
  KEY `fk_users_cars_idx` (`car`),
  KEY `fk_users_sensors1_idx` (`sensor`),
  CONSTRAINT `fk_users_cars` FOREIGN KEY (`car`) REFERENCES `cars` (`id`),
  CONSTRAINT `fk_users_sensors1` FOREIGN KEY (`sensor`) REFERENCES `sensors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test@gmail.com','$2y$10$SrAnQ8lcYVkxYCQqvQ250eUD24LZaui9H3s6GNmtbvO60p0m/7QHG','2023-04-10 17:43:56','2023-05-02 19:55:30',0,9,1),(27,'test2@gmail.com','$2y$10$rM7ZlNsvzE97h6f0d7MH6uhvokUNtAMlKkVGS4O0xTGeS4VgwTvvO','2023-04-15 07:28:46','2023-05-02 19:49:29',0,35,4),(46,'test3@gmail.com','$2y$10$NiCI2XJwY2U.Vb96JhJrXODKdhObARu7hVTcaNwGirbIOSyy.xcrm','2023-04-29 17:25:03','2023-04-29 17:28:05',0,48,2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `values`
--

DROP TABLE IF EXISTS `values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `values` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `value` float NOT NULL,
  `sensor` int unsigned NOT NULL,
  `sensorProperty` int unsigned NOT NULL,
  PRIMARY KEY (`id`,`sensor`,`sensorProperty`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_values_sensors1_idx` (`sensor`),
  KEY `fk_values_sensorProperties1_idx` (`sensorProperty`),
  CONSTRAINT `fk_values_sensorProperties1` FOREIGN KEY (`sensorProperty`) REFERENCES `sensorProperties` (`id`),
  CONSTRAINT `fk_values_sensors1` FOREIGN KEY (`sensor`) REFERENCES `sensors` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `values`
--

LOCK TABLES `values` WRITE;
/*!40000 ALTER TABLE `values` DISABLE KEYS */;
/*!40000 ALTER TABLE `values` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-03 22:40:26
