-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 30 2023 г., 21:46
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `citron_bank`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bank_capital`
--

CREATE TABLE `bank_capital` (
  `id_capital` int NOT NULL,
  `amount` decimal(19,4) NOT NULL,
  `currency` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_capital`
--

INSERT INTO `bank_capital` (`id_capital`, `amount`, `currency`) VALUES
(1, '3103.5500', 1),
(2, '1310.1862', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `bank_card`
--

CREATE TABLE `bank_card` (
  `id_card` int NOT NULL,
  `user_id` int NOT NULL,
  `type_card` enum('Дебетовая','Кредитная') NOT NULL,
  `category` int NOT NULL,
  `balance` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `end_date` timestamp NOT NULL,
  `cvc_code` varchar(10) NOT NULL,
  `status` enum('Заморожена','Неактивирована','Активирована') NOT NULL,
  `currency_id` int NOT NULL,
  `start_date` timestamp NOT NULL,
  `name` varchar(255) NOT NULL,
  `type_pay` enum('visa','mastercard','mir') NOT NULL DEFAULT 'mir',
  `image_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'img/cards/On-Front/default-img-card.png',
  `number_card` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_card`
--

INSERT INTO `bank_card` (`id_card`, `user_id`, `type_card`, `category`, `balance`, `end_date`, `cvc_code`, `status`, `currency_id`, `start_date`, `name`, `type_pay`, `image_path`, `number_card`) VALUES
(2, 14, 'Дебетовая', 1, '2953.5500', '2028-04-25 16:31:38', '037', 'Активирована', 1, '2023-04-27 16:31:38', 'Pavel Serzhantov', 'visa', 'img/cards/On-Front/default-img-card.png', '1234567890000001'),
(3, 15, 'Дебетовая', 1, '1243.7299', '2023-05-03 16:32:18', '035', 'Активирована', 2, '2023-05-03 16:32:18', 'Pavel Serzhantov', 'visa', 'img/cards/On-Front/default-img-card.png', '1234567890000000'),
(5, 14, 'Дебетовая', 1, '100.0000', '2028-05-07 06:48:28', '797', 'Неактивирована', 1, '2023-05-09 06:48:28', 'Pavel Serzhantov', 'mastercard', 'img/cards/On-Front/default-img-card.png', '4412637484857615'),
(6, 14, 'Дебетовая', 1, '65.9563', '2028-05-20 16:38:34', '448', 'Неактивирована', 2, '2023-05-22 16:38:34', 'Pavel Serzhantov', 'mastercard', 'img/cards/On-Front/default-img-card.png', '4412775188072146'),
(66, 14, 'Дебетовая', 1, '0.0000', '2028-05-21 15:50:51', '241', 'Неактивирована', 1, '2023-05-23 15:50:51', 'Ya Yebal Diplom', 'mir', 'img/cards/On-Front/default-img-card.png', '4412525664593831'),
(67, 18, 'Дебетовая', 1, '50.0000', '2028-05-28 15:27:20', '300', 'Активирована', 1, '2023-05-30 15:27:20', 'Pavel Serzhantov', 'visa', 'img/cards/On-Front/default-img-card.png', '4412020570423033'),
(68, 18, 'Дебетовая', 1, '0.5000', '2028-05-28 15:30:14', '630', 'Неактивирована', 2, '2023-05-30 15:30:14', 'sfasfasfasfas', 'visa', 'img/cards/On-Front/default-img-card.png', '4412341854054924');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_card-category`
--

CREATE TABLE `bank_card-category` (
  `id_card-category` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_card-category`
--

INSERT INTO `bank_card-category` (`id_card-category`, `name`) VALUES
(1, 'Citron'),
(2, 'Игровая'),
(3, 'Премиум'),
(5, 'Путешествия');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_card-features`
--

CREATE TABLE `bank_card-features` (
  `id_card-feature` int NOT NULL,
  `id_feature` int NOT NULL,
  `id_card-product` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `bank_card-product`
--

CREATE TABLE `bank_card-product` (
  `id_product` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `preview_image` varchar(1000) NOT NULL,
  `id_category` int NOT NULL,
  `type_card` enum('Дебетовая','Кредитная') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_card-product`
--

INSERT INTO `bank_card-product` (`id_product`, `name`, `description`, `preview_image`, `id_category`, `type_card`) VALUES
(5, 'ASDASDAS322', 'ASDASDASDASD322', 'img/cards/Preview-Cards/1667747653Black-and-White-Rifles-Pack.png', 2, 'Кредитная'),
(7, 'dsadas121221', 'd2112asdasd', 'img/cards/Preview-Cards/1667754456Concept-SO2.png', 1, 'Кредитная'),
(13, 'Citron Game 3', 'Дебетовая карта геймера. Закажите карту со своим sadasdasd никнеймом, копите бонусы, получайте игры и технику бесплатно', 'img\\cards\\Preview-Cards\\Citron-Game.png', 3, 'Кредитная'),
(15, 'xksdasfasf', '1241241241241', 'img/cards/Preview-Cards/1667818228main-cards.png', 2, 'Кредитная'),
(16, 'Citron Premium', 'Сделаю описание ок да 2', 'img/cards/SinglePage/Adding/1685340217_CardOnSingle-5.png', 3, 'Дебетовая'),
(17, 'Citron Card', 'Зарабатывайте деньги, а не бонусы. Закажите дебетовую карту с платежной системой «Мир» и получайте кэшбэк в любимых категориях покупок\r\n', 'img/cards/SinglePage/Adding/1685271755_CardOnSingle-2.png', 1, 'Дебетовая'),
(18, 'Citron Airline', 'a1241241241', 'img/cards/SinglePage/Adding/1685387607_CardOnSingle-6.png', 5, 'Дебетовая'),
(19, 'Citron Game', 'фафыаф', 'img/cards/SinglePage/Adding/1685271973_CardOnSingle-4.png', 2, 'Дебетовая'),
(20, 'Citron Premium Glass Ed.', 'asfasfasf', 'img/cards/SinglePage/Adding/1685272439_CardOnSingle-1.png', 3, 'Дебетовая');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_card_image-path`
--

CREATE TABLE `bank_card_image-path` (
  `id_card_image-path` int NOT NULL,
  `image-path` varchar(1000) NOT NULL,
  `id_card` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_card_image-path`
--

INSERT INTO `bank_card_image-path` (`id_card_image-path`, `image-path`, `id_card`) VALUES
(7, 'img/cards/Preview-Cards/1667747653Black-and-White-Rifles-Pack.png', 5),
(15, 'img/cards/Preview-Cards/1667807840', 13),
(19, 'img/cards/Preview-Cards/16678182283D-Icon-1.png', 15),
(20, 'img/cards/Preview-Cards/16678182283D-Icon-2.png', 15),
(21, 'img/cards/Preview-Cards/16678182283D-Icon-3.png', 15),
(22, 'img/cards/CardIcon/Adding/1685340866_CitronCard_Front-4.png', 16),
(23, 'img/cards/CardIcon/Adding/1685340894_CitronCard_Front-6.png', 17),
(24, 'img/cards/CardIcon/Adding/1685387607_CitronCard_Front-5.png', 18),
(25, 'img/cards/CardIcon/Adding/1685271973_CitronCard_Front-2.png', 19),
(26, 'img/cards/CardIcon/Adding/1685339865_', 20);

-- --------------------------------------------------------

--
-- Структура таблицы `bank_currency`
--

CREATE TABLE `bank_currency` (
  `id_currency` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_currency`
--

INSERT INTO `bank_currency` (`id_currency`, `name`, `name_id`) VALUES
(1, 'Рубль', 'RUB'),
(2, 'Доллар', 'USD');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_features`
--

CREATE TABLE `bank_features` (
  `id_feature` int NOT NULL,
  `id_feature-category` int NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_features`
--

INSERT INTO `bank_features` (`id_feature`, `id_feature-category`, `value`) VALUES
(2, 2, '10'),
(3, 1, '6');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_features-categories`
--

CREATE TABLE `bank_features-categories` (
  `id_feature-category` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_features-categories`
--

INSERT INTO `bank_features-categories` (`id_feature-category`, `name`) VALUES
(1, 'Годовые'),
(2, 'Кэшбэк');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_news`
--

CREATE TABLE `bank_news` (
  `newsID` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `status` enum('published','hidden') NOT NULL DEFAULT 'hidden',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_news`
--

INSERT INTO `bank_news` (`newsID`, `title`, `description`, `image_path`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Ещё одна тестовая', 'фыафыаафыа фыа фыа фыаыфффафыафыафыафыа фафыафыа. \r\n\r\nфыафыафафыафаыыфафыафыаафыафыафыафыа. фаыфаыфаыфыафыаафыафыв.', 'img/news/1685011084-Слой 12.jpg', 'published', '2023-05-25 10:38:04', '2023-05-25 10:38:04'),
(4, 'Ещё одна тестовая 2', 'фыафыаафыа фыа фыа фыаыфффафыафыафыафыа фафыафыа. \r\n\r\nфыафыафафыафаыыфафыафыаафыафыафыафыа. фаыфаыфаыфыафыаафыафыв.', 'img/news/1685011104-Слой 19.jpg', 'published', '2023-05-25 10:38:24', '2023-05-25 10:38:24'),
(5, 'Новость ничего себе', 'Длинное описание с различными абзацами.\r\n\r\nНапример, сделаем один абзац здесь, дабы проверить работоспособность данной штуки.\r\n\r\nКстати, можно и для финалочки абзац выделить.', 'img/news/1685033742-Glass-Card_Front-view-24.png', 'hidden', '2023-05-25 16:55:42', '2023-05-25 16:55:42'),
(6, 'Новость ничего себе', 'Длинное описание с различными абзацами.\r\n\r\nНапример, сделаем один абзац здесь, дабы проверить работоспособность данной штуки.\r\n\r\nКстати, можно и для финалочки абзац выделить.', 'img/news/1685033778-Glass-Card_Front-view-24.png', 'published', '2023-05-25 16:56:18', '2023-05-25 16:56:18'),
(7, 'Проверка добавления', 'вфывыфвфывфывыфвфы', 'img/news/1685438937-CitronCard_Front-3.png', 'published', '2023-05-30 09:28:57', '2023-05-30 09:28:57');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_order`
--

CREATE TABLE `bank_order` (
  `id_order` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `number_phone` int NOT NULL,
  `id_card` int NOT NULL,
  `id_curier` int NOT NULL,
  `date_order` timestamp NOT NULL,
  `date_delivery` timestamp NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `bank_organizations`
--

CREATE TABLE `bank_organizations` (
  `organizationID` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `color` varchar(10) NOT NULL,
  `categoryID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_organizations`
--

INSERT INTO `bank_organizations` (`organizationID`, `name`, `image_path`, `color`, `categoryID`) VALUES
(1, 'Название орги', 'img/icons/transactions/Transaction-Payment-icon.svg', '1EAF37', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `bank_payment-account`
--

CREATE TABLE `bank_payment-account` (
  `id_payment-account` int NOT NULL,
  `id_user` int NOT NULL,
  `currency` int NOT NULL,
  `amount` int NOT NULL DEFAULT '0',
  `date_create` timestamp NOT NULL,
  `status` enum('Заблокирован','Заморожен','Открыт','') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Открыт'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_payment-account`
--

INSERT INTO `bank_payment-account` (`id_payment-account`, `id_user`, `currency`, `amount`, `date_create`, `status`) VALUES
(1, 14, 1, 0, '2023-04-26 12:46:46', 'Открыт'),
(3, 14, 2, 0, '2023-05-09 06:49:29', 'Открыт'),
(4, 18, 1, 0, '2023-05-30 15:06:01', 'Открыт'),
(5, 18, 2, 0, '2023-05-30 15:26:28', 'Открыт');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_transactions`
--

CREATE TABLE `bank_transactions` (
  `id_transaction` int NOT NULL,
  `from_id` int NOT NULL,
  `to_id` int NOT NULL,
  `summary_from` decimal(19,4) NOT NULL,
  `summary_to` decimal(19,4) NOT NULL,
  `commission` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `status` enum('Ошибка перевода','Ожидание авторизации','Отправлено') NOT NULL,
  `organizationID` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_transactions`
--

INSERT INTO `bank_transactions` (`id_transaction`, `from_id`, `to_id`, `summary_from`, `summary_to`, `commission`, `status`, `organizationID`, `created_at`, `updated_at`) VALUES
(54, 2, 3, '2.0000', '0.0250', '0.0000', 'Отправлено', NULL, '2023-05-19 10:42:58', '2023-05-19 13:42:58'),
(55, 3, 2, '0.1500', '12.0000', '0.0000', 'Отправлено', NULL, '2023-05-19 16:59:20', '2023-05-19 19:59:20'),
(56, 2, 3, '12.0000', '0.1519', '0.0000', 'Отправлено', NULL, '2023-05-20 08:16:33', '2023-05-20 11:16:33'),
(57, 2, 3, '12.0000', '0.1519', '0.0000', 'Отправлено', NULL, '2023-04-20 08:16:33', '2023-04-20 11:16:33'),
(58, 2, 3, '12.0000', '0.1519', '0.0000', 'Отправлено', NULL, '2023-04-20 08:16:33', '2023-04-20 11:16:33'),
(59, 2, 3, '12.0000', '0.1519', '0.0000', 'Отправлено', 1, '2023-05-20 08:16:33', '2023-05-20 11:16:33'),
(60, 2, 3, '2.0000', '0.0253', '0.0000', 'Отправлено', 1, '2023-05-20 11:33:19', '2023-05-20 14:33:19'),
(61, 5, 3, '1.0000', '0.0127', '0.0000', 'Отправлено', 1, '2023-05-20 11:41:17', '2023-05-20 14:41:17'),
(62, 5, 2, '1.0000', '1.0000', '0.0000', 'Отправлено', 1, '2023-05-20 11:53:45', '2023-05-20 14:53:45'),
(63, 2, 3, '11.0000', '0.1392', '0.0000', 'Отправлено', 1, '2023-05-22 11:28:29', '2023-05-22 14:28:29'),
(64, 2, 6, '1.0000', '0.0127', '0.0000', 'Отправлено', 1, '2023-05-23 07:49:17', '2023-05-23 10:49:17'),
(65, 2, 6, '1.0000', '0.0127', '0.0000', 'Отправлено', 1, '2023-05-23 07:51:02', '2023-05-23 10:51:02'),
(66, 2, 6, '1.0000', '0.0127', '0.0000', 'Отправлено', 1, '2023-05-23 07:51:04', '2023-05-23 10:51:04'),
(67, 2, 6, '1.0000', '0.0127', '0.0000', 'Отправлено', 1, '2023-05-23 07:51:05', '2023-05-23 10:51:05'),
(68, 2, 6, '1.0000', '0.0127', '0.0000', 'Отправлено', 1, '2023-05-23 07:51:06', '2023-05-23 10:51:06'),
(69, 2, 6, '1.0000', '0.0127', '0.0000', 'Отправлено', 1, '2023-05-23 07:51:08', '2023-05-23 10:51:08'),
(70, 2, 6, '1.0000', '0.0127', '0.0000', 'Отправлено', 1, '2023-05-23 07:51:09', '2023-05-23 10:51:09'),
(71, 2, 6, '1.0000', '0.0127', '0.0000', 'Отправлено', 1, '2023-05-23 07:51:10', '2023-05-23 10:51:10'),
(72, 2, 6, '1.0000', '0.0127', '0.0000', 'Отправлено', 1, '2023-05-23 07:51:18', '2023-05-23 10:51:18'),
(73, 2, 6, '1.0000', '0.0127', '0.0000', 'Отправлено', 1, '2023-05-23 07:51:22', '2023-05-23 10:51:22'),
(74, 2, 3, '10.5000', '0.1266', '0.5000', 'Отправлено', 1, '2023-05-23 11:56:50', '2023-05-23 14:56:50'),
(75, 2, 6, '10.5000', '0.1266', '0.5000', 'Отправлено', 1, '2023-05-23 11:57:35', '2023-05-23 14:57:35'),
(76, 6, 2, '0.1050', '0.0000', '0.0050', 'Отправлено', 1, '2023-05-23 11:59:07', '2023-05-23 14:59:07'),
(77, 6, 2, '0.1050', '7.9000', '0.0050', 'Отправлено', 1, '2023-05-23 12:02:25', '2023-05-23 15:02:25'),
(78, 2, 3, '5.2500', '0.0633', '0.2500', 'Отправлено', 1, '2023-05-23 12:05:06', '2023-05-23 15:05:06'),
(79, 2, 3, '2.1000', '0.0253', '0.1000', 'Отправлено', 1, '2023-05-23 12:05:51', '2023-05-23 15:05:51'),
(80, 6, 2, '11.5500', '869.0000', '0.5500', 'Отправлено', 1, '2023-05-23 12:07:09', '2023-05-23 15:07:09'),
(81, 2, 6, '105.0000', '1.2658', '5.0000', 'Отправлено', 1, '2023-05-23 12:07:44', '2023-05-23 15:07:44'),
(82, 2, 3, '105.0000', '1.2658', '5.0000', 'Отправлено', 1, '2023-05-23 12:09:09', '2023-05-23 15:09:09'),
(83, 6, 2, '1.0500', '79.0000', '0.0500', 'Отправлено', 1, '2023-05-23 12:09:30', '2023-05-23 15:09:30'),
(84, 6, 2, '10.5000', '790.0000', '0.5000', 'Отправлено', 1, '2023-05-23 15:42:55', '2023-05-23 18:42:55'),
(85, 6, 2, '10.5000', '790.0000', '0.5000', 'Отправлено', 1, '2023-05-23 15:44:51', '2023-05-23 18:44:51'),
(86, 2, 5, '100.0000', '100.0000', '0.0000', 'Отправлено', 1, '2023-05-23 15:45:24', '2023-05-23 18:45:24'),
(87, 2, 6, '105.0000', '1.2658', '5.0000', 'Отправлено', 1, '2023-05-23 16:21:46', '2023-05-23 19:21:46'),
(88, 2, 6, '105.0000', '1.2658', '5.0000', 'Отправлено', 1, '2023-05-23 16:46:02', '2023-05-23 19:46:02'),
(89, 6, 2, '11.5500', '869.0000', '0.5500', 'Отправлено', 1, '2023-05-23 16:46:27', '2023-05-23 19:46:27'),
(90, 6, 2, '10.5000', '790.0000', '0.5000', 'Отправлено', 1, '2023-05-23 16:46:50', '2023-05-23 19:46:50'),
(91, 6, 2, '10.5000', '790.0000', '0.5000', 'Отправлено', 1, '2023-05-23 16:47:17', '2023-05-23 19:47:17'),
(92, 6, 2, '10.5000', '790.0000', '0.5000', 'Отправлено', 1, '2023-05-23 16:51:39', '2023-05-23 19:51:39'),
(93, 6, 2, '10.5000', '790.0000', '0.5000', 'Отправлено', 1, '2023-05-23 16:52:06', '2023-05-23 19:52:06'),
(94, 2, 6, '3150.0000', '37.9747', '150.0000', 'Отправлено', 1, '2023-05-23 16:52:28', '2023-05-23 19:52:28'),
(95, 67, 68, '42.0000', '0.5000', '2.0000', 'Отправлено', 1, '2023-05-30 15:30:29', '2023-05-30 18:30:29'),
(96, 67, 2, '8.0000', '8.0000', '0.0000', 'Отправлено', 1, '2023-05-30 15:32:44', '2023-05-30 18:32:44');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_transactions-categories`
--

CREATE TABLE `bank_transactions-categories` (
  `categoryID` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_transactions-categories`
--

INSERT INTO `bank_transactions-categories` (`categoryID`, `name`) VALUES
(1, 'Переводы'),
(2, 'Пополнение'),
(3, 'Супермаркеты'),
(4, 'Канцтовары');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_user-pasport`
--

CREATE TABLE `bank_user-pasport` (
  `id_pasport` int NOT NULL,
  `serial` int NOT NULL,
  `number` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_user-pasport`
--

INSERT INTO `bank_user-pasport` (`id_pasport`, `serial`, `number`, `user_id`) VALUES
(2, 1241, 135124, 14),
(3, 1124, 312141, 18);

-- --------------------------------------------------------

--
-- Структура таблицы `bank_users`
--

CREATE TABLE `bank_users` (
  `id_user` int NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `id_pasport` int DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `role` enum('user','admin','curier') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'user',
  `status` enum('banned','default','premium') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `bank_users`
--

INSERT INTO `bank_users` (`id_user`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `id_pasport`, `phone_number`, `image_path`, `role`, `status`) VALUES
(14, 'User', 'Testov', 'Testovich', 'elovdesign@mail.ru', '05a671c66aefea124cc08b76ea6d30bb', 2, '+7(999)999-99-99', 'img/profile/default_profile_img.png', 'user', 'default'),
(15, 'Павел', 'Сержантов', 'Андреевич', 'elovdesign@mail.ru', 'e10adc3949ba59abbe56e057f20f883e', NULL, '+7(953)400-44-68', 'img/profile/default_profile_img.png', 'user', 'default'),
(16, 'Курьер', '1', NULL, '-', 'e10adc3949ba59abbe56e057f20f883e', NULL, '+7(900)000-00-01', 'img/profile/default_profile_img.png', 'curier', 'default'),
(17, 'Админ', 'Админов', NULL, '-', 'f6fdffe48c908deb0f4c3bd36c032e72', NULL, 'admin', 'img/profile/default_profile_img.png', 'admin', 'default'),
(18, 'Ярослав', 'Фролов', NULL, 'yafoyafo@gmail.com', 'cda65371d24acb89637e5280ab3c14fb', 3, '+7(800)555-35-35', 'img/profile/default_profile_img.png', 'user', 'default');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bank_capital`
--
ALTER TABLE `bank_capital`
  ADD PRIMARY KEY (`id_capital`),
  ADD KEY `id_currency` (`currency`);

--
-- Индексы таблицы `bank_card`
--
ALTER TABLE `bank_card`
  ADD PRIMARY KEY (`id_card`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `currency_id` (`currency_id`),
  ADD KEY `category` (`category`);

--
-- Индексы таблицы `bank_card-category`
--
ALTER TABLE `bank_card-category`
  ADD PRIMARY KEY (`id_card-category`);

--
-- Индексы таблицы `bank_card-features`
--
ALTER TABLE `bank_card-features`
  ADD PRIMARY KEY (`id_card-feature`),
  ADD KEY `feature` (`id_feature`),
  ADD KEY `card_product` (`id_card-product`);

--
-- Индексы таблицы `bank_card-product`
--
ALTER TABLE `bank_card-product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_type_card` (`type_card`);

--
-- Индексы таблицы `bank_card_image-path`
--
ALTER TABLE `bank_card_image-path`
  ADD PRIMARY KEY (`id_card_image-path`),
  ADD KEY `id_card` (`id_card`);

--
-- Индексы таблицы `bank_currency`
--
ALTER TABLE `bank_currency`
  ADD PRIMARY KEY (`id_currency`);

--
-- Индексы таблицы `bank_features`
--
ALTER TABLE `bank_features`
  ADD PRIMARY KEY (`id_feature`),
  ADD KEY `feature_category` (`id_feature-category`);

--
-- Индексы таблицы `bank_features-categories`
--
ALTER TABLE `bank_features-categories`
  ADD PRIMARY KEY (`id_feature-category`);

--
-- Индексы таблицы `bank_news`
--
ALTER TABLE `bank_news`
  ADD PRIMARY KEY (`newsID`);

--
-- Индексы таблицы `bank_order`
--
ALTER TABLE `bank_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_card` (`id_card`),
  ADD KEY `id_curier` (`id_curier`);

--
-- Индексы таблицы `bank_organizations`
--
ALTER TABLE `bank_organizations`
  ADD PRIMARY KEY (`organizationID`);

--
-- Индексы таблицы `bank_payment-account`
--
ALTER TABLE `bank_payment-account`
  ADD PRIMARY KEY (`id_payment-account`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_currency` (`currency`);

--
-- Индексы таблицы `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `from_id_card` (`from_id`),
  ADD KEY `to_id_card` (`to_id`);

--
-- Индексы таблицы `bank_transactions-categories`
--
ALTER TABLE `bank_transactions-categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Индексы таблицы `bank_user-pasport`
--
ALTER TABLE `bank_user-pasport`
  ADD PRIMARY KEY (`id_pasport`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `bank_users`
--
ALTER TABLE `bank_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_pasport` (`id_pasport`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bank_capital`
--
ALTER TABLE `bank_capital`
  MODIFY `id_capital` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `bank_card`
--
ALTER TABLE `bank_card`
  MODIFY `id_card` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT для таблицы `bank_card-category`
--
ALTER TABLE `bank_card-category`
  MODIFY `id_card-category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `bank_card-features`
--
ALTER TABLE `bank_card-features`
  MODIFY `id_card-feature` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bank_card-product`
--
ALTER TABLE `bank_card-product`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `bank_card_image-path`
--
ALTER TABLE `bank_card_image-path`
  MODIFY `id_card_image-path` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `bank_currency`
--
ALTER TABLE `bank_currency`
  MODIFY `id_currency` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `bank_features`
--
ALTER TABLE `bank_features`
  MODIFY `id_feature` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `bank_features-categories`
--
ALTER TABLE `bank_features-categories`
  MODIFY `id_feature-category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `bank_news`
--
ALTER TABLE `bank_news`
  MODIFY `newsID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `bank_order`
--
ALTER TABLE `bank_order`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bank_organizations`
--
ALTER TABLE `bank_organizations`
  MODIFY `organizationID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `bank_payment-account`
--
ALTER TABLE `bank_payment-account`
  MODIFY `id_payment-account` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `id_transaction` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT для таблицы `bank_transactions-categories`
--
ALTER TABLE `bank_transactions-categories`
  MODIFY `categoryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `bank_user-pasport`
--
ALTER TABLE `bank_user-pasport`
  MODIFY `id_pasport` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `bank_users`
--
ALTER TABLE `bank_users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bank_capital`
--
ALTER TABLE `bank_capital`
  ADD CONSTRAINT `bank_capital_ibfk_1` FOREIGN KEY (`currency`) REFERENCES `bank_currency` (`id_currency`);

--
-- Ограничения внешнего ключа таблицы `bank_card`
--
ALTER TABLE `bank_card`
  ADD CONSTRAINT `bank_card_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bank_users` (`id_user`),
  ADD CONSTRAINT `bank_card_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `bank_currency` (`id_currency`),
  ADD CONSTRAINT `bank_card_ibfk_3` FOREIGN KEY (`category`) REFERENCES `bank_card-category` (`id_card-category`);

--
-- Ограничения внешнего ключа таблицы `bank_card-features`
--
ALTER TABLE `bank_card-features`
  ADD CONSTRAINT `bank_card-features_ibfk_1` FOREIGN KEY (`id_feature`) REFERENCES `bank_features` (`id_feature`),
  ADD CONSTRAINT `bank_card-features_ibfk_2` FOREIGN KEY (`id_card-product`) REFERENCES `bank_card-product` (`id_product`);

--
-- Ограничения внешнего ключа таблицы `bank_card-product`
--
ALTER TABLE `bank_card-product`
  ADD CONSTRAINT `bank_card-product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `bank_card-category` (`id_card-category`);

--
-- Ограничения внешнего ключа таблицы `bank_card_image-path`
--
ALTER TABLE `bank_card_image-path`
  ADD CONSTRAINT `bank_card_image-path_ibfk_1` FOREIGN KEY (`id_card`) REFERENCES `bank_card-product` (`id_product`);

--
-- Ограничения внешнего ключа таблицы `bank_features`
--
ALTER TABLE `bank_features`
  ADD CONSTRAINT `bank_features_ibfk_1` FOREIGN KEY (`id_feature-category`) REFERENCES `bank_features-categories` (`id_feature-category`);

--
-- Ограничения внешнего ключа таблицы `bank_order`
--
ALTER TABLE `bank_order`
  ADD CONSTRAINT `bank_order_ibfk_1` FOREIGN KEY (`id_card`) REFERENCES `bank_card` (`id_card`),
  ADD CONSTRAINT `bank_order_ibfk_2` FOREIGN KEY (`id_curier`) REFERENCES `bank_users` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `bank_payment-account`
--
ALTER TABLE `bank_payment-account`
  ADD CONSTRAINT `bank_payment-account_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `bank_users` (`id_user`),
  ADD CONSTRAINT `bank_payment-account_ibfk_2` FOREIGN KEY (`currency`) REFERENCES `bank_currency` (`id_currency`);

--
-- Ограничения внешнего ключа таблицы `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD CONSTRAINT `bank_transactions_ibfk_1` FOREIGN KEY (`from_id`) REFERENCES `bank_card` (`id_card`),
  ADD CONSTRAINT `bank_transactions_ibfk_2` FOREIGN KEY (`to_id`) REFERENCES `bank_card` (`id_card`);

--
-- Ограничения внешнего ключа таблицы `bank_user-pasport`
--
ALTER TABLE `bank_user-pasport`
  ADD CONSTRAINT `bank_user-pasport_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bank_users` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `bank_users`
--
ALTER TABLE `bank_users`
  ADD CONSTRAINT `bank_users_ibfk_1` FOREIGN KEY (`id_pasport`) REFERENCES `bank_user-pasport` (`id_pasport`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
