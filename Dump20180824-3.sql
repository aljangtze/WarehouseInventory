CREATE DATABASE  IF NOT EXISTS `warehouseinventory` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `warehouseinventory`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: warehouseinventory
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (4,'11234'),(2,'sdasf'),(3,'sxx');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract_entry`
--

DROP TABLE IF EXISTS `contract_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `entry_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `initiator` int(11) DEFAULT NULL,
  `operator` int(11) DEFAULT NULL,
  `memo` varchar(255) DEFAULT '',
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract_entry`
--

LOCK TABLES `contract_entry` WRITE;
/*!40000 ALTER TABLE `contract_entry` DISABLE KEYS */;
INSERT INTO `contract_entry` VALUES (1,'CON20180039',4,'2018-08-22 16:35:01',8,8,'',1),(2,'CON20180040',4,'2018-08-22 16:39:24',8,8,'',1),(3,'CON20180041',4,'2018-08-22 16:43:47',8,8,'',0),(4,'CON20180042',4,'2018-08-22 16:45:43',8,8,'',0),(5,'CON20180043',4,'2018-08-22 16:46:37',8,8,'',0),(6,'CON20180044',4,'2018-08-22 16:47:23',8,8,'',0),(7,'CON20180045',4,'2018-08-22 16:48:04',8,NULL,'',0),(8,'CON20180046',6,'2018-08-22 16:48:16',8,NULL,'',0),(9,'CON20180047',15,'2018-08-22 16:48:23',8,NULL,'',0),(10,'CON20180048',90,'2018-08-22 16:48:30',8,NULL,'',0),(11,'CON20180049',38,'2018-08-22 16:48:35',8,NULL,'',0),(12,'CON20180050',6,'2018-08-22 16:50:01',8,8,'',0);
/*!40000 ALTER TABLE `contract_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract_entry_code`
--

DROP TABLE IF EXISTS `contract_entry_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract_entry_code` (
  `year` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`year`,`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract_entry_code`
--

LOCK TABLES `contract_entry_code` WRITE;
/*!40000 ALTER TABLE `contract_entry_code` DISABLE KEYS */;
INSERT INTO `contract_entry_code` VALUES (2018,0,'-'),(2018,1,'CON20180001'),(2018,2,'CON20180002'),(2018,3,'CON20180003'),(2018,4,'CON20180004'),(2018,5,'CON20180005'),(2018,6,'CON20180006'),(2018,7,'CON20180007'),(2018,8,'CON20180008'),(2018,9,'CON20180009'),(2018,10,'CON20180010'),(2018,11,'CON20180011'),(2018,12,'CON20180012'),(2018,13,'CON20180013'),(2018,14,'CON20180014'),(2018,15,'CON20180015'),(2018,16,'CON20180016'),(2018,17,'CON20180017'),(2018,18,'CON20180018'),(2018,19,'CON20180019'),(2018,20,'CON20180020'),(2018,21,'CON20180021'),(2018,22,'CON20180022'),(2018,23,'CON20180023'),(2018,24,'CON20180024'),(2018,25,'CON20180025'),(2018,26,'CON20180026'),(2018,27,'CON20180027'),(2018,28,'CON20180028'),(2018,29,'CON20180029'),(2018,30,'CON20180030'),(2018,31,'CON20180031'),(2018,32,'CON20180032'),(2018,33,'CON20180033'),(2018,34,'CON20180034'),(2018,35,'CON20180035'),(2018,36,'CON20180036'),(2018,37,'CON20180037'),(2018,38,'CON20180038'),(2018,39,'CON20180039'),(2018,40,'CON20180040'),(2018,41,'CON20180041'),(2018,42,'CON20180042'),(2018,43,'CON20180043'),(2018,44,'CON20180044'),(2018,45,'CON20180045'),(2018,46,'CON20180046'),(2018,47,'CON20180047'),(2018,48,'CON20180048'),(2018,49,'CON20180049'),(2018,50,'CON20180050');
/*!40000 ALTER TABLE `contract_entry_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract_entry_details`
--

DROP TABLE IF EXISTS `contract_entry_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract_entry_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `requestion_details_id` varchar(45) DEFAULT NULL,
  `price` float DEFAULT '0',
  `total_price` float DEFAULT '0',
  `tax_price` float DEFAULT '0',
  `tax_total_price` float DEFAULT '0',
  `memo` varchar(45) DEFAULT '',
  `entry_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UniformKey` (`contract_id`,`requestion_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract_entry_details`
--

LOCK TABLES `contract_entry_details` WRITE;
/*!40000 ALTER TABLE `contract_entry_details` DISABLE KEYS */;
INSERT INTO `contract_entry_details` VALUES (1,1,4,'2',0,0,0,0,'','2018-08-22 16:35:01'),(2,1,4,'9',0,0,0,0,'','2018-08-22 16:35:01'),(3,1,4,'10',0,0,0,0,'','2018-08-22 16:35:01'),(4,1,4,'12',0,0,0,0,'','2018-08-22 16:35:01'),(5,1,4,'13',0,0,0,0,'','2018-08-22 16:35:01'),(6,1,4,'14',0,0,0,0,'','2018-08-22 16:35:01'),(7,1,4,'15',0,0,0,0,'','2018-08-22 16:35:01'),(8,1,4,'16',0,0,0,0,'','2018-08-22 16:35:01'),(9,1,4,'17',0,0,0,0,'','2018-08-22 16:35:01'),(10,1,4,'18',0,0,0,0,'','2018-08-22 16:35:01'),(11,1,4,'19',0,0,0,0,'','2018-08-22 16:35:01'),(12,1,4,'20',0,0,0,0,'','2018-08-22 16:35:01'),(13,1,4,'36',0,0,0,0,'','2018-08-22 16:35:01'),(14,1,4,'37',0,0,0,0,'','2018-08-22 16:35:01'),(15,1,4,'38',0,0,0,0,'','2018-08-22 16:35:01'),(16,2,4,'40',0,0,0,0,'','2018-08-22 16:39:24'),(17,2,4,'42',0,0,0,0,'','2018-08-22 16:39:24'),(18,2,4,'43',0,0,0,0,'','2018-08-22 16:39:24'),(19,3,4,'39',0,0,0,0,'','2018-08-22 16:43:47'),(20,3,4,'41',0,0,0,0,'','2018-08-22 16:43:47'),(21,3,4,'45',0,0,0,0,'','2018-08-22 16:43:47'),(22,4,4,'82',0,0,0,0,'','2018-08-22 16:45:43'),(23,4,4,'83',0,0,0,0,'','2018-08-22 16:45:43'),(24,5,4,'44',0,0,0,0,'','2018-08-22 16:46:37'),(25,5,4,'46',0,0,0,0,'','2018-08-22 16:46:37'),(26,6,4,'47',0,0,0,0,'','2018-08-22 16:47:23'),(27,6,4,'48',0,0,0,0,'','2018-08-22 16:47:23'),(28,7,4,'49',0,0,0,0,'','2018-08-22 16:48:04'),(29,8,6,'1',0,0,0,0,'','2018-08-22 16:48:16'),(30,8,6,'8',0,0,0,0,'','2018-08-22 16:48:16'),(31,9,15,'21',0,0,0,0,'','2018-08-22 16:48:23'),(32,9,15,'22',0,0,0,0,'','2018-08-22 16:48:23'),(33,9,15,'24',0,0,0,0,'','2018-08-22 16:48:23'),(34,9,15,'26',0,0,0,0,'','2018-08-22 16:48:23'),(35,10,90,'114',0,0,0,0,'','2018-08-22 16:48:30'),(36,10,90,'117',0,0,0,0,'','2018-08-22 16:48:30'),(37,10,90,'122',0,0,0,0,'','2018-08-22 16:48:30'),(38,11,38,'66',0,0,0,0,'','2018-08-22 16:48:35'),(39,11,38,'67',0,0,0,0,'','2018-08-22 16:48:35'),(40,11,38,'68',0,0,0,0,'','2018-08-22 16:48:35'),(41,11,38,'69',0,0,0,0,'','2018-08-22 16:48:35'),(42,11,38,'70',0,0,0,0,'','2018-08-22 16:48:35'),(43,11,38,'71',0,0,0,0,'','2018-08-22 16:48:35'),(44,11,38,'72',0,0,0,0,'','2018-08-22 16:48:35'),(45,11,38,'73',0,0,0,0,'','2018-08-22 16:48:35'),(46,11,38,'74',0,0,0,0,'','2018-08-22 16:48:35'),(47,11,38,'75',0,0,0,0,'','2018-08-22 16:48:35'),(48,11,38,'76',0,0,0,0,'','2018-08-22 16:48:35'),(49,11,38,'77',0,0,0,0,'','2018-08-22 16:48:35'),(50,11,38,'78',0,0,0,0,'','2018-08-22 16:48:35'),(51,11,38,'79',0,0,0,0,'','2018-08-22 16:48:35'),(52,11,38,'80',0,0,0,0,'','2018-08-22 16:48:35'),(53,12,6,'11',0,0,0,0,'','2018-08-22 16:50:01');
/*!40000 ALTER TABLE `contract_entry_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite_product`
--

DROP TABLE IF EXISTS `favorite_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorite_product` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite_product`
--

LOCK TABLES `favorite_product` WRITE;
/*!40000 ALTER TABLE `favorite_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorite_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `godown_entry`
--

DROP TABLE IF EXISTS `godown_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `godown_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `requestion_id` int(11) DEFAULT NULL COMMENT '关联的请购单',
  `supplier_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `initiator` int(11) DEFAULT NULL COMMENT '入库人员',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='入库单';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `godown_entry`
--

LOCK TABLES `godown_entry` WRITE;
/*!40000 ALTER TABLE `godown_entry` DISABLE KEYS */;
INSERT INTO `godown_entry` VALUES (1,'RK201808010001',11,4,'2018-08-01 11:55:50',8),(2,'RK201808070002',24,7,'2018-08-07 11:12:44',8);
/*!40000 ALTER TABLE `godown_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `godown_entry_code`
--

DROP TABLE IF EXISTS `godown_entry_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `godown_entry_code` (
  `year` int(11) NOT NULL,
  `month` int(11) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `number` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `godown_entry_code`
--

LOCK TABLES `godown_entry_code` WRITE;
/*!40000 ALTER TABLE `godown_entry_code` DISABLE KEYS */;
INSERT INTO `godown_entry_code` VALUES (2018,8,1,0,''),(2018,8,1,1,'RK201808010001'),(2018,8,7,2,'RK201808070002');
/*!40000 ALTER TABLE `godown_entry_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `godown_entry_details`
--

DROP TABLE IF EXISTS `godown_entry_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `godown_entry_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `godown_entry_id` int(11) DEFAULT NULL,
  `requestion_details_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `memo` varchar(255) DEFAULT NULL COMMENT '备注',
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='入库单详情';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `godown_entry_details`
--

LOCK TABLES `godown_entry_details` WRITE;
/*!40000 ALTER TABLE `godown_entry_details` DISABLE KEYS */;
INSERT INTO `godown_entry_details` VALUES (1,1,19,0,0,1,'','2018-08-01 11:55:50'),(2,2,43,0,0,1,'','2018-08-07 11:12:44'),(3,2,44,0,0,1,'','2018-08-07 11:12:44'),(4,2,45,0,0,1,'','2018-08-07 11:12:44');
/*!40000 ALTER TABLE `godown_entry_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT '组名',
  `memo` varchar(45) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='分组';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (0,'未知分组','此分组为初始化分组'),(1,'技术开发A组','技术开发A组'),(2,'技术开发B组','技术开发B组');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_user_relationship`
--

DROP TABLE IF EXISTS `group_user_relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_user_relationship` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_user_relationship`
--

LOCK TABLES `group_user_relationship` WRITE;
/*!40000 ALTER TABLE `group_user_relationship` DISABLE KEYS */;
INSERT INTO `group_user_relationship` VALUES (1,2,1);
/*!40000 ALTER TABLE `group_user_relationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modelnumber`
--

DROP TABLE IF EXISTS `modelnumber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modelnumber` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='型号';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modelnumber`
--

LOCK TABLES `modelnumber` WRITE;
/*!40000 ALTER TABLE `modelnumber` DISABLE KEYS */;
INSERT INTO `modelnumber` VALUES (0,'\\');
/*!40000 ALTER TABLE `modelnumber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outgoing_entry`
--

DROP TABLE IF EXISTS `outgoing_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outgoing_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL COMMENT '出库单据编号',
  `product_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `initiator` int(11) DEFAULT NULL COMMENT '出库人员',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='出库单据';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outgoing_entry`
--

LOCK TABLES `outgoing_entry` WRITE;
/*!40000 ALTER TABLE `outgoing_entry` DISABLE KEYS */;
/*!40000 ALTER TABLE `outgoing_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outgoing_entry_code`
--

DROP TABLE IF EXISTS `outgoing_entry_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outgoing_entry_code` (
  `year` int(11) NOT NULL,
  `day` varchar(45) DEFAULT NULL,
  `month` varchar(45) DEFAULT NULL,
  `number` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outgoing_entry_code`
--

LOCK TABLES `outgoing_entry_code` WRITE;
/*!40000 ALTER TABLE `outgoing_entry_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `outgoing_entry_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outgoing_entry_details`
--

DROP TABLE IF EXISTS `outgoing_entry_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outgoing_entry_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT '0',
  `number` int(11) DEFAULT '0',
  `project_id` int(11) DEFAULT '0',
  `memo` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='出库详单';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outgoing_entry_details`
--

LOCK TABLES `outgoing_entry_details` WRITE;
/*!40000 ALTER TABLE `outgoing_entry_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `outgoing_entry_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '品名',
  `specification` varchar(255) DEFAULT '\\' COMMENT '规格 ',
  `model_number` varchar(255) DEFAULT '\\' COMMENT '型号',
  `unit` varchar(255) DEFAULT '\\' COMMENT '单位',
  `type` int(11) DEFAULT '1' COMMENT '物料类别 1A 2B 3C',
  `initiator` int(11) DEFAULT NULL COMMENT '此物料是由创建人员创建的',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1492 DEFAULT CHARSET=utf8 COMMENT='产品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'VGA线缆','/','/','支',2,8),(2,'接线端子','/','/','支',3,8),(3,'0.1mL凝胶鲎试剂','灵敏度0.125EU/mL','/','支',1,8),(4,'0.1mL凝胶鲎试剂','灵敏度0.25EU/mL','/','支',1,8),(5,'0.1mL凝胶鲎试剂','灵敏度0.5EU/mL','/','管',1,8),(6,'0.22μm针头滤器(Millex -GP)','/','/','支',1,8),(7,'1.5mL尖底刻度离心管','/','/','支',1,8),(8,'1.5ml离心管','/','/','支',1,8),(9,'1.5ml离心管','无DNA RNA','/','支',1,8),(10,'10%LMD IN 0.9%Sodium Chlorde Injection 右旋糖酐','/','/','支',1,8),(11,'100-1000ul滤芯吸嘴，蓝色，盒装灭菌','/','/','支',1,8),(12,'100微米细胞筛网','/','/','支',1,8),(1478,'签字笔','黑色','0.5mm','支',2,8),(1479,'签字笔','黑色','0.3mm','支',2,8),(1480,'签字笔','红色','0.5mm','支',3,8),(1481,'签字笔','红色','0.3mm','支',3,8),(1483,'xx','/','/','把',3,8),(1484,'sdfadsafdddd','/','/','个',1,8),(1485,'01','/','/','把',3,8),(1486,'02','/','/','把',3,8),(1487,'03','/','/','把',3,8),(1488,'04','/','/','把',3,8),(1489,'05','/','/','把',3,8),(1490,'07','/','/','把',3,8),(1491,'jkljkl','/','/','/',1,8);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product-xx`
--

DROP TABLE IF EXISTS `product-xx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product-xx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) DEFAULT NULL,
  `memo` varchar(225) DEFAULT NULL COMMENT '描述信息',
  `status` int(11) DEFAULT '0',
  `initiator` int(11) DEFAULT NULL COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='物料';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product-xx`
--

LOCK TABLES `product-xx` WRITE;
/*!40000 ALTER TABLE `product-xx` DISABLE KEYS */;
INSERT INTO `product-xx` VALUES (1,'签字笔',NULL,1,8),(2,'Nalgene™ Square PET Media Bottles with Closure: Sterile, Shrink-Wrapped Trays',NULL,1,8),(3,'6孔细胞培养板',NULL,1,8),(4,'DMEM-LG',NULL,1,8),(5,'Ham\'s F-12 Nutrient Mixture',NULL,1,8),(6,'75%酒精',NULL,1,8),(7,'1.5ml离心管',NULL,1,8),(8,'医用纱布块 8x10cm x8层 ',NULL,1,8);
/*!40000 ALTER TABLE `product-xx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_details`
--

DROP TABLE IF EXISTS `product_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `specification_id` int(11) DEFAULT NULL,
  `modelnumber_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_details`
--

LOCK TABLES `product_details` WRITE;
/*!40000 ALTER TABLE `product_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_type`
--

DROP TABLE IF EXISTS `product_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT '物料简写',
  `info` varchar(255) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='物料类别';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_type`
--

LOCK TABLES `product_type` WRITE;
/*!40000 ALTER TABLE `product_type` DISABLE KEYS */;
INSERT INTO `product_type` VALUES (0,'未知物料类型','未知物料类型'),(1,'A.原物料','加工生产后可成为产品一部分的物料'),(2,'B.耗材','在加工生产过程中被消耗掉，且不会以其任务形式存在于产品中'),(3,'C.办公用品','包含办公用品，五金工具等');
/*!40000 ALTER TABLE `product_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) unsigned NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `categorie_id` (`categorie_id`),
  KEY `media_id` (`media_id`),
  CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'xxx','1',11.00,11.00,2,0,'2018-07-17 14:23:42');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `initiator` int(11) DEFAULT NULL COMMENT '创建人',
  `name` varchar(45) DEFAULT NULL COMMENT '名称',
  `memo` varchar(45) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (0,0,'未知项目','未知项目'),(1,1,'办公用品','办公用品'),(2,8,'17AE001','17AE001'),(3,8,'17AN001','17AN001');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qualification`
--

DROP TABLE IF EXISTS `qualification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qualification_info` varchar(255) DEFAULT NULL COMMENT '资质描述',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qualification`
--

LOCK TABLES `qualification` WRITE;
/*!40000 ALTER TABLE `qualification` DISABLE KEYS */;
INSERT INTO `qualification` VALUES (0,'无'),(1,'医用资质');
/*!40000 ALTER TABLE `qualification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requestion`
--

DROP TABLE IF EXISTS `requestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL COMMENT '请购单唯一编号',
  `initiator` int(11) DEFAULT NULL COMMENT '请购发起人id',
  `operator` int(11) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '请购单创建时间',
  `status` int(11) DEFAULT '0' COMMENT '请购单审核状态',
  `flushdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8 COMMENT='出入库单号';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requestion`
--

LOCK TABLES `requestion` WRITE;
/*!40000 ALTER TABLE `requestion` DISABLE KEYS */;
INSERT INTO `requestion` VALUES (0,'QG18022',1,0,'2018-07-17 08:50:01',0,'2018-08-21 11:36:39'),(7,'QS20180004',8,0,'2018-07-26 10:09:53',1,'2018-08-21 11:36:54'),(8,'QS20180005',8,0,'2018-07-26 10:12:16',1,'2018-08-21 11:36:54'),(9,'QS20180006',8,0,'2018-07-26 10:13:58',1,'2018-08-21 11:36:54'),(10,'QS20180008',8,0,'2018-07-26 10:17:54',0,'2018-08-21 11:36:39'),(11,'QS20180009',8,9,'2018-07-26 10:26:11',0,'2018-08-21 11:36:39'),(12,'QS20180010',8,9,'2018-07-26 10:30:05',0,'2018-08-21 11:36:39'),(13,'QS20180011',8,9,'2018-07-26 10:33:49',0,'2018-08-21 11:36:39'),(14,'QS20180012',8,8,'2018-07-26 10:34:38',1,'2018-08-21 11:36:39'),(15,'QS20180013',8,8,'2018-07-26 10:34:54',1,'2018-08-21 11:36:39'),(16,'QS20180014',8,8,'2018-07-26 10:35:54',1,'2018-08-21 11:36:39'),(17,'QS20180015',8,8,'2018-07-26 11:07:20',1,'2018-08-21 11:36:39'),(18,'QS20180016',8,8,'2018-07-26 11:07:43',1,'2018-08-21 11:36:39'),(19,'QS20180017',8,8,'2018-07-26 11:11:40',1,'2018-08-21 11:36:39'),(20,'QS20180018',8,8,'2018-07-26 11:12:12',1,'2018-08-21 11:36:39'),(21,'QS20180019',8,8,'2018-07-26 11:12:25',1,'2018-08-21 11:36:39'),(22,'QS20180020',8,8,'2018-07-26 11:12:35',1,'2018-08-21 11:36:39'),(23,'QS20180021',8,8,'2018-07-26 11:13:14',1,'2018-08-21 11:36:39'),(24,'QS20180022',8,8,'2018-07-26 11:13:14',1,'2018-08-21 11:39:44'),(25,'QS20180023',8,8,'2018-07-26 11:17:27',1,'2018-08-21 11:36:39'),(26,'QS20180024',8,8,'2018-07-26 11:17:41',1,'2018-08-21 11:36:39'),(27,'QS20180025',8,8,'2018-07-26 11:17:54',1,'2018-08-21 11:36:39'),(28,'QS20180026',8,8,'2018-07-26 11:18:22',1,'2018-08-21 11:36:39'),(29,'QS20180027',8,8,'2018-07-26 11:19:28',1,'2018-08-21 11:36:39'),(30,'QS20180028',8,8,'2018-07-26 11:21:08',1,'2018-08-21 11:36:39'),(31,'QS20180029',8,8,'2018-07-26 11:21:41',1,'2018-08-21 11:41:03'),(32,'QS20180030',8,8,'2018-07-26 11:24:52',1,'2018-08-21 11:39:44'),(33,'QS20180031',8,8,'2018-07-26 11:32:50',1,'2018-08-21 11:36:39'),(34,'QS20180032',8,8,'2018-07-26 11:33:40',1,'2018-08-21 11:36:39'),(35,'QS20180033',8,8,'2018-07-26 11:34:47',1,'2018-08-21 11:36:39'),(36,'QS20180034',8,8,'2018-07-26 11:35:10',1,'2018-08-21 11:36:39'),(37,'QS20180035',8,8,'2018-07-26 11:35:24',1,'2018-08-21 11:36:39'),(38,'QS20180036',8,8,'2018-07-26 11:36:26',1,'2018-08-21 11:36:39'),(39,'QS20180037',8,8,'2018-07-26 11:37:19',1,'2018-08-21 11:36:39'),(40,'QS20180038',8,8,'2018-07-26 11:37:43',1,'2018-08-21 11:41:03'),(41,'QS20180039',8,8,'2018-07-26 11:38:46',1,'2018-08-21 11:41:12'),(42,'QS20180040',8,8,'2018-07-26 11:38:51',1,'2018-08-21 11:36:39'),(43,'QS20180041',8,8,'2018-07-26 11:39:08',1,'2018-08-21 11:36:39'),(44,'QS20180042',8,8,'2018-07-26 11:39:09',1,'2018-08-21 11:41:20'),(45,'QS20180043',8,8,'2018-07-26 11:39:34',1,'2018-08-21 11:41:03'),(46,'QS20180044',8,8,'2018-07-26 11:41:11',1,'2018-08-21 11:36:39'),(47,'QS20180045',8,8,'2018-07-26 11:41:25',1,'2018-08-21 11:42:22'),(48,'QS20180046',8,8,'2018-07-26 11:42:12',1,'2018-08-21 11:36:39'),(49,'QS20180047',8,8,'2018-07-26 11:43:24',1,'2018-08-21 11:41:12'),(50,'QS20180048',8,8,'2018-07-26 11:43:31',1,'2018-08-21 11:41:20'),(51,'QS20180049',8,8,'2018-07-26 11:44:54',1,'2018-08-21 11:42:31'),(52,'QS20180050',8,8,'2018-07-26 11:45:54',1,'2018-08-21 11:41:20'),(53,'QS20180051',8,8,'2018-07-26 11:46:16',1,'2018-08-21 11:41:12'),(54,'QS20180052',8,8,'2018-07-26 11:46:30',1,'2018-08-21 11:42:31'),(55,'QS20180053',8,8,'2018-07-26 11:47:59',1,'2018-08-21 13:27:38'),(56,'QS20180054',8,8,'2018-07-26 11:57:24',1,'2018-08-21 11:41:20'),(57,'QS20180055',8,8,'2018-07-26 11:58:15',1,'2018-08-21 11:41:12'),(58,'QS20180056',8,8,'2018-07-26 11:58:21',1,'2018-08-21 11:42:31'),(59,'QS20180057',8,8,'2018-07-26 11:59:52',1,'2018-08-21 11:41:20'),(60,'QS20180058',8,8,'2018-07-26 12:00:00',1,'2018-08-21 13:27:38'),(61,'QS20180059',8,8,'2018-07-26 12:00:12',1,'2018-08-21 13:27:38'),(62,'QS20180060',8,8,'2018-07-26 12:00:52',1,'2018-08-21 11:36:39'),(63,'QS20180061',8,8,'2018-07-26 12:01:20',1,'2018-08-21 13:27:38'),(64,'QS20180062',8,8,'2018-07-26 12:01:42',1,'2018-08-21 13:27:38'),(65,'QS20180063',8,8,'2018-07-26 12:01:43',0,'2018-08-21 11:36:39'),(66,'QS20180064',8,8,'2018-07-26 12:01:44',1,'2018-08-21 11:36:39'),(67,'QS20180065',8,8,'2018-07-26 12:01:45',1,'2018-08-21 13:27:38'),(68,'QS20180066',8,8,'2018-07-26 12:01:45',0,'2018-08-21 11:36:39'),(69,'QS20180067',8,8,'2018-07-26 12:05:52',0,'2018-08-21 11:36:39'),(70,'QS20180068',8,8,'2018-07-26 12:06:30',1,'2018-08-21 11:36:39'),(71,'QS20180069',8,8,'2018-07-26 12:11:43',0,'2018-08-21 11:36:39'),(72,'QS20180070',8,8,'2018-07-26 12:11:59',1,'2018-08-21 11:36:39'),(73,'QS20180071',8,8,'2018-07-26 12:12:04',0,'2018-08-21 11:36:39'),(74,'QS20180072',8,8,'2018-07-26 12:12:08',0,'2018-08-21 11:36:39'),(75,'QS20180073',8,8,'2018-07-26 12:12:12',0,'2018-08-21 11:36:39'),(76,'QS20180074',8,8,'2018-07-26 12:12:18',0,'2018-08-21 11:36:39'),(77,'QS20180075',8,8,'2018-07-26 12:13:10',1,'2018-08-21 11:36:39'),(78,'QS20180076',8,8,'2018-07-26 12:13:52',0,'2018-08-21 11:36:39'),(79,'QS20180077',8,8,'2018-07-26 13:15:08',0,'2018-08-21 11:36:39'),(80,'QS20180078',8,8,'2018-07-26 13:16:08',0,'2018-08-21 11:36:39'),(81,'QS20180079',8,8,'2018-07-26 13:16:34',1,'2018-08-21 11:36:39'),(82,'QS20180080',8,8,'2018-07-26 13:18:05',0,'2018-08-21 11:36:39'),(83,'QS20180081',8,8,'2018-07-26 13:18:25',0,'2018-08-21 11:36:39'),(84,'QS20180082',8,8,'2018-07-26 13:20:43',0,'2018-08-21 11:36:39'),(85,'QS20180083',8,8,'2018-07-26 13:23:30',1,'2018-08-21 11:36:39'),(86,'QS20180084',8,8,'2018-07-30 13:41:22',0,'2018-08-21 11:36:39'),(87,'QS20180085',8,8,'2018-07-30 13:41:34',0,'2018-08-21 11:36:39'),(88,'QS20180086',8,8,'2018-07-30 13:41:35',0,'2018-08-21 11:36:39'),(89,'QS20180087',8,8,'2018-07-30 13:41:35',1,'2018-08-21 11:36:39'),(90,'QS20180088',8,8,'2018-07-30 13:41:35',1,'2018-08-21 11:36:39'),(91,'QS20180089',8,8,'2018-07-30 13:41:36',0,'2018-08-21 11:36:39'),(92,'QS20180090',8,8,'2018-07-30 13:41:36',0,'2018-08-21 11:36:39'),(93,'QS20180091',8,8,'2018-07-30 13:41:36',1,'2018-08-21 11:36:39'),(94,'QS20180092',8,8,'2018-07-30 13:41:36',0,'2018-08-21 11:36:39'),(95,'QS20180093',8,8,'2018-07-30 13:41:36',0,'2018-08-21 11:36:39'),(96,'QS20180094',8,8,'2018-07-30 13:41:36',0,'2018-08-21 11:36:39'),(98,'QS20180095',8,8,'2018-07-30 16:48:04',0,'2018-08-21 11:36:39'),(100,'QS20180096',8,8,'2018-07-31 15:29:03',0,'2018-08-21 11:36:39'),(106,'QS20180097',8,8,'2018-07-31 15:40:43',1,'2018-08-21 11:46:21'),(107,'QS20180098',8,8,'2018-07-31 16:04:35',1,'2018-08-21 11:36:39'),(108,'QG20180099',8,8,'2018-08-01 11:40:34',1,'2018-08-21 11:46:21'),(109,'QG20180100',8,9,'2018-08-07 10:39:02',0,'2018-08-21 11:36:39'),(110,'QG20180101',8,8,'2018-08-07 10:55:01',1,'2018-08-21 11:36:39'),(111,'QG20180102',8,8,'2018-08-07 11:04:52',1,'2018-08-21 11:36:39'),(112,'QG20180103',8,8,'2018-08-08 15:10:10',1,'2018-08-21 11:46:21'),(113,'QG20180104',8,8,'2018-08-08 15:15:29',1,'2018-08-21 11:36:39'),(114,'QG20180105',8,8,'2018-08-08 15:15:40',1,'2018-08-21 11:36:39'),(115,'QG20180106',8,8,'2018-08-08 15:16:06',1,'2018-08-21 11:36:39'),(116,'QG20180107',8,8,'2018-08-08 15:16:21',1,'2018-08-21 11:36:39'),(117,'QG20180108',8,8,'2018-08-08 16:25:04',1,'2018-08-21 11:46:21'),(118,'QG20180109',8,8,'2018-08-22 09:38:38',0,'2018-08-22 09:38:38');
/*!40000 ALTER TABLE `requestion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requestion_code`
--

DROP TABLE IF EXISTS `requestion_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requestion_code` (
  `year` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`year`,`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requestion_code`
--

LOCK TABLES `requestion_code` WRITE;
/*!40000 ALTER TABLE `requestion_code` DISABLE KEYS */;
INSERT INTO `requestion_code` VALUES (2018,1,'QS20180001'),(2018,2,'QS20180002'),(2018,3,'QS20180003'),(2018,4,'QS20180004'),(2018,5,'QS20180005'),(2018,6,'QS20180006'),(2018,7,'QS20180007'),(2018,8,'QS20180008'),(2018,9,'QS20180009'),(2018,10,'QS20180010'),(2018,11,'QS20180011'),(2018,12,'QS20180012'),(2018,13,'QS20180013'),(2018,14,'QS20180014'),(2018,15,'QS20180015'),(2018,16,'QS20180016'),(2018,17,'QS20180017'),(2018,18,'QS20180018'),(2018,19,'QS20180019'),(2018,20,'QS20180020'),(2018,21,'QS20180021'),(2018,22,'QS20180022'),(2018,23,'QS20180023'),(2018,24,'QS20180024'),(2018,25,'QS20180025'),(2018,26,'QS20180026'),(2018,27,'QS20180027'),(2018,28,'QS20180028'),(2018,29,'QS20180029'),(2018,30,'QS20180030'),(2018,31,'QS20180031'),(2018,32,'QS20180032'),(2018,33,'QS20180033'),(2018,34,'QS20180034'),(2018,35,'QS20180035'),(2018,36,'QS20180036'),(2018,37,'QS20180037'),(2018,38,'QS20180038'),(2018,39,'QS20180039'),(2018,40,'QS20180040'),(2018,41,'QS20180041'),(2018,42,'QS20180042'),(2018,43,'QS20180043'),(2018,44,'QS20180044'),(2018,45,'QS20180045'),(2018,46,'QS20180046'),(2018,47,'QS20180047'),(2018,48,'QS20180048'),(2018,49,'QS20180049'),(2018,50,'QS20180050'),(2018,51,'QS20180051'),(2018,52,'QS20180052'),(2018,53,'QS20180053'),(2018,54,'QS20180054'),(2018,55,'QS20180055'),(2018,56,'QS20180056'),(2018,57,'QS20180057'),(2018,58,'QS20180058'),(2018,59,'QS20180059'),(2018,60,'QS20180060'),(2018,61,'QS20180061'),(2018,62,'QS20180062'),(2018,63,'QS20180063'),(2018,64,'QS20180064'),(2018,65,'QS20180065'),(2018,66,'QS20180066'),(2018,67,'QS20180067'),(2018,68,'QS20180068'),(2018,69,'QS20180069'),(2018,70,'QS20180070'),(2018,71,'QS20180071'),(2018,72,'QS20180072'),(2018,73,'QS20180073'),(2018,74,'QS20180074'),(2018,75,'QS20180075'),(2018,76,'QS20180076'),(2018,77,'QS20180077'),(2018,78,'QS20180078'),(2018,79,'QS20180079'),(2018,80,'QS20180080'),(2018,81,'QS20180081'),(2018,82,'QS20180082'),(2018,83,'QS20180083'),(2018,84,'QS20180084'),(2018,85,'QS20180085'),(2018,86,'QS20180086'),(2018,87,'QS20180087'),(2018,88,'QS20180088'),(2018,89,'QS20180089'),(2018,90,'QS20180090'),(2018,91,'QS20180091'),(2018,92,'QS20180092'),(2018,93,'QS20180093'),(2018,94,'QS20180094'),(2018,95,'QS20180095'),(2018,96,'QS20180096'),(2018,97,'QS20180097'),(2018,98,'QS20180098'),(2018,99,'QG20180099'),(2018,100,'QG20180100'),(2018,101,'QG20180101'),(2018,102,'QG20180102'),(2018,103,'QG20180103'),(2018,104,'QG20180104'),(2018,105,'QG20180105'),(2018,106,'QG20180106'),(2018,107,'QG20180107'),(2018,108,'QG20180108'),(2018,109,'QG20180109');
/*!40000 ALTER TABLE `requestion_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requestion_details`
--

DROP TABLE IF EXISTS `requestion_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requestion_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requestion_id` int(11) DEFAULT '0' COMMENT '请购单号',
  `code` varchar(45) DEFAULT NULL COMMENT '物料代码',
  `product_id` int(11) DEFAULT '0',
  `project_id` int(11) DEFAULT '0',
  `supplier_id` int(11) DEFAULT '0',
  `qualification_id` int(11) DEFAULT '0' COMMENT '资质要求',
  `requestion_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '请购日期',
  `expect_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '期望到货日期',
  `requestion_number` int(11) DEFAULT NULL COMMENT '期望数量',
  `godown_number` int(11) DEFAULT '0',
  `outgoing_number` int(11) DEFAULT '0',
  `is_test` int(11) DEFAULT '0' COMMENT '是否试样',
  `is_reprocess` int(11) DEFAULT '0' COMMENT '是否二次加工',
  `reference` varchar(200) DEFAULT NULL COMMENT '参考供应商或链接',
  `memo` varchar(245) DEFAULT NULL COMMENT '备注',
  `refreshTime` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0' COMMENT '-1 未知\n0 新建\n1 议价\n2 采购',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requestion_details`
--

LOCK TABLES `requestion_details` WRITE;
/*!40000 ALTER TABLE `requestion_details` DISABLE KEYS */;
INSERT INTO `requestion_details` VALUES (1,0,'5-2',1,0,6,0,'2018-07-17 08:51:41','2018-07-20 00:00:00',10,0,0,0,0,'参考',NULL,'2018-08-21 15:29:49',1),(2,0,'QS20180004',7,0,4,0,'2018-07-25 00:00:00','2018-07-25 00:00:00',1,0,0,0,0,'','','2018-08-21 15:45:39',1),(8,7,'',7,0,6,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(9,7,'',2,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:45:39',1),(10,8,'',8,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:45:39',1),(11,8,'',2,0,6,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(12,9,'物料代码',1483,0,4,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,1,1,'参考链接','备注信息','2018-08-21 15:45:39',1),(13,9,'物料代码',1,0,4,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,1,1,'参考链接','备注信息','2018-08-21 15:45:39',1),(14,10,'物料代码',1483,0,4,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,1,1,'参考链接','备注信息','2018-08-21 15:45:39',1),(15,10,'物料代码',1,0,4,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,1,1,'参考链接','备注信息','2018-08-21 15:45:39',1),(16,11,'',2,0,4,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:45:39',1),(17,11,'',2,0,4,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:45:39',1),(18,11,'',1480,0,4,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',10,0,0,0,0,'','','2018-08-21 15:45:39',1),(19,11,'',1478,0,4,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',10,0,0,0,0,'','','2018-08-21 15:45:39',1),(20,12,'',2,0,4,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:45:39',1),(21,12,'',2,0,15,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(22,12,'',1480,0,15,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',10,0,0,0,0,'','','2018-08-21 15:29:49',1),(23,12,'',1478,0,15,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',10,0,0,0,0,'','','2018-08-21 15:29:49',1),(24,13,'',2,0,15,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(25,13,'',2,0,15,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(26,13,'',1480,0,15,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',10,0,0,0,0,'','','2018-08-21 15:29:49',1),(27,13,'',1478,0,15,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',10,0,0,0,0,'','','2018-08-21 15:29:49',1),(28,14,'',2,0,15,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(29,15,'',2,0,15,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(30,16,'',2,0,15,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(31,17,'',2,0,15,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(32,18,'',2,0,15,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(33,19,'',2,0,15,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(34,20,'',2,0,15,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(35,20,'',1483,0,15,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(36,21,'',2,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(37,21,'',1483,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(38,22,'',2,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(39,22,'',1483,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(40,23,'',2,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(41,23,'',1483,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(42,23,'',1484,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(43,24,'',2,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(44,24,'',1483,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(45,24,'',1484,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(46,25,'',1485,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(47,25,'',1486,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(48,25,'',1487,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(49,26,'',1485,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(50,26,'',1486,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(51,26,'',1487,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(52,27,'',1485,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(53,27,'',1486,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(54,27,'',1487,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(55,28,'',1485,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(56,28,'',1486,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(57,28,'',1487,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(58,28,'',1488,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(59,29,'',1485,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(60,29,'',1486,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(61,29,'',1487,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(62,29,'',1488,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(63,29,'',1489,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(64,30,'',1485,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(65,30,'',1486,0,17,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(66,30,'',1487,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(67,30,'',1488,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(68,30,'',1489,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(69,30,'',1490,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(70,31,'',1485,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(71,31,'',1486,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(72,31,'',1487,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(73,31,'',1488,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(74,31,'',1489,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(75,31,'',1490,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(76,32,'',1,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(77,33,'',1485,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(78,34,'',1485,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(79,35,'',3,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(80,36,'',1483,0,38,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:29:49',1),(81,37,'',1,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:45:39',1),(82,38,'',1,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:45:39',1),(83,39,'',1,0,4,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:45:39',1),(84,40,'',1,0,10,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-22 09:52:16',1),(85,41,'',1,0,10,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-22 09:52:16',1),(86,42,'',1,0,10,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-22 09:52:16',1),(87,43,'',2,0,16,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-22 14:27:06',1),(88,44,'',2,0,10,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-22 09:52:16',1),(89,58,'',1,0,16,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-22 14:27:06',1),(90,61,'',1,0,10,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-22 09:52:16',1),(91,62,'',1,0,8,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-22 14:27:14',1),(92,63,'',1,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(93,64,'',1,0,8,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-22 14:27:14',1),(94,65,'',1,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(95,66,'',1,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(96,67,'',1,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(97,68,'',1,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(98,69,'',1,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(99,70,'',1,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(100,71,'',1,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(101,72,'',3,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 14:41:49',0),(102,73,'',3,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 14:41:49',0),(103,74,'',3,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 14:41:49',0),(104,75,'',3,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 14:41:49',0),(105,76,'',3,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 14:41:49',0),(106,77,'',3,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 14:41:49',0),(107,78,'',2,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(108,79,'',2,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(109,80,'',1,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(110,81,'',3,0,0,1,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 14:41:49',0),(111,82,'',2,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(112,83,'',3,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 14:41:49',0),(113,84,'',1,0,0,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(114,84,'',1484,0,90,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(115,84,'',1485,0,90,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(116,85,'',1,0,90,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(117,85,'',1480,0,90,0,'2018-07-26 00:00:00','2018-07-26 00:00:00',10,0,0,0,0,'','','2018-08-21 15:30:08',1),(118,86,'',1491,0,90,0,'2018-07-31 00:00:00','2018-08-01 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(119,87,'',1491,0,90,0,'2018-07-31 00:00:00','2018-08-01 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(120,88,'',1491,0,90,0,'2018-07-31 00:00:00','2018-08-01 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(121,89,'',1491,0,90,0,'2018-07-31 00:00:00','2018-08-01 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(122,90,'',1491,0,90,0,'2018-07-31 00:00:00','2018-08-01 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(123,91,'',1491,0,90,0,'2018-07-31 00:00:00','2018-08-01 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(124,92,'',1491,0,90,0,'2018-07-31 00:00:00','2018-08-01 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(125,93,'',1491,0,90,0,'2018-07-31 00:00:00','2018-08-01 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(126,94,'',1491,0,90,0,'2018-07-31 00:00:00','2018-08-01 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(127,95,'',1491,0,90,0,'2018-07-31 00:00:00','2018-08-01 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(128,96,'',1491,0,90,0,'2018-07-31 00:00:00','2018-08-01 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:08',1),(129,98,'',2,0,0,0,'2018-07-30 00:00:00','2018-07-30 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(130,98,'',10,0,0,0,'2018-07-30 00:00:00','2018-07-30 00:00:00',1,0,0,0,0,'','','2018-07-31 15:23:24',0),(131,100,'',4,0,0,0,'2018-07-31 00:00:00','2018-07-31 00:00:00',1,0,0,0,0,'','','2018-08-21 14:41:49',0),(132,100,'',2,0,0,0,'2018-07-31 00:00:00','2018-07-31 00:00:00',1,0,0,0,0,'','','2018-07-31 15:29:03',0),(133,106,'',6,0,0,0,'2018-07-31 00:00:00','2018-07-31 00:00:00',1,0,0,0,0,'','','2018-07-31 15:40:43',0),(134,106,'',12,0,0,0,'2018-07-31 00:00:00','2018-07-31 00:00:00',1,0,0,0,0,'','','2018-07-31 15:40:43',0),(135,107,'',1,0,0,0,'2018-07-31 00:00:00','2018-07-31 00:00:00',1,0,0,0,0,'','','2018-07-31 16:04:35',0),(136,107,'',1,0,0,0,'2018-07-31 00:00:00','2018-07-31 00:00:00',1,0,0,0,0,'','','2018-07-31 16:04:35',0),(137,108,'',7,0,0,0,'2018-08-01 00:00:00','2018-08-01 00:00:00',1,0,0,0,0,'','','2018-08-21 15:06:01',0),(138,109,'',1,0,0,0,'2018-08-07 00:00:00','2018-08-07 00:00:00',1,0,0,0,0,'','','2018-08-07 10:39:02',0),(139,109,'',2,0,0,0,'2018-08-07 00:00:00','2018-08-07 00:00:00',1,0,0,0,0,'','','2018-08-07 10:39:02',0),(140,109,'',3,0,0,0,'2018-08-07 00:00:00','2018-08-07 00:00:00',10,0,0,0,0,'','','2018-08-21 14:41:49',0),(141,109,'',10,0,0,0,'2018-08-07 00:00:00','2018-08-07 00:00:00',10,0,0,0,0,'','','2018-08-07 10:39:02',0),(142,109,'',12,0,0,0,'2018-08-07 00:00:00','2018-08-07 00:00:00',10,0,0,0,0,'','','2018-08-07 10:39:02',0),(143,110,'',10,0,0,0,'2018-08-07 00:00:00','2018-08-07 00:00:00',1,0,0,0,0,'','','2018-08-07 10:55:01',0),(144,110,'',7,0,93,0,'2018-08-07 00:00:00','2018-08-07 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:20',1),(145,110,'',12,0,93,0,'2018-08-07 00:00:00','2018-08-07 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:20',1),(146,110,'',1484,0,93,0,'2018-08-07 00:00:00','2018-08-07 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:20',1),(147,110,'',11,0,93,0,'2018-08-07 00:00:00','2018-08-07 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:20',1),(148,111,'',1,0,93,0,'2018-08-07 00:00:00','2018-08-07 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:20',1),(149,112,'',1,0,93,0,'2018-08-08 00:00:00','2018-08-08 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:20',1),(150,113,'',1,0,93,0,'2018-08-08 00:00:00','2018-08-08 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:20',1),(151,113,'',2,0,93,0,'2018-08-08 00:00:00','2018-08-08 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:20',1),(152,114,'',1,0,93,0,'2018-08-08 00:00:00','2018-08-08 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:20',1),(153,115,'',1,0,93,0,'2018-08-08 00:00:00','2018-08-08 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:20',1),(154,116,'',1,0,93,0,'2018-08-08 00:00:00','2018-08-08 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:20',1),(155,117,'',2,0,93,0,'2018-08-08 00:00:00','2018-08-08 00:00:00',1,0,0,0,0,'','','2018-08-21 15:30:20',1),(156,118,'',1,0,0,0,'2018-08-22 00:00:00','2018-08-22 00:00:00',1,0,0,0,0,'','','2018-08-22 09:38:38',0),(157,118,'',3,0,0,0,'2018-08-22 00:00:00','2018-08-22 00:00:00',1,0,0,0,0,'','','2018-08-22 09:38:38',0);
/*!40000 ALTER TABLE `requestion_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `memo` varchar(45) DEFAULT '描述',
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='角色';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'系统管理员','系统管理员拥有最高权限',1),(3,'采购人员','拥有请购单状态更新，出入库，库存状态查看权限',1),(32,'提交请购单','提交请购单',1),(33,'新增加','新增加',1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_rules`
--

DROP TABLE IF EXISTS `role_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  PRIMARY KEY (`rule_id`,`role_id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='角色权限关联表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_rules`
--

LOCK TABLES `role_rules` WRITE;
/*!40000 ALTER TABLE `role_rules` DISABLE KEYS */;
INSERT INTO `role_rules` VALUES (8,1,2),(22,1,1),(37,3,1),(38,3,2),(43,33,1),(44,33,2);
/*!40000 ALTER TABLE `role_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rule`
--

DROP TABLE IF EXISTS `rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL COMMENT '权限编码，用于页面的控制',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='权限';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rule`
--

LOCK TABLES `rule` WRITE;
/*!40000 ALTER TABLE `rule` DISABLE KEYS */;
INSERT INTO `rule` VALUES (1,'提交请购单',1,'00001'),(2,'更新请购单的状态',1,NULL),(3,'删除请购单',1,NULL),(4,'编辑权限信息',1,NULL),(5,'查看权限信息',1,NULL);
/*!40000 ALTER TABLE `rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specification`
--

DROP TABLE IF EXISTS `specification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='规格';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specification`
--

LOCK TABLES `specification` WRITE;
/*!40000 ALTER TABLE `specification` DISABLE KEYS */;
INSERT INTO `specification` VALUES (1,'黑色'),(2,'342040-0250'),(3,'3516');
/*!40000 ALTER TABLE `specification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `initiator` int(11) DEFAULT NULL,
  `flush_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COMMENT='供应商信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'MISUMI',NULL,NULL,'2018-08-01 10:36:33'),(2,'SMC',NULL,NULL,'2018-08-01 10:36:33'),(3,'白山市浑江区瑞福达医疗器械经销处',NULL,NULL,'2018-08-01 10:36:33'),(4,'保定申辰泵业有限公司',NULL,NULL,'2018-08-01 10:36:33'),(5,'北京达科为生物技术有限公司',NULL,NULL,'2018-08-01 10:36:33'),(6,'北京华大吉比爱生物技术有限公司',NULL,NULL,'2018-08-01 10:36:33'),(7,'北京未来科仪科技发展有限公司',NULL,NULL,'2018-08-01 10:36:33'),(8,'成都艾露生物科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(9,'成都艾普瑞实验设备有限公司',NULL,NULL,'2018-08-01 10:36:33'),(10,'成都辰誉仓储设备有限公司',NULL,NULL,'2018-08-01 10:36:33'),(11,'成都晨源气体有限公司',NULL,NULL,'2018-08-01 10:36:33'),(12,'成都创智机电设备工程有限公司',NULL,NULL,'2018-08-01 10:36:33'),(13,'成都顶为科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(14,'成都东方锐进科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(15,'成都金通仪器有限公司',NULL,NULL,'2018-08-01 10:36:33'),(16,'成都九州利丰商贸有限公司',NULL,NULL,'2018-08-01 10:36:33'),(17,'成都美宜佳科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(18,'成都容信达科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(19,'成都三鼎精密机械有限公司',NULL,NULL,'2018-08-01 10:36:33'),(20,'成都三行科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(21,'成都市川卫医疗器械有限责任公司',NULL,NULL,'2018-08-01 10:36:33'),(22,'成都市金百乐商贸有限公司',NULL,NULL,'2018-08-01 10:36:33'),(23,'成都市锦丽医疗设备有限公司',NULL,NULL,'2018-08-01 10:36:33'),(24,'成都市科龙化工试剂厂',NULL,NULL,'2018-08-01 10:36:33'),(25,'成都市思博瑞医疗器械有限公司',NULL,NULL,'2018-08-01 10:36:33'),(26,'成都市昕源化工有限公司',NULL,NULL,'2018-08-01 10:36:33'),(27,'成都蜀鑫科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(28,'成都天鸿新创医疗科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(29,'成都天新睿创科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(30,'成都稳健利康医疗用品有限公司',NULL,NULL,'2018-08-01 10:36:33'),(31,'成都昕源化工有限公司',NULL,NULL,'2018-08-01 10:36:33'),(32,'成都新锶维智能科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(33,'成都新西旺自动化科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(34,'成都宜科包装有限公司',NULL,NULL,'2018-08-01 10:36:33'),(35,'成都智凯自动化科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(36,'成都众皓康医疗器械有限公司',NULL,NULL,'2018-08-01 10:36:33'),(37,'东莞市浩洋自动化设备有限公司',NULL,NULL,'2018-08-01 10:36:33'),(38,'广东斯坦德流体系统有限公司',NULL,NULL,'2018-08-01 10:36:33'),(39,'广州市奥冷电子科技发展有限公司',NULL,NULL,'2018-08-01 10:36:33'),(40,'海顿直线电机(常州)有限公司',NULL,NULL,'2018-08-01 10:36:33'),(41,'杭州亿凡医疗器械有限公司',NULL,NULL,'2018-08-01 10:36:33'),(42,'河北考力森生物科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(43,'湖南圣湘生物科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(44,'基恩士（中国）有限公司',NULL,NULL,'2018-08-01 10:36:33'),(45,'江苏草源医疗器械贸易有限公司',NULL,NULL,'2018-08-01 10:36:33'),(46,'江阴法尔胜佩尔新材料科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(47,'京东',NULL,NULL,'2018-08-01 10:36:33'),(48,'京东第三方',NULL,NULL,'2018-08-01 10:36:33'),(49,'科龙化工',NULL,NULL,'2018-08-01 10:36:33'),(50,'昆明万辰科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(51,'励沃自动化设备成都有限公司',NULL,NULL,'2018-08-01 10:36:33'),(52,'米思米',NULL,NULL,'2018-08-01 10:36:33'),(53,'上海拜力生物科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(54,'上海巨翰电子材料有限公司',NULL,NULL,'2018-08-01 10:36:33'),(55,'上海联日商贸有限公司',NULL,NULL,'2018-08-01 10:36:33'),(56,'上药控股四川有限公司',NULL,NULL,'2018-08-01 10:36:33'),(57,'深圳市德航智能技术有限公司',NULL,NULL,'2018-08-01 10:36:33'),(58,'深圳市键特电子有限公司',NULL,NULL,'2018-08-01 10:36:33'),(59,'深圳市美的连医疗电子股份有限公司',NULL,NULL,'2018-08-01 10:36:33'),(60,'深圳市瑞沃德生命科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(61,'深圳市原位实业有限公司',NULL,NULL,'2018-08-01 10:36:33'),(62,'深圳市正运动技术有限公司',NULL,NULL,'2018-08-01 10:36:33'),(63,'沈阳骏宝',NULL,NULL,'2018-08-01 10:36:33'),(64,'四川爱德科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(65,'四川诚必达科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(66,'四川富鑫圣科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(67,'四川恒海达科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(68,'四川华仕医疗器械有限责任公司',NULL,NULL,'2018-08-01 10:36:33'),(69,'四川键克科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(70,'四川科伦医药贸易有限公司',NULL,NULL,'2018-08-01 10:36:33'),(71,'四川蓉飞生物技术有限公司',NULL,NULL,'2018-08-01 10:36:33'),(72,'四川省好利达生物科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(73,'四川泰川医疗设备有限公司',NULL,NULL,'2018-08-01 10:36:33'),(74,'四川悦和科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(75,'四川众鼎系统集成有限公司',NULL,NULL,'2018-08-01 10:36:33'),(76,'苏州猴皇动物实验设备科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(77,'苏州钧和伺服科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(78,'苏州智德自动控制有限公司',NULL,NULL,'2018-08-01 10:36:33'),(79,'苏州中芯启恒科学仪器有限公司',NULL,NULL,'2018-08-01 10:36:33'),(80,'淘宝',NULL,NULL,'2018-08-01 10:36:33'),(81,'天津希翼恒丰医疗器械有限公司',NULL,NULL,'2018-08-01 10:36:33'),(82,'威海洁瑞医用制品有限公司',NULL,NULL,'2018-08-01 10:36:33'),(83,'无锡贝迪生物工程股份有限公司',NULL,NULL,'2018-08-01 10:36:33'),(84,'武汉麦朗医疗科技有限公司',NULL,NULL,'2018-08-01 10:36:33'),(85,'兴化市同昌不锈钢制品厂',NULL,NULL,'2018-08-01 10:36:33'),(86,'雄克精密机械贸易（上海）有限公司',NULL,NULL,'2018-08-01 10:36:33'),(87,'怡合达',NULL,NULL,'2018-08-01 10:36:33'),(88,'易格斯',NULL,NULL,'2018-08-01 10:36:33'),(89,'英潍捷基（上海）贸易有限公司',NULL,NULL,'2018-08-01 10:36:33'),(90,'郑州瑞朗光学光源医疗电子有限公司',NULL,NULL,'2018-08-01 10:36:33'),(91,'中强辐兴科技（青岛）有限公司',NULL,NULL,'2018-08-01 10:36:33'),(92,'中山大学达安基因股份有限公司',NULL,NULL,'2018-08-01 10:36:33'),(93,'重庆海骅动物药品有限公司',NULL,NULL,'2018-08-01 10:36:33');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'/'),(2,'g'),(3,'kg'),(4,'L'),(5,'把'),(6,'包'),(7,'次'),(8,'袋'),(9,'副'),(10,'个'),(11,'根'),(12,'盒'),(13,'架'),(14,'件'),(15,'卷'),(16,'捆'),(17,'粒'),(18,'米'),(19,'片'),(20,'瓶'),(21,'双'),(22,'台'),(23,'套'),(24,'天'),(25,'桶'),(26,'箱'),(27,'张'),(28,'支'),(29,'组'),(30,'管');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_level` (`group_level`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` VALUES (4,'xx',0,1),(6,'Admin',1,1);
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_level` (`user_level`),
  CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (8,'廖长江','Admin','6c7ca345f63f835cb353ff15bd6c5e052ec08e7a',1,'no_image.jpg',1,'2018-08-24 13:48:34'),(9,'张慧','zhanghui','6c7ca345f63f835cb353ff15bd6c5e052ec08e7a',1,'no_image.jpg',1,'2018-07-24 14:17:45');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userx`
--

DROP TABLE IF EXISTS `userx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL COMMENT '中文名',
  `login_name` varchar(200) DEFAULT NULL COMMENT '登录名',
  `password` varchar(200) DEFAULT NULL COMMENT '密码',
  `role` int(11) DEFAULT '0',
  `image` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `last_login` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userx`
--

LOCK TABLES `userx` WRITE;
/*!40000 ALTER TABLE `userx` DISABLE KEYS */;
INSERT INTO `userx` VALUES (0,'admin','admin','admin',0,NULL,1,'2018-07-18 13:24:30'),(1,'廖长江','liaochangjiang','123456',0,NULL,1,'2018-07-18 13:24:30');
/*!40000 ALTER TABLE `userx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'warehouseinventory'
--

--
-- Dumping routines for database 'warehouseinventory'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-24 14:30:16
