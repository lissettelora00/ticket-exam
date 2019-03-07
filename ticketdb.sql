-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-03-2019 a las 21:55:11
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ticketdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assigned_ticket`
--

CREATE TABLE `assigned_ticket` (
  `id_record` int(11) NOT NULL,
  `id_user_assigned` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `id_user_assigns_ticket` int(11) NOT NULL,
  `assigned_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id_record` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `id_user_requestor` int(11) NOT NULL,
  `id_ticket_type` int(11) NOT NULL,
  `request_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_ticket_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id_record`, `title`, `description`, `id_user_requestor`, `id_ticket_type`, `request_date`, `id_ticket_status`) VALUES
(1, 'Titulo Prueba', 'desc prueba', 1, 1, '2018-01-01 00:00:00', 1),
(2, 'Titulo Prueba2', 'Desc prueba', 1, 1, '2018-01-01 00:00:00', 2),
(3, 'test', 'test', 1, 1, '2019-03-05 16:09:19', 1),
(4, 'test2', 'test', 1, 1, '2019-03-05 16:31:14', 1),
(5, 'Prueba orbis', 'pruea', 1, 1, '2019-03-05 18:03:48', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_detail`
--

CREATE TABLE `ticket_detail` (
  `id_record` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `worked_time` float NOT NULL,
  `id_ticket_status_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_status`
--

CREATE TABLE `ticket_status` (
  `id_record` int(11) NOT NULL,
  `status_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ticket_status`
--

INSERT INTO `ticket_status` (`id_record`, `status_name`, `description`) VALUES
(1, 'Open', 'Estatus que se crea por defecto cuando se abre un '),
(2, 'Assigned', 'Se genera por defecto cuando se asigna el ticket, pero aun no  se le reportan horas.'),
(3, 'Pending', 'Se genera por defecto cuando se reporta horas al ticket por primera vez.'),
(4, 'Cancelled', 'El usuario tanto a quien se asigna el ticket como quien lo genera puede cancelarlo.'),
(5, 'Finished', 'El usuario da por terminado/cerrado el ticket cuando esta listo. Nota: no se puede cerrar sin haberle reportado horas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_type`
--

CREATE TABLE `ticket_type` (
  `id_record` int(11) NOT NULL,
  `type_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ticket_type`
--

INSERT INTO `ticket_type` (`id_record`, `type_name`, `description`, `active`) VALUES
(1, 'General', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_record` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_record`, `first_name`, `last_name`, `username`, `password`, `active`) VALUES
(1, 'Lissette', 'Lora', 'lmlora', '123456', 1),
(3, 'Wilman', 'Hilario', 'whilario', '123456', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `assigned_ticket`
--
ALTER TABLE `assigned_ticket`
  ADD PRIMARY KEY (`id_record`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_record`);

--
-- Indices de la tabla `ticket_detail`
--
ALTER TABLE `ticket_detail`
  ADD PRIMARY KEY (`id_record`);

--
-- Indices de la tabla `ticket_status`
--
ALTER TABLE `ticket_status`
  ADD PRIMARY KEY (`id_record`);

--
-- Indices de la tabla `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD PRIMARY KEY (`id_record`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_record`),
  ADD UNIQUE KEY `user_name` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `assigned_ticket`
--
ALTER TABLE `assigned_ticket`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ticket_detail`
--
ALTER TABLE `ticket_detail`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket_status`
--
ALTER TABLE `ticket_status`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ticket_type`
--
ALTER TABLE `ticket_type`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `ticket_detail` CHANGE `updated_datetime` `updated_datetime` DATETIME NOT NULL;