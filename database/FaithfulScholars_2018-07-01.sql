# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.22)
# Database: FaithfulScholars
# Generation Time: 2018-07-01 20:38:15 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE db743020317;

# Dump of table eoy
# ------------------------------------------------------------

DROP TABLE IF EXISTS `eoy`;

CREATE TABLE `eoy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `family_id` int(11) unsigned NOT NULL,
  `initial_1` varchar(11) NOT NULL DEFAULT '',
  `initial_2` varchar(11) NOT NULL DEFAULT '',
  `initial_3` varchar(11) NOT NULL DEFAULT '',
  `initial_4` varchar(11) NOT NULL DEFAULT '',
  `initial_5` varchar(11) NOT NULL DEFAULT '',
  `initial_6` varchar(11) NOT NULL DEFAULT '',
  `initial_7` varchar(11) NOT NULL DEFAULT '',
  `submitted_worksheet` tinyint(1) NOT NULL,
  `dual_enrollment` tinyint(1) NOT NULL,
  `last_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  CONSTRAINT `eoy_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table family
# ------------------------------------------------------------

DROP TABLE IF EXISTS `family`;

CREATE TABLE `family` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `zip` varchar(255) NOT NULL DEFAULT '',
  `county` varchar(255) NOT NULL DEFAULT '',
  `new` tinyint(1) DEFAULT NULL,
  `mom_cell` varchar(10) DEFAULT NULL,
  `dad_cell` varchar(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(20) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `last_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `family` WRITE;
/*!40000 ALTER TABLE `family` DISABLE KEYS */;

INSERT INTO `family` (`id`, `father_name`, `mother_name`, `address`, `city`, `zip`, `county`, `new`, `mom_cell`, `dad_cell`, `email`, `phone`, `first_name`, `last_name`, `district`, `last_updated_at`)
VALUES
	(20,'test','test','123 Somewhere St','TestTown','12345','York',1,'','','admin@email.com','12312341234','test','test','','2018-07-01 16:37:47');

/*!40000 ALTER TABLE `family` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table homeschool
# ------------------------------------------------------------

DROP TABLE IF EXISTS `homeschool`;

CREATE TABLE `homeschool` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `family_id` int(11) unsigned NOT NULL,
  `school_start_date` varchar(255) DEFAULT NULL,
  `school_end_date` varchar(255) DEFAULT NULL,
  `new_homeschool` tinyint(1) DEFAULT NULL,
  `years_homeschooling` int(255) DEFAULT NULL,
  `primary_instructor` varchar(25) DEFAULT NULL,
  `removing_public_school` varchar(255) DEFAULT NULL,
  `referred_by` varchar(255) DEFAULT NULL,
  `school_district` varchar(255) DEFAULT NULL,
  `school_fax` varchar(255) DEFAULT NULL,
  `last_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `familyId` (`family_id`),
  CONSTRAINT `homeschool_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `homeschool` WRITE;
/*!40000 ALTER TABLE `homeschool` DISABLE KEYS */;

INSERT INTO `homeschool` (`id`, `family_id`, `school_start_date`, `school_end_date`, `new_homeschool`, `years_homeschooling`, `primary_instructor`, `removing_public_school`, `referred_by`, `school_district`, `school_fax`, `last_updated_at`)
VALUES
	(12,20,'test','test',1,2,'test','no','','','','2018-07-01 16:37:47');

/*!40000 ALTER TABLE `homeschool` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL DEFAULT '',
  `psalt` varchar(255) DEFAULT NULL,
  `password` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT '',
  `family_id` int(11) NOT NULL,
  `admin` int(1) DEFAULT '0',
  `last_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;

INSERT INTO `members` (`id`, `username`, `psalt`, `password`, `email`, `family_id`, `admin`, `last_updated_at`)
VALUES
	(20,'admin','3fe87a589cd6c017904496df91dcca6d1b7ee71e23ade72c84412e7aab8711f8','69cc80a0b52d37c83fd5a12936f9e7f9f5299ea6628bfbb79235e5ecbdd99b5e','admin@email.com',20,0,'2018-07-01 16:37:47');

/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table membership
# ------------------------------------------------------------

DROP TABLE IF EXISTS `membership`;

CREATE TABLE `membership` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `family_id` int(11) unsigned NOT NULL,
  `type_id` int(11) unsigned NOT NULL,
  `highschool` int(11) DEFAULT NULL,
  `replacement_card` tinyint(1) DEFAULT NULL,
  `schea` tinyint(1) DEFAULT NULL,
  `schea_sent` tinyint(1) DEFAULT '0',
  `enchanted_learning` tinyint(1) DEFAULT NULL,
  `enchanted_learning_sent` tinyint(1) DEFAULT NULL,
  `expedited` tinyint(1) DEFAULT NULL,
  `initial_1` varchar(11) NOT NULL DEFAULT '',
  `initial_2` varchar(11) NOT NULL DEFAULT '',
  `initial_3` varchar(11) NOT NULL DEFAULT '',
  `initial_4` varchar(11) NOT NULL DEFAULT '',
  `initial_5` varchar(11) NOT NULL DEFAULT '',
  `initial_6` varchar(11) NOT NULL DEFAULT '',
  `last_updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`),
  CONSTRAINT `membership_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `membership_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `membership` WRITE;
/*!40000 ALTER TABLE `membership` DISABLE KEYS */;

INSERT INTO `membership` (`id`, `family_id`, `type_id`, `highschool`, `replacement_card`, `schea`, `schea_sent`, `enchanted_learning`, `enchanted_learning_sent`, `expedited`, `initial_1`, `initial_2`, `initial_3`, `initial_4`, `initial_5`, `initial_6`, `last_updated_at`)
VALUES
	(69,20,3,150,1,1,0,1,NULL,1,'TE','TE','TE','TE','TE','TE','2018-07-01 16:37:47');

/*!40000 ALTER TABLE `membership` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table membership_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `membership_types`;

CREATE TABLE `membership_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `membership_types` WRITE;
/*!40000 ALTER TABLE `membership_types` DISABLE KEYS */;

INSERT INTO `membership_types` (`id`, `name`, `price`)
VALUES
	(1,'kindergarten',25),
	(2,'single-student',35),
	(3,'multi-student',60);

/*!40000 ALTER TABLE `membership_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table student
# ------------------------------------------------------------

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `family_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `grade` int(11) NOT NULL,
  `age` int(11) NOT NULL DEFAULT '0',
  `birthday` varchar(11) NOT NULL DEFAULT '',
  `curriculum_desc` varchar(255) NOT NULL DEFAULT '',
  `last_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;

INSERT INTO `student` (`id`, `family_id`, `name`, `grade`, `age`, `birthday`, `curriculum_desc`, `last_updated_at`)
VALUES
	(18,20,'Test1',1,12,'12','12','2018-07-01 16:37:47'),
	(19,20,'Test2',12,12,'12','12','2018-07-01 16:37:47');

/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
