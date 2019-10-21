-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `client_business_types`;
CREATE TABLE `client_business_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'adn_logo.png',
  `contact_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `tax` double(8,2) NOT NULL,
  `tdr_type` enum('Fixed','Percentage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_tdr` double(8,2) NOT NULL,
  `services_tdr` double(8,2) NOT NULL,
  `total_tdr` double(8,2) NOT NULL,
  `status` enum('Pending','Rejected','Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_business_types_client_id_foreign` (`client_id`),
  CONSTRAINT `client_business_types_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `client_business_types` (`id`, `client_id`, `store_id`, `name`, `logo`, `contact_name`, `phone_number`, `email`, `address`, `tax`, `tdr_type`, `my_tdr`, `services_tdr`, `total_tdr`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(33,	1,	NULL,	'School',	'1528264513.png',	'Saif',	'8801827230806',	'sch@gmail.com',	'Dhanmondi,Dhaka,Bangladesh.',	4.00,	'Percentage',	3.50,	2.25,	5.75,	'Active',	1,	1,	NULL,	'2018-06-05 23:55:13',	'2018-06-05 23:58:52'),
(34,	1,	NULL,	'ISP',	'1528265905.png',	'Saif',	'8801827230807',	'isp@gmail.com',	'Dhanmondi,dhaka,bangladesh.',	7.00,	'Percentage',	2.30,	2.70,	5.00,	'Pending',	1,	NULL,	NULL,	'2018-06-06 00:18:25',	'2018-06-06 00:18:25'),
(35,	54,	NULL,	'ISP',	NULL,	'Saif',	'8801827230804',	'isp@gmail.com',	'Dhaka,Bangladesh.',	2.00,	'Percentage',	3.00,	1.80,	4.80,	'Active',	54,	12,	NULL,	'2018-06-07 00:51:16',	'2018-06-07 01:29:37');

DROP TABLE IF EXISTS `client_customer_group_pivot`;
CREATE TABLE `client_customer_group_pivot` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_customer_group_pivot_client_id_foreign` (`client_id`),
  KEY `client_customer_group_pivot_customer_id_foreign` (`customer_id`),
  KEY `client_customer_group_pivot_group_id_foreign` (`group_id`),
  CONSTRAINT `client_customer_group_pivot_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `client_customer_group_pivot_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `client_customer_group_pivot_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `customer_groups` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `client_customer_group_pivot` (`id`, `client_id`, `customer_id`, `group_id`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(40,	1,	51,	12,	'Active',	1,	NULL,	NULL,	'2018-06-06 00:57:49',	'2018-06-06 00:57:49'),
(41,	1,	1,	12,	'Active',	1,	NULL,	NULL,	'2018-06-06 00:57:50',	'2018-06-06 00:57:50'),
(42,	1,	53,	12,	'Active',	1,	NULL,	NULL,	'2018-06-06 00:57:50',	'2018-06-06 00:57:50'),
(43,	54,	1,	13,	'Active',	54,	NULL,	NULL,	'2018-06-07 02:19:52',	'2018-06-07 02:19:52'),
(44,	54,	19,	13,	'Active',	54,	NULL,	NULL,	'2018-06-07 02:19:52',	'2018-06-07 02:19:52'),
(45,	54,	53,	13,	'Active',	54,	NULL,	NULL,	'2018-06-07 02:19:53',	'2018-06-07 02:19:53');

DROP TABLE IF EXISTS `customer_groups`;
CREATE TABLE `customer_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_groups_client_id_foreign` (`client_id`),
  CONSTRAINT `customer_groups_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `customer_groups` (`id`, `client_id`, `name`, `details`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(12,	1,	'Class One',	'Class one student Group',	'Active',	1,	NULL,	NULL,	'2018-06-06 00:46:02',	'2018-06-06 00:46:02'),
(13,	54,	'ISP(common User)',	'iso customer',	'Active',	54,	54,	NULL,	'2018-06-07 02:15:49',	'2018-06-07 02:19:07');

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE `discounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `client_business_type_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` date NOT NULL,
  `type` enum('Fixed','Percentage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double(8,2) NOT NULL,
  `use` int(10) unsigned NOT NULL DEFAULT '0',
  `status` enum('Unused','Using','Used') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discounts_client_id_foreign` (`client_id`),
  KEY `discounts_client_business_type_id_foreign` (`client_business_type_id`),
  CONSTRAINT `discounts_client_business_type_id_foreign` FOREIGN KEY (`client_business_type_id`) REFERENCES `client_business_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `discounts_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `discounts` (`id`, `client_id`, `client_business_type_id`, `title`, `expire_date`, `type`, `value`, `use`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	1,	33,	'summer Discount',	'2018-07-31',	'Percentage',	4.00,	0,	'Using',	1,	1,	NULL,	'2018-06-06 00:43:25',	'2018-06-06 00:44:00'),
(2,	54,	35,	'Eid Discount',	'2018-06-30',	'Percentage',	2.00,	3,	'Unused',	54,	NULL,	NULL,	'2018-06-07 02:14:47',	'2018-06-07 02:45:49');

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `customer_group_id` int(10) unsigned DEFAULT '0',
  `client_business_type_id` int(10) unsigned NOT NULL,
  `bundle_id` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_date` date DEFAULT NULL,
  `notification_method` enum('Email','SMS','Both') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `last_payment_date` date DEFAULT NULL,
  `subtotal` double(8,2) NOT NULL,
  `discount_id` int(10) unsigned DEFAULT NULL,
  `discount_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `tax` double(8,2) NOT NULL DEFAULT '0.00',
  `tdr_type` enum('Fixed','Percentage') CHARACTER SET utf8 NOT NULL,
  `tdr_value` double(8,2) NOT NULL DEFAULT '0.00',
  `services_tdr` double(8,2) NOT NULL DEFAULT '0.00',
  `my_tdr` double(8,2) NOT NULL DEFAULT '0.00',
  `total_tdr` double(8,2) NOT NULL DEFAULT '0.00',
  `total_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `note` text COLLATE utf8mb4_unicode_ci,
  `payment_status` enum('Paid','Unpaid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('create','Cancel','Rejected','Expired') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_client_id_foreign` (`client_id`),
  KEY `invoices_customer_id_foreign` (`customer_id`),
  KEY `invoices_customer_group_id_foreign` (`customer_group_id`),
  KEY `invoices_client_business_type_id_foreign` (`client_business_type_id`),
  KEY `invoices_discount_id_foreign` (`discount_id`),
  CONSTRAINT `invoices_client_business_type_id_foreign` FOREIGN KEY (`client_business_type_id`) REFERENCES `client_business_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `invoices_customer_group_id_foreign` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_groups` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `invoices_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `invoices` (`id`, `client_id`, `customer_id`, `customer_group_id`, `client_business_type_id`, `bundle_id`, `invoice_no`, `notification_date`, `notification_method`, `publish_date`, `last_payment_date`, `subtotal`, `discount_id`, `discount_amount`, `tax`, `tdr_type`, `tdr_value`, `services_tdr`, `my_tdr`, `total_tdr`, `total_amount`, `note`, `payment_status`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	1,	51,	12,	33,	NULL,	'QB15282699975',	'2018-06-06',	'Both',	'2018-06-06',	'2018-06-06',	1200.00,	1,	48.00,	48.00,	'Percentage',	69.00,	2.25,	3.50,	5.75,	1269.00,	NULL,	'Paid',	'create',	1,	51,	NULL,	'2018-06-06 01:28:20',	'2018-06-06 02:58:22'),
(2,	1,	1,	12,	33,	NULL,	'QB15282699970',	'2018-06-06',	'Both',	'2018-06-06',	'2018-06-06',	1200.00,	1,	48.00,	48.00,	'Percentage',	69.00,	2.25,	3.50,	5.75,	1269.00,	NULL,	'Paid',	'create',	1,	1,	NULL,	'2018-06-06 01:28:24',	'2018-06-06 02:38:50'),
(3,	1,	53,	12,	33,	NULL,	'QB15282699972',	'2018-06-06',	'Both',	'2018-06-06',	'2018-06-06',	2400.00,	1,	96.00,	96.00,	'Percentage',	138.00,	2.25,	3.50,	5.75,	2538.00,	NULL,	'Unpaid',	'create',	1,	NULL,	NULL,	'2018-06-06 01:28:29',	'2018-06-06 01:28:29'),
(4,	54,	1,	13,	35,	NULL,	'QB15283610333',	'2018-06-07',	'SMS',	'2018-06-07',	'2018-06-07',	500.00,	2,	10.00,	10.00,	'Percentage',	24.00,	1.80,	3.00,	4.80,	524.00,	NULL,	'Unpaid',	'create',	54,	NULL,	NULL,	'2018-06-07 02:45:41',	'2018-06-07 02:45:41'),
(5,	54,	19,	13,	35,	NULL,	'QB15283610338',	'2018-06-07',	'SMS',	'2018-06-07',	'2018-06-07',	500.00,	2,	10.00,	10.00,	'Percentage',	24.00,	1.80,	3.00,	4.80,	524.00,	NULL,	'Paid',	'create',	54,	19,	NULL,	'2018-06-07 02:45:45',	'2018-06-07 03:25:22'),
(6,	54,	53,	13,	35,	NULL,	'QB15283610339',	'2018-06-07',	'SMS',	'2018-06-07',	'2018-06-07',	500.00,	2,	10.00,	10.00,	'Percentage',	24.00,	1.80,	3.00,	4.80,	524.00,	NULL,	'Unpaid',	'create',	54,	NULL,	NULL,	'2018-06-07 02:45:49',	'2018-06-07 02:45:49');

DROP TABLE IF EXISTS `invoice_details`;
CREATE TABLE `invoice_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `client_business_type_id` int(10) unsigned NOT NULL,
  `item_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `unit_price` double(8,2) NOT NULL,
  `total_amount` double(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_details_invoice_id_foreign` (`invoice_id`),
  KEY `invoice_details_item_id_foreign` (`item_id`),
  KEY `invoice_details_client_business_type_id_foreign` (`client_business_type_id`),
  CONSTRAINT `invoice_details_client_business_type_id_foreign` FOREIGN KEY (`client_business_type_id`) REFERENCES `client_business_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `invoice_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `invoice_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `invoice_details` (`id`, `invoice_id`, `item_id`, `client_business_type_id`, `item_name`, `quantity`, `unit_price`, `total_amount`, `deleted_at`) VALUES
(1,	1,	1,	33,	'class one monthly free',	1,	1200.00,	1200.00,	NULL),
(2,	2,	1,	33,	'class one monthly free',	1,	1200.00,	1200.00,	NULL),
(3,	3,	1,	33,	'class one monthly free',	2,	1200.00,	2400.00,	NULL),
(4,	4,	4,	35,	'Common customer',	1,	500.00,	500.00,	NULL),
(5,	5,	4,	35,	'Common customer',	1,	500.00,	500.00,	NULL),
(6,	6,	4,	35,	'Common customer',	1,	500.00,	500.00,	NULL);

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_type_id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_business_type_id_foreign` (`business_type_id`),
  KEY `items_client_id_foreign` (`client_id`),
  CONSTRAINT `items_business_type_id_foreign` FOREIGN KEY (`business_type_id`) REFERENCES `client_business_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `items_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `items` (`id`, `business_type_id`, `client_id`, `name`, `price`, `details`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	33,	1,	'class one monthly free',	1200.00,	'class one all student monthly admission free',	'Active',	1,	1,	NULL,	'2018-06-06 00:10:16',	'2018-06-06 00:11:06'),
(2,	33,	1,	'class one van rent',	800.00,	NULL,	'Active',	1,	1,	NULL,	'2018-06-06 00:10:45',	'2018-06-06 00:13:58'),
(3,	33,	1,	'yearly free',	10000.00,	'every class yearly free',	'Active',	1,	1,	NULL,	'2018-06-06 00:15:13',	'2018-06-06 00:24:15'),
(4,	35,	54,	'Common customer',	500.00,	NULL,	'Active',	54,	NULL,	NULL,	'2018-06-07 02:08:15',	'2018-06-07 02:08:15');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2018_04_15_091134_create_client_business_type_table',	1),
(4,	'2018_04_15_092344_create_item_table',	1),
(5,	'2018_04_15_093534_create_customer_group_table',	1),
(6,	'2018_04_15_093805_create_client_customer_group_pivot_table',	1),
(7,	'2018_04_15_095108_create_discount_table',	1),
(8,	'2018_04_15_095921_create_invoice_table',	1),
(9,	'2018_04_15_101607_create_invoice_detail_table',	1),
(11,	'2018_04_15_104650_create_notification_table',	1),
(12,	'2018_04_15_105514_create_system_setting_table',	1),
(13,	'2018_04_15_102044_create_transaction_table',	2);

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `process_table` enum('invoices') COLLATE utf8mb4_unicode_ci NOT NULL,
  `process_id` int(10) unsigned NOT NULL,
  `method` enum('Email','SMS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fire_date` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Pending','Success','Failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `notifications` (`id`, `user_id`, `process_table`, `process_id`, `method`, `content`, `url_code`, `fire_date`, `note`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	51,	'invoices',	1,	'Email',	'Dear Customer, Your Total Amount: ....,Last Payment Date:...., Please Pay your total Amount.Click Details',	'MQ==',	'2018-06-06',	NULL,	'Pending',	1,	NULL,	NULL,	'2018-06-06 01:28:20',	'2018-06-06 01:28:20'),
(2,	51,	'invoices',	1,	'SMS',	'Dear Customer, Please Pay your total Amount.Click Details',	'MQ==',	'2018-06-06',	NULL,	'Pending',	1,	NULL,	NULL,	'2018-06-06 01:28:20',	'2018-06-06 01:28:20'),
(3,	1,	'invoices',	2,	'Email',	'Dear Customer, Your Total Amount: ....,Last Payment Date:...., Please Pay your total Amount.Click Details',	'Mg==',	'2018-06-06',	NULL,	'Pending',	1,	NULL,	NULL,	'2018-06-06 01:28:24',	'2018-06-06 01:28:24'),
(4,	1,	'invoices',	2,	'SMS',	'Dear Customer, Please Pay your total Amount.Click Details',	'Mg==',	'2018-06-06',	NULL,	'Pending',	1,	NULL,	NULL,	'2018-06-06 01:28:25',	'2018-06-06 01:28:25'),
(5,	53,	'invoices',	3,	'Email',	'Dear Customer, Your Total Amount: ....,Last Payment Date:...., Please Pay your total Amount.Click Details',	'Mw==',	'2018-06-06',	NULL,	'Pending',	1,	NULL,	NULL,	'2018-06-06 01:28:29',	'2018-06-06 01:28:29'),
(6,	53,	'invoices',	3,	'SMS',	'Dear Customer, Please Pay your total Amount.Click Details',	'Mw==',	'2018-06-06',	NULL,	'Pending',	1,	NULL,	NULL,	'2018-06-06 01:28:29',	'2018-06-06 01:28:29'),
(7,	1,	'invoices',	4,	'SMS',	'Dear Customer, Please Pay your total Amount.Click Details',	'NA==',	'2018-06-07',	NULL,	'Pending',	54,	NULL,	NULL,	'2018-06-07 02:45:41',	'2018-06-07 02:45:41'),
(8,	19,	'invoices',	5,	'SMS',	'Dear Customer, Please Pay your total Amount.Click Details',	'NQ==',	'2018-06-07',	NULL,	'Pending',	54,	NULL,	NULL,	'2018-06-07 02:45:45',	'2018-06-07 02:45:45'),
(9,	53,	'invoices',	6,	'SMS',	'Dear Customer, Please Pay your total Amount.Click Details',	'Ng==',	'2018-06-07',	NULL,	'Pending',	54,	NULL,	NULL,	'2018-06-07 02:45:49',	'2018-06-07 02:45:49');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `system_settings`;
CREATE TABLE `system_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tran_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `payment_amount` double(8,2) NOT NULL,
  `payment_date` date NOT NULL,
  `gateway_data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Completed','Failed','Cancelled','Fraud','VALID') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_invoice_id_foreign` (`invoice_id`),
  KEY `transactions_client_id_foreign` (`client_id`),
  KEY `transactions_customer_id_foreign` (`customer_id`),
  CONSTRAINT `transactions_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `transactions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `transactions_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `transactions` (`id`, `tran_id`, `store_id`, `invoice_id`, `client_id`, `customer_id`, `payment_amount`, `payment_date`, `gateway_data`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(20,	't1528272996437',	'test',	2,	1,	1,	1269.00,	'2018-06-06',	'a:28:{s:7:\"tran_id\";s:14:\"t1528272996437\";s:6:\"val_id\";s:27:\"18060614203219JRXtrsXXQRt5i\";s:6:\"amount\";s:4:\"1269\";s:9:\"card_type\";s:14:\"AMEX-City Bank\";s:12:\"store_amount\";s:8:\"1224.585\";s:7:\"card_no\";N;s:12:\"bank_tran_id\";s:27:\"1806061420320qaBmGPj5yZCJsu\";s:6:\"status\";s:5:\"VALID\";s:9:\"tran_date\";s:19:\"2018-06-06 14:20:28\";s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";N;s:10:\"card_brand\";N;s:19:\"card_issuer_country\";N;s:24:\"card_issuer_country_code\";N;s:8:\"store_id\";s:4:\"test\";s:11:\"verify_sign\";s:32:\"0074da8840a5d8132c877ef467c79c4c\";s:10:\"verify_key\";s:276:\"amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_type,currency,currency_amount,currency_rate,currency_type,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d\";s:16:\"verify_sign_sha2\";s:64:\"4b03efef0996a04240c5d4bee924f31417cd96b0f3024f7b87d658b5a57bb06f\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:7:\"1269.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:7:\"value_a\";s:1:\"2\";s:7:\"value_b\";s:15:\"client@demo.com\";s:7:\"value_c\";N;s:7:\"value_d\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";}',	'VALID',	1,	NULL,	NULL,	'2018-06-06 02:18:06',	'2018-06-06 02:18:06'),
(21,	't1528273366818',	'test',	2,	1,	1,	1269.00,	'2018-06-06',	'a:28:{s:7:\"tran_id\";s:14:\"t1528273366818\";s:6:\"val_id\";s:27:\"180606142528DfIuvPtcL73Y9Ai\";s:6:\"amount\";s:4:\"1269\";s:9:\"card_type\";s:14:\"AMEX-City Bank\";s:12:\"store_amount\";s:8:\"1224.585\";s:7:\"card_no\";N;s:12:\"bank_tran_id\";s:27:\"180606142528rLAIfuD9sCDC4MC\";s:6:\"status\";s:5:\"VALID\";s:9:\"tran_date\";s:19:\"2018-06-06 14:25:24\";s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";N;s:10:\"card_brand\";N;s:19:\"card_issuer_country\";N;s:24:\"card_issuer_country_code\";N;s:8:\"store_id\";s:4:\"test\";s:11:\"verify_sign\";s:32:\"c5d945fc0a60225428d9b30503605bd2\";s:10:\"verify_key\";s:276:\"amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_type,currency,currency_amount,currency_rate,currency_type,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d\";s:16:\"verify_sign_sha2\";s:64:\"ed247a2cf775bde8eb23b994a7596a9544868bf61ecb1161b9b25cabe87235a1\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:7:\"1269.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:7:\"value_a\";s:1:\"2\";s:7:\"value_b\";s:15:\"client@demo.com\";s:7:\"value_c\";N;s:7:\"value_d\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";}',	'VALID',	1,	NULL,	NULL,	'2018-06-06 02:22:59',	'2018-06-06 02:22:59'),
(26,	't1528274322170',	'test',	2,	1,	1,	1269.00,	'2018-06-06',	'a:28:{s:7:\"tran_id\";s:14:\"t1528274322170\";s:6:\"val_id\";s:27:\"180606144120uSvfl68nWZVB8yr\";s:6:\"amount\";s:4:\"1269\";s:9:\"card_type\";s:17:\"VISA-Dutch Bangla\";s:12:\"store_amount\";s:7:\"1230.93\";s:7:\"card_no\";s:16:\"432155******3964\";s:12:\"bank_tran_id\";s:27:\"180606144120a4OcfG53CJnOj28\";s:6:\"status\";s:5:\"VALID\";s:9:\"tran_date\";s:19:\"2018-06-06 14:41:16\";s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";s:23:\"STANDARD CHARTERED BANK\";s:10:\"card_brand\";s:4:\"VISA\";s:19:\"card_issuer_country\";s:10:\"Bangladesh\";s:24:\"card_issuer_country_code\";s:2:\"BD\";s:8:\"store_id\";s:4:\"test\";s:11:\"verify_sign\";s:32:\"638590e2dff0e96f5cda768efcc8e435\";s:10:\"verify_key\";s:276:\"amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_type,currency,currency_amount,currency_rate,currency_type,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d\";s:16:\"verify_sign_sha2\";s:64:\"9d8ec6114e04dd71135b06dfa70da10ce5fa82bf98badc202c38689518663a96\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:7:\"1269.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:7:\"value_a\";s:1:\"2\";s:7:\"value_b\";s:15:\"client@demo.com\";s:7:\"value_c\";N;s:7:\"value_d\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";}',	'VALID',	1,	NULL,	NULL,	'2018-06-06 02:38:50',	'2018-06-06 02:38:50'),
(27,	't1528275486446',	'test',	1,	1,	51,	1269.00,	'2018-06-06',	'a:28:{s:7:\"tran_id\";s:14:\"t1528275486446\";s:6:\"val_id\";s:27:\"180606150054ZEqwQ9oRzmMP8Cs\";s:6:\"amount\";s:4:\"1269\";s:9:\"card_type\";s:27:\"MASTER-Eastern Bank Limited\";s:12:\"store_amount\";s:8:\"1237.275\";s:7:\"card_no\";N;s:12:\"bank_tran_id\";s:27:\"1806061500540vK57k65g9IRm8o\";s:6:\"status\";s:5:\"VALID\";s:9:\"tran_date\";s:19:\"2018-06-06 15:00:41\";s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";N;s:10:\"card_brand\";N;s:19:\"card_issuer_country\";N;s:24:\"card_issuer_country_code\";N;s:8:\"store_id\";s:4:\"test\";s:11:\"verify_sign\";s:32:\"20a1a5c5f9d9aaa0b3e1aab95f5e8c34\";s:10:\"verify_key\";s:276:\"amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_type,currency,currency_amount,currency_rate,currency_type,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d\";s:16:\"verify_sign_sha2\";s:64:\"8f996f793afb60ea29fcea71ea4ab98a907639f52878eb172567c5b9a3f5445f\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:7:\"1269.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:7:\"value_a\";s:1:\"1\";s:7:\"value_b\";s:12:\"st@gmail.com\";s:7:\"value_c\";N;s:7:\"value_d\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";}',	'VALID',	51,	NULL,	NULL,	'2018-06-06 02:58:22',	'2018-06-06 02:58:22'),
(30,	't1528363454438',	'test',	5,	54,	19,	524.00,	'2018-06-07',	'a:28:{s:7:\"tran_id\";s:14:\"t1528363454438\";s:6:\"val_id\";s:27:\"1806071527521pqGtwRwACcskL7\";s:6:\"amount\";s:3:\"524\";s:9:\"card_type\";s:27:\"MASTER-Eastern Bank Limited\";s:12:\"store_amount\";s:5:\"510.9\";s:7:\"card_no\";N;s:12:\"bank_tran_id\";s:27:\"180607152752kZ8rcg2Grpc4SVR\";s:6:\"status\";s:5:\"VALID\";s:9:\"tran_date\";s:19:\"2018-06-07 15:27:31\";s:8:\"currency\";s:3:\"BDT\";s:11:\"card_issuer\";N;s:10:\"card_brand\";N;s:19:\"card_issuer_country\";N;s:24:\"card_issuer_country_code\";N;s:8:\"store_id\";s:4:\"test\";s:11:\"verify_sign\";s:32:\"14c68481a70a6603d8fe59cb54ce41df\";s:10:\"verify_key\";s:276:\"amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_type,currency,currency_amount,currency_rate,currency_type,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d\";s:16:\"verify_sign_sha2\";s:64:\"0d5ce91c4f1402151c435b9fc0b064041840911b43054bd7e1f65d99a47e5961\";s:13:\"currency_type\";s:3:\"BDT\";s:15:\"currency_amount\";s:6:\"524.00\";s:13:\"currency_rate\";s:6:\"1.0000\";s:9:\"base_fair\";s:4:\"0.00\";s:7:\"value_a\";s:1:\"5\";s:7:\"value_b\";s:21:\"forhad.anam@gmail.com\";s:7:\"value_c\";N;s:7:\"value_d\";N;s:10:\"risk_level\";s:1:\"0\";s:10:\"risk_title\";s:4:\"Safe\";}',	'VALID',	19,	NULL,	NULL,	'2018-06-07 03:25:22',	'2018-06-07 03:25:22');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('Admin','Client','Customer','Employee') COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_certificate` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Pending','Active','Inactive','Suspended') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `type`, `parent_id`, `name`, `address`, `phone`, `email`, `password`, `profile_picture`, `nid`, `passport`, `birth_certificate`, `status`, `remember_token`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'Client',	NULL,	'Md.Saif Uddin',	'Zigatola,Dhanamondi,Dhaka.',	'8801777777777',	'client@demo.com',	'$2y$10$s5VtntPY1R29a9Iihv5CUO/tjrtrJEzIl6nD.ss0KEmKVHKcaUunK',	'1527142212.jpeg',	'0123456789',	'321321456',	'123213456',	'Active',	'YZnKPrxf4Bx2W35X8U30CWIBqxMWSINuK7MrhXiyAzNEioJr8BZHj3qqOWad',	0,	1,	NULL,	'2018-04-22 22:58:49',	'2018-05-27 00:35:37'),
(2,	'Client',	NULL,	'ADN Digital',	'test',	'01777770531',	'saifcsediu806@admin.com',	'$2y$10$8HJLXINZ4OUtAdbMNvSVGegYFbgekP34.EhBVIFeEk8dMfSvo8sby',	NULL,	'444',	NULL,	NULL,	'Active',	NULL,	1,	NULL,	NULL,	'2018-04-22 23:08:54',	'2018-04-22 23:08:54'),
(12,	'Admin',	NULL,	'Admin',	'test dhaka',	'8801777777770',	'admin@demo.com',	'$2y$10$s5VtntPY1R29a9Iihv5CUO/tjrtrJEzIl6nD.ss0KEmKVHKcaUunK',	'1527403145.jpeg',	'0123456789',	NULL,	NULL,	'Active',	'GHAg8OvNyu6CgRIGAZypXNfL5cLC0yQ6XOclIvJzLlzzhP9iz1KbTjqafSRW',	1,	12,	NULL,	'2018-04-26 01:59:21',	'2018-05-27 00:39:05'),
(13,	'Admin',	NULL,	'saif',	'test address',	'01827230806',	'saifcse06@gmail.com',	'$2y$10$c7t4roQkO9aGcOAmsxO3POp5U1EkmT5r4fFq9FBB7ZNuSbA44egIG',	NULL,	NULL,	NULL,	NULL,	'Active',	NULL,	1,	NULL,	NULL,	'2018-05-06 00:25:44',	'2018-05-06 00:25:44'),
(14,	'Admin',	NULL,	'User 2',	'Address',	'01777770540',	'saifcsediu806@demo.com',	'$2y$10$l61HvJhsp0S8J78FqktSEeSZgqarlAfOkvUNIOP36G.P5SXahSVzm',	NULL,	NULL,	NULL,	NULL,	'Active',	NULL,	1,	NULL,	NULL,	'2018-05-06 04:17:39',	'2018-05-06 04:17:39'),
(15,	'Admin',	NULL,	'User 2',	'Address',	'01777779087',	'saif.adndigital@demo.com',	'$2y$10$.lqXATLWJh3uezmAuMKBYuAXFgjNqt0nROTOzIOGPbz4ax1PNRFOa',	NULL,	NULL,	NULL,	NULL,	'Active',	NULL,	1,	NULL,	NULL,	'2018-05-06 04:44:07',	'2018-05-06 04:44:07'),
(18,	'Admin',	NULL,	'User 2',	'test test',	'01777777787',	'user3@demo.com',	'$2y$10$7KgpxJqqlTdtDhEZ9PtjGu3ghUiOOhyOLVliOZe0nOMZHp.9rPvT6',	NULL,	NULL,	NULL,	NULL,	'Active',	NULL,	1,	NULL,	NULL,	'2018-05-06 04:47:31',	'2018-05-06 04:47:31'),
(19,	'Customer',	NULL,	'Forhad Bin Mohammad Anam',	'648/D4, Navana Kazi Richmond, Gabtola Mor\r\nNoyatola Road, Maghbazar',	'8801777770514',	'forhad.anam@gmail.com',	'$2y$10$s5VtntPY1R29a9Iihv5CUO/tjrtrJEzIl6nD.ss0KEmKVHKcaUunK',	'1527402348.png',	'0123456789',	'1231212321312',	'12312312312',	'Active',	'7PX9Vu8OiAeMg43PSpeUUHwfjZm0sdOG8AHZaU83UNEys12AbGiZwq6xiOZv',	1,	19,	NULL,	'2018-05-17 05:51:57',	'2018-05-29 23:28:37'),
(49,	'Customer',	NULL,	'New Client',	NULL,	'01777770250',	'newclient@gmail.com',	'$2y$10$f0L3ROu40zmE.MmOw8MRuuY5Wkai1/88ZbMdUViZ39NMhODlPIXwe',	NULL,	'0123456789',	NULL,	NULL,	'Active',	NULL,	12,	12,	NULL,	'2018-06-03 00:05:44',	'2018-06-07 00:16:54'),
(51,	'Customer',	NULL,	'test',	NULL,	'8801827230807',	'st@gmail.com',	'$2y$10$s5VtntPY1R29a9Iihv5CUO/tjrtrJEzIl6nD.ss0KEmKVHKcaUunK',	NULL,	NULL,	NULL,	NULL,	'Active',	'A55Da86EqYGpK4zI9dwVRXZD5CCym3j6nf658HlkI8bnte6Nb4L9AJzfrZpb',	0,	51,	NULL,	'2018-06-03 00:49:58',	'2018-06-03 03:18:05'),
(52,	'Employee',	1,	'New Employee',	'test',	'8801777770535',	'testemployee@gmail.com',	'$2y$10$s0.OKZrLeuyRJdn1N8yrG.giVSJ0cwCqt48bSlzEzB/BoJ8yLAeMO',	NULL,	'0123456789',	'1231212321312',	'12312312312',	'Active',	NULL,	1,	1,	NULL,	'2018-06-04 00:54:13',	'2018-06-07 00:32:35'),
(53,	'Customer',	NULL,	'Arif',	'Dhaka,Bangladesh',	'8801777770532',	'arif@gmail.com',	'$2y$10$xz5pg5osbq2bAFJmndw24OSIWUrFuIyvoJRg.nbVeZCT2/Ticau0K',	NULL,	NULL,	NULL,	NULL,	'Active',	NULL,	1,	NULL,	NULL,	'2018-06-06 00:56:11',	'2018-06-06 00:56:11'),
(54,	'Client',	NULL,	'saif as a Client',	'dhaka,Bangladesh.',	'8801827230802',	'ccl@gmail.com',	'$2y$10$ZzHj.fFEQkK.dbtazhn2NeFMq8gROHk.P9pfmLjpiJ6mIuZao.yuG',	NULL,	'0123456789',	NULL,	NULL,	'Active',	'BEE7IVAHkD38Cj93ZP0gzzSiBMuqJJfMEKzxDfXcfCggM9HLWpZVXGFfPMWk',	0,	54,	NULL,	'2018-06-06 23:31:12',	'2018-06-07 00:17:07'),
(55,	'Customer',	NULL,	'Saif As a Customer',	'Dhanmondhi,Dhaka,Bangladesh.',	'8801827230801',	'saifcus@gmail.com',	'$2y$10$uGnZrOIIyf5r9iL8JlDSd.aOziImPfzXTWS8sN7O/w7RpqdhhhBBW',	NULL,	NULL,	NULL,	NULL,	'Active',	'BFZzRaiB1WvBQovgnxKC6vKpfZ5VNKwZpwMqQ8JyKOlwELUIuI1tcnYKSE3p',	0,	55,	NULL,	'2018-06-06 23:54:08',	'2018-06-07 00:16:59');

-- 2018-07-19 18:21:59
