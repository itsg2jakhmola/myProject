-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2017 at 08:24 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mymedicrip`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `medical_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` int(11) NOT NULL,
  `doctor_practice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insurance_company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insurance_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type`, `email`, `password`, `dob`, `medical_number`, `address`, `phone_number`, `doctor_practice`, `fax_number`, `insurance_company`, `insurance_number`, `lat`, `lng`, `about`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Patient One', 1, 'patient@gmail.com', '$2y$10$5XLMZ.8UeFipfij6m5/YeulLBy/CyAv4wsTGBQfxtF4vHP0O3l/.2', '08-12-2016', '98768889', 'Paschim Vihar West Metro Station, Block A 1, New Delhi, Delhi, India', 989809899, NULL, NULL, '788999999', '788999999', '', '', '', 'xlQYluwy5frRUYX0DMOORuJDyT1GZ8q2juQK0rfRLGDxc3iMC3x83kZZD13n', '2017-08-05 05:12:12', '2017-08-07 07:35:51'),
(2, 'doctor two', 2, 'doctor@gmail.com', '$2y$10$WcnAS5OXeAbiP4GaoVhTRuJnZ6ZgpfbXnDFYme748cspsGi51Q2pC', '', '', 'Batra Hospital Bus Stop, Mehrauli - Badarpur Road, Tughlakabad Institutional Area, New Delhi, Delhi, India', 989809899, NULL, NULL, '', '', '', '', '', 'JF3z26WsTM0Pk5K9ZTAa4DsYof5mHE8K8ordqhPkNlcNhaKcJfz1XAel6wwi', '2017-08-05 05:12:54', '2017-08-05 05:15:02'),
(3, 'PHarmach', 3, 'pharmacies@gmail.com', '$2y$10$Wy1lMADQB3fzHRJF0uWtMO7D.dcubdds0cXRPSTe5kTAoki4AF4CO', '', '', 'Indeevaram, Kerala, India', 2147483647, NULL, NULL, '', '', '', '', '', '9T9LRqAU7iiG0cBX8H2d6R8W3RBfp5JIsLlzItde7tb3MO2DkkuZ2w7qP7m6', '2017-08-05 05:13:31', '2017-08-05 05:15:41'),
(4, 'Patientss', 1, 'patiesnt@gmail.com', '$2y$10$phmypAm3CGnJ1h8mSf6WSe7ZFo/uSj5XYw4jIcQyT4BpOQjWwM9fG', '01-08-2017', '98768889', 'Khushāb, Punjab, Pakistan', 2147483647, NULL, NULL, '788999999', '788999999', '', '', '', 'EL2xuDR6n0fVNXke7qwJyfU0me8RVnHgSXdNCBwxXv1TABzWb9bXtxPikmcC', '2017-08-05 05:50:28', '2017-08-05 05:50:36'),
(5, 'Test', 1, 'test@gmail.com', '$2y$10$hQ9aProAweq8Kj9OwyG0tuHj6OnKldLWgOFOK5jX4y94Wi/DH2HxW', '02-08-2017', '98989999', 'Nangarhar, Afghanistan', 89898898, NULL, NULL, '89889898', '898989898', '', '', '', NULL, '2017-08-05 13:49:54', '2017-08-05 13:49:54'),
(6, 'test', 1, 'test@gmail.coms', '$2y$10$uGJPDJbmfVL196uThqEZXufSXH1h5xAP7qdakk.Yomrf5SlSknMCG', '01-08-2017', '908080909', 'Nangloi Extension, Delhi, India', 89898898, NULL, NULL, '89889898', '898989898', '', '', '', 'Xxf1pno4BpwhFIyTwopaHpZUtyNA6yAiB6l21IiaDbDZL8rrVF5W99hwgeRa', '2017-08-05 14:02:29', '2017-08-05 14:02:51'),
(7, 'newPatient', 1, 'pate@adf.com', '$2y$10$EGg4M24pAEB3fa3Qk8d9ouiiEtxV6CaQoI8GfUa4lPhQpNrC3Pfqi', '08-08-2017', '', 'Sussex Street, Sydney, New South Wales, Australia', 89898898, NULL, NULL, '89889898', '898989898', '', '', '', 'ogwfzQnIVGRTdeFaGkAnbsD8LWD3Fb5vtHgn0WTMDX98p33IcQ1qHpjWLcII', '2017-08-05 14:09:30', '2017-08-05 14:10:43'),
(8, 'patoiemt', 1, 'asadf@gad.com', '$2y$10$T0/R0tVnWai7JKa435pszuUDcVMyRKsmWyitYodB3VeLMQUifbLs2', '01-08-2017', '908080909', 'New York, NY, United States', 89898898, NULL, NULL, '89889898', '898989898', '', '', '', 'dQrfZM7GLISv3GY5VYOXBGumbyCilPtiksyiZfNZB3QLVdI2b46tqqfMH4pR', '2017-08-05 14:11:29', '2017-08-05 14:12:34'),
(9, 'xys', 1, 'xss@asdf.com', '$2y$10$d9NvAww3WmDfycIP.qJzBel/Fc08JGpgl684V8A6B7ZJELG199wZO', '01-08-2017', '908080909', 'New South Wales, Australia', 89898898, NULL, NULL, '89889898', '898989898', '', '', '', 'BxYoCT7bTnzPhGn5CzYfhQEIvN3ZzdI8vj33Zzt6QVZhRCFEJAanvFNqXRps', '2017-08-05 14:13:13', '2017-08-05 14:13:36'),
(10, 'Shahrukh', 1, 'shahrukh@test.com', '$2y$10$6swt5nGd/JZm8NtvCDre7.zQvmiopZUu9Yv0l8OhDI5poFJFo9cqy', '01-08-2017', '908080909', 'Nangloi Extension, Delhi, India', 89898898, NULL, NULL, '88888', '898989898', '', '', '', 'NgZYqiI6If16h1udlKzghKWPVdJpcM6x2TMMvWWaMzwwtuSrQnZLYmVHUa3o', '2017-08-06 12:26:14', '2017-08-06 12:26:22'),
(11, 'PHarmacy', 3, 'pharmacyji@gmail.com', '$2y$10$ypBZYOQYctH.F5xYO5aS1OA47qnAZ1BcFafIvP4p8r2gN5o0bqU2a', '', '', 'New Delhi, Delhi, India', 789098980, NULL, NULL, '', '', '', '', '', '43kgkdCnN8CEmt7U254kRBel5CQeUIxaRvoOBq8Stz6gVtEkeOcfpWddeqet', '2017-08-07 02:56:03', '2017-08-07 02:56:43'),
(12, 'DoctorName', 2, 'doctorname@yaa.com', '$2y$10$XQYqBg83mJ8BY.xybFpPGe3.SThglMMXRZQKw8t.JwTAQWAEpqEVq', '', '', 'New York, IA, United States', 987766687, NULL, NULL, '', '', '', '', '', 'dXttRxJ0aZ0Fj8yP7F0KBjvphlpcDv0wjVI3A2lsnU1KlPPhgUOdI8WMcAgz', '2017-08-07 03:48:25', '2017-08-07 03:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Patient', '2017-08-07 01:30:00', NULL),
(2, 'Doctor', '2017-08-07 01:30:00', NULL),
(3, 'Pharmacies', '2017-08-07 01:30:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
