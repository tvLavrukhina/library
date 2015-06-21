-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 19 2015 г., 23:46
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `book`
--

-- --------------------------------------------------------

--
-- Структура таблицы `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `login` varchar(15) NOT NULL,
  `password` varchar(150) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `login`
--

INSERT INTO `login` (`login`, `password`) VALUES
('opo', 'kkk'),
('pit', '202cb962ac59075b964b07152d234b70'),
('pity', '123'),
('user', 'caf1a3dfb505ffed0d024130f58c5cfa');

-- --------------------------------------------------------

--
-- Структура таблицы `mybooks`
--

CREATE TABLE IF NOT EXISTS `mybooks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET cp1251 NOT NULL,
  `author` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `cover` varchar(100) NOT NULL,
  `download` varchar(100) NOT NULL,
  `permission` varchar(2) NOT NULL,
  `login` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `mybooks`
--

INSERT INTO `mybooks` (`id`, `title`, `author`, `date`, `cover`, `download`, `permission`, `login`) VALUES
(15, 'Chrisanthemum', 'Ivanov P.', '2015-05-12', 'Chrysanthemum.jpg', 'BOOK1.pdf', '1', 'pit'),
(16, 'Desert', 'Petrov K.', '2015-05-04', 'Desert.jpg', 'book2.pdf', '0', 'pit'),
(17, 'Hydrangeas', 'Jamsa K.', '2015-05-06', 'Hydrangeas.jpg', 'book3.pdf', '1', 'pit'),
(18, 'Jelly', 'Sidorov O.', '2015-05-30', 'Jellyfish.jpg', 'booK4.pdf', '0', 'pit'),
(19, 'Коала', 'Perov O.', '2015-05-31', '1434651766Koala.jpg', '', '0', 'pit'),
(20, 'Lighthouse', 'Hyttrop O.', '2015-04-27', 'Lighthouse.jpg', '26.pdf', '1', 'pit'),
(21, 'Пингвины', 'Акопян П', '2015-05-31', '1434572475Penguins.jpg', '1434572475ЛАВРУХИНА_1.docx', '1', 'pit'),
(27, 'Основы чего-либо', 'Андрейченко П.Г.', '2015-06-10', '143456702917.jpg', '1434567029123.pdf', '1', 'user'),
(28, 'Тюльпаны', 'Акопян Е.', '2015-06-02', '1434567168Tulips.jpg', '1434567168123.pdf', '1', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
