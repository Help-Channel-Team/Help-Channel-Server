-- MySQL dump 10.13  Distrib 5.6.27, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: helpchannel
-- ------------------------------------------------------
-- Server version	5.6.28-0ubuntu0.15.10.1-log

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
-- Table structure for table `helpchannel_connection`
--

CREATE DATABASE helpchannel;
USE helpchannel;

DROP TABLE IF EXISTS `helpchannel_connection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helpchannel_connection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` datetime NOT NULL,
  `modification_date` datetime DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `connection_code` varchar(255) NOT NULL,
  `machine_name` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `technician_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `connection_code_UNIQUE` (`connection_code`),
  KEY `connection_user_fk_idx` (`user_id`),
  KEY `connection_technician_fk_idx` (`technician_id`),
  KEY `connection_status_fk_idx` (`status_id`),
  KEY `connection_creator_fk_idx` (`creator_id`),
  CONSTRAINT `connection_creator_fk` FOREIGN KEY (`creator_id`) REFERENCES `helpchannel_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `connection_status_fk` FOREIGN KEY (`status_id`) REFERENCES `helpchannel_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `connection_technician_fk` FOREIGN KEY (`technician_id`) REFERENCES `helpchannel_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `connection_user_fk` FOREIGN KEY (`user_id`) REFERENCES `helpchannel_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `helpchannel_connection_tracking`
--

DROP TABLE IF EXISTS `helpchannel_connection_tracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helpchannel_connection_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` varchar(255) NOT NULL,
  `modification_date` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `connection_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `connection_tracking_connection_fk_idx` (`connection_id`),
  KEY `connection_tracking_creator_fk_idx` (`creator_id`),
  CONSTRAINT `connection_tracking_connection_fk` FOREIGN KEY (`connection_id`) REFERENCES `helpchannel_connection` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `connection_tracking_creator_fk` FOREIGN KEY (`creator_id`) REFERENCES `helpchannel_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=447 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `helpchannel_profile`
--

DROP TABLE IF EXISTS `helpchannel_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helpchannel_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpchannel_profile`
--

LOCK TABLES `helpchannel_profile` WRITE;
/*!40000 ALTER TABLE `helpchannel_profile` DISABLE KEYS */;
INSERT INTO `helpchannel_profile` VALUES (1,'ADMIN'),(2,'TECH'),(3,'USER');
/*!40000 ALTER TABLE `helpchannel_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpchannel_status`
--

DROP TABLE IF EXISTS `helpchannel_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helpchannel_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpchannel_status`
--

LOCK TABLES `helpchannel_status` WRITE;
/*!40000 ALTER TABLE `helpchannel_status` DISABLE KEYS */;
INSERT INTO `helpchannel_status` VALUES (1,'Requested'),(2,'Cancelled User'),(3,'Pending'),(4,'Stablished'),(5,'Accepted'),(6,'Finished User'),(7,'Rejected'),(8,'Cancelled Tech'),(9,'Finished Tech'),(10,'Aborted');
/*!40000 ALTER TABLE `helpchannel_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpchannel_user`
--

DROP TABLE IF EXISTS `helpchannel_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helpchannel_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ldap_username` varchar(255) NOT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `ldap_username_UNIQUE` (`ldap_username`),
  UNIQUE KEY `access_token_UNIQUE` (`access_token`),
  KEY `user_profile_fk_idx` (`profile_id`),
  CONSTRAINT `user_profile_fk` FOREIGN KEY (`profile_id`) REFERENCES `helpchannel_profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpchannel_user`
--

LOCK TABLES `helpchannel_user` WRITE;
/*!40000 ALTER TABLE `helpchannel_user` DISABLE KEYS */;

INSERT INTO `helpchannel_user` VALUES (1,'admin','admin','admin',NULL,NULL,1),(2,'demo','demo','demo','9ffcf0f151a49404a240cab8a3fa01adba667d1b',NULL,3),(3,'tec1','tec1','tec1',NULL,NULL,2);

/*!40000 ALTER TABLE `helpchannel_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-27 18:22:16
