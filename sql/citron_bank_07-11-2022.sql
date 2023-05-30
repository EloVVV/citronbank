-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 07 2022 г., 12:02
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

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
  `amount` int NOT NULL,
  `currency` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bank_card`
--

CREATE TABLE `bank_card` (
  `id_card` int NOT NULL,
  `user_id` int NOT NULL,
  `type_card` enum('Дебетовая','Кредитная') NOT NULL,
  `category` enum('Премиальные','Геймеру','Путешественнику','Автомобилисту') NOT NULL,
  `balance` int NOT NULL DEFAULT '0',
  `end_date` timestamp NOT NULL,
  `cvc_code` int NOT NULL,
  `status` enum('Заморожена','Неактивирована','Активирована') NOT NULL,
  `currency_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bank_card-category`
--

CREATE TABLE `bank_card-category` (
  `id_card-category` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bank_card-category`
--

INSERT INTO `bank_card-category` (`id_card-category`, `name`) VALUES
(1, 'Путешествия'),
(2, 'Игровая'),
(3, 'Премиум'),
(4, 'Новая категория');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_card-features`
--

CREATE TABLE `bank_card-features` (
  `id_card-feature` int NOT NULL,
  `id_feature` int NOT NULL,
  `id_card-product` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `type_card` enum('Дебетовая','Кредитная') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bank_card-product`
--

INSERT INTO `bank_card-product` (`id_product`, `name`, `description`, `preview_image`, `id_category`, `type_card`) VALUES
(1, 'Citron Card', 'Зарабатывайте деньги, а не бонусы. Закажите дебетовую карту с платежной системой «Мир» и получайте кэшбэк в любимых категориях покупок', 'img\\cards\\Preview-Cards\\Citron-Card.png', 3, 'Дебетовая'),
(5, 'ASDASDAS', 'ASDASDASDASD', 'img/cards/Preview-Cards/1667747653Black-and-White-Rifles-Pack.png', 2, 'Кредитная'),
(7, 'dsadas', 'dasdasd', 'img/cards/Preview-Cards/1667754456Concept-SO2.png', 1, 'Кредитная'),
(12, 'Citron Game', 'Дебетовая карта геймера. Закажите карту со своим никнеймом, копите бонусы, получайте игры и технику бесплатно', 'img/cards/Preview-Cards/1667806458Group 135.png', 2, 'Дебетовая'),
(13, 'Citron Game 3', 'Дебетовая карта геймера. Закажите карту со своим sadasdasd никнеймом, копите бонусы, получайте игры и технику бесплатно', 'img\\cards\\Preview-Cards\\Citron-Game.png', 3, 'Кредитная'),
(14, 'New Test', 'Test', 'img/cards/Preview-Cards/1667807147Mask group.png', 3, 'Дебетовая');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_card_image-path`
--

CREATE TABLE `bank_card_image-path` (
  `id_card_image-path` int NOT NULL,
  `image-path` varchar(1000) NOT NULL,
  `id_card` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bank_card_image-path`
--

INSERT INTO `bank_card_image-path` (`id_card_image-path`, `image-path`, `id_card`) VALUES
(6, 'img/cards/Preview-Cards/1667747653Black-and-White-Rifles-Pack.png', 5),
(7, 'img/cards/Preview-Cards/1667747653Black-and-White-Rifles-Pack.png', 5),
(14, 'img/cards/Preview-Cards/1667805709', 12),
(15, 'img/cards/Preview-Cards/1667807840', 13),
(16, 'img/cards/Preview-Cards/1667805710', 12),
(17, 'img/cards/Preview-Cards/16678076613D-Icon-3.png', 14),
(18, 'img/cards/Preview-Cards/16678076613D-Icon-5.png', 14);

-- --------------------------------------------------------

--
-- Структура таблицы `bank_currency`
--

CREATE TABLE `bank_currency` (
  `id_currency` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bank_features`
--

CREATE TABLE `bank_features` (
  `id_feature` int NOT NULL,
  `id_feature-category` int NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bank_features-categories`
--

INSERT INTO `bank_features-categories` (`id_feature-category`, `name`) VALUES
(1, 'Годовые'),
(2, 'Кэшбэк');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bank_payment-account`
--

CREATE TABLE `bank_payment-account` (
  `id_payment-account` int NOT NULL,
  `id_user` int NOT NULL,
  `currency` int NOT NULL,
  `amount` int NOT NULL,
  `date_create` timestamp NOT NULL,
  `status` enum('Заблокирован','Заморожен','Открыт','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bank_transaction`
--

CREATE TABLE `bank_transaction` (
  `id_transaction` int NOT NULL,
  `from_id` int NOT NULL,
  `to_id` int NOT NULL,
  `summary` int NOT NULL,
  `status` enum('Ошибка перевода','Ожидание авторизации','Отправлено') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bank_user-pasport`
--

CREATE TABLE `bank_user-pasport` (
  `id_pasport` int NOT NULL,
  `serial` int NOT NULL,
  `number` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bank_users`
--

CREATE TABLE `bank_users` (
  `id_user` int NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `id_pasport` int DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `role` enum('user','admin','curier') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'user',
  `status` enum('banned','default','premium') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bank_users`
--

INSERT INTO `bank_users` (`id_user`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `id_pasport`, `phone_number`, `image_path`, `role`, `status`) VALUES
(8, 'sadasdasd', '12412421', 'asdasdasdasdasd', 'asdasdasda@mail.ru', 'fcea920f7412b5da7be0cf42b8c93759', NULL, '+79534004468', '214312412412', 'user', 'default'),
(10, 'Павел', '2121412', 'Андреевич', 'elovdesign@mail.ru', 'fcea920f7412b5da7be0cf42b8c93759', NULL, '+79534004468', 'nussll', 'user', 'default'),
(11, 'Кирилл', 'Кириллов', 'Павлович', 'kirill@mail.ru', 'fcea920f7412b5da7be0cf42b8c93759', NULL, '+79331244422', 'nussll', 'user', 'default'),
(12, 'Павел', 'Сержантов', 'Андреевич', 'newdesign@mail.ru', 'fcea920f7412b5da7be0cf42b8c93759', NULL, '+79001000001', 'nussll', 'admin', 'default');

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
  ADD KEY `currency_id` (`currency_id`);

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
-- Индексы таблицы `bank_order`
--
ALTER TABLE `bank_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_card` (`id_card`),
  ADD KEY `id_curier` (`id_curier`);

--
-- Индексы таблицы `bank_payment-account`
--
ALTER TABLE `bank_payment-account`
  ADD PRIMARY KEY (`id_payment-account`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_currency` (`currency`);

--
-- Индексы таблицы `bank_transaction`
--
ALTER TABLE `bank_transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `from_id_card` (`from_id`),
  ADD KEY `to_id_card` (`to_id`);

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
  MODIFY `id_capital` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bank_card`
--
ALTER TABLE `bank_card`
  MODIFY `id_card` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bank_card-category`
--
ALTER TABLE `bank_card-category`
  MODIFY `id_card-category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `bank_card-features`
--
ALTER TABLE `bank_card-features`
  MODIFY `id_card-feature` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bank_card-product`
--
ALTER TABLE `bank_card-product`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `bank_card_image-path`
--
ALTER TABLE `bank_card_image-path`
  MODIFY `id_card_image-path` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `bank_currency`
--
ALTER TABLE `bank_currency`
  MODIFY `id_currency` int NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT для таблицы `bank_order`
--
ALTER TABLE `bank_order`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bank_payment-account`
--
ALTER TABLE `bank_payment-account`
  MODIFY `id_payment-account` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bank_transaction`
--
ALTER TABLE `bank_transaction`
  MODIFY `id_transaction` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bank_user-pasport`
--
ALTER TABLE `bank_user-pasport`
  MODIFY `id_pasport` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bank_users`
--
ALTER TABLE `bank_users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `bank_card_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `bank_currency` (`id_currency`);

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
-- Ограничения внешнего ключа таблицы `bank_transaction`
--
ALTER TABLE `bank_transaction`
  ADD CONSTRAINT `bank_transaction_ibfk_1` FOREIGN KEY (`from_id`) REFERENCES `bank_card` (`id_card`),
  ADD CONSTRAINT `bank_transaction_ibfk_2` FOREIGN KEY (`to_id`) REFERENCES `bank_card` (`id_card`);

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
