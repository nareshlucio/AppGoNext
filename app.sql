-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-08-2020 a las 22:57:14
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id` int(11) NOT NULL,
  `id_usuario` int(3) NOT NULL,
  `tipo_usuario` varchar(30) NOT NULL,
  `cordenadas_longitud` double NOT NULL,
  `cordenadas_latitud` double NOT NULL,
  `activo` int(1) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id`, `id_usuario`, `tipo_usuario`, `cordenadas_longitud`, `cordenadas_latitud`, `activo`, `estado`) VALUES
(1, 1, 'usuario', -99.0310355, 19.6829219, 0, 'inactivo'),
(2, 2, 'usuario', -99.0310355, 19.6829219, 0, 'inactivo'),
(3, 3, 'usuario', -99.0310355, 19.6829219, 0, 'inactivo'),
(4, 4, 'usuario', -99.0310355, 19.6829219, 0, 'inactivo'),
(5, 5, 'usuario', -99.0310355, 19.6829219, 0, 'inactivo'),
(6, 1, 'conductor', -99.02918, 19.681225, 1, 'esperando');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductores`
--

CREATE TABLE `conductores` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `conductores`
--

INSERT INTO `conductores` (`id`, `Nombre`, `apellidos`, `correo`, `password`, `marca`, `modelo`, `matricula`, `telefono`, `foto`) VALUES
(1, 'David Naresh', 'Lucio López', 'poti@live.com.mx', '1234as', 'Renauld', 'Clio_2008', 'MXTR208', '5538183969', NULL),
(2, 'David', 'Lucio Landin', 'enano1971@live.com.mx', '$2y$10$q.5oeTTcIeWmRbZTQcIvhOdFhHOv4Z6AK3wdJJhQ1s/A05qSppVMq', 'chebrolet', 'aveo', 'MXTS865', '5552155285', NULL),
(3, 'Uriel Liam ', 'Lucio López ', 'liamswag@gmail.com', '$2y$10$n9UZ6uYBEXYOKgBugh63gePoTG7ZoDRebGCerTco3WkFw1oW7GW4W', 'Nissan', 'GTR', 'RSLN457', '5587150923', NULL),
(4, 'Ana Maria ', 'López Rivera ', 'naniz@live.com.mx', '$2y$10$.QPNC5Tf/CaxhZB123v/kuiIuOjNJo5QP/48IMlhY2fKbo7iC4FX6', 'Chevrolet', 'Chevi', 'MLAN144', '5520913792', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperaciones`
--

CREATE TABLE `recuperaciones` (
  `id` int(10) NOT NULL,
  `Id_usuario` int(10) NOT NULL,
  `url_secreta` varchar(255) NOT NULL,
  `token` int(5) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recuperaciones`
--

INSERT INTO `recuperaciones` (`id`, `Id_usuario`, `url_secreta`, `token`, `estado`, `fecha`) VALUES
(1, 1, 'a76f19cd5230eb6022bd7e16a4cd79292fda42a783adaa32a4b87d4f2761f875', 12345, 'Usado', '2020-01-26 00:02:40'),
(2, 1, '03d1ff5238a41d9928c9dd9ca70bd9f4719723572b9f452758561ee6c4966d89', 67891, 'Usado', '2020-01-28 16:06:33'),
(3, 1, 'b6c191bc350e17453b12fcc86da6a1a0d47141ece33ecbac0f8b396fcb30b8af', 30573, 'Usado', '2020-03-22 23:14:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `Apellidos` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Alias` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Telefono` varchar(13) NOT NULL,
  `Edad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `Apellidos`, `Nombre`, `Alias`, `Correo`, `Password`, `Telefono`, `Edad`) VALUES
(1, 'David Naresh', 'Lucio López', 'Poti7652', 'poti9976@gmail.com', '$2y$10$ubg6RbL0W/fiFyjRzPOyqORtkqAp3UGJq0by5p23I/7D0slnwXH1u', '5552155285', '1999-04-13'),
(2, 'Uriel Liam', 'Lucio López', 'Sonic02z', 'liamswag@gmail.com', '$2y$10$DXCRSKG8FTFpdhJ71lxLROFQefjKKKa17zEH2vmOjxIG5pqIUpKSC', '5567891234', '2002-07-07'),
(3, 'Daniel', 'González', 'dan', '1234', '$2y$10$JpEHQP57nbmYjeWJ2dh.jOfAEcvwtLAwliNQIH3zgpnX66UpJXVgu', '+525583620', '0000-00-00'),
(4, 'David', 'Lucio Landin', 'Enano', 'poti@live.com.mx', '$2y$10$T8qgGSGsR.7furqPbQ0QqO9uVhj00Hz9ggBEpqcx0J7DMYTdzW8T6', '5552155285', '1971-07-01'),
(5, 'López Rivera', 'Ana Maria', 'NanizLinda', 'naniz@live.com.mx', '$2y$10$UxWNFMf92tiZ6ZAAhAZeQueNHSqRPwVh.kQ90AAxqx11RCdv0Kb.G', '5552155285', '1970-07-05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `conductores`
--
ALTER TABLE `conductores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recuperaciones`
--
ALTER TABLE `recuperaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Id_usuario` (`Id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `conductores`
--
ALTER TABLE `conductores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `recuperaciones`
--
ALTER TABLE `recuperaciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `recuperaciones`
--
ALTER TABLE `recuperaciones`
  ADD CONSTRAINT `recuperaciones_ibfk_1` FOREIGN KEY (`Id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
