-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2025 a las 01:39:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp-sistemas-nro1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matches`
--

CREATE TABLE `matches` (
  `id` int(10) UNSIGNED NOT NULL,
  `location` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `team_name1` varchar(50) NOT NULL,
  `team_name2` varchar(50) NOT NULL,
  `datetime_created` datetime NOT NULL,
  `datetime_scheduled` datetime NOT NULL,
  `datetime_started` datetime DEFAULT NULL,
  `datetime_finished` datetime DEFAULT NULL,
  `manager_id` int(10) UNSIGNED NOT NULL,
  `max_players` int(10) UNSIGNED NOT NULL,
  `image` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `matches`
--

INSERT INTO `matches` (`id`, `location`, `name`, `team_name1`, `team_name2`, `datetime_created`, `datetime_scheduled`, `datetime_started`, `datetime_finished`, `manager_id`, `max_players`, `image`) VALUES
(9, 'Cancha 12', '', 'Boca', 'River Plate', '2025-10-22 01:08:22', '2025-10-24 01:08:00', NULL, NULL, 4, 14, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `match_players`
--

CREATE TABLE `match_players` (
  `id` int(10) UNSIGNED NOT NULL,
  `match_id` int(10) UNSIGNED NOT NULL,
  `player_id` int(10) UNSIGNED NOT NULL,
  `position` varchar(50) NOT NULL,
  `team` varchar(255) NOT NULL,
  `datetime_player_added` datetime DEFAULT NULL,
  `datetime_player_declined` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `match_players`
--

INSERT INTO `match_players` (`id`, `match_id`, `player_id`, `position`, `team`, `datetime_player_added`, `datetime_player_declined`) VALUES
(2, 9, 4, 'test', 'Boca', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'User ID',
  `name` varchar(255) NOT NULL COMMENT 'User Name',
  `email` varchar(255) NOT NULL COMMENT 'User Email',
  `password_hash` varchar(255) NOT NULL COMMENT 'User Password Bcrypt',
  `role` varchar(255) NOT NULL COMMENT 'User Role'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`) VALUES
(1, 'Cristian Gaber', 'test@example.com', 'bcrypt_tesst123456', 'admin'),
(2, 'Test user', 'cgaber@example.com', '$2y$10$z4ASW8UVoEnTaecK1ewIBexp2SZvu6AYnrAcHSufkj/VDi9A0bCfG', 'jugador'),
(3, 'Cristian', 'test1@example.com', '$2y$10$H2tUqmqA8lClw15Xqgk6RO/EbuAuESKKWVosUTYfehLzhovv9FBIu', 'jugador'),
(4, 'Cristian G', 'test12123@test.com', '$2y$10$DqDKrKyxvzDWjvu706ckg.GvUglHxVnL2P1eKrPpQC260fKQtmKLu', 'jugador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `match_players`
--
ALTER TABLE `match_players`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `match_players`
--
ALTER TABLE `match_players`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User ID', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
