-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2025 a las 09:36:59
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
-- Base de datos: `e-commerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `idCarrito` int(7) NOT NULL,
  `fkIdUsuario` int(7) DEFAULT NULL,
  `fkIdProducto` int(7) DEFAULT NULL,
  `precioTotal` float DEFAULT NULL,
  `precioUnidad` float DEFAULT NULL,
  `cantidad` int(5) DEFAULT NULL,
  `fkIdCompra` int(11) DEFAULT NULL,
  `fechaInicial` date DEFAULT NULL,
  `fechaFinal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `carrito`
--

(38, 1, 3, 1749990, 249999, 7, NULL, '2025-06-21', '2025-06-28'),
(40, 1, 41, 500000, 500000, 1, NULL, '2025-06-27', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(7) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre`) VALUES
(1, 'Auto'),
(2, 'Vuelos'),
(3, 'Hospeajes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idCompra` int(7) NOT NULL,
  `fkIdUsuario` int(7) DEFAULT NULL,
  `precioTotal` float DEFAULT NULL,
  `estado` enum('No realizado','Pendiente','Cancelado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoshistoricos`
--

CREATE TABLE `pedidoshistoricos` (
  `idHistorico` int(7) NOT NULL,
  `fechaDelPedido` date DEFAULT NULL,
  `fkIdUsuario` int(7) DEFAULT NULL,
  `fkIdProducto` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(7) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `fkIdCategoria` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `descripcion`, `precio`, `nombre`, `fkIdCategoria`) VALUES
(1, 'Ford Ka modelo 2008.', 25000, 'Ford ka', 1),
(3, 'Hotel en Miami, Estados Unidos tres estrellas.', 249999, 'Hotel El Momito', 3),
(4, 'Subaru impresa modelo 2011.', 50000, 'Subaru', 1),
(5, 'Pasaje clase media a Buenos Aires.', 500000, 'Buenos Aires', 2),
(6, 'Hotel en Roma, Italia  cuatro estrellas.', 120000, 'Hotel Splinter', 3),
(7, 'Toyota Hilux modelo 2001.', 25000, 'Toyota', 1),
(8, 'Ford Ranger modelo 1998.', 30000, 'Ford', 1),
(9, 'Ford Focus modelo 2013.', 15000, 'Ford', 1),
(10, 'Jeep Cherokee modelo 2019.', 60000, 'Jeep', 1),
(11, 'Jeep Gladiator modelo 2015.', 70000, 'Jeep', 1),
(12, 'Toyota Corolla modelo 2022.', 35000, 'Toyota', 1),
(13, 'Jaguar F Pace modelo 2019.', 80000, 'Jaguar', 1),
(14, 'Hummer EV modelo 2023.', 90000, 'Hummer', 1),
(15, 'RAM Rampage modelo 2016.', 45000, 'RAM', 1),
(16, 'RAM 2500 modelo 2023.', 25000, 'RAM', 1),
(17, 'Hotel en Londres, Reino Unido Cinco estrellas.', 200000, 'Hotel Sigmaboy', 3),
(18, 'Hotel Berlín, Alemania cuatro estrellas.', 120000, 'Hotel Platense', 3),
(19, 'Volkswagen Polo Classic modelo 2006.', 30000, 'Volkswagen', 1),
(20, 'Volkswagen Taos modelo 2024.', 450000, 'Volkswagen', 1),
(21, 'Hotel París, Francia tres estrellas.', 100000, 'Hotel Sorieketon', 3),
(22, 'Hotel en Ciudad De México, México tres estrellas.', 90000, 'Hotel Frabigol', 3),
(23, 'Hotel en Santiago De Chile, Chile cuatro estrellas.', 130000, 'Hotel Ming', 3),
(24, 'Hotel en Santo Domingo, Republica Dominicana cinco estrellas.', 110000, 'Hotel Bordieri', 3),
(25, 'Hotel en Viena, Austria cinco estrellas.', 150000, 'Hotel Toto', 3),
(26, 'Hotel en Madrid, España cinco estrellas.', 150000, 'Hotel Wigetta', 3),
(27, 'Hotel en Atenas, Gre', 100000, 'Hotel Kratos', 3),
(28, 'Hotel en Copenhague,', 800000, 'Hotel Zuko', 3),
(29, 'Hotel en Brasilia, B', 1500000, 'Hotel Atomix', 3),
(30, 'Hotel en Asunción, P', 850000, 'Hotel Echoes', 3),
(31, 'Hotel en Montevideo,', 1200000, 'Hotel Mortis', 3),
(32, 'Hotel en San Salvado', 1600000, 'Hotel Fernan', 3),
(33, 'Hotel en Washington ', 1700000, 'Hotel Liberty', 3),
(34, 'Hotel en 	Lima, Perú', 900000, 'Hotel Luchito', 3),
(35, 'Hotel en La Paz, Bol', 1200000, 'Hotel Unidad', 3),
(36, 'Hotel en Medellín, C', 1300000, 'Hotel Diriboy', 3),
(37, 'Hotel en Kiev, Ucran', 1000000, 'Hotel Rusowsky', 3),
(38, 'Hotel en Andorra La ', 1700000, 'Hotel Grefg ', 3),
(39, 'Hotel en Ottawa, Can', 1500000, 'Hotel Wolverine', 3),
(40, 'Pasaje clase media a', 600000, 'Estambul', 2),
(41, 'Pasaje clase alta a ', 500000, 'Santiago De Chile', 2),
(42, 'Pasaje clase media a', 650000, 'Roma', 2),
(43, 'Pasaje clase media a', 400000, 'Montevideo', 2),
(44, 'Pasaje clase media a', 700000, 'Londres', 2),
(45, 'Pasaje clase alta a ', 800000, 'París', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(7) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `contrasenia` varchar(18) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellido`, `email`, `contrasenia`, `admin`) VALUES
(1, 'Joaquin', NULL, 'joaquin@gmail.com', 'Joaquin123', 0),
(2, 'admin', NULL, 'admin@admin', 'Admin123', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`idCarrito`),
  ADD KEY `fkIdUsuario` (`fkIdUsuario`),
  ADD KEY `fkIdProducto` (`fkIdProducto`),
  ADD KEY `fkIdCompra` (`fkIdCompra`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idCompra`),
  ADD KEY `fkIdUsuario` (`fkIdUsuario`);

--
-- Indices de la tabla `pedidoshistoricos`
--
ALTER TABLE `pedidoshistoricos`
  ADD PRIMARY KEY (`idHistorico`),
  ADD KEY `fkIdUsuario` (`fkIdUsuario`),
  ADD KEY `fkIdProducto` (`fkIdProducto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `fkIdCategoria` (`fkIdCategoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `idCarrito` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
  MODIFY `idCarrito` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
  MODIFY `idCarrito` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idCompra` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `pedidoshistoricos`
--
ALTER TABLE `pedidoshistoricos`
  MODIFY `idHistorico` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
