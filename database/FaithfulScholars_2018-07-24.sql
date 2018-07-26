# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.22)
# Database: FaithfulScholars
# Generation Time: 2018-07-25 01:06:50 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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
  `last_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  CONSTRAINT `eoy_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`) ON DELETE CASCADE
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
  `last_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
  `last_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `familyId` (`family_id`),
  CONSTRAINT `homeschool_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL DEFAULT '',
  `psalt` varchar(255) DEFAULT NULL,
  `password` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT '',
  `family_id` int(11) unsigned NOT NULL,
  `admin` int(1) DEFAULT '0',
  `last_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approved` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  CONSTRAINT `members_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
  `last_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `membership_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `membership_types` (`id`),
  CONSTRAINT `membership_ibfk_3` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table membership_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `membership_types`;

CREATE TABLE `membership_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
  `last_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
