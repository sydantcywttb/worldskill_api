-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 21 2020 г., 20:58
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
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `created_at` varchar(64) NOT NULL DEFAULT '0',
  `updated_at` varchar(64) NOT NULL DEFAULT '0',
  `deleted_at` varchar(64) NOT NULL DEFAULT '0',
  `owner_login` varchar(64) NOT NULL,
  `content` varchar(1024) NOT NULL,
  `qu_content` varchar(1024) NOT NULL,
  `parent_id` varchar(64) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `created_at`, `updated_at`, `deleted_at`, `owner_login`, `content`, `qu_content`, `parent_id`) VALUES
(1, '1581774416', '1581776686', '0', 'test', 'hello2', '', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `created_at` varchar(64) NOT NULL DEFAULT '0',
  `updated_at` varchar(64) NOT NULL DEFAULT '0',
  `deleted_at` varchar(64) NOT NULL DEFAULT '0',
  `owner_login` varchar(64) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` varchar(512) NOT NULL,
  `parent_id` varchar(64) NOT NULL,
  `type` varchar(64) NOT NULL DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `created_at`, `updated_at`, `deleted_at`, `owner_login`, `title`, `content`, `parent_id`, `type`) VALUES
(1, '1581773522', '1581778370', '0', 'test', 'theme terer1', 'xcvsd fsdf sdf sdf', '7', 'info');

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

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `created_at` varchar(12) NOT NULL DEFAULT '0',
  `updated_at` varchar(12) NOT NULL DEFAULT '0',
  `deleted_at` varchar(12) NOT NULL DEFAULT '0',
  `title` varchar(128) NOT NULL,
  `parent_id` varchar(12) NOT NULL,
  `content` varchar(512) NOT NULL,
  `level` varchar(12) NOT NULL DEFAULT '1',
  `owner_login` varchar(64) NOT NULL,
  `is_championship` varchar(64) NOT NULL DEFAULT 'N',
  `manager_login` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `created_at`, `updated_at`, `deleted_at`, `title`, `parent_id`, `content`, `level`, `owner_login`, `is_championship`, `manager_login`) VALUES
(1, '1581160265', '0', '0', 'test', '0', 'sdf', '1', '', 'N', ''),
(4, '1581160876', '0', '0', 'terer', '0', 'sdfsdf', '1', '', 'N', ''),
(5, '1581259512', '0', '0', 'new', '0', 'xcv', '1', 'test', 'N', ''),
(6, '1581771245', '0', '0', 'podrazdel terer', '4', '', '2', 'test', 'N', ''),
(7, '1581772238', '0', '0', '3 podrazdel terer', '6', '', '3', 'test', 'N', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `created_at` varchar(11) NOT NULL DEFAULT '0',
  `updated_at` varchar(11) NOT NULL DEFAULT '0',
  `deleted_at` varchar(11) NOT NULL DEFAULT '0',
  `group_id` varchar(64) NOT NULL DEFAULT 'expert'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `created_at`, `updated_at`, `deleted_at`, `group_id`) VALUES
(1, 'test', '123', '1581148699', '0', '0', 'manager'),
(16, 'test2', 'test', '1581259043', '0', '0', 'expert');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `theme_users`
--
ALTER TABLE `theme_users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `theme_users`
--
ALTER TABLE `theme_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
