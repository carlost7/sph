-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: sphellar.csy6kwgdyuct.us-east-1.rds.amazonaws.com    Database: sphapp
-- ------------------------------------------------------
-- Server version	5.6.17-log

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
-- Table structure for table `zonas`
--

DROP TABLE IF EXISTS `zonas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zonas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zona` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zonas_estado_id_foreign` (`estado_id`),
  CONSTRAINT `zonas_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zonas`
--

LOCK TABLES `zonas` WRITE;
/*!40000 ALTER TABLE `zonas` DISABLE KEYS */;
INSERT INTO `zonas` VALUES (1,'Condesa','2014-09-14 23:27:38','2014-09-14 23:27:38',9),(2,'Roma','2014-09-14 23:27:49','2014-09-14 23:27:49',9),(3,'Polanco','2014-09-14 23:31:50','2014-09-14 23:31:50',9),(4,'Escandon','2014-09-14 23:31:58','2014-09-14 23:31:58',9),(5,'Juárez','2014-09-14 23:32:10','2014-09-14 23:32:10',9),(6,'Del Valle','2014-09-14 23:32:18','2014-09-14 23:32:18',9),(7,'Narvarte','2014-09-14 23:32:24','2014-09-14 23:32:24',9),(8,'Cancún - Zona Hotelera','2014-09-14 23:34:46','2014-09-14 23:34:46',23),(9,'Cancún - Centro','2014-09-14 23:35:09','2014-09-14 23:35:09',23),(10,'Riviera Maya','2014-09-14 23:35:18','2014-09-14 23:35:18',23),(11,'Playa del Carmen','2014-09-14 23:35:26','2014-09-14 23:35:26',23),(12,'Tulúm','2014-09-14 23:35:33','2014-09-14 23:35:33',23),(13,'Holbox','2014-09-14 23:35:40','2014-09-14 23:35:40',23),(14,'Isla Mujeres','2014-09-14 23:35:50','2014-09-14 23:35:50',23),(15,'Cozumel','2014-09-14 23:35:59','2014-09-14 23:35:59',23),(16,'Bacalar','2014-09-14 23:36:07','2014-09-14 23:36:07',23),(17,'Mahahual','2014-09-14 23:36:15','2014-09-14 23:36:15',23),(18,'Villahermosa','2014-09-14 23:36:57','2014-09-14 23:36:57',27),(19,'Huimanguillo','2014-09-14 23:37:06','2014-09-14 23:37:06',27),(20,'Cárdenas','2014-09-14 23:37:13','2014-09-14 23:37:13',27);
/*!40000 ALTER TABLE `zonas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategorias`
--

DROP TABLE IF EXISTS `subcategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subcategoria` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `categoria_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subcategorias_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `subcategorias_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategorias`
--

LOCK TABLES `subcategorias` WRITE;
/*!40000 ALTER TABLE `subcategorias` DISABLE KEYS */;
INSERT INTO `subcategorias` VALUES (1,'Perfumería','2014-09-14 23:37:56','2014-09-14 23:37:56',5),(2,'Spas','2014-09-14 23:38:04','2014-09-14 23:38:04',5),(3,'Cosméticos','2014-09-14 23:38:12','2014-09-14 23:38:12',5),(4,'Estéticas','2014-09-14 23:38:21','2014-09-14 23:38:21',5),(5,'Para Caballeros','2014-09-14 23:38:34','2014-09-14 23:38:34',9),(6,'Para Damas','2014-09-14 23:38:41','2014-09-14 23:38:41',9),(7,'Hoteles','2014-09-14 23:38:54','2014-09-14 23:38:54',10),(8,'Moteles','2014-09-14 23:39:00','2014-09-14 23:39:00',10),(9,'Hostales','2014-09-14 23:39:09','2014-09-14 23:39:09',10),(10,'Doctores','2014-09-14 23:39:21','2014-09-14 23:39:21',14),(11,'Farmacias','2014-09-14 23:39:28','2014-09-14 23:39:28',14),(12,'Ópticas','2014-09-14 23:39:35','2014-09-14 23:39:35',14),(13,'Podología','2014-09-14 23:39:44','2014-09-14 23:39:44',14),(14,'Ortopedia','2014-09-14 23:39:50','2014-09-14 23:39:50',14),(15,'Helados','2014-09-14 23:40:02','2014-09-14 23:40:02',16),(16,'Panadería','2014-09-14 23:40:09','2014-09-14 23:40:09',16),(17,'Pastelería','2014-09-14 23:40:37','2014-09-14 23:40:37',16),(18,'Dulcería','2014-09-14 23:40:45','2014-09-14 23:40:45',16),(19,'Cupcakes','2014-09-14 23:40:53','2014-09-14 23:40:53',16),(20,'Tacos','2014-09-14 23:41:09','2014-09-14 23:41:09',18),(21,'Japonesa ','2014-09-14 23:41:17','2014-09-14 23:41:17',18),(22,'Mexicana','2014-09-14 23:41:24','2014-09-14 23:41:24',18),(23,'Internacional','2014-09-14 23:41:32','2014-09-14 23:41:32',18),(24,'Italiana','2014-09-14 23:41:40','2014-09-14 23:41:40',18),(25,'Americana','2014-09-14 23:41:48','2014-09-14 23:41:48',18),(26,'Gimnasios','2014-09-14 23:42:12','2014-09-14 23:42:12',19),(27,'Crossfit','2014-09-14 23:42:20','2014-09-14 23:42:20',19),(28,'Yoga','2014-09-14 23:42:27','2014-09-14 23:42:27',19),(29,'Pilates','2014-09-14 23:42:34','2014-09-14 23:42:34',19),(30,'Zumba','2014-09-14 23:42:41','2014-09-14 23:42:41',19),(31,'Pole Dance','2014-09-14 23:42:48','2014-09-14 23:42:48',19),(32,'Locales','2014-09-14 23:43:09','2014-09-14 23:43:09',20),(33,'Públicos','2014-09-14 23:43:16','2014-09-14 23:43:16',20),(34,'Financieros','2014-09-14 23:43:23','2014-09-14 23:43:23',20),(35,'Profesionales','2014-09-14 23:43:29','2014-09-14 23:43:29',20),(36,'Eventos','2014-09-14 23:43:36','2014-09-14 23:43:36',20),(37,'Ropa','2014-09-14 23:44:05','2014-09-14 23:44:05',22),(38,'Sexshop','2014-09-14 23:44:13','2014-09-14 23:44:13',22),(39,'Muebles','2014-09-14 23:44:19','2014-09-14 23:44:19',22),(40,'Accesorios','2014-09-14 23:44:27','2014-09-14 23:44:27',22),(41,'Zapatos','2014-09-14 23:44:34','2014-09-14 23:44:34',22),(42,'Joyería','2014-09-14 23:44:40','2014-09-14 23:44:40',22),(43,'Música','2014-09-14 23:44:45','2014-09-14 23:44:45',22),(44,'Gourmet','2014-09-14 23:44:52','2014-09-14 23:44:52',22),(45,'Jugueterías','2014-09-14 23:44:59','2014-09-14 23:44:59',22),(46,'Deportes','2014-09-14 23:45:06','2014-09-14 23:45:06',22),(47,'Equipaje','2014-09-14 23:45:17','2014-09-14 23:45:17',22),(48,'Lencería','2014-09-14 23:45:23','2014-09-14 23:45:23',22),(49,'Oficina ','2014-09-14 23:45:31','2014-09-14 23:45:31',22),(50,'Escolares','2014-09-14 23:45:39','2014-09-14 23:45:39',22),(51,'Ferreterías','2014-09-14 23:45:46','2014-09-14 23:45:46',22),(52,'Computación','2014-09-14 23:46:02','2014-09-14 23:46:02',24),(53,'Fotografía','2014-09-14 23:46:09','2014-09-14 23:46:09',24),(54,'Telefonía','2014-09-14 23:46:15','2014-09-14 23:46:15',24),(55,'Videojuegos','2014-09-14 23:46:23','2014-09-14 23:46:23',24),(56,'Vídeo','2014-09-14 23:46:29','2014-09-14 23:46:29',24),(57,'Televisiones','2014-09-14 23:46:36','2014-09-14 23:46:36',24);
/*!40000 ALTER TABLE `subcategorias` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-23 16:08:31
