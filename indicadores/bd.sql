-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2020 a las 23:51:41
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mdl_ind_companies`
--

CREATE TABLE `mdl_ind_companies` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_spanish_ci NOT NULL,
  `nit` text COLLATE utf8_spanish_ci NOT NULL,
  `telephone` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mdl_ind_companies`
--

INSERT INTO `mdl_ind_companies` (`id`, `name`, `nit`, `telephone`) VALUES
(1, 'empresa 1', '11', '111'),
(2, 'empresa 2', '22', '222'),
(3, 'empresa 3', '33', '333'),
(4, 'empresa 4', '44', '444'),
(5, 'empresa 5', '55', '555'),
(6, 'empresa 6', '66', '666'),
(7, 'empresa 7', '77', '777'),
(8, 'empresa 8', '88', '888'),
(9, 'empresa 9', '99', '999'),
(10, 'empresa 10', '1010', '101010'),
(11, 'empresa 11', '1111', '111111'),
(12, 'empresa 12', '1212', '121212'),
(13, 'empresa 13', '1313', '131313'),
(14, 'empresa 14', '1414', '141414'),
(15, 'empresa 15', '1515', '151515');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mdl_ind_company_indicators`
--

CREATE TABLE `mdl_ind_company_indicators` (
  `id` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `id_indicators` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mdl_ind_company_indicators`
--

INSERT INTO `mdl_ind_company_indicators` (`id`, `id_company`, `id_indicators`) VALUES
(52, 1, 1),
(53, 1, 2),
(54, 1, 3),
(55, 1, 4),
(56, 1, 5),
(57, 1, 6),
(58, 1, 7),
(59, 1, 8),
(60, 1, 9),
(61, 1, 10),
(62, 1, 11),
(63, 1, 12),
(64, 2, 1),
(65, 2, 2),
(66, 2, 3),
(67, 2, 4),
(68, 2, 5),
(69, 2, 6),
(70, 2, 7),
(71, 2, 8),
(72, 2, 9),
(73, 2, 10),
(74, 2, 11),
(75, 2, 12),
(76, 3, 1),
(77, 3, 2),
(78, 3, 3),
(79, 3, 4),
(80, 3, 5),
(81, 3, 6),
(82, 3, 7),
(83, 3, 8),
(84, 3, 9),
(85, 3, 10),
(86, 3, 11),
(87, 3, 12),
(88, 4, 1),
(89, 4, 2),
(90, 4, 3),
(91, 4, 4),
(92, 4, 5),
(93, 4, 6),
(94, 4, 7),
(95, 4, 8),
(96, 4, 9),
(97, 4, 10),
(98, 4, 11),
(99, 4, 12),
(100, 5, 1),
(101, 5, 2),
(102, 5, 3),
(103, 5, 4),
(104, 5, 5),
(105, 5, 6),
(106, 5, 7),
(107, 5, 8),
(108, 5, 9),
(109, 5, 10),
(110, 5, 11),
(111, 5, 12),
(112, 6, 1),
(113, 6, 2),
(114, 6, 3),
(115, 6, 4),
(116, 6, 5),
(117, 6, 6),
(118, 6, 7),
(119, 6, 8),
(120, 6, 9),
(121, 6, 10),
(122, 6, 11),
(123, 6, 12),
(124, 7, 1),
(125, 7, 2),
(126, 7, 3),
(127, 7, 4),
(128, 7, 5),
(129, 7, 6),
(130, 7, 7),
(131, 7, 8),
(132, 7, 9),
(133, 7, 10),
(134, 7, 11),
(135, 7, 12),
(136, 8, 1),
(137, 8, 2),
(138, 8, 3),
(139, 8, 4),
(140, 8, 5),
(141, 8, 6),
(142, 8, 7),
(143, 8, 8),
(144, 8, 9),
(145, 8, 10),
(146, 8, 11),
(147, 8, 12),
(148, 9, 1),
(149, 9, 2),
(150, 9, 3),
(151, 9, 4),
(152, 9, 5),
(153, 9, 6),
(154, 9, 7),
(155, 9, 8),
(156, 9, 9),
(157, 9, 10),
(158, 9, 11),
(159, 9, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mdl_ind_equations`
--

CREATE TABLE `mdl_ind_equations` (
  `id` int(11) NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `unity_measure` text COLLATE utf8_spanish_ci NOT NULL,
  `finish` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mdl_ind_equations`
--

INSERT INTO `mdl_ind_equations` (`id`, `description`, `unity_measure`, `finish`) VALUES
(1, 'Actividades ejecutadas a la fecha medición / Actividades planeadas totales a la fecha de medición', '%', 90),
(2, 'Suma de los cumplimientos semanales / Cantidad de semanas ejecutadas del proyecto', '%', 90),
(3, 'Entregables finalizados / Entregables acordados', '%', 100),
(4, 'Entregables que cumplen criterios de aceptación / Entregables finalizados', '%', 95),
(5, 'Cantidad de personas que finalizan entrenamiento satisfactoriamente / Cantidad de personas que inician entrenamiento', '%', 90),
(6, 'Prototipos finalizados / Empresas que inician prototipos', '%', 80),
(7, '# Acuerdos de cooperación realizados con empresas tractoras', '#', 20),
(8, 'Cantidad de interacciones que tienen las empresas con el SCTI', '#', 40),
(9, '# Oportunidades encontradas', '#', 5),
(10, 'Cantidad de empresas que cambiaron sus metas de creciemiento / Cantidad de empresas', '%', 50),
(11, 'Empresas buscando oportunidades internaciones / Empresas que al inicio del programa no exportaban', '%', 35),
(12, 'Cantidad de personas de las definidas por la empresa participan de las actividades / Cantidad de personas definidas por la empresa para estar en el programa', '%', 95),
(13, 'Oportunidades detectadas que inician ejecución', '#', 1),
(14, 'Recursos representados en dinero asignados al crecimiento exponencial', '$', 1000000),
(15, 'Cantidad de conexiones realizadas con los actores del ecosistema', '#', 3),
(16, 'Cantidad de horas de consultoria adicionales solicitadas', '#', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mdl_ind_equation_variables`
--

CREATE TABLE `mdl_ind_equation_variables` (
  `id` int(11) NOT NULL,
  `id_variable` int(11) NOT NULL,
  `id_equation` int(11) NOT NULL,
  `id_operation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mdl_ind_equation_variables`
--

INSERT INTO `mdl_ind_equation_variables` (`id`, `id_variable`, `id_equation`, `id_operation`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 2, 1),
(4, 4, 2, 1),
(5, 5, 3, 1),
(6, 6, 3, 1),
(7, 7, 4, 1),
(8, 5, 4, 1),
(9, 8, 5, 1),
(10, 9, 5, 1),
(11, 10, 6, 1),
(12, 11, 6, 1),
(13, 12, 7, 2),
(14, 13, 8, 2),
(15, 14, 9, 2),
(16, 15, 10, 1),
(17, 16, 10, 1),
(18, 17, 11, 1),
(19, 18, 11, 1),
(20, 19, 12, 1),
(21, 20, 12, 1),
(22, 21, 13, 2),
(23, 22, 14, 2),
(24, 23, 15, 2),
(25, 24, 16, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mdl_ind_indicators`
--

CREATE TABLE `mdl_ind_indicators` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `id_type_indicators` int(11) NOT NULL,
  `id_equations` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mdl_ind_indicators`
--

INSERT INTO `mdl_ind_indicators` (`id`, `name`, `description`, `id_type_indicators`, `id_equations`) VALUES
(1, 'Avance del cronograma', 'Este indicador mide el avance en la realización de las actividades definidas para el proyecto', 1, 1),
(2, 'Cumplimiento del cronograma', 'Este indicador mide el cumplimiento de la realización de actividades en las fechas planeadas', 1, 2),
(3, 'Cumplimiento de entregables del proyecto', 'Este indicador mide el cumplimiento de los entregables definidos para el proyecto', 2, 3),
(4, 'Entregables del proyecto que cumplen criterios de aceptación', 'Este indicador mide que los entregables finalizados este de acuerdo con los criterios de aceptación', 3, 4),
(5, 'Personas entrenadas en Modelos de Negocios, Finanzas, Mercadeo y Propiedad Intelectual con los evaluaciones satisfactorias', 'Este indicador mide la cantidad de presonas entrenadas satisfactoriamente', 2, 5),
(6, 'Prototipos finalizados con éxito en el tiempo estipulado', 'Este indicador mide la cantidad de prototipos finalizados con éxito', 2, 6),
(7, 'Acuerdos de cooperación con las empresas tractoras realizados', 'Este indicador mide la cantidad de acuerdos de cooperación o comerciales realizado con las empresas tractoras', 2, 7),
(8, 'Actividades relacionadas con el CTI', 'Este indicador mide la cantidad de contactos que realizan las empresas con los actores del SCTI', 2, 8),
(9, 'Cantidad de oportunidades encontradas por empresas', 'Este indicador mide la cantidad de oportunidades encontradas por las empresas', 2, 9),
(10, 'Incremento de las metas de crecimiento', 'Este indicador mide el cambio de las metas de crecimiento de las empresas para proyectar su crecimiento', 2, 10),
(11, 'Cantidad de empresas explorando mercados internacionales', 'Este indicador mide las acciones para la expansión de las empresas a mercados internacionales', 2, 11),
(12, 'Ruta del crecimiento exponencial', 'Este indicador da cuenta de las acciones que emprenden las empresas para ponerse en ruta de crecimient exponencial', 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mdl_ind_operations`
--

CREATE TABLE `mdl_ind_operations` (
  `id` int(11) NOT NULL,
  `symbol` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mdl_ind_operations`
--

INSERT INTO `mdl_ind_operations` (`id`, `symbol`) VALUES
(1, 'División'),
(2, 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mdl_ind_score`
--

CREATE TABLE `mdl_ind_score` (
  `id` int(11) NOT NULL,
  `id_company_indicators` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `score` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mdl_ind_subindicators`
--

CREATE TABLE `mdl_ind_subindicators` (
  `id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `id_indicators` int(11) NOT NULL,
  `id_type_indicators` int(11) NOT NULL,
  `id_equations` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mdl_ind_subindicators`
--

INSERT INTO `mdl_ind_subindicators` (`id`, `description`, `id_indicators`, `id_type_indicators`, `id_equations`) VALUES
(1, 'Participación activa', 12, 4, 12),
(2, 'Oportunidades de facil ejecución', 12, 4, 13),
(3, 'Asignación de recursos al crecimiento exponencial', 12, 4, 14),
(4, 'Conexiones efectivas con diferentes actores: Tractoras, Procolombia, etc.', 12, 4, 15),
(5, 'Aprovechamiento de horas de consultoria adicionales', 12, 4, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mdl_ind_type_indicators`
--

CREATE TABLE `mdl_ind_type_indicators` (
  `id` int(11) NOT NULL,
  `type_indicator` text COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mdl_ind_type_indicators`
--

INSERT INTO `mdl_ind_type_indicators` (`id`, `type_indicator`) VALUES
(1, 'Tiempo'),
(2, 'Alcance'),
(3, 'Calidad'),
(4, 'Ninguno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mdl_ind_user_companies`
--

CREATE TABLE `mdl_ind_user_companies` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_companies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mdl_ind_variables`
--

CREATE TABLE `mdl_ind_variables` (
  `id` int(11) NOT NULL,
  `name_variable` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mdl_ind_variables`
--

INSERT INTO `mdl_ind_variables` (`id`, `name_variable`) VALUES
(1, 'Actividades ejecutadas a la fecha medición'),
(2, 'Actividades planeadas totales a la fecha de medición'),
(3, 'Suma de los cumplimientos semanales'),
(4, 'Cantidad de semanas ejecutadas del proyecto'),
(5, 'Entregables finalizados'),
(6, 'Entregables acordados'),
(7, 'Entregables que cumplen criterios de aceptación'),
(8, 'Cantidad de personas que finalizan entrenamiento satisfactoriamente'),
(9, 'Cantidad de personas que inician entrenamiento'),
(10, 'Prototipos finalizados'),
(11, 'Empresas que inician prototipos'),
(12, '# Acuerdos de cooperación realizados con empresas tractoras'),
(13, 'Cantidad de interacciones que tienen las empresas con el SCTI'),
(14, '# Oportunidades encontradas'),
(15, 'Cantidad de empresas que cambiaron sus metas de creciemiento'),
(16, 'Cantidad de empresas'),
(17, 'Empresas buscando oportunidades internaciones'),
(18, 'Empresas que al inicio del programa no exportaban'),
(19, 'Cantidad de personas de las definidas por la empresa participan de las actividades'),
(20, 'Cantidad de personas definidas por la empresa para estar en el programa'),
(21, 'Oportunidades detectadas que inician ejecución'),
(22, 'Recursos representados en dinero asignados al crecimiento exponencial'),
(23, 'Cantidad de conexiones realizadas con los actores del ecosistema'),
(24, 'Cantidad de horas de consultoria adicionales solicitadas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mdl_ind_companies`
--
ALTER TABLE `mdl_ind_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mdl_ind_company_indicators`
--
ALTER TABLE `mdl_ind_company_indicators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mdl_empresa_indcadores_mdl_empresa_idx` (`id_company`),
  ADD KEY `fk_mdl_empresa_indcadores_mdl_indicadores1_idx` (`id_indicators`);

--
-- Indices de la tabla `mdl_ind_equations`
--
ALTER TABLE `mdl_ind_equations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mdl_ind_equation_variables`
--
ALTER TABLE `mdl_ind_equation_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mdl_formula_variable_mdl_variable1_idx` (`id_variable`),
  ADD KEY `fk_mdl_formula_variable_mdl_formula1_idx` (`id_equation`),
  ADD KEY `fk_mdl_ind_equation_variables_mdl_ind_operations1_idx` (`id_operation`);

--
-- Indices de la tabla `mdl_ind_indicators`
--
ALTER TABLE `mdl_ind_indicators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mdl_sub_indicadores_mdl_tipo_indicadores1_idx` (`id_type_indicators`),
  ADD KEY `fk_mdl_ind_indicators_mdl_ind_equations1_idx` (`id_equations`);

--
-- Indices de la tabla `mdl_ind_operations`
--
ALTER TABLE `mdl_ind_operations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mdl_ind_score`
--
ALTER TABLE `mdl_ind_score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mdl_ind_score_mdl_ind_company_indicators1_idx` (`id_company_indicators`);

--
-- Indices de la tabla `mdl_ind_subindicators`
--
ALTER TABLE `mdl_ind_subindicators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mdl_ind_sub_indicators_mdl_ind_indicators1_idx` (`id_indicators`),
  ADD KEY `fk_mdl_ind_sub_indicators_mdl_ind_type_indicators1_idx` (`id_type_indicators`),
  ADD KEY `fk_mdl_ind_subindicators_mdl_ind_equations1_idx` (`id_equations`);

--
-- Indices de la tabla `mdl_ind_type_indicators`
--
ALTER TABLE `mdl_ind_type_indicators`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mdl_ind_user_companies`
--
ALTER TABLE `mdl_ind_user_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mdl_ind_variables`
--
ALTER TABLE `mdl_ind_variables`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mdl_ind_companies`
--
ALTER TABLE `mdl_ind_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `mdl_ind_company_indicators`
--
ALTER TABLE `mdl_ind_company_indicators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de la tabla `mdl_ind_equations`
--
ALTER TABLE `mdl_ind_equations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `mdl_ind_equation_variables`
--
ALTER TABLE `mdl_ind_equation_variables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `mdl_ind_indicators`
--
ALTER TABLE `mdl_ind_indicators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `mdl_ind_operations`
--
ALTER TABLE `mdl_ind_operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mdl_ind_score`
--
ALTER TABLE `mdl_ind_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mdl_ind_subindicators`
--
ALTER TABLE `mdl_ind_subindicators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mdl_ind_type_indicators`
--
ALTER TABLE `mdl_ind_type_indicators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mdl_ind_user_companies`
--
ALTER TABLE `mdl_ind_user_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mdl_ind_variables`
--
ALTER TABLE `mdl_ind_variables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mdl_ind_company_indicators`
--
ALTER TABLE `mdl_ind_company_indicators`
  ADD CONSTRAINT `fk_mdl_empresa_indcadores_mdl_empresa` FOREIGN KEY (`id_company`) REFERENCES `mdl_ind_companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mdl_empresa_indcadores_mdl_indicadores1` FOREIGN KEY (`id_indicators`) REFERENCES `mdl_ind_indicators` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mdl_ind_equation_variables`
--
ALTER TABLE `mdl_ind_equation_variables`
  ADD CONSTRAINT `fk_mdl_formula_variable_mdl_formula1` FOREIGN KEY (`id_equation`) REFERENCES `mdl_ind_equations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mdl_formula_variable_mdl_variable1` FOREIGN KEY (`id_variable`) REFERENCES `mdl_ind_variables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mdl_ind_equation_variables_mdl_ind_operations1` FOREIGN KEY (`id_operation`) REFERENCES `mdl_ind_operations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mdl_ind_indicators`
--
ALTER TABLE `mdl_ind_indicators`
  ADD CONSTRAINT `fk_mdl_ind_indicators_mdl_ind_equations1` FOREIGN KEY (`id_equations`) REFERENCES `mdl_ind_equations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mdl_sub_indicadores_mdl_tipo_indicadores1` FOREIGN KEY (`id_type_indicators`) REFERENCES `mdl_ind_type_indicators` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mdl_ind_score`
--
ALTER TABLE `mdl_ind_score`
  ADD CONSTRAINT `fk_mdl_ind_score_mdl_ind_company_indicators1` FOREIGN KEY (`id_company_indicators`) REFERENCES `mdl_ind_company_indicators` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mdl_ind_subindicators`
--
ALTER TABLE `mdl_ind_subindicators`
  ADD CONSTRAINT `fk_mdl_ind_sub_indicators_mdl_ind_indicators1` FOREIGN KEY (`id_indicators`) REFERENCES `mdl_ind_indicators` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mdl_ind_sub_indicators_mdl_ind_type_indicators1` FOREIGN KEY (`id_type_indicators`) REFERENCES `mdl_ind_type_indicators` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mdl_ind_subindicators_mdl_ind_equations1` FOREIGN KEY (`id_equations`) REFERENCES `mdl_ind_equations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
