
CREATE TABLE `banners` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created_by` char(40) DEFAULT NULL,
  `updated_by` char(40) DEFAULT NULL,
  `sort_order` decimal(11,3) NOT NULL DEFAULT '0.000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int UNSIGNED NOT NULL,
  `batch_title` varchar(255) DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `course_duration` varchar(255) DEFAULT NULL,
  `course_duration_days` int DEFAULT NULL,
  `no_of_questions` int DEFAULT NULL,
  `total_marks` decimal(8,2) DEFAULT NULL,
  `time_limit` int DEFAULT NULL,
  `no_of_easy_question` int DEFAULT NULL,
  `no_of_medium_question` int DEFAULT NULL,
  `no_of_hard_question` int DEFAULT NULL,
  `year` int DEFAULT NULL,
  `month` int DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int UNSIGNED NOT NULL,
  `category_id` int DEFAULT NULL,
  `mollim_id` int DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `course_name_ur` varchar(255) DEFAULT NULL,
  `course_requirement` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `course_detail` varbinary(2000) DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `group_permission`
--

CREATE TABLE `group_permission` (
  `id` int UNSIGNED NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `form_name` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `permission_id` varchar(16) NOT NULL,
  `permission_name` varchar(32) NOT NULL,
  `sort_order` decimal(11,3) NOT NULL DEFAULT '0.000'
);

--
-- Dumping data for table `group_permission`
--

INSERT INTO `group_permission` (`id`, `module_name`, `form_name`, `route`, `permission_id`, `permission_name`, `sort_order`) VALUES
(1, 'Administrator', 'Permission', 'user_permission', 'list', 'List', '1.101'),
(2, 'Administrator', 'Permission', 'user_permission', 'add', 'Add', '1.102'),
(3, 'Administrator', 'Permission', 'user_permission', 'edit', 'Edit', '1.103'),
(4, 'Administrator', 'Permission', 'user_permission', 'delete', 'Delete', '1.104'),
(5, 'Administrator', 'User', 'user', 'list', 'List', '1.201'),
(6, 'Administrator', 'User', 'user', 'add', 'Add', '1.202'),
(7, 'Administrator', 'User', 'user', 'edit', 'Edit', '1.203'),
(8, 'Administrator', 'User', 'user', 'delete', 'Delete', '1.204'),
(9, 'General Group', 'Banners', 'banners', 'list', 'List', '1.301'),
(10, 'General Group', 'Banners', 'banners', 'add', 'Add', '1.302'),
(11, 'General Group', 'Banners', 'banners', 'edit', 'Edit', '1.303'),
(12, 'General Group', 'Banners', 'banners', 'delete', 'Delete', '1.304'),
(13, 'General Group', 'Category', 'category', 'list', 'List', '1.401'),
(14, 'General Group', 'Category', 'category', 'add', 'Add', '1.402'),
(15, 'General Group', 'Category', 'category', 'edit', 'Edit', '1.403'),
(16, 'General Group', 'Category', 'category', 'delete', 'Delete', '1.404'),
(17, 'General Group', 'Courses', 'courses', 'list', 'List', '1.501'),
(18, 'General Group', 'Courses', 'courses', 'add', 'Add', '1.502'),
(19, 'General Group', 'Courses', 'courses', 'edit', 'Edit', '1.503'),
(20, 'General Group', 'Courses', 'courses', 'delete', 'Delete', '1.504'),
(21, 'General Group', 'Batches', 'batches', 'list', 'List', '1.601'),
(22, 'General Group', 'Batches', 'batches', 'add', 'Add', '1.602'),
(23, 'General Group', 'Batches', 'batches', 'edit', 'Edit', '1.603'),
(24, 'General Group', 'Batches', 'batches', 'delete', 'Delete', '1.604');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
);

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_15_063639_create_permission_table', 1),
(6, '2024_10_15_090259_create_group_permission_table', 1),
(7, '2025_03_12_144238_create_permission_user_table', 1),
(8, '2025_03_13_170256_create_category_table', 1),
(9, '2025_04_06_085314_create_courses_table', 1),
(10, '2024_10_15_090259_create_banners_table', 2),
(15, '2025_04_15_150330_create_messages_table', 4),
(16, '2025_04_10_191734_create_batches_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `heading_text` varchar(255) DEFAULT NULL,
  `message` text,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `permission` text NOT NULL,
  `created_by` char(40) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` char(40) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `permission`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Admin', '\"{\\\"user_permission\\\":{\\\"list\\\":\\\"1\\\",\\\"add\\\":\\\"1\\\",\\\"edit\\\":\\\"1\\\",\\\"delete\\\":\\\"1\\\"},\\\"user\\\":{\\\"list\\\":\\\"1\\\",\\\"add\\\":\\\"1\\\",\\\"edit\\\":\\\"1\\\",\\\"delete\\\":\\\"1\\\"},\\\"banners\\\":{\\\"list\\\":\\\"1\\\",\\\"add\\\":\\\"1\\\",\\\"edit\\\":\\\"1\\\",\\\"delete\\\":\\\"1\\\"},\\\"category\\\":{\\\"list\\\":\\\"1\\\",\\\"add\\\":\\\"1\\\",\\\"edit\\\":\\\"1\\\",\\\"delete\\\":\\\"1\\\"},\\\"courses\\\":{\\\"list\\\":\\\"1\\\",\\\"add\\\":\\\"1\\\",\\\"edit\\\":\\\"1\\\",\\\"delete\\\":\\\"1\\\"},\\\"batches\\\":{\\\"list\\\":\\\"1\\\",\\\"add\\\":\\\"1\\\",\\\"edit\\\":\\\"1\\\",\\\"delete\\\":\\\"1\\\"}}\"', NULL, '2024-08-06 08:44:23', NULL, '2025-04-14 17:01:30');

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`id`, `user_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
);

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cRAkmyEa6swKYyW3PY05J8ZQZ1JbyH3YWXZUCCWk', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiaUhRa0NxYWpOWmFHcWFlSlM1QjIxZ0t3Q0twV09wYWRWeTZCY211byI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MToiaHR0cDovL2xtc19wcm9qZWN0LnRlc3QvYWRtaW4vcGVybWlzc2lvbnMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozOToiaHR0cDovL2xtc19wcm9qZWN0LnRlc3QvYWRtaW4vYmFubmVycy8yIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE2OiJ1c2VyX3Blcm1pc3Npb25zIjtPOjIxOiJBcHBcTW9kZWxzXFBlcm1pc3Npb24iOjMwOntzOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjExOiJwZXJtaXNzaW9ucyI7czoxMzoiACoAcHJpbWFyeUtleSI7czoyOiJpZCI7czoxMDoiACoAa2V5VHlwZSI7czozOiJpbnQiO3M6MTI6ImluY3JlbWVudGluZyI7YjoxO3M6NzoiACoAd2l0aCI7YTowOnt9czoxMjoiACoAd2l0aENvdW50IjthOjA6e31zOjE5OiJwcmV2ZW50c0xhenlMb2FkaW5nIjtiOjA7czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7YjoxO3M6MTg6Indhc1JlY2VudGx5Q3JlYXRlZCI7YjowO3M6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDtzOjEzOiIAKgBhdHRyaWJ1dGVzIjthOjc6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6NToiQWRtaW4iO3M6MTA6InBlcm1pc3Npb24iO3M6NDU5OiIie1widXNlcl9wZXJtaXNzaW9uXCI6e1wibGlzdFwiOlwiMVwiLFwiYWRkXCI6XCIxXCIsXCJlZGl0XCI6XCIxXCIsXCJkZWxldGVcIjpcIjFcIn0sXCJ1c2VyXCI6e1wibGlzdFwiOlwiMVwiLFwiYWRkXCI6XCIxXCIsXCJlZGl0XCI6XCIxXCIsXCJkZWxldGVcIjpcIjFcIn0sXCJiYW5uZXJzXCI6e1wibGlzdFwiOlwiMVwiLFwiYWRkXCI6XCIxXCIsXCJlZGl0XCI6XCIxXCIsXCJkZWxldGVcIjpcIjFcIn0sXCJjYXRlZ29yeVwiOntcImxpc3RcIjpcIjFcIixcImFkZFwiOlwiMVwiLFwiZWRpdFwiOlwiMVwiLFwiZGVsZXRlXCI6XCIxXCJ9LFwiY291cnNlc1wiOntcImxpc3RcIjpcIjFcIixcImFkZFwiOlwiMVwiLFwiZWRpdFwiOlwiMVwiLFwiZGVsZXRlXCI6XCIxXCJ9LFwiYmF0Y2hlc1wiOntcImxpc3RcIjpcIjFcIixcImFkZFwiOlwiMVwiLFwiZWRpdFwiOlwiMVwiLFwiZGVsZXRlXCI6XCIxXCJ9fSIiO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNC0wOC0wNiAwODo0NDoyMyI7czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI1LTA0LTE0IDE3OjAxOjMwIjt9czoxMToiACoAb3JpZ2luYWwiO2E6Nzp7czoyOiJpZCI7aToxO3M6NDoibmFtZSI7czo1OiJBZG1pbiI7czoxMDoicGVybWlzc2lvbiI7czo0NTk6IiJ7XCJ1c2VyX3Blcm1pc3Npb25cIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcInVzZXJcIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcImJhbm5lcnNcIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcImNhdGVnb3J5XCI6e1wibGlzdFwiOlwiMVwiLFwiYWRkXCI6XCIxXCIsXCJlZGl0XCI6XCIxXCIsXCJkZWxldGVcIjpcIjFc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IixcImFkZFwiOlwiMVwiLFwiZWRpdFwiOlwiMVwiLFwiZGVsZXRlXCI6XCIxXCJ9fSIiO3M6MTA6ImNyZWF0ZWRfYnkiO047czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNC0wOC0wNiAwODo0NDoyMyI7czoxMDoidXBkYXRlZF9ieSI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI1LTA0LTE0IDE3OjAxOjMwIjt9czoxMToiACoAb3JpZ2luYWwiO2E6Nzp7czoyOiJpZCI7aToxO3M6NDoibmFtZSI7czo1OiJBZG1pbiI7czoxMDoicGVybWlzc2lvbiI7czo0NTk6IiJ7XCJ1c2VyX3Blcm1pc3Npb25cIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcInVzZXJcIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcImJhbm5lcnNcIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcImNhdGVnb3J5XCI6e1wibGlzdFwiOlwiMVwiLFwiYWRkXCI6XCIxXCIsXCJlZGl0XCI6XCIxXCIsXCJkZWxldGVcIjpcIjFcIn0sXCJjb3Vyc2VzXCI6e1wibGlzdFwiOlwiMVwiLFwiYWRkXCI6XCIxXCIsXCJlZGl0XCI6XCIxXCIsXCJkZWxldGVcIjpcIjFcIn0sXCJiYXRjaGVzXCI6e1wibGlzdFwiOlwiMVwiLFwiYWRkXCI6XCIxXCIsXCJlZGl0XCI6XCIxXCIsXCJkZWxldGVcIjpcIjFcIn19IiI7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI0LTA4LTA2IDA4OjQ0OjIzIjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMTQgMTc6MDE6MzAiO31zOjEwOiIAKgBjaGFuZ2VzIjthOjA6e31zOjg6IgAqAGNhc3RzIjthOjE6e3M6MTA6InBlcm1pc3Npb24iO3M6NToiYXJyYXkiO31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czoyMToiACoAYXR0cmlidXRlQ2FzdENhY2hlIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MDp7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MDp7fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjEzOiJ1c2VzVW5pcXVlSWRzIjtiOjA7czo5OiIAKgBoaWRkZW4iO2E6MDp7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTE6IgAqAGZpbGxhYmxlIjthOjI6e2k6MDtzOjQ6Im5hbWUiO2k6MTtzOjEwOiJwZXJtaXNzaW9uIjt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9fX1zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fX0=', 1744738982),
('VJQBYNVRF2EJ0l8k96GJoxptL8IaACamfaPuaNuL', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoidzR3amNNRDVCN1oyaVRUaUZLVWluNVZzMUdCSlJheW9OYjd0QmV1YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sbXNfcHJvamVjdC50ZXN0L2NvdXJzZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTY6InVzZXJfcGVybWlzc2lvbnMiO086MjE6IkFwcFxNb2RlbHNcUGVybWlzc2lvbiI6MzA6e3M6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6MTE6InBlcm1pc3Npb25zIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTk6InByZXZlbnRzTGF6eUxvYWRpbmciO2I6MDtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6Nzp7czoyOiJpZCI7aToxO3M6NDoibmFtZSI7czo1OiJBZG1pbiI7czoxMDoicGVybWlzc2lvbiI7czo0NTk6IiJ7XCJ1c2VyX3Blcm1pc3Npb25cIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcInVzZXJcIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcImJhbm5lcnNcIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcImNhdGVnb3J5XCI6e1wibGlzdFwiOlwiMVwiLFwiYWRkXCI6XCIxXCIsXCJlZGl0XCI6XCIxXCIsXCJkZWxldGVcIjpcIjFcIn0sXCJjb3Vyc2VzXCI6e1wibGlzdFwiOlwiMVwiLFwiYWRkXCI6XCIxXCIsXCJlZGl0XCI6XCIxXCIsXCJkZWxldGVcIjpcIjFcIn0sXCJiYXRjaGVzXCI6e1wibGlzdFwiOlwiMVwiLFwiYWRkXCI6XCIxXCIsXCJlZGl0XCI6XCIxXCIsXCJkZWxldGVcIjpcIjFcIn19IiI7czoxMDoiY3JlYXRlZF9ieSI7TjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI0LTA4LTA2IDA4OjQ0OjIzIjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMTQgMTc6MDE6MzAiO31zOjExOiIAKgBvcmlnaW5hbCI7YTo3OntzOjI6ImlkIjtpOjE7czo0OiJuYW1lIjtzOjU6IkFkbWluIjtzOjEwOiJwZXJtaXNzaW9uIjtzOjQ1OToiIntcInVzZXJfcGVybWlzc2lvblwiOntcImxpc3RcIjpcIjFcIixcImFkZFwiOlwiMVwiLFwiZWRpdFwiOlwiMVwiLFwiZGVsZXRlXCI6XCIxXCJ9LFwidXNlclwiOntcImxpc3RcIjpcIjFcIixcImFkZFwiOlwiMVwiLFwiZWRpdFwiOlwiMVwiLFwiZGVsZXRlXCI6XCIxXCJ9LFwiYmFubmVyc1wiOntcImxpc3RcIjpcIjFcIixcImFkZFwiOlwiMVwiLFwiZWRpdFwiOlwiMVwiLFwiZGVsZXRlXCI6XCIxXCJ9LFwiY2F0ZWdvcnlcIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcImNvdXJzZXNcIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcImJhdGNoZXNc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IjtzOjE5OiIyMDI0LTA4LTA2IDA4OjQ0OjIzIjtzOjEwOiJ1cGRhdGVkX2J5IjtOO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMTQgMTc6MDE6MzAiO31zOjExOiIAKgBvcmlnaW5hbCI7YTo3OntzOjI6ImlkIjtpOjE7czo0OiJuYW1lIjtzOjU6IkFkbWluIjtzOjEwOiJwZXJtaXNzaW9uIjtzOjQ1OToiIntcInVzZXJfcGVybWlzc2lvblwiOntcImxpc3RcIjpcIjFcIixcImFkZFwiOlwiMVwiLFwiZWRpdFwiOlwiMVwiLFwiZGVsZXRlXCI6XCIxXCJ9LFwidXNlclwiOntcImxpc3RcIjpcIjFcIixcImFkZFwiOlwiMVwiLFwiZWRpdFwiOlwiMVwiLFwiZGVsZXRlXCI6XCIxXCJ9LFwiYmFubmVyc1wiOntcImxpc3RcIjpcIjFcIixcImFkZFwiOlwiMVwiLFwiZWRpdFwiOlwiMVwiLFwiZGVsZXRlXCI6XCIxXCJ9LFwiY2F0ZWdvcnlcIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcImNvdXJzZXNcIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifSxcImJhdGNoZXNcIjp7XCJsaXN0XCI6XCIxXCIsXCJhZGRcIjpcIjFcIixcImVkaXRcIjpcIjFcIixcImRlbGV0ZVwiOlwiMVwifX0iIjtzOjEwOiJjcmVhdGVkX2J5IjtOO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjQtMDgtMDYgMDg6NDQ6MjMiO3M6MTA6InVwZGF0ZWRfYnkiO047czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wNC0xNCAxNzowMTozMCI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6MTp7czoxMDoicGVybWlzc2lvbiI7czo1OiJhcnJheSI7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjIxOiIAKgBhdHRyaWJ1dGVDYXN0Q2FjaGUiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6MTM6InVzZXNVbmlxdWVJZHMiO2I6MDtzOjk6IgAqAGhpZGRlbiI7YTowOnt9czoxMDoiACoAdmlzaWJsZSI7YTowOnt9czoxMToiACoAZmlsbGFibGUiO2E6Mjp7aTowO3M6NDoibmFtZSI7aToxO3M6MTA6InBlcm1pc3Npb24iO31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO319fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9fQ==', 1744771546);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `permission_id` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `permission_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$iPsKTzqn4.ghgIS9OjTfxOm9qhqy9iGtdWPxJcQx3oM9ClRGJKDb6', 1, '[\"1\"]', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `group_permission`
--
ALTER TABLE `group_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_permission`
--
ALTER TABLE `group_permission`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
