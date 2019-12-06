-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-12-2019 a las 09:07:22
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kinetime`
--
CREATE DATABASE IF NOT EXISTS `kinetime` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kinetime`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedentes_clinicos`
--

CREATE TABLE `antecedentes_clinicos` (
  `id` int(255) NOT NULL,
  `paciente_id` int(255) NOT NULL,
  `morbilidad` varchar(255) DEFAULT NULL,
  `medico` varchar(255) DEFAULT NULL,
  `zona_id` int(255) DEFAULT NULL,
  `operacion` varchar(200) DEFAULT NULL,
  `factores_riesgo` varchar(200) DEFAULT NULL,
  `cuando_episodio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `antecedentes_clinicos`
--

INSERT INTO `antecedentes_clinicos` (`id`, `paciente_id`, `morbilidad`, `medico`, `zona_id`, `operacion`, `factores_riesgo`, `cuando_episodio`) VALUES
(2, 11, 'sfsf', 'sdf', 1, 'Si', 'sfd', '2005-05-16'),
(3, 12, 'dhbfsjah', 'sdf', 1, 'Si', 'asf', '2019-10-23'),
(4, 13, 'asd', 'asd', 1, 'Si', 'asd', '2019-10-09'),
(5, 14, 'asd', 'asd', 1, 'Si', 'asd', '2019-10-15'),
(6, 15, 'asdf', 'sdf', 1, 'Si', 'sdf', '2019-10-10'),
(7, 8, 'asd', 'asd', 1, 'Si', 'asd', '2019-10-10'),
(8, 1, 'ada', 'asd', 1, 'Si', 'asd', '2019-10-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas_kinesiologo`
--

CREATE TABLE `areas_kinesiologo` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `id` int(255) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `tipo_ejercicio` int(255) NOT NULL,
  `objetivo` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`id`, `nombre`, `tipo_ejercicio`, `objetivo`, `url`) VALUES
(1, 'asd2', 1, 'dasd', 'uploads/bc700b05b908e7aa65f959ce25ecb148.mp4'),
(6, 'czds', 2, 'acsas', 'uploads/3c873b0845ff29d1d26853a30665c0f8.mp4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_rutina`
--

CREATE TABLE `evaluacion_rutina` (
  `id` int(11) NOT NULL,
  `rutina_ejercicio` int(11) NOT NULL,
  `evaluacion` int(11) NOT NULL,
  `observacion` varchar(1000) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evaluacion_rutina`
--

INSERT INTO `evaluacion_rutina` (`id`, `rutina_ejercicio`, `evaluacion`, `observacion`, `fecha`) VALUES
(4, 3, 5, 'da', '2019-12-06'),
(6, 3, 5, 'das', '2019-12-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kinesiologos`
--

CREATE TABLE `kinesiologos` (
  `id` int(255) NOT NULL,
  `rut` char(12) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `password` char(60) DEFAULT NULL,
  `especialidad` varchar(200) DEFAULT NULL,
  `certificaciones` int(255) DEFAULT NULL,
  `anos_experiencia` int(255) DEFAULT NULL,
  `metas` varchar(1000) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `kinesiologos`
--

INSERT INTO `kinesiologos` (`id`, `rut`, `nombre`, `password`, `especialidad`, `certificaciones`, `anos_experiencia`, `metas`, `role`) VALUES
(1, '11.111.111-1', 'admin', '$2y$12$mkQlG3pyfHwf0e12XX/RyusWaQgCLm4C4/fQDIdn2.vvlmCeQxlru', NULL, 0, 0, NULL, 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kinesiologos_has_areas`
--

CREATE TABLE `kinesiologos_has_areas` (
  `id` int(255) NOT NULL,
  `kinesiologo_id` int(255) NOT NULL,
  `area_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kinesiologos_has_perfiles`
--

CREATE TABLE `kinesiologos_has_perfiles` (
  `id` int(255) NOT NULL,
  `kinesiologo_id` int(255) NOT NULL,
  `perfil_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rut` char(12) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `edad` int(2) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `ocupacion` varchar(200) DEFAULT NULL,
  `fumador` char(2) DEFAULT NULL,
  `bebedor` char(2) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `correo`, `password`, `rut`, `nombre`, `edad`, `direccion`, `ocupacion`, `fumador`, `bebedor`, `estado`) VALUES
(1, 'prueba.2112@gmail.com', '', '20492942-4', 'Alejandro Casas', 26, 'Av. Concha Y Toro 2618', 'Programador', 'Si', 'No', 1),
(2, '', '', '22.222.222-2', 'ads', 12, 'ads', 'asd', 'No', 'No', 1),
(3, '', '', '44.444.444-4', 'casd', 22, 'sda', 'sdv', 'Si', 'Si', 0),
(4, '', '', '77.777.777-7', 'csdca', 44, 'Nicanor Plaza #846', 'Programador', 'Si', 'Si', 0),
(5, '', '', '77.777.777-7', 'csdca', 44, 'Nicanor Plaza #846', 'Programador', 'Si', 'Si', 0),
(6, '', '', '77.777.777-7', 'csdca', 44, 'Nicanor Plaza #846', 'Programador', 'Si', 'Si', 0),
(7, '', '', '77.777.777-7', 'csdca', 44, 'Nicanor Plaza #846', 'Programador', 'Si', 'Si', 1),
(8, '', '', '77.777.777-7', 'csdca', 44, 'Nicanor Plaza #846', 'Programador', 'Si', 'Si', 1),
(9, '', '', '77.777.777-7', 'csdca', 44, 'Nicanor Plaza #846', 'Programador', 'Si', 'Si', 0),
(10, '', '', '77.777.777-7', 'csdca', 44, 'Nicanor Plaza #846', 'Programador', 'Si', 'Si', 0),
(11, '', '', '77.777.777-7', 'csdca', 44, 'Nicanor Plaza #846', 'Programador', 'Si', 'Si', 1),
(12, 'nicolas.a.cartagena.m@gmail.com', '$2y$12$vAYiVnqCqmWJieGtF.9wCOSLKUKbwuXx0GfvnYhABWWNdrFF7ysym', '19.704.366-0', 'Nicolas Cartagena', 22, 'Luis Espinal Campos #1389', 'Programador', 'No', 'Si', 0),
(13, 'nicolas.a.cartagena@gmail.com', 'C', '22.222.222-2', 'Nicolas', 22, 'sda', 'Programador', 'Si', 'Si', 1),
(14, 'nicolas.cartagena.m@gmail.com', 'Vfv8KodVrV', '66.666.666-6', 'Nicolas', 22, 'Luis Espinal Campos #1389', 'Programador', 'Si', 'Si', 1),
(15, 'nicolas.a.cartagenm@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$Tm5hUWpFTWU2elRoU1BJTg$F1r/HGghWps0awXa4KVOejoCPU755tZcBOf07oC6vDg', '19.704.366-0', 'Nicolas', 22, 'ygvgyv', 'Programador', 'Si', 'Si', 0),
(16, 'dsadsa@gmail.com', '$2y$12$ew5Cn96AIj9KL4oibmbkEekAjltgkxiGZWZF70r1ZsHMMUqkN/eHm', '77.777.777-7', 'asd', 23, 'ad', 'sda', 'No', 'Si', 1),
(17, 'dsadsa@gmail.com', '$2y$12$3z4qrP.ARbxcOSNaOOeJlOoOwGkCOmMMRJNMgJAglri4Rzf.QskVe', '77.777.777-7', 'asd', 23, 'ad', 'sda', 'Si', 'Si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes_has_rutinas`
--

CREATE TABLE `pacientes_has_rutinas` (
  `id` int(255) NOT NULL,
  `paciente_id` int(255) NOT NULL,
  `rutina_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pacientes_has_rutinas`
--

INSERT INTO `pacientes_has_rutinas` (`id`, `paciente_id`, `rutina_id`) VALUES
(13, 12, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_has_kinesiologo`
--

CREATE TABLE `paciente_has_kinesiologo` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `kinesiologo_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `comentario` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paciente_has_kinesiologo`
--

INSERT INTO `paciente_has_kinesiologo` (`id`, `paciente_id`, `kinesiologo_id`, `estado`, `comentario`) VALUES
(0, 12, 1, 1, 'asdasdasdsad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutinas`
--

CREATE TABLE `rutinas` (
  `id` int(255) NOT NULL,
  `tiempo` time DEFAULT NULL,
  `volumen` int(255) NOT NULL,
  `descanso` time DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_termino` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rutinas`
--

INSERT INTO `rutinas` (`id`, `tiempo`, `volumen`, `descanso`, `hora_inicio`, `hora_termino`) VALUES
(1, NULL, 1, NULL, NULL, NULL),
(2, NULL, 1, NULL, NULL, NULL),
(3, NULL, 1, NULL, NULL, NULL),
(4, NULL, 1, NULL, NULL, NULL),
(5, NULL, 1, NULL, NULL, NULL),
(6, NULL, 1, NULL, NULL, NULL),
(7, NULL, 1, NULL, NULL, NULL),
(8, NULL, 1, NULL, NULL, NULL),
(9, NULL, 1, NULL, NULL, NULL),
(10, NULL, 1, NULL, NULL, NULL),
(11, NULL, 1, NULL, NULL, NULL),
(12, NULL, 1, NULL, NULL, NULL),
(13, NULL, 1, NULL, NULL, NULL),
(14, NULL, 1, NULL, NULL, NULL),
(15, NULL, 1, NULL, NULL, NULL),
(16, NULL, 1, NULL, NULL, NULL),
(17, NULL, 1, NULL, NULL, NULL),
(18, NULL, 1, NULL, NULL, NULL),
(19, NULL, 1, NULL, NULL, NULL),
(20, NULL, 1, NULL, NULL, NULL),
(21, NULL, 1, NULL, NULL, NULL),
(22, NULL, 1, NULL, NULL, NULL),
(23, NULL, 1, NULL, NULL, NULL),
(24, '10:00:00', 1, '00:04:00', '15:10:00', '17:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutinas_has_ejercicios`
--

CREATE TABLE `rutinas_has_ejercicios` (
  `id` int(255) NOT NULL,
  `rutina_id` int(255) NOT NULL,
  `ejercicio_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rutinas_has_ejercicios`
--

INSERT INTO `rutinas_has_ejercicios` (`id`, `rutina_id`, `ejercicio_id`) VALUES
(1, 1, 1),
(2, 24, 1),
(3, 24, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ejercicios`
--

CREATE TABLE `tipo_ejercicios` (
  `id` int(255) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_ejercicios`
--

INSERT INTO `tipo_ejercicios` (`id`, `descripcion`) VALUES
(1, 'Brazo'),
(2, 'Pierna'),
(3, 'Antebrazo'),
(4, 'Hombro'),
(5, 'Pie'),
(6, 'Muñeca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `volumenes`
--

CREATE TABLE `volumenes` (
  `id` int(255) NOT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `volumenes`
--

INSERT INTO `volumenes` (`id`, `serie`, `total`) VALUES
(1, '3', '16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona_lesion`
--

CREATE TABLE `zona_lesion` (
  `id` int(255) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `zona_lesion`
--

INSERT INTO `zona_lesion` (`id`, `nombre`) VALUES
(1, 'Fractura de cubito'),
(2, 'Fractura de metatarso'),
(3, 'Fractura de tibia y perone'),
(4, 'Fractura de tobillo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedentes_clinicos`
--
ALTER TABLE `antecedentes_clinicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_antecedentes_clinicos_pacientes` (`paciente_id`),
  ADD KEY `fk_antecedentes_clinicos_zona` (`zona_id`);

--
-- Indices de la tabla `areas_kinesiologo`
--
ALTER TABLE `areas_kinesiologo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ejercicios_tipo_ejercicios` (`tipo_ejercicio`);

--
-- Indices de la tabla `evaluacion_rutina`
--
ALTER TABLE `evaluacion_rutina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rutina` (`rutina_ejercicio`) USING BTREE;

--
-- Indices de la tabla `kinesiologos`
--
ALTER TABLE `kinesiologos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `kinesiologos_has_areas`
--
ALTER TABLE `kinesiologos_has_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kinesiologos_has_areas_kinesiologos` (`kinesiologo_id`),
  ADD KEY `fk_kinesiologos_has_areas_areas` (`area_id`);

--
-- Indices de la tabla `kinesiologos_has_perfiles`
--
ALTER TABLE `kinesiologos_has_perfiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kinesiologos_has_perfiles_kinesiologos` (`kinesiologo_id`),
  ADD KEY `fk_kinesiologos_has_perfiles_perfiles` (`perfil_id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes_has_rutinas`
--
ALTER TABLE `pacientes_has_rutinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pacientes_has_rutinas_pacientes` (`paciente_id`),
  ADD KEY `fk_pacientes_has_rutinas_rutinas` (`rutina_id`);

--
-- Indices de la tabla `paciente_has_kinesiologo`
--
ALTER TABLE `paciente_has_kinesiologo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paciente_id` (`paciente_id`),
  ADD UNIQUE KEY `kinesiologo_id` (`kinesiologo_id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rutinas_volumenes` (`volumen`);

--
-- Indices de la tabla `rutinas_has_ejercicios`
--
ALTER TABLE `rutinas_has_ejercicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rutinas_has_ejercicios_rutinas` (`rutina_id`),
  ADD KEY `fk_rutinas_has_ejercicios_ejercicios` (`ejercicio_id`);

--
-- Indices de la tabla `tipo_ejercicios`
--
ALTER TABLE `tipo_ejercicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `volumenes`
--
ALTER TABLE `volumenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zona_lesion`
--
ALTER TABLE `zona_lesion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedentes_clinicos`
--
ALTER TABLE `antecedentes_clinicos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `areas_kinesiologo`
--
ALTER TABLE `areas_kinesiologo`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `evaluacion_rutina`
--
ALTER TABLE `evaluacion_rutina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `kinesiologos`
--
ALTER TABLE `kinesiologos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `kinesiologos_has_areas`
--
ALTER TABLE `kinesiologos_has_areas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `kinesiologos_has_perfiles`
--
ALTER TABLE `kinesiologos_has_perfiles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `pacientes_has_rutinas`
--
ALTER TABLE `pacientes_has_rutinas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `rutinas_has_ejercicios`
--
ALTER TABLE `rutinas_has_ejercicios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_ejercicios`
--
ALTER TABLE `tipo_ejercicios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `volumenes`
--
ALTER TABLE `volumenes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `zona_lesion`
--
ALTER TABLE `zona_lesion`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `antecedentes_clinicos`
--
ALTER TABLE `antecedentes_clinicos`
  ADD CONSTRAINT `fk_antecedentes_clinicos_pacientes` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`),
  ADD CONSTRAINT `fk_antecedentes_clinicos_zona` FOREIGN KEY (`zona_id`) REFERENCES `zona_lesion` (`id`);

--
-- Filtros para la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD CONSTRAINT `fk_ejercicios_tipo_ejercicios` FOREIGN KEY (`tipo_ejercicio`) REFERENCES `tipo_ejercicios` (`id`);

--
-- Filtros para la tabla `evaluacion_rutina`
--
ALTER TABLE `evaluacion_rutina`
  ADD CONSTRAINT `fk_evaluacion_has_rutina` FOREIGN KEY (`rutina_ejercicio`) REFERENCES `rutinas_has_ejercicios` (`id`);

--
-- Filtros para la tabla `kinesiologos_has_areas`
--
ALTER TABLE `kinesiologos_has_areas`
  ADD CONSTRAINT `fk_kinesiologos_has_areas_areas` FOREIGN KEY (`area_id`) REFERENCES `areas_kinesiologo` (`id`),
  ADD CONSTRAINT `fk_kinesiologos_has_areas_kinesiologos` FOREIGN KEY (`kinesiologo_id`) REFERENCES `kinesiologos` (`id`);

--
-- Filtros para la tabla `kinesiologos_has_perfiles`
--
ALTER TABLE `kinesiologos_has_perfiles`
  ADD CONSTRAINT `fk_kinesiologos_has_perfiles_kinesiologos` FOREIGN KEY (`kinesiologo_id`) REFERENCES `kinesiologos` (`id`),
  ADD CONSTRAINT `fk_kinesiologos_has_perfiles_perfiles` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`);

--
-- Filtros para la tabla `pacientes_has_rutinas`
--
ALTER TABLE `pacientes_has_rutinas`
  ADD CONSTRAINT `fk_pacientes_has_rutinas_pacientes` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`),
  ADD CONSTRAINT `fk_pacientes_has_rutinas_rutinas` FOREIGN KEY (`rutina_id`) REFERENCES `rutinas` (`id`);

--
-- Filtros para la tabla `paciente_has_kinesiologo`
--
ALTER TABLE `paciente_has_kinesiologo`
  ADD CONSTRAINT `fk_paciente_has_kinesiologo_kinesiologo` FOREIGN KEY (`kinesiologo_id`) REFERENCES `kinesiologos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_paciente_has_kinesiologo_paciente` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rutinas`
--
ALTER TABLE `rutinas`
  ADD CONSTRAINT `fk_rutinas_volumenes` FOREIGN KEY (`volumen`) REFERENCES `volumenes` (`id`);

--
-- Filtros para la tabla `rutinas_has_ejercicios`
--
ALTER TABLE `rutinas_has_ejercicios`
  ADD CONSTRAINT `fk_rutinas_has_ejercicios_ejercicios` FOREIGN KEY (`ejercicio_id`) REFERENCES `ejercicios` (`id`),
  ADD CONSTRAINT `fk_rutinas_has_ejercicios_rutinas` FOREIGN KEY (`rutina_id`) REFERENCES `rutinas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
