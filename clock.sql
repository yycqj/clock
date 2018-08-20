/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.32-MariaDB : Database - clock
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`clock` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `clock`;

/*Table structure for table `clock_data` */

DROP TABLE IF EXISTS `clock_data`;

CREATE TABLE `clock_data` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `clock_status` enum('in','out','NULL') NOT NULL DEFAULT 'NULL',
  `clock_date` int(11) NOT NULL,
  `clock_day` date NOT NULL,
  `clock_week` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
