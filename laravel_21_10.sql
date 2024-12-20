-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 21 Eki 2024, 07:02:34
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `laravel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_09_25_091223_create_quality_forms_table', 1),
(7, '2024_09_25_120713_add_assigned_to_to_quality_forms_table', 1),
(8, '2024_09_25_125808_add_engineer_id_to_quality_forms_table', 1),
(9, '2024_09_26_075327_add_new_columns_to_quality_forms_table', 1),
(10, '2024_09_26_110938_add_missing_columns_to_quality_forms_table', 1),
(11, '2024_09_26_112016_add_inspected_and_approved_by_to_quality_forms_table', 1),
(12, '2024_10_08_101808_add_surec_id_to_quality_form_table', 2),
(13, '2022_05_09_190603_create_books_table', 3),
(14, '2022_09_25_055619_add_is_deleted_to_books_table', 3),
(15, '2022_12_03_183952_add_user_id_to_books_table', 3),
(16, '2022_12_10_051309_add_role_to_user_table', 3),
(17, '2022_12_10_160224_create_orders_table', 3),
(18, '2022_12_10_160242_create_orderdetails_table', 3),
(19, '2022_12_10_162016_add_order_id_to_orderdetails_table', 3),
(20, '2022_12_10_182605_add_parameters_to_orders_table', 3),
(21, '2022_12_11_093128_add_payment_params_to_orders_table', 3),
(22, '2023_02_19_131644_add_deleted_at_to_books_table', 3),
(23, '2023_03_11_074808_create_jobs_table', 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `per_price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_success` tinyint(1) NOT NULL DEFAULT 0,
  `failed_reason_msg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `quality_forms`
--

CREATE TABLE `quality_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `technician_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_to` varchar(255) DEFAULT NULL,
  `engineer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `document_date` varchar(255) DEFAULT NULL,
  `document_no` varchar(255) NOT NULL DEFAULT 'TKKF/ FR-KYM-247',
  `part_stock_number` varchar(255) DEFAULT NULL,
  `quality_report_number` varchar(255) DEFAULT NULL,
  `part_description` text DEFAULT NULL,
  `product_revision` varchar(255) DEFAULT NULL,
  `batch_quantity` int(11) DEFAULT NULL,
  `inspected_quantity` int(11) DEFAULT NULL,
  `technical_drawing_qdms` varchar(255) DEFAULT NULL,
  `technical_drawing_qdms_file` text DEFAULT NULL,
  `mechanical_measurements` varchar(255) DEFAULT NULL,
  `mechanical_measurements_file` text DEFAULT NULL,
  `calibration_equipment` varchar(255) DEFAULT NULL,
  `calibration_equipment_file` text DEFAULT NULL,
  `electrical_optical_test` varchar(255) DEFAULT NULL,
  `electrical_optical_test_file` text DEFAULT NULL,
  `supplier_measurement` varchar(255) DEFAULT NULL,
  `supplier_measurement_file` text DEFAULT NULL,
  `environmental_conditions` varchar(255) DEFAULT NULL,
  `environmental_conditions_file` text DEFAULT NULL,
  `special_process_tests` varchar(255) DEFAULT NULL,
  `special_process_tests_file` text DEFAULT NULL,
  `quality_conformance_certificate` varchar(255) DEFAULT NULL,
  `quality_conformance_certificate_file` text DEFAULT NULL,
  `shipping_packaging` varchar(255) DEFAULT NULL,
  `shipping_packaging_file` text DEFAULT NULL,
  `counterfeit_suspected` varchar(255) DEFAULT NULL,
  `counterfeit_suspected_file` text DEFAULT NULL,
  `shelf_life` varchar(255) DEFAULT NULL,
  `shelf_life_file` text DEFAULT NULL,
  `product_type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`product_type`)),
  `mechanical_raw_material` varchar(255) DEFAULT NULL,
  `mechanical_raw_material_file` text DEFAULT NULL,
  `mechanical_paint` varchar(255) DEFAULT NULL,
  `mechanical_paint_file` text DEFAULT NULL,
  `mechanical_exterior` varchar(255) DEFAULT NULL,
  `mechanical_exterior_file` text DEFAULT NULL,
  `mechanical_welding_documents` varchar(255) DEFAULT NULL,
  `mechanical_welding_documents_file` text DEFAULT NULL,
  `electronics_shipping` varchar(255) DEFAULT NULL,
  `electronics_shipping_file` text DEFAULT NULL,
  `electronics_pcb_certificate` varchar(255) DEFAULT NULL,
  `electronics_pcb_certificate_file` text DEFAULT NULL,
  `electronics_special_process` varchar(255) DEFAULT NULL,
  `electronics_special_process_file` text DEFAULT NULL,
  `electronics_pcb_mechanical` varchar(255) DEFAULT NULL,
  `electronics_pcb_mechanical_file` text DEFAULT NULL,
  `electronics_visual_inspection` varchar(255) DEFAULT NULL,
  `electronics_visual_inspection_file` text DEFAULT NULL,
  `electronics_electrical_test` varchar(255) DEFAULT NULL,
  `electronics_electrical_test_file` text DEFAULT NULL,
  `component_shipping` varchar(255) DEFAULT NULL,
  `component_shipping_file` text DEFAULT NULL,
  `component_lot_certificate` varchar(255) DEFAULT NULL,
  `component_lot_certificate_file` text DEFAULT NULL,
  `component_visual_inspection` varchar(255) DEFAULT NULL,
  `component_visual_inspection_file` text DEFAULT NULL,
  `component_electrical_test` varchar(255) DEFAULT NULL,
  `component_electrical_test_file` text DEFAULT NULL,
  `component_measurement` varchar(255) DEFAULT NULL,
  `component_measurement_file` text DEFAULT NULL,
  `cabling_mechanical_test` varchar(255) DEFAULT NULL,
  `cabling_mechanical_test_file` text DEFAULT NULL,
  `cabling_visual_inspection` varchar(255) DEFAULT NULL,
  `cabling_visual_inspection_file` text DEFAULT NULL,
  `cabling_electrical_test` varchar(255) DEFAULT NULL,
  `cabling_electrical_test_file` text DEFAULT NULL,
  `suspected_supplier_list` varchar(255) DEFAULT NULL,
  `suspected_supplier_list_file` text DEFAULT NULL,
  `suspected_traceability` varchar(255) DEFAULT NULL,
  `suspected_traceability_file` text DEFAULT NULL,
  `suspected_fake_packaging` varchar(255) DEFAULT NULL,
  `suspected_fake_packaging_file` text DEFAULT NULL,
  `inspected_by` varchar(255) DEFAULT NULL,
  `approved_by` varchar(255) DEFAULT NULL,
  `surec_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'guest'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Tablo için indeksler `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Tablo için indeksler `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Tablo için indeksler `quality_forms`
--
ALTER TABLE `quality_forms`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `quality_forms`
--
ALTER TABLE `quality_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
