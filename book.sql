-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 10 2015 г., 16:39
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `mybooks`
--

INSERT INTO `mybooks` (`id`, `title`, `author`, `date`, `cover`, `download`, `permission`) VALUES
(15, 'Chrisanthemum', 'Ivanov P.', '2015-05-12', 'Chrysanthemum.jpg', 'BOOK1.pdf', '1'),
(16, 'Desert', 'Petrov K.', '2015-05-04', 'Desert.jpg', 'book2.pdf', '0'),
(17, 'Hydrangeas', 'Jamsa K.', '2015-05-06', 'Hydrangeas.jpg', 'book3.pdf', '1'),
(18, 'Jelly', 'Sidorov O.', '2015-05-30', 'Jellyfish.jpg', 'booK4.pdf', '1'),
(19, 'Koala', 'Perov O.', '2015-05-31', 'Koala.jpg', 'bookk5.pdf', '1'),
(20, 'Lighthouse', 'Hyttrop O.', '2015-04-27', 'Lighthouse.jpg', '26.pdf', '1'),
(21, 'Penhuins', 'Acopyan F.', '2015-06-01', 'Penguins.jpg', 'book.pdf', '0'),
(22, 'Tulips', 'Acopyan F. R.', '2015-06-02', 'Tulips.jpg', '23290 - ', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
