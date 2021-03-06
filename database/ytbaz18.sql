-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 22, 2017 at 01:11 PM
-- Server version: 5.6.30-1+deb.sury.org~wily+2
-- PHP Version: 5.6.11-1ubuntu3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ytbaz18`
--

-- --------------------------------------------------------

--
-- Table structure for table `counter_ips`
--

CREATE TABLE `counter_ips` (
  `ip` varchar(15) NOT NULL,
  `smart_link_id` int(11) DEFAULT NULL,
  `visit` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `counter_ips`
--

INSERT INTO `counter_ips` (`ip`, `smart_link_id`, `visit`) VALUES
('127.0.0.1', 1, 1503369371);

-- --------------------------------------------------------

--
-- Table structure for table `counter_values`
--

CREATE TABLE `counter_values` (
  `id` bigint(11) NOT NULL,
  `smart_link_id` int(11) DEFAULT NULL,
  `day_id` bigint(11) NOT NULL,
  `day_value` bigint(11) NOT NULL,
  `all_value` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `counter_values`
--

INSERT INTO `counter_values` (`id`, `smart_link_id`, `day_id`, `day_value`, `all_value`) VALUES
(1, 1, 233, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `member_money`
--

CREATE TABLE `member_money` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `money` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `value` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(145, 'time_expires', '600', '2017-08-22 00:00:00', '2017-08-22 05:15:51'),
(146, 'ignore_ips', '127.0.0.1,127.0.0.2', '2017-08-22 00:00:00', '2017-08-22 05:15:52'),
(147, 'cpa_traffic', '1.9', '2017-08-22 00:00:00', '2017-08-22 05:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `smart_link`
--

CREATE TABLE `smart_link` (
  `id` int(11) NOT NULL,
  `smart_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smart_link`
--

INSERT INTO `smart_link` (`id`, `smart_link`) VALUES
(1, 'http://www.faptubes.mobi/?sl=2115228-a7b5e&data1=Track1&data2=Track2'),
(2, 'http://www.contentformen.mobi/?sl=2115229-86a1d&data1=Track1&data2=Track2'),
(3, 'http://www.girlsvideosonline.info/?sl=2115230-a5146&data1=Track1&data2=Track2'),
(4, 'http://www.videosondemand.online/?sl=2115344-0cb20&data1=Track1&data2=Track2'),
(5, 'http://www.allurevideos.info/?sl=2115232-a5b5a&data1=Track1&data2=Track2'),
(6, 'http://www.faptubes.mobi/?sl=2179419-53386&data1=Track1&data2=Track2'),
(7, 'http://www.contentformen.mobi/?sl=2179420-ff97f&data1=Track1&data2=Track2'),
(8, 'http://www.girlsvideosonline.info/?sl=2179421-4fcbe&data1=Track1&data2=Track2'),
(9, 'http://www.allurevideos.info/?sl=2179422-02f6c&data1=Track1&data2=Track2'),
(10, 'http://www.videosondemand.online/?sl=2179423-ae3a1&data1=Track1&data2=Track2'),
(11, 'http://www.faptubes.mobi/?sl=2179426-6fb98&data1=Track1&data2=Track2'),
(12, 'http://www.contentformen.mobi/?sl=2179427-e1a32&data1=Track1&data2=Track2'),
(13, 'http://www.girlsvideosonline.info/?sl=2179428-d62ef&data1=Track1&data2=Track2'),
(14, 'http://www.allurevideos.info/?sl=2179429-2e57d&data1=Track1&data2=Track2'),
(15, 'http://www.videosondemand.online/?sl=2179430-376d6&data1=Track1&data2=Track2'),
(16, 'http://www.amazingvideos.mobi/?sl=1893494-81744&data1=Track1&data2=Track2'),
(17, 'http://www.amazingvideos.mobi/?sl=1893494-81744&data1=Track1&data2=Track2'),
(18, 'http://www.amazingvideos.mobi/?sl=1893494-81744&data1=Track1&data2=Track2'),
(19, 'http://www.amazingvideos.mobi/?sl=1893494-81744&data1=Track1&data2=Track2'),
(20, 'http://www.girlsvideosonline.info/?sl=2204334-00110&data1=Track1&data2=Track2'),
(21, 'http://www.faptubes.mobi/?sl=2213937-23e75&data1=Track1&data2=Track2'),
(22, 'http://www.contentformen.mobi/?sl=2213938-2b136&data1=Track1&data2=Track2'),
(23, 'Http://abc.comssssfff');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `smart_link_id` int(11) DEFAULT NULL,
  `changed_password` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`, `role`, `status`, `smart_link_id`, `changed_password`, `remember_token`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
(1, 'Phan Ngọc', 'phanngoc', 'phanngoc@gmail.com', '$2y$10$O/qiniHWHa25C4VabL5OuOQacso0rhboRZsXveIDM4lCwS/KdSPLC', 1, 1, NULL, 0, NULL, 1, 1, '2017-06-02 00:00:00', '2017-08-22 01:37:19'),
(2, 'Member 1', 'member_1', 'member_1@gmail.com', '$2y$10$yWjAxrwUtwCJd7r5DzPB9uIvqCsy4lmFIdA8XIfoFJwy5p3vnoh/m', 3, 1, 1, 0, NULL, 1, 1, '2017-08-22 01:36:11', '2017-08-22 01:37:39'),
(3, 'Member 2', 'member_2', 'member_2@gmail.com', '$2y$10$7IxeY/i3mbcYZAiF4plwL.ngYXg4/cirCfoWoUYNGD3ToCT20EM4.', 3, 1, 2, 0, NULL, 1, 1, '2017-08-22 01:36:11', '2017-08-22 01:37:39'),
(4, 'Member 3', 'member_3', 'member_3@gmail.com', '$2y$10$FbQAk4uq8UjXldnDVool7OpvSfJLAsiUPXHh/2IPHQ7eWSbwExx3i', 3, 1, 3, 0, NULL, 1, 1, '2017-08-22 01:36:11', '2017-08-22 01:37:39'),
(5, 'Member 4', 'member_4', 'member_4@gmail.com', '$2y$10$E3FFY4sXxfJqgMRhGqT40.FkchdrIppGydq.GRMyjv9Zw4tnRDiLe', 3, 1, 4, 0, NULL, 1, 1, '2017-08-22 01:36:11', '2017-08-22 01:37:39'),
(6, 'Member 5', 'member_5', 'member_5@gmail.com', '$2y$10$Z7nt02n0i33hh/EKv0TPYuzh1.Ly.D3cgkQ5obw3lHkdyR.LIugge', 3, 1, 5, 0, NULL, 1, 1, '2017-08-22 01:36:11', '2017-08-22 01:37:39'),
(7, 'Member 6', 'member_6', 'member_6@gmail.com', '$2y$10$dW.JXywxkEwGBNtgaJu5KOCbnAMd3g4jJcfhvcsIjmcwyRXU2CsLK', 3, 1, 6, 0, NULL, 1, 1, '2017-08-22 01:36:11', '2017-08-22 01:37:39'),
(8, 'Member 7', 'member_7', 'member_7@gmail.com', '$2y$10$pSHgq/g5pS8sdvhPayFNcO4WQF.lGv/69X0PymsZK88R0ogcVFJ.K', 3, 1, 7, 0, NULL, 1, 1, '2017-08-22 01:36:12', '2017-08-22 01:37:39'),
(9, 'Member 8', 'member_8', 'member_8@gmail.com', '$2y$10$mUZ894LXvx4ToRjZpb25y.u5ghTi9bIQqAgRPiqupBVorB/gcXgxa', 3, 1, 8, 0, NULL, 1, 1, '2017-08-22 01:36:12', '2017-08-22 01:37:39'),
(10, 'Member 9', 'member_9', 'member_9@gmail.com', '$2y$10$DlvkYauz7m6ZLxIuw2t1W.Rq921yeKpgL.WeIAr3P7d3G5M4XTrCC', 3, 1, 9, 0, NULL, 1, 1, '2017-08-22 01:36:12', '2017-08-22 01:37:39'),
(11, 'Member 10', 'member_10', 'member_10@gmail.com', '$2y$10$zP7A2qtfrJNGUB5fWHAJAOT.at7AJ29seZ2AHbYdiqe8FaHYp.14W', 3, 1, 10, 0, NULL, 1, 1, '2017-08-22 01:36:12', '2017-08-22 01:37:39'),
(12, 'Member 11', 'member_11', 'member_11@gmail.com', '$2y$10$ah/Bg86.YoOO.bYK.YYjOepQW1Fnh.lyv2Qg/wJRMi5DKlu.D.dmu', 3, 1, 11, 0, NULL, 1, 1, '2017-08-22 01:36:12', '2017-08-22 01:37:39'),
(13, 'Member 12', 'member_12', 'member_12@gmail.com', '$2y$10$wNrrRgXJkcGgqs3XzXP88eqqEAp5M8x58YWVQvvQ6DqRZ0KI5dShy', 3, 1, 12, 0, NULL, 1, 1, '2017-08-22 01:36:12', '2017-08-22 01:37:39'),
(14, 'Member 13', 'member_13', 'member_13@gmail.com', '$2y$10$8SfsoT9FpeAX4ZhL6kFyue5Ln0sMqP95NGVlLpB1DhzqL6dY4Kd1y', 3, 1, 13, 0, NULL, 1, 1, '2017-08-22 01:36:12', '2017-08-22 01:37:39'),
(15, 'Member 14', 'member_14', 'member_14@gmail.com', '$2y$10$Xcl5Y0EM.Bw/EPgRkXc5b.Lk1N.4wNqdcYUJKaKP413gr4Mwy7xAG', 3, 1, 14, 0, NULL, 1, 1, '2017-08-22 01:36:12', '2017-08-22 01:37:39'),
(16, 'Member 15', 'member_15', 'member_15@gmail.com', '$2y$10$jkJN5g8DYiC5V/KEeYbtn.vl/TgaAD5n0bt5vFJk7S4QDtCIhN0rG', 3, 1, 15, 0, NULL, 1, 1, '2017-08-22 01:36:12', '2017-08-22 01:37:39'),
(17, 'Member 16', 'member_16', 'member_16@gmail.com', '$2y$10$bCBjgUX/kUYQ6aWZfyltO.IyoCS3BANL1TF3o3RrmglZe4MYk0rRe', 3, 1, 16, 0, NULL, 1, 1, '2017-08-22 01:36:12', '2017-08-22 01:37:39'),
(18, 'Member 17', 'member_17', 'member_17@gmail.com', '$2y$10$9dCZI4ybCD6N8R/Nua.hX.4isGQu.dkr/vJPz/fWOo9pG7TMo6fnW', 3, 1, 17, 0, NULL, 1, 1, '2017-08-22 01:36:12', '2017-08-22 01:37:39'),
(19, 'Member 18', 'member_18', 'member_18@gmail.com', '$2y$10$4ZQymbqJKZSpFM5cYcfi9./BKmOySTeZ6MAmFmvLt.y3764Uzsbvm', 3, 1, 18, 0, NULL, 1, 1, '2017-08-22 01:36:13', '2017-08-22 01:37:39'),
(20, 'Member 19', 'member_19', 'member_19@gmail.com', '$2y$10$1MTG5b8uL1yltTjBUMknE.sG9.6tHQW9M2veBzHD.D4bzZtfVr7Ky', 3, 1, 19, 0, NULL, 1, 1, '2017-08-22 01:36:13', '2017-08-22 01:37:39'),
(21, 'Member 20', 'member_20', 'member_20@gmail.com', '$2y$10$XSUoYCdsO/wwEy2ijKMVO.gX7bBmfGIb95Ts.LDMe4qJTmDo1s7Ta', 3, 1, 20, 0, NULL, 1, 1, '2017-08-22 01:36:13', '2017-08-22 01:37:39'),
(22, 'Member 21', 'member_21', 'member_21@gmail.com', '$2y$10$cIo3l3jLmg9JsA1JOs.WrunuVuemKNHwicAF5chqlSEPliil21OZi', 3, 1, 21, 0, NULL, 1, 1, '2017-08-22 01:36:13', '2017-08-22 01:37:39'),
(23, 'Member 22', 'member_22', 'member_22@gmail.com', '$2y$10$MvhNpYNyggoxnStRK7WtG.un6TkSWgSqBM0SH7hgtTxqbqbKygfdq', 3, 1, 22, 0, NULL, 1, 1, '2017-08-22 01:36:13', '2017-08-22 01:37:39'),
(24, 'Mod', 'mod', 'mod@gmail.com', '$2y$10$O/qiniHWHa25C4VabL5OuOQacso0rhboRZsXveIDM4lCwS/KdSPLC', 2, 1, NULL, 0, NULL, 1, 1, '2017-08-22 00:00:00', '2017-08-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_bank`
--

CREATE TABLE `user_bank` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_no` varchar(50) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_history`
--

CREATE TABLE `withdraw_history` (
  `id` int(11) NOT NULL,
  `money` float DEFAULT NULL,
  `money_request` float DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 : request 2 : sent',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counter_ips`
--
ALTER TABLE `counter_ips`
  ADD UNIQUE KEY `ip` (`ip`,`smart_link_id`),
  ADD KEY `film_id_2` (`smart_link_id`);

--
-- Indexes for table `counter_values`
--
ALTER TABLE `counter_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `film_id` (`smart_link_id`),
  ADD KEY `film_id_2` (`smart_link_id`);

--
-- Indexes for table `member_money`
--
ALTER TABLE `member_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `option_name` (`name`) USING BTREE;

--
-- Indexes for table `smart_link`
--
ALTER TABLE `smart_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bank`
--
ALTER TABLE `user_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_history`
--
ALTER TABLE `withdraw_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `counter_values`
--
ALTER TABLE `counter_values`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `member_money`
--
ALTER TABLE `member_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT for table `smart_link`
--
ALTER TABLE `smart_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user_bank`
--
ALTER TABLE `user_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `withdraw_history`
--
ALTER TABLE `withdraw_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
