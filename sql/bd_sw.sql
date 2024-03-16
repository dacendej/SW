-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2024 a las 15:54:56
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
-- Base de datos: `bd_sw`
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

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`ID`, `Titulo`, `Usuario`, `Juego`, `Tipo`, `Fecha`, `Contenido`) VALUES
(1, 'Ayuda no puedo pasar', 'dacendej', 'Dark Souls', 'Duda', '2007-03-24', 'Llevo 5 días intentando pasarme las gargolas pero no consigo matar a la segunda. ¿Algun truco para que no me mate el fuego? Gracias!'),
(2, 'Como hacer un portal', 'jorglo03', 'Minecraft', 'Guia', '2010-03-24', 'Primero has de hacerte con un pico de diamante para poder picar 10 bloques de obsidiana, luego tienes que ponerlos en forma de portal y prender la parte inferior con un mechero. Listo! Si el portal se ha puesto en morado, cruzalo y estaras en el nether.'),
(3, 'Mejor configuracion?', 'dacendej', 'Fortnite', 'Duda', '2010-03-24', '¿Alguien sabe cual es la mejor configuracion para un PC de gama media? No consigo mas de 30 fps.');

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

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`ID`, `Titulo`, `Usuario`, `Fecha`, `Contenido`) VALUES
(1, 'Xbox Game Pass anuncia un juego por sorpresa', 'dacendej', '2007-03-24', 'A los miembros de Xbox Game Pass no se nos da un respiro con tantos títulos como tenemos disponibles en el catálogo. Sin embargo, el equipo responsable del servicio sigue trabajando para añadirnos más juegos al listado de pendientes. Hace escasos días conocimos los títulos de todos aquellos que llegarán durante la priemera quincena de marzo, pero parece que se dejaron uno en el tintero.\r\n\r\nNo es habitual que esto ocurra, pero al equipo de Xbox Game Pass le gusta juguetear con sus planes y sorprender de vez en cuando a los miembros de la suscripción. Y así es como la cuenta oficial del servicio ha anunciado por sorpresa y sin que nadie lo esperara, una nueva entrada que llega el 11 de marzo, y es NBA 2K24.\r\n\r\nNBA 2K24 nos sumerge en la esencia del baloncesto con una experiencia que abarca el pasado, presente y futuro de este deporte con un amplio abanico de modos de juego: Disfruta de la acción sin límites y personaliza tu Mi JUGADOR en Mi CARRERA. Colecciona leyendas para formar tu equ'),
(2, 'Nintendo pone fecha a la próxima película de Super', 'dacendej', '2024-03-10', 'La gente vuelve a sonreír, se ha anunciado en el Mario Day muchas novedades sobre el futuro de esta franquicia que encantarán a los jugadores y a las millones de personas que fueron a ver Super Mario Bros La Película al cine. Hace varios meses os hablamos de que no esperes pronto la próxima película de Super Mario Bros, pues la huelga de guionistas y actores había retrasado los planes, pero ahora ya tenemos fecha definitiva para esta producción.\r\nEn el canal de YouTube de Nintendo España Shigeru Miyamoto ha hablado sobre  las próximas novedades de la exitosa e histórica franquicia Mario. Lo más destacado ha sido que tanto Nintendo como Illumination ya están \"produciendo una nueva película animada basada en el mundo de Super Mario Bros\". Está previsto que \"se estrene el 3 de abril de 2026 en los EE. UU. y en muchos mercados adicionales a nivel mundial\", según lee en un comunicado en la web oficial.');

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

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`ID`, `ID foro`, `Usuario`, `Fecha`, `Contenido`) VALUES
(1, 1, 'rauare01', '2007-03-24', 'Te recomiendo ir al herrero y mejorar el arma a +5. Estuve en tu misma situacion y me apañe con eso. Pruebalo y me cuentas.'),
(2, 1, 'josev27', '2010-03-24', 'No se bro simplemente mejora, yo me lo pase a la primera XD'),
(3, 2, 'dacendej', '2011-03-24', 'Wow, no sabia que era tan facil. Gracias por la guia tio!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sugerenciasjuegos`
--

CREATE TABLE `sugerenciasjuegos` (
  `ID` int(5) NOT NULL,
  `Juego` varchar(20) NOT NULL,
  `Año de salida` int(4) NOT NULL,
  `Desarrollador` varchar(10) NOT NULL,
  `Genero` varchar(10) NOT NULL,
  `Descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sugerenciasjuegos`
--

INSERT INTO `sugerenciasjuegos` (`ID`, `Juego`, `Año de salida`, `Desarrollador`, `Genero`, `Descripcion`) VALUES
(1, 'Dark Souls', 2011, 'From Softw', 'RPG', 'Dark Souls 1 es el primer juego de la saga Dark Souls. El juego tiene lugar en el reino de Lordran, '),
(2, 'Minecraft', 2011, 'Mojang', 'Sandbox', 'Minecraft es un videojuego sandbox enfocado en permitirle al jugador explorar y modificar un mundo generado dinámicamente hecho de bloques de un metro cúbico. Es mantenido por Mojang Studios, que forma parte de Xbox Game Studios, que a su vez es parte de Microsoft.'),
(3, 'ASDFGHJKL', 1111, 'Yo', 'RPG', 'Prueba de juego no valido'),
(4, 'Fortnite', 2017, 'Epic Games', 'Battle Roy', 'Fortnite es un mundo de experiencias múltiples. Dejaos caer en la isla y competid hasta ser los últimos jugadores (o equipos) que queden en pie. Cread una isla personalizada con vuestras propias reglas. Quedad con vuestros amigos en una isla creada por una de vuestras amistades. O eliminad hordas de monstruos con otros jugadores para salvar el mundo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Usuario` varchar(15) NOT NULL,
  `Nombre Completo` varchar(40) NOT NULL,
  `Edad` int(3) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Contraseña` varchar(20) NOT NULL,
  `Experto` tinyint(1) NOT NULL,
  `Moderador` tinyint(1) NOT NULL,
  `Admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Usuario`, `Nombre Completo`, `Edad`, `Correo`, `Contraseña`, `Experto`, `Moderador`, `Admin`) VALUES
('dacendej', 'David Cendejas', 20, 'dacendej@ucm.es', 'AmorPorJorglo123', 1, 1, 1),
('jorglo03', 'Jorge Lopez', 15, 'jorglo03@ucm.es', 'NodoFantasmaLover', 1, 0, 0),
('josev27', 'Jose Galvez', 57, 'josegalvezv27@gmail.com', 'HackerBOYxx', 0, 0, 0),
('rauare01', 'Raul Arellano', 20, 'rauare01@ucm.es', 'YoSePilaaa', 1, 1, 0);

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
-- Volcado de datos para la tabla `videojuegos`
--

INSERT INTO `videojuegos` (`ID`, `Juego`, `Año de salida`, `Desarrollador`, `Genero`, `Nota`, `nResenias`, `Descripcion`) VALUES
(1, 'Dark Souls', 2011, 'From Softw', 'RPG', 8, 1, 'Dark Souls 1 es el primer juego de la saga Dark Souls. El juego tiene lugar en el reino de Lordran, '),
(2, 'Minecraft', 2011, 'Mojang', 'Sandbox', 10, 2, 'Minecraft es un videojuego sandbox enfocado en permitirle al jugador explorar y modificar un mundo generado dinámicamente hecho de bloques de un metro cúbico. Es mantenido por Mojang Studios, que forma parte de Xbox Game Studios, que a su vez es parte de Microsoft.'),
(3, 'Fortnite', 2017, 'Epic Games', 'Battle Roy', 5, 10, 'Fortnite es un mundo de experiencias múltiples. Dejaos caer en la isla y competid hasta ser los últimos jugadores (o equipos) que queden en pie. Cread una isla personalizada con vuestras propias reglas. Quedad con vuestros amigos en una isla creada por una de vuestras amistades. O eliminad hordas de monstruos con otros jugadores para salvar el mundo.');

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
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sugerenciasjuegos`
--
ALTER TABLE `sugerenciasjuegos`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

--
-- Filtros para la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD CONSTRAINT `videojuegos_ibfk_1` FOREIGN KEY (`Juego`) REFERENCES `sugerenciasjuegos` (`Juego`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
