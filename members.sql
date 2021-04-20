-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-04-20 06:30:22
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `food`
--

-- --------------------------------------------------------

--
-- 資料表結構 `members`
--

CREATE TABLE `members` (
  `bid` int(8) NOT NULL,
  `acc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `addr` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `members`
--

INSERT INTO `members` (`bid`, `acc`, `pass`, `name`, `addr`) VALUES
(11, 'ruby', '123', '周芳妤', '歸綏街122號'),
(10, '122', '122', 'ruby', '12'),
(9, 'zxc', 'zxc', 'xzc', 'zcx'),
(8, '', '', 'asd', 'sad'),
(7, '123', '123', '', ''),
(12, '123', 'ad', 'ruby123', '12'),
(13, 'ads', 'ads', 'dsa', 'das'),
(14, 'ass', '', '周芳妤', '12'),
(15, 'asdasd', '', 'asdasd', 'asdsad'),
(16, 'asdasd', 'asdasd', '', 'vcxv'),
(17, 'ads', 'cxv', 'xv', 'xc'),
(18, '123', '123', '周芳妤', 'ads'),
(19, 'ruby', '123', '周芳妤', 'ads'),
(20, '022', '123', 'ruby', 'erek@21'),
(21, '022', '123', 'ruby', 'erek@21'),
(22, '022', '123', 'ruby', 'erek@21'),
(23, '123', '123', 'lili', 'erek@21'),
(24, '022', '123', 'lili', 'erek@21'),
(25, '022', '56', 'lili', 'erek@21');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`bid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `members`
--
ALTER TABLE `members`
  MODIFY `bid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
