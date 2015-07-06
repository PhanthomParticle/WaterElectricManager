-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-07-06 02:44:26
-- 服务器版本： 5.1.63
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `powersystem`
--
DROP DATABASE `powersystem`;
CREATE DATABASE IF NOT EXISTS `powersystem` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `powersystem`;

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `loginname` varchar(36) NOT NULL,
  `name` varchar(36) NOT NULL,
  `password` varchar(32) NOT NULL,
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `level` int(1) NOT NULL,
  `state` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `loginname`, `name`, `password`, `createtime`, `level`, `state`) VALUES
(1, 'admin', '超级管理员', '21232f297a57a5a743894a0e4a801fc3', '2015-06-20 04:14:55', 2, 1),
(3, 'cash1', 'cash1', 'bf3b7590dd1066229b44b1c780b08056', '2015-07-04 03:04:27', 7, 1),
(4, 'card1', 'card1', '15196325a32fe8deef7514ca816487db', '2015-07-04 03:08:31', 6, 1),
(5, 'wage1', 'wage1', '48dc95042b97436842c08763da1763a8', '2015-07-04 03:08:48', 5, 1),
(6, 'up1', 'up2', '466156636cca7281fb9ee38fa85f199d', '2015-07-04 03:09:06', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `deposit`
--

DROP TABLE IF EXISTS `deposit`;
CREATE TABLE IF NOT EXISTS `deposit` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `uid` varchar(36) NOT NULL,
  `money` int(9) NOT NULL,
  `ispay` int(1) NOT NULL,
  `isback` int(1) NOT NULL,
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paytime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `backtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `deposit`
--

INSERT INTO `deposit` (`id`, `uid`, `money`, `ispay`, `isback`, `createtime`, `paytime`, `backtime`) VALUES
(1, 'DF70B621-9DB0-48EC-E3D3-86A0BBC45260', 12, 0, 0, '2015-07-03 08:27:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'DF70B621-9DB0-48EC-E3D3-86A0BBC45260', 20, 0, 0, '2015-07-03 08:58:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `electric`
--

DROP TABLE IF EXISTS `electric`;
CREATE TABLE IF NOT EXISTS `electric` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(36) NOT NULL,
  `uid` varchar(36) NOT NULL,
  `rate` int(4) NOT NULL,
  `note` varchar(36) DEFAULT NULL,
  `init` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `electric`
--

INSERT INTO `electric` (`id`, `name`, `uid`, `rate`, `note`, `init`) VALUES
(1, '36栋1', 'A796E15E-DE10-6E17-D67F-C8588336A085', 1, '电表好烂了', 100),
(2, '36栋2', 'A796E15E-DE10-6E17-D67F-C8588336A085', 2, '地方', 23),
(3, '122', 'A796E15E-DE10-6E17-D67F-C8588336A085', 2, 'hkjhkj', 135),
(4, '213', 'A796E15E-DE10-6E17-D67F-C8588336A085', 14, 'fvfv', 1),
(6, '1', 'DF70B621-9DB0-48EC-E3D3-86A0BBC45260', 1, 'hu', 10);

-- --------------------------------------------------------

--
-- 表的结构 `eprice`
--

DROP TABLE IF EXISTS `eprice`;
CREATE TABLE IF NOT EXISTS `eprice` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(36) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `eprice`
--

INSERT INTO `eprice` (`id`, `name`, `price`) VALUES
(1, '民用电价', '0.60'),
(2, '商用电价', '1.20');

-- --------------------------------------------------------

--
-- 表的结构 `evalue`
--

DROP TABLE IF EXISTS `evalue`;
CREATE TABLE IF NOT EXISTS `evalue` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `uid` varchar(36) NOT NULL,
  `date` varchar(10) NOT NULL,
  `eid` int(9) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rate` int(6) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `pvalue` int(6) NOT NULL,
  `cvalue` int(6) NOT NULL,
  `state` int(1) NOT NULL,
  `updatetime` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `evalue`
--

INSERT INTO `evalue` (`id`, `uid`, `date`, `eid`, `time`, `rate`, `price`, `pvalue`, `cvalue`, `state`, `updatetime`) VALUES
(1, 'A796E15E-DE10-6E17-D67F-C8588336A085', '2015-06', 1, '2015-06-21 15:42:08', 1, '0.60', 100, 1109, 0, NULL),
(2, 'A796E15E-DE10-6E17-D67F-C8588336A085', '2015-06', 2, '2015-06-21 15:42:08', 2, '0.60', 23, 121, 0, NULL),
(3, 'A796E15E-DE10-6E17-D67F-C8588336A085', '2015-06', 4, '2015-06-24 08:35:05', 14, '0.60', 1, 12, 0, NULL),
(4, 'A796E15E-DE10-6E17-D67F-C8588336A085', '2015-06', 3, '2015-06-25 09:33:32', 2, '0.60', 135, 3, 0, NULL),
(5, 'A796E15E-DE10-6E17-D67F-C8588336A085', '2015-07', 1, '2015-07-02 15:33:19', 1, '0.60', 1109, 1110, 0, NULL),
(6, 'DF70B621-9DB0-48EC-E3D3-86A0BBC45260', '2015-07', 6, '2015-07-03 04:25:50', 1, '0.60', 10, 15, 0, NULL),
(7, 'DF70B621-9DB0-48EC-E3D3-86A0BBC45260', '2015-07', 6, '2015-07-03 05:08:17', 1, '0.60', 15, 16, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `uid` varchar(36) NOT NULL,
  `area` varchar(4) NOT NULL,
  `wage` varchar(10) DEFAULT NULL,
  `name` varchar(12) NOT NULL,
  `address` varchar(36) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `note` varchar(36) DEFAULT NULL,
  `type` int(1) NOT NULL,
  `state` int(1) NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `eprice` decimal(8,2) NOT NULL,
  `wprice` decimal(8,2) NOT NULL,
  `createtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `uid`, `area`, `wage`, `name`, `address`, `phone`, `note`, `type`, `state`, `updatetime`, `eprice`, `wprice`, `createtime`) VALUES
(4, 'A796E15E-DE10-6E17-D67F-C8588336A085', '36', '1325466', '蓝先生', '北区36栋一单元6021', '0797-569552', '哈哈哈哈', 1, 1, '2015-07-03 06:16:10', '0.11', '1.30', '2015-06-20 10:12:01'),
(5, 'DF70B621-9DB0-48EC-E3D3-86A0BBC45260', '37', '123457', '蓝女士', '37栋三单元708', '18720960078', '那就id萨芬娜', 3, 1, '2015-07-02 14:52:20', '0.60', '0.60', '2015-06-20 10:13:03');

-- --------------------------------------------------------

--
-- 表的结构 `water`
--

DROP TABLE IF EXISTS `water`;
CREATE TABLE IF NOT EXISTS `water` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `uid` varchar(36) NOT NULL,
  `name` varchar(36) NOT NULL,
  `note` varchar(36) DEFAULT NULL,
  `init` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `water`
--

INSERT INTO `water` (`id`, `uid`, `name`, `note`, `init`) VALUES
(1, 'A796E15E-DE10-6E17-D67F-C8588336A085', '36栋1', '哈哈哈哈', 12),
(2, 'A796E15E-DE10-6E17-D67F-C8588336A085', '36栋3', '没用了', 300),
(4, 'DF70B621-9DB0-48EC-E3D3-86A0BBC45260', '2', 'hah', 10);

-- --------------------------------------------------------

--
-- 表的结构 `wprice`
--

DROP TABLE IF EXISTS `wprice`;
CREATE TABLE IF NOT EXISTS `wprice` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(36) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `wprice`
--

INSERT INTO `wprice` (`id`, `name`, `price`) VALUES
(1, '民用水价', '0.60'),
(2, '商用水价', '1.30');

-- --------------------------------------------------------

--
-- 表的结构 `wvalue`
--

DROP TABLE IF EXISTS `wvalue`;
CREATE TABLE IF NOT EXISTS `wvalue` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `uid` varchar(36) NOT NULL,
  `date` varchar(10) NOT NULL,
  `wid` int(9) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `pvalue` int(6) NOT NULL,
  `cvalue` int(6) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` int(1) NOT NULL,
  `updatetime` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `wvalue`
--

INSERT INTO `wvalue` (`id`, `uid`, `date`, `wid`, `price`, `pvalue`, `cvalue`, `time`, `state`, `updatetime`) VALUES
(1, 'A796E15E-DE10-6E17-D67F-C8588336A085', '2015-06', 1, '0.60', 12, 130, '2015-06-21 15:42:08', 0, NULL),
(2, 'A796E15E-DE10-6E17-D67F-C8588336A085', '2015-06', 2, '0.60', 300, 140, '2015-06-21 15:42:08', 0, NULL),
(3, 'DF70B621-9DB0-48EC-E3D3-86A0BBC45260', '2015-07', 4, '0.60', 10, 16, '2015-07-03 04:25:50', 0, NULL),
(4, 'DF70B621-9DB0-48EC-E3D3-86A0BBC45260', '2015-07', 4, '0.60', 16, 17, '2015-07-03 05:08:17', 0, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
