-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-12-2019 a las 21:24:36
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdsoluweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL,
  `nombres` text COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` text COLLATE utf8_spanish_ci NOT NULL,
  `cedula` text COLLATE utf8_spanish_ci NOT NULL,
  `nit` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `idtipocliente` int(11) NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `celular` text COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `fechaingreso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fechamodificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcliente`, `nombres`, `apellidos`, `cedula`, `nit`, `email`, `idtipocliente`, `telefono`, `celular`, `ciudad`, `direccion`, `fechaingreso`, `fechamodificacion`) VALUES
(1, 'medasculo', 'moreno', '12345678', '147258369 - 4', 'merda@correo.com', 1, '239 - 38 - 98', '300 - 011 - 44 - 54', 'medellin', 'calle 87', '2019-10-17 05:30:26', '2019-10-17 00:30:26'),
(2, 'diego', 'gallego', '71378654', '7777777 - 4', 'diego@yahoo.com', 1, '239 - 38 - 48', '300 - 000 - 00 - 00', 'medellin', 'carrera 39B numero 44-38 int 444', '2019-10-12 05:01:30', '2019-10-12 00:01:30'),
(3, 'pepito', 'perez', '789789789', '789789789 - 1', 'pepito@gmail.com', 47, '258 - 74 - 10', '300 - 000 - 00 - 00', 'medellin', 'calle 65', '2019-10-17 06:28:53', '2019-10-17 01:28:53'),
(4, 'pei', 'pes', '978789789897', '9788546456 - 6', 'ljklfdgjlkdfgjl@dfgdfg.ggg', 1, '645 - 45 - 64', '978 - 789 - 84 - 56', 'djdslkfjdslk', 'sdofopsdfipo 20', '2019-10-14 07:12:18', NULL),
(5, 'agapito alfonso', 'lopez gónzales', '225589630', '258963000 - 9', 'agapt@gmail.mee', 1, '258 - 96 - 30', '321 - 456 - 98 - 70', 'cali', 'av 12', '2019-11-09 06:18:28', '2019-10-17 02:49:01'),
(6, 'gilma', 'gutierrez', '22558989', '5465465445 - 1', 'kjhdfgkjdfgh@fgdfg.com', 1, '236 - 54 - 78', '321 - 456 - 98 - 88', 'cali', 'call 20', '2019-10-17 06:04:49', '2019-10-17 01:04:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `idcotizacion` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `fechainicial` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fechamovimiento` timestamp NULL DEFAULT NULL,
  `formapago` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `totalcotizacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`idcotizacion`, `idcliente`, `idusuario`, `fechainicial`, `fechamovimiento`, `formapago`, `totalcotizacion`, `estado`) VALUES
(1, 2, 1, '2019-11-05 07:27:50', '2019-11-20 05:00:00', 'Efectivo - 150000', '107748', '1'),
(2, 1, 1, '2019-11-14 18:52:05', '2019-11-15 05:00:00', 'Targeta credito - 312132213312312', '141300', '1'),
(3, 5, 1, '2019-11-01 05:06:50', '2019-10-27 05:00:00', 'Efectivo - 70000', '61576', '1'),
(4, 2, 1, '2019-10-31 06:41:31', '2019-10-27 05:00:00', 'Targeta debito', '22640', '1'),
(5, 6, 1, '2019-11-12 06:10:50', '2019-11-12 05:00:00', 'Efectivo - 150000', '141300', '1'),
(6, 4, 1, '2019-10-31 06:41:31', '2019-10-27 05:00:00', 'Targeta credito', '43990', '1'),
(7, 1, 1, '2019-10-31 06:41:31', '2019-10-27 05:00:00', 'Efectivo - 500000', '445784', '1'),
(8, 2, 1, '2019-10-31 06:41:31', '2019-10-27 05:00:00', 'Targeta debito - 11447785522', '109430', '1'),
(9, 2, 1, '2019-10-31 06:41:31', '2019-10-27 05:00:00', 'Efectivo - 91000', '86550', '1'),
(10, 2, 1, '2019-10-31 06:41:31', '2019-10-27 05:00:00', 'Efectivo - 50000', '37760', '1'),
(11, 5, 1, '2019-10-31 06:41:31', '2019-10-27 05:00:00', 'Targeta debito - 1122334455667788', '25850', '1'),
(12, 1, 1, '2019-10-31 06:41:31', '2019-10-27 05:00:00', 'Efectivo - 25000', '22640', '1'),
(13, 3, 1, '2019-10-31 06:49:48', '2019-11-01 05:00:00', 'Efectivo - 30000', '28260', '1'),
(16, 5, 1, '2019-11-15 02:53:30', '2019-11-14 05:00:00', 'Efectivo - 68000', '66460', '1'),
(17, 3, 1, '2019-11-18 00:14:19', '2019-11-17 05:00:00', 'Efectivo - 180000', '165100', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecotizacion`
--

CREATE TABLE `detallecotizacion` (
  `idcotizacion` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `detalle` text COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` text COLLATE utf8_spanish_ci NOT NULL,
  `valorunitario` text COLLATE utf8_spanish_ci NOT NULL,
  `total` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detallecotizacion`
--

INSERT INTO `detallecotizacion` (`idcotizacion`, `idproducto`, `detalle`, `cantidad`, `valorunitario`, `total`) VALUES
(1, 28, 'papa rancia', '2', '5410', '10820'),
(1, 9, 'jjjjjjjjjjjjjjjjjj', '4', '1500', '6000'),
(1, 8, 'hgjghjghj', '6', '588', '3528'),
(1, 7, 'hkhjkhjk', '10', '8740', '87400'),
(3, 1, 'mondongo enlatado kl', '1', '2410', '2410'),
(3, 2, 'FRIJOL ROSADO', '1', '21350', '21350'),
(3, 3, 'AAAAAAA', '1', '4500', '4500'),
(3, 4, 'ghjghj', '1', '9500', '9500'),
(3, 5, 'ghjhgj', '1', '12400', '12400'),
(3, 6, 'ghjghj', '1', '1500', '1500'),
(3, 7, 'hkhjkhjk', '1', '8740', '8740'),
(3, 8, 'hgjghjghj', '2', '588', '1176'),
(5, 1, 'mondongo enlatado kl', '5', '2410', '12050'),
(5, 2, 'FRIJOL ROSADO', '5', '21350', '106750'),
(5, 3, 'AAAAAAA', '5', '4500', '22500'),
(2, 1, 'mondongo enlatado kl', '5', '2410', '12050'),
(2, 2, 'FRIJOL ROSADO', '5', '21350', '106750'),
(2, 3, 'AAAAAAA', '5', '4500', '22500'),
(6, 9, 'jjjjjjjjjjjjjjjjjj', '1', '1500', '1500'),
(6, 7, 'hkhjkhjk', '1', '8740', '8740'),
(6, 5, 'ghjhgj', '1', '12400', '12400'),
(6, 2, 'FRIJOL ROSADO', '1', '21350', '21350'),
(4, 7, 'hkhjkhjk', '1', '8740', '8740'),
(4, 6, 'ghjghj', '1', '1500', '1500'),
(4, 5, 'ghjhgj', '1', '12400', '12400'),
(8, 1, 'mondongo enlatado kl', '11', '2410', '26510'),
(8, 9, 'jjjjjjjjjjjjjjjjjj', '12', '1500', '18000'),
(8, 28, 'papa rancia', '12', '5410', '64920'),
(9, 2, 'FRIJOL ROSADO', '3', '21350', '64050'),
(9, 3, 'AAAAAAA', '5', '4500', '22500'),
(7, 28, 'papa rancia', '1', '5410', '5410'),
(7, 9, 'jjjjjjjjjjjjjjjjjj', '2', '1500', '3000'),
(7, 8, 'hgjghjghj', '3', '588', '1764'),
(7, 7, 'hkhjkhjk', '4', '8740', '34960'),
(7, 6, 'ghjghj', '5', '1500', '7500'),
(7, 5, 'ghjhgj', '6', '12400', '74400'),
(7, 4, 'ghjghj', '7', '9500', '66500'),
(7, 3, 'AAAAAAA', '8', '4500', '36000'),
(7, 2, 'FRIJOL ROSADO', '9', '21350', '192150'),
(7, 1, 'mondongo enlatado kl', '10', '2410', '24100'),
(10, 1, 'mondongo enlatado kl', '1', '2410', '2410'),
(10, 2, 'FRIJOL ROSADO', '1', '21350', '21350'),
(10, 3, 'AAAAAAA', '1', '4500', '4500'),
(10, 4, 'ghjghj', '1', '9500', '9500'),
(11, 2, 'FRIJOL ROSADO', '1', '21350', '21350'),
(11, 3, 'AAAAAAA', '1', '4500', '4500'),
(12, 6, 'ghjghj', '1', '1500', '1500'),
(12, 5, 'ghjhgj', '1', '12400', '12400'),
(12, 7, 'hkhjkhjk', '1', '8740', '8740'),
(13, 1, 'mondongo enlatado kl', '1', '2410', '2410'),
(13, 2, 'FRIJOL ROSADO', '1', '21350', '21350'),
(13, 3, 'AAAAAAA', '1', '4500', '4500'),
(16, 1, 'mondongo enlatado kl', '1', '2410', '2410'),
(16, 2, 'FRIJOL ROSADO', '3', '21350', '64050'),
(17, 2, 'FRIJOL ROSADO', '6', '21350', '128100'),
(17, 3, 'AAAAAAA', '4', '4500', '18000'),
(17, 4, 'ghjghj', '2', '9500', '19000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `idusuario` int(11) NOT NULL,
  `tipomovimiento` text COLLATE utf8_spanish_ci NOT NULL,
  `estado_actual` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechamovimiento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`idusuario`, `tipomovimiento`, `estado_actual`, `fechamovimiento`, `id`) VALUES
(1, 'usuario', 'Salió sistema', '2019-11-12 06:28:19', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-14 18:49:04', 1),
(1, 'cotizacion', 'guardar cotizacion', '2019-11-14 18:52:05', 2),
(1, 'usuario', 'ingreso sistema', '2019-11-15 02:43:01', 1),
(1, 'cotizacion', 'Nuevo cotizacion', '2019-11-15 02:43:29', 16),
(1, 'cotizacion', 'guardar cotizacion', '2019-11-15 02:53:30', 16),
(1, 'usuario', 'Salió sistema', '2019-11-15 07:58:09', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-15 07:58:11', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-16 04:06:01', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-17 05:32:36', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-17 20:51:56', 1),
(1, 'cotizacion', 'Nuevo cotizacion', '2019-11-18 00:13:55', 17),
(1, 'cotizacion', 'guardar cotizacion', '2019-11-18 00:14:19', 17),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:23:21', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:23:22', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:23:32', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:23:33', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:23:57', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:24:05', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:24:31', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:25:49', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:27:25', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:29:14', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:29:42', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:39:57', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:40:46', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:42:42', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:45:38', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:45:52', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:46:10', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:46:56', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:47:11', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:49:11', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:50:07', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:52:24', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:54:20', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:56:15', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 00:58:04', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 00:58:10', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 07:16:47', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 08:00:26', 1),
(1, 'usuario', 'ingreso sistema', '2019-11-18 08:00:31', 1),
(1, 'usuario', 'Salió sistema', '2019-11-18 08:14:18', 1),
(1, 'usuario', 'ingreso sistema', '2019-12-17 02:09:37', 1),
(1, 'producto', 'Nuevo producto', '2019-12-17 02:10:17', 30),
(1, 'cotizacion', 'Nuevo cotizacion', '2019-12-17 02:13:16', 18),
(1, 'usuario', 'ingreso sistema', '2019-12-18 01:49:31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perdidas`
--

CREATE TABLE `perdidas` (
  `idproducto` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` text COLLATE utf8_spanish_ci NOT NULL,
  `totalperdida` text COLLATE utf8_spanish_ci NOT NULL,
  `fechamovimiento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `valor` text COLLATE utf8_spanish_ci NOT NULL,
  `iva` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `valoriva` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `idtipoproducto` int(11) NOT NULL,
  `fechaingreso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fechamodificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `codigo`, `nombre`, `descripcion`, `valor`, `iva`, `valoriva`, `idtipoproducto`, `fechaingreso`, `fechamodificacion`) VALUES
(1, '1234567890', 'mondongo enlatado kl', 'contenido 3 litros kl', '2410', '1', '21', 4, '2019-10-29 06:49:14', '2019-10-29 01:49:14'),
(2, '99887700', 'FRIJOL ROSADO', '2 libras', '21350', '1', '0', 4, '2019-10-20 00:57:29', '2019-10-19 19:57:29'),
(3, '3366998', 'AAAAAAA', 'bbbbbbbbbbbb', '4500', '1', '0', 5, '2019-10-23 01:18:16', '2019-10-17 03:34:50'),
(4, '7878788', 'ghjghj', 'kikikikiki', '9500', '0', '0', 5, '2019-10-29 06:49:23', '2019-10-29 01:49:23'),
(5, '897898797', 'ghjhgj', 'ghjhg', '12400', '1', '11', 5, '2019-10-23 01:18:25', '2019-10-17 03:35:02'),
(6, '786786', 'ghjghj', 'ghjghj', '1500', '1', '32', 4, '2019-10-20 00:27:45', '2019-10-17 03:46:28'),
(7, '789789', 'hkhjkhjk', 'hjkhjk', '8740', '0', '0', 4, '2019-10-20 00:56:32', '2019-10-19 19:56:32'),
(8, '876867876', 'hgjghjghj', 'ghjghj', '588', '1', '77', 4, '2019-10-23 01:18:38', NULL),
(9, '4444444444444', 'jjjjjjjjjjjjjjjjjj', 'jjjjjjjjjjjjjj', '1500', '1', '98', 5, '2019-10-20 00:27:45', '2019-10-18 01:17:46'),
(28, '85214700', 'papa rancia', 'producto comoestible', '5410', '0', '0', 4, '2019-10-23 05:18:15', NULL),
(30, '1111111111111', 'vvvvvvvv', 'dddddddddddd', '20000', '1', '10', 5, '2019-12-17 02:10:17', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocliente`
--

CREATE TABLE `tipocliente` (
  `idtipocliente` int(11) NOT NULL,
  `tipocliente` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipocliente`
--

INSERT INTO `tipocliente` (`idtipocliente`, `tipocliente`) VALUES
(1, 'Natural'),
(47, 'empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproducto`
--

CREATE TABLE `tipoproducto` (
  `idtipoproducto` int(11) NOT NULL,
  `tipoproducto` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipoproducto`
--

INSERT INTO `tipoproducto` (`idtipoproducto`, `tipoproducto`) VALUES
(4, 'Producto'),
(5, 'Servicio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombres` text COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `permisos` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaingreso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fechamodificacion` datetime DEFAULT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombres`, `apellidos`, `email`, `usuario`, `password`, `permisos`, `fechaingreso`, `fechamodificacion`, `imagen`, `estado`, `ultimo_login`) VALUES
(1, 'administrador', 'principal', 'admin@correo.com', 'adminnistrator', '$2a$07$usesomesillystringforeZ/FSGqiNPKlP.F3H7dTY6bIQhlWQdjC', NULL, '2019-12-18 01:49:31', '2019-10-16 04:09:29', 'vista/img/usuarios/adminnistrator/271.jpg', 1, '2019-12-17 20:49:31'),
(5, 'alberto', 'castro', 'alberto@gmail.es', 'alberto17', '$2a$07$usesomesillystringforeZ/FSGqiNPKlP.F3H7dTY6bIQhlWQdjC', NULL, '2019-10-16 09:36:04', '2019-10-14 03:33:08', 'vista/img/usuarios/alberto17/311.png', 1, '2019-10-16 04:36:04'),
(55, 'alejandro', 'carrasquilla', 'alejandro@correo.com', 'alejandro', '$2a$07$usesomesillystringforeZ/FSGqiNPKlP.F3H7dTY6bIQhlWQdjC', NULL, '2019-10-16 09:09:04', '2019-10-16 04:09:04', 'vista/img/usuarios/alejandro/879.jpg', 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `idtipocliente` (`idtipocliente`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`idcotizacion`),
  ADD KEY `idcliente` (`idcliente`);

--
-- Indices de la tabla `detallecotizacion`
--
ALTER TABLE `detallecotizacion`
  ADD KEY `idcotizacion` (`idcotizacion`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `idtipoproducto` (`idtipoproducto`);

--
-- Indices de la tabla `tipocliente`
--
ALTER TABLE `tipocliente`
  ADD PRIMARY KEY (`idtipocliente`);

--
-- Indices de la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  ADD PRIMARY KEY (`idtipoproducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `idcotizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tipocliente`
--
ALTER TABLE `tipocliente`
  MODIFY `idtipocliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `tipoproducto`
--
ALTER TABLE `tipoproducto`
  MODIFY `idtipoproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`idtipocliente`) REFERENCES `tipocliente` (`idtipocliente`);

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`);

--
-- Filtros para la tabla `detallecotizacion`
--
ALTER TABLE `detallecotizacion`
  ADD CONSTRAINT `detallecotizacion_ibfk_1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idtipoproducto`) REFERENCES `tipoproducto` (`idtipoproducto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
