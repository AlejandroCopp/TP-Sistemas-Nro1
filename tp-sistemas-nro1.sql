-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2025 a las 02:34:33
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

INSERT INTO `matches` (`id`, `location`, `name`, `datetime_created`, `datetime_scheduled`, `datetime_started`, `datetime_finished`, `manager_id`, `max_players`, `image`) VALUES
(1, 'Buenos Aires', 'Partido 1', '2025-10-20 01:22:35', '2028-12-20 09:07:13', NULL, NULL, 3, 10, NULL),
(2, 'Buenos Aires', 'Partido 1', '2025-10-20 01:22:40', '2028-12-20 09:07:13', NULL, NULL, 3, 10, NULL),
(3, 'Buenos Aires', 'Partido 1', '2025-10-20 02:31:01', '2028-12-20 09:07:13', NULL, NULL, 3, 10, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `match_players`
--

CREATE TABLE `match_players` (
  `match_id` int(10) UNSIGNED NOT NULL,
  `player_id` int(10) UNSIGNED NOT NULL,
  `datetime_player_added` datetime DEFAULT NULL,
  `datetime_player_declined` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `match_players`
--

INSERT INTO `match_players` (`match_id`, `player_id`, `datetime_player_added`, `datetime_player_declined`) VALUES
(1, 2, '2025-10-20 03:00:00', NULL),
(1, 3, '2025-10-20 03:01:00', NULL);

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
(2, 'Test user', 'cgaber@example.com', '$2y$10$z4ASW8UVoEnTaecK1ewIBexp2SZvu6AYnrAcHSufkj/VDi9A0bCfG', 'jugador'),
(3, 'Cristian', 'test1@example.com', '$2y$10$H2tUqmqA8lClw15Xqgk6RO/EbuAuESKKWVosUTYfehLzhovv9FBIu', 'jugador');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User ID', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
