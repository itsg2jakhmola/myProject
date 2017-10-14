-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2017 at 02:15 PM
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
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type`, `email`, `password`, `dob`, `medical_number`, `address`, `phone_number`, `doctor_practice`, `fax_number`, `insurance_company`, `insurance_number`, `lat`, `lng`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Patient One', 1, 'patient@gmail.com', '$2y$10$5XLMZ.8UeFipfij6m5/YeulLBy/CyAv4wsTGBQfxtF4vHP0O3l/.2', '08-12-2016', '98768889', 'Paschim Vihar West Metro Station, Block A 1, New Delhi, Delhi, India', 989809899, NULL, NULL, '788999999', '788999999', '', '', 'nZX5t3rY2lMBbVzXh8wzHYSekBww2l52J2eY19aCQpZfSreokb8xTNcJCLn7', '2017-08-05 05:12:12', '2017-08-05 05:14:28'),
(2, 'doctor two', 2, 'doctor@gmail.com', '$2y$10$WcnAS5OXeAbiP4GaoVhTRuJnZ6ZgpfbXnDFYme748cspsGi51Q2pC', '', '', 'Batra Hospital Bus Stop, Mehrauli - Badarpur Road, Tughlakabad Institutional Area, New Delhi, Delhi, India', 989809899, NULL, NULL, '', '', '', '', 'JF3z26WsTM0Pk5K9ZTAa4DsYof5mHE8K8ordqhPkNlcNhaKcJfz1XAel6wwi', '2017-08-05 05:12:54', '2017-08-05 05:15:02'),
(3, 'PHarmach', 3, 'pharmacies@gmail.com', '$2y$10$Wy1lMADQB3fzHRJF0uWtMO7D.dcubdds0cXRPSTe5kTAoki4AF4CO', '', '', 'Indeevaram, Kerala, India', 2147483647, NULL, NULL, '', '', '', '', '9T9LRqAU7iiG0cBX8H2d6R8W3RBfp5JIsLlzItde7tb3MO2DkkuZ2w7qP7m6', '2017-08-05 05:13:31', '2017-08-05 05:15:41'),
(4, 'Patientss', 1, 'patiesnt@gmail.com', '$2y$10$phmypAm3CGnJ1h8mSf6WSe7ZFo/uSj5XYw4jIcQyT4BpOQjWwM9fG', '01-08-2017', '98768889', 'Khushāb, Punjab, Pakistan', 2147483647, NULL, NULL, '788999999', '788999999', '', '', 'EL2xuDR6n0fVNXke7qwJyfU0me8RVnHgSXdNCBwxXv1TABzWb9bXtxPikmcC', '2017-08-05 05:50:28', '2017-08-05 05:50:36');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
