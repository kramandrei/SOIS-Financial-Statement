-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table thesis.expenses
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table thesis.expenses: ~2 rows (approximately)
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` (`id`, `name`, `isActive`, `created_at`, `updated_at`) VALUES
	(1, 'Sample', 0, '2022-02-02 07:16:47', '2022-02-02 07:16:47'),
	(2, 'Test', 1, '2022-02-02 07:16:53', '2022-02-02 07:17:03'),
	(3, 'Nice', 0, '2022-02-02 07:16:59', '2022-02-02 07:16:59'),
	(4, 'Event', 0, '2022-02-09 02:35:39', '2022-02-09 02:35:39');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;

-- Dumping structure for table thesis.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table thesis.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table thesis.incomes
CREATE TABLE IF NOT EXISTS `incomes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `isActive` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table thesis.incomes: ~4 rows (approximately)
/*!40000 ALTER TABLE `incomes` DISABLE KEYS */;
INSERT INTO `incomes` (`id`, `name`, `user_id`, `isActive`, `created_at`, `updated_at`) VALUES
	(1, 'Sample', 0, 0, '2022-02-02 00:23:19', '2022-02-02 01:48:24'),
	(2, 'test', 0, 0, '2022-02-02 00:26:51', '2022-02-02 01:51:04'),
	(3, 'Weekly Contributions', 0, 0, '2022-02-09 02:34:43', '2022-02-09 02:34:43'),
	(4, 'tester', 0, 1, '2022-02-09 02:34:58', '2022-02-09 02:35:05');
/*!40000 ALTER TABLE `incomes` ENABLE KEYS */;

-- Dumping structure for table thesis.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table thesis.migrations: ~6 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2019_08_19_000000_create_failed_jobs_table', 1),
	(3, '2022_02_02_000632_create_incomes_table', 1),
	(4, '2022_02_02_010049_create_roles_table', 2),
	(5, '2022_02_02_012417_create_organizations_table', 3),
	(6, '2022_02_02_070800_create_expenses_table', 4),
	(7, '2022_02_02_072232_create_org_incomes_table', 5),
	(8, '2022_02_05_024608_create_org_expenses_table', 6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table thesis.organizations
CREATE TABLE IF NOT EXISTS `organizations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table thesis.organizations: ~0 rows (approximately)
/*!40000 ALTER TABLE `organizations` DISABLE KEYS */;
/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;

-- Dumping structure for table thesis.org_expenses
CREATE TABLE IF NOT EXISTS `org_expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `org_id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `invoice_or` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `receipt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isApproved` int(11) DEFAULT NULL,
  `approvedBy` int(11) DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table thesis.org_expenses: ~1 rows (approximately)
/*!40000 ALTER TABLE `org_expenses` DISABLE KEYS */;
INSERT INTO `org_expenses` (`id`, `date`, `org_id`, `expense_id`, `invoice_or`, `amount`, `receipt`, `description`, `isApproved`, `approvedBy`, `createdBy`, `status`, `created_at`, `updated_at`) VALUES
	(1, '2022-02-05', 2, 3, '1', 6250.000000, 'uEJqbTvsdhMLdhVjXp1PUx6M6iLFb9E8SJpHhc6xrvbtKPynwO.png', 'this is nice', 1, 10, 19, 1, '2022-02-05 03:09:59', '2022-02-05 03:31:07'),
	(3, '2022-02-08', 1, 3, '123', 5000.000000, 'qRS6WKGLkyeoVqJZK4YcVBrLbwb2td8dg8CEshR8s3K3IIGuNK.png', 'wewe', 1, 20, 21, 1, '2022-02-08 00:55:56', '2022-02-08 00:56:59'),
	(4, '2022-02-09', 7, 4, '143', 2000.000000, 'r1fHr02dwrIGUed03wgyZd6O7tKBSQN1quopMbAC81YNtu5btW.png', 'this is an event', 1, 22, 23, 1, '2022-02-09 02:48:02', '2022-02-09 02:50:41');
/*!40000 ALTER TABLE `org_expenses` ENABLE KEYS */;

-- Dumping structure for table thesis.org_incomes
CREATE TABLE IF NOT EXISTS `org_incomes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `org_id` int(11) NOT NULL,
  `income_id` int(11) NOT NULL,
  `invoice_or` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `receipt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isApproved` int(11) DEFAULT '0',
  `approvedBy` int(11) DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table thesis.org_incomes: ~2 rows (approximately)
/*!40000 ALTER TABLE `org_incomes` DISABLE KEYS */;
INSERT INTO `org_incomes` (`id`, `date`, `org_id`, `income_id`, `invoice_or`, `amount`, `receipt`, `description`, `isApproved`, `approvedBy`, `createdBy`, `status`, `created_at`, `updated_at`) VALUES
	(1, '2022-02-05', 2, 1, '143', 5000.000000, '2B3NRDKE6LEWPjLZ7ODPKqxHsWqe4xvXImGOQYsRiox68JaIqt.png', 'test', 1, 10, 19, 1, '2022-02-05 00:28:38', '2022-02-05 01:52:39'),
	(2, '2022-02-05', 2, 2, '34', 2500.000000, 'GKyXfgreEwzgbVeQ12cexwLGi7kCtCOGxOvBhEDdH4p6Ma7MEs.png', 'wewe', 0, NULL, 10, 0, '2022-02-05 02:32:57', '2022-02-08 00:27:07'),
	(3, '2022-02-09', 7, 3, '12345', 6000.000000, 'Gx0olkMk9uLGogEwW24AEjKYjR9Hp4wK2bUUnu04BUKXGYH3cJ.png', 'this is weekly contributions', 1, 22, 23, 1, '2022-02-09 02:44:32', '2022-02-09 02:50:01');
/*!40000 ALTER TABLE `org_incomes` ENABLE KEYS */;

-- Dumping structure for table thesis.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table thesis.roles: ~0 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table thesis.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_id` int(11) DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `isActive` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table thesis.users: ~7 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `fullname`, `email`, `email_verified_at`, `password`, `organization_id`, `role_id`, `isActive`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Rody Duterte', 'super-admin@email.com', NULL, '$2y$10$uhOC8CiaXDcQBD4l2StDRu9aWX12m9HLgaTLCDAg1.t2sC1vUqlRm', NULL, 1, 0, NULL, '2022-02-02 03:23:18', '2022-02-08 00:11:20'),
	(10, 'csorg', 'Leni Robredo', 'adviser@email.com', NULL, '$2y$10$wJVVa/MwlMXINNyjACK6a.FNVt9mZPO2ReoE16Jh0PCwWi0Ic6Mi6', 2, 9, 0, NULL, '2022-02-02 06:27:26', '2022-02-08 00:10:48'),
	(19, 'test', 'Isko Moreno', 'orgofficer@mail.com', NULL, '$2y$10$3INiuDYvRlc5sm64oXpXge1DobkjRS8tXowOnek88/tVOwzJBUIbq', 2, 7, 0, NULL, '2022-02-04 08:48:51', '2022-02-08 00:11:34'),
	(20, 'eng@mail.com', 'wewe', 'eng@mail.com', NULL, '$2y$10$EiU.EkfreQvfJweKf9R77OvcWy1OiFvsMx8xh514Yvu8qC2aw3jlu', 1, 9, 0, NULL, '2022-02-05 00:11:04', '2022-02-08 00:09:40'),
	(21, 'orgeng@mail.com', 'Ping Lacson', 'orgeng@mail.com', NULL, '$2y$10$.D4gbe0XyV6fY5QXJby1Ne2imzFfwbzBlMj/JMW6YxJF9G4e4Ma1.', 1, 7, 0, NULL, '2022-02-05 00:18:26', '2022-02-08 00:11:48'),
	(22, 'saraduterte', 'Sara Duterte', 'saraduterte@mail.com', NULL, '$2y$10$K8J/vmuh.Y.Gvoi7LutnzuGkCOiPV9vDxgTLBKJaLNaq/FF3CkGWa', 7, 9, 0, NULL, '2022-02-09 02:40:33', '2022-02-09 02:40:33'),
	(23, 'willieong', 'Willie Ong', 'willieong@mail.com', NULL, '$2y$10$xiHgXfUOGq.jC0lBo8w5FuciAt33wJMPl3sIRTuT1alFBNziABhya', 7, 7, 0, NULL, '2022-02-09 02:41:11', '2022-02-09 02:41:11');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
