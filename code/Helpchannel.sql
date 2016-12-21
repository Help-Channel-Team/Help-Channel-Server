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

CREATE DATABASE helpchannel CHARACTER SET utf8 COLLATE utf8_general;
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
-- Dumping data for table `helpchannel_connection`
--

LOCK TABLES `helpchannel_connection` WRITE;
/*!40000 ALTER TABLE `helpchannel_connection` DISABLE KEYS */;
INSERT INTO `helpchannel_connection` VALUES (213,'2015-08-23 17:44:44','2015-08-23 17:47:42','2015-08-23 19:45:56',NULL,'c078034c913f29fa92103f54b8a2b2eaabdaaa02','osboxes',2,1,2,2),(214,'2015-08-23 18:09:11','2015-08-23 18:26:18',NULL,'2015-08-23 18:26:18','74ed98ee372ca6309ed6db999498f91f8f7f18fb','osboxes',2,NULL,2,2),(215,'2015-08-23 18:28:26','2015-08-23 18:35:03','2015-08-23 20:29:08','2015-08-23 18:35:03','ca4d14432556598df8f8aadd53c35e00469a1057','osboxes',2,1,9,2),(217,'2015-08-24 08:24:01','2015-08-24 08:30:48',NULL,'2015-08-24 08:30:48','dc93cd094847cd8c46ded02bb2f4fbe97000e0dc','ingenieria-UX31E',2,NULL,2,2),(218,'2015-08-24 08:30:58','2015-08-24 08:32:43','2015-08-24 10:31:57','2015-08-24 08:32:43','c8ef48550409f376e1fb42d285fe6f1acc368e34','ingenieria-UX31E',2,5,2,2),(219,'2015-08-24 09:32:17','2015-08-24 09:37:33',NULL,'2015-08-24 09:37:33','630452f3b7f8d1602b16e947453f8c6e4183bb0c','carlos-VirtualBox',7,5,2,7),(224,'2015-08-24 09:56:19','2015-08-24 10:01:19',NULL,'2015-08-24 10:01:19','9b2b4b343811118e336f914f4c9a932de7f0650a','SDTPC302',2,NULL,2,2),(226,'2015-08-24 10:01:43','2015-08-24 10:06:55','2015-08-24 12:02:26','2015-08-24 10:06:55','6eff4ae4b9818950422e6cd1e0f59c97c9cd3667','SDTPC302',2,5,2,2),(227,'2015-08-24 10:52:31','2015-08-24 11:02:39','2015-08-24 12:57:04','2015-08-24 11:02:39','f03a1d49fd4c4bd5441c2e2faccb1c85c7b77898','SDTPC302',8,NULL,2,8),(234,'2015-08-24 12:10:59','2015-08-24 12:13:32',NULL,NULL,'c8045ca945503a8e669658d15aa4fc201b71e20a','oem-TravelMate-5720',8,9,5,8),(235,'2015-08-24 13:48:19','2015-08-24 13:49:25',NULL,'2015-08-24 13:49:25','34525660bf5c4cc2df80d590f45d0d937dacb4cf','dcjosej-VirtualBox',2,NULL,2,2),(240,'2015-08-24 15:58:03','2015-08-24 15:58:20',NULL,'2015-08-24 15:58:20','7887e6d800a1c7abd4d9d85d0999af02bea0060c','dcjosej-VirtualBox',2,NULL,2,2),(241,'2015-08-24 16:03:28','2015-08-24 16:03:48',NULL,'2015-08-24 16:03:48','4475399c10cb03e5b5019656be093fc1ba47a35c','dcjosej-VirtualBox',2,NULL,2,2),(242,'2015-08-24 16:36:15','2015-08-24 16:36:28',NULL,'2015-08-24 16:36:28','93b4b5caf0e974bfdeba02a54a202b6f80e81928','dcjosej-VirtualBox',2,NULL,2,2),(243,'2015-08-24 16:36:53','2015-08-24 16:37:03',NULL,'2015-08-24 16:37:03','d350b5b94f8336a35590cf836c881376e97a3fbf','dcjosej-VirtualBox',2,NULL,2,2),(244,'2015-08-24 16:37:13','2015-08-24 16:39:30',NULL,'2015-08-24 16:39:30','a5811b016e1105868514e1a9c600fd2e32460b9d','dcjosej-VirtualBox',2,7,6,2),(245,'2015-08-24 17:15:02','2015-08-24 17:15:08',NULL,'2015-08-24 17:15:08','cd37978ce9e340270a99a7eda1b6ffd881082451','dcjosej-VirtualBox',2,NULL,2,2),(246,'2015-08-24 20:52:17','2015-08-25 06:12:09','2015-08-24 22:55:38','2015-08-25 06:12:09','cfbc25f126182fc547d73c44ffbe460302c17afc','cvela-SATELLITE-L755',2,NULL,2,2),(247,'2015-09-01 14:14:43','2015-09-01 14:16:06',NULL,'0000-00-00 00:00:00','9eaf278237ac7abeec60cc4db01f2b5af7a0d722','cvela-SATELLITE-L755',6,9,1,2);
/*!40000 ALTER TABLE `helpchannel_connection` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `helpchannel_connection_tracking`
--

LOCK TABLES `helpchannel_connection_tracking` WRITE;
/*!40000 ALTER TABLE `helpchannel_connection_tracking` DISABLE KEYS */;
INSERT INTO `helpchannel_connection_tracking` VALUES (263,'2015-08-23 17:45:19',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Pending',213,1),(264,'2015-08-23 17:45:48',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 17:45:19 ---> 2015-08-23 17:45:48<br/>Estado: Pending ---> Accepted',213,2),(265,'2015-08-23 17:47:42',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 19:45:56 ---> 2015-08-23 17:47:42<br/>Estado: Stablished ---> Cancelled User',213,2),(266,'2015-08-23 18:16:46',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Pending',214,1),(267,'2015-08-23 18:17:21',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:16:46 ---> 2015-08-23 18:17:21<br/>Estado: Pending ---> Rejected',214,2),(268,'2015-08-23 18:17:21',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Técnico: dfernandez ---> <br/>Estado: Rejected ---> Requested',214,2),(269,'2015-08-23 18:17:35',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:17:21 ---> 2015-08-23 18:17:35<br/>Estado: Requested ---> Pending',214,1),(270,'2015-08-23 18:20:30',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:17:35 ---> 2015-08-23 18:20:30<br/>Técnico: dfernandez ---> <br/>Estado: Pending ---> Requested',214,1),(271,'2015-08-23 18:26:18',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:20:30 ---> 2015-08-23 18:26:18<br/>Estado: Requested ---> Cancelled User',214,2),(272,'2015-08-23 18:28:34',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Pending',215,1),(273,'2015-08-23 18:28:58',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:28:34 ---> 2015-08-23 18:28:58<br/>Estado: Pending ---> Accepted',215,2),(274,'2015-08-23 18:29:34',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 20:29:08 ---> 2015-08-23 18:29:34<br/>Estado: Stablished ---> Finished Tech',215,2),(275,'2015-08-23 18:29:39',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:29:34 ---> 2015-08-23 18:29:39<br/>Fecha Fin: 2015-08-23 18:29:34 ---> 2015-08-23 18:29:39',215,2),(276,'2015-08-23 18:29:44',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:29:39 ---> 2015-08-23 18:29:44<br/>Fecha Fin: 2015-08-23 18:29:39 ---> 2015-08-23 18:29:44',215,2),(277,'2015-08-23 18:29:50',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:29:44 ---> 2015-08-23 18:29:50<br/>Fecha Fin: 2015-08-23 18:29:44 ---> 2015-08-23 18:29:50',215,2),(278,'2015-08-23 18:29:55',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:29:50 ---> 2015-08-23 18:29:55<br/>Fecha Fin: 2015-08-23 18:29:50 ---> 2015-08-23 18:29:55',215,2),(279,'2015-08-23 18:30:00',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:29:55 ---> 2015-08-23 18:30:00<br/>Fecha Fin: 2015-08-23 18:29:55 ---> 2015-08-23 18:30:00',215,2),(280,'2015-08-23 18:30:06',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:30:00 ---> 2015-08-23 18:30:06<br/>Fecha Fin: 2015-08-23 18:30:00 ---> 2015-08-23 18:30:06',215,2),(281,'2015-08-23 18:30:11',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:30:06 ---> 2015-08-23 18:30:11<br/>Fecha Fin: 2015-08-23 18:30:06 ---> 2015-08-23 18:30:11',215,2),(282,'2015-08-23 18:30:16',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:30:11 ---> 2015-08-23 18:30:16<br/>Fecha Fin: 2015-08-23 18:30:11 ---> 2015-08-23 18:30:16',215,2),(283,'2015-08-23 18:30:22',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:30:16 ---> 2015-08-23 18:30:22<br/>Fecha Fin: 2015-08-23 18:30:16 ---> 2015-08-23 18:30:22',215,2),(284,'2015-08-23 18:30:27',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:30:22 ---> 2015-08-23 18:30:27<br/>Fecha Fin: 2015-08-23 18:30:22 ---> 2015-08-23 18:30:27',215,2),(285,'2015-08-23 18:30:32',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:30:27 ---> 2015-08-23 18:30:32<br/>Fecha Fin: 2015-08-23 18:30:27 ---> 2015-08-23 18:30:32',215,2),(286,'2015-08-23 18:30:37',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:30:32 ---> 2015-08-23 18:30:37<br/>Fecha Fin: 2015-08-23 18:30:32 ---> 2015-08-23 18:30:37',215,2),(287,'2015-08-23 18:30:43',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:30:37 ---> 2015-08-23 18:30:43<br/>Fecha Fin: 2015-08-23 18:30:37 ---> 2015-08-23 18:30:43',215,2),(288,'2015-08-23 18:30:48',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:30:43 ---> 2015-08-23 18:30:48<br/>Fecha Fin: 2015-08-23 18:30:43 ---> 2015-08-23 18:30:48',215,2),(289,'2015-08-23 18:30:53',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:30:48 ---> 2015-08-23 18:30:53<br/>Fecha Fin: 2015-08-23 18:30:48 ---> 2015-08-23 18:30:53',215,2),(290,'2015-08-23 18:30:59',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:30:53 ---> 2015-08-23 18:30:59<br/>Fecha Fin: 2015-08-23 18:30:53 ---> 2015-08-23 18:30:59',215,2),(291,'2015-08-23 18:31:04',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:30:59 ---> 2015-08-23 18:31:04<br/>Fecha Fin: 2015-08-23 18:30:59 ---> 2015-08-23 18:31:04',215,2),(292,'2015-08-23 18:31:09',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:31:04 ---> 2015-08-23 18:31:09<br/>Fecha Fin: 2015-08-23 18:31:04 ---> 2015-08-23 18:31:09',215,2),(293,'2015-08-23 18:31:15',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:31:09 ---> 2015-08-23 18:31:15<br/>Fecha Fin: 2015-08-23 18:31:09 ---> 2015-08-23 18:31:15',215,2),(294,'2015-08-23 18:31:20',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:31:15 ---> 2015-08-23 18:31:20<br/>Fecha Fin: 2015-08-23 18:31:15 ---> 2015-08-23 18:31:20',215,2),(295,'2015-08-23 18:31:25',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:31:20 ---> 2015-08-23 18:31:25<br/>Fecha Fin: 2015-08-23 18:31:20 ---> 2015-08-23 18:31:25',215,2),(296,'2015-08-23 18:31:31',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:31:25 ---> 2015-08-23 18:31:31<br/>Fecha Fin: 2015-08-23 18:31:25 ---> 2015-08-23 18:31:31',215,2),(297,'2015-08-23 18:31:36',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:31:31 ---> 2015-08-23 18:31:36<br/>Fecha Fin: 2015-08-23 18:31:31 ---> 2015-08-23 18:31:36',215,2),(298,'2015-08-23 18:31:41',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:31:36 ---> 2015-08-23 18:31:41<br/>Fecha Fin: 2015-08-23 18:31:36 ---> 2015-08-23 18:31:41',215,2),(299,'2015-08-23 18:31:46',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:31:41 ---> 2015-08-23 18:31:46<br/>Fecha Fin: 2015-08-23 18:31:41 ---> 2015-08-23 18:31:46',215,2),(300,'2015-08-23 18:31:52',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:31:46 ---> 2015-08-23 18:31:52<br/>Fecha Fin: 2015-08-23 18:31:46 ---> 2015-08-23 18:31:52',215,2),(301,'2015-08-23 18:31:57',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:31:52 ---> 2015-08-23 18:31:57<br/>Fecha Fin: 2015-08-23 18:31:52 ---> 2015-08-23 18:31:57',215,2),(302,'2015-08-23 18:32:02',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:31:57 ---> 2015-08-23 18:32:02<br/>Fecha Fin: 2015-08-23 18:31:57 ---> 2015-08-23 18:32:02',215,2),(303,'2015-08-23 18:32:08',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:32:02 ---> 2015-08-23 18:32:08<br/>Fecha Fin: 2015-08-23 18:32:02 ---> 2015-08-23 18:32:08',215,2),(304,'2015-08-23 18:32:13',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:32:08 ---> 2015-08-23 18:32:13<br/>Fecha Fin: 2015-08-23 18:32:08 ---> 2015-08-23 18:32:13',215,2),(305,'2015-08-23 18:32:18',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:32:13 ---> 2015-08-23 18:32:18<br/>Fecha Fin: 2015-08-23 18:32:13 ---> 2015-08-23 18:32:18',215,2),(306,'2015-08-23 18:32:24',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:32:18 ---> 2015-08-23 18:32:24<br/>Fecha Fin: 2015-08-23 18:32:18 ---> 2015-08-23 18:32:24',215,2),(307,'2015-08-23 18:32:29',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:32:24 ---> 2015-08-23 18:32:29<br/>Fecha Fin: 2015-08-23 18:32:24 ---> 2015-08-23 18:32:29',215,2),(308,'2015-08-23 18:32:34',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:32:29 ---> 2015-08-23 18:32:34<br/>Fecha Fin: 2015-08-23 18:32:29 ---> 2015-08-23 18:32:34',215,2),(309,'2015-08-23 18:32:40',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:32:34 ---> 2015-08-23 18:32:40<br/>Fecha Fin: 2015-08-23 18:32:34 ---> 2015-08-23 18:32:40',215,2),(310,'2015-08-23 18:32:45',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:32:40 ---> 2015-08-23 18:32:45<br/>Fecha Fin: 2015-08-23 18:32:40 ---> 2015-08-23 18:32:45',215,2),(311,'2015-08-23 18:32:50',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:32:45 ---> 2015-08-23 18:32:50<br/>Fecha Fin: 2015-08-23 18:32:45 ---> 2015-08-23 18:32:50',215,2),(312,'2015-08-23 18:32:55',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:32:50 ---> 2015-08-23 18:32:55<br/>Fecha Fin: 2015-08-23 18:32:50 ---> 2015-08-23 18:32:55',215,2),(313,'2015-08-23 18:33:01',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:32:55 ---> 2015-08-23 18:33:01<br/>Fecha Fin: 2015-08-23 18:32:55 ---> 2015-08-23 18:33:01',215,2),(314,'2015-08-23 18:33:06',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:33:01 ---> 2015-08-23 18:33:06<br/>Fecha Fin: 2015-08-23 18:33:01 ---> 2015-08-23 18:33:06',215,2),(315,'2015-08-23 18:33:11',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:33:06 ---> 2015-08-23 18:33:11<br/>Fecha Fin: 2015-08-23 18:33:06 ---> 2015-08-23 18:33:11',215,2),(316,'2015-08-23 18:33:17',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:33:11 ---> 2015-08-23 18:33:17<br/>Fecha Fin: 2015-08-23 18:33:11 ---> 2015-08-23 18:33:17',215,2),(317,'2015-08-23 18:33:22',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:33:17 ---> 2015-08-23 18:33:22<br/>Fecha Fin: 2015-08-23 18:33:17 ---> 2015-08-23 18:33:22',215,2),(318,'2015-08-23 18:33:27',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:33:22 ---> 2015-08-23 18:33:27<br/>Fecha Fin: 2015-08-23 18:33:22 ---> 2015-08-23 18:33:27',215,2),(319,'2015-08-23 18:33:33',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:33:27 ---> 2015-08-23 18:33:33<br/>Fecha Fin: 2015-08-23 18:33:27 ---> 2015-08-23 18:33:33',215,2),(320,'2015-08-23 18:33:38',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:33:33 ---> 2015-08-23 18:33:38<br/>Fecha Fin: 2015-08-23 18:33:33 ---> 2015-08-23 18:33:38',215,2),(321,'2015-08-23 18:33:43',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:33:38 ---> 2015-08-23 18:33:43<br/>Fecha Fin: 2015-08-23 18:33:38 ---> 2015-08-23 18:33:43',215,2),(322,'2015-08-23 18:33:49',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:33:43 ---> 2015-08-23 18:33:49<br/>Fecha Fin: 2015-08-23 18:33:43 ---> 2015-08-23 18:33:49',215,2),(323,'2015-08-23 18:33:54',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:33:49 ---> 2015-08-23 18:33:54<br/>Fecha Fin: 2015-08-23 18:33:49 ---> 2015-08-23 18:33:54',215,2),(324,'2015-08-23 18:33:59',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:33:54 ---> 2015-08-23 18:33:59<br/>Fecha Fin: 2015-08-23 18:33:54 ---> 2015-08-23 18:33:59',215,2),(325,'2015-08-23 18:34:05',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:33:59 ---> 2015-08-23 18:34:05<br/>Fecha Fin: 2015-08-23 18:33:59 ---> 2015-08-23 18:34:05',215,2),(326,'2015-08-23 18:34:10',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:34:05 ---> 2015-08-23 18:34:10<br/>Fecha Fin: 2015-08-23 18:34:05 ---> 2015-08-23 18:34:10',215,2),(327,'2015-08-23 18:34:15',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:34:10 ---> 2015-08-23 18:34:15<br/>Fecha Fin: 2015-08-23 18:34:10 ---> 2015-08-23 18:34:15',215,2),(328,'2015-08-23 18:34:20',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:34:15 ---> 2015-08-23 18:34:20<br/>Fecha Fin: 2015-08-23 18:34:15 ---> 2015-08-23 18:34:20',215,2),(329,'2015-08-23 18:34:26',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:34:20 ---> 2015-08-23 18:34:26<br/>Fecha Fin: 2015-08-23 18:34:20 ---> 2015-08-23 18:34:26',215,2),(330,'2015-08-23 18:34:31',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:34:26 ---> 2015-08-23 18:34:31<br/>Fecha Fin: 2015-08-23 18:34:26 ---> 2015-08-23 18:34:31',215,2),(331,'2015-08-23 18:34:36',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:34:31 ---> 2015-08-23 18:34:36<br/>Fecha Fin: 2015-08-23 18:34:31 ---> 2015-08-23 18:34:36',215,2),(332,'2015-08-23 18:34:42',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:34:36 ---> 2015-08-23 18:34:42<br/>Fecha Fin: 2015-08-23 18:34:36 ---> 2015-08-23 18:34:42',215,2),(333,'2015-08-23 18:34:47',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:34:42 ---> 2015-08-23 18:34:47<br/>Fecha Fin: 2015-08-23 18:34:42 ---> 2015-08-23 18:34:47',215,2),(334,'2015-08-23 18:34:52',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:34:47 ---> 2015-08-23 18:34:52<br/>Fecha Fin: 2015-08-23 18:34:47 ---> 2015-08-23 18:34:52',215,2),(335,'2015-08-23 18:34:58',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:34:52 ---> 2015-08-23 18:34:58<br/>Fecha Fin: 2015-08-23 18:34:52 ---> 2015-08-23 18:34:58',215,2),(336,'2015-08-23 18:35:03',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-23 18:34:58 ---> 2015-08-23 18:35:03<br/>Fecha Fin: 2015-08-23 18:34:58 ---> 2015-08-23 18:35:03',215,2),(337,'2015-08-24 08:24:26',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Pending',217,1),(338,'2015-08-24 08:25:09',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 08:24:26 ---> 2015-08-24 08:25:09<br/>Estado: Pending ---> Rejected',217,2),(339,'2015-08-24 08:25:09',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Técnico: dfernandez ---> <br/>Estado: Rejected ---> Requested',217,2),(340,'2015-08-24 08:25:45',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 08:25:09 ---> 2015-08-24 08:25:45<br/>Estado: Requested ---> Pending',217,1),(341,'2015-08-24 08:28:47',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 08:25:45 ---> 2015-08-24 08:28:47<br/>Técnico: dfernandez ---> <br/>Estado: Pending ---> Requested',217,1),(342,'2015-08-24 08:30:00',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 08:28:47 ---> 2015-08-24 08:30:00<br/>Estado: Requested ---> Pending',217,5),(343,'2015-08-24 08:30:27',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 08:30:00 ---> 2015-08-24 08:30:27<br/>Técnico: fromero ---> <br/>Estado: Pending ---> Requested',217,5),(344,'2015-08-24 08:30:48',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 08:30:27 ---> 2015-08-24 08:30:48<br/>Estado: Requested ---> Cancelled User',217,2),(345,'2015-08-24 08:31:04',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Pending',218,5),(346,'2015-08-24 08:31:48',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 08:31:04 ---> 2015-08-24 08:31:48<br/>Estado: Pending ---> Accepted',218,2),(347,'2015-08-24 08:32:43',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 10:31:57 ---> 2015-08-24 08:32:43<br/>Estado: Stablished ---> Cancelled User',218,2),(348,'2015-08-24 09:32:23',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Pending',219,1),(349,'2015-08-24 09:32:50',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 09:32:23 ---> 2015-08-24 09:32:50<br/>Estado: Pending ---> Rejected',219,7),(350,'2015-08-24 09:32:50',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Técnico: dfernandez ---> <br/>Estado: Rejected ---> Requested',219,7),(351,'2015-08-24 09:33:10',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 09:32:50 ---> 2015-08-24 09:33:10<br/>Estado: Requested ---> Pending',219,5),(352,'2015-08-24 09:37:33',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 09:33:10 ---> 2015-08-24 09:37:33<br/>Estado: Pending ---> Cancelled User',219,7),(372,'2015-08-24 09:57:54',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Pending',224,5),(373,'2015-08-24 09:58:27',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 09:57:54 ---> 2015-08-24 09:58:27<br/>Estado: Pending ---> Accepted',224,2),(378,'2015-08-24 10:01:11',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 09:58:27 ---> 2015-08-24 10:01:11<br/>Estado: Accepted ---> Rejected',224,2),(379,'2015-08-24 10:01:11',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Técnico: fromero ---> <br/>Estado: Rejected ---> Requested',224,2),(380,'2015-08-24 10:01:19',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 10:01:11 ---> 2015-08-24 10:01:19<br/>Estado: Requested ---> Cancelled User',224,2),(381,'2015-08-24 10:01:49',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Pending',226,5),(382,'2015-08-24 10:02:15',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 10:01:49 ---> 2015-08-24 10:02:15<br/>Estado: Pending ---> Accepted',226,2),(383,'2015-08-24 10:06:55',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 12:02:26 ---> 2015-08-24 10:06:55<br/>Estado: Stablished ---> Cancelled User',226,2),(384,'2015-08-24 10:53:01',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Pending',227,9),(385,'2015-08-24 10:56:58',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 10:53:01 ---> 2015-08-24 10:56:58<br/>Estado: Pending ---> Accepted',227,8),(386,'2015-08-24 11:02:33',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 12:57:04 ---> 2015-08-24 11:02:33<br/>Estado: Stablished ---> Rejected',227,8),(387,'2015-08-24 11:02:33',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Técnico: demotech ---> <br/>Estado: Rejected ---> Requested',227,8),(388,'2015-08-24 11:02:39',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 11:02:33 ---> 2015-08-24 11:02:39<br/>Estado: Requested ---> Cancelled User',227,8),(408,'2015-08-24 12:13:00',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Pending',234,9),(409,'2015-08-24 12:13:32',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 12:13:00 ---> 2015-08-24 12:13:32<br/>Estado: Pending ---> Accepted',234,8),(412,'2015-08-24 13:49:25',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Cancelled User',235,2),(428,'2015-08-24 15:58:20',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Cancelled User',240,2),(429,'2015-08-24 16:03:48',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Cancelled User',241,2),(430,'2015-08-24 16:36:28',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Cancelled User',242,2),(431,'2015-08-24 16:37:03',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Cancelled User',243,2),(432,'2015-08-24 16:37:21',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Pending',244,7),(433,'2015-08-24 16:38:22',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 16:37:21 ---> 2015-08-24 16:38:22<br/>Estado: Pending ---> Rejected',244,2),(434,'2015-08-24 16:38:22',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Técnico: cborja ---> <br/>Estado: Rejected ---> Requested',244,2),(435,'2015-08-24 16:38:32',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 16:38:22 ---> 2015-08-24 16:38:32<br/>Estado: Requested ---> Pending',244,7),(436,'2015-08-24 16:39:28',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 16:38:32 ---> 2015-08-24 16:39:28<br/>Estado: Pending ---> Accepted',244,2),(437,'2015-08-24 16:39:30',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 16:39:28 ---> 2015-08-24 16:39:30<br/>Estado: Accepted ---> Finished User',244,2),(438,'2015-08-24 17:15:08',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Cancelled User',245,2),(439,'2015-08-24 20:55:12',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Pending',246,1),(440,'2015-08-24 20:55:26',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 20:55:12 ---> 2015-08-24 20:55:26<br/>Estado: Pending ---> Accepted',246,2),(441,'2015-08-24 20:55:54',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 22:55:38 ---> 2015-08-24 20:55:54<br/>Estado: Stablished ---> Rejected',246,2),(442,'2015-08-24 20:55:54',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Técnico: dfernandez ---> <br/>Estado: Rejected ---> Requested',246,2),(443,'2015-08-25 06:12:09',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Fecha Modificación: 2015-08-24 20:55:54 ---> 2015-08-25 06:12:09<br/>Estado: Requested ---> Cancelled User',246,2),(446,'2015-09-01 14:16:06',NULL,'ACTUALIZACIÓN CONEXIÓN <br/>Estado: Requested ---> Cancelled User',247,2);
/*!40000 ALTER TABLE `helpchannel_connection_tracking` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `helpchannel_user` VALUES (1,'dfernandez','dfernandez','dfernandez','5e514393bce3e73720675626bbac08ec9b55f679','f4b86ced00c4bb0aa6ab983079495c0b8472b004',2),(2,'cvela','cvela','cvela','ee356448279745238d80200be8514424fb9e454c',NULL,3),(5,'fromero','fromero','fromero',NULL,'2b505e26103e652db52807ddaaf4aabc6730cbc0',2),(6,'admin','admin','admin',NULL,NULL,1),(7,'cborja','cborja','cborja','097f7415789e56cc244382f64e9dbfcf3e8212ef','984d3c268ebc50f4c6c91e3cf4d1496c2441a410',2),(8,'demo','demo','demo','9ffcf0f151a49404a240cab8a3fa01adba667d1b',NULL,3),(9,'demotech','demotech','demotech',NULL,NULL,2);
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
