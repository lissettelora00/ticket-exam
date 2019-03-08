CREATE FUNCTION GETUSERNAMEBYID(UID INT) RETURNS TEXT BEGIN DECLARE FULL_NAME TEXT DEFAULT ""; 
SELECT CONCAT(FIRST_NAME, " ", LAST_NAME) INTO FULL_NAME FROM USER WHERE id_record = UID; RETURN FULL_NAME; END;

SELECT *, COALESCE(SUM(td.worked_time), 0)
FROM ticket t
INNER JOIN assigned_ticket ati ON (ati.id_ticket = t.id_record)
INNER JOIN user u ON (u.id_record = ati.id_user_assigned)
INNER JOIN ticket_status ts ON (ts.id_record = t.id_ticket_status)
LEFT JOIN ticket_detail td ON (td.id_ticket = t.id_record)
WHERE TRUE
AND t.request_date BETWEEN '2018-01-01' AND '2018-01-05'
GROUP BY t.id_record
ORDER BY t.id_record

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2019 a las 01:43:29
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

--
-- Volcado de datos para la tabla `assigned_ticket`
--

INSERT INTO `assigned_ticket` (`id_record`, `id_user_assigned`, `id_ticket`, `id_user_assigns_ticket`, `assigned_date`) VALUES
(1, 3, 1, 1, '2019-03-06 21:52:08'),
(2, 3, 3, 1, '2019-03-06 21:59:22'),
(3, 3, 4, 1, '2019-03-06 22:01:37'),
(4, 3, 5, 1, '2019-03-06 22:03:07'),
(5, 1, 6, 3, '2019-03-08 01:08:53');

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
(1, 'Titulo Prueba', 'desc prueba', 1, 1, '2018-01-01 00:00:00', 5),
(2, 'Titulo Prueba2', 'Desc prueba', 1, 1, '2018-01-01 00:00:00', 2),
(3, 'test', 'test', 1, 1, '2019-03-05 16:09:19', 2),
(4, 'test2', 'test', 1, 1, '2019-03-05 16:31:14', 2),
(5, 'Prueba orbis', 'pruea', 1, 1, '2019-03-05 18:03:48', 2),
(6, 'Ticket de prueba', 'Este es un Ticket de prueba', 3, 1, '2019-03-08 01:08:31', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_detail`
--

CREATE TABLE `ticket_detail` (
  `id_record` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `worked_time` float NOT NULL,
  `id_ticket_status_user` int(11) NOT NULL,
  `updated_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ticket_detail`
--

INSERT INTO `ticket_detail` (`id_record`, `id_ticket`, `comment`, `worked_time`, `id_ticket_status_user`, `updated_datetime`) VALUES
(1, 1, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. ', 1.3, 2, '2019-03-04 07:12:00'),
(2, 1, 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. ', 3, 2, '2019-03-19 06:23:24'),
(3, 4, 'prueba4', 1.2, 2, '2019-03-28 07:20:21'),
(4, 4, 'Pru4', 2.1, 2, '2019-03-19 09:24:08'),
(5, 1, 'Esta es la prueba', 5, 3, '2019-03-08 00:31:33'),
(8, 1, 'Esta es la prueba', 5, 3, '2019-03-08 00:36:06'),
(9, 1, 'Otra', 7, 3, '2019-03-08 00:37:11'),
(10, 5, 'Finally', 6, 3, '2019-03-08 00:38:30'),
(11, 5, 'Vamos a ver', 3, 3, '2019-03-08 00:49:12'),
(12, 1, 'Finish', 1, 5, '2019-03-08 00:57:40');

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
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ticket_detail`
--
ALTER TABLE `ticket_detail`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
