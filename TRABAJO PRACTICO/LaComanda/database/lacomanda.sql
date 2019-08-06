-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2019 a las 00:38:45
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lacomanda`
--
/*CREATE DATABASE IF NOT EXISTS `lacomanda` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `lacomanda`;*/

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL,
  `IdPedido` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `resto` int(11) DEFAULT NULL,
  `cocinero` int(11) DEFAULT NULL,
  `mozo` int(11) DEFAULT NULL,
  `comentario` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`id`, `IdPedido`, `resto`, `cocinero`, `mozo`, `comentario`) VALUES
(1, 'COM-001', 5, 6, 7, 'BUENISIMA'),
(8, 'COM-008', 10, 4, 8, 'pesimo todo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`Id`, `Nombre`) VALUES
(1, 'Pendiente'),
(2, 'En Preparacion'),
(3, 'Listo para Servir'),
(4, 'Con Cliente Esperando Pedido'),
(5, 'Cliente Comiendo'),
(6, 'Cliente Pagando'),
(7, 'Cerrada'),
(8, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `codigoFactura` int(11) NOT NULL,
  `codigoPedido` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `mesa` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` varchar(11) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`codigoFactura`, `codigoPedido`, `mesa`, `fecha`, `total`) VALUES
(4, 'COM-001', 'MESA01', '23/02/2019', 1800),
(5, 'COM-002', 'MESA01', '25/02/2019', 1500),
(6, 'COM-003', 'MESA02', '24/02/2019', 2000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `IdEmpleado` int(11) NOT NULL,
  `fecha` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `ingreso` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `egreso` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`IdEmpleado`, `fecha`, `ingreso`, `egreso`) VALUES
(12, '12/12/2018', '12:00:01', ''),
(2, '19/02/2019', '11:21:51', ''),
(1, '19/02/2019', '11:23:02', '09:50:27'),
(1, '20/02/2019', '12:43:37', '09:50:27'),
(16, '20/02/2019', '01:15:03', ''),
(1, '21/02/2019', '08:22:08', '09:50:27'),
(1, '22/02/2019', '08:45:29', '09:50:27'),
(1, '23/02/2019', '12:20:47', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `Id` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `IdCliente` int(10) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`Id`, `IdCliente`, `estado`) VALUES
('MESA03', 0, 0),
('MESA01', 1, 6),
('MESA02', 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `fecha` varchar(11) COLLATE utf8_spanish2_ci NOT NULL,
  `horaInicio` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `horaFin` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `id` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `idCliente` int(10) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `tiempo` varchar(5) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `productoId` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`fecha`, `horaInicio`, `horaFin`, `id`, `idCliente`, `estado`, `tiempo`, `productoId`, `cantidad`) VALUES
('12/12/2018', '10:10:05', '10:25:05', 'COM-006', 4, 3, '30', 1, 1),
('23/02/2019', '15:26:00', '16:26:00', 'COM-003', 3, 3, '30', 2, 6),
('23/02/2019', '22:00:00', '22:40:00', 'COM-008', 2, 3, '30', 3, 5),
('23/02/2019', '16:05:00', '16:25:00', 'COM-001', 1, 3, '30', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_puesto`
--

CREATE TABLE `pedido_puesto` (
  `idPedido` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `idEmpleado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedido_puesto`
--

INSERT INTO `pedido_puesto` (`idPedido`, `idEmpleado`) VALUES
('COM-008', 6),
('COM-003', 5),
('COM-006', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codigo`, `descripcion`, `precio`) VALUES
(1, 'vino Salentein', 600),
(2, 'empanadas', 20),
(3, 'cerveza Patagonia', 30),
(4, 'pizzas', 100),
(5, 'caipirinha', 120),
(6, 'margarita', 125),
(7, 'daikiri', 90),
(8, 'mojito', 75),
(9, 'salmon', 320);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`Id`, `Nombre`) VALUES
(1, 'Golondrina'),
(2, 'Bartender'),
(3, 'Cerveceros'),
(4, 'Cocineros'),
(5, 'Mozos'),
(6, 'Socios'),
(7, 'Clientes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `IdPuesto` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `clave`, `nombre`, `apellido`, `IdPuesto`) VALUES
(1, 'ger@ger', '123', 'german', 'alvaredo', 7),
(2, 'maria@maria', '123', 'maria', 'cross', 7),
(3, 'javi@javi', '123', 'javier', 'alvaredo', 7),
(4, 'maru@botana', '123', 'Maru ', 'Botana', 4),
(5, 'carlos@arguinano', '123', 'Carlos', 'Arguiñano', 4),
(6, 'rodrigo@pascual', '123', 'Rodrigo', 'Pascual', 2),
(7, 'javier@bazterrica', '123', 'Javier', 'Bazterrica', 2),
(8, 'narda@lepes', '123', 'Narda', 'Lepes', 3),
(9, 'ariel@figueroa', '123', 'Ariel', 'Figueroa', 3),
(10, 'francisco@sade', '123', 'Francisco', 'Sade', 5),
(11, 'fernando@trocca', '123', 'Fernando', 'Trocca', 5),
(12, 'rosa@martinez', '123', 'Rosa', 'Martinez', 6),
(13, 'gonzalo@rodriguez', '123', 'Gonzalito', 'Rodriguez', 6),
(14, 'susana@gimenez', '123', 'Susana', 'Gimenez', 1),
(15, 'ana@Casanova', '123', 'Ana', 'Casanova', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_asignacion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_asignacion` (
`idPedido` varchar(25)
,`Cliente` varchar(101)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_empleados`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_empleados` (
`email` varchar(50)
,`nombre` varchar(50)
,`apellido` varchar(50)
,`Puesto` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_horarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_horarios` (
`fecha` varchar(11)
,`ingreso` varchar(10)
,`egreso` varchar(10)
,`Empleado` varchar(50)
,`apellido` varchar(50)
,`Puesto` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_operacion_empleado`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_operacion_empleado` (
`fecha` varchar(11)
,`nombre` varchar(50)
,`apellido` varchar(50)
,`descripcion` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_asignacion`
--
DROP TABLE IF EXISTS `v_asignacion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_asignacion`  AS  select `pp`.`idPedido` AS `idPedido`,concat(`u`.`nombre`,' ',`u`.`apellido`) AS `Cliente` from (`pedido_puesto` `pp` join `usuario` `u`) where (`u`.`id` = `pp`.`idEmpleado`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_empleados`
--
DROP TABLE IF EXISTS `v_empleados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_empleados`  AS  select `u`.`email` AS `email`,`u`.`nombre` AS `nombre`,`u`.`apellido` AS `apellido`,`p`.`Nombre` AS `Puesto` from (`usuario` `u` join `puesto` `p`) where ((`u`.`IdPuesto` = `p`.`Id`) and (`u`.`IdPuesto` <> 7)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_horarios`
--
DROP TABLE IF EXISTS `v_horarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_horarios`  AS  select `h`.`fecha` AS `fecha`,`h`.`ingreso` AS `ingreso`,`h`.`egreso` AS `egreso`,`e`.`nombre` AS `Empleado`,`e`.`apellido` AS `apellido`,`p`.`Nombre` AS `Puesto` from ((`horarios` `h` join `usuario` `e`) join `puesto` `p`) where ((`h`.`IdEmpleado` = `e`.`id`) and (`p`.`Id` = `e`.`id`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_operacion_empleado`
--
DROP TABLE IF EXISTS `v_operacion_empleado`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_operacion_empleado`  AS  select `ped`.`fecha` AS `fecha`,`u`.`nombre` AS `nombre`,`u`.`apellido` AS `apellido`,`p`.`descripcion` AS `descripcion` from (((`usuario` `u` join `producto` `p`) join `pedido` `ped`) join `pedido_puesto` `pedp`) where ((`pedp`.`idEmpleado` = `u`.`id`) and (`pedp`.`idPedido` = `ped`.`id`) and (`ped`.`productoId` = `p`.`codigo`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`codigoFactura`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`IdCliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `codigoFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
