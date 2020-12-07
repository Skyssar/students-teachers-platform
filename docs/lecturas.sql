-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2020 a las 18:59:51
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lecturas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id_estudiante` int(11) NOT NULL,
  `nombres` varchar(120) NOT NULL,
  `cedula` int(11) NOT NULL,
  `correo` varchar(120) NOT NULL,
  `ciudad` varchar(120) NOT NULL,
  `telefono` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_estudiante`, `nombres`, `cedula`, `correo`, `ciudad`, `telefono`, `id_grado`, `id_usuario`) VALUES
(1, 'Yasar José Cure González', 100345, 'ycure10@gmail.com', 'Ciénaga de Oro', 31451876, 1, 4),
(2, 'María Isabel Pinedo Burgos', 123456, 'mayi_isa@hotmail.com', 'Montería', 342151, 0, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id_grado` int(11) NOT NULL,
  `code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `code`) VALUES
(1, '10A'),
(2, '10B'),
(3, '11A'),
(4, '11B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado_profesor`
--

CREATE TABLE `grado_profesor` (
  `code_grado` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grado_profesor`
--

INSERT INTO `grado_profesor` (`code_grado`, `id_profesor`) VALUES
(1, 2),
(3, 2),
(2, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecturas`
--

CREATE TABLE `lecturas` (
  `id_lectura` int(11) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_profesor` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lecturas`
--

INSERT INTO `lecturas` (`id_lectura`, `titulo`, `contenido`, `fecha`, `id_profesor`, `id_grado`) VALUES
(21, 'Merry Christmas', '<p><span style=\"font-family:Verdana,Geneva,sans-serif\">I wanna wish you a Merry Christmas from the bottom of&nbsp;my heart!</span></p>\r\n', '2020-11-22 20:59:03', 2, 3),
(36, 'Machine Learning and Approachment', '<p><strong>Machine Learning</strong>&nbsp;es una disciplina cient&iacute;fica del &aacute;mbito de la Inteligencia Artificial que crea sistemas que aprenden autom&aacute;ticamente.&nbsp;<em>Aprender</em>&nbsp;en este contexto quiere decir identificar patrones complejos en millones de datos.&nbsp;<strong>La m&aacute;quina que realmente aprende es un algoritmo</strong>&nbsp;que revisa los datos y es capaz de predecir comportamientos futuros.&nbsp;<em>Autom&aacute;ticamente</em>, tambi&eacute;n en este contexto, implica que estos sistemas se mejoran de forma aut&oacute;noma con el tiempo, sin intervenci&oacute;n humana. Veamos c&oacute;mo funciona.</p>\r\n', '2020-11-23 21:09:46', 3, 1),
(41, 'Aplicaciones de la Inteligencia Artificiale', '<p>La&nbsp;Inteligencia Artificial (IA)&nbsp;es la&nbsp;<strong>combinaci&oacute;n de algoritmos planteados con el prop&oacute;sito de crear m&aacute;quinas que presenten las mismas capacidades que el ser humano.</strong>&nbsp;Una tecnolog&iacute;a que todav&iacute;a nos resulta lejana y misteriosa, pero que desde hace unos a&ntilde;os est&aacute;&nbsp;<strong>presente en nuestro d&iacute;a a d&iacute;a a todas horas.</strong></p>\r\n\r\n<p>La IA est&aacute; presente en la&nbsp;<strong>detecci&oacute;n facial de los m&oacute;viles,</strong>&nbsp;en los&nbsp;<strong>asistentes virtuales de voz</strong>&nbsp;como Siri de Apple, Alexa de Amazon o Cortana de Microsoft y est&aacute;&nbsp;<strong>integrada en nuestros dispositivos cotidianos a trav&eacute;s de&nbsp;bots</strong>&nbsp;(abreviatura de robots) o&nbsp;<strong>aplicaciones para m&oacute;vil.</strong></p>\r\n', '2020-11-26 17:50:24', 2, 1),
(42, 'One Vision', '<p><strong><tt><span style=\"color:#2980b9\">No hate, no fight, just excitation.&nbsp;</span></tt></strong></p>\r\n', '2020-11-30 15:30:50', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_estudiante`
--

CREATE TABLE `notas_estudiante` (
  `id_nota` int(11) NOT NULL,
  `id_lectura` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `nota` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas_estudiante`
--

INSERT INTO `notas_estudiante` (`id_nota`, `id_lectura`, `id_estudiante`, `nota`) VALUES
(11, 42, 1, 2.5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_pregunta` int(11) NOT NULL,
  `numero_pregunta` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `respuesta_a` varchar(200) NOT NULL,
  `respuesta_b` varchar(200) NOT NULL,
  `respuesta_c` varchar(200) NOT NULL,
  `respuesta_d` varchar(200) NOT NULL,
  `correcta` varchar(1) NOT NULL,
  `id_lectura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_pregunta`, `numero_pregunta`, `pregunta`, `respuesta_a`, `respuesta_b`, `respuesta_c`, `respuesta_d`, `correcta`, `id_lectura`) VALUES
(11, 1, ' ¿Qué significa giving away?', '4 PM', 'sIUUU', 'Irse muy lejos', 'Comer', 'c', 21),
(16, 2, 'What does I wish to you?', 'Happy New Year', 'Merry Christmas', 'Happy Birthday', 'Merry Saint Valentine', 'b', 21),
(18, 1, ' La IA es una tecnología...', 'Interesante pero imposible', 'Antigua pero efectiva', 'Poderosa pero inefectiva', 'Misteriosa pero presente', 'd', 41),
(19, 2, '¿Qué busca la IA?', 'Crear máquinas que presenten las mismas capacidades que el ser humano', 'Crear humanos que presenten las mismas capacidades que las máquinas', 'Crear algoritmos que permitan la seguridad informática', 'Conseguir la inmortalidad a través de la tecnología', 'a', 41),
(20, 3, ' NO es una Inteligencia Artificial', 'Detección facial', 'Asistente virtual', 'Leonel Messi', 'Bot de un videojuego', 'c', 41),
(21, 4, ' El objetivo de la IA es', 'Conocer el universo aún desconocido', 'Mejorar la vida de las personas', 'Generar una solución empresarial', 'Crear un arma de destrucción masiva', 'b', 41),
(27, 1, ' Tie a Mother Down?', 'Yeah, sure', 'Thank you everybody', 'I am in ecstasy', 'This is cool', 'a', 42),
(28, 2, ' No man, no light?', 'Obviously', 'One Vision', 'This one solution', 'None', 'b', 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id_profesor` int(11) NOT NULL,
  `nombres` varchar(120) NOT NULL,
  `cedula` int(11) NOT NULL,
  `correo` varchar(120) NOT NULL,
  `ciudad` varchar(120) NOT NULL,
  `telefono` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id_profesor`, `nombres`, `cedula`, `correo`, `ciudad`, `telefono`, `id_usuario`) VALUES
(2, 'Juan Queso', 123, 'ycure10@gmail.com', 'Ciénaga de Oro', 312, 2),
(3, 'David Álvarez Martínez', 3214532, 'yonyyepezfuentes@gmail.com', 'Ponferradina', 987362, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_estudiantes`
--

CREATE TABLE `respuestas_estudiantes` (
  `id_estudiante` int(11) NOT NULL,
  `id_lectura` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `respuesta` varchar(1) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `respuestas_estudiantes`
--

INSERT INTO `respuestas_estudiantes` (`id_estudiante`, `id_lectura`, `id_pregunta`, `respuesta`, `status`) VALUES
(1, 42, 27, 'b', 0),
(1, 42, 28, 'b', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Docente'),
(2, 'Estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `token` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `password`, `id_rol`, `token`) VALUES
(2, 'profesor', '$2y$10$B1KC4VeNFVupwm2OyB7EH.QYyzV/DnAI0JEIbTBDP6RLFl8ZsV08q', 1, 964649),
(4, 'Skyssar', '$2y$10$4re/5V39hs7nXsMI.AqyZuJ99dPv4ymqPthUSB8aIYmn1hJ4ad.W2', 2, 548856),
(5, 'mayi_isa', '$2y$10$e5n6OWbeyxMhOrPzopEY0u7/uB2AYcKOCaWjCr4JEZ7s8kriiMJOS', 2, 0),
(6, 'davidam', '$2y$10$Wv3bTrMLfyczHbBwKFnPTOQ82w1VYRnE2hxbNMkALwVJjLPOAmDMW', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id_estudiante`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `grado_profesor`
--
ALTER TABLE `grado_profesor`
  ADD KEY `code_grado` (`code_grado`),
  ADD KEY `id_profesor` (`id_profesor`);

--
-- Indices de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD PRIMARY KEY (`id_lectura`),
  ADD KEY `id_profesor` (`id_profesor`),
  ADD KEY `id_grado` (`id_grado`);

--
-- Indices de la tabla `notas_estudiante`
--
ALTER TABLE `notas_estudiante`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_estudiante` (`id_estudiante`),
  ADD KEY `notas_estudiante_ibfk_2` (`id_lectura`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `preguntas_ibfk_1` (`id_lectura`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id_profesor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `respuestas_estudiantes`
--
ALTER TABLE `respuestas_estudiantes`
  ADD KEY `respuestas_estudiantes_ibfk_1` (`id_estudiante`),
  ADD KEY `respuestas_estudiantes_ibfk_2` (`id_lectura`),
  ADD KEY `respuestas_estudiantes_ibfk_3` (`id_pregunta`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  MODIFY `id_lectura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `notas_estudiante`
--
ALTER TABLE `notas_estudiante`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id_profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `grado_profesor`
--
ALTER TABLE `grado_profesor`
  ADD CONSTRAINT `grado_profesor_ibfk_1` FOREIGN KEY (`code_grado`) REFERENCES `grado` (`id_grado`),
  ADD CONSTRAINT `grado_profesor_ibfk_2` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id_profesor`);

--
-- Filtros para la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD CONSTRAINT `lecturas_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id_profesor`),
  ADD CONSTRAINT `lecturas_ibfk_2` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`);

--
-- Filtros para la tabla `notas_estudiante`
--
ALTER TABLE `notas_estudiante`
  ADD CONSTRAINT `notas_estudiante_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notas_estudiante_ibfk_2` FOREIGN KEY (`id_lectura`) REFERENCES `lecturas` (`id_lectura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`id_lectura`) REFERENCES `lecturas` (`id_lectura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `respuestas_estudiantes`
--
ALTER TABLE `respuestas_estudiantes`
  ADD CONSTRAINT `respuestas_estudiantes_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respuestas_estudiantes_ibfk_2` FOREIGN KEY (`id_lectura`) REFERENCES `lecturas` (`id_lectura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respuestas_estudiantes_ibfk_3` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id_pregunta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
