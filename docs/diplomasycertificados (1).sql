-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-02-2024 a las 06:26:05
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
-- Base de datos: `diplomasycertificados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoriaId` int(11) NOT NULL,
  `categoriaNombre` varchar(150) DEFAULT NULL,
  `categoriaFechaCreacion` datetime DEFAULT NULL,
  `categoriaEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoriaId`, `categoriaNombre`, `categoriaFechaCreacion`, `categoriaEstado`) VALUES
(1, 'PROGRAMACiONES', '2021-04-26 20:27:52', 1),
(2, 'MARKETING', '2021-04-26 20:27:52', 1),
(3, 'NEGOCIOS1', '2021-04-26 20:27:52', 0),
(4, 'EDUCACION', '2021-04-26 20:27:52', 1),
(9, 'Negocios', '2024-01-27 23:50:08', 1),
(10, 'Programacion21', '2024-01-27 23:51:55', 0),
(11, 'Arquitectura', '2024-02-16 00:25:54', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `cursoId` int(11) NOT NULL,
  `cursoInstructorId` int(11) DEFAULT NULL,
  `cursoCategoriaId` int(11) DEFAULT NULL,
  `cursoNombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cursoDescripcion` varchar(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cursoFechaInicio` date DEFAULT NULL,
  `cursoFechaFin` date DEFAULT NULL,
  `cursoImagen` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cursoFechaCreacion` datetime DEFAULT NULL,
  `cursoEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`cursoId`, `cursoInstructorId`, `cursoCategoriaId`, `cursoNombre`, `cursoDescripcion`, `cursoFechaInicio`, `cursoFechaFin`, `cursoImagen`, `cursoFechaCreacion`, `cursoEstado`) VALUES
(5, 2, 1, 'cHATGPT1', 'test', '2024-01-01', '2023-11-28', '../../public/672117671.png', '2024-01-25 22:37:41', 1),
(34, 1, 2, 'ko-ko', 'tets', '2024-01-01', '2024-01-23', '../../public/1060328349.png', '2024-01-28 23:20:24', 1),
(35, 12, 4, 'CTA2', 'CASDAde', '2024-02-01', '2024-02-29', '../../public/103149935.png', '2024-02-16 00:06:27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecurso`
--

CREATE TABLE `detallecurso` (
  `detallecursoId` int(11) NOT NULL,
  `detallecursoCursoId` int(11) DEFAULT NULL,
  `detallecursoUsuarioId` int(11) DEFAULT NULL,
  `detallecursoFechaCreacion` datetime DEFAULT NULL,
  `detallecursoEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallecurso`
--

INSERT INTO `detallecurso` (`detallecursoId`, `detallecursoCursoId`, `detallecursoUsuarioId`, `detallecursoFechaCreacion`, `detallecursoEstado`) VALUES
(1, 5, 1, '2024-02-18 22:54:57', 0),
(2, 5, 10, '2024-02-18 22:54:57', 0),
(3, 5, 1, '2024-02-18 22:56:16', 0),
(4, 5, 1, '2024-02-18 22:56:55', 1),
(5, 34, 1, '2024-02-18 22:57:18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE `instructor` (
  `instructorId` int(11) NOT NULL,
  `instructorNombre` varchar(150) DEFAULT NULL,
  `instructorApellidoPaterno` varchar(150) DEFAULT NULL,
  `instructorApellidoMaterno` varchar(150) DEFAULT NULL,
  `instructorCorreo` varchar(100) DEFAULT NULL,
  `instructorTelefono` varchar(12) DEFAULT NULL,
  `instructorSexo` varchar(1) DEFAULT NULL,
  `instructorFechaCreacion` datetime DEFAULT NULL,
  `instructorEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`instructorId`, `instructorNombre`, `instructorApellidoPaterno`, `instructorApellidoMaterno`, `instructorCorreo`, `instructorTelefono`, `instructorSexo`, `instructorFechaCreacion`, `instructorEstado`) VALUES
(1, 'Robert', 'Palma', 'PALMA', 'RPALMA@TEST.COM.PE', '5555555', 'M', '2021-04-26 20:24:06', 1),
(2, 'Austin', 'Timberlake', 'Medrano', 'austin@gmail.com', '5555555', 'M', '2021-04-26 20:24:06', 1),
(9, 'Cesar', 'Vallejo', 'Medrano', 'CVALLEJO@MEDRANO.COM.PE', '5555555', 'M', '2024-01-28 23:52:42', 1),
(10, 'Josefina', 'Ramona', 'Ferrer', 'josefina@gamil.com', '5555555', 'F', '2024-01-28 23:55:24', 1),
(11, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-15 23:33:57', 0),
(12, 'Charly2', 'Rode', 'felr', 'car@gmail.com', '76543223', 'M', '2024-02-15 23:39:16', 1),
(13, 'Charly', 'Rodered', 'ferrer', 'car@gmail.com', '76543223', 'M', '2024-02-15 23:39:38', 0),
(14, 'Charly2', 'Rodered', 'ferrer', 'car@gmail.com', '76543223', 'M', '2024-02-15 23:40:17', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rolId` int(11) NOT NULL,
  `rolDescripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rolId`, `rolDescripcion`) VALUES
(1, 'User'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuarioId` int(11) NOT NULL,
  `usuarioNombre` varchar(150) DEFAULT NULL,
  `usuarioApellidoPaterno` varchar(150) DEFAULT NULL,
  `usuarioApellidoMaterno` varchar(150) DEFAULT NULL,
  `usuarioCorreo` varchar(100) DEFAULT NULL,
  `usuarioPassword` varchar(10) DEFAULT NULL,
  `usuarioSexo` varchar(1) DEFAULT NULL,
  `usuarioTelefono` varchar(12) DEFAULT NULL,
  `usuarioRolId` int(11) DEFAULT NULL,
  `usuarioDni` int(11) DEFAULT NULL,
  `usuarioFechaCreacion` datetime DEFAULT NULL,
  `usuarioEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuarioId`, `usuarioNombre`, `usuarioApellidoPaterno`, `usuarioApellidoMaterno`, `usuarioCorreo`, `usuarioPassword`, `usuarioSexo`, `usuarioTelefono`, `usuarioRolId`, `usuarioDni`, `usuarioFechaCreacion`, `usuarioEstado`) VALUES
(1, 'Administrador', 'Solsol', 'Abelardo', 'admin@gmail.com', '123456', 'M', '99872343', 2, 12345678, '2024-01-01 23:11:15', 1),
(2, 'User1', 'Use', 'Ser1', 'user1@gmail.com', '123456', 'M', '9876543', 1, 12345679, '2024-01-04 23:05:55', 0),
(3, 'UserTes', 'teset1', 'tesda2', 'usert1@gmail.com', '123456', 'M', '12315135', 1, 12345610, '2024-01-31 14:27:31', 1),
(4, 'Admin', 'Ministrar', 'Minis', 'admin@gmail.com', '123456', 'F', '98765456', 2, 12345611, '2024-01-31 14:29:50', 0),
(9, 'Uno', 'Ministrar', 'Minis', 'ad@gmail.com', '123456', 'F', '1341221', 2, 12345612, '2024-02-15 23:20:26', 1),
(10, 'Uno', 'trar', 'Minis', 'ad@gmail.com', '123456', 'F', '1341221', 1, 12345613, '2024-02-15 23:21:49', 1),
(11, 'test1', 'testap', 'testema', 'tes@gmail.com', '123456', 'M', '98765456', 1, NULL, '2024-02-19 00:14:51', 1),
(12, 'Test2', 'testap', 'testmat', 'test2@gmail.com', '123456', 'M', '98765456', 1, 87654322, '2024-02-19 00:16:56', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoriaId`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cursoId`);

--
-- Indices de la tabla `detallecurso`
--
ALTER TABLE `detallecurso`
  ADD PRIMARY KEY (`detallecursoId`),
  ADD KEY `detallecurso_ibfk_1` (`detallecursoCursoId`),
  ADD KEY `detallecurso_ibfk_2` (`detallecursoUsuarioId`);

--
-- Indices de la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instructorId`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rolId`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuarioId`),
  ADD KEY `fk_usuario_rol` (`usuarioRolId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoriaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `cursoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `detallecurso`
--
ALTER TABLE `detallecurso`
  MODIFY `detallecursoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rolId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuarioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallecurso`
--
ALTER TABLE `detallecurso`
  ADD CONSTRAINT `detallecurso_ibfk_1` FOREIGN KEY (`detallecursoCursoId`) REFERENCES `curso` (`cursoId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallecurso_ibfk_2` FOREIGN KEY (`detallecursoUsuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuarioRolId_ibfk_1` FOREIGN KEY (`usuarioRolId`) REFERENCES `rol` (`rolId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
