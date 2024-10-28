/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.7.23-log : Database - veteran
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`veteran` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `veteran`;

/*Table structure for table `animal` */

DROP TABLE IF EXISTS `animal`;

CREATE TABLE `animal` (
  `animal_rid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `category_rid` int(11) DEFAULT NULL,
  `description` text,
  `img_url` text,
  `status` tinyint(4) DEFAULT '1' COMMENT '0 = inactive, 1 = active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`animal_rid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `animal` */

insert  into `animal`(`animal_rid`,`name`,`category_rid`,`description`,`img_url`,`status`,`created_at`,`updated_at`) values (1,'Dog',1,'fgfdg','124747485061384e865caaf.jpg',0,'2021-09-08 11:17:50',NULL),(2,'Dog',2,'fdgfd','207837378261384f1a82474.jpg',1,'2021-09-08 11:20:18','2021-09-08 20:02:03'),(3,'PIGON',1,'IT\'S A BIRD','646035473613866be5cbed.jpg',1,'2021-09-08 13:01:10','2021-09-08 20:02:16');

/*Table structure for table `appointment` */

DROP TABLE IF EXISTS `appointment`;

CREATE TABLE `appointment` (
  `appointment_rid` int(11) NOT NULL AUTO_INCREMENT,
  `user_rid` int(11) DEFAULT NULL,
  `doctor_rid` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `description` text,
  `status` tinyint(4) DEFAULT '0' COMMENT '0 = draft, 1 = accpted, -1 = rejected',
  `reject_reason` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`appointment_rid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `appointment` */

insert  into `appointment`(`appointment_rid`,`user_rid`,`doctor_rid`,`date_time`,`description`,`status`,`reject_reason`,`created_at`,`updated_at`) values (1,8,4,'2021-09-09 11:00:00','fghfgh',1,'','2021-09-08 12:43:13',NULL),(2,8,3,'2021-09-15 11:30:00','fewer',-1,'i am bsy','2021-09-08 12:50:35',NULL);

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_rid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '0 = inactive, 1 = active',
  PRIMARY KEY (`category_rid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `category` */

insert  into `category`(`category_rid`,`name`,`status`) values (1,'bird',1),(2,'animal',1);

/*Table structure for table `disease` */

DROP TABLE IF EXISTS `disease`;

CREATE TABLE `disease` (
  `disease_rid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) DEFAULT '1' COMMENT '0 = inactive, 1 = active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`disease_rid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `disease` */

insert  into `disease`(`disease_rid`,`name`,`description`,`status`,`created_at`,`updated_at`) values (1,'vsd','fvfg',1,'2021-09-08 12:38:40',NULL);

/*Table structure for table `disease_animal_map` */

DROP TABLE IF EXISTS `disease_animal_map`;

CREATE TABLE `disease_animal_map` (
  `dam_rid` int(11) NOT NULL AUTO_INCREMENT,
  `animal_rid` int(11) DEFAULT NULL,
  `disease_rid` int(11) DEFAULT NULL,
  PRIMARY KEY (`dam_rid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `disease_animal_map` */

insert  into `disease_animal_map`(`dam_rid`,`animal_rid`,`disease_rid`) values (1,3,1);

/*Table structure for table `doctor` */

DROP TABLE IF EXISTS `doctor`;

CREATE TABLE `doctor` (
  `doctor_rid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '0 = inactive, 1 = active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`doctor_rid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `doctor` */

insert  into `doctor`(`doctor_rid`,`name`,`contact`,`email`,`password`,`address`,`status`,`created_at`,`updated_at`) values (3,'xyz','9876543289','xyz@gmail.com','890','Mangalore',0,'2021-08-30 09:57:31',NULL),(4,'raj','9567436525','ujy4e@gmail.com','uyeuy','yeikkeu',1,'2021-09-08 11:40:06',NULL);

/*Table structure for table `food` */

DROP TABLE IF EXISTS `food`;

CREATE TABLE `food` (
  `food_rid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `img_url` text,
  `status` tinyint(4) DEFAULT '1' COMMENT '0 = inactive, 1 = active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`food_rid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `food` */

insert  into `food`(`food_rid`,`name`,`description`,`img_url`,`status`,`created_at`,`updated_at`,`quantity`,`price`) values (6,'abcd','gjrrrgergreg','107083692612c7a0b4cf72.jpg',1,'2021-08-30 11:56:19','2021-09-08 21:44:19',0,90),(7,'hfgh','fgdgtgfdg','1695784195612c8b22aa8ee.jpg',1,'2021-08-30 13:09:14','2021-08-30 13:09:28',20,89),(8,'dgfd','fgfg','14508521516138e1d60e6de.jpg',1,'2021-09-08 21:46:22',NULL,1,78);

/*Table structure for table `food_animal_map` */

DROP TABLE IF EXISTS `food_animal_map`;

CREATE TABLE `food_animal_map` (
  `fam_rid` int(11) NOT NULL AUTO_INCREMENT,
  `animal_rid` int(11) DEFAULT NULL,
  `food_rid` int(11) DEFAULT NULL,
  PRIMARY KEY (`fam_rid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `food_animal_map` */

insert  into `food_animal_map`(`fam_rid`,`animal_rid`,`food_rid`) values (1,3,6);

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `order_rid` int(11) NOT NULL AUTO_INCREMENT,
  `food_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ordered_date` date DEFAULT NULL,
  `required_quantity` int(11) DEFAULT NULL,
  `order_status` int(5) DEFAULT '0' COMMENT '0-under process,1-accepted,2-rejected',
  `total_cost` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_rid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `order` */

insert  into `order`(`order_rid`,`food_id`,`user_id`,`ordered_date`,`required_quantity`,`order_status`,`total_cost`) values (4,8,4,'2021-09-08',42,2,3276),(5,7,4,'2021-09-08',5,1,445);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_rid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_rid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`user_rid`,`name`,`contact`,`email`,`password`,`address`,`status`,`created_at`,`updated_at`) values (4,'abcd','9876543210','suneethamoolya090@gmail.com','890','Mangalore',1,'2021-08-30 09:56:10',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
