CREATE DATABASE  IF NOT EXISTS `phpmyadmin` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `phpmyadmin`;
-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: phpmyadmin
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

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
-- Table structure for table `Ifiles`
--

DROP TABLE IF EXISTS `Ifiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ifiles` (
  `fid` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `hash` varchar(500) NOT NULL,
  `lid` int(20) NOT NULL,
  `uid` int(20) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ifiles`
--

LOCK TABLES `Ifiles` WRITE;
/*!40000 ALTER TABLE `Ifiles` DISABLE KEYS */;
INSERT INTO `Ifiles` VALUES (2,'batman.jpg','5d5fe1e316e8c370994fc9955bcb6f3879499b29df2bf8d6cdf62ff737ec6fe11838ff676d6bbe5d5c8da10135196e8eddc90a78805553d64c0d0dd0db8fa67d',0,1),(3,'vicky.jpg','6ffacc75a399d8a128363851ee388c5f102e269da5833162faa85d44fda9a3a73f2079de600d7235078ae552243e3886de2bafd86287c238d0bac4de0bc6589b',0,1),(7,'joker1.jpg','6ffacc75a399d8a128363851ee388c5f102e269da5833162faa85d44fda9a3a73f2079de600d7235078ae552243e3886de2bafd86287c238d0bac4de0bc6589b',3,3),(8,'Menu_001.png','0b273ce3b7165759bce1a56a55abd1f2a82d3c6642f454d8baa226b6b0a3c6816be8c6c5eed063d5ae78520b167acf997df7a295ace251feee962e02126d3c1f',0,1);
/*!40000 ALTER TABLE `Ifiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userEmail` (`userEmail`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'vicky','vicky@vicky.com','23ab8f57881f6c3175725dc2abdd5ff19681b4ab3f0e51dec54c9ef98a14a37f'),(2,'karthi','karthi@karthi.com','8d12d8356626b478d15811989ef6e2b95696d4868ee558caa0c2ce4ec63ac858'),(3,'Muthunagai','muthunagai@svce.ac.in','62d2c9a951b6b2473c9d024e9215a345b8546fb156fe232b213dfac18b01e4a8');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `fid` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `hash` varchar(500) NOT NULL,
  `lid` int(20) NOT NULL,
  `uid` int(20) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (10,'a1.txt','bd10064af0d6e6d2b6ab6249e8134e5a6740076d86f8828160e34e6f490f5187a270197e1c3da438c1824063ca1926c761c974e3376ec4a26f855d68d41af9ca',0,3),(11,'b1.txt','1baa70abd5b2a6ee2c4dbc9e54dc92662a7ffeb93a872013037f172341501f30d0fe0de3a1eec122ea4c993b1d944737236cddaacd5c04e71dea4f55b5f49f22',0,3),(12,'c1.txt','bd10064af0d6e6d2b6ab6249e8134e5a6740076d86f8828160e34e6f490f5187a270197e1c3da438c1824063ca1926c761c974e3376ec4a26f855d68d41af9ca',10,3),(14,'sample2.txt','27a2a2755c476f2f108333f041079e939dbe988d770996b4b7f9b955b2d8619f755cabf63132ee46a85193030db126c9d268dd60d7d2d12968b2e5cc554633e9',0,3),(15,'final.txt','84c88f6d38cab192a4e90a0ac5d3b3d4731e157b36d0daed00a5e5ac71e03cac7b45980ece654947eeb36e52ebea117170ad915de3a0a89372eb0f7ce143f218',0,3),(16,'sample1.txt','84c88f6d38cab192a4e90a0ac5d3b3d4731e157b36d0daed00a5e5ac71e03cac7b45980ece654947eeb36e52ebea117170ad915de3a0a89372eb0f7ce143f218',15,3);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-13 12:27:30
