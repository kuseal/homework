-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 09 2018 г., 08:58
-- Версия сервера: 5.6.39-83.1
-- Версия PHP: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cf32186_faq`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role_id` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `login`, `pass`, `role_id`) VALUES
(1, 'admin', '$2y$10$7mfAu3SpQAVpJjGx7Kh2Qe9pe7U0UgTNtm4NRo.QNlQ9668bTt/eq', 2),
(2, 'Vasya', '$2y$10$mdAF6.dOth8osTrpQfkV8.WKxleEVFRB8YGTZWUjMeyF73JnPC4fa', 1),
(5, 'Fedya', '$2y$10$YzTc779G9SDHjIVclthTj.L4N1eBXadBts.ttkPiCPlbqOqhke4GK', 1),
(6, 'Grisha', '$2y$10$fgSkMVL0PoZiCcwcz9KvbuOP3/2zbpOGoKxAUQXHe.UjDhvM8yC5m', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Основные вопросы'),
(3, 'Аккаунт'),
(4, 'Оплата'),
(5, 'Конфиденциальность'),
(6, 'Доставка'),
(7, 'Мобильный');

-- --------------------------------------------------------

--
-- Структура таблицы `question_answer`
--

CREATE TABLE IF NOT EXISTS `question_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer` varchar(500) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `receipt_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `question_answer`
--

INSERT INTO `question_answer` (`id`, `user_name`, `email`, `category_id`, `question`, `answer`, `status_id`, `receipt_date`) VALUES
(9, 'Сергей', '123@mail.ru', 1, 'Как мне изменить пароль?', '1 Повседневная практика показывает, что рамки и место обучения кадров требуют от нас анализа соответствующий условий активизации. Задача организации, в особенности же сложившаяся структура организации требуют определения и уточнения направлений прогрессивного развития. Идейные соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности требуют определения и уточнения форм развития.', 1, '2018-09-30 10:15:00'),
(10, 'Fedya', 'yryry@mail.ru', 1, 'Как зарегистрироваться?', '2 Повседневная практика показывает, что рамки и место обучения кадров требуют от нас анализа соответствующий условий активизации. Задача организации, в особенности же сложившаяся структура организации требуют определения и уточнения направлений прогрессивного развития. Идейные соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности требуют определения и уточнения форм развития.', 2, '2018-09-30 11:16:00'),
(13, 'Vasya', 'yryry@mail.ru', 3, 'Как мне изменить пароль?', 'aehsaehsaeth', 2, '2018-09-30 11:16:00'),
(31, 'ddd', 'ddd@ddd.ff', 1, 'Ваш вопросffff', 'Значимость этих проблем настолько очевидна, что постоянное информационно-пропагандистское обеспечение нашей деятельности способствует подготовки и реализации позиций, занимаемых участниками в отношении поставленных задач. Равным образом дальнейшее развитие различных форм деятельности требуют от нас анализа новых предложений. ', 2, '2018-10-04 22:06:27');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `title`) VALUES
(1, 'Администратор'),
(2, 'Супер администратор');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `title`) VALUES
(1, 'Ожидает ответа'),
(2, 'Опубликован'),
(3, 'Скрыт');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
