-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018-07-19 18:32:32
-- 服务器版本： 5.5.56-log
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(10) unsigned NOT NULL,
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `notice` varchar(225) NOT NULL DEFAULT '',
  `year` int(4) NOT NULL DEFAULT '2018',
  `mon` int(2) NOT NULL DEFAULT '6',
  `data` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `data`
--

INSERT INTO `data` (`id`, `user_name`, `notice`, `year`, `mon`, `data`) VALUES
(1, '周树成', '', 2018, 6, 'VpcZf1HxSWfLVlEFZn7Elsbh3UWTp+t3ztVlEQ++3EUlE5Y2RFbY/ccSrtvtX8fhLasl0EOO/qCwy1gwttfJlusYD/EJmhJpkiDfKmzCLqw0085RIfxpklA6c4GzVdJ2tlOQFIRX5r0dhhNl3O83gta8nq/KLpqFhKidlAi885x5231ofNw2a7dhdL/N2+C7dSGSoy3IrqgQiaP7YEm4Wct1pmQHUU9CS+1b3M+fH3HuxGmqS0lf+t3b0W7SDuwpqYOGAXfxd/tsGzcPPcaaDXt5cca7wtukSIbNT839ImiXqJ5Wnwt8ETGVr8Ewa1W8WEgqWUYd2FddLhucDISwhA==');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `salt` varchar(6) NOT NULL DEFAULT '',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `type` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_name`, `password`, `salt`, `update_time`, `type`) VALUES
('admin', 'd382669017f9e56f9f35185ff8d196b4742efce3', 'oafaXL', 1529329350, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_name`,`year`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=115;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
