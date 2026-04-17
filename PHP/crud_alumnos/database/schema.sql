-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-04-2026 a las 17:08:31
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
-- Base de datos: `alumnos_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `edad` int(11) NOT NULL,
  `esfriki` tinyint(1) DEFAULT NULL,
  `nota` float NOT NULL,
  `avatar` varchar(1000) NOT NULL,
  `curso` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `email`, `edad`, `esfriki`, `nota`, `avatar`, `curso`) VALUES
(2, 'Pablo Gomez', 'pablo.gomez@ies.local', 19, 0, 0, 'https://s1.abcstatics.com/media/play/2018/08/22/homer-simpson-kJU--1248x698@abc.JPG', '1DAM'),
(3, 'Lucia Navarro', 'lucia.navarro@ies.local', 20, 0, 0, '', '1DAM'),
(4, 'Sergio Ruiz', 'sergio.ruiz@ies.local', 21, 0, 10, '', '2DAM'),
(5, 'Marta Lopez', 'marta.lopez@ies.local', 18, 0, 0, '', '2DAW'),
(6, 'David Torres', 'david.torres@ies.local', 22, 0, 0, '', '1ASIR'),
(7, 'Carla Perez', 'carla.perez@ies.local', 19, 0, 0, '', '2ASIR'),
(8, 'Hugo Sanchez', 'hugo.sanchez@ies.local', 20, 0, 0, '', '1DAW'),
(12, 'Pepe', 'pepe@gmail.com', 20, 1, 0, '', '1DAM'),
(13, 'Rafa piltrafa', 'rafa@gmail.com', 25, 0, 0, '', '2DAM'),
(14, 'Rafus', 'carla.perez@ies.locals', 20, 0, 0, '', '1DAM'),
(15, 'Rodolfo', 'rodolfo@gmail.com', 20, 1, 0, '', '2ASIX');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
