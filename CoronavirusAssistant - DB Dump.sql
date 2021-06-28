/*
SQLyog Community
MySQL - 8.0.23 : Database - coronavirusassistant
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `accounts` */

CREATE TABLE `accounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `Email` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Password` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Name` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Status` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'PENDING',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniquename` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=5476 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `doctors` */

CREATE TABLE `doctors` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `InstitutionName` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PhoneNumber` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Address` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `JMBG` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `InstitutionPosition` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Account_ID` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_doctor_account_id` (`Account_ID`),
  CONSTRAINT `fk_doctor_account_id` FOREIGN KEY (`Account_ID`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `patients` */

CREATE TABLE `patients` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `accounts_id` int unsigned DEFAULT NULL,
  `Name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `DateOfBirth` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `PhoneNumber` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `Email` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `City` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Address` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Country` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `JMBG` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `MedicalInsuranceNO` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `NumberOfDoses` int DEFAULT '2',
  `Vaccine` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `VaccinationPlace` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `VaccinationDate` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `Status` varchar(256) COLLATE utf8_bin DEFAULT 'CONFIRMED',
  PRIMARY KEY (`id`,`JMBG`),
  KEY `fk_account_id_patient` (`accounts_id`),
  CONSTRAINT `fk_accounts_id` FOREIGN KEY (`accounts_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `Email` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'PENDING',
  `role` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `account_id` int unsigned DEFAULT NULL,
  `token` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `token_creation` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_account_id_user` (`account_id`),
  KEY `uniquename` (`name`),
  CONSTRAINT `fk_account_id_user` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `vaccines` */

CREATE TABLE `vaccines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(256) COLLATE utf8_bin NOT NULL,
  `Doses` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
