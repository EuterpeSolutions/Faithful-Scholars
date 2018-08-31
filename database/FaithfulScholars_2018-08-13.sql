# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.22)
# Database: FaithfulScholars
# Generation Time: 2018-08-13 23:28:37 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;



--
-- Dumping routines (PROCEDURE) for database 'FaithfulScholars'
--
DELIMITER ;;

# Dump of PROCEDURE insertUser
# ------------------------------------------------------------

/*!50003 DROP PROCEDURE IF EXISTS `insertUser` */;;
/*!50003 SET SESSION SQL_MODE="ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"*/;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `insertUser`(
IN fn_p VARCHAR(50),
IN ln_p VARCHAR(50),
IN fan_p VARCHAR(50),
IN mn_p VARCHAR(50),
IN a_p VARCHAR(50),
IN c_p VARCHAR(50),
IN z_p VARCHAR(50),
IN co_p VARCHAR(50),
IN p_p VARCHAR(10),
IN mc_p VARCHAR(10),
IN dc_p VARCHAR(10),
IN e_p VARCHAR(50),
IN n_p VARCHAR(50),
IN d_p VARCHAR(50),
IN uname_p VARCHAR(50),
IN psalt_p VARCHAR(255),
IN pass_p VARCHAR(255),
IN sDate_p VARCHAR(50),
IN eDate_p VARCHAR(50),
IN nhs_p TINYINT(1),
IN yhs_p INT(10),
IN pi_p VARCHAR(50),
IN rp_p VARCHAR(50),
IN re_p VARCHAR(50),
IN sd_p VARCHAR(50),
IN sf_p VARCHAR(50),
IN type_p INT(11),
IN hs_p TINYINT(1),
IN schea_p TINYINT(1),
IN el_p TINYINT(1),
IN expedited_p TINYINT(1),
IN i1_p VARCHAR(50),
IN i2_p VARCHAR(50),
IN i3_p VARCHAR(50),
IN i4_p VARCHAR(50),
IN i5_p VARCHAR(50),
IN i6_p VARCHAR(50)
)
BEGIN
	DECLARE errno INT;
	DECLARE new_family_id INT;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
		BEGIN
			GET CURRENT DIAGNOSTICS CONDITION 1 errno = MYSQL_ERRNO;
			SELECT errno AS MYSQL_ERROR;
			ROLLBACK;
		END;
	
	START TRANSACTION;
-- Insert Family
		INSERT INTO family (first_name, last_name, father_name, mother_name, address, city, zip, county, phone, mom_cell, dad_cell, email, new, district) VALUES (fn_p,ln_p, fan_p, mn_p, a_p, c_p, z_p, co_p, p_p, mc_p, dc_p, e_p, n_p, d_p);
		SET new_family_id = LAST_INSERT_ID();
		
-- Insert members
		INSERT INTO members (username,psalt,`password`,email,family_id) VALUES (uname_p, psalt_p,pass_p,e_p,new_family_id);
		
-- Insert homeschool
		INSERT INTO homeschool(family_id, school_start_date, school_end_date, new_homeschool, years_homeschooling, primary_instructor, removing_public_school, referred_by, school_district, school_fax) VALUES (new_family_id,sDate_p, eDate_p, nhs_p, yhs_p, pi_p, rp_p, re_p, sd_p, sf_p);
		
-- Insert membership
		INSERT INTO membership(family_id, type_id, highschool, schea, enchanted_learning, expedited, initial_1, initial_2, initial_3, initial_4, initial_5, initial_6) VALUES (new_family_id, type_p, hs_p, schea_p, el_p, expedited_p, i1_p, i2_p, i3_p, i4_p, i5_p, i6_p);
		
		SELECT new_family_id;
	COMMIT;
END */;;

/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;;
DELIMITER ;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
