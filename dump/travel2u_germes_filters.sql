-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 17 2014 г., 17:05
-- Версия сервера: 5.6.12-log
-- Версия PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `travel2u_germes`
--
CREATE DATABASE IF NOT EXISTS `travel2u_germes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `travel2u_germes`;

-- --------------------------------------------------------

--
-- Структура таблицы `tp_filter_cost`
--

CREATE TABLE IF NOT EXISTS `tp_filter_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Фильтр стоимости' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tp_filter_flight`
--

CREATE TABLE IF NOT EXISTS `tp_filter_flight` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Фильтр по времени перелета' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tp_filter_popularity`
--

CREATE TABLE IF NOT EXISTS `tp_filter_popularity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Фильтр популярности' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tp_filter_type`
--

CREATE TABLE IF NOT EXISTS `tp_filter_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Тип отдыха' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
