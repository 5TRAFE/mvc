-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 06 2017 г., 23:59
-- Версия сервера: 5.5.50
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Eshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `url` varchar(200) NOT NULL,
  `count_goods` int(10) NOT NULL DEFAULT '0',
  `category_description` varchar(500) NOT NULL DEFAULT 'Без описания'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `category_name`, `parent_id`, `url`, `count_goods`, `category_description`) VALUES
(1, 'Компьютеры', 0, 'computers', 0, 'Без описания'),
(2, 'Ноутбуки', 1, 'notebooks', 0, 'Без описания'),
(6, 'Планшеты', 1, 'tablets', 0, 'Без описания'),
(8, 'Системные блоки', 1, 'system-blocks', 0, 'Без описания'),
(9, 'Lenovo', 2, 'lenovo', 0, 'Ноутбуки Lenovo'),
(10, 'asus', 2, 'asus', 0, 'Без описания'),
(11, 'Бытовая техника', 0, 'tech', 0, 'Без описания'),
(12, 'Планшет Lenovo', 6, 'tablets-lenovo', 0, 'Без описания'),
(13, 'Планшет asus', 6, 'tablets-asus', 0, 'Без описания'),
(14, 'Холодильники', 11, 'ice', 0, 'Без описания'),
(15, 'Мини-ноутбуки', 9, 'lenovo-mini-notes', 0, 'Без описания');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(20) NOT NULL,
  `product_name` varchar(200) NOT NULL DEFAULT 'Без имени',
  `category_id` int(20) NOT NULL DEFAULT '0',
  `alias` varchar(200) NOT NULL,
  `cost` int(20) NOT NULL DEFAULT '0',
  `product_description` varchar(500) NOT NULL DEFAULT 'Без описания',
  `img` varchar(300) NOT NULL DEFAULT '/default.jpg',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `product_name`, `category_id`, `alias`, `cost`, `product_description`, `img`, `date_create`) VALUES
(1, 'Asus super Note', 0, 'asus-es', 0, 'Без описания', '/default.jpg', '2017-09-04 12:43:37');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name_2` (`category_name`,`url`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
