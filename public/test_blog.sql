-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Квт 18 2018 р., 13:53
-- Версія сервера: 5.6.25
-- Версія PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `test_blog`
--
CREATE DATABASE IF NOT EXISTS `test_blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `test_blog`;

-- --------------------------------------------------------

--
-- Структура таблиці `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `pubdate` date NOT NULL,
  `views` int(11) DEFAULT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=311 DEFAULT CHARSET=utf8 ROW_FORMAT=REDUNDANT;

--
-- Дамп даних таблиці `articles`
--

INSERT INTO `articles` (`id`, `title`, `image`, `text`, `pubdate`, `views`, `author`) VALUES
(1, 'Первая статья', '1.jpg', 'ПЕРВАЯ СТАТЬЯ,\r\nПЕРВАЯ СТАТЬЯ,\r\nПЕРВАЯ СТАТЬЯ,\r\nПЕРВАЯ СТАТЬЯ,\r\nПЕРВАЯ СТАТЬЯ,\r\nПЕРВАЯ СТАТЬЯ,\r\nПЕРВАЯ СТАТЬЯ,\r\nПЕРВАЯ СТАТЬЯ,\r\nПЕРВАЯ СТАТЬЯ,\r\nПЕРВАЯ СТАТЬЯ', '2018-03-12', 1, 'имя_автора1'),
(2, 'Вторая статья', '2.jpg', 'ТЕКСТ ВТОРОЙ СТАТЬИ,\r\nТЕКСТ ВТОРОЙ СТАТЬИ,\r\nТЕКСТ ВТОРОЙ СТАТЬИ,\r\nТЕКСТ ВТОРОЙ СТАТЬИ,\r\nТЕКСТ ВТОРОЙ СТАТЬИ,\r\nТЕКСТ ВТОРОЙ СТАТЬИ,\r\nТЕКСТ ВТОРОЙ СТАТЬИ,\r\nТЕКСТ ВТОРОЙ СТАТЬИ,\r\nТЕКСТ ВТОРОЙ СТАТЬИ,\r\nТЕКСТ ВТОРОЙ СТАТЬИ', '2018-03-12', 2, 'имя_автора2'),
(3, 'Третья статья', '3.jpg', 'ТЕКСТ ТРЕТЬЕЙ СТАТЬИ,\r\nТЕКСТ ТРЕТЬЕЙ СТАТЬИ,\r\nТЕКСТ ТРЕТЬЕЙ СТАТЬИ,\r\nТЕКСТ ТРЕТЬЕЙ СТАТЬИ,\r\nТЕКСТ ТРЕТЬЕЙ СТАТЬИ,\r\nТЕКСТ ТРЕТЬЕЙ СТАТЬИ,\r\nТЕКСТ ТРЕТЬЕЙ СТАТЬИ,\r\nТЕКСТ ТРЕТЬЕЙ СТАТЬИ,\r\nТЕКСТ ТРЕТЬЕЙ СТАТЬИ,\r\nТЕКСТ ТРЕТЬЕЙ СТАТЬИ', '2018-03-12', 8, 'имя_автора3'),
(4, 'Четвёртая статья', '4.jpg', 'ТЕКСТ ЧЕТВЁРТОЙ СТАТЬИ,\r\nТЕКСТ ЧЕТВЁРТОЙ СТАТЬИ,\r\nТЕКСТ ЧЕТВЁРТОЙ СТАТЬИ,\r\nТЕКСТ ЧЕТВЁРТОЙ СТАТЬИ,\r\nТЕКСТ ЧЕТВЁРТОЙ СТАТЬИ,\r\nТЕКСТ ЧЕТВЁРТОЙ СТАТЬИ,\r\nТЕКСТ ЧЕТВЁРТОЙ СТАТЬИ,\r\nТЕКСТ ЧЕТВЁРТОЙ СТАТЬИ,\r\nТЕКСТ ЧЕТВЁРТОЙ СТАТЬИ,\r\nТЕКСТ ЧЕТВЁРТОЙ СТАТЬИ', '2018-03-12', 4, 'имя_автора4'),
(5, 'Пятая статья', '51.jpg', 'ТЕКСТ ПЯТОЙ СТАТЬИ,\r\nТЕКСТ ПЯТОЙ СТАТЬИ,\r\nТЕКСТ ПЯТОЙ СТАТЬИ,\r\nТЕКСТ ПЯТОЙ СТАТЬИ,\r\nТЕКСТ ПЯТОЙ СТАТЬИ,\r\nТЕКСТ ПЯТОЙ СТАТЬИ,\r\nТЕКСТ ПЯТОЙ СТАТЬИ,\r\nТЕКСТ ПЯТОЙ СТАТЬИ,\r\nТЕКСТ ПЯТОЙ СТАТЬИ,\r\nТЕКСТ ПЯТОЙ СТАТЬИ\r\n', '2018-03-12', 5, 'имя_автора5'),
(6, 'Шестая статья', '6.jpg', 'ТЕКСТ ШЕСТОЙ СТАТЬИ,\r\nТЕКСТ ШЕСТОЙ СТАТЬИ,\r\nТЕКСТ ШЕСТОЙ СТАТЬИ,\r\nТЕКСТ ШЕСТОЙ СТАТЬИ,\r\nТЕКСТ ШЕСТОЙ СТАТЬИ,\r\nТЕКСТ ШЕСТОЙ СТАТЬИ,\r\nТЕКСТ ШЕСТОЙ СТАТЬИ,\r\nТЕКСТ ШЕСТОЙ СТАТЬИ,\r\nТЕКСТ ШЕСТОЙ СТАТЬИ,\r\nТЕКСТ ШЕСТОЙ СТАТЬИ', '2018-03-12', 0, 'имя_автора6'),
(28, 'Тестовая публикация', '3w6myHlTGtQ.jpg', 'Текст публикации - проверка загрузки файла изображения. Файл загружается только если до этого был помещён в папку public. ', '2018-03-22', NULL, 'Максим'),
(157, 'TEST ARTICLE', '01VOuGGwkO4.jpg', 'TEST ARTICLE', '2018-04-04', NULL, 'TEST ARTICLE'),
(287, 'Тест название публикации', 'DhlKBYouDIs.jpg', 'Текст публикации', '2018-04-06', NULL, 'ТЕСТ'),
(290, 'test', 'DfUx7pQsoXw.jpg', 'testText', '2018-04-12', 20, 'Maximus');

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `pubdate` date NOT NULL,
  `articles_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `comments`
--

INSERT INTO `comments` (`id`, `author`, `nickname`, `email`, `text`, `pubdate`, `articles_id`) VALUES
(1, 'комментатор1', 'troll', 'trollBox@gmail.com', 'ВАТТТТЭТАДАААА!!!', '2018-03-20', 3),
(2, 'Максим', 'MadMax', 'smstepani4@gmail.com', 'ТЕСТ', '2018-03-22', 3),
(31, 'коммент для тест', 'тестован', 'testilo@test.test', 'текст тест', '2018-04-06', 287),
(33, 'Имя', 'Ник', 'test@gmail.com', 'Текст', '2018-04-17', 3);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=311;
--
-- AUTO_INCREMENT для таблиці `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
