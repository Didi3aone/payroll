-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_app_payroll.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_app_payroll.ci_sessions: ~6 rows (approximately)
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
	('b7vsjqqisbq3ptjo1csmsmpv1u7ciss4', '::1', 1563174172, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313536333137343137323B),
	('2uksb79dttsgh5fdpdp45pqd2ojd0nmo', '::1', 1563174879, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313536333137343837393B),
	('pdl0kgoopr3rmn57tpt8voc8ss74ikek', '::1', 1563175334, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313536333137353333343B),
	('tpnv8gko947l1stidudfi1it7e2jet17', '::1', 1563175748, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313536333137353734383B),
	('88dhcb28t2g3hstfpmadoc0reiafeov0', '::1', 1563176227, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313536333137363232373B),
	('lh0doi95i04sfn6r60vakuhmvc6af619', '::1', 1563176278, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313536333137363232373B);
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;

-- Dumping structure for table db_app_payroll.tbl_log_activityuser
CREATE TABLE IF NOT EXISTS `tbl_log_activityuser` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title_activity` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_activity` varchar(255) DEFAULT NULL,
  `activity_date` datetime DEFAULT NULL,
  `user_ip_address` varchar(255) DEFAULT NULL,
  `user_platform` varchar(255) DEFAULT NULL,
  `user_browser` varchar(255) DEFAULT NULL,
  `user_mobile` varchar(255) DEFAULT NULL,
  `user_city_activity` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_app_payroll.tbl_log_activityuser: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_log_activityuser` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_log_activityuser` ENABLE KEYS */;

-- Dumping structure for table db_app_payroll.tbl_setting
CREATE TABLE IF NOT EXISTS `tbl_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `is_active` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_app_payroll.tbl_setting: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_setting` DISABLE KEYS */;
INSERT INTO `tbl_setting` (`id`, `name`, `value`, `is_active`) VALUES
	(1, 'app_name', 'FINTE (FREE INTERNET FOR EVERYONE)', 1),
	(2, 'version_app', 'v.1.1', 1);
/*!40000 ALTER TABLE `tbl_setting` ENABLE KEYS */;

-- Dumping structure for table db_app_payroll.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1 COMMENT '1=active;0=notactive',
  `status_login` varchar(6) DEFAULT 'LOGOUT',
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `cookie` varchar(255) DEFAULT NULL,
  `forgot_passtime` timestamp NULL DEFAULT NULL,
  `unique_code` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_app_payroll.tbl_users: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`id`, `hash_id`, `fullname`, `email`, `username`, `password`, `role_id`, `is_active`, `status_login`, `login_time`, `logout_time`, `ip_address`, `cookie`, `forgot_passtime`, `unique_code`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
	(1, '63a9f0ea7bb98050796b649e854818455d0afcd45a7d81561001172', 'system', 'system@system.com', 'admin', '$2y$10$2eShhaEjX8UTP92.iimxdesr89NqvESYIOTIYQfpyPM1ulfKLMpP.', 1, 1, 'LOGIN', '2019-07-14 19:17:12', '2019-06-25 04:04:24', '::1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

-- Dumping structure for table db_app_payroll.tbl_users_role
CREATE TABLE IF NOT EXISTS `tbl_users_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1 COMMENT '1=active;0=notactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_app_payroll.tbl_users_role: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_users_role` DISABLE KEYS */;
INSERT INTO `tbl_users_role` (`id`, `hash_id`, `name`, `description`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
	(1, 'system', 'system', 'all access', 1, '2019-06-24 23:04:02', '2019-06-24 23:04:03', 'SYSTEM', 'SYSTEM', NULL, NULL);
/*!40000 ALTER TABLE `tbl_users_role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
