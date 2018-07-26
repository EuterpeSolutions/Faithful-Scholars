-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db743020317.db.1and1.com
-- Generation Time: Jul 25, 2018 at 07:21 PM
-- Server version: 5.5.60-0+deb7u1-log
-- PHP Version: 5.4.45-0+deb7u14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db743020317`
--

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
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
  `last_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `family_id`, `type_id`, `highschool`, `replacement_card`, `schea`, `schea_sent`, `enchanted_learning`, `enchanted_learning_sent`, `expedited`, `initial_1`, `initial_2`, `initial_3`, `initial_4`, `initial_5`, `initial_6`, `last_updated_at`) VALUES
(69, 20, 3, 1, 1, 0, 0, 0, NULL, 0, 'TE', 'TE', 'TE', 'TE', 'TE', 'TE', '2018-07-19 21:40:20'),
(70, 21, 3, 75, 1, 0, 0, 0, NULL, 1, 'TM', 'TM', 'TM', 'TM', 'TM', 'TM', '2018-07-16 21:34:54'),
(74, 25, 3, 75, 1, 1, 0, 1, NULL, 1, 'GP', 'GP', '', 'GP', 'GP', 'GP', '2018-07-03 01:22:56'),
(75, 26, 3, 0, 0, 0, 0, 0, NULL, 0, 'kb', 'ksb', 'ksb', 'ksb', 'kb', 'kb', '2018-07-13 19:52:30');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `family` (`id`),
  ADD CONSTRAINT `membership_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `membership_types` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
