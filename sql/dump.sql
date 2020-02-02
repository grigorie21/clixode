-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.26-0ubuntu0.18.10.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             10.1.0.5490
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table clixode2.bucket_file
CREATE TABLE IF NOT EXISTS `bucket_file` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bucket_file_user_id_foreign` (`user_id`),
  CONSTRAINT `bucket_file_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table clixode2.bucket_file: ~5 rows (approximately)
/*!40000 ALTER TABLE `bucket_file` DISABLE KEYS */;
INSERT INTO `bucket_file` (`id`, `title`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'корзина 1', 1, '2020-01-05 20:08:13', NULL),
	(2, 'корзина 2', 1, '2020-01-05 20:08:13', NULL),
	(3, 'корзина 3', 1, '2020-01-05 20:08:13', NULL),
	(4, 'корзина 4', 1, '2020-01-05 20:08:13', NULL),
	(5, 'корзина 5', 1, '2020-01-05 20:08:13', NULL);
/*!40000 ALTER TABLE `bucket_file` ENABLE KEYS */;

-- Dumping structure for table clixode2.bucket_image
CREATE TABLE IF NOT EXISTS `bucket_image` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bucket_image_user_id_foreign` (`user_id`),
  CONSTRAINT `bucket_image_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table clixode2.bucket_image: ~0 rows (approximately)
/*!40000 ALTER TABLE `bucket_image` DISABLE KEYS */;
INSERT INTO `bucket_image` (`id`, `title`, `slug`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'wer', 'ewr', 1, '2020-01-06 17:26:11', NULL);
/*!40000 ALTER TABLE `bucket_image` ENABLE KEYS */;

-- Dumping structure for table clixode2.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table clixode2.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table clixode2.file
CREATE TABLE IF NOT EXISTS `file` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sha512` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table clixode2.file: ~0 rows (approximately)
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`id`, `name`, `sha512`, `slug`, `size`, `created_at`, `updated_at`) VALUES
	(1, '200kb.txt', 'e7023090ea87dbd121dbba8f225f7ba79d01468e65dabb238333b2d58780e881c34f413e79b79cbd285145b6d7721513e0cf91bfa47a755fa2df02e7dbcf9e17', '5e13910655227', 204976, '2020-01-06 19:56:54', '2020-01-06 19:56:54');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- Dumping structure for table clixode2.file_m2m_bucket
CREATE TABLE IF NOT EXISTS `file_m2m_bucket` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` bigint(20) unsigned NOT NULL,
  `bucket_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `file_m2m_bucket_file_id_foreign` (`file_id`),
  KEY `file_m2m_bucket_bucket_id_foreign` (`bucket_id`),
  CONSTRAINT `file_m2m_bucket_bucket_id_foreign` FOREIGN KEY (`bucket_id`) REFERENCES `bucket_file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `file_m2m_bucket_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table clixode2.file_m2m_bucket: ~0 rows (approximately)
/*!40000 ALTER TABLE `file_m2m_bucket` DISABLE KEYS */;
INSERT INTO `file_m2m_bucket` (`id`, `file_id`, `bucket_id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '5e13910655227', '2020-01-06 19:56:54', '2020-01-06 19:56:54');
/*!40000 ALTER TABLE `file_m2m_bucket` ENABLE KEYS */;

-- Dumping structure for table clixode2.http_download_task
CREATE TABLE IF NOT EXISTS `http_download_task` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_http_download_task_status_id` int(10) unsigned NOT NULL,
  `bucket_id` bigint(20) unsigned NOT NULL,
  `progress` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `http_download_task_ref_http_download_task_status_id_foreign` (`ref_http_download_task_status_id`),
  KEY `http_download_task_bucket_id_foreign` (`bucket_id`),
  CONSTRAINT `http_download_task_bucket_id_foreign` FOREIGN KEY (`bucket_id`) REFERENCES `bucket_file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `http_download_task_ref_http_download_task_status_id_foreign` FOREIGN KEY (`ref_http_download_task_status_id`) REFERENCES `ref_http_download_task_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table clixode2.http_download_task: ~2 rows (approximately)
/*!40000 ALTER TABLE `http_download_task` DISABLE KEYS */;
INSERT INTO `http_download_task` (`id`, `url`, `ref_http_download_task_status_id`, `bucket_id`, `progress`, `created_at`, `updated_at`) VALUES
	(1, 'https://speed.hetzner.de/1GB.bin', 1, 1, 63.46, '2020-01-06 19:55:49', '2020-01-06 19:58:59'),
	(2, 'https://rantcell.com/200kb.txt', 10, 1, 100.00, '2020-01-06 19:56:52', '2020-01-06 19:56:54');
/*!40000 ALTER TABLE `http_download_task` ENABLE KEYS */;

-- Dumping structure for table clixode2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table clixode2.migrations: ~9 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(55, '0000_01_01_100000_create_failed_jobs_table', 1),
	(56, '0000_01_01_100100_create_password_resets_table', 1),
	(57, '1100_01_01_100000_create_ref_http_download_task_status_table', 1),
	(58, '1200_01_01_100000_create_user_table', 1),
	(59, '1200_01_01_100100_create_file_table', 1),
	(60, '1200_01_01_100200_create_bucket_file_table', 1),
	(61, '1200_01_01_100300_create_bucket_image_table', 1),
	(62, '1200_01_01_100400_create_http_download_task_table', 1),
	(63, '1300_01_01_100000_create_file_m2m_bucket', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table clixode2.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table clixode2.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table clixode2.ref_http_download_task_status
CREATE TABLE IF NOT EXISTS `ref_http_download_task_status` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `ref_http_download_task_status_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table clixode2.ref_http_download_task_status: ~2 rows (approximately)
/*!40000 ALTER TABLE `ref_http_download_task_status` DISABLE KEYS */;
INSERT INTO `ref_http_download_task_status` (`id`, `title`) VALUES
	(1, 'Новая задача'),
	(10, 'Завершенная задача');
/*!40000 ALTER TABLE `ref_http_download_task_status` ENABLE KEYS */;

-- Dumping structure for table clixode2.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table clixode2.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `password`, `role`) VALUES
	(1, 'admin@admin.admin', '$2y$12$9E.Vf7KTlt5AcdzZ6DjmSe6P.dWGzSy.Dsp4s9Eo5XZTA7SGQ4g8W', 'admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
