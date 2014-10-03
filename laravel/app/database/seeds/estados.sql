-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sph
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1-log

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
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `app_estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_estados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `app_estados` WRITE;
/*!40000 ALTER TABLE `app_estados` DISABLE KEYS */;
INSERT INTO `app_estados` VALUES (1,'Aguascalientes','2014-09-14 23:24:26','2014-09-14 23:24:26'),(2,'Baja California','2014-09-14 23:24:26','2014-09-14 23:24:26'),(3,'Baja California Sur','2014-09-14 23:24:26','2014-09-14 23:24:26'),(4,'Campeche','2014-09-14 23:24:26','2014-09-14 23:24:26'),(5,'Coahuila','2014-09-14 23:24:26','2014-09-14 23:24:26'),(6,'Colima','2014-09-14 23:24:26','2014-09-14 23:24:26'),(7,'Chiapas','2014-09-14 23:24:26','2014-09-14 23:24:26'),(8,'Chihuahua','2014-09-14 23:24:26','2014-09-14 23:24:26'),(9,'Distrito Federal','2014-09-14 23:24:26','2014-09-14 23:24:26'),(10,'Durango','2014-09-14 23:24:26','2014-09-14 23:24:26'),(11,'Guanajuato','2014-09-14 23:24:27','2014-09-14 23:24:27'),(12,'Guerrero','2014-09-14 23:24:27','2014-09-14 23:24:27'),(13,'Hidalgo','2014-09-14 23:24:27','2014-09-14 23:24:27'),(14,'Jalisco','2014-09-14 23:24:27','2014-09-14 23:24:27'),(15,'Estado de México','2014-09-14 23:24:27','2014-09-14 23:24:27'),(16,'Michoacán','2014-09-14 23:24:27','2014-09-14 23:24:27'),(17,'Morelos','2014-09-14 23:24:27','2014-09-14 23:24:27'),(18,'Nayarit','2014-09-14 23:24:27','2014-09-14 23:24:27'),(19,'Nuevo León','2014-09-14 23:24:27','2014-09-14 23:24:27'),(20,'Oaxaca','2014-09-14 23:24:27','2014-09-14 23:24:27'),(21,'Puebla','2014-09-14 23:24:27','2014-09-14 23:24:27'),(22,'Querétaro','2014-09-14 23:24:27','2014-09-14 23:24:27'),(23,'Quintana Roo','2014-09-14 23:24:27','2014-09-14 23:24:27'),(24,'San Luis Potosí','2014-09-14 23:24:27','2014-09-14 23:24:27'),(25,'Sinaloa','2014-09-14 23:24:27','2014-09-14 23:24:27'),(26,'Sonora','2014-09-14 23:24:27','2014-09-14 23:24:27'),(27,'Tabasco','2014-09-14 23:24:27','2014-09-14 23:24:27'),(28,'Tamaulipas','2014-09-14 23:24:27','2014-09-14 23:24:27'),(29,'Tlaxcala','2014-09-14 23:24:27','2014-09-14 23:24:27'),(30,'Veracruz','2014-09-14 23:24:27','2014-09-14 23:24:27'),(31,'Yucatán','2014-09-14 23:24:27','2014-09-14 23:24:27'),(32,'Zacatecas','2014-09-14 23:24:27','2014-09-14 23:24:27');
/*!40000 ALTER TABLE `app_estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zonas`
--

DROP TABLE IF EXISTS `app_zonas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_zonas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zona` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zonas_estado_id_foreign` (`estado_id`),
  CONSTRAINT `zonas_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `app_estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zonas`
--

LOCK TABLES `app_zonas` WRITE;
/*!40000 ALTER TABLE `zonas` DISABLE KEYS */;
INSERT INTO `app_zonas` VALUES (1,'Condesa','2014-09-15 04:27:38','2014-09-15 04:27:38',9),(2,'Roma','2014-09-15 04:27:49','2014-09-15 04:27:49',9),(3,'Polanco','2014-09-15 04:31:50','2014-09-15 04:31:50',9),(4,'Escandon','2014-09-15 04:31:58','2014-09-15 04:31:58',9),(5,'Juárez','2014-09-15 04:32:10','2014-09-15 04:32:10',9),(6,'Del Valle','2014-09-15 04:32:18','2014-09-15 04:32:18',9),(7,'Narvarte','2014-09-15 04:32:24','2014-09-15 04:32:24',9),(8,'Cancún - Zona Hotelera','2014-09-15 04:34:46','2014-09-15 04:34:46',23),(9,'Cancún - Centro','2014-09-15 04:35:09','2014-09-15 04:35:09',23),(10,'Riviera Maya','2014-09-15 04:35:18','2014-09-15 04:35:18',23),(11,'Playa del Carmen','2014-09-15 04:35:26','2014-09-15 04:35:26',23),(12,'Tulúm','2014-09-15 04:35:33','2014-09-15 04:35:33',23),(13,'Holbox','2014-09-15 04:35:40','2014-09-15 04:35:40',23),(14,'Isla Mujeres','2014-09-15 04:35:50','2014-09-15 04:35:50',23),(15,'Cozumel','2014-09-15 04:35:59','2014-09-15 04:35:59',23),(16,'Bacalar','2014-09-15 04:36:07','2014-09-15 04:36:07',23),(17,'Mahahual','2014-09-15 04:36:15','2014-09-15 04:36:15',23),(18,'Villahermosa','2014-09-15 04:36:57','2014-09-15 04:36:57',27),(19,'Huimanguillo','2014-09-15 04:37:06','2014-09-15 04:37:06',27),(20,'Cárdenas','2014-09-15 04:37:13','2014-09-15 04:37:13',27);
/*!40000 ALTER TABLE `zonas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-03 10:55:30
