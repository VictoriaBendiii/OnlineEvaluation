-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: peerpal
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `courseCode` varchar(45) NOT NULL,
  `courseName` varchar(240) NOT NULL,
  `courseNo` varchar(240) DEFAULT NULL,
  `schedule` varchar(45) NOT NULL,
  `status` enum('Active','Archived') NOT NULL,
  `courseStatus` enum('First Semester','Second Semester','Short Term') NOT NULL,
  `sy` varchar(45) NOT NULL,
  PRIMARY KEY (`courseCode`),
  UNIQUE KEY `courseCode_UNIQUE` (`courseCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES ('9358A','Web Technologies Lecture','IT 324','3:00 - 4:00 WS','Active','First Semester','2017-2018'),('9358B','Web Technologies Laboratory','IT 322L','4:00 - 5:30 TF','Active','First Semester','2017-2018'),('9360','Information Assurance and Security','IT 324','8:00 - 9:00 TTHS','Active','First Semester','2017-2018'),('9361','Theology','TH301','9:00 - 11:00 TTHS','Active','First Semester','2017-2018');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form` (
  `formID` int(11) NOT NULL AUTO_INCREMENT,
  `formName` varchar(140) NOT NULL,
  `formDesc` varchar(1000) DEFAULT 'No description available',
  `due` date NOT NULL,
  `path` varchar(240) NOT NULL,
  `expTime` time NOT NULL,
  `type` enum('form1','form2') DEFAULT NULL,
  PRIMARY KEY (`formID`),
  UNIQUE KEY `formID_UNIQUE` (`formID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form`
--

LOCK TABLES `form` WRITE;
/*!40000 ALTER TABLE `form` DISABLE KEYS */;
INSERT INTO `form` VALUES (1,'Web Technology Peer Eval Prelims','This is the peer evaluation form for Web Technology Prelims','2018-07-04','9358A-Jam','21:30:00','form1'),(2,'Midterms Evaluation Form','Please make sure to fill the form properly and honestly.','2018-07-05','9358B-Midterms Evaluation Form','17:00:00','form1'),(3,'This is a form','This is a form','2018-06-07','9360-This is a form','21:00:00','form1'),(4,'Project Evaluation form','Please make sure to follow the guidelines','2018-07-05','9358A-Project Evaluation form','17:00:00','form1'),(5,'Prelims Evaluation','Please fill up accordingly','2018-08-01','9361-Prelims Evaluation','17:00:00','form1');
/*!40000 ALTER TABLE `form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `groupID` int(11) NOT NULL AUTO_INCREMENT,
  `groupNo` int(11) NOT NULL,
  PRIMARY KEY (`groupID`),
  UNIQUE KEY `groupID_UNIQUE` (`groupID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10),(11,11),(12,12),(13,13),(14,14),(15,15);
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_form`
--

DROP TABLE IF EXISTS `group_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_form` (
  `groupID` int(11) NOT NULL,
  `courseCodeForm` varchar(45) NOT NULL,
  `formID` int(11) DEFAULT NULL,
  KEY `groupID_idx` (`groupID`),
  KEY `groupIDForm_idx` (`groupID`),
  KEY `courseCodeForm_idx` (`courseCodeForm`),
  KEY `formID_idx` (`formID`),
  CONSTRAINT `courseCodeForm` FOREIGN KEY (`courseCodeForm`) REFERENCES `course` (`courseCode`) ON UPDATE CASCADE,
  CONSTRAINT `formID` FOREIGN KEY (`formID`) REFERENCES `form` (`formID`) ON UPDATE CASCADE,
  CONSTRAINT `groupID` FOREIGN KEY (`groupID`) REFERENCES `group` (`groupID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_form`
--

LOCK TABLES `group_form` WRITE;
/*!40000 ALTER TABLE `group_form` DISABLE KEYS */;
INSERT INTO `group_form` VALUES (1,'9358A',1),(2,'9358A',1),(1,'9358B',2),(1,'9358A',4),(1,'9361',5);
/*!40000 ALTER TABLE `group_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `result`
--

DROP TABLE IF EXISTS `result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `result` (
  `resultID` int(11) NOT NULL AUTO_INCREMENT,
  `score` varchar(1000) NOT NULL,
  `formID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `courseCode` varchar(45) NOT NULL,
  `evaluator` varchar(100) NOT NULL,
  `remarks` varchar(1000) DEFAULT NULL,
  `userID` varchar(100) NOT NULL,
  PRIMARY KEY (`resultID`),
  KEY `formID_idx` (`formID`),
  KEY `formIDResult_idx` (`formID`),
  KEY `groupIDResult_idx` (`groupID`),
  KEY `courseCodeResult_idx` (`courseCode`),
  CONSTRAINT `courseCodeResult` FOREIGN KEY (`courseCode`) REFERENCES `course` (`courseCode`) ON UPDATE CASCADE,
  CONSTRAINT `formIDResult` FOREIGN KEY (`formID`) REFERENCES `form` (`formID`) ON UPDATE CASCADE,
  CONSTRAINT `groupIDResult` FOREIGN KEY (`groupID`) REFERENCES `group_form` (`groupID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `result`
--

LOCK TABLES `result` WRITE;
/*!40000 ALTER TABLE `result` DISABLE KEYS */;
INSERT INTO `result` VALUES (1,'4-3-3-4',2,1,'9358B','2160051','Hardworking always','6'),(2,'3-4-4-3',2,1,'9358B','2160051','Good at communicating.','7'),(3,'2-3-3-4',2,1,'9358B','2156789','Fair worker, independent','5'),(4,'3-3-2-3',2,1,'9358B','2156789','Creative and critical thinker','7');
/*!40000 ALTER TABLE `result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_course`
--

DROP TABLE IF EXISTS `user_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_course` (
  `id` int(11) NOT NULL,
  `courseCode` varchar(45) NOT NULL,
  `groupID` int(11) DEFAULT NULL,
  KEY `id_idx` (`id`),
  KEY `courseCode_idx` (`courseCode`),
  KEY `groupID_idx` (`groupID`),
  KEY `groupIDUser_idx` (`groupID`),
  CONSTRAINT `courseCode` FOREIGN KEY (`courseCode`) REFERENCES `course` (`courseCode`) ON UPDATE CASCADE,
  CONSTRAINT `groupIDUser` FOREIGN KEY (`groupID`) REFERENCES `group` (`groupID`) ON UPDATE CASCADE,
  CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_course`
--

LOCK TABLES `user_course` WRITE;
/*!40000 ALTER TABLE `user_course` DISABLE KEYS */;
INSERT INTO `user_course` VALUES (1,'9358A',NULL),(3,'9358A',2),(4,'9358A',2),(5,'9358A',1),(6,'9358A',1),(1,'9360',NULL),(1,'9358B',NULL),(7,'9358A',1),(5,'9358B',1),(6,'9358B',1),(7,'9358B',1),(4,'9358B',2),(9,'9361',NULL),(5,'9361',1),(5,'9361',1);
/*!40000 ALTER TABLE `user_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `identification` enum('student','teacher') NOT NULL,
  `profilepicture` varchar(45) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2165500','admin','Mary','Gelidon','teacher','default.jpg'),(2,'0000','admin','test','test','teacher','default.jpg'),(3,'2163054','2163054','Juan','Cruz','student','default.jpg'),(4,'2160316','password','Victoria','Buse','student','2160316.jpg'),(5,'2160051','2160051','Nix','Andres','student','2160051.jpg'),(6,'2156789','2156789','Bennie','Santos','student','default.jpg'),(7,'2160052','2160052','Erin','Villanueva','student','default.jpg'),(8,'2160053','2160053','Alfonso','Valdez','student','default.jpg'),(9,'teacher','teacher','Michael','Pinto','teacher','default.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-05 16:00:36
