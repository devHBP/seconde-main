-- MySQL dump 10.13  Distrib 9.1.0, for Linux (aarch64)
--
-- Host: localhost    Database: seconde_main
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_button_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_button_font` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subheader_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subheader_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subheader_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subheader_button` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subheader_button_font` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_cards_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_cards_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_cards_font` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_cards_svg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_cards_button` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pattern_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'Magasin01','Sport 2000/WAS Argeles/mer','sport-2000-was-argeles-mer','$2y$12$YpzZAqo7pIFZFS6yNdPIs.dhB1hAOMKM8UO46ndets0/gm5Un2nWq',NULL,'#324c21','#e7d7c0','#516d65','#516d65','#000000','#516d65','#ddd0b9','#4e6860','#e7d7c0','#334c21','#334c21','#516d65','#334c21','#ddd0b9','#ddd0b9','#334c21','25','2024-11-04 12:05:09','2024-12-04 13:28:07'),(2,'hbp','H-BP','h-bp','$2y$12$zr1TMWRd2705jYM2ThnaiehvL3nbkz.scqYon6X1C8ArpJjmr9o.i',NULL,'#ffffff','#b97979','#000000','#e6dbcc',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-02 13:15:41','2024-12-02 15:05:47'),(4,'youdo-claira','Youdo Linx Optique Claira','youdo-linx-optique-claira','$2y$12$3D/0X56YgNzNNB44WH5tuOBMzpFHFETd8U.qs/rEa5AyTpKeJKUhK',NULL,'#f5f5f5','#000000','#ea572a','#ffe7d1','#000000','#ea572a','#000000','#f5f5f5','#000000','#080808','#f5f5f5','#ffffff','#231a1a','#000000','#ea572a','#f5f5f5',NULL,'2024-12-03 11:38:34','2024-12-04 15:47:54');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_name_account_id_unique` (`name`,`account_id`),
  KEY `brands_account_id_foreign` (`account_id`),
  CONSTRAINT `brands_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'NIKE','2',1,'2024-11-07 11:46:07','2024-11-21 09:46:37'),(5,'LACOSTE','3',1,'2024-11-07 13:18:39','2024-11-21 09:49:40'),(6,'ADIDAS','4',1,'2024-11-07 13:31:10','2024-11-21 09:50:52'),(7,'PUMA','5',1,'2024-11-07 13:31:15','2024-11-21 09:51:58'),(9,'LE COQ SPORTIF','6',1,'2024-11-07 13:31:46','2024-11-21 09:53:52'),(10,'UNDER ARMOUR','7',1,'2024-11-07 13:32:04','2024-11-21 09:54:26'),(11,'RALPH LAUREN','8',1,'2024-11-07 13:32:14','2024-11-21 09:55:44'),(12,'TOMMY HILFIGER','9',1,'2024-11-07 13:32:41','2024-11-21 09:57:02'),(13,'HUGO BOSS','10',1,'2024-11-07 13:32:50','2024-11-21 09:57:48'),(14,'LEVIS','11',1,'2024-11-07 13:32:56','2024-11-21 09:58:51'),(15,'GUESS','12',1,'2024-11-07 13:33:29','2024-11-21 09:59:25'),(16,'NOX',NULL,1,'2024-11-15 15:01:08','2024-11-15 15:01:08'),(17,'LE TEMPS DES CERISES','13',1,'2024-11-21 09:04:03','2024-11-21 11:08:09'),(18,'RAY-BAN','26',4,'2024-12-04 15:39:54','2024-12-04 15:39:54');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consent` tinyint(1) NOT NULL DEFAULT '0',
  `account_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_email_unique` (`email`),
  UNIQUE KEY `clients_phone_unique` (`phone`),
  KEY `clients_account_id_foreign` (`account_id`),
  CONSTRAINT `clients_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Desjardins','Jean','jeandesjardins@mail.com','0600000000',1,1,'2024-11-12 16:16:30','2024-11-12 16:16:30'),(2,'Dumoulin','Etienne','etiennedumoulin@mail.com','0000000000',1,1,'2024-11-13 09:07:31','2024-11-13 09:07:31'),(6,'Lou','Marc','marclou@mail.com',NULL,0,1,'2024-11-14 14:44:43','2024-11-14 14:44:43'),(7,'Dupont','Marc','marcdupont@mail.com',NULL,1,1,'2024-11-14 15:00:08','2024-11-14 15:00:08'),(8,'Moulin','Jeannot','jeannotmoulin@mail.com',NULL,1,1,'2024-11-14 15:00:37','2024-11-14 15:00:37'),(10,'Dernier','Margot',NULL,'0600000001',0,1,'2024-11-14 15:37:06','2024-11-18 13:51:11'),(12,'Hbp','Dev','dev@h-bp.fr',NULL,0,1,'2024-11-15 13:42:36','2024-11-25 15:57:52');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_10_31_135020_create_table_account_and_add_role_on_user_table',2),(5,'2024_11_05_140922_add_field_description_on_roles_table',3),(6,'2024_11_07_112202_create_brands_table',4),(7,'2024_11_07_120634_create_types_table',5),(8,'2024_11_07_135549_create_states_table',6),(9,'2024_11_07_152034_create_products_table_and_product_state_table',7),(11,'2024_11_12_120927_create_client_table',8),(12,'2024_11_13_120022_create_field_user_id_on_panier_table',9),(13,'2024_11_14_081620_add_unique_field_on_product_panier_table',10),(14,'2024_11_15_090045_create_ticket_reprise_table',11),(15,'2024_11_15_115821_add_account_id_field_in_ticket_reprise_table',12),(16,'2024_11_20_131332_update_column_type_utilisation_on_tickets_reprise_table',13),(17,'2024_11_21_134127_add_fields_on_accounts_table',14),(18,'2024_11_27_093149_add_fields_slug_and_code_caisse',15),(19,'2024_12_02_104032_add_code_caisse_field_on_product_panier_table',16),(20,'2024_12_04_084646_add_fields_custom_color_to_account_table',17);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paniers`
--

DROP TABLE IF EXISTS `paniers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paniers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `total_remboursement` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total_bon_achat` decimal(8,2) NOT NULL DEFAULT '0.00',
  `account_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('en_cours','valide','annule','restitue') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_cours',
  PRIMARY KEY (`id`),
  KEY `paniers_account_id_foreign` (`account_id`),
  KEY `paniers_client_id_foreign` (`client_id`),
  KEY `paniers_user_id_foreign` (`user_id`),
  CONSTRAINT `paniers_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `paniers_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  CONSTRAINT `paniers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paniers`
--

LOCK TABLES `paniers` WRITE;
/*!40000 ALTER TABLE `paniers` DISABLE KEYS */;
/*!40000 ALTER TABLE `paniers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pictures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pictures`
--

LOCK TABLES `pictures` WRITE;
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` VALUES (1,'pngegg.png','icons/72iyspXxvuzlxVSLqfnmc0HPdryiYOPVL5VwHuKH.png','icon','2024-11-21 09:04:03','2024-11-21 09:04:03'),(2,'nike-logo.svg','icons/5MMnphHDcEVgv0gr3zxTOz9AIpuJmhPPDuzBpkoQ.svg','icon','2024-11-21 09:46:37','2024-11-21 09:46:37'),(3,'Logo_lacoste.svg','icons/O4dwQzpi2E9ZQw0Q1vQKVGirwcXglKIoNuZaKobT.svg','icon','2024-11-21 09:49:40','2024-11-21 09:49:40'),(4,'Adidas_Logo.svg','icons/j2zW4eD3qGKvMSqC7P3XFCU6JXwqqdXl4EXzQ3z1.svg','icon','2024-11-21 09:50:52','2024-11-21 09:50:52'),(5,'Puma_AG.svg','icons/zJoSIyF9L4sZsA9cXNbczbGoewAxm8jIoo20aUad.svg','icon','2024-11-21 09:51:58','2024-11-21 09:51:58'),(6,'Le_coq_sportif_2016_logo.svg','icons/q19KzoKD9X0hpP4xAOCAicQ82eMxfkjwJtEpPO9g.svg','icon','2024-11-21 09:53:52','2024-11-21 09:53:52'),(7,'Under_armour_logo.svg','icons/u9VxO1k3wzK24DLyt0jvLy5QjrQwYKi9limGe0QY.svg','icon','2024-11-21 09:54:26','2024-11-21 09:54:26'),(8,'ralphlauren.svg','icons/lfT7yCmOLKsy8PdvltH8O9UJZDPAV1LLIF0sp0fK.svg','icon','2024-11-21 09:55:44','2024-11-21 09:55:44'),(9,'tommy-hilfiger-2.svg','icons/o3FxcUtkktHqJxdyx6xYFNUSRfuyHHXYNt6UQAAo.svg','icon','2024-11-21 09:57:02','2024-11-21 09:57:02'),(10,'Hugo-Boss-Logo.svg','icons/xoXJfxh2I3oHOFwwAYNoJllSMKx5LtoWv0zhWnkd.svg','icon','2024-11-21 09:57:48','2024-11-21 09:57:48'),(11,'Levi\'s_logo.svg','icons/A7Mw4eJWrfpghb9fC8leGCVRzD97FOCVvFBHmuMz.svg','icon','2024-11-21 09:58:51','2024-11-21 09:58:51'),(12,'Guess_logo.svg','icons/8DHeq0I6PDyDTcfRDmOTDvGnwcOuuqjnr9459dxA.svg','icon','2024-11-21 09:59:25','2024-11-21 09:59:25'),(13,'shorts.png','icons/Tsbn6cqG2TzkaKBeUUSEpXaY1z72cymqSKTaj47J.png','icon','2024-11-21 11:04:28','2024-11-21 11:04:28'),(14,'vetements (1).png','icons/ZiqnMFdMZjvBwBkeFyENzQVNGKRjZj6oROTktYwV.png','icon','2024-11-21 11:15:01','2024-11-21 11:15:01'),(15,'pull-over.png','icons/cAYyss40k7VMX4Bswwq0ba9cGBysMnnrELHofph3.png','icon','2024-11-21 11:17:41','2024-11-21 11:17:41'),(16,'sweat-a-capuche.png','icons/2q0fPlpLpZuC2fAW7fhjIWBlNbsLeG0CofAZ7SqS.png','icon','2024-11-21 11:18:01','2024-11-21 11:18:01'),(17,'pantalon.png','icons/9fPRi6DxlU8RBAV0SedtLzaIVYz4s8ssv783c8Db.png','icon','2024-11-21 11:18:14','2024-11-21 11:18:14'),(18,'jeans.png','icons/sIm4GujM7rtnAlY7960FslHdhwA6TsLlggNjpUsA.png','icon','2024-11-21 11:18:24','2024-11-21 11:18:24'),(19,'chemise.png','icons/rJy4qO6OEO7PLvZg1MCUExxlw4MyKvuGDUt0lUQA.png','icon','2024-11-21 11:18:36','2024-11-21 11:18:36'),(20,'veste.png','icons/Azd4icVWdyi92i0mM44M52zqOiwkfguACU8R7jYQ.png','icon','2024-11-21 11:18:46','2024-11-21 11:18:46'),(21,'manteau.png','icons/uZBKOtSa8oeacg0vq5jnZ8uzUnUJZmgRt4y5LbG2.png','icon','2024-11-21 11:19:00','2024-11-21 11:19:00'),(22,'jupe.png','icons/flXWzcT6diWOnvK7KGHWrHpbCykrAD3nAXhijvRR.png','icon','2024-11-21 11:19:10','2024-11-21 11:19:10'),(23,'vetements (2).png','icons/mrPz2S1y33WnlE7wfrTu1d9fSoDctUonjlq9nzV8.png','icon','2024-11-21 11:19:21','2024-11-21 11:19:21'),(24,'sac-a-main.png','icons/6PxR271hCGRsAqIJo9AIZUxSqcPu1BiSjZTthss3.png','icon','2024-11-21 11:19:56','2024-11-21 11:19:56'),(25,'Fichier 1.svg','customisation/Gz9tVrgbXMG82VROT6nJnkGUDg1aZbZiAVk7foJU.svg','icon','2024-11-22 09:48:27','2024-11-22 09:48:27'),(26,'rayban.png','icons/n33PakJMDROc5OHB2O7W6xvLbuOcTDRkcvSxjceW.png','icon','2024-12-04 15:39:54','2024-12-04 15:39:54'),(27,'glasses-svgrepo-com.png','icons/GaiucgpLOJrTiBiDChEa9dXWw13cY9sAWGwsVqwr.png','icon','2024-12-04 15:46:20','2024-12-04 15:46:20'),(28,'glasses-svgrepo-com-etui.png','icons/UTJxPPcmV1wgXfwMyshnzw1fIlrjgpKeURm94y3g.png','icon','2024-12-05 09:37:35','2024-12-05 09:37:35');
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_panier`
--

DROP TABLE IF EXISTS `product_panier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_panier` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `prix_remboursement` decimal(6,2) DEFAULT NULL,
  `prix_bon_achat` decimal(6,2) DEFAULT NULL,
  `code_caisse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `product_id` bigint unsigned DEFAULT NULL,
  `panier_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_state_panier_unique` (`product_id`,`state`,`panier_id`),
  KEY `product_panier_panier_id_foreign` (`panier_id`),
  CONSTRAINT `product_panier_panier_id_foreign` FOREIGN KEY (`panier_id`) REFERENCES `paniers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_panier_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_panier`
--

LOCK TABLES `product_panier` WRITE;
/*!40000 ALTER TABLE `product_panier` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_panier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_states`
--

DROP TABLE IF EXISTS `product_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `state_id` bigint unsigned NOT NULL,
  `prix_remboursement` decimal(6,2) DEFAULT NULL,
  `prix_bon_achat` decimal(6,2) DEFAULT NULL,
  `code_caisse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_states_product_id_foreign` (`product_id`),
  KEY `product_states_state_id_foreign` (`state_id`),
  CONSTRAINT `product_states_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_states_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=303 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_states`
--

LOCK TABLES `product_states` WRITE;
/*!40000 ALTER TABLE `product_states` DISABLE KEYS */;
INSERT INTO `product_states` VALUES (1,3,1,1.40,2.80,'0983218903712','2024-11-08 09:42:34','2024-11-29 14:58:11'),(7,3,4,0.70,1.40,'0983218903711','2024-11-12 09:08:33','2024-11-29 14:58:11'),(8,6,1,1.60,3.20,NULL,'2024-11-12 09:09:46','2024-11-26 11:18:33'),(9,6,4,0.80,1.60,NULL,'2024-11-12 09:09:46','2024-11-26 11:18:33'),(10,3,7,0.00,0.00,NULL,'2024-11-12 09:17:49','2024-11-29 14:58:11'),(11,6,7,0.00,0.00,NULL,'2024-11-12 09:17:58','2024-11-26 11:18:33'),(12,7,1,1.60,3.20,NULL,'2024-11-26 11:08:29','2024-11-26 11:08:29'),(13,7,4,0.80,1.60,NULL,'2024-11-26 11:08:29','2024-11-26 11:08:29'),(14,7,7,0.00,0.00,NULL,'2024-11-26 11:08:29','2024-11-26 11:08:29'),(18,9,1,1.00,2.00,NULL,'2024-11-26 11:09:43','2024-11-26 11:09:43'),(19,9,4,0.50,1.00,NULL,'2024-11-26 11:09:43','2024-11-26 11:09:43'),(20,9,7,0.00,0.00,NULL,'2024-11-26 11:09:43','2024-11-26 11:09:43'),(21,10,1,1.00,2.00,NULL,'2024-11-26 11:10:33','2024-11-26 11:10:33'),(22,10,4,0.50,1.00,NULL,'2024-11-26 11:10:33','2024-11-26 11:10:33'),(23,10,7,0.00,0.00,NULL,'2024-11-26 11:10:33','2024-11-26 11:10:33'),(24,11,1,4.50,9.00,NULL,'2024-11-26 11:16:04','2024-11-26 11:16:04'),(25,11,4,2.25,4.50,NULL,'2024-11-26 11:16:04','2024-11-26 11:16:04'),(26,11,7,0.00,0.00,NULL,'2024-11-26 11:16:04','2024-11-26 11:16:04'),(27,12,1,2.10,4.20,NULL,'2024-11-26 11:16:47','2024-11-26 11:16:47'),(28,12,4,1.05,2.10,NULL,'2024-11-26 11:16:47','2024-11-26 11:16:47'),(29,12,7,0.00,0.00,NULL,'2024-11-26 11:16:47','2024-11-26 11:16:47'),(30,13,1,6.30,12.60,NULL,'2024-11-26 11:17:39','2024-11-26 11:17:39'),(31,13,4,3.15,6.30,NULL,'2024-11-26 11:17:39','2024-11-26 11:17:39'),(32,13,7,0.00,0.00,NULL,'2024-11-26 11:17:39','2024-11-26 11:17:39'),(33,14,1,3.30,6.60,NULL,'2024-11-26 11:19:38','2024-11-26 11:19:38'),(34,14,4,1.15,3.30,NULL,'2024-11-26 11:19:38','2024-11-26 11:19:38'),(35,14,7,0.00,0.00,NULL,'2024-11-26 11:19:38','2024-11-26 11:19:38'),(36,15,1,1.00,2.00,NULL,'2024-11-26 11:20:08','2024-11-26 11:20:08'),(37,15,4,0.50,1.00,NULL,'2024-11-26 11:20:08','2024-11-26 11:20:08'),(38,15,7,0.00,0.00,NULL,'2024-11-26 11:20:08','2024-11-26 11:20:08'),(39,16,1,1.00,2.00,NULL,'2024-11-26 11:21:35','2024-11-26 11:22:58'),(40,16,4,0.50,1.00,NULL,'2024-11-26 11:21:35','2024-11-26 11:22:58'),(41,16,7,0.00,0.00,NULL,'2024-11-26 11:21:35','2024-11-26 11:22:58'),(42,17,1,1.00,2.00,NULL,'2024-11-26 11:21:54','2024-11-26 11:21:54'),(43,17,4,0.50,1.00,NULL,'2024-11-26 11:21:54','2024-11-26 11:21:54'),(44,17,7,0.00,0.00,NULL,'2024-11-26 11:21:54','2024-11-26 11:21:54'),(45,18,1,1.00,2.00,NULL,'2024-11-26 11:22:37','2024-11-26 11:22:37'),(46,18,4,0.50,1.00,NULL,'2024-11-26 11:22:37','2024-11-26 11:22:37'),(47,18,7,0.00,0.00,NULL,'2024-11-26 11:22:37','2024-11-26 11:22:37'),(48,19,1,3.30,6.60,NULL,'2024-11-26 11:23:41','2024-11-26 11:23:41'),(49,19,4,1.65,3.30,NULL,'2024-11-26 11:23:41','2024-11-26 11:23:41'),(50,19,7,0.00,0.00,NULL,'2024-11-26 11:23:41','2024-11-26 11:23:41'),(51,20,1,2.40,4.80,NULL,'2024-11-26 11:24:11','2024-11-26 11:24:11'),(52,20,4,1.20,2.40,NULL,'2024-11-26 11:24:11','2024-11-26 11:24:11'),(53,20,7,0.00,0.00,NULL,'2024-11-26 11:24:11','2024-11-26 11:24:11'),(54,21,1,4.40,8.80,NULL,'2024-11-26 11:25:18','2024-11-26 11:25:18'),(55,21,4,2.20,4.40,NULL,'2024-11-26 11:25:18','2024-11-26 11:25:18'),(56,21,7,0.00,0.00,NULL,'2024-11-26 11:25:18','2024-11-26 11:25:18'),(57,22,1,4.40,8.80,NULL,'2024-11-26 11:25:44','2024-11-26 11:25:44'),(58,22,4,2.20,4.40,NULL,'2024-11-26 11:25:44','2024-11-26 11:25:44'),(59,22,7,0.00,0.00,NULL,'2024-11-26 11:25:44','2024-11-26 11:25:44'),(60,23,1,2.40,4.80,NULL,'2024-11-26 11:26:21','2024-11-26 11:26:21'),(61,23,4,1.20,2.40,NULL,'2024-11-26 11:26:21','2024-11-26 11:26:21'),(62,23,7,0.00,0.00,NULL,'2024-11-26 11:26:21','2024-11-26 11:26:21'),(63,24,1,10.00,20.00,NULL,'2024-11-26 11:27:17','2024-11-26 11:27:17'),(64,24,4,5.00,10.00,NULL,'2024-11-26 11:27:17','2024-11-26 11:27:17'),(65,24,7,0.00,0.00,NULL,'2024-11-26 11:27:17','2024-11-26 11:27:17'),(66,25,1,7.50,15.00,NULL,'2024-11-26 11:27:59','2024-11-26 11:27:59'),(67,25,4,3.75,7.50,NULL,'2024-11-26 11:27:59','2024-11-26 11:27:59'),(68,25,7,0.00,0.00,NULL,'2024-11-26 11:27:59','2024-11-26 11:27:59'),(69,26,1,10.00,20.00,NULL,'2024-11-26 11:28:23','2024-11-26 11:28:23'),(70,26,4,5.00,10.00,NULL,'2024-11-26 11:28:23','2024-11-26 11:28:23'),(71,26,7,0.00,0.00,NULL,'2024-11-26 11:28:23','2024-11-26 11:28:23'),(72,27,1,7.50,15.00,NULL,'2024-11-26 11:28:55','2024-11-26 11:28:55'),(73,27,4,3.75,7.50,NULL,'2024-11-26 11:28:55','2024-11-26 11:28:55'),(74,27,7,0.00,0.00,NULL,'2024-11-26 11:28:55','2024-11-26 11:28:55'),(75,28,1,10.00,20.00,NULL,'2024-11-26 11:29:20','2024-11-26 11:29:20'),(76,28,4,5.00,10.00,NULL,'2024-11-26 11:29:20','2024-11-26 11:29:20'),(77,28,7,0.00,0.00,NULL,'2024-11-26 11:29:20','2024-11-26 11:29:20'),(78,29,1,6.00,12.00,NULL,'2024-11-26 11:29:44','2024-11-26 11:29:44'),(79,29,4,3.00,6.00,NULL,'2024-11-26 11:29:44','2024-11-26 11:29:44'),(80,29,7,0.00,0.00,NULL,'2024-11-26 11:29:44','2024-11-26 11:29:44'),(81,30,1,5.10,10.20,NULL,'2024-11-26 11:30:33','2024-11-26 11:30:33'),(82,30,4,2.55,5.10,NULL,'2024-11-26 11:30:33','2024-11-26 11:30:33'),(83,30,7,0.00,0.00,NULL,'2024-11-26 11:30:33','2024-11-26 11:30:33'),(84,31,1,4.00,8.00,NULL,'2024-11-26 11:31:02','2024-11-26 11:31:02'),(85,31,4,2.00,4.00,NULL,'2024-11-26 11:31:02','2024-11-26 11:31:02'),(86,31,7,0.00,0.00,NULL,'2024-11-26 11:31:02','2024-11-26 11:31:02'),(87,32,1,5.00,10.00,NULL,'2024-11-26 11:31:28','2024-11-26 11:31:28'),(88,32,4,2.50,10.00,NULL,'2024-11-26 11:31:28','2024-11-26 11:31:28'),(89,32,7,0.00,0.00,NULL,'2024-11-26 11:31:28','2024-11-26 11:31:28'),(90,33,1,5.10,10.20,NULL,'2024-11-26 11:32:07','2024-11-26 11:32:07'),(91,33,4,2.55,5.10,NULL,'2024-11-26 11:32:07','2024-11-26 11:32:07'),(92,33,7,0.00,0.00,NULL,'2024-11-26 11:32:07','2024-11-26 11:32:07'),(93,34,1,20.00,40.00,NULL,'2024-11-26 11:32:54','2024-11-26 11:32:54'),(94,34,4,10.00,20.00,NULL,'2024-11-26 11:32:54','2024-11-26 11:32:54'),(95,34,7,0.00,0.00,NULL,'2024-11-26 11:32:54','2024-11-26 11:32:54'),(96,35,1,15.00,30.00,NULL,'2024-11-26 11:33:18','2024-11-26 11:33:18'),(97,35,4,7.50,15.00,NULL,'2024-11-26 11:33:18','2024-11-26 11:33:18'),(98,35,7,0.00,0.00,NULL,'2024-11-26 11:33:18','2024-11-26 11:33:18'),(99,36,1,20.00,40.00,NULL,'2024-11-26 11:33:57','2024-11-26 11:33:57'),(100,36,4,10.00,20.00,NULL,'2024-11-26 11:33:57','2024-11-26 11:33:57'),(101,36,7,0.00,0.00,NULL,'2024-11-26 11:33:57','2024-11-26 11:33:57'),(102,37,1,15.00,30.00,NULL,'2024-11-26 11:34:27','2024-11-26 11:34:27'),(103,37,4,7.50,15.00,NULL,'2024-11-26 11:34:27','2024-11-26 11:34:27'),(104,37,7,0.00,0.00,NULL,'2024-11-26 11:34:27','2024-11-26 11:34:27'),(105,38,1,20.00,40.00,NULL,'2024-11-26 11:34:48','2024-11-26 11:34:48'),(106,38,4,10.00,20.00,NULL,'2024-11-26 11:34:48','2024-11-26 11:34:48'),(107,38,7,0.00,0.00,NULL,'2024-11-26 11:34:48','2024-11-26 11:34:48'),(108,39,1,5.00,10.00,NULL,'2024-11-26 11:35:38','2024-11-26 11:35:38'),(109,39,4,2.50,5.00,NULL,'2024-11-26 11:35:38','2024-11-26 11:35:38'),(110,39,7,0.00,0.00,NULL,'2024-11-26 11:35:38','2024-11-26 11:35:38'),(111,40,1,4.00,8.00,NULL,'2024-11-26 11:35:59','2024-11-26 11:35:59'),(112,40,4,2.00,4.00,NULL,'2024-11-26 11:35:59','2024-11-26 11:35:59'),(113,40,7,0.00,0.00,NULL,'2024-11-26 11:35:59','2024-11-26 11:35:59'),(114,41,1,3.00,6.00,NULL,'2024-11-26 11:36:23','2024-11-26 11:36:23'),(115,41,4,1.50,3.00,NULL,'2024-11-26 11:36:23','2024-11-26 11:36:23'),(116,41,7,0.00,0.00,NULL,'2024-11-26 11:36:23','2024-11-26 11:36:23'),(117,42,1,4.00,8.00,NULL,'2024-11-26 11:36:54','2024-11-26 11:36:54'),(118,42,4,2.00,4.00,NULL,'2024-11-26 11:36:54','2024-11-26 11:36:54'),(119,42,7,0.00,0.00,NULL,'2024-11-26 11:36:54','2024-11-26 11:36:54'),(120,43,1,4.00,8.00,NULL,'2024-11-26 11:37:18','2024-11-26 11:37:18'),(121,43,4,2.00,4.00,NULL,'2024-11-26 11:37:18','2024-11-26 11:37:18'),(122,43,7,0.00,0.00,NULL,'2024-11-26 11:37:18','2024-11-26 11:37:18'),(123,44,1,15.00,30.00,NULL,'2024-11-26 11:37:42','2024-11-26 11:37:42'),(124,44,4,7.50,15.00,NULL,'2024-11-26 11:37:42','2024-11-26 11:37:42'),(125,44,7,0.00,0.00,NULL,'2024-11-26 11:37:42','2024-11-26 11:37:42'),(126,45,1,12.00,24.00,NULL,'2024-11-26 11:38:14','2024-11-26 11:38:14'),(127,45,4,6.00,12.00,NULL,'2024-11-26 11:38:14','2024-11-26 11:38:14'),(128,45,7,0.00,0.00,NULL,'2024-11-26 11:38:14','2024-11-26 11:38:14'),(129,46,1,15.00,30.00,NULL,'2024-11-26 11:38:45','2024-11-26 11:38:45'),(130,46,4,7.50,15.00,NULL,'2024-11-26 11:38:45','2024-11-26 11:38:45'),(131,46,7,0.00,0.00,NULL,'2024-11-26 11:38:45','2024-11-26 11:38:45'),(132,47,1,12.00,24.00,NULL,'2024-11-26 11:39:22','2024-11-26 11:39:22'),(133,47,4,6.00,12.00,NULL,'2024-11-26 11:39:22','2024-11-26 11:39:22'),(134,47,7,0.00,0.00,NULL,'2024-11-26 11:39:22','2024-11-26 11:39:22'),(135,48,1,15.00,30.00,NULL,'2024-11-26 11:39:45','2024-11-26 11:39:45'),(136,48,4,7.50,15.00,NULL,'2024-11-26 11:39:45','2024-11-26 11:39:45'),(137,48,7,0.00,0.00,NULL,'2024-11-26 11:39:45','2024-11-26 11:39:45'),(138,49,1,12.00,24.00,NULL,'2024-11-26 11:40:07','2024-11-26 11:40:07'),(139,49,4,6.00,12.00,NULL,'2024-11-26 11:40:07','2024-11-26 11:40:07'),(140,49,7,0.00,0.00,NULL,'2024-11-26 11:40:07','2024-11-26 11:40:07'),(141,50,1,12.00,24.00,NULL,'2024-11-26 11:40:40','2024-11-26 11:40:40'),(142,50,4,6.00,12.00,NULL,'2024-11-26 11:40:40','2024-11-26 11:40:40'),(143,50,7,0.00,0.00,NULL,'2024-11-26 11:40:40','2024-11-26 11:40:40'),(144,51,1,12.00,24.00,NULL,'2024-11-26 11:40:57','2024-11-26 11:40:57'),(145,51,4,6.00,12.00,NULL,'2024-11-26 11:40:57','2024-11-26 11:40:57'),(146,51,7,0.00,0.00,NULL,'2024-11-26 11:40:57','2024-11-26 11:40:57'),(147,52,1,9.00,18.00,NULL,'2024-11-26 11:41:22','2024-11-26 11:41:22'),(148,52,4,4.50,9.00,NULL,'2024-11-26 11:41:22','2024-11-26 11:41:22'),(149,52,7,0.00,0.00,NULL,'2024-11-26 11:41:22','2024-11-26 11:41:22'),(150,53,1,12.00,24.00,NULL,'2024-11-26 11:41:43','2024-11-26 11:41:43'),(151,53,4,6.00,12.00,NULL,'2024-11-26 11:41:43','2024-11-26 11:41:43'),(152,53,7,0.00,0.00,NULL,'2024-11-26 11:41:43','2024-11-26 11:41:43'),(153,54,1,7.20,14.40,NULL,'2024-11-26 11:42:25','2024-11-26 11:42:25'),(154,54,4,3.60,7.20,NULL,'2024-11-26 11:42:25','2024-11-26 11:42:25'),(155,54,7,0.00,0.00,NULL,'2024-11-26 11:42:25','2024-11-26 11:42:25'),(156,55,1,3.30,6.60,NULL,'2024-11-26 11:43:04','2024-11-26 11:43:04'),(157,55,4,1.65,3.30,NULL,'2024-11-26 11:43:04','2024-11-26 11:43:04'),(158,55,7,0.00,0.00,NULL,'2024-11-26 11:43:04','2024-11-26 11:43:04'),(159,56,1,7.00,14.00,NULL,'2024-11-26 11:43:27','2024-11-26 11:43:27'),(160,56,4,3.50,7.00,NULL,'2024-11-26 11:43:27','2024-11-26 11:43:27'),(161,56,7,0.00,0.00,NULL,'2024-11-26 11:43:27','2024-11-26 11:43:27'),(162,57,1,4.70,9.40,NULL,'2024-11-26 11:44:20','2024-11-26 11:44:20'),(163,57,4,2.35,4.70,NULL,'2024-11-26 11:44:20','2024-11-26 11:44:20'),(164,57,7,0.00,0.00,NULL,'2024-11-26 11:44:20','2024-11-26 11:44:20'),(165,58,1,5.60,11.20,NULL,'2024-11-26 11:45:17','2024-11-26 11:45:17'),(166,58,4,2.80,5.60,NULL,'2024-11-26 11:45:17','2024-11-26 11:45:17'),(167,58,7,0.00,0.00,NULL,'2024-11-26 11:45:17','2024-11-26 11:45:17'),(168,59,1,8.20,16.40,NULL,'2024-11-26 11:45:53','2024-11-26 11:45:53'),(169,59,4,4.10,8.20,NULL,'2024-11-26 11:45:53','2024-11-26 11:45:53'),(170,59,7,0.00,0.00,NULL,'2024-11-26 11:45:53','2024-11-26 11:45:53'),(171,60,1,6.80,13.60,NULL,'2024-11-26 11:46:27','2024-11-26 11:46:27'),(172,60,4,3.40,6.80,NULL,'2024-11-26 11:46:27','2024-11-26 11:46:27'),(173,60,7,0.00,0.00,NULL,'2024-11-26 11:46:27','2024-11-26 11:46:27'),(174,61,1,3.30,6.60,NULL,'2024-11-26 11:47:01','2024-11-26 11:47:01'),(175,61,4,1.65,3.30,NULL,'2024-11-26 11:47:01','2024-11-26 11:47:01'),(176,61,7,0.00,0.00,NULL,'2024-11-26 11:47:01','2024-11-26 11:47:01'),(177,62,1,5.50,11.00,NULL,'2024-11-26 11:47:30','2024-11-26 11:47:30'),(178,62,4,2.75,5.50,NULL,'2024-11-26 11:47:30','2024-11-26 11:47:30'),(179,62,7,0.00,0.00,NULL,'2024-11-26 11:47:30','2024-11-26 11:47:30'),(180,63,1,6.80,13.60,NULL,'2024-11-26 11:48:15','2024-11-26 11:48:15'),(181,63,4,3.40,6.80,NULL,'2024-11-26 11:48:15','2024-11-26 11:48:15'),(182,63,7,0.00,0.00,NULL,'2024-11-26 11:48:15','2024-11-26 11:48:15'),(183,64,1,18.30,36.60,NULL,'2024-11-26 11:48:49','2024-11-26 11:48:49'),(184,64,4,9.15,18.30,NULL,'2024-11-26 11:48:49','2024-11-26 11:48:49'),(185,64,7,0.00,0.00,NULL,'2024-11-26 11:48:49','2024-11-26 11:48:49'),(186,65,1,11.80,23.60,NULL,'2024-11-26 11:49:22','2024-11-26 11:49:22'),(187,65,4,5.90,11.80,NULL,'2024-11-26 11:49:22','2024-11-26 11:49:22'),(188,65,7,0.00,0.00,NULL,'2024-11-26 11:49:22','2024-11-26 11:49:22'),(189,66,1,17.80,35.60,NULL,'2024-11-26 11:50:06','2024-11-26 11:50:06'),(190,66,4,8.90,17.80,NULL,'2024-11-26 11:50:06','2024-11-26 11:50:06'),(191,66,7,0.00,0.00,NULL,'2024-11-26 11:50:06','2024-11-26 11:50:06'),(192,67,1,12.00,24.00,NULL,'2024-11-26 11:54:40','2024-11-26 11:54:40'),(193,67,4,6.00,12.00,NULL,'2024-11-26 11:54:40','2024-11-26 11:54:40'),(194,67,7,0.00,0.00,NULL,'2024-11-26 11:54:40','2024-11-26 11:54:40'),(195,68,1,12.30,24.60,NULL,'2024-11-26 11:55:17','2024-11-26 11:55:17'),(196,68,4,6.15,12.30,NULL,'2024-11-26 11:55:18','2024-11-26 11:55:18'),(197,68,7,0.00,0.00,NULL,'2024-11-26 11:55:18','2024-11-26 11:55:18'),(198,69,1,15.00,30.00,NULL,'2024-11-26 11:56:02','2024-11-26 11:56:02'),(199,69,4,7.50,15.00,NULL,'2024-11-26 11:56:02','2024-11-26 11:56:02'),(200,69,7,0.00,0.00,NULL,'2024-11-26 11:56:02','2024-11-26 11:56:02'),(201,70,1,10.00,20.00,NULL,'2024-11-26 11:56:20','2024-11-26 11:56:20'),(202,70,4,5.00,10.00,NULL,'2024-11-26 11:56:20','2024-11-26 11:56:20'),(203,70,7,0.00,0.00,NULL,'2024-11-26 11:56:20','2024-11-26 11:56:20'),(204,71,1,8.00,16.00,NULL,'2024-11-26 11:56:37','2024-11-26 11:56:37'),(205,71,4,4.00,8.00,NULL,'2024-11-26 11:56:37','2024-11-26 11:56:37'),(206,71,7,0.00,0.00,NULL,'2024-11-26 11:56:37','2024-11-26 11:56:37'),(207,72,1,10.00,20.00,NULL,'2024-11-26 11:56:57','2024-11-26 11:56:57'),(208,72,4,5.00,10.00,NULL,'2024-11-26 11:56:57','2024-11-26 11:56:57'),(209,72,7,0.00,0.00,NULL,'2024-11-26 11:56:57','2024-11-26 11:56:57'),(210,73,1,15.00,30.00,NULL,'2024-11-26 11:57:31','2024-11-26 11:57:31'),(211,73,4,7.50,15.00,NULL,'2024-11-26 11:57:31','2024-11-26 11:57:31'),(212,73,7,0.00,0.00,NULL,'2024-11-26 11:57:31','2024-11-26 11:57:31'),(213,74,1,40.00,80.00,NULL,'2024-11-26 11:57:57','2024-11-26 11:57:57'),(214,74,4,20.00,40.00,NULL,'2024-11-26 11:57:57','2024-11-26 11:57:57'),(215,74,7,0.00,0.00,NULL,'2024-11-26 11:57:57','2024-11-26 11:57:57'),(216,75,1,30.00,60.00,NULL,'2024-11-26 11:58:18','2024-11-26 11:58:18'),(217,75,4,15.00,30.00,NULL,'2024-11-26 11:58:18','2024-11-26 11:58:18'),(218,75,7,0.00,0.00,NULL,'2024-11-26 11:58:18','2024-11-26 11:58:18'),(219,76,1,30.00,60.00,NULL,'2024-11-26 11:58:38','2024-11-26 11:58:38'),(220,76,4,15.00,30.00,NULL,'2024-11-26 11:58:38','2024-11-26 11:58:38'),(221,76,7,0.00,0.00,NULL,'2024-11-26 11:58:38','2024-11-26 11:58:38'),(222,77,1,20.00,40.00,NULL,'2024-11-26 11:58:58','2024-11-26 11:58:58'),(223,77,4,10.00,20.00,NULL,'2024-11-26 11:58:58','2024-11-26 11:58:58'),(224,77,7,0.00,0.00,NULL,'2024-11-26 11:58:58','2024-11-26 11:58:58'),(225,78,1,40.00,80.00,NULL,'2024-11-26 11:59:30','2024-11-26 11:59:30'),(226,78,4,20.00,40.00,NULL,'2024-11-26 11:59:30','2024-11-26 11:59:30'),(227,78,7,0.00,0.00,NULL,'2024-11-26 11:59:30','2024-11-26 11:59:30'),(228,79,1,1.66,3.32,NULL,'2024-11-26 12:00:17','2024-11-26 12:00:17'),(229,79,4,0.83,1.66,NULL,'2024-11-26 12:00:17','2024-11-26 12:00:17'),(230,79,7,0.00,0.00,NULL,'2024-11-26 12:00:17','2024-11-26 12:00:17'),(231,80,1,1.88,3.76,NULL,'2024-11-26 12:00:52','2024-11-26 12:00:52'),(232,80,4,0.94,1.88,NULL,'2024-11-26 12:00:52','2024-11-26 12:00:52'),(233,80,7,0.00,0.00,NULL,'2024-11-26 12:00:52','2024-11-26 12:00:52'),(234,81,1,0.80,1.60,NULL,'2024-11-26 12:01:15','2024-11-26 12:01:15'),(235,81,4,0.40,0.80,NULL,'2024-11-26 12:01:15','2024-11-26 12:01:15'),(236,81,7,0.00,0.00,NULL,'2024-11-26 12:01:15','2024-11-26 12:01:15'),(237,82,1,5.60,11.20,NULL,'2024-11-26 12:03:10','2024-11-26 12:03:10'),(238,82,4,2.80,5.60,NULL,'2024-11-26 12:03:10','2024-11-26 12:03:10'),(239,82,7,0.00,0.00,NULL,'2024-11-26 12:03:10','2024-11-26 12:03:10'),(240,83,1,2.10,4.20,NULL,'2024-11-26 12:03:51','2024-11-26 12:03:51'),(241,83,4,1.05,2.10,NULL,'2024-11-26 12:03:51','2024-11-26 12:03:51'),(242,83,7,0.00,0.00,NULL,'2024-11-26 12:03:51','2024-11-26 12:03:51'),(243,84,1,5.20,10.40,NULL,'2024-11-26 12:04:49','2024-11-26 12:04:49'),(244,84,4,2.60,5.20,NULL,'2024-11-26 12:04:49','2024-11-26 12:04:49'),(245,84,7,0.00,0.00,NULL,'2024-11-26 12:04:49','2024-11-26 12:04:49'),(246,85,1,3.18,6.36,NULL,'2024-11-26 12:05:47','2024-11-26 12:05:47'),(247,85,4,1.59,3.18,NULL,'2024-11-26 12:05:47','2024-11-26 12:05:47'),(248,85,7,0.00,0.00,NULL,'2024-11-26 12:05:47','2024-11-26 12:05:47'),(249,86,1,5.40,10.80,NULL,'2024-11-26 12:06:27','2024-11-26 12:06:27'),(250,86,4,2.70,5.40,NULL,'2024-11-26 12:06:27','2024-11-26 12:06:27'),(251,86,7,0.00,0.00,NULL,'2024-11-26 12:06:27','2024-11-26 12:06:27'),(252,87,1,7.50,15.00,NULL,'2024-11-26 12:07:07','2024-11-26 12:07:07'),(253,87,4,3.75,7.50,NULL,'2024-11-26 12:07:07','2024-11-26 12:07:07'),(254,87,7,0.00,0.00,NULL,'2024-11-26 12:07:07','2024-11-26 12:07:07'),(255,88,1,5.60,11.20,NULL,'2024-11-26 12:07:40','2024-11-26 12:07:40'),(256,88,4,2.80,5.60,NULL,'2024-11-26 12:07:40','2024-11-26 12:07:40'),(257,88,7,0.00,0.00,NULL,'2024-11-26 12:07:40','2024-11-26 12:07:40'),(258,89,1,8.70,17.40,NULL,'2024-11-26 12:08:59','2024-11-26 12:08:59'),(259,89,4,4.35,8.70,NULL,'2024-11-26 12:08:59','2024-11-26 12:08:59'),(260,89,7,0.00,0.00,NULL,'2024-11-26 12:08:59','2024-11-26 12:08:59'),(261,90,1,6.20,12.40,NULL,'2024-11-26 12:09:40','2024-11-26 12:09:40'),(262,90,4,3.10,6.20,NULL,'2024-11-26 12:09:40','2024-11-26 12:09:40'),(263,90,7,0.00,0.00,NULL,'2024-11-26 12:09:40','2024-11-26 12:09:40'),(264,91,1,7.90,15.80,NULL,'2024-11-26 12:10:20','2024-11-26 12:10:20'),(265,91,4,3.95,7.90,NULL,'2024-11-26 12:10:20','2024-11-26 12:10:20'),(266,91,7,0.00,0.00,NULL,'2024-11-26 12:10:20','2024-11-26 12:10:20'),(267,92,1,3.60,7.20,NULL,'2024-11-26 12:10:54','2024-11-26 12:10:54'),(268,92,4,1.80,3.60,NULL,'2024-11-26 12:10:54','2024-11-26 12:10:54'),(269,92,7,0.00,0.00,NULL,'2024-11-26 12:10:54','2024-11-26 12:10:54'),(270,93,1,2.40,4.80,NULL,'2024-11-26 12:11:19','2024-11-26 12:11:19'),(271,93,4,1.20,2.40,NULL,'2024-11-26 12:11:19','2024-11-26 12:11:19'),(272,93,7,0.00,0.00,NULL,'2024-11-26 12:11:19','2024-11-26 12:11:19'),(273,94,1,1.15,2.30,NULL,'2024-11-26 12:11:51','2024-11-26 12:11:51'),(274,94,4,0.58,1.15,NULL,'2024-11-26 12:11:51','2024-11-26 12:11:51'),(275,94,7,0.00,0.00,NULL,'2024-11-26 12:11:51','2024-11-26 12:11:51'),(276,95,1,2.10,4.20,NULL,'2024-11-26 12:12:18','2024-11-26 12:12:18'),(277,95,4,1.05,2.10,NULL,'2024-11-26 12:12:18','2024-11-26 12:12:18'),(278,95,7,0.00,0.00,NULL,'2024-11-26 12:12:18','2024-11-26 12:12:18'),(279,96,1,2.40,4.80,NULL,'2024-11-26 12:12:50','2024-11-26 12:12:50'),(280,96,4,1.20,2.40,NULL,'2024-11-26 12:12:50','2024-11-26 12:12:50'),(281,96,7,0.00,0.00,NULL,'2024-11-26 12:12:50','2024-11-26 12:12:50'),(282,97,1,20.90,41.80,NULL,'2024-11-26 12:13:47','2024-11-26 12:13:47'),(283,97,4,10.45,20.90,NULL,'2024-11-26 12:13:47','2024-11-26 12:13:47'),(284,97,7,0.00,0.00,NULL,'2024-11-26 12:13:47','2024-11-26 12:13:47'),(285,98,1,10.40,20.80,NULL,'2024-11-26 12:14:14','2024-11-26 12:14:14'),(286,98,4,5.20,10.40,NULL,'2024-11-26 12:14:14','2024-11-26 12:14:14'),(287,98,7,0.00,0.00,NULL,'2024-11-26 12:14:14','2024-11-26 12:14:14'),(288,99,1,14.70,29.40,NULL,'2024-11-26 12:14:49','2024-11-26 12:14:49'),(289,99,4,7.35,14.70,NULL,'2024-11-26 12:14:49','2024-11-26 12:14:49'),(290,99,7,0.00,0.00,NULL,'2024-11-26 12:14:49','2024-11-26 12:14:49'),(291,100,1,19.20,38.40,NULL,'2024-11-26 12:15:17','2024-11-26 12:15:17'),(292,100,4,9.60,19.20,NULL,'2024-11-26 12:15:17','2024-11-26 12:15:17'),(293,100,7,0.00,0.00,NULL,'2024-11-26 12:15:17','2024-11-26 12:15:17'),(294,101,1,9.60,19.20,NULL,'2024-11-26 12:15:42','2024-11-26 12:15:42'),(295,101,4,4.80,9.60,NULL,'2024-11-26 12:15:42','2024-11-26 12:15:42'),(296,101,7,0.00,0.00,NULL,'2024-11-26 12:15:42','2024-11-26 12:15:42'),(297,102,8,25.00,30.00,NULL,'2024-12-05 08:44:21','2024-12-05 09:48:20'),(298,102,9,15.00,18.00,NULL,'2024-12-05 08:44:21','2024-12-05 09:48:20'),(299,102,10,0.00,0.00,NULL,'2024-12-05 08:44:21','2024-12-05 09:48:20'),(300,103,8,27.00,32.40,'NC','2024-12-05 09:49:21','2024-12-05 09:49:21'),(301,103,9,17.00,20.40,'NC','2024-12-05 09:49:21','2024-12-05 09:49:21'),(302,103,10,0.00,0.00,'NC','2024-12-05 09:49:21','2024-12-05 09:49:21');
/*!40000 ALTER TABLE `product_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint unsigned NOT NULL,
  `type_id` bigint unsigned NOT NULL,
  `account_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_type_id_foreign` (`type_id`),
  KEY `products_account_id_foreign` (`account_id`),
  CONSTRAINT `products_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (3,1,3,1,'2024-11-08 09:42:34','2024-11-08 09:42:34'),(6,14,1,1,'2024-11-12 09:09:46','2024-11-12 09:09:46'),(7,6,1,1,'2024-11-26 11:08:29','2024-11-26 11:08:29'),(9,9,1,1,'2024-11-26 11:09:43','2024-11-26 11:09:43'),(10,10,1,1,'2024-11-26 11:10:33','2024-11-26 11:10:33'),(11,11,1,1,'2024-11-26 11:16:04','2024-11-26 11:16:04'),(12,12,1,1,'2024-11-26 11:16:47','2024-11-26 11:16:47'),(13,5,1,1,'2024-11-26 11:17:39','2024-11-26 11:17:39'),(14,13,1,1,'2024-11-26 11:19:38','2024-11-26 11:19:38'),(15,6,3,1,'2024-11-26 11:20:08','2024-11-26 11:20:08'),(16,7,3,1,'2024-11-26 11:21:35','2024-11-26 11:22:58'),(17,9,3,1,'2024-11-26 11:21:54','2024-11-26 11:21:54'),(18,10,3,1,'2024-11-26 11:22:37','2024-11-26 11:22:37'),(19,11,3,1,'2024-11-26 11:23:41','2024-11-26 11:23:41'),(20,12,3,1,'2024-11-26 11:24:11','2024-11-26 11:24:11'),(21,5,3,1,'2024-11-26 11:25:18','2024-11-26 11:25:18'),(22,14,3,1,'2024-11-26 11:25:44','2024-11-26 11:25:44'),(23,13,3,1,'2024-11-26 11:26:21','2024-11-26 11:26:21'),(24,11,4,1,'2024-11-26 11:27:17','2024-11-26 11:27:17'),(25,12,4,1,'2024-11-26 11:27:59','2024-11-26 11:27:59'),(26,5,4,1,'2024-11-26 11:28:23','2024-11-26 11:28:23'),(27,14,4,1,'2024-11-26 11:28:55','2024-11-26 11:28:55'),(28,13,4,1,'2024-11-26 11:29:20','2024-11-26 11:29:20'),(29,1,5,1,'2024-11-26 11:29:44','2024-11-26 11:29:44'),(30,6,5,1,'2024-11-26 11:30:33','2024-11-26 11:30:33'),(31,7,5,1,'2024-11-26 11:31:02','2024-11-26 11:31:02'),(32,9,5,1,'2024-11-26 11:31:28','2024-11-26 11:31:28'),(33,10,5,1,'2024-11-26 11:32:07','2024-11-26 11:32:07'),(34,11,5,1,'2024-11-26 11:32:54','2024-11-26 11:32:54'),(35,12,5,1,'2024-11-26 11:33:18','2024-11-26 11:33:18'),(36,5,5,1,'2024-11-26 11:33:57','2024-11-26 11:33:57'),(37,14,5,1,'2024-11-26 11:34:27','2024-11-26 11:34:27'),(38,13,5,1,'2024-11-26 11:34:48','2024-11-26 11:34:48'),(39,1,6,1,'2024-11-26 11:35:38','2024-11-26 11:35:38'),(40,6,6,1,'2024-11-26 11:35:59','2024-11-26 11:35:59'),(41,7,6,1,'2024-11-26 11:36:23','2024-11-26 11:36:23'),(42,9,6,1,'2024-11-26 11:36:54','2024-11-26 11:36:54'),(43,10,6,1,'2024-11-26 11:37:18','2024-11-26 11:37:18'),(44,11,6,1,'2024-11-26 11:37:42','2024-11-26 11:37:42'),(45,12,6,1,'2024-11-26 11:38:14','2024-11-26 11:38:14'),(46,5,6,1,'2024-11-26 11:38:45','2024-11-26 11:38:45'),(47,14,6,1,'2024-11-26 11:39:22','2024-11-26 11:39:22'),(48,13,6,1,'2024-11-26 11:39:45','2024-11-26 11:39:45'),(49,11,7,1,'2024-11-26 11:40:07','2024-11-26 11:40:07'),(50,12,7,1,'2024-11-26 11:40:40','2024-11-26 11:40:40'),(51,5,7,1,'2024-11-26 11:40:57','2024-11-26 11:40:57'),(52,14,7,1,'2024-11-26 11:41:22','2024-11-26 11:41:22'),(53,13,7,1,'2024-11-26 11:41:43','2024-11-26 11:41:43'),(54,11,8,1,'2024-11-26 11:42:25','2024-11-26 11:42:25'),(55,12,8,1,'2024-11-26 11:43:04','2024-11-26 11:43:04'),(56,5,8,1,'2024-11-26 11:43:27','2024-11-26 11:43:27'),(57,14,8,1,'2024-11-26 11:44:20','2024-11-26 11:44:20'),(58,13,8,1,'2024-11-26 11:45:17','2024-11-26 11:45:17'),(59,1,9,1,'2024-11-26 11:45:53','2024-11-26 11:45:53'),(60,6,9,1,'2024-11-26 11:46:27','2024-11-26 11:46:27'),(61,7,9,1,'2024-11-26 11:47:01','2024-11-26 11:47:01'),(62,9,9,1,'2024-11-26 11:47:30','2024-11-26 11:47:30'),(63,10,9,1,'2024-11-26 11:48:15','2024-11-26 11:48:15'),(64,11,9,1,'2024-11-26 11:48:49','2024-11-26 11:48:49'),(65,12,9,1,'2024-11-26 11:49:22','2024-11-26 11:49:22'),(66,5,9,1,'2024-11-26 11:50:06','2024-11-26 11:50:06'),(67,14,9,1,'2024-11-26 11:54:40','2024-11-26 11:54:40'),(68,13,9,1,'2024-11-26 11:55:17','2024-11-26 11:55:17'),(69,1,10,1,'2024-11-26 11:56:02','2024-11-26 11:56:02'),(70,6,10,1,'2024-11-26 11:56:20','2024-11-26 11:56:20'),(71,7,10,1,'2024-11-26 11:56:37','2024-11-26 11:56:37'),(72,9,10,1,'2024-11-26 11:56:57','2024-11-26 11:56:57'),(73,10,10,1,'2024-11-26 11:57:31','2024-11-26 11:57:31'),(74,11,10,1,'2024-11-26 11:57:57','2024-11-26 11:57:57'),(75,12,10,1,'2024-11-26 11:58:18','2024-11-26 11:58:18'),(76,5,10,1,'2024-11-26 11:58:38','2024-11-26 11:58:38'),(77,14,10,1,'2024-11-26 11:58:58','2024-11-26 11:58:58'),(78,13,10,1,'2024-11-26 11:59:30','2024-11-26 11:59:30'),(79,1,11,1,'2024-11-26 12:00:17','2024-11-26 12:00:17'),(80,6,11,1,'2024-11-26 12:00:52','2024-11-26 12:00:52'),(81,9,11,1,'2024-11-26 12:01:15','2024-11-26 12:01:15'),(82,11,11,1,'2024-11-26 12:03:10','2024-11-26 12:03:10'),(83,12,11,1,'2024-11-26 12:03:51','2024-11-26 12:03:51'),(84,5,11,1,'2024-11-26 12:04:49','2024-11-26 12:04:49'),(85,14,11,1,'2024-11-26 12:05:47','2024-11-26 12:05:47'),(86,13,11,1,'2024-11-26 12:06:27','2024-11-26 12:06:27'),(87,11,12,1,'2024-11-26 12:07:07','2024-11-26 12:07:07'),(88,12,12,1,'2024-11-26 12:07:40','2024-11-26 12:07:40'),(89,5,12,1,'2024-11-26 12:08:59','2024-11-26 12:08:59'),(90,14,12,1,'2024-11-26 12:09:40','2024-11-26 12:09:40'),(91,13,12,1,'2024-11-26 12:10:20','2024-11-26 12:10:20'),(92,1,14,1,'2024-11-26 12:10:54','2024-11-26 12:10:54'),(93,6,14,1,'2024-11-26 12:11:19','2024-11-26 12:11:19'),(94,7,14,1,'2024-11-26 12:11:51','2024-11-26 12:11:51'),(95,9,14,1,'2024-11-26 12:12:18','2024-11-26 12:12:18'),(96,10,14,1,'2024-11-26 12:12:50','2024-11-26 12:12:50'),(97,11,14,1,'2024-11-26 12:13:47','2024-11-26 12:13:47'),(98,12,14,1,'2024-11-26 12:14:14','2024-11-26 12:14:14'),(99,5,14,1,'2024-11-26 12:14:49','2024-11-26 12:14:49'),(100,13,14,1,'2024-11-26 12:15:17','2024-11-26 12:15:17'),(101,15,14,1,'2024-11-26 12:15:42','2024-11-26 12:15:42'),(102,18,16,4,'2024-12-04 15:46:35','2024-12-04 15:46:35'),(103,18,17,4,'2024-12-05 09:49:21','2024-12-05 09:49:21');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (2,2,NULL,NULL),(1,1,NULL,NULL),(5,1,NULL,NULL),(5,2,NULL,NULL),(5,3,NULL,NULL),(6,3,NULL,NULL),(8,1,NULL,NULL),(10,2,NULL,NULL),(10,3,NULL,NULL),(11,1,NULL,NULL),(11,2,NULL,NULL),(11,3,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Encaissement','Permet la visualisation des tickets de remise client','2024-11-05 14:15:02','2024-11-05 14:15:02'),(2,'Reception','Permet, la visualisation des tarifs pour le client, l\'edition d\'un ticket de remise','2024-11-05 14:15:59','2024-11-05 14:15:59'),(3,'Administrateur','Gestion des produits et des utilisateurs','2024-11-05 14:17:17','2024-11-05 14:17:17');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('aMa9IVBIgnqKZJBwF3DEr3UDVJOMNCq0vX4plaLd',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','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',1733404128),('dkvfGE2pEyeAitfvISUndo2mepemWQyZYskuzjiW',4,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:133.0) Gecko/20100101 Firefox/133.0','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',1733404188);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `definition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `infos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `states_name_account_id_unique` (`name`,`account_id`),
  KEY `states_account_id_foreign` (`account_id`),
  CONSTRAINT `states_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'PARFAIT ETAT','Pas de trous, coutures ok, flocage ok, pas de délavage, pas de tâches, pas de bouloches.','Nous reprenons l\'article contre rétribution maximale',1,'2024-11-07 14:28:45','2024-12-05 08:25:51'),(4,'BON ETAT','petits trous ou défaut de coutures ou démodé.','Nous reprenons l\'article avec rétribution minorée',1,'2024-11-07 14:32:32','2024-12-05 08:26:28'),(7,'MAUVAIS','Trous, déchirure, aspect mauvais état','Nous reprenons l\'article, mais à but de recyclage uniquement, sans rétribution',1,'2024-11-12 09:17:33','2024-12-05 08:27:59'),(8,'PARFAIT ETAT','Verres: micro-rayures acceptées | Face: Micro-rayures acceptées, Visserie OK, Plaquettes OK | Branches: Micro-rayures acceptées, Ref apparentes','Reprise de l\'article avec rétribution maximale',4,'2024-12-05 08:36:44','2024-12-05 08:36:52'),(9,'BON ETAT','Verres: Rayures visibles | Face: Rayures d\'usures, Visserie non d\'origine, Plaquettes oxydées | Branches: Rayures visibles, Ref partielles','Nous reprenons l\'article avec rétribution minorée',4,'2024-12-05 08:38:38','2024-12-05 08:38:38'),(10,'IMPORTABLE','Verres: Eclats, Opacité des verres | Face: Cassée | Branches: Cassée ou manquante','Nous reprenons l\'article sans retribution à des fins de recyclage uniquement',4,'2024-12-05 08:40:28','2024-12-05 08:40:28');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets_reprise`
--

DROP TABLE IF EXISTS `tickets_reprise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets_reprise` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint unsigned DEFAULT NULL,
  `panier_id` bigint unsigned NOT NULL,
  `account_id` bigint unsigned NOT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_by_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deactivated_by` bigint unsigned DEFAULT NULL,
  `deactivated_by_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_utilisation` enum('bon_achat','remboursement','mixte','annule') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bon_achat',
  `deactivation_date` datetime DEFAULT NULL,
  `date_limite` datetime DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tickets_reprise_uuid_unique` (`uuid`),
  KEY `tickets_reprise_client_id_foreign` (`client_id`),
  KEY `tickets_reprise_panier_id_foreign` (`panier_id`),
  KEY `tickets_reprise_created_by_foreign` (`created_by`),
  KEY `tickets_reprise_deactivated_by_foreign` (`deactivated_by`),
  KEY `tickets_reprise_account_id_foreign` (`account_id`),
  CONSTRAINT `tickets_reprise_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tickets_reprise_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tickets_reprise_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tickets_reprise_deactivated_by_foreign` FOREIGN KEY (`deactivated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tickets_reprise_panier_id_foreign` FOREIGN KEY (`panier_id`) REFERENCES `paniers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets_reprise`
--

LOCK TABLES `tickets_reprise` WRITE;
/*!40000 ALTER TABLE `tickets_reprise` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets_reprise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `types_name_account_id_unique` (`name`,`account_id`),
  KEY `types_account_id_foreign` (`account_id`),
  CONSTRAINT `types_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'T-SHIRT & TOP','14',1,'2024-11-07 13:17:28','2024-11-21 11:15:01'),(3,'SHORT & BERMUDAS','13',1,'2024-11-07 13:21:10','2024-11-21 11:16:45'),(4,'T-SHIRT MANCHES LONGUES & PULL FIN','15',1,'2024-11-07 13:22:16','2024-11-21 11:17:41'),(5,'PULL - GILET - SWEAT','16',1,'2024-11-07 13:22:56','2024-11-21 11:18:01'),(6,'PANTALONS','17',1,'2024-11-07 13:23:26','2024-11-21 11:18:14'),(7,'JEANS','18',1,'2024-11-07 13:23:32','2024-11-21 11:18:24'),(8,'CHEMISES & BLOUSES','19',1,'2024-11-07 13:25:21','2024-11-21 11:18:36'),(9,'VESTES FINES','20',1,'2024-11-07 13:25:36','2024-11-21 11:18:46'),(10,'MANTEAUX','21',1,'2024-11-07 13:25:47','2024-11-21 11:19:00'),(11,'JUPES','22',1,'2024-11-07 13:25:54','2024-11-21 11:19:10'),(12,'ROBES','23',1,'2024-11-07 13:26:22','2024-11-21 11:19:21'),(14,'SACS','24',1,'2024-11-07 13:35:04','2024-11-21 11:19:56'),(16,'SOLAIRES SANS ETUI','27',4,'2024-12-04 15:46:09','2024-12-05 09:37:15'),(17,'SOLAIRES AVEC ETUI','28',4,'2024-12-05 09:37:35','2024-12-05 09:37:35');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_account_id_foreign` (`account_id`),
  CONSTRAINT `users_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jean','jean@mail.com',NULL,'$2y$12$K6iW0zOQQqVq.7lSO.j50.aywNHtS3hz18dDZyTRF/bABuO0F3maG',NULL,'2024-11-05 15:56:14','2024-11-07 10:56:24',1),(2,'Martine','martine@mail.com',NULL,'$2y$12$7gZPrJaGJ8e4eBzhB2AjLeiWPDdu1BCwIICq7yWmyUlRas6UwIzvW',NULL,'2024-11-05 16:04:21','2024-11-05 16:04:21',1),(5,'Brigitte','brigitte@mail.com',NULL,'$2y$12$6Jm0b3wdaZiSghh4Vay4ResvMQ8.NCCCuK9Kj3YFWqXBje0gl64eO',NULL,'2024-11-07 11:58:14','2024-11-07 11:58:14',1),(6,'admin1','admin@mail.com',NULL,'$2y$12$tepHuvXoB6aFfIXQQcqo/...QoknAnN0X9oAPREk9KLbL4B2xQ0yy',NULL,'2024-12-03 11:38:34','2024-12-03 11:38:34',4),(8,'test','test2@mail.com',NULL,'$2y$12$qwe4vw2y6fGzYaiHiNWcu.eCulPawGvc1shcsDeV5bCEnBAyUlBi2',NULL,'2024-12-03 16:13:30','2024-12-03 16:13:30',4),(10,'etienne','etienne@mail.com',NULL,'$2y$12$t0hQfiE5MdqZrDkCYszaCegksgW2.eLYRlfVl4tVV5Du3QG9HvPzG',NULL,'2024-12-03 16:14:33','2024-12-03 16:14:33',4),(11,'marc','marclilo@mail.com',NULL,'$2y$12$SBbhGl0GJc.otVEFLplr5OIJVwDWKiYKLcRY.w91z9Y0K3ZySPE8a',NULL,'2024-12-03 16:15:38','2024-12-03 16:15:38',4);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-05 13:12:26
