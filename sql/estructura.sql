-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2024 a las 18:07:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gameforum`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `ID` int(5) UNSIGNED NOT NULL,
  `Titulo` varchar(20) NOT NULL,
  `Usuario` varchar(15) NOT NULL,
  `Juego` varchar(20) NOT NULL,
  `Tipo` varchar(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Contenido` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(32) UNSIGNED NOT NULL,
  `ruta` varchar(512) NOT NULL,
  `descripcion` varchar(512) NOT NULL,
  `noticia_id` int(5) UNSIGNED DEFAULT NULL,
  `foro_id` int(5) UNSIGNED DEFAULT NULL,
  `respuestas_id` int(5) UNSIGNED DEFAULT NULL,
  `videojuego_id` int(5) UNSIGNED DEFAULT NULL,
  `sugerencia_juego_id` int(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `ID` int(5) UNSIGNED NOT NULL,
  `Titulo` varchar(50) NOT NULL,
  `Usuario` varchar(15) NOT NULL,
  `Fecha` date NOT NULL,
  `Contenido` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `ID` int(5) UNSIGNED NOT NULL,
  `ID foro` int(5) UNSIGNED NOT NULL,
  `Usuario` varchar(15) NOT NULL,
  `Fecha` date NOT NULL,
  `Contenido` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sugerenciasjuegos`
--

CREATE TABLE `sugerenciasjuegos` (
  `ID` int(5) UNSIGNED NOT NULL,
  `Juego` varchar(20) NOT NULL,
  `Año de salida` int(4) NOT NULL,
  `Desarrollador` varchar(10) NOT NULL,
  `Genero` varchar(10) NOT NULL,
  `Descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Usuario` varchar(15) NOT NULL,
  `Nombre Completo` varchar(40) NOT NULL,
  `Edad` int(3) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Contraseña` varchar(255) DEFAULT NULL,
  `Experto` tinyint(1) NOT NULL,
  `Moderador` tinyint(1) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `JuegosValorados` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojuegos`
--

CREATE TABLE `videojuegos` (
  `ID` int(5) UNSIGNED NOT NULL,
  `Juego` varchar(20) NOT NULL,
  `Año de salida` int(4) NOT NULL,
  `Desarrollador` varchar(10) NOT NULL,
  `Genero` varchar(10) NOT NULL,
  `Nota` float NOT NULL,
  `nResenias` int(5) NOT NULL,
  `Descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Usuario` (`Usuario`),
  ADD KEY `Juego` (`Juego`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foro_id` (`foro_id`),
  ADD KEY `fk_noticia_id` (`noticia_id`),
  ADD KEY `fk_respuestas_id` (`respuestas_id`),
  ADD KEY `fk_videojuego_id` (`videojuego_id`),
  ADD KEY `fk_sugerencia_juego_id` (`sugerencia_juego_id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Usuario` (`Usuario`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID Foro` (`ID foro`),
  ADD KEY `Usuario` (`Usuario`);

--
-- Indices de la tabla `sugerenciasjuegos`
--
ALTER TABLE `sugerenciasjuegos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Juego` (`Juego`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Usuario`);

--
-- Indices de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Juego` (`Juego`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(32) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sugerenciasjuegos`
--
ALTER TABLE `sugerenciasjuegos`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`Usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_ibfk_2` FOREIGN KEY (`Juego`) REFERENCES `videojuegos` (`Juego`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `fk_foro_id` FOREIGN KEY (`foro_id`) REFERENCES `foro` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_noticia_id` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_respuestas_id` FOREIGN KEY (`respuestas_id`) REFERENCES `respuestas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sugerencia_juego_id` FOREIGN KEY (`sugerencia_juego_id`) REFERENCES `sugerenciasjuegos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_videojuego_id` FOREIGN KEY (`videojuego_id`) REFERENCES `videojuegos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`Usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`Usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `respuestas_ibfk_2` FOREIGN KEY (`ID foro`) REFERENCES `foro` (`ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
