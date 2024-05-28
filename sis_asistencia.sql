-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 19:09:15
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sis_asistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `entrada` datetime DEFAULT NULL,
  `salida` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `id_empleado`, `entrada`, `salida`) VALUES
(51, 11, '2024-05-09 10:04:22', '2024-05-09 10:04:42'),
(52, 12, '2024-05-09 10:07:24', '2024-05-09 10:07:53'),
(53, 11, '2024-05-13 17:02:09', '2024-05-13 17:54:23'),
(54, 18, '2024-05-13 17:31:04', '2024-05-13 17:56:00'),
(57, 16, '2024-05-14 09:08:49', '2024-05-14 09:08:59'),
(58, 15, '2024-05-14 09:10:05', '2024-05-14 09:10:22'),
(59, 12, '2024-05-19 13:07:05', '2024-05-19 13:35:43'),
(60, 11, '2024-05-19 13:38:22', '2024-05-19 13:38:22'),
(61, 17, '2024-05-19 14:20:05', '2024-05-19 14:21:10'),
(62, 18, '2024-05-19 18:37:36', '2024-05-19 18:39:06'),
(63, 11, '2024-05-20 09:33:01', '2024-05-20 09:45:59'),
(64, 12, '2024-05-20 09:47:21', '2024-05-20 09:49:49'),
(65, 13, '2024-05-21 09:39:51', '2024-05-21 09:42:59'),
(66, 11, '2024-05-21 17:56:27', '2024-05-21 18:52:45'),
(68, 12, '2024-05-25 19:46:54', '2024-05-25 19:51:18'),
(69, 11, '2024-05-27 08:26:39', '2024-05-27 08:28:12'),
(71, 11, '2024-05-28 08:24:38', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `nombre`) VALUES
(24, 'Sistemas'),
(25, 'Civil'),
(26, 'Bioquimíca'),
(27, 'Administración'),
(28, 'Informática'),
(29, 'Electromecánica'),
(30, 'Gestión');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `dni` varchar(255) NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre`, `apellido`, `dni`, `cargo`) VALUES
(11, 'Yuliana del Carmen', 'Altamirano Montes', '20350250', 24),
(12, 'Gerardo Luis', 'Quiroga León', '20350309', 24),
(13, 'Rocio', 'Carlos Contrera', '20350255', 24),
(14, 'Jennifer', 'Vendrell Javier', '20350326', 24),
(15, 'Paola Estefania', 'Flores Durán', '20350639', 24),
(16, 'Juan José', 'Contreras Silva', '20350528', 24),
(17, 'Jared Sam', 'Leyva Ferrer', '20350286', 24),
(18, 'Edgar Gabriel', 'Cámara Briones', '20350658', 24),
(19, 'Maria de los Angeles', 'Hernandez', '20351235', 26),
(20, 'Maria', 'Hernandez', '20351213', 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `ruc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nombre`, `telefono`, `ubicacion`, `ruc`) VALUES
(1, 'Instituto Técnologico de Tuxtepec, OAX.', '287 875 1880', 'Avenida Dr, Víctor Bravo Ahuja S/N, 5 de Mayo, 68350.', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `usuario`, `password`) VALUES
(1, 'Yuliana del Carmen', 'Altamirano Montes', '20350250', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `fk2` (`id_empleado`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `fk1` (`cargo`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`id_cargo`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
