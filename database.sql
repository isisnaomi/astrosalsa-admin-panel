-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 05-12-2016 a las 05:49:24
-- Versión del servidor: 5.6.33
-- Versión de PHP: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `astrosalsa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assistancelog`
--

CREATE TABLE `assistancelog` (
  `studentId` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `assistancelog`
--

INSERT INTO `assistancelog` (`studentId`, `date`, `time`) VALUES
(0, '2016-12-03', '23:23:31'),
(0, '2016-12-03', '23:33:04'),
(0, '2016-12-04', '02:04:19'),
(0, '2016-12-04', '02:06:15'),
(0, '2016-12-04', '02:06:23'),
(0, '2016-12-04', '02:06:35'),
(1, '2016-12-03', '23:44:37'),
(7, '2016-12-03', '23:53:50'),
(7, '2016-12-04', '02:09:28'),
(7, '2016-12-04', '11:26:49'),
(7, '2016-12-04', '11:36:23'),
(7, '2016-12-04', '11:37:09'),
(7, '2016-12-04', '11:39:33'),
(7, '2016-12-04', '11:40:54'),
(7, '2016-12-04', '11:41:35'),
(7, '2016-12-04', '11:42:06'),
(7, '2016-12-04', '11:47:18'),
(7, '2016-12-04', '11:47:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL DEFAULT 'No definido',
  `classesIncluded` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `packages`
--

INSERT INTO `packages` (`id`, `name`, `classesIncluded`, `price`) VALUES
(0, 'Sin subscripción', 0, 0),
(2, 'Viva la salsa', 34, 234),
(3, 'Viva la salsa (Pro level)', 14, 19000),
(4, 'Viva la catsup', 34, 9000),
(5, 'God like class', 12, 120000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paymentrecords`
--

CREATE TABLE `paymentrecords` (
  `paymentId` int(11) NOT NULL,
  `studentId` int(11) DEFAULT NULL,
  `studentName` varchar(25) DEFAULT NULL,
  `location` varchar(25) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `location` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paymentsLog`
--

CREATE TABLE `paymentsLog` (
  `paymentId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `packageId` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paymentsLog`
--

INSERT INTO `paymentsLog` (`paymentId`, `studentId`, `packageId`, `date`) VALUES
(1, 7, 1, '2016-12-04'),
(2, 7, 1, '2016-12-04'),
(3, 7, 1, '2016-12-03'),
(4, 7, 1, '2016-12-04'),
(5, 7, 1, '2016-12-04'),
(6, 7, 1, '2016-12-04'),
(7, 7, 1, '2016-12-04'),
(8, 7, 1, '2016-12-04'),
(9, 7, 1, '2016-12-04'),
(10, 7, 1, '2016-12-04'),
(11, 7, 1, '2016-12-04'),
(12, 7, 1, '2016-12-04'),
(13, 7, 1, '2016-12-04'),
(14, 7, 1, '2016-12-04'),
(15, 7, 1, '2016-12-04'),
(16, 7, 1, '2016-12-04'),
(17, 7, 1, '2016-12-04'),
(18, 7, 1, '2016-12-04'),
(19, 7, 1, '2016-12-04'),
(20, 7, 1, '2016-12-04'),
(21, 7, 1, '2016-12-04'),
(22, 7, 1, '2016-12-04'),
(23, 7, 1, '2016-12-04'),
(24, 7, 1, '2016-12-04'),
(25, 7, 1, '2016-12-04'),
(26, 7, 1, '2016-12-04'),
(27, 7, 1, '2016-12-04'),
(28, 7, 1, '2016-12-04'),
(29, 7, 1, '2016-12-04'),
(30, 7, 1, '2016-12-04'),
(31, 7, 1, '2016-12-04'),
(32, 7, 1, '2016-12-04'),
(33, 7, 1, '2016-12-04'),
(34, 7, 1, '2016-12-04'),
(35, 7, 1, '2016-12-04'),
(36, 7, 1, '2016-12-04'),
(37, 7, 1, '2016-12-04'),
(38, 7, 1, '2016-12-04'),
(39, 7, 1, '2016-12-04'),
(40, 7, 1, '2016-12-04'),
(41, 34, 4, '2016-12-05'),
(42, 34, 4, '2016-12-05'),
(43, 32, 3, '2016-12-05'),
(44, 34, 0, '2016-12-05'),
(45, 35, 3, '2016-12-05'),
(46, 35, 5, '2016-12-05'),
(47, 36, 2, '2016-12-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `studentInscriptionLog`
--

CREATE TABLE `studentInscriptionLog` (
  `studentId` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `studentInscriptionLog`
--

INSERT INTO `studentInscriptionLog` (`studentId`, `date`) VALUES
(5, '2016-12-02'),
(6, '2016-12-02'),
(7, '2016-12-03'),
(8, '2016-12-04'),
(9, '2016-12-04'),
(10, '2016-12-04'),
(11, '2016-12-04'),
(12, '2016-12-04'),
(13, '2016-12-04'),
(14, '2016-12-04'),
(15, '2016-12-04'),
(16, '2016-12-04'),
(17, '2016-12-04'),
(18, '2016-12-04'),
(19, '2016-12-04'),
(20, '2016-12-04'),
(21, '2016-12-04'),
(22, '2016-12-04'),
(23, '2016-12-04'),
(24, '2016-12-04'),
(25, '2016-12-04'),
(26, '2016-12-04'),
(27, '2016-12-04'),
(28, '2016-12-04'),
(29, '2016-12-04'),
(30, '2016-12-04'),
(31, '2016-12-04'),
(32, '2016-12-04'),
(33, '2016-12-04'),
(34, '2016-12-04'),
(35, '2016-12-05'),
(36, '2016-12-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 NOT NULL DEFAULT 'No definido'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`id`, `name`) VALUES
(33, 'Isis Ramirez'),
(34, 'Testeroni Flexeroni'),
(35, 'Alejandro Montañez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `packageId` int(11) DEFAULT NULL,
  `classesRemaining` int(11) NOT NULL DEFAULT '0',
  `paymentDay` enum('15','30') NOT NULL DEFAULT '15'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `studentId`, `packageId`, `classesRemaining`, `paymentDay`) VALUES
(2, 32, 3, 34, '15'),
(3, 33, 0, 0, ''),
(4, 34, 0, 0, '15'),
(5, 35, 5, 12, '30'),
(6, 36, 2, 34, '30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `assistancelog`
--
ALTER TABLE `assistancelog`
  ADD PRIMARY KEY (`studentId`,`date`,`time`);

--
-- Indices de la tabla `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paymentrecords`
--
ALTER TABLE `paymentrecords`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paymentsLog`
--
ALTER TABLE `paymentsLog`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indices de la tabla `studentInscriptionLog`
--
ALTER TABLE `studentInscriptionLog`
  ADD PRIMARY KEY (`studentId`);

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paymentsLog`
--
ALTER TABLE `paymentsLog`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;