-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2017 at 06:25 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_groups`
--

CREATE TABLE `blood_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blood_groups`
--

INSERT INTO `blood_groups` (`id`, `name`) VALUES
(1, 'A +'),
(2, 'A -'),
(3, 'B +'),
(4, 'B -'),
(5, 'AB +'),
(6, 'AB -'),
(7, 'O +'),
(8, 'O -');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`) VALUES
(1, 'Achham'),
(2, 'Arghakhanchi'),
(3, 'Baglung'),
(4, 'Baitadi'),
(5, 'Bajhang'),
(6, 'Bajura'),
(7, 'Banke'),
(8, 'Bara'),
(9, 'Bardiya'),
(10, 'Bhaktapur'),
(11, 'Bhojpur'),
(12, 'Chitwan'),
(13, 'Dadeldhura'),
(14, 'Dailekh'),
(15, 'Dang Deukhuri'),
(16, 'Darchula'),
(17, 'Dhading'),
(18, 'Dhankuta'),
(19, 'Dhanusa'),
(20, 'Dholkha'),
(21, 'Dolpa'),
(22, 'Doti'),
(23, 'Gorkha'),
(24, 'Gulmi'),
(25, 'Humla'),
(26, 'Ilam'),
(27, 'Jajarkot'),
(28, 'Jhapa'),
(29, 'Jumla'),
(30, 'Kailali'),
(31, 'Kalikot'),
(32, 'Kanchanpur'),
(33, 'Kapilvastu'),
(34, 'Kaski'),
(35, 'Kathmandu'),
(36, 'Kavrepalanchok'),
(37, 'Khotang'),
(38, 'Lalitpur'),
(39, 'Lamjung'),
(40, 'Mahottari'),
(41, 'Makwanpur'),
(42, 'Manang'),
(43, 'Morang'),
(44, 'Mugu'),
(45, 'Mustang'),
(46, 'Myagdi'),
(47, 'Nawalparasi'),
(48, 'Nuwakot'),
(49, 'Okhaldhunga'),
(50, 'Palpa'),
(51, 'Panchthar'),
(52, 'Parbat'),
(53, 'Parsa'),
(54, 'Pyuthan'),
(55, 'Ramechhap'),
(56, 'Rasuwa'),
(57, 'Rautahat'),
(58, 'Rolpa'),
(59, 'Rukum'),
(60, 'Rupandehi'),
(61, 'Salyan'),
(62, 'Sankhuwasabha'),
(63, 'Saptari'),
(64, 'Sarlahi'),
(65, 'Sindhuli'),
(66, 'Sindhupalchok'),
(67, 'Siraha'),
(68, 'Solukhumbu'),
(69, 'Sunsari'),
(70, 'Surkhet'),
(71, 'Syangja'),
(72, 'Tanahu'),
(73, 'Taplejung'),
(74, 'Terhathum'),
(75, 'Udayapur');

-- --------------------------------------------------------

--
-- Table structure for table `donation_histories`
--

CREATE TABLE `donation_histories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `donated_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `duration` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = active && 1 = inactive ',
  `remark` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `title`, `details`, `location`, `date`, `duration`, `status`, `remark`, `created_at`, `updated_at`) VALUES
(1, 2, 'free donation program', 'Available for everyone.', 'tokha', '2017-07-04', '9 AM  -  4 PM', 1, 'Postponed', '2017-07-03 11:16:35', '2017-07-03 05:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_01_13_063344_create_category_table', 1),
(2, '2017_01_13_063344_create_role_users_table', 1),
(3, '2017_01_13_063344_create_user_profiles_table', 1),
(4, '2017_01_13_063344_create_users_table', 1),
(5, '2017_01_13_063346_add_foreign_keys_to_role_users_table', 1),
(6, '2017_01_13_063346_add_foreign_keys_to_user_profiles_table', 1),
(7, '2017_06_29_165102_create_blood_groups_table', 0),
(8, '2017_06_29_165102_create_districts_table', 0),
(9, '2017_06_29_165102_create_donation_histories_table', 0),
(10, '2017_06_29_165102_create_events_table', 0),
(11, '2017_06_29_165102_create_notifications_table', 0),
(12, '2017_06_29_165102_create_role_users_table', 0),
(13, '2017_06_29_165102_create_status_users_table', 0),
(14, '2017_06_29_165102_create_statuses_table', 0),
(15, '2017_06_29_165102_create_user_profiles_table', 0),
(16, '2017_06_29_165102_create_users_table', 0),
(17, '2017_06_29_165105_add_foreign_keys_to_donation_histories_table', 0),
(18, '2017_06_29_165105_add_foreign_keys_to_events_table', 0),
(19, '2017_06_29_165105_add_foreign_keys_to_notifications_table', 0),
(20, '2017_06_29_165105_add_foreign_keys_to_role_users_table', 0),
(21, '2017_06_29_165105_add_foreign_keys_to_status_users_table', 0),
(22, '2017_06_29_165105_add_foreign_keys_to_user_profiles_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_status_id` int(11) NOT NULL COMMENT '1 = urgent / 0= not  urgent',
  `emergency_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `details`, `type`, `emergency_status_id`, `emergency_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'B+ blood required', 'For an operation, fresh blood is required.', NULL, 1, '2018-01-13', '2017-07-07 11:27:12', '2017-07-07 05:42:12'),
(2, 1, 'B+ blood required', 'For an operation, fresh blood is required.', NULL, 1, '2018-01-12', '2017-07-07 05:08:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`id`, `user_id`, `role`) VALUES
(1, 1, 1),
(9, 13, 1),
(10, 15, 1),
(11, 16, 1),
(12, 18, 1),
(13, 20, 1),
(14, 21, 1),
(15, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'shajish', 'ferimanandhar@gmail.com', 'shajish1', '2017-07-07 02:07:08', '2017-07-07 02:07:08'),
(13, 'japanika', 'Japanika.dongol@gmail.com', 'japanika1', '2017-07-07 05:53:34', NULL),
(15, 'anish', 'anishraj@gmail.com', 'chari', '2017-07-07 05:55:53', NULL),
(16, 'suman', 'suman@gmail.com', '$2y$10$zn0cxJharj93G17eoa9yueadATH1cRPWSBvyav7/7U.2BzT0Lx8nG', '2017-07-10 02:06:22', NULL),
(18, 'sudhir', 'sudhir@gmail.com', '$2y$10$P6qn57/9NTJBXjnftsUvl.YA6UFSm0bcw9Bil3KlXA73TP8XUC4BK', '2017-07-10 02:07:20', NULL),
(20, 'sudhir', 'sudhir1@gmail.com', '$2y$10$LQiI1nuVDJlXI/eSdZ17fuW1sGUTck0bZouZvVl1MpJ52ie1YC2l2', '2017-07-10 02:07:50', NULL),
(21, 'sudhir', 'sudhir12@gmail.com', '$2y$10$QMWU0xQaftPK8Q1MYDNUze27Inbp3RtGRykaHcyH0T2Xrqi00ihY6', '2017-07-10 02:08:58', NULL),
(23, 'shyam', 'shyam@gmail.com', '$2y$10$cKXtHtS1j7tJUfZxhsUzfufYHBt0klsGcza1tFVmwE3I.ETBBnwdi', '2017-07-13 10:37:54', '2017-07-13 10:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blood_group_id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `address1` int(11) NOT NULL,
  `address2` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `contacts` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `blood_group_id`, `name`, `address1`, `address2`, `age`, `gender`, `contacts`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Shajish Mananadhar', 35, 'Manamaiju', 0, '', '9843672889', 0, '2017-07-11 01:42:09', '2017-07-10 19:57:09'),
(2, 13, 4, 'Japanika Maharjan', 38, 'tyagal', 0, '', '9841399009', 1, '2017-07-07 11:38:34', NULL),
(3, 15, 4, 'Anish Raj Karnikar', 35, 'maru', 0, '', '9834092345', 1, '2017-07-07 11:40:53', NULL),
(4, 16, 4, 'suman Manandhar', 35, 'manamaiju', 0, '', '9834092389', 1, '2017-07-10 07:51:22', NULL),
(5, 18, 4, 'sudhir Manandhar', 35, 'manamaiju', 0, '', '9834092389', 1, '2017-07-10 07:52:20', NULL),
(6, 20, 4, 'sudhir Manandhar', 35, 'manamaiju', 0, '', '9834092389', 1, '2017-07-10 07:52:50', NULL),
(7, 21, 4, 'sudhir Manandhar', 35, 'manamaiju', 0, '', '9834092389', 1, '2017-07-10 07:53:58', NULL),
(8, 23, 4, 'shyam Maharjan', 35, 'manamaiju', 40, 'male', '9813667724', 1, '2017-07-13 10:37:55', '2017-07-13 10:37:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_groups`
--
ALTER TABLE `blood_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_histories`
--
ALTER TABLE `donation_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oneusercanhaveoneprofile` (`user_id`),
  ADD KEY `multiplecategoriespossible` (`blood_group_id`),
  ADD KEY `address1` (`address1`),
  ADD KEY `address1_2` (`address1`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_groups`
--
ALTER TABLE `blood_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `donation_histories`
--
ALTER TABLE `donation_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `donation_histories`
--
ALTER TABLE `donation_histories`
  ADD CONSTRAINT `donation_histories_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_profiles_ibfk_2` FOREIGN KEY (`blood_group_id`) REFERENCES `blood_groups` (`id`),
  ADD CONSTRAINT `user_profiles_ibfk_3` FOREIGN KEY (`address1`) REFERENCES `districts` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
