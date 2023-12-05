-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05. Des, 2023 13:08 PM
-- Tjener-versjon: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookingsystemdb`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `reciver` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `time_stamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dataark for tabell `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2),
(6, '2019_08_19_000000_create_failed_jobs_table', 2),
(7, '2023_11_14_152659_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `personal_access_tokens`
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
-- Tabellstruktur for tabell `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'student'),
(2, 'tutor');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dataark for tabell `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('tkNJK6l2Fx2vUDbP7X3pnGPFy2Se5vTvBVa6AhEh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 OPR/102.0.0.0 (Edition std-1)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY3plaHE2UUVYY3J5dDJCUmdHcG50Q1liOTB6YUhpZkZsVFNkZG9DQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1699976204);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `time_slots`
--

CREATE TABLE `time_slots` (
  `timeslot_id` int(11) NOT NULL,
  `tutor_id` int(11) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `booked_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `time_slots`
--

INSERT INTO `time_slots` (`timeslot_id`, `tutor_id`, `date`, `start_time`, `end_time`, `location`, `description`, `booked_by`, `created_at`, `updated_at`) VALUES
(12, 10, '2023-11-30', '12:08:00', '01:08:00', 'uia', 'Laravel', NULL, '2023-11-30 17:08:09', '2023-11-30 17:34:11'),
(13, 10, '2023-11-28', '20:24:00', '09:24:00', 'UIA', 'AWDAE', 11, '2023-11-30 17:24:12', '2023-11-30 17:54:01'),
(14, 10, '2023-11-22', '22:33:00', '11:33:00', '48 115', 'Php', NULL, '2023-11-30 17:33:35', '2023-11-30 17:33:35'),
(15, 10, '2023-11-23', '20:34:00', '09:34:00', 'UIA', 'Laravel', NULL, '2023-11-30 17:34:31', '2023-11-30 17:34:31'),
(16, 10, '2023-12-14', '09:02:00', '10:02:00', 'Digitlat', 'Modul 1', 13, '2023-12-04 14:03:35', '2023-12-05 11:17:38'),
(17, 10, '2023-12-14', '11:03:00', '12:03:00', 'Digitalt', 'JAVASCRIPT', NULL, '2023-12-04 14:04:02', '2023-12-04 14:04:02'),
(18, 12, '2023-12-12', '15:00:00', '04:00:00', 'B2 017', 'Modul Godkjening', NULL, '2023-12-04 14:06:42', '2023-12-05 10:40:39'),
(19, 12, '2023-12-13', '12:13:00', '01:13:00', 'uia', 'Veiledningstime', NULL, '2023-12-05 11:16:53', '2023-12-05 11:16:53'),
(20, 12, '2023-12-14', '10:00:00', '11:00:00', 'B2 017', 'Veiledningstime', NULL, '2023-12-05 11:17:20', '2023-12-05 11:17:20'),
(21, 10, '2023-12-12', '12:00:00', '01:00:00', 'uia', 'Hjelp i PHP', NULL, '2023-12-05 11:18:38', '2023-12-05 11:18:38'),
(22, 10, '2023-12-15', '14:00:00', '03:00:00', 'Digitalt', 'Veiledningstime', 11, '2023-12-05 11:19:52', '2023-12-05 11:22:12'),
(24, 12, '2023-12-15', '13:05:00', '02:05:00', 'Digitalt', 'Veiledningstime', NULL, '2023-12-05 11:21:43', '2023-12-05 11:21:43');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `role_id` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `phone_number`, `role_id`, `created_at`) VALUES
(4, 'Tester', 'Tester', 'tester@tester.no', '$2y$10$MX4TYdwBaTfgqny3uTKDCOSgjtIRj60cRYd0uNZibhlebpEj40iQi', '97382049', 1, NULL),
(7, 'Cookie', 'Monster', 'cookie@monster.no', '$2y$10$EMx1A7.MpArEIeIt11FnCu8CPSfu8AozEEogbzg3DKWR/uiN42qH2', '497203957', 1, NULL),
(9, 'test', 'tutor', 'test@tutor.no', '68eacb97d86f0c4621fa2b0e17cabd8c', '65439458784', 2, NULL),
(10, 'Donald', 'Duck', 'donald@duck.moc', '$2y$10$KCD/PICREJmoKUFFDohCmegXQnfPK067d8kBDTjvN5PWXoiqoFWHe', '12345678', 2, NULL),
(11, 'Herring', 'Silden', 'herring@silden.moc', '$2y$10$vWan7paJFwiPnflyZbkSlOXMR0.dhBgInz7jqOsfL.D.6bOaPVTB.', '87654321', 1, NULL),
(12, 'Karl', 'Johan', 'karl@bernadotte.se', '$2y$10$f9d6LYLu6lltUaKOCao4iuXEeNLRgJqrkiWOkzeXXJ59EVoNUKUBe', '67451232', 2, NULL),
(13, 'Cola', 'Coca', 'coca@cola.moc', '$2y$10$sT2v.IhW282J.KXaLq6y2.dH1wusg68KEsDf7wbLHxMkOJ8V5xXxm', '98872323', 1, NULL),
(14, 'Lars', 'Gunnar', 'lars@gunnar.moc', '$2y$10$ldV8PBTSJ7Rw/y8mDsklneQFh3IMnLBcf8nRKmbZG3Ckgn7fwzJ3C', '12345678', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`timeslot_id`),
  ADD KEY `fk_booked_by` (`booked_by`),
  ADD KEY `fk_tutor_id` (`tutor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `timeslot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `time_slots`
--
ALTER TABLE `time_slots`
  ADD CONSTRAINT `fk_booked_by` FOREIGN KEY (`booked_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_tutor_id` FOREIGN KEY (`tutor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Begrensninger for tabell `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
