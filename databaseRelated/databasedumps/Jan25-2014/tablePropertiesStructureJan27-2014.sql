-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: data_synd_platform
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.12.04.1

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
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `properties` (
  `id` bigint(20) unsigned NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `title` varchar(64) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `pdate` date DEFAULT NULL,
  `sold` varchar(4) DEFAULT 'No',
  `description` text NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip_code` varchar(50) NOT NULL,
  `featured` varchar(4) DEFAULT NULL,
  `active` varchar(5) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `beds` varchar(10) DEFAULT NULL,
  `baths` varchar(10) DEFAULT NULL,
  `subdivision` varchar(255) DEFAULT NULL,
  `school_district` varchar(64) DEFAULT NULL,
  `year_built` int(11) DEFAULT NULL,
  `acres` double NOT NULL,
  `sqft` int(11) DEFAULT NULL,
  `lat` varchar(40) DEFAULT NULL,
  `long` varchar(40) DEFAULT NULL,
  `show_cities` text,
  `company_name` varchar(100) DEFAULT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_phone` varchar(30) DEFAULT NULL,
  `contact_email` varchar(255) NOT NULL,
  `users_id` int(11) unsigned NOT NULL,
  `notes` text,
  `expires` date DEFAULT NULL,
  `style_id` int(11) DEFAULT NULL,
  `has_garage` tinyint(1) DEFAULT NULL,
  `levels` double DEFAULT NULL,
  `testimonial` text,
  `county` varchar(50) DEFAULT NULL,
  `sale_price` varchar(35) DEFAULT NULL,
  `mls_id` int(15) DEFAULT NULL,
  `photo_limit` int(2) DEFAULT NULL,
  `credit_id` int(2) DEFAULT '1',
  `mls_url` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'active',
  `private_financing` tinyint(1) DEFAULT NULL,
  `fsbo` tinyint(1) DEFAULT NULL,
  `region` char(1) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `is_archived` tinyint(1) DEFAULT '0',
  `property_types_id` int(10) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_properties_users_idx` (`users_id`),
  KEY `fk_properties_property_types1_idx` (`property_types_id`),
  CONSTRAINT `fk_properties_property_types1` FOREIGN KEY (`property_types_id`) REFERENCES `property_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_properties_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-27 19:55:41
