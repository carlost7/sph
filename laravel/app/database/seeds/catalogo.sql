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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Noche','2014-09-14 23:24:26','2014-10-02 15:13:49'),(2,'Cultura','2014-09-14 23:24:26','2014-09-14 23:24:26'),(5,'Belleza','2014-09-14 23:24:26','2014-09-14 23:24:26'),(8,'Centros Comerciales','2014-09-14 23:24:26','2014-09-14 23:24:26'),(10,'Hospedaje','2014-09-14 23:24:26','2014-09-14 23:24:26'),(12,'Librerías','2014-09-14 23:24:26','2014-09-14 23:24:26'),(13,'Mascotas','2014-09-14 23:24:26','2014-09-14 23:24:26'),(18,'Comida','2014-09-14 23:24:26','2014-10-02 15:17:57'),(19,'Salud','2014-09-14 23:24:26','2014-09-14 23:24:26'),(20,'Servicios','2014-09-14 23:24:26','2014-09-14 23:24:26'),(21,'Teatros','2014-09-14 23:24:26','2014-09-14 23:24:26'),(22,'Tiendas','2014-09-14 23:24:26','2014-09-14 23:24:26'),(23,'Viajes','2014-09-14 23:24:26','2014-09-14 23:24:26'),(25,'Casa y Jardín','2014-09-14 23:24:26','2014-09-14 23:24:26'),(28,'Cines','2014-09-30 15:25:12','2014-09-30 15:25:12'),(29,'Deportes','2014-09-30 15:26:17','2014-09-30 15:26:17'),(30,'Educación','2014-09-30 15:27:36','2014-09-30 15:27:36'),(32,'Moda','2014-09-30 15:30:22','2014-09-30 15:30:22'),(33,'Recreación','2014-09-30 15:32:09','2014-10-02 15:18:30');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategorias`
--

LOCK TABLES `subcategorias` WRITE;
/*!40000 ALTER TABLE `subcategorias` DISABLE KEYS */;
INSERT INTO `subcategorias` VALUES (1,'Perfumería','2014-09-14 23:37:56','2014-09-14 23:37:56',5),(2,'Spas','2014-09-14 23:38:04','2014-09-14 23:38:04',5),(3,'Cosméticos','2014-09-14 23:38:12','2014-09-14 23:38:12',5),(4,'Estéticas','2014-09-14 23:38:21','2014-09-14 23:38:21',5),(7,'Hoteles','2014-09-14 23:38:54','2014-09-14 23:38:54',10),(8,'Moteles','2014-09-14 23:39:00','2014-09-14 23:39:00',10),(9,'Hostal','2014-09-14 23:39:09','2014-09-30 15:28:56',10),(20,'Tacos','2014-09-14 23:41:09','2014-09-14 23:41:09',18),(21,'Japonesa ','2014-09-14 23:41:17','2014-09-14 23:41:17',18),(22,'Mexicana','2014-09-14 23:41:24','2014-09-14 23:41:24',18),(23,'Internacional','2014-09-14 23:41:32','2014-09-14 23:41:32',18),(24,'Italiana','2014-09-14 23:41:40','2014-09-14 23:41:40',18),(25,'Americana','2014-09-14 23:41:48','2014-09-14 23:41:48',18),(32,'Locales','2014-09-14 23:43:09','2014-09-14 23:43:09',20),(33,'Públicos','2014-09-14 23:43:16','2014-09-14 23:43:16',20),(34,'Financieros','2014-09-14 23:43:23','2014-09-14 23:43:23',20),(35,'Profesionales','2014-09-14 23:43:29','2014-09-14 23:43:29',20),(36,'Eventos','2014-09-14 23:43:36','2014-09-14 23:43:36',20),(38,'Sexshop','2014-09-14 23:44:13','2014-09-14 23:44:13',22),(40,'Accesorios','2014-09-14 23:44:27','2014-09-14 23:44:27',22),(41,'Zapatos','2014-09-14 23:44:34','2014-09-14 23:44:34',22),(42,'Joyería','2014-09-14 23:44:40','2014-09-14 23:44:40',22),(43,'Música','2014-09-14 23:44:45','2014-09-14 23:44:45',22),(45,'Jugueterías','2014-09-14 23:44:59','2014-09-14 23:44:59',22),(46,'Deportes','2014-09-14 23:45:06','2014-09-14 23:45:06',22),(48,'Lencería','2014-09-14 23:45:23','2014-09-14 23:45:23',22),(49,'Oficina ','2014-09-14 23:45:31','2014-09-14 23:45:31',22),(58,'Museos','2014-09-30 15:17:59','2014-09-30 15:17:59',2),(59,'Galerias','2014-09-30 15:18:06','2014-09-30 15:18:06',2),(60,'Casas de Cultura','2014-09-30 15:18:16','2014-09-30 15:18:16',2),(61,'Cine Clubes','2014-09-30 15:18:30','2014-09-30 15:18:30',2),(62,'Body Shopping ','2014-09-30 15:19:28','2014-09-30 15:19:28',5),(63,'Maquillaje','2014-09-30 15:19:33','2014-09-30 15:19:33',5),(64,'Ferreterias','2014-09-30 15:23:31','2014-09-30 15:23:31',25),(65,'Viveros','2014-09-30 15:23:39','2014-09-30 15:23:39',25),(66,'Muebles','2014-09-30 15:23:47','2014-09-30 15:23:47',25),(67,'Decoración','2014-09-30 15:23:55','2014-09-30 15:23:55',25),(68,'Pisos','2014-09-30 15:24:02','2014-09-30 15:24:02',25),(69,'Persianas','2014-09-30 15:24:09','2014-09-30 15:24:09',25),(70,'Plazas','2014-09-30 15:24:36','2014-09-30 15:24:36',8),(71,'Outlets','2014-09-30 15:24:41','2014-09-30 15:24:41',8),(72,'Gimnasios','2014-09-30 15:26:36','2014-09-30 15:26:36',29),(73,'Crossfit','2014-09-30 15:26:42','2014-09-30 15:26:42',29),(74,'Yoga','2014-09-30 15:26:46','2014-09-30 15:26:46',29),(75,'Pilates','2014-09-30 15:26:50','2014-09-30 15:26:50',29),(76,'Zumba','2014-09-30 15:26:54','2014-09-30 15:26:54',29),(77,'Pole Dance','2014-09-30 15:26:58','2014-09-30 15:26:58',29),(78,'Ciclismo','2014-09-30 15:27:06','2014-09-30 15:27:06',29),(79,'Bici de Montaña','2014-09-30 15:27:11','2014-09-30 15:27:11',29),(80,'Yoga','2014-09-30 15:27:16','2014-09-30 15:27:16',29),(81,'Universidades','2014-09-30 15:27:53','2014-09-30 15:27:53',30),(82,'Idiomas','2014-09-30 15:27:58','2014-09-30 15:27:58',30),(88,'Suite','2014-09-30 15:29:11','2014-09-30 15:29:11',10),(89,'Veterinarias','2014-09-30 15:29:45','2014-09-30 15:29:45',13),(90,'Clínicas','2014-09-30 15:29:51','2014-09-30 15:29:51',13),(91,'Guarderías','2014-09-30 15:29:57','2014-09-30 15:29:57',13),(92,'Accesorios','2014-09-30 15:30:02','2014-09-30 15:30:02',13),(93,'Ropa','2014-09-30 15:30:07','2014-09-30 15:30:07',13),(94,'Accesorios','2014-09-30 15:30:34','2014-09-30 15:30:34',32),(95,'Zapatos','2014-09-30 15:30:40','2014-09-30 15:30:40',32),(96,'Joyería','2014-09-30 15:30:45','2014-09-30 15:30:45',32),(97,'Ropa','2014-09-30 15:30:49','2014-09-30 15:30:49',32),(98,'Lencería','2014-09-30 15:30:53','2014-09-30 15:30:53',32),(99,'Boutiques','2014-09-30 15:30:57','2014-09-30 15:30:57',32),(102,'Zoológicos','2014-09-30 15:32:21','2014-09-30 15:32:21',33),(103,'Ferias','2014-09-30 15:32:25','2014-09-30 15:32:25',33),(104,'Acuarios','2014-09-30 15:32:29','2014-09-30 15:32:29',33),(105,'Parques','2014-09-30 15:32:34','2014-09-30 15:32:34',33),(106,'Pistas de Hielo','2014-09-30 15:32:38','2014-09-30 15:57:58',33),(107,'Parques Acuáticos','2014-09-30 15:32:42','2014-09-30 15:32:42',33),(108,'Foros','2014-09-30 15:32:47','2014-09-30 15:32:47',33),(109,'Conferencias','2014-09-30 15:32:51','2014-09-30 15:32:51',33),(110,'Negocios','2014-09-30 15:32:55','2014-09-30 15:32:55',33),(111,'Callejera','2014-09-30 15:33:42','2014-09-30 15:33:42',18),(112,'Árabe','2014-09-30 15:33:46','2014-09-30 15:33:46',18),(113,'China','2014-09-30 15:33:51','2014-09-30 15:33:51',18),(114,'Libanesa','2014-09-30 15:33:57','2014-09-30 15:33:57',18),(115,'Vegetariano','2014-09-30 15:34:01','2014-09-30 15:34:01',18),(116,'Mariscos','2014-09-30 15:34:06','2014-09-30 15:34:06',18),(117,'Pizza','2014-09-30 15:34:14','2014-09-30 15:34:14',18),(118,'Tailandesa','2014-09-30 15:34:19','2014-09-30 15:34:19',18),(119,'Alemana','2014-09-30 15:34:23','2014-09-30 15:34:23',18),(120,'Argentina','2014-09-30 15:34:28','2014-09-30 15:34:28',18),(121,'Cubana','2014-09-30 15:34:33','2014-09-30 15:34:33',18),(122,'Española','2014-09-30 15:34:37','2014-09-30 15:34:37',18),(123,'Francesa','2014-09-30 15:34:45','2014-09-30 15:34:45',18),(124,'Griego','2014-09-30 15:34:49','2014-09-30 15:34:49',18),(125,'Mediterránea','2014-09-30 15:34:55','2014-09-30 15:34:55',18),(126,'Doctores','2014-09-30 15:36:07','2014-09-30 15:36:07',19),(127,'Dentistas','2014-09-30 15:36:11','2014-09-30 15:36:11',19),(128,'Farmacias','2014-09-30 15:36:15','2014-09-30 15:36:15',19),(129,'Laboratorios','2014-09-30 15:36:19','2014-09-30 15:36:19',19),(130,'Podólogos','2014-09-30 15:36:23','2014-09-30 15:36:23',19),(131,'Ópticas','2014-09-30 15:36:27','2014-09-30 15:36:27',19),(132,'Control de Peso','2014-09-30 15:36:31','2014-09-30 15:36:31',19),(133,'Hospitales','2014-09-30 15:36:35','2014-09-30 15:36:35',19),(134,'Suplementos Alimenticios','2014-09-30 15:36:40','2014-09-30 15:36:40',19),(135,'Terapia','2014-09-30 15:36:45','2014-09-30 15:36:45',19),(136,'Taxis','2014-09-30 15:37:26','2014-09-30 15:37:26',20),(137,'Inmobiliarias','2014-09-30 15:37:29','2014-09-30 15:37:29',20),(138,'Bienes Raices','2014-09-30 15:37:33','2014-09-30 15:37:33',20),(139,'Préstamos','2014-09-30 15:37:37','2014-09-30 15:37:37',20),(140,'Mensajería','2014-09-30 15:37:42','2014-09-30 15:37:42',20),(141,'Mudanza','2014-09-30 15:37:46','2014-09-30 15:37:46',20),(142,'Seguridad','2014-09-30 15:37:50','2014-09-30 15:37:50',20),(143,'Música','2014-09-30 15:40:03','2014-09-30 15:40:34',22),(144,'Equipaje','2014-09-30 15:40:57','2014-09-30 15:40:57',22),(145,'Automotriz','2014-09-30 15:41:11','2014-09-30 15:41:11',22),(146,'Escolares','2014-09-30 15:41:28','2014-09-30 15:41:28',22),(147,'Electrónicos','2014-09-30 15:41:36','2014-09-30 15:41:36',22),(148,'Tintorería','2014-09-30 15:41:40','2014-09-30 15:41:40',22),(149,'Lavandería','2014-09-30 15:41:51','2014-09-30 15:41:51',22),(150,'Bebés','2014-09-30 15:41:55','2014-09-30 15:41:55',22),(151,'Florerías','2014-09-30 15:42:14','2014-09-30 15:42:14',22),(152,'Regalos','2014-09-30 15:42:23','2014-09-30 15:42:23',22),(153,'Supermercados','2014-09-30 15:42:26','2014-09-30 15:42:26',22),(154,'Mercados','2014-09-30 15:42:30','2014-09-30 15:42:30',22),(155,'Licorerías','2014-09-30 15:42:34','2014-09-30 15:42:34',22),(156,'Aerolíneas','2014-09-30 15:43:00','2014-09-30 15:43:00',23),(157,'Agencias','2014-09-30 15:43:06','2014-09-30 15:43:06',23),(158,'Autobuses','2014-09-30 15:43:10','2014-09-30 15:43:10',23),(159,'Trenes','2014-09-30 15:43:15','2014-09-30 15:43:15',23),(160,'Antros','2014-10-02 15:14:05','2014-10-02 15:14:05',1),(161,'Bares','2014-10-02 15:14:10','2014-10-02 15:14:10',1),(162,'Cantinas','2014-10-02 15:14:16','2014-10-02 15:14:16',1),(163,'Clubes para caballeros','2014-10-02 15:14:21','2014-10-02 15:14:21',1),(164,'Clubes para damas','2014-10-02 15:14:25','2014-10-02 15:14:25',1),(165,'Departamento','2014-10-02 15:15:55','2014-10-02 15:15:55',10),(166,'Casa','2014-10-02 15:16:00','2014-10-02 15:16:00',10),(167,'Loft','2014-10-02 15:16:04','2014-10-02 15:16:04',10),(168,'Cabaña','2014-10-02 15:16:08','2014-10-02 15:16:08',10),(169,'Villa','2014-10-02 15:16:14','2014-10-02 15:16:14',10),(170,'Chalet','2014-10-02 15:16:18','2014-10-02 15:16:18',10),(171,'Dormitorio','2014-10-02 15:16:22','2014-10-02 15:16:22',10),(172,'Cueva','2014-10-02 15:16:28','2014-10-02 15:16:28',10),(173,'Barco','2014-10-02 15:16:32','2014-10-02 15:16:32',10),(174,'Tienda de campaña','2014-10-02 15:16:40','2014-10-02 15:16:40',10),(175,'Autocaravana','2014-10-02 15:16:48','2014-10-02 15:16:48',10),(176,'Choza','2014-10-02 15:16:52','2014-10-02 15:16:52',10),(177,'Generales','2014-10-02 15:17:11','2014-10-02 15:17:11',12),(178,'Especializadas','2014-10-02 15:17:18','2014-10-02 15:17:18',12),(179,'Casinos','2014-10-02 15:18:19','2014-10-02 15:18:19',33),(180,'Cafeterías','2014-10-02 15:18:51','2014-10-02 15:18:51',18),(181,'Helados','2014-10-02 15:18:55','2014-10-02 15:18:55',18),(182,'Panadería','2014-10-02 15:18:59','2014-10-02 15:18:59',18),(183,'Pastelería','2014-10-02 15:19:03','2014-10-02 15:19:03',18),(184,'Dulcería','2014-10-02 15:19:07','2014-10-02 15:19:07',18),(185,'Cupcakes','2014-10-02 15:19:11','2014-10-02 15:19:11',18),(186,'Nieves','2014-10-02 15:19:15','2014-10-02 15:19:15',18),(187,'Crepas','2014-10-02 15:19:21','2014-10-02 15:19:21',18),(188,'Gourmet','2014-10-02 15:19:41','2014-10-02 15:19:41',22);
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

-- Dump completed on 2014-10-02 20:29:31
