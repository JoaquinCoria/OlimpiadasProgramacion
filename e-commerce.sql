-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2024 a las 23:42:23
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `delivery`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(4) NOT NULL,
  `id_cliente` int(3) DEFAULT NULL,
  `id_producto` varchar(10) DEFAULT NULL,
  `pago` varchar(25) DEFAULT NULL,
  `entrega` varchar(25) DEFAULT NULL,
  `fecha` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_cliente`, `id_producto`, `pago`, `entrega`, `fecha`) VALUES
(111, 2, '54-58', NULL, NULL, '2024-11-20 18:59:26.000000'),
(112, 2, '62', 'tarjeta', 'delivery', '2024-11-20 19:04:19.000000'),
(113, 0, '', NULL, NULL, '2024-11-20 19:09:29.000000'),
(114, 0, '54', NULL, NULL, '2024-11-20 19:09:37.000000'),
(115, 2, '51-61', 'efectivo', 'delivery', '2024-11-20 19:18:28.000000'),
(116, 2, '', NULL, NULL, '2024-11-25 23:40:32.000000'),
(117, 2, '54-58', NULL, NULL, '2024-11-25 23:40:38.000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(3) NOT NULL,
  `nombre_producto` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `precio` float(10,2) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `categoria`, `imagen`) VALUES
(51, 'Hamburguesa 1', 'Hamburguesa simple medallon de pollo con salsa golf', 7.00, 'Pollo', 'hamburguesa1P.jpeg'),
(54, 'Hamburguesa 2', 'hamburguesa de doble carne, bacon, tomate, cebolla y pepino', 10000.00, 'Carne', 'hamburguesa3P.jpg'),
(58, 'Combo 1', 'Dos hamburguesas triples con queso cheddar y bacon', 15000.00, 'Combos', 'combo5.png'),
(59, 'Hamburguesa simple-niños', 'Hamburguesa de un solo medallon con lechuga y tomate', 7000.00, 'Infantiles', 'burga.jpg'),
(60, 'Combo Triple ', '3 hamburguesas con gusto a elección: \r\n1) Lechuga,tomate,huevo a la plancha\r\n2) Bacon, cheddar y sal', 11800.00, 'Combos', 'combotriple.jpeg'),
(61, 'Hamburguesa 3', 'Doble medallon, champignones, rúcula, muzzarela y roquefort', 11200.00, 'Pollo', 'combosimple-removebg-preview.png'),
(62, 'Hamburguesa 4', 'Doble medallón, muzzarela, tomate cherry y rúcula', 11200.00, 'Carne', 'hamburguesa2P.jpeg'),
(63, 'Hamburguesa 2- niños', 'Hamburguesa de medallon simple con lechuga y tomate', 8200.00, 'Infantiles', 'infantil.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(25) NOT NULL,
  `nombreu` varchar(25) DEFAULT NULL,
  `mail` varchar(25) DEFAULT NULL,
  `clave` varchar(20) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `apellido` varchar(25) DEFAULT NULL,
  `calle` varchar(25) DEFAULT NULL,
  `numero` int(25) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `localidad` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombreu`, `mail`, `clave`, `admin`, `nombre`, `apellido`, `calle`, `numero`, `telefono`, `localidad`) VALUES
(1, 'joaquin2', 'asd@asd2', 'asd321', 1, '', '', '', 0, '0', ''),
(2, 'mm', 'mm@mm', 'mm', 0, 'mm', 'mm', 'mm', 23, '2345', 'nn');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
