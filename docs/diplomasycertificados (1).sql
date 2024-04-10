-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2024 a las 21:42:26
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_categoria` (IN `p_categoriaId` INT)   BEGIN
    UPDATE categoria
    SET categoriaEstado = 0
    WHERE categoriaId = p_categoriaId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_curso` (IN `p_cursoId` INT)   BEGIN
    UPDATE curso
    SET cursoEstado = 0
    WHERE cursoId = p_cursoId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_curso_usuario` (IN `p_detallecursoId` INT)   BEGIN
    UPDATE detallecurso
    SET detallecursoEstado = 0
    WHERE detallecursoId = p_detallecursoId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_instructor` (IN `instructor_id` INT)   BEGIN
    UPDATE instructor
    SET
        instructorEstado = 0
    WHERE
        instructorId = instructor_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_usuario` (IN `p_usuarioId` INT)   BEGIN
    UPDATE usuario
    SET
        usuarioEstado = 0
    WHERE
        usuarioId = p_usuarioId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_categoria` ()   BEGIN
    SELECT * FROM categoria WHERE categoriaEstado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_categoria_id` (IN `categoria_id` INT)   BEGIN
    SELECT * FROM categoria WHERE categoriaId = categoria_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_curso` ()   BEGIN
    SELECT
        curso.cursoId,
        curso.cursoNombre,
        curso.cursoDescripcion,
        curso.cursoFechaInicio,
        curso.cursoFechaFin,
        curso.cursoCategoriaId,
        curso.cursoImagen,
        categoria.categoriaNombre,
        curso.cursoInstructorId,
        instructor.instructorNombre,
        instructor.instructorApellidoPaterno,
        instructor.instructorApellidoMaterno,
        instructor.instructorCorreo,
        instructor.instructorSexo,
        instructor.instructorTelefono
    FROM curso
    INNER JOIN categoria ON curso.cursoCategoriaId = categoria.categoriaId
    INNER JOIN instructor ON curso.cursoInstructorId = instructor.instructorId
    WHERE curso.cursoEstado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_cursos_usuario_x_id` (IN `p_cursoId` INT)   BEGIN
    SELECT 
        dc.detallecursoId,
        c.cursoId,
        c.cursoNombre,
        c.cursoDescripcion,
        c.cursoFechaInicio,
        c.cursoFechaFin,
        u.usuarioId,
        u.usuarioNombre,
        u.usuarioApellidoPaterno,
        u.usuarioApellidoMaterno,
        u.usuarioDni, 
        i.instructorId,
        i.instructorNombre,
        i.instructorApellidoPaterno,
        i.instructorApellidoMaterno
    FROM detallecurso dc
    INNER JOIN curso c ON dc.detallecursoCursoId = c.cursoId
    INNER JOIN usuario u ON dc.detallecursoUsuarioId = u.usuarioId
    INNER JOIN instructor i ON c.cursoInstructorId = i.instructorId
    WHERE c.cursoId = p_cursoId
    AND dc.detallecursoEstado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_cursos_x_usuario` (IN `p_usuarioId` INT)   BEGIN
    SELECT 
        dc.detallecursoId,
        c.cursoId,
        c.cursoNombre,
        c.cursoDescripcion,
        c.cursoFechaInicio,
        c.cursoFechaFin,
        u.usuarioId,
        u.usuarioNombre,
        u.usuarioApellidoPaterno,
        u.usuarioApellidoMaterno,
        u.usuarioDni, 
        i.instructorId,
        i.instructorNombre,
        i.instructorApellidoPaterno,
        i.instructorApellidoMaterno
    FROM detallecurso dc
    INNER JOIN curso c ON dc.detallecursoCursoId = c.cursoId
    INNER JOIN usuario u ON dc.detallecursoUsuarioId = u.usuarioId
    INNER JOIN instructor i ON c.cursoInstructorId = i.instructorId
    WHERE dc.detallecursoUsuarioId = p_usuarioId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_cursos_x_usuario_top10` (IN `p_usuarioId` INT)   BEGIN
    SELECT 
        dc.detallecursoId,
        c.cursoId,
        c.cursoNombre,
        c.cursoDescripcion,
        c.cursoFechaInicio,
        c.cursoFechaFin,
        u.usuarioId,
        u.usuarioNombre,
        u.usuarioApellidoPaterno,
        u.usuarioApellidoMaterno,
        u.usuarioDni, 
        i.instructorId,
        i.instructorNombre,
        i.instructorApellidoPaterno,
        i.instructorApellidoMaterno
    FROM detallecurso dc
    INNER JOIN curso c ON dc.detallecursoCursoId = c.cursoId
    INNER JOIN usuario u ON dc.detallecursoUsuarioId = u.usuarioId
    INNER JOIN instructor i ON c.cursoInstructorId = i.instructorId
    WHERE dc.detallecursoUsuarioId = p_usuarioId
    AND dc.detallecursoEstado = 1
    LIMIT 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_curso_id` (IN `p_cursoId` INT)   BEGIN
    SELECT *
    FROM curso
    WHERE cursoEstado = 1 AND cursoId = p_cursoId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_curso_x_id_detalle` (IN `p_detallecursoId` INT)   BEGIN
    SELECT 
        dc.detallecursoId,
        c.cursoId,
        c.cursoNombre,
        c.cursoDescripcion,
        c.cursoFechaInicio,
        c.cursoFechaFin,
        u.usuarioId,
        u.usuarioNombre,
        u.usuarioApellidoPaterno,
        u.usuarioApellidoMaterno,
        c.cursoImagen,
        i.instructorId,
        i.instructorNombre,
        i.instructorApellidoPaterno,
        i.instructorApellidoMaterno
    FROM detallecurso dc
    INNER JOIN curso c ON dc.detallecursoCursoId = c.cursoId
    INNER JOIN usuario u ON dc.detallecursoUsuarioId = u.usuarioId
    INNER JOIN instructor i ON c.cursoInstructorId = i.instructorId
    WHERE dc.detallecursoId = p_detallecursoId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_instructor` ()   BEGIN
    SELECT *
    FROM instructor
    WHERE instructorEstado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_instructor_id` (IN `instructor_id` INT)   BEGIN
    SELECT *
    FROM instructor
    WHERE instructorEstado = 1 AND instructorId = instructor_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_total_cursos_x_usuario` (IN `p_usuarioId` INT)   BEGIN
    SELECT COUNT(*) AS total FROM detallecurso WHERE detallecursoUsuarioId = p_usuarioId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_usuario` ()   BEGIN
    SELECT * FROM usuario WHERE usuarioEstado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_usuario_modal` (IN `p_cursoId` INT)   BEGIN
    SELECT * FROM usuario 
    WHERE usuarioEstado = 1
    AND usuarioId NOT IN (SELECT detallecursoUsuarioId FROM detallecurso WHERE detallecursoCursoId = p_cursoId AND detallecursoEstado = 1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_usuario_x_dni` (IN `p_usuarioDni` VARCHAR(255))   BEGIN
    SELECT * FROM usuario WHERE usuarioEstado = 1 AND usuarioDni = p_usuarioDni;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_usuario_x_id` (IN `p_usuarioId` INT)   BEGIN
    SELECT * FROM usuario WHERE usuarioEstado = 1 AND usuarioId = p_usuarioId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_categoria` (IN `p_categoriaNombre` VARCHAR(255))   BEGIN
    INSERT INTO categoria (categoriaNombre, categoriaFechaCreacion, categoriaEstado) 
    VALUES (p_categoriaNombre, NOW(), '1');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_curso` (IN `p_cursoCategoriaId` INT, IN `p_cursoNombre` VARCHAR(255), IN `p_cursoDescripcion` TEXT, IN `p_cursoFechaInicio` DATE, IN `p_cursoFechaFin` DATE, IN `p_cursoInstructorId` INT)   BEGIN
    INSERT INTO curso (
        cursoCategoriaId, 
        cursoNombre, 
        cursoDescripcion, 
        cursoFechaInicio, 
        cursoFechaFin, 
        cursoInstructorId, 
        cursoImagen, 
        cursoFechaCreacion, 
        cursoEstado
    ) VALUES (
        p_cursoCategoriaId, 
        p_cursoNombre, 
        p_cursoDescripcion, 
        p_cursoFechaInicio, 
        p_cursoFechaFin, 
        p_cursoInstructorId, 
        '../../public/1.png', 
        NOW(), 
        '1'
    );

    SELECT LAST_INSERT_ID() AS cursoId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_curso_usuario` (IN `p_cursoId` INT, IN `p_usu_id` INT)   BEGIN
    INSERT INTO detallecurso (detallecursoCursoId, detallecursoUsuarioId, detallecursoFechaCreacion, detallecursoEstado) 
    VALUES (p_cursoId, p_usu_id, NOW(), 1);

    SELECT LAST_INSERT_ID() AS detallecursoId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_instructor` (IN `instructor_nombre` VARCHAR(150), IN `instructor_apellido_paterno` VARCHAR(150), IN `instructor_apellido_materno` VARCHAR(150), IN `instructor_correo` VARCHAR(100), IN `instructor_sexo` VARCHAR(1), IN `instructor_telefono` VARCHAR(12))   BEGIN
    INSERT INTO instructor (
        instructorNombre,
        instructorApellidoPaterno,
        instructorApellidoMaterno,
        instructorCorreo,
        instructorSexo,
        instructorTelefono,
        instructorFechaCreacion,
        instructorEstado
    ) VALUES (
        instructor_nombre,
        instructor_apellido_paterno,
        instructor_apellido_materno,
        instructor_correo,
        instructor_sexo,
        instructor_telefono,
        NOW(),
        '1'
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_usuario` (IN `p_usuarioNombre` VARCHAR(255), IN `p_usuarioApellidoPaterno` VARCHAR(255), IN `p_usuarioApellidoMaterno` VARCHAR(255), IN `p_usuarioCorreo` VARCHAR(255), IN `p_usuarioPassword` VARCHAR(255), IN `p_usuarioSexo` VARCHAR(255), IN `p_usuarioTelefono` VARCHAR(255), IN `p_usuarioRolId` INT, IN `p_usuarioDni` VARCHAR(255))   BEGIN
    INSERT INTO usuario (usuarioId,usuarioNombre,usuarioApellidoPaterno,usuarioApellidoMaterno,usuarioCorreo,usuarioPassword,usuarioSexo,usuarioTelefono,usuarioRolId, usuarioDni,usuarioFechaCreacion, usuarioEstado) 
    VALUES (NULL, p_usuarioNombre, p_usuarioApellidoPaterno, p_usuarioApellidoMaterno, p_usuarioCorreo, p_usuarioPassword, p_usuarioSexo, p_usuarioTelefono, p_usuarioRolId, p_usuarioDni, now(), '1');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `correo` VARCHAR(255), IN `pass` VARCHAR(255))   BEGIN
    IF correo IS NULL OR pass IS NULL THEN
        -- Enviar mensaje de error si el correo o la contraseña están vacíos
        SELECT 2 AS resultado;
    ELSE
        -- Verificar si el usuario existe y tiene la contraseña correcta
        SELECT usuarioId, usuarioNombre, usuarioApellidoPaterno, usuarioCorreo, usuarioRolId
        FROM usuario
        WHERE usuarioCorreo = correo AND usuarioPassword = pass AND usuarioEstado = 1;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_categoria` (IN `p_categoriaId` INT, IN `p_categoriaNombre` VARCHAR(255))   BEGIN
    UPDATE categoria
    SET categoriaNombre = p_categoriaNombre
    WHERE categoriaId = p_categoriaId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_curso` (IN `p_cursoId` INT, IN `p_cursoCategoriaId` INT, IN `p_cursoNombre` VARCHAR(255), IN `p_cursoDescripcion` TEXT, IN `p_cursoFechaInicio` DATE, IN `p_cursoFechaFin` DATE, IN `p_cursoInstructorId` INT)   BEGIN
    UPDATE curso
    SET
        cursoCategoriaId = p_cursoCategoriaId,
        cursoNombre = p_cursoNombre,
        cursoDescripcion = p_cursoDescripcion,
        cursoFechaInicio = p_cursoFechaInicio,
        cursoFechaFin = p_cursoFechaFin,
        cursoInstructorId = p_cursoInstructorId
    WHERE
        cursoId = p_cursoId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_imagen_curso` (IN `p_cursoId` INT, IN `p_cursoImagen` VARCHAR(255))   BEGIN
    UPDATE curso
    SET cursoImagen = p_cursoImagen
    WHERE cursoId = p_cursoId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_instructor` (IN `instructor_id` INT, IN `instructor_nombre` VARCHAR(255), IN `instructor_apellido_paterno` VARCHAR(255), IN `instructor_apellido_materno` VARCHAR(255), IN `instructor_correo` VARCHAR(255), IN `instructor_sexo` CHAR(1), IN `instructor_telefono` VARCHAR(20))   BEGIN
    UPDATE instructor
    SET
        instructorNombre = instructor_nombre,
        instructorApellidoPaterno = instructor_apellido_paterno,
        instructorApellidoMaterno = instructor_apellido_materno,
        instructorCorreo = instructor_correo,
        instructorSexo = instructor_sexo,
        instructorTelefono = instructor_telefono
    WHERE
        instructorId = instructor_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_usuario` (IN `p_usuarioId` INT, IN `p_usuarioNombre` VARCHAR(255), IN `p_usuarioApellidoPaterno` VARCHAR(255), IN `p_usuarioApellidoMaterno` VARCHAR(255), IN `p_usuarioCorreo` VARCHAR(255), IN `p_usuarioPassword` VARCHAR(255), IN `p_usuarioSexo` VARCHAR(255), IN `p_usuarioTelefono` VARCHAR(255), IN `p_usuarioRolId` INT, IN `p_usuarioDni` VARCHAR(255))   BEGIN
    UPDATE usuario
    SET
        usuarioNombre = p_usuarioNombre,
        usuarioApellidoPaterno = p_usuarioApellidoPaterno,
        usuarioApellidoMaterno = p_usuarioApellidoMaterno,
        usuarioCorreo = p_usuarioCorreo,
        usuarioPassword = p_usuarioPassword,
        usuarioSexo = p_usuarioSexo,
        usuarioTelefono = p_usuarioTelefono,
        usuarioRolId = p_usuarioRolId,
        usuarioDni = p_usuarioDni
    WHERE
        usuarioId = p_usuarioId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_usuario_perfil` (IN `p_usuarioId` INT, IN `p_usuarioNombre` VARCHAR(255), IN `p_usuarioApellidoPaterno` VARCHAR(255), IN `p_usuarioApellidoMaterno` VARCHAR(255), IN `p_usuarioPassword` VARCHAR(255), IN `p_usuarioSexo` VARCHAR(1), IN `p_usuarioTelefono` VARCHAR(20))   BEGIN
    UPDATE usuario 
    SET
        usuarioNombre = p_usuarioNombre,
        usuarioApellidoPaterno = p_usuarioApellidoPaterno,
        usuarioApellidoMaterno = p_usuarioApellidoMaterno,
        usuarioPassword = p_usuarioPassword,
        usuarioSexo = p_usuarioSexo,
        usuarioTelefono = p_usuarioTelefono
    WHERE
        usuarioId = p_usuarioId;
END$$

DELIMITER ;

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
(11, 'Arquitectura y Ingenieria', '2024-02-16 00:25:54', 1),
(12, 'Ciberseguridad', '2024-02-21 01:06:09', 1),
(13, 'Logicasss', '2024-02-21 16:25:59', 0),
(14, NULL, '2024-02-21 16:26:09', 1);

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
(5, 34, 1, '2024-02-18 22:57:18', 1),
(6, 5, 3, '2024-02-21 16:29:23', 1),
(7, 5, 10, '2024-02-21 16:33:01', 1),
(8, 5, 46, '2024-02-21 16:33:01', 1),
(9, 5, 49, '2024-02-21 16:33:01', 1),
(10, 5, 45, '2024-02-21 16:33:28', 0);

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
(12, 'Charly2', 'Rode', 'felr', 'car@gmail.com', '76543223', 'M', '2024-02-15 23:39:16', 1),
(13, 'Charly', 'Rodered', 'ferrer', 'car@gmail.com', '76543223', 'M', '2024-02-15 23:39:38', 0),
(14, 'Charly2', 'Rodered', 'ferrer', 'car@gmail.com', '76543223', 'M', '2024-02-15 23:40:17', 0),
(18, 'Alfonso', 'Perez', 'Cuellar', 'alfonso@gmail.com', '5555555', 'M', '2024-02-21 00:16:13', 1),
(23, 'alonso', 'laro', 'pardo', 'alonso@gmail.com', '5555555', 'M', '2024-02-21 00:34:41', 1),
(25, 'test', 'afsdasd', 'asfasd', 'tes@gmail.com', '5555555', 'F', '2024-02-21 00:52:01', 1),
(27, '1', 'asfaf', 'afasd', '1@gmail.com', '5555555', 'M', '2024-02-21 00:55:02', 1),
(28, '2', 'qweqw', 'qweqwe', '2@gmail.com', '5555555', 'F', '2024-02-21 00:57:04', 1);

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
(1, 'Usuario'),
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
(1, 'Administrador', 'Sol', 'Abelardo', 'admin@gmail.com', '123456', 'M', '99872343', 2, 12345678, '2024-01-01 23:11:15', 1),
(2, 'User1', 'Use', 'Ser1', 'user1@gmail.com', '123456', 'M', '9876543', 1, 12345679, '2024-01-04 23:05:55', 0),
(3, 'UserTes', 'teset1', 'tesda2', 'usert1@gmail.com', '123456', 'M', '12315135', 1, 12345610, '2024-01-31 14:27:31', 1),
(4, 'Admin', 'Ministrar', 'Minis', 'admin@gmail.com', '123456', 'F', '98765456', 2, 12345611, '2024-01-31 14:29:50', 0),
(9, 'Uno1', 'trar', 'Minis', 'uno1@gmail.com', '123456', 'F', '98765456', 1, 124124, '2024-02-15 23:20:26', 0),
(10, 'Uno', 'trar', 'Minis', 'ad@gmail.com', '123456', 'F', '1341221', 1, 12345613, '2024-02-15 23:21:49', 1),
(45, 'Test1', 'Paterno1', 'Materno1', 'correo1@correo1.com1', 'password1', 'M', '12345', 1, 654131, '2024-02-20 23:18:54', 1),
(46, 'Test2', 'Paterno2', 'Materno2', 'correo1@correo1.com2', 'password2', 'M', '12345', 1, 654131, '2024-02-20 23:18:54', 1),
(47, 'Test3', 'Paterno3', 'Materno3', 'correo1@correo1.com3', 'password3', 'M', '12345', 1, 654131, '2024-02-20 23:18:54', 1),
(48, 'Test5', 'Paterno5', 'Materno5', 'correo1@correo1.com5', 'password5', 'F', '12345', 1, 654131, '2024-02-20 23:18:54', 1),
(49, 'Test4', 'Paterno4', 'Materno4', 'correo1@correo1.com4', 'password4', 'M', '12345', 1, 654131, '2024-02-20 23:18:54', 1),
(50, 'Test6', 'Paterno6', 'Materno6', 'correo1@correo1.com6', 'password6', 'F', '12345', 1, 654131, '2024-02-20 23:18:54', 1),
(51, 'Test7', 'Paterno7', 'Materno7', 'correo1@correo1.com7', 'password7', 'F', '12345', 1, 654131, '2024-02-20 23:18:54', 1),
(52, 'Test8', 'Paterno8', 'Materno8', 'correo1@correo1.com8', 'password8', 'F', '12345', 1, 654131, '2024-02-20 23:18:54', 1),
(53, 'Test9', 'Paterno9', 'Materno9', 'correo1@correo1.com9', 'password9', 'F', '12345', 1, 654131, '2024-02-20 23:18:54', 1);

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
  MODIFY `categoriaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `cursoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `detallecurso`
--
ALTER TABLE `detallecurso`
  MODIFY `detallecursoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rolId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuarioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
