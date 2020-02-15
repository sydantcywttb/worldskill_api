-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 15 2020 г., 18:21
-- Версия сервера: 5.6.38
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `worldapi`
--

-- --------------------------------------------------------

--
-- Структура таблицы `theme_users`
--

CREATE TABLE `theme_users` (
  `id` int(11) NOT NULL,
  `created_at` varchar(64) NOT NULL DEFAULT '0',
  `updated_at` varchar(64) NOT NULL DEFAULT '0',
  `deleted_at` varchar(64) NOT NULL DEFAULT '0',
  `theme_id` varchar(64) NOT NULL,
  `login` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `theme_users`
--

INSERT INTO `theme_users` (`id`, `created_at`, `updated_at`, `deleted_at`, `theme_id`, `login`) VALUES
(1, '1581779778', '0', '0', '1', 'test'),
(2, '1581780015', '0', '0', '1', 'sdf');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `theme_users`
--
ALTER TABLE `theme_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `theme_users`
--
ALTER TABLE `theme_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
