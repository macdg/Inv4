-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-11-2015 a las 18:00:13
-- Versión del servidor: 5.5.46-0+deb8u1
-- Versión de PHP: 5.6.14-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `almacen1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto`
--

CREATE TABLE IF NOT EXISTS `concepto` (
`id_concepto` int(11) NOT NULL,
  `id_uuid` varchar(36) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cantidad` int(3) NOT NULL,
  `unidad` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descrip` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `val_unit` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Conceptos del xml';

--
-- Volcado de datos para la tabla `concepto`
--

INSERT INTO `concepto` (`id_concepto`, `id_uuid`, `cantidad`, `unidad`, `descrip`, `val_unit`) VALUES
(207, '32f7865e-5ee9-46b0-857d-30cc9b7d68b5', 4, 'pz', 'SANGOMA TARJETA AFT 1 T1/E1 MOD. A101E', 426.79),
(208, '32f7865e-5ee9-46b0-857d-30cc9b7d68b5', 3, 'pz', 'BALUN NEO BNC FEMALE TO RJ45 CCITT G703', 45),
(209, '4FFB3E12-5CF2-AA48-B533-986FAC14F7DA', 1, 'PIEZA', 'TELEFONO SIP YEALINK MOD T26P DISPLAY LCD 3 TECLAS LINEA', 112);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `id_uuid` varchar(36) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `rfc_nom` varchar(70) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha` varchar(19) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `subtotal` double NOT NULL,
  `moneda` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `total` double NOT NULL,
  `id_rfc` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Datos de la factura.';

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_uuid`, `rfc_nom`, `fecha`, `subtotal`, `moneda`, `total`, `id_rfc`) VALUES
('32f7865e-5ee9-46b0-857d-30cc9b7d68b5', 'NEOCENTER, S.A. DE C.V.', '2015-08-07T09:32:18', 1842.16, 'Dólares', 2136.91, 'NEO0303288Z1'),
('4FFB3E12-5CF2-AA48-B533-986FAC14F7DA', 'NORDATA, S.A. DE C.V.', '2015-08-03T12:10:26', 112, 'USD', 129.92, 'NOR041213MX4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interno`
--

CREATE TABLE IF NOT EXISTS `interno` (
`id_interno` int(11) NOT NULL,
  `id_productos` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  `tipo_moneda` varchar(3) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tipo_cambio` double NOT NULL,
  `marca` varchar(70) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Interno es una tabla interna con info útil para enlaza.';

--
-- Volcado de datos para la tabla `interno`
--

INSERT INTO `interno` (`id_interno`, `id_productos`, `precio_venta`, `tipo_moneda`, `tipo_cambio`, `marca`) VALUES
(1, 0, 25.16, 'USD', 16.45, 'Sangoma'),
(2, 0, 28.14, 'USD', 16.85, 'Yealink'),
(3, 0, 25.16, 'USD', 16.45, 'Sangoma'),
(4, 0, 28.14, 'USD', 16.85, 'Yealink');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
`id_productos` int(11) NOT NULL,
  `cantidad` int(3) NOT NULL,
  `noserie` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_concepto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=696 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Productos propios de Enlaza.';

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_productos`, `cantidad`, `noserie`, `id_concepto`) VALUES
(688, 4, '0001', 207),
(689, 4, '0001', 207),
(690, 4, '0001', 207),
(691, 4, '0001', 207),
(692, 3, '0001', 208),
(693, 3, '0001', 208),
(694, 3, '0001', 208),
(695, 1, '0001', 209);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `id_rfc` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `rfc_nom` varchar(70) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `calle` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `no_ext` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `no_int` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `colonia` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `referen` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `mun` varchar(25) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `pais` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cp` int(5) NOT NULL,
  `id_uuid` varchar(36) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Proveedor de Partes';

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_rfc`, `rfc_nom`, `calle`, `no_ext`, `no_int`, `colonia`, `referen`, `mun`, `estado`, `pais`, `cp`, `id_uuid`) VALUES
('NEO0303288Z1', 'NEOCENTER, S.A. DE C.V.', 'AVENIDA DIVISION DEL NORTE', '1354 PISO 2', '-202', 'LETRAN VALLE', 'ENTRE UXMAL Y MIGUEL LAURENT', 'DEL. BENITO JUAREZ', 'DISTRITO FEDERA', 'MEXICO', 3650, '32f7865e-5ee9-46b0-857d-30cc9b7d68b5'),
('NOR041213MX4', 'NORDATA, S.A. DE C.V.', 'AV. Morones Prieto 1500', 'Piso 1', 'Suite 101', 'Nuevas Colonias', 'CENTRO CONVEX EDIFICIO JARDINES', 'MONTERREY', 'N.L.', 'México', 64710, '4FFB3E12-5CF2-AA48-B533-986FAC14F7DA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `concepto`
--
ALTER TABLE `concepto`
 ADD PRIMARY KEY (`id_concepto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
 ADD PRIMARY KEY (`id_uuid`);

--
-- Indices de la tabla `interno`
--
ALTER TABLE `interno`
 ADD KEY `id_interno` (`id_interno`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
 ADD PRIMARY KEY (`id_productos`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
 ADD PRIMARY KEY (`id_rfc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `concepto`
--
ALTER TABLE `concepto`
MODIFY `id_concepto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=210;
--
-- AUTO_INCREMENT de la tabla `interno`
--
ALTER TABLE `interno`
MODIFY `id_interno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=696;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
