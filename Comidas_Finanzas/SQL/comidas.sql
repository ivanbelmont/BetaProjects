/*
SQLyog Community v11.12 (64 bit)
MySQL - 5.5.32 : Database - comidas
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`comidas` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `comidas`;

/*Table structure for table `comida` */

DROP TABLE IF EXISTS `comida`;

CREATE TABLE `comida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `comida` */

insert  into `comida`(`id`,`nombre`) values (1,'Sebiche de Atun'),(2,'Milanesa de Pollo'),(3,'Tacos dorados');

/*Table structure for table `historico` */

DROP TABLE IF EXISTS `historico`;

CREATE TABLE `historico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_preparacion` date NOT NULL DEFAULT '0000-00-00',
  `fecha_repeticion` date DEFAULT NULL,
  `id_comida` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `historico` */

insert  into `historico`(`id`,`fecha_preparacion`,`fecha_repeticion`,`id_comida`) values (1,'2015-10-28','2015-10-28',1),(3,'2015-10-29','2015-10-29',2),(4,'2015-12-04','2015-11-14',3);

/*Table structure for table `ingredientes` */

DROP TABLE IF EXISTS `ingredientes`;

CREATE TABLE `ingredientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `id_comida` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `ingredientes` */

insert  into `ingredientes`(`id`,`nombre`,`precio`,`id_comida`) values (1,'Lata de Atun',10,1),(2,'Lata de Champiñones',12,1),(3,'Lata de Elotes',15,1),(4,'Mayonesa ch',15,1),(5,'1/2 Pollo',50,2),(6,'Empanizador',15,2);

/*Table structure for table `preparacion` */

DROP TABLE IF EXISTS `preparacion`;

CREATE TABLE `preparacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `descripcion` text,
  `id_comida` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `preparacion` */

insert  into `preparacion`(`id`,`nombre`,`orden`,`descripcion`,`id_comida`) values (1,'1.- Escurrir lata de atun',1,'Se debe vaciar en su totalidad la lata',1),(2,'2.- Mezclar todos los ingredientes con la mayonesa',2,'-',1);

/*Table structure for table `videos` */

DROP TABLE IF EXISTS `videos`;

CREATE TABLE `videos` (
  `id_video` int(1) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `url` text NOT NULL,
  `fecha_video` date NOT NULL DEFAULT '0000-00-00',
  `id_comida` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_video`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `videos` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
