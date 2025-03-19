/*
SQLyog Community v12.4.0 (64 bit)
MySQL - 8.0.30 : Database - lms_management
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lms_management` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `lms_management`;

/*Table structure for table `banners` */

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `sort_order` decimal(11,3) NOT NULL DEFAULT '0.000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `banners` */

insert  into `banners`(`id`,`name`,`description`,`image`,`path`,`created_at`,`created_by`,`updated_by`,`updated_at`,`sort_order`) values 
(1,'color-list',NULL,NULL,NULL,'2025-03-12 01:48:29',NULL,NULL,'2025-03-12 01:48:29',0.000),
(2,'test2',NULL,NULL,NULL,'2025-03-13 02:05:19',NULL,NULL,'2025-03-13 02:08:28',0.000),
(3,'test',NULL,NULL,NULL,'2025-03-13 02:08:51',NULL,NULL,'2025-03-13 02:08:51',0.000),
(4,'tests',NULL,NULL,NULL,'2025-03-13 02:09:16',NULL,NULL,'2025-03-13 02:09:16',0.000);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `group_permission` */

DROP TABLE IF EXISTS `group_permission`;

CREATE TABLE `group_permission` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_id` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` decimal(11,3) NOT NULL DEFAULT '0.000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `group_permission` */

insert  into `group_permission`(`id`,`module_name`,`form_name`,`route`,`permission_id`,`permission_name`,`sort_order`) values 
(1,'Administrator','User Permission','user_permission','list','List',1.101),
(2,'Administrator','User Permission','user_permission','add','Add',1.102),
(3,'Administrator','User Permission','user_permission','edit','Edit',1.103),
(4,'Administrator','User Permission','user_permission','delete','Delete',1.104),
(5,'Administrator','User','user','list','List',1.201),
(6,'Administrator','User','user','add','Add',1.202),
(7,'Administrator','User','user','edit','Edit',1.203),
(8,'Administrator','User','user','delete','Delete',1.204),
(9,'General','banners','banners','view','View',1.300);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2025_03_06_184913_add_is_admin_to_users_table',1),
(9,'2024_10_15_090259_create_control_access_table',2),
(10,'2024_10_15_090259_create_banners_table',3),
(11,'2024_10_15_090259_create_group_permission_table',4),
(12,'2024_10_15_063639_create_user_permission_table',5);

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading_text` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint NOT NULL DEFAULT '0',
  `is_deleted` tinyint NOT NULL DEFAULT '0',
  `created_by` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `notifications` */

insert  into `notifications`(`id`,`heading_text`,`user_id`,`message`,`is_read`,`is_deleted`,`created_by`,`created_at`,`updated_at`) values 
('1','test','1','test',0,0,NULL,'2025-03-10 23:23:17','2025-03-10 23:23:17');

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `permission_user` */

DROP TABLE IF EXISTS `permission_user`;

CREATE TABLE `permission_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_user_id_foreign` (`user_id`),
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_user` */

insert  into `permission_user`(`id`,`user_id`,`permission_id`,`created_at`,`updated_at`) values 
(1,1,1,'2025-03-12 22:53:47',NULL),
(2,1,2,'2025-03-12 22:48:12',NULL);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` char(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`permission`,`created_by`,`created_at`,`updated_by`,`updated_at`) values 
(1,'Admin','\"{\\\"user_permission\\\":{\\\"list\\\":\\\"1\\\",\\\"edit\\\":\\\"1\\\",\\\"delete\\\":\\\"1\\\"},\\\"user\\\":{\\\"list\\\":\\\"1\\\",\\\"add\\\":\\\"1\\\",\\\"edit\\\":\\\"1\\\",\\\"delete\\\":\\\"1\\\"}}\"',NULL,'2024-08-06 08:44:23',NULL,'2025-03-13 02:03:43');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`permission_id`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`is_admin`) values 
(1,'Admin','admin@gmail.com','[1,2]',NULL,'$2y$10$uzveriPsN/0i6pwo3bfjMOI1nEcDnoMc3RbYp07V9Mz4UAbKbwEra',NULL,NULL,NULL,1),
(2,'User','user@gmail.com',NULL,NULL,'$2y$10$uzveriPsN/0i6pwo3bfjMOI1nEcDnoMc3RbYp07V9Mz4UAbKbwEra',NULL,NULL,NULL,0),
(3,'ddddd','user3@gmail.com',NULL,NULL,'$2y$12$zMMlSp0Gs80IjcJ0V2FXAesYiQwXkmthfB2rCqN3bU5fW3akFEpGW',NULL,'2025-03-10 18:47:02','2025-03-10 18:47:02',0),
(4,'ddddd','user3ew@gmail.com',NULL,NULL,'$2y$12$YD/I84QnMz/93GXNbG/qKOsfgu5.kBS/9or6WtyfaYWSeQMblQxAK',NULL,'2025-03-10 18:47:31','2025-03-10 18:47:31',0),
(5,'ddddd','userw3ew@gmail.com',NULL,NULL,'$2y$12$CFvQR2TDk1IaxLV3r1BUcuXT3B5fFJ7UzVHfSTsETtJtgsx2av7Pu',NULL,'2025-03-10 18:47:56','2025-03-10 18:47:56',0),
(6,'test Product2','222@gmail.com',NULL,NULL,'$2y$12$lp8QowCV6lV0Le/pCS0NLu6PRVNWUNeOCMfMjo3dqV44MYY0xu1A6',NULL,'2025-03-10 18:49:30','2025-03-10 18:49:30',0),
(7,'wqwqw','qwqwq@gmail.com',NULL,NULL,'$2y$12$pEtP5aekutAXXg2dof9naeBEmdAag329/rSTWdt9JW/3RwPXNzJZ6',NULL,'2025-03-10 18:52:41','2025-03-10 18:52:41',0),
(8,'Admin','user12@gmail.com',NULL,NULL,'$2y$12$fl4t4GUcQaFerNtdCxd4LuXXvCU0K6dsxGvJhyzkOpGiYEnhLTpyW',NULL,'2025-03-10 18:55:23','2025-03-10 18:55:23',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
