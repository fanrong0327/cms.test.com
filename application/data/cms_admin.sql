-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 05 月 07 日 12:15
-- 服务器版本: 5.5.30-log
-- PHP 版本: 5.3.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `cms_admin`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_action`
--

CREATE TABLE IF NOT EXISTS `admin_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `icon` varchar(10) NOT NULL,
  `title` varchar(20) NOT NULL,
  `target` varchar(50) NOT NULL,
  `verify` varchar(30) NOT NULL,
  `display` enum('yes','no') NOT NULL DEFAULT 'no',
  `orderby` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `orderby` (`orderby`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- 转存表中的数据 `admin_action`
--

INSERT INTO `admin_action` (`id`, `pid`, `icon`, `title`, `target`, `verify`, `display`, `orderby`) VALUES
(1, 0, 'lab.png', '操作集合', 'javascript:;', '', 'yes', 0),
(2, 1, '0', '修改操作', '/cms/action/edit', 'ACTION_EDIT', 'no', 2),
(3, 1, '0', '添加操作', '/cms/action/add', 'ACTION_ADD', 'yes', 3),
(11, 0, 'role.png', '角色管理', 'javascript:;', '', 'yes', 5),
(12, 11, '0', '添加角色', '/cms/role/add', 'ROLE_ADD', 'yes', 2),
(13, 1, '0', '操作列表', '/cms/action/index', 'ACTION_LIST', 'yes', 1),
(14, 11, '0', '角色列表', '/cms/role/index', 'ROLE_LIST', 'yes', 1),
(15, 11, '0', '编辑角色', '/cms/role/edit', 'ROLE_EDIT', 'no', 3),
(16, 0, 'inbox.png', '控制面板', '/cms/index', '', 'yes', -10),
(17, 16, '0', '控制面板', '', 'ADMIN_INDEX', 'no', 1),
(36, 1, '0', '删除操作', '/cms/action/delete', 'ACTION_DELETE', 'no', 5),
(39, 11, '0', '删除角色', '/cms/role/delete', 'ROLE_DELETE', 'no', 4);

-- --------------------------------------------------------

--
-- 表的结构 `admin_role`
--

CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `act` text NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `admin_role`
--

INSERT INTO `admin_role` (`id`, `name`, `act`) VALUES
(1, '管理员', 'a:9:{i:0;s:2:"17";i:1;s:2:"13";i:2;s:1:"2";i:3;s:1:"3";i:4;s:2:"36";i:5;s:2:"14";i:6;s:2:"12";i:7;s:2:"15";i:8;s:2:"39";}'),
(2, '广告投放员', 'a:5:{i:0;s:2:"17";i:1;s:2:"13";i:2;s:1:"2";i:3;s:2:"14";i:4;s:2:"15";}');

-- --------------------------------------------------------

--
-- 表的结构 `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `admin_user`
--

INSERT INTO `admin_user` (`id`, `uid`, `rid`) VALUES
(1, 100, 1),
(2, 101, 2);

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `uname` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`uname`, `email`) VALUES
('', ''),
('aaa', '545995309@qq.com'),
('aaab', '545995309@qq.com'),
('bbb', 'luchanghong1990@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
