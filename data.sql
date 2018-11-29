-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:8889
-- 生成日期： 2018-11-28 13:15:30
-- 服务器版本： 5.7.23
-- PHP 版本： 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 数据库： `user`
--

-- --------------------------------------------------------

--
-- 表的结构 `u_admin`
--

CREATE TABLE `u_admin` (
  `id` int(5) NOT NULL COMMENT '管理员id',
  `username` char(30) NOT NULL COMMENT '管理员名称',
  `password` char(40) NOT NULL COMMENT '管理员密码',
  `mpw` varchar(40) NOT NULL COMMENT '明文密码',
  `ip` varchar(255) NOT NULL COMMENT '最后登录ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `u_admin`
--

INSERT INTO `u_admin` (`id`, `username`, `password`, `mpw`, `ip`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', '::1');

-- --------------------------------------------------------

--
-- 表的结构 `u_crows`
--

CREATE TABLE `u_crows` (
  `id` bigint(20) NOT NULL COMMENT '记录id',
  `uid` bigint(20) NOT NULL COMMENT '用户id',
  `jf` varchar(20) NOT NULL DEFAULT '0' COMMENT '当前积分',
  `ymd` varchar(20) NOT NULL COMMENT '签到时间20180111'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `u_crows`
--

INSERT INTO `u_crows` (`id`, `uid`, `jf`, `ymd`) VALUES
(3, 32, '25', '20181126'),
(4, 30, '11', '20181126'),
(5, 30, '5', '20181128'),
(6, 36, '21', '20181128');

-- --------------------------------------------------------

--
-- 表的结构 `u_users`
--

CREATE TABLE `u_users` (
  `id` mediumint(9) NOT NULL COMMENT 'id号',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '用户密码',
  `integral` bigint(20) NOT NULL DEFAULT '20' COMMENT '用户积分',
  `zc_time` bigint(20) NOT NULL COMMENT '注册时间',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1男0女 默认 1',
  `ip` varchar(25) NOT NULL DEFAULT '0' COMMENT '用户最后登陆ip',
  `email` varchar(50) NOT NULL COMMENT '邮箱'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `u_users`
--

INSERT INTO `u_users` (`id`, `username`, `password`, `integral`, `zc_time`, `sex`, `ip`, `email`) VALUES
(33, 'ddd', 'ddd', 20, 1543366493, 0, '0', 'ddd@qq.com'),
(32, 'ccc', 'ccc', 24, 1543366446, 1, '::1', 'ccc@qq.com'),
(30, 'aaa11', 'aaa11', 4, 1543366416, 1, '::1', 'aaa11@qq.com'),
(31, 'bbb', 'bbb', 1, 1543366430, 0, '::1', 'bbb@qq.com'),
(34, 'eee', 'eee', 0, 1543370523, 0, '0', 'eee@qq.com'),
(35, 'fff', 'fff', 0, 1543370565, 0, '0', 'fff@qq.com'),
(36, 'chaodada', 'chaodada', 16, 1543380600, 1, '::1', 'chaodada@qq.com');

-- --------------------------------------------------------

--
-- 表的结构 `u_xiaos`
--

CREATE TABLE `u_xiaos` (
  `id` bigint(20) NOT NULL COMMENT '自增id',
  `uid` bigint(20) NOT NULL COMMENT '用户id',
  `jf` varchar(20) NOT NULL DEFAULT '0' COMMENT '当前积分',
  `ymd` varchar(10) NOT NULL COMMENT '消费时间20180111'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `u_xiaos`
--

INSERT INTO `u_xiaos` (`id`, `uid`, `jf`, `ymd`) VALUES
(2, 32, '29', '1543375510'),
(3, 32, '28', '1543375551'),
(4, 32, '27', '1543375627'),
(5, 32, '26', '1543375630'),
(6, 32, '25', '1543375641'),
(7, 32, '24', '1543375829'),
(8, 30, '10', '1543375956'),
(9, 30, '9', '1543375958'),
(10, 30, '8', '1543375960'),
(11, 30, '7', '1543376799'),
(12, 30, '6', '1543376970'),
(13, 30, '5', '1543376973'),
(14, 30, '4', '1543380134'),
(15, 30, '4', '1543380338'),
(16, 36, '20', '1543380738'),
(17, 36, '19', '1543380741'),
(18, 36, '18', '1543380743'),
(19, 36, '17', '1543380746'),
(20, 36, '16', '1543381225');

--
-- 转储表的索引
--

--
-- 表的索引 `u_admin`
--
ALTER TABLE `u_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 表的索引 `u_crows`
--
ALTER TABLE `u_crows`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `u_users`
--
ALTER TABLE `u_users`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `u_xiaos`
--
ALTER TABLE `u_xiaos`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `u_admin`
--
ALTER TABLE `u_admin`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '管理员id', AUTO_INCREMENT=18;

--
-- 使用表AUTO_INCREMENT `u_crows`
--
ALTER TABLE `u_crows`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '记录id', AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `u_users`
--
ALTER TABLE `u_users`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'id号', AUTO_INCREMENT=37;

--
-- 使用表AUTO_INCREMENT `u_xiaos`
--
ALTER TABLE `u_xiaos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=21;
