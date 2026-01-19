-- ============================================
-- Database Export: Warung Sate Madura
-- From: SQLite (Local)
-- To: MySQL (InfinityFree)
-- Date: 2026-01-14 22:27:35
-- ============================================

-- GANTI 'your_database_name' dengan nama database kamu!
-- Contoh: USE ifO_46004434_warung_sate;
-- USE your_database_name;

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- ============================================
-- Table structure and data for: users
-- ============================================

TRUNCATE TABLE `users`;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('1', 'Admin', 'admin@example.com', NULL, '$2y$12$dqx4sY4j29mPd8yFTHgftuD7vC9yTK9JZnrojCWCZ4gj/gqySy8fy', NULL, '2025-12-04 01:42:53', '2025-12-04 01:42:53');

-- ============================================
-- Table structure and data for: password_reset_tokens
-- ============================================

TRUNCATE TABLE `password_reset_tokens`;

-- ============================================
-- Table structure and data for: sessions
-- ============================================

TRUNCATE TABLE `sessions`;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('AcxcDDtwarvgQLqfk9NYyQkvF3M4DnJUqiIEAcLu', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT1NraVJvblZlcW41UUJnUjFxcEtQcUtBNEx6TnBscDc5TmswQjNkYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi90YWJsZXMiO3M6NToicm91dGUiO3M6MTI6InRhYmxlcy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', '1768371445');

-- ============================================
-- Table structure and data for: cache
-- ============================================

TRUNCATE TABLE `cache`;

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-test@example.com|127.0.0.1:timer', 'i:1764812551;', '1764812551');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-test@example.com|127.0.0.1', 'i:2;', '1764812551');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-admin@warungsate.com|127.0.0.1:timer', 'i:1764849295;', '1764849295');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-admin@warungsate.com|127.0.0.1', 'i:2;', '1764849295');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-admin@admin.com|127.0.0.1:timer', 'i:1767481473;', '1767481473');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-admin@admin.com|127.0.0.1', 'i:1;', '1767481473');

-- ============================================
-- Table structure and data for: cache_locks
-- ============================================

TRUNCATE TABLE `cache_locks`;

-- ============================================
-- Table structure and data for: jobs
-- ============================================

TRUNCATE TABLE `jobs`;

-- ============================================
-- Table structure and data for: job_batches
-- ============================================

TRUNCATE TABLE `job_batches`;

-- ============================================
-- Table structure and data for: failed_jobs
-- ============================================

TRUNCATE TABLE `failed_jobs`;

-- ============================================
-- Table structure and data for: menus
-- ============================================

TRUNCATE TABLE `menus`;

INSERT INTO `menus` (`id`, `name`, `description`, `price`, `image`, `category`, `is_available`, `created_at`, `updated_at`) VALUES ('1', 'Sate Ayam', 'Sate Daging Ayam Tanpa Lontong', '17000', '20260104222951.jpg', 'Makanan', '1', '2025-12-04 01:52:33', '2026-01-04 22:29:51');
INSERT INTO `menus` (`id`, `name`, `description`, `price`, `image`, `category`, `is_available`, `created_at`, `updated_at`) VALUES ('2', 'Sate Ayam+Lontong', 'Sate Daging Ayam Dengan Lontong', '20000', '20260104223127.jpg', 'Makanan', '1', '2025-12-04 02:17:39', '2026-01-04 22:31:27');
INSERT INTO `menus` (`id`, `name`, `description`, `price`, `image`, `category`, `is_available`, `created_at`, `updated_at`) VALUES ('3', 'Sate Kambing', 'Sate Daging Kambing', '22000', '20260104223258.jpg', 'Makanan', '1', '2025-12-07 13:52:50', '2026-01-04 22:32:58');
INSERT INTO `menus` (`id`, `name`, `description`, `price`, `image`, `category`, `is_available`, `created_at`, `updated_at`) VALUES ('4', 'Sate Kambing+Lontong', 'Sate Daging Kambing Dengan Lontong', '25000', '20260104223436.jpg', 'Makanan', '1', '2026-01-04 22:34:36', '2026-01-04 22:34:36');
INSERT INTO `menus` (`id`, `name`, `description`, `price`, `image`, `category`, `is_available`, `created_at`, `updated_at`) VALUES ('6', 'Nasi Goreng Madura', 'Nasi Goreng Khas Madura Dengan Irisan Timun dan Tomat serta Kerupuk Udang', '15000', '20260104223647.jpg', 'Makanan', '1', '2026-01-04 22:36:48', '2026-01-04 22:36:48');
INSERT INTO `menus` (`id`, `name`, `description`, `price`, `image`, `category`, `is_available`, `created_at`, `updated_at`) VALUES ('7', 'Soto Khas Madura', 'Soto Khas Madura dengan Isian Ayam Suwir dan Sayur-Sayuran', '20000', '20260104223926.jpg', 'Makanan', '1', '2026-01-04 22:39:26', '2026-01-04 22:39:26');
INSERT INTO `menus` (`id`, `name`, `description`, `price`, `image`, `category`, `is_available`, `created_at`, `updated_at`) VALUES ('8', 'Es Teh', 'Es Teh Manis/Tawar', '5000', '20260104224106.jpg', 'Minuman', '1', '2026-01-04 22:41:06', '2026-01-04 22:42:26');
INSERT INTO `menus` (`id`, `name`, `description`, `price`, `image`, `category`, `is_available`, `created_at`, `updated_at`) VALUES ('9', 'Teh Panas', 'Teh Panas Manis/Tawar', '4000', '20260104224213.jpg', 'Minuman', '1', '2026-01-04 22:42:13', '2026-01-04 22:42:13');
INSERT INTO `menus` (`id`, `name`, `description`, `price`, `image`, `category`, `is_available`, `created_at`, `updated_at`) VALUES ('10', 'Es Jeruk', 'Es Jeruk Manis', '6000', '20260104224638.jpg', 'Minuman', '1', '2026-01-04 22:46:38', '2026-01-04 22:46:38');

-- ============================================
-- Table structure and data for: tables
-- ============================================

TRUNCATE TABLE `tables`;

INSERT INTO `tables` (`id`, `table_number`, `uuid`, `qr_code_path`, `created_at`, `updated_at`, `status`, `location_lat`, `location_lng`, `location_radius`, `require_location`) VALUES ('11', '1', '43efbe3f-c246-48b8-ba3c-051dac93de8e', 'qrcodes/qr-1.svg', '2026-01-09 04:29:00', '2026-01-14 06:09:03', 'occupied', '-3.0017', '104.800345', '100', '1');

-- ============================================
-- Table structure and data for: payment_methods
-- ============================================

TRUNCATE TABLE `payment_methods`;

INSERT INTO `payment_methods` (`id`, `name`, `type`, `account_number`, `account_name`, `qr_code_image`, `instructions`, `is_active`, `created_at`, `updated_at`) VALUES ('1', 'dana', 'bank_transfer', '083826383761', 'Muhamad Farhan Maura', NULL, NULL, '1', '2025-12-04 03:52:22', '2025-12-04 04:02:58');

-- ============================================
-- Table structure and data for: orders
-- ============================================

TRUNCATE TABLE `orders`;

INSERT INTO `orders` (`id`, `table_id`, `total_amount`, `payment_method`, `payment_status`, `order_status`, `customer_name`, `created_at`, `updated_at`) VALUES ('18', '11', '48000', 'Transfer', 'paid', 'completed', 'Farhan', '2026-01-09 04:46:33', '2026-01-09 04:49:02');
INSERT INTO `orders` (`id`, `table_id`, `total_amount`, `payment_method`, `payment_status`, `order_status`, `customer_name`, `created_at`, `updated_at`) VALUES ('19', '11', '56000', 'Cash', 'paid', 'completed', 'Farhan', '2026-01-09 05:09:56', '2026-01-09 05:12:38');
INSERT INTO `orders` (`id`, `table_id`, `total_amount`, `payment_method`, `payment_status`, `order_status`, `customer_name`, `created_at`, `updated_at`) VALUES ('20', '11', '37000', 'Cash', 'pending', 'pending', 'Farhan', '2026-01-14 06:09:03', '2026-01-14 06:09:03');

-- ============================================
-- Table structure and data for: order_items
-- ============================================

TRUNCATE TABLE `order_items`;

INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES ('22', '18', '1', '1', '17000', '2026-01-09 04:46:33', '2026-01-09 04:46:33');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES ('23', '18', '2', '1', '20000', '2026-01-09 04:46:33', '2026-01-09 04:46:33');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES ('24', '18', '8', '1', '5000', '2026-01-09 04:46:33', '2026-01-09 04:46:33');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES ('25', '18', '10', '1', '6000', '2026-01-09 04:46:33', '2026-01-09 04:46:33');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES ('26', '19', '1', '3', '17000', '2026-01-09 05:09:56', '2026-01-09 05:09:56');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES ('27', '19', '8', '1', '5000', '2026-01-09 05:09:56', '2026-01-09 05:09:56');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES ('28', '20', '1', '1', '17000', '2026-01-14 06:09:03', '2026-01-14 06:09:03');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES ('29', '20', '2', '1', '20000', '2026-01-14 06:09:03', '2026-01-14 06:09:03');

SET FOREIGN_KEY_CHECKS=1;

-- ============================================
-- Export Summary
-- Tables exported: 13
-- Total rows: 30
-- ============================================
