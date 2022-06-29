-- MySQL dump 10.19  Distrib 10.3.31-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: db5003537921.hosting-data.io    Database: dbs2878085
-- ------------------------------------------------------
-- Server version	5.7.32-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `IdArea` int(11) NOT NULL AUTO_INCREMENT,
  `DescripcionA` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdArea`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (1,'Administración'),(2,'Mantenimiento'),(3,'Lavado'),(4,'Peletizado'),(5,'Extrusión'),(6,'Bolseo'),(7,'Servicios generales'),(8,'Producción'),(9,'Recolección'),(10,'Molienda');
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `IdCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `DescripcionC` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Artículos limpieza'),(2,'Ferretería'),(3,'Herramientas'),(4,'Lubricantes'),(5,'Material estructural'),(6,'Materias primas'),(7,'Papelería'),(8,'Refacciones eléctricas'),(9,'Refacciones instrumentación'),(10,'Refacciones mecánicas'),(11,'Seguridad'),(12,'Soldadura'),(13,'Tornillería'),(14,'Refacciones equipo móvil');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprasproductos`
--

DROP TABLE IF EXISTS `comprasproductos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comprasproductos` (
  `IdCompra` int(11) NOT NULL AUTO_INCREMENT,
  `IdProveedor` int(11) NOT NULL,
  `Factura` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Condiciones` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` date NOT NULL,
  `FechaVto` date NOT NULL,
  `Subtotal` double NOT NULL,
  `Iva` double NOT NULL,
  `Total` double NOT NULL,
  `Saldo` double NOT NULL,
  PRIMARY KEY (`IdCompra`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprasproductos`
--

LOCK TABLES `comprasproductos` WRITE;
/*!40000 ALTER TABLE `comprasproductos` DISABLE KEYS */;
INSERT INTO `comprasproductos` VALUES (1,2,'1456','Contado','2022-01-24','2022-01-28',103.5,16.56,120.06,0);
/*!40000 ALTER TABLE `comprasproductos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallecompraprod`
--

DROP TABLE IF EXISTS `detallecompraprod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallecompraprod` (
  `IdCompra` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` float NOT NULL,
  `Costo` double NOT NULL,
  UNIQUE KEY `detallecompraprod` (`IdCompra`,`IdProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallecompraprod`
--

LOCK TABLES `detallecompraprod` WRITE;
/*!40000 ALTER TABLE `detallecompraprod` DISABLE KEYS */;
INSERT INTO `detallecompraprod` VALUES (1,32,3,24.5),(1,34,2,15);
/*!40000 ALTER TABLE `detallecompraprod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalledevolucion`
--

DROP TABLE IF EXISTS `detalledevolucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalledevolucion` (
  `IdDevolucion` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` float NOT NULL,
  UNIQUE KEY `detalledevo` (`IdProducto`,`IdDevolucion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalledevolucion`
--

LOCK TABLES `detalledevolucion` WRITE;
/*!40000 ALTER TABLE `detalledevolucion` DISABLE KEYS */;
INSERT INTO `detalledevolucion` VALUES (1,6,1);
/*!40000 ALTER TABLE `detalledevolucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallemanttoint`
--

DROP TABLE IF EXISTS `detallemanttoint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallemanttoint` (
  `IdOrdenInt` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` float NOT NULL,
  `Costo` double NOT NULL,
  `CantidadSurtida` float NOT NULL,
  `Estado` char(1) COLLATE utf8_spanish_ci NOT NULL,
  UNIQUE KEY `detallemanttoint` (`IdOrdenInt`,`IdProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallemanttoint`
--

LOCK TABLES `detallemanttoint` WRITE;
/*!40000 ALTER TABLE `detallemanttoint` DISABLE KEYS */;
INSERT INTO `detallemanttoint` VALUES (1,6,2,0,2,'S'),(1,33,3,0,2,'N'),(2,22,2,0,2,'S');
/*!40000 ALTER TABLE `detallemanttoint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallerequisicionproductos`
--

DROP TABLE IF EXISTS `detallerequisicionproductos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallerequisicionproductos` (
  `IdRequisicion` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` float NOT NULL,
  `CantidadSurtida` float NOT NULL,
  `CantidadDevuelta` float NOT NULL,
  `CostoAprox` double NOT NULL,
  UNIQUE KEY `detreqprod` (`IdRequisicion`,`IdProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallerequisicionproductos`
--

LOCK TABLES `detallerequisicionproductos` WRITE;
/*!40000 ALTER TABLE `detallerequisicionproductos` DISABLE KEYS */;
INSERT INTO `detallerequisicionproductos` VALUES (1,32,3,3,1,24.5),(1,34,2,2,1,15);
/*!40000 ALTER TABLE `detallerequisicionproductos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallevales`
--

DROP TABLE IF EXISTS `detallevales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallevales` (
  `IdVale` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` float NOT NULL,
  UNIQUE KEY `llaveDetalle` (`IdVale`,`IdProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallevales`
--

LOCK TABLES `detallevales` WRITE;
/*!40000 ALTER TABLE `detallevales` DISABLE KEYS */;
INSERT INTO `detallevales` VALUES (1,6,1),(1,33,2),(2,6,1),(3,22,2);
/*!40000 ALTER TABLE `detallevales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detdevprodvale`
--

DROP TABLE IF EXISTS `detdevprodvale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detdevprodvale` (
  `IdDevolucion` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` float NOT NULL,
  UNIQUE KEY `detdevprodvale` (`IdDevolucion`,`IdProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detdevprodvale`
--

LOCK TABLES `detdevprodvale` WRITE;
/*!40000 ALTER TABLE `detdevprodvale` DISABLE KEYS */;
INSERT INTO `detdevprodvale` VALUES (1,32,1),(1,34,1);
/*!40000 ALTER TABLE `detdevprodvale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detfactmanttoext`
--

DROP TABLE IF EXISTS `detfactmanttoext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detfactmanttoext` (
  `IdOrdenExt` int(11) NOT NULL,
  `Consecutivo` int(11) NOT NULL,
  `DescripcionRef` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Cantidad` float NOT NULL,
  `CostoRef` double NOT NULL,
  PRIMARY KEY (`IdOrdenExt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detfactmanttoext`
--

LOCK TABLES `detfactmanttoext` WRITE;
/*!40000 ALTER TABLE `detfactmanttoext` DISABLE KEYS */;
/*!40000 ALTER TABLE `detfactmanttoext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detvalesconsumibles`
--

DROP TABLE IF EXISTS `detvalesconsumibles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detvalesconsumibles` (
  `IdValeCons` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` float NOT NULL,
  UNIQUE KEY `detvalesconsumibles` (`IdValeCons`,`IdProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detvalesconsumibles`
--

LOCK TABLES `detvalesconsumibles` WRITE;
/*!40000 ALTER TABLE `detvalesconsumibles` DISABLE KEYS */;
INSERT INTO `detvalesconsumibles` VALUES (1,32,3),(1,34,1),(2,34,1);
/*!40000 ALTER TABLE `detvalesconsumibles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devoluciones`
--

DROP TABLE IF EXISTS `devoluciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devoluciones` (
  `IdDevolucion` int(11) NOT NULL,
  `IdVale` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`IdDevolucion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devoluciones`
--

LOCK TABLES `devoluciones` WRITE;
/*!40000 ALTER TABLE `devoluciones` DISABLE KEYS */;
INSERT INTO `devoluciones` VALUES (1,2,'2021-08-13');
/*!40000 ALTER TABLE `devoluciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devprodvale`
--

DROP TABLE IF EXISTS `devprodvale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devprodvale` (
  `IdDevolucion` int(11) NOT NULL AUTO_INCREMENT,
  `IdRequisicion` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`IdDevolucion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devprodvale`
--

LOCK TABLES `devprodvale` WRITE;
/*!40000 ALTER TABLE `devprodvale` DISABLE KEYS */;
INSERT INTO `devprodvale` VALUES (1,1,'2022-01-25');
/*!40000 ALTER TABLE `devprodvale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleados` (
  `IdEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `IdArea` int(11) NOT NULL,
  `IdPuesto` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `FechaNac` date NOT NULL,
  `FechaIngreso` date NOT NULL,
  `Domicilio` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Colonia` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Ciudad` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `CP` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `Edo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `Tel` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Celular` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Estado` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (1,1,1,'OCHOA ALCARAZ GUSTAVO ADRIAN','0000-00-00','0000-00-00','','','Guzmán','49000','Jalisco','','341 886 79','Activo'),(2,1,2,'BLUMGART PEREZ EDUARDO','0000-00-00','0000-00-00','','','Guzmán','49000','Jalisco','','341 121 42','Activo'),(3,1,3,'FREGOSO CORNEJO ROCIO','0000-00-00','0000-00-00','','','Guzmán','49000','Jalisco','','341 420 04','Activo'),(4,1,3,'RUBIO ALVAREZ LISA DENISSE','0000-00-00','0000-00-00','','','Guzmán','49000','Jalisco','','341 117 68','Activo'),(5,1,4,'MARTINEZ TENORIO JUAN MANUEL','0000-00-00','0000-00-00','','','Guzmán','49000','Jalisco','','33 2240 76','Activo'),(6,3,14,'ISRAEL PONCE CALVARIO','0000-00-00','0000-00-00','','','Usmajac','49330','Jalisco','','342 101 72','Activo'),(7,8,5,'CARRASCO TERRONES CARLOS','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 117 02','Activo'),(8,8,5,'LOPEZ BAUTISTA JOSE  MANUEL','0000-00-00','0000-00-00','','','Guzmán','49000','Jalisco','','341 121 02','Activo'),(9,8,5,'PEDRO LOPEZ LOPEZ','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 105 32','Activo'),(10,8,5,'BALTAZAR CALVARIO ALEX','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 112 58','Activo'),(11,2,6,'SOSA RODRIGUEZ DAVID ARMANDO','0000-00-00','0000-00-00','','','Usmajac','49330','Jalisco','','341 878 99','Activo'),(12,2,6,'RODRIGUEZ FLORES LUCIO JOSE','0000-00-00','0000-00-00','','','Usmajac','49330','Jalisco','','342 101 22','Activo'),(13,7,15,'MARTINEZ MENDOZA FAUSTINO','0000-00-00','0000-00-00','','','Guzmán','49000','Jalisco','','','Activo'),(14,2,7,'JESUS SOSA RODRIGUEZ','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','341 126 84','Activo'),(15,7,15,'ARROYO JAVIER','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 109 44','Activo'),(16,7,8,'RAMIREZ DE LA CRUZ BENIGNO MARTIN','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 101 37','Activo'),(17,7,8,'GOMORA CANO JONATHAN EDER','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 102 50','Activo'),(18,6,9,'ROMAN  RODRIGUEZ  ARIANI','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(19,6,9,'TERRONES LOPEZ IRMA','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(20,6,9,'AVALOS RODRIGUEZ ALEXIA ESMERALDA','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 108 13','Activo'),(21,6,9,'LOPEZ RAMIREZ ELIZABETH GUADALUPE','0000-00-00','0000-00-00','','','Guzmán','49000','Jalisco','','341 439 08','Activo'),(22,6,9,'BERNABE ALDANA LOURDES','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 103 27','Activo'),(23,6,9,'RODRIGUEZ TERRONES MARIA DE JESUS','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 103 25','Activo'),(24,4,10,'PADRON ALVARADO KRISTIAN CRISTOFER','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','341 146 28','Activo'),(25,4,10,'MIGUEL ANGEL RODRIGUEZ BEATRIZ','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 100 62','Activo'),(26,4,10,'LOPEZ SANTOS FRANCISCO','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(27,4,10,'JIMENEZ JONATHAN','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 108 46','Activo'),(28,4,10,'AVALOS RAMIREZ JAVIER','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(29,4,10,'ENCISO  RAMIREZ JAVIER','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(30,4,10,'RIVERA RAMIREZ ALEJANDRO','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 110 57','Activo'),(31,5,11,'GOMEZ  ENCISO  MARIO  ISRAEL','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(32,5,11,'LOPEZ LARIOS JORGE ALBERTO','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(33,5,11,'LUIS  ISIDRO JIMENEZ RODRIGUEZ','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 103 70','Activo'),(34,3,12,'ANGUIANO ORDUÑEZ JAVIER','0000-00-00','0000-00-00','','','Usmajac','49330','Jalisco','','342 109 90','Activo'),(35,3,12,'SANCHEZ ENCISO MIGUEL ANGEL','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(36,3,12,'RODRIGUEZ PADRON FRANCISCO','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(37,3,12,'ENCISO URDIANO MIGUEL','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(38,3,12,'ENCISO CORTES MARCO ANTONIO','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(39,9,16,'HERNADEZ CIBRIAN JOSE ADOLFO','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 108 18','Activo'),(40,9,16,'CASTILLO BENITEZ MAURICIO','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 105 30','Activo'),(41,9,16,'RODRIGO VILLA','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','342 109 12','Activo'),(42,10,13,'VILLA ENCISO SERGIO','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(43,10,13,'AVALOS ENCISO ARTURO','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(44,10,13,'ENCISO CASTILLO ROBER ADAN','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(45,10,13,'SALGADO ARTEAGA CLISOFORO','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(46,10,13,'SANCHEZ ENCISO ALEXANDER','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(47,10,13,'ENCISO BARAJAS LEOPOLDO','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(48,10,13,'ENCISO CASTILLO VIDAL','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo'),(49,10,17,'VARAGAS  AVARGAS  RUBEN','0000-00-00','0000-00-00','','','El Reparo','49339','Jalisco','','','Activo');
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipocomponentes`
--

DROP TABLE IF EXISTS `equipocomponentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipocomponentes` (
  `IdComponente` int(11) NOT NULL AUTO_INCREMENT,
  `IdEquipo` int(11) NOT NULL,
  `Descripcion` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdComponente`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipocomponentes`
--

LOCK TABLES `equipocomponentes` WRITE;
/*!40000 ALTER TABLE `equipocomponentes` DISABLE KEYS */;
INSERT INTO `equipocomponentes` VALUES (1,58,'Bandas B98'),(2,58,'Chumaceras SKF SNL 520-617'),(3,58,'Baleros 22220 CK'),(4,12,'Bandas C140'),(5,5,'Banda hule 23\" x 12.5 mts 3 capas'),(6,5,'Chumacera de pared de 1 1/2\" diam.'),(7,5,'Chumacera tipo tensor de 1 1/2\" diam.'),(8,8,'Chumacera de piso de 2\"'),(9,8,'Valvula de mariposa 6\" diam'),(10,8,'Cadena paso 60'),(11,8,'Cadena paso 160'),(12,10,'Chumacera de piso de 2\"'),(13,12,'Motor de gusano 120 HP 143 Amp 440 V'),(14,12,'Motor de cortador 2.2 Kw 4.2 Amp 440 V  '),(15,12,'Motor turbina 1 interior 3 Hp 4 Amp 440 '),(16,12,'Motor turbina 2 exterior 10 Hp 23 Amp 22'),(17,5,'Motor 1 Hp 3 Amp 220 V 1750 RPM'),(18,6,'Motor 45 Kw 220 V 1780 RPM'),(19,7,'Motor 22 Kw 73.6 Amp 220 V 1760 RPM'),(20,8,'Motor 1 de 2.2 Kw 8.29 Amp 220 V 1728 RP'),(21,8,'Motor 2 de 2.2 Kw 8.29 Amp 220 V 1728 RP'),(22,10,'Motor 1 de 2.2 Kw 8.29 Amp 220 V 1728 RP'),(23,10,'Motor 2 de 2.2 Kw 8.29 Amp 220 V 1728 RP'),(24,9,'Motor 2.2 Kw 5.31 Amp 220 V 1680 RPM'),(25,11,'Motor 2.2 Kw 5.31 Amp 220 V 1680 RPM');
/*!40000 ALTER TABLE `equipocomponentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipos`
--

DROP TABLE IF EXISTS `equipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipos` (
  `IdEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `IdProveedor` int(11) NOT NULL,
  `IdArea` int(11) NOT NULL,
  `Nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Marca` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Modelo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `NoSerie` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `FechaAdq` date NOT NULL,
  `FechaGarantia` date NOT NULL,
  `FechaUltMant` date NOT NULL,
  `FechaProxMant` date NOT NULL,
  `HorasTrabajadas` double NOT NULL,
  `HorasUltimoCorte` double NOT NULL,
  `Estado` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdEquipo`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipos`
--

LOCK TABLES `equipos` WRITE;
/*!40000 ALTER TABLE `equipos` DISABLE KEYS */;
INSERT INTO `equipos` VALUES (1,1,7,'Compresor 1 suministro planta','Compresor CBS presión máxima 8.8 kg/cm2','CBS','2080','209','2106-01-01','2017-01-01','2021-06-01','2021-12-01',0,0,'Activo'),(2,1,7,'Compresor 2 suministro planta','Compresor CBS presión máxima 8.8 kg/cm2','CBS','2080','210','2016-01-01','2017-01-01','2021-06-01','2021-12-01',0,0,'Activo'),(3,3,7,'Montacargas móvil Hyster 50','Montacargas de horquillas 2.2 Tn de capacidad de carga','Hyster','50','pend','2016-01-01','2017-01-01','2021-06-01','2021-09-01',0,0,'Activo'),(4,3,7,'Retroexcavadora CASE 580 super K','Retroexcavadora capacidad de cuchara0.95 m3','CASE','580SK','pend','2016-01-01','2017-01-01','2021-06-01','2021-09-01',0,0,'Activo'),(5,2,3,'Banda 1 alimentación trituración','Banda de hule 23\" ancho con levantadores 3 capas x 12.5 mts','p','p','p','2016-01-01','2016-12-31','2021-06-01','2021-09-01',0,0,'Activo'),(6,1,3,'Molino navajas área lavado mat baja dens','Triturador de navajas de 3 3/4\" x 15\"','s','s','s','2016-06-01','2016-12-31','2021-07-30','2021-08-31',0,0,'Activo'),(7,2,3,'Gusano 1 materiales baja densidad','Gusano helicoidal transportador a tina de  lavado 1','s','s','s','2016-01-01','2016-12-31','2021-07-30','2021-08-31',0,0,'Activo'),(8,2,3,'Tina de lavado 1 mat. baja densidad','Tina de lavado con rodillos de 24\" diam x 55 1/2\" long','s','s','s','2016-01-01','2016-12-31','2021-07-30','2021-08-31',0,0,'Activo'),(9,2,3,'Banda paletas 1 alimentación a tina 2','Banda 39\" ancho de cadena paso 2\"','s','s','s','2016-01-01','2016-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(10,2,3,'Tina de lavado 2','Tina de lavado con rodillos de 24\" diam x 55 1/2\" long','s','s','s','2016-01-01','2016-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(11,2,3,'Banda paletas 2 alimentación squeezer','Banda 39\" ancho de cadena paso 2\"','s','s','s','2016-01-01','2016-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(12,2,3,'Squeezer (Exprimidor de fibras lavadas)','Conjunto gusano, extrusor y cortador de navajas','YARI','PB300L','8002766','2018-10-01','2019-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(13,2,3,'Turboventilador 1 decarga de squeezer','Turboventilador decarga squeezer','s','s','s','2018-10-01','2019-10-31','2021-07-30','2021-08-30',0,0,'Activo'),(14,2,3,'Turboventilador 2 transporte a tolva','Turboventilador decarga squeezer a tolva materia prima','s','s','s','2018-01-01','2019-10-31','2021-07-30','2021-08-30',0,0,'Activo'),(15,1,10,'Banda alimentación desfibradora gruesos','Banda alimentación desfibradora materiales gruesos','s','s','s','2018-01-01','2018-12-31','2021-06-01','2021-01-01',0,0,'Activo'),(16,1,10,'Molino navajas desfibradora mat.grueso','Molino de navajas desfibradora materiales gruesos','s','s','s','2018-01-01','2018-12-31','2021-06-01','2021-10-30',0,0,'Activo'),(17,1,10,'Banda descarga desfibradora mat gruesos','Banda de descarga a piso desfibradora materiales gruesos','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(18,1,10,'Molino navajas mat. recuperación','Molino de navajas desfibradora materiales de recuperación','s','s','s','2018-01-01','0000-00-00','2021-07-30','2021-08-30',0,0,'Activo'),(19,3,3,'Tolva recepción lavado mat alta densidad','Tolva para recepción materiales alta densidad para lavado','s','s','s','2018-08-01','2019-08-31','2021-07-30','2021-08-30',0,0,'Activo'),(20,3,3,'Tina lavado materiales alta densidad','Tina de lavado materiales alta densidad','s','s','s','2018-01-01','2019-01-31','2021-07-30','2021-08-30',0,0,'Activo'),(21,3,3,'Elevador centrifugo lavado mat alta dens','Elevador centrifugo de lavado de materiales de alta densidad','s','s','s','2018-10-01','2019-10-31','2021-07-30','2021-08-30',0,0,'Activo'),(22,3,3,'Secador materiales alta densidad','Secador materiales alta densidad','s','s','s','2018-01-01','2018-10-31','2021-07-30','2021-08-30',0,0,'Activo'),(23,3,3,'Sistema descarga lavado mat alta densid','Sistema de transporte para descarga de lavado de materiales de alta densidad','s','s','s','2018-01-01','2018-10-31','2021-07-30','2021-08-30',0,0,'Activo'),(24,3,4,'Alimentador de banda peletizadora 1','Alimentador de banda peletizadora 1','s','s','s','2018-01-01','2018-01-31','2021-07-30','2021-08-30',0,0,'Activo'),(25,3,4,'Compactador peletizadora 1','Compactador peletizadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(26,3,4,'Transportador helicoidal 1 peletizador 1','Transportador helicoidal 1 peletizadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(27,3,4,'Banco de resistencias 1 peletizadora 1','Banco de resistencias 1 peletizadora 1 con desgasificador','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(28,3,4,'Banco de resistencias 2 peletizadora 1','Banco de resistencias 2 peletizadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(29,3,4,'Portamalla limpieza 1 peletizadora 1','Portamalla limpieza 1 peletizadora 1','s','s','s','0218-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(30,3,4,'Transportador helicoidal 2 peletizador 1','Transportador helicoidal 2 peletizadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2018-08-30',0,0,'Activo'),(31,3,4,'Banco de resistencias  3 peletizadora 1','Banco de resistencias  3 peletizadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(32,3,4,'Portamalla limpieza 2 peletizadora 1','Portamalla limpieza 2 peletizadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(33,3,4,'Ciclon de descarga peletizadora 1','Ciclon de descarga peletizadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(34,3,4,'Elevador centrifugo peletizadora 1','Elevador centrifugo peletizadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(35,3,4,'Criba peletizadora 1','Criba peletizadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(36,3,4,'Sistema transporte finos peletizadora 1','Sistema transporte finos peletizadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(37,3,4,'Sistema enfriamiento agua 1 pelet 1','Sistema enfriamiento agua 1 peletizadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(38,3,4,'Sistema enfriamiento agua 2 pelet 1','Sistema enfriamiento agua 2 peletizadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(39,1,7,'Bascula electrónica pesaje materiales','Bascula electrónica pesaje materiales en proceso','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(40,1,4,'Tolva de alimentación peletizadora 2','Tolva de alimentación peletizadora 2','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(41,1,10,'Transportador helicoidal 1 peletizado 2','Transportador helicoidal 1 peletizadora 2','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(42,1,4,'Portamalla limpieza 1 peletizadora 2','Portamalla limpieza 1 peletizadora 2','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(43,1,4,'Transportador helicoidal 2 peletizador 2','Transportador helicoidal 2 peletizadora 2','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(44,1,4,'Portamalla limpieza 2 peletizadora 2','Portamalla limpieza 2 peletizadora 2','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(45,1,4,'Tina enfriamiento peletizadora 2','Tina enfriamiento peletizadora 2','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(46,1,4,'Sistema tracción hilo peletizadora 2','Sistema tracción hilo peletizadora 2 con secador y cortador','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(47,1,4,'Sistema de enfriamiento agua pelet 2','Sistema de enfriamiento agua peletizadora 2','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(48,1,7,'Impresora flexográfica para bobina de pl','Impresora flexográfica para bobina de plástico','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(49,1,6,'Alimentador bolseadora 1','Alimentador bolseadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(50,1,6,'Cortador bolseadora 1','Cortador bolseadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(51,1,6,'Sellador bolseadora 1','Sellador bolseadora 1','s','s','s','2018-01-01','2018-01-31','2021-07-30','2021-08-30',0,0,'Activo'),(52,1,6,'Mesa y rodillos bolseadora 1','Mesa y rodillos bolseadora 1','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(53,1,6,'Alimentador bolseadora 2','Alimentador bolseadora 2','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(54,1,6,'Cortador bolseadora 2','Cortador bolseadora 2','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(55,1,6,'Sellador bolseadora 2','Sellador bolseadora 2','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(56,1,6,'Mesa y rodillos bolseadora 2','Mesa y rodillos bolseadora 2','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(57,2,2,'Afiladora de navajas MF2510A','Afiladora de navajas MF2510A','s','MF2510A','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(58,2,10,'Molino de navajas para mangueras','Molino de navajas para mangueras','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo'),(59,2,10,'Transportador helicoidal molienda mangue','Transportador helicoidal molienda manguera para descarga','s','s','s','2018-01-01','2018-12-31','2021-07-30','2021-08-30',0,0,'Activo');
/*!40000 ALTER TABLE `equipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factmanttoext`
--

DROP TABLE IF EXISTS `factmanttoext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factmanttoext` (
  `IdOrdenExt` int(11) NOT NULL,
  `Factura` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Condiciones` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` date NOT NULL,
  `FechaVto` date NOT NULL,
  `Subtotal` double NOT NULL,
  `Iva` double NOT NULL,
  `Total` double NOT NULL,
  `Saldo` double NOT NULL,
  PRIMARY KEY (`IdOrdenExt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factmanttoext`
--

LOCK TABLES `factmanttoext` WRITE;
/*!40000 ALTER TABLE `factmanttoext` DISABLE KEYS */;
INSERT INTO `factmanttoext` VALUES (1,'ZZX','Crédito','2021-08-20','2021-08-26',1000,160,1160,0),(2,'WER122','Crédito','2021-08-21','2021-08-27',2000,320,2320,0),(3,'fggf','Contado','2022-02-01','2022-02-03',1500,240,1740,0);
/*!40000 ALTER TABLE `factmanttoext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finmanttoext`
--

DROP TABLE IF EXISTS `finmanttoext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finmanttoext` (
  `IdFinManttoExt` int(11) NOT NULL AUTO_INCREMENT,
  `IdOrdenExt` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Observaciones` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `DuracionHoras` int(11) NOT NULL,
  PRIMARY KEY (`IdFinManttoExt`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finmanttoext`
--

LOCK TABLES `finmanttoext` WRITE;
/*!40000 ALTER TABLE `finmanttoext` DISABLE KEYS */;
INSERT INTO `finmanttoext` VALUES (1,1,'2021-08-12','todo de lujo',34),(2,2,'2021-08-20','todo ok',120),(3,3,'2022-02-01','test',4);
/*!40000 ALTER TABLE `finmanttoext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finmanttoint`
--

DROP TABLE IF EXISTS `finmanttoint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finmanttoint` (
  `IdFinManttoInt` int(11) NOT NULL AUTO_INCREMENT,
  `IdOrdenInt` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Observaciones` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `DuracionHoras` int(11) NOT NULL,
  PRIMARY KEY (`IdFinManttoInt`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finmanttoint`
--

LOCK TABLES `finmanttoint` WRITE;
/*!40000 ALTER TABLE `finmanttoint` DISABLE KEYS */;
INSERT INTO `finmanttoint` VALUES (1,2,'2022-02-01','test',3);
/*!40000 ALTER TABLE `finmanttoint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordenmanttoext`
--

DROP TABLE IF EXISTS `ordenmanttoext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordenmanttoext` (
  `IdOrdenExt` int(11) NOT NULL,
  `IdPrograma` int(11) NOT NULL,
  `IdProveedor` int(11) NOT NULL,
  `FechaRegistro` date NOT NULL,
  `Descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `FechaEntrega` date NOT NULL,
  `Estado` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdOrdenExt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenmanttoext`
--

LOCK TABLES `ordenmanttoext` WRITE;
/*!40000 ALTER TABLE `ordenmanttoext` DISABLE KEYS */;
INSERT INTO `ordenmanttoext` VALUES (1,1,3,'2021-08-13','no funciona nada el equipo','2021-08-20','Pagada'),(2,1,2,'2021-08-09','revisión genral','2021-08-14','Pagada'),(3,19,2,'2022-02-01','test','2022-02-01','Pagada');
/*!40000 ALTER TABLE `ordenmanttoext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordenmanttoint`
--

DROP TABLE IF EXISTS `ordenmanttoint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordenmanttoint` (
  `IdOrdenInt` int(11) NOT NULL,
  `IdPrograma` int(11) NOT NULL,
  `IdEmpleado` int(11) NOT NULL,
  `FechaRegistro` date NOT NULL,
  `Descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `FechaEstimadaEntrega` date NOT NULL,
  `Estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdOrdenInt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenmanttoint`
--

LOCK TABLES `ordenmanttoint` WRITE;
/*!40000 ALTER TABLE `ordenmanttoint` DISABLE KEYS */;
INSERT INTO `ordenmanttoint` VALUES (1,2,17,'2021-08-12','El programa diario que es el 2 tomar temperaturas........','2021-08-14','Ejecución'),(2,25,17,'2022-02-02','asd','2022-02-02','Terminada');
/*!40000 ALTER TABLE `ordenmanttoint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagomanttoext`
--

DROP TABLE IF EXISTS `pagomanttoext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagomanttoext` (
  `IdPagoOrdenE` int(11) NOT NULL AUTO_INCREMENT,
  `IdOrdenExt` int(11) NOT NULL,
  `Referencia` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` date NOT NULL,
  `Importe` double NOT NULL,
  PRIMARY KEY (`IdPagoOrdenE`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagomanttoext`
--

LOCK TABLES `pagomanttoext` WRITE;
/*!40000 ALTER TABLE `pagomanttoext` DISABLE KEYS */;
INSERT INTO `pagomanttoext` VALUES (1,1,'Transacción','2021-08-14',500),(2,1,'Cheque','2021-08-06',5),(3,1,'Efectivo','2021-08-12',55),(4,2,'Cheque','2021-08-19',2000),(5,2,'Transacción','2021-08-20',320);
/*!40000 ALTER TABLE `pagomanttoext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagoscompras`
--

DROP TABLE IF EXISTS `pagoscompras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagoscompras` (
  `IdPago` int(11) NOT NULL AUTO_INCREMENT,
  `IdCompra` int(11) NOT NULL,
  `Referencia` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` date NOT NULL,
  `Importe` double NOT NULL,
  PRIMARY KEY (`IdPago`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagoscompras`
--

LOCK TABLES `pagoscompras` WRITE;
/*!40000 ALTER TABLE `pagoscompras` DISABLE KEYS */;
INSERT INTO `pagoscompras` VALUES (1,1,'b','2022-01-24',120.06);
/*!40000 ALTER TABLE `pagoscompras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `IdProducto` int(11) NOT NULL AUTO_INCREMENT,
  `IdSubCategoria` int(11) NOT NULL,
  `Descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Maximo` float NOT NULL,
  `Minimo` float NOT NULL,
  `PuntoReorden` float NOT NULL,
  `Existencia` float NOT NULL,
  `CostoProm` double NOT NULL,
  `UltCosto` double NOT NULL,
  `UnidadMedida` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Marca` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Modelo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `NoParte` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,17,'Balero FAG 6306 2rsr',0,0,0,2,0,0,'Piezas','FAG','X','6306'),(2,17,'Balero FAG 6305 2rsr',0,0,0,1,0,0,'Piezas','FAG','x','6305'),(3,17,'Balero Accor 3204 2rs',0,0,0,4.53,0.13,1.09,'Piezas','Accor','x','3204'),(4,17,'Balero FAG 6004 2rsr',0,0,0,3,0,0,'Piezas','FAG','x','6004'),(5,17,'Balero NTN 6C004Z',0,0,0,2,0,0,'Piezas','NTN','x','6C004Z'),(6,17,'Balero Timken SE1522 5520',0,0,0,0,0,0,'Piezas','Timken','x','SE1522 5520'),(7,26,'Chumacera Craft F-206',0,0,0,2.72,0.16,0.61,'Piezas','Craft','x','F-206'),(8,17,'Balero Accor 6006 2rs',0,0,0,2,0,0,'Piezas','Accor','x','6006'),(9,17,'Balero SKF 6306 2Z',0,0,0,1,0,0,'Piezas','SKF','x','6306'),(10,17,'Balero FAG 1216 tvn',0,0,0,1,0,0,'Piezas','FAG','x','1216'),(11,26,'Chumacera FSB UCT-206',0,0,0,1,0,0,'Piezas','FSB','x','UCT-206'),(12,29,'Contactor Siemens 3RT2026',0,0,0,3,0,0,'Piezas','Siemens','3RT2026','x'),(13,33,'Clemas ABB M/10',0,0,0,5,0,0,'Piezas','ABB','M/10','x'),(14,33,'Clemas ABB MA/2.5',0,0,0,6,0,0,'Piezas','ABB','MA/2.5','x'),(15,31,'Controlador digital OMRON E5EC-RR2ASM-820',0,0,0,1,0,0,'Piezas','OMRON','E5EC-RR2ASM-820','x'),(16,32,'Inversor FQ WEGG CFW8 220/440 V',0,0,0,1,0,0,'Piezas','WEGG','CFW8','x'),(17,34,'Fotosensor ERC Autonics BEN5M-MFR24-240',0,0,0,3,0,0,'Piezas','Autonics','BEN5M-MFR24-240','x'),(18,29,'Contactor Siemens 3RT1036-1AJ16',0,0,0,1,0,0,'Piezas','Siemens','3RT1036-1AJ16','x'),(19,31,'Controlador de temperatura Temcoline 737-S00100-24',0,0,0,1,0,0,'Piezas','Temcoline','737-S00100-24','x'),(20,29,'Contactor magnético DEVICO/KOREA DMC 40B 2A2B',0,0,0,3,0,0,'Piezas','Devico','DMC 40B 2A2B','x'),(21,28,'Relevador térmico LS Industrial GTH-22',0,0,0,1,0,0,'Piezas','LS industrial','GTH-22','x'),(22,28,'Relevador estado solido Hanyoung Nux SSR-2A402Z',0,0,0,3,0,0,'Piezas','Hanyoung','SSR-2A402Z','x'),(23,40,'Medidor para panel Autonics MT4W-DV-40',0,0,0,1,0,0,'Piezas','Autonics','MT4W-DV-40','x'),(24,28,'Relevador control LS Industrial GMR-480461611020',0,0,0,1,0,0,'Piezas','LS industrial','GMR-480461611020','x'),(25,39,'Amperímetro WYES WY-S72AA',0,0,0,2.04,0,0,'Piezas','WYES','WY-S72AA','x'),(26,31,'Controlador temperatura Hanyoung Nux AX4-1A100-240',0,0,0,2,0,0,'Piezas','Hanyoung','AX4-1A100-240V','x'),(27,28,'Relevador Siemens 3RU1136-4MBO 50A',0,0,0,1,0,0,'Piezas','Siemens','3RU1136-4MBO 50A','x'),(28,35,'Pines planos ABB CR-M230AC2',0,0,0,10,0,0,'Piezas','ABB','CR-M230AC2','x'),(29,29,'Contactor Siemens 3RT20171AN61',0,0,0,1,0,0,'Piezas','Siemens','3RT20171AN61','x'),(30,29,'Contactor Metamec 6B21518',0,0,0,1,0,0,'Piezas','Metamec','6B21518','x'),(31,29,'Contactor Metamec DHNT 6B10963',0,0,0,1,0,0,'Piezas','Metamec','6B10963','x'),(32,29,'Contactor Chint DZ4760',0,0,0,2,24.5,24.5,'Piezas','Chint','DZ4760','x'),(33,36,'Botón pulsador SDO2009',0,0,0,-1,0,0,'Piezas','Sin marca','SDO2009','x'),(34,36,'Botón pulsador BS216B',0,0,0,2,15,15,'Piezas','Sin marca','BS216B','x');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programaequipo`
--

DROP TABLE IF EXISTS `programaequipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programaequipo` (
  `IdPrograma` int(11) NOT NULL AUTO_INCREMENT,
  `IdEquipo` int(11) NOT NULL,
  `Descripcion` varchar(600) COLLATE utf8_spanish_ci NOT NULL,
  `TipoFrecuencia` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Frecuencia` int(11) NOT NULL,
  PRIMARY KEY (`IdPrograma`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programaequipo`
--

LOCK TABLES `programaequipo` WRITE;
/*!40000 ALTER TABLE `programaequipo` DISABLE KEYS */;
INSERT INTO `programaequipo` VALUES (1,5,'a) Revisar desgaste lateral de la banda y cubierta superior de hule, Checar estado de engrapado. Revisar sujeción y desgaste de levantadores de hule. Verificar alineación y tensión de banda.\nb) Realizar limpieza y revisar estado y fijación de chumaceras de polea motriz e inducida. Limpiar y lubricar tensores.\nc) Revisar estado de poleas y realizar limpieza entre flechas y carcaza de banda.\nd) Realizar limpieza de motor y reductor. Revisar nivel de aceite de reductor.','Semana',1),(2,5,'Con equipo en operación: \na) Tomar temperatura de chumaceras polea motriz e inducida. \nb) Tomar temperatura de motor y reductor de transmisión.\nc) Revisar con estetoscopio motor y reductor por ruidos anormales.\nd) Verificar alineación de banda.','Día',1),(3,5,'Con equipo en operación.\n1. Lubricar chumaceras de polea motriz e inducida. Grasa litio EP2.','Día',7),(4,6,'1. Realizar limpieza general del equipo. Retirar guardas de protección.\n2. Revisar alineación y desgaste de bandas de transmisión y poleas.\n3. Realizar limpieza de motor, verificar fijación de guarda de ventilador de enfriamiento. Y tornillos de base.\n4. Revisar fijación y desgaste de navajas de molino. Cambiar si es necesario.\n5. Revisar estado y fijación de chumaceras de rotor.','Semana',2),(5,6,'1. Revisar fijación y desgaste de navajas de molino. Cambiar si es necesario.','Día',7),(6,6,'Con equipo en operación.\n1. Tomar temperatura de chumaceras de rotor de molino.\n2. Tomar temperatura de baleros apoyo rotor de motor eléctrico y estator.\n3. Con estetoscopio escuchar balero de motor.\n4. Con estetoscopio revisar chumaceras de apoyo de molino.','Día',3),(7,8,'1. Realizar limpieza general del equipo.\n2. Descargar agua de lavado de tina.\n3. Verificar estado de válvulas de mariposa de las descargas. Y fijación de tubería de drenaje.','Día',7),(8,8,'1. Realizar limpieza general del equipo.\n2. Descargar agua de lavado de tina.\n3. Verificar estado de válvulas de mariposa de las descargas. Y fijación de tubería de drenaje.\n4. Revisar estado de levantadores y paletas de rodillos.\n5. Revisar estado y fijación de chumaceras.\n6. Revisar desgaste de catarinas y cadenas de accionamiento de rodillos. Lubricar cadena.\n7. Realizar limpieza de transmisión y checar nivel de aceite reductor.','Semana',2),(9,8,'Con equipo en operación.\n1. Lubricar chumaceras de rodillos. Grasa litio EP2.','Día',7),(10,8,'Con equipo en operación.\n1. Tomar temperatura de chumaceras de rodillos.\n2. Tomar temperatura de baleros apoyo rotor de motores eléctricos y reductores de transmisión.\n3. Con estetoscopio escuchar baleros de motores y reductores.\n4. Con estetoscopio revisar chumaceras de apoyo de rodillos.\n5. Verificación saturación por suciedad de agua de lavado.','Día',3),(11,7,'1. Realizar limpieza general del equipo.\n2. Revisar fijación de motor de transmisión y tapa de ventilador.\n3. Revisar alineación y desgaste de bandas y poleas de transmisión.\n4. Revisar desgaste de gusano helicoidal y carcaza.\n5. Revisar fijación y estado de chumaceras.','Semana',2),(12,7,'Con equipo en operación. \n1. Lubricar chumaceras de apoyo de gusano. Grasa litio EP2.','Día',7),(13,7,'Con equipo en operación. \n1. Tomar temperatura de chumaceras de gusano. \n2. Tomar temperatura de baleros apoyo rotor de motor eléctrico y estator. \n3. Con estetoscopio escuchar balero de motor. \n4. Con estetoscopio revisar chumaceras de gusano.','Día',3),(14,9,'1. Realizar limpieza general del equipo.\n2. Revisar estado de ángulos y levantadores.\n3. Revisar desgaste de cadenas y catarinas.\n4. Revisar fijación y estado de chumaceras.\n5. Revisar nivel de aceite de reductor.\n6. Revisar fijación de motor eléctrico.','Semana',2),(15,9,'Con equipo en operación.\n1. Lubricar chumaceras de rodillo motriz e inducido. Grasa litio EP2.','Día',7),(16,9,'Con equipo en operación. \n1. Tomar temperatura de chumaceras de rodillos. \n2. Tomar temperatura de baleros apoyo rotor de motor eléctrico y estator. Y reductor\n3. Con estetoscopio escuchar balero de moto y reductor. \n4. Con estetoscopio revisar chumaceras de rodillos.','Día',3),(17,10,'1. Realizar limpieza general del equipo. \n2. Descargar agua de lavado de tina. \n3. Verificar estado de válvulas de mariposa de las descargas. Y fijación de tuberías de drenaje.','Día',7),(18,10,'1. Realizar limpieza general del equipo. \n2. Descargar agua de lavado de tina. \n3. Verificar estado de válvulas de mariposa de las descargas. Y fijación de tubería de drenaje. \n4. Revisar estado de levantadores y paletas de rodillos.\n5. Revisar estado y fijación de chumaceras de rodillos. \n6. Revisar desgaste de catarinas y cadenas de accionamiento de rodillos. Lubricar cadena. \n7. Realizar limpieza de transmisión y checar nivel de aceite reductor.','Semana',2),(19,10,'Con equipo en operación. \n1. Lubricar chumaceras de rodillos. Grasa litio EP2.','Día',7),(20,10,'Con equipo en operación. \n1. Tomar temperatura de chumaceras de rodillos. \n2. Tomar temperatura de baleros apoyo rotor de motores eléctricos y reductores de transmisión. \n3. Con estetoscopio escuchar baleros de motores y reductores. \n4. Con estetoscopio revisar chumaceras de apoyo de rodillos. 5. Verificación saturación por suciedad de agua de lavado.','Día',3),(21,11,'1. Realizar limpieza general del equipo. \n2. Revisar estado de ángulos y levantadores. \n3. Revisar desgaste de cadenas y catarinas. \n4. Revisar fijación y estado de chumaceras. \n5. Revisar nivel de aceite de reductor. \n6. Revisar fijación de motor eléctrico.','Semana',2),(22,11,'Con equipo en operación. \n1. Lubricar chumaceras de rodillo motriz e inducido. Grasa litio EP2.','Día',7),(23,11,'Con equipo en operación. \n1. Tomar temperatura de chumaceras de rodillos. \n2. Tomar temperatura de baleros apoyo rotor de motor eléctrico y estator. Y reductor \n3. Con estetoscopio escuchar balero de moto y reductor. \n4. Con estetoscopio revisar chumaceras de rodillos.','Día',3),(24,12,'1. Realizar limpieza general del equipo\n2. Verificar fijación de motor y tapa de ventilador.\n3. Revisar nivel de aceite de reductor y estado de engranes.\n4. Revisar desgaste de gusano y carcaza.\n5. Revisar estado y fijación de navajas de corte de material.\n6. Revisar fijación de motor y reductor de cortador. Así como de su base y correderas.\n7. Revisar nivel de aceite de reductor de cortador.\n8. Revisar estado de sistema de calentamiento de material.\n9. Revisar estado de chumaceras de gusano.','Semana',2),(25,12,'Con equipo en operación. \n1. Tomar temperatura de baleros apoyo rotor de motor eléctrico y estator. Y reductor de gusano.\n2. Tomar temperatura de baleros apoyo rotor de motor eléctrico, estator y reductor de cortador.\n3. Con estetoscopio escuchar baleros de motor y reductor de gusano. \n4. Con estetoscopio revisar baleros de motor y reductor de cortador.','Día',3);
/*!40000 ALTER TABLE `programaequipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `IdProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `NombreP` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Domicilio` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Colonia` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Ciudad` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `CP` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `Estado` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `Tel` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Celular` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Representante` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `DescripcionTipoProv` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Saldo` double NOT NULL,
  PRIMARY KEY (`IdProveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Proveedor 1','S','S','Cd','49000','x','1','1','pendiente@pnd.com','s','s',0),(2,'Proveedor 2','s','s','s','49000','s','1','1','pendiente@pnd.com','s','s',0),(3,'Proveedor 3','s','s','cd','49000','j','3','3','pendiente@pnd.com','s','s',0);
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puestos`
--

DROP TABLE IF EXISTS `puestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puestos` (
  `IdPuesto` int(11) NOT NULL AUTO_INCREMENT,
  `DescripcionP` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdPuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puestos`
--

LOCK TABLES `puestos` WRITE;
/*!40000 ALTER TABLE `puestos` DISABLE KEYS */;
INSERT INTO `puestos` VALUES (1,'Gerente'),(2,'Coordinador logística'),(3,'Contador'),(4,'Coordinador producción'),(5,'Supervisor'),(6,'Mecánico'),(7,'Eléctrico'),(8,'Operador de equipo móvil'),(9,'Operador bolseo'),(10,'Operador peletizado'),(11,'Operador extruder'),(12,'Operador lavado'),(13,'Operador molienda acolchado'),(14,'Encargado lavado'),(15,'Auxiliar'),(16,'Recolector'),(17,'Operador molienda manguera');
/*!40000 ALTER TABLE `puestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisicionesproductos`
--

DROP TABLE IF EXISTS `requisicionesproductos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requisicionesproductos` (
  `IdRequisicion` int(11) NOT NULL AUTO_INCREMENT,
  `IdEmpleadoSolicita` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `TotalAprox` double NOT NULL,
  PRIMARY KEY (`IdRequisicion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisicionesproductos`
--

LOCK TABLES `requisicionesproductos` WRITE;
/*!40000 ALTER TABLE `requisicionesproductos` DISABLE KEYS */;
INSERT INTO `requisicionesproductos` VALUES (1,2,'2022-01-23','Ejecución',103.5);
/*!40000 ALTER TABLE `requisicionesproductos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategorias`
--

DROP TABLE IF EXISTS `subcategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategorias` (
  `IdSubCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `IdCategoria` int(11) NOT NULL,
  `DescripcionSC` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdSubCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategorias`
--

LOCK TABLES `subcategorias` WRITE;
/*!40000 ALTER TABLE `subcategorias` DISABLE KEYS */;
INSERT INTO `subcategorias` VALUES (1,11,'Equipo protección personal'),(2,4,'Aceites'),(3,4,'Grasas'),(4,5,'Laminas'),(5,5,'Canal'),(6,5,'Angulo'),(7,5,'Solera'),(8,14,'Llantas'),(9,14,'Sistema eléctrico'),(10,14,'Transmisión'),(11,14,'Sistema hidráulico'),(12,14,'Frenos'),(13,14,'Motor'),(14,14,'Sistema enfriamiento'),(15,3,'Herramientas de mano'),(16,3,'Herramientas eléctricas'),(17,10,'Rodamientos'),(18,10,'Banda de transmisión'),(19,10,'Poleas'),(20,10,'Rodillos'),(21,10,'Sellos'),(22,10,'Banda transportadora'),(23,10,'Cadena de transmisión'),(24,10,'Rueda dentada'),(25,10,'Válvulas'),(26,10,'Chumaceras'),(27,10,'Acoplamientos'),(28,8,'Relevador'),(29,8,'Contactor'),(30,8,'Interruptor'),(31,8,'Controlador'),(32,8,'Inversor'),(33,8,'Clemas'),(34,8,'Fotosensor'),(35,8,'Pines'),(36,8,'Botón pulsador'),(37,8,'Regulador'),(38,8,'Caja de conexiones'),(39,8,'Amperímetro'),(40,8,'Medidor');
/*!40000 ALTER TABLE `subcategorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(15) NOT NULL,
  `Contrasena` varchar(100) NOT NULL,
  `Sistema` char(1) NOT NULL,
  `Privilegio` tinyint(4) NOT NULL,
  UNIQUE KEY `usuarios` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'RENE','4ff99c52dc14973ab7fc14601f066877','M',2),(2,'InvAdmin','577b83c735d621dd5c23cf60fa337377','I',2),(3,'Cama1998','81dc9bdb52d04dc20036dbd8313ed055','I',1),(4,'Stelita20','202cb962ac59075b964b07152d234b70','M',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valesconsumibles`
--

DROP TABLE IF EXISTS `valesconsumibles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valesconsumibles` (
  `IdValeCons` int(11) NOT NULL AUTO_INCREMENT,
  `IdRequisicion` int(11) NOT NULL,
  `IdEmpleadoRecibe` int(11) NOT NULL,
  `FechaEmision` date NOT NULL,
  `FechaSurte` date NOT NULL,
  `Motivo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdValeCons`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valesconsumibles`
--

LOCK TABLES `valesconsumibles` WRITE;
/*!40000 ALTER TABLE `valesconsumibles` DISABLE KEYS */;
INSERT INTO `valesconsumibles` VALUES (1,1,2,'2022-01-24','2022-01-24','para mantto'),(2,1,2,'2022-01-25','2022-01-25','mantto 2');
/*!40000 ALTER TABLE `valesconsumibles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valesordenmanttoint`
--

DROP TABLE IF EXISTS `valesordenmanttoint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valesordenmanttoint` (
  `IdVale` int(11) NOT NULL,
  `IdOrdenInt` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`IdVale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valesordenmanttoint`
--

LOCK TABLES `valesordenmanttoint` WRITE;
/*!40000 ALTER TABLE `valesordenmanttoint` DISABLE KEYS */;
INSERT INTO `valesordenmanttoint` VALUES (1,1,'0000-00-00'),(2,1,'2021-08-13'),(3,2,'2022-02-01');
/*!40000 ALTER TABLE `valesordenmanttoint` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-24 18:54:09
