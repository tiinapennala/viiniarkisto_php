-- MySQL dump 10.15  Distrib 10.0.27-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: a1402802
-- ------------------------------------------------------
-- Server version	10.0.27-MariaDB-0+deb8u1

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
-- Table structure for table `MatinKommentit`
--

DROP TABLE IF EXISTS `MatinKommentit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MatinKommentit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kommentti` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MatinKommentit`
--

LOCK TABLES `MatinKommentit` WRITE;
/*!40000 ALTER TABLE `MatinKommentit` DISABLE KEYS */;
INSERT INTO `MatinKommentit` VALUES (1,'Huominen on aina tulevaisuutta.'),(2,'Ruokarauha se on merirosvollakin.'),(3,'Mulla on karismaa!'),(4,'Se on ihan fifty-sixty miten käy.');
/*!40000 ALTER TABLE `MatinKommentit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ViiniArkisto`
--

DROP TABLE IF EXISTS `ViiniArkisto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ViiniArkisto` (
  `Id_Viini` int(11) NOT NULL AUTO_INCREMENT,
  `Nimi` varchar(100) NOT NULL,
  `Vuosi` int(11) NOT NULL,
  `Tyyppi` varchar(50) NOT NULL,
  `Maa` varchar(50) NOT NULL,
  `Rypale` varchar(50) NOT NULL,
  `Hinta` int(11) NOT NULL,
  `Arvio` int(11) NOT NULL,
  `Arvostelu` varchar(500) NOT NULL,
  PRIMARY KEY (`Id_Viini`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ViiniArkisto`
--

LOCK TABLES `ViiniArkisto` WRITE;
/*!40000 ALTER TABLE `ViiniArkisto` DISABLE KEYS */;
/*!40000 ALTER TABLE `ViiniArkisto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Viinit`
--

DROP TABLE IF EXISTS `Viinit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Viinit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nimi` varchar(100) NOT NULL,
  `vuosi` int(11) DEFAULT NULL,
  `tyyppi` varchar(50) NOT NULL,
  `maa` varchar(50) DEFAULT NULL,
  `rypale` varchar(50) DEFAULT NULL,
  `hinta` decimal(11,0) DEFAULT NULL,
  `arvio` int(11) NOT NULL,
  `arvostelu` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Viinit`
--

LOCK TABLES `Viinit` WRITE;
/*!40000 ALTER TABLE `Viinit` DISABLE KEYS */;
INSERT INTO `Viinit` VALUES (3,'Llai Llai Sauvignon Blanc',2015,'Valkoviini','Chile, Bío Bío','Sauvignon Blanc',10,3,'Ihan ok, ei erityisen mieleenpainuva.'),(4,'Testi Viini',0,'Testi Viini','','',0,4,''),(8,'Duval-Leroy Blanc de Blancs Prestige Grand Cru Brut',2006,'Champagne','Ranska','',50,5,''),(10,'Block 50 Mourvèdre Grenache',0,'Punaviini','','',14,1,''),(11,'Lindemans Cawarra Shiraz Cabernet',2015,'Punaviini','Australia','Shiraz, Cabernet Sauvignon',8,4,'Oikein hyvää ollakseen 8 euron viini'),(12,'Tenuta Marsiliana Vermentino',2015,'Valkoviini','','',17,5,''),(14,'Trivento Chardonnay',2016,'Valkoviini','','',7,2,''),(15,'martize',0,'punaviini','','',0,5,'sairaan hyvää!!!! <3'),(16,'Malbec viini',0,'punaviini','','',0,2,'huono viini, älä osta');
/*!40000 ALTER TABLE `Viinit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-17 17:12:56
