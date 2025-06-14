-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2025 a las 01:46:37
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

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
  `precioUnidad` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `email` varchar(20) DEFAULT NULL,
  `precioTotal` float DEFAULT NULL,
  `fkIdProducto` int(7) DEFAULT NULL
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
  `descripcion` varchar(20) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `fkIdCategoria` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `descripcion`, `precio`, `nombre`, `fkIdCategoria`) VALUES
(1, 'Auto de gama media', 25000, 'Ford ka', 1),
(2, 'Vuelo clase economic', 1500000, 'Miami', 2),
(3, 'Hotel tres estrellas', 249999, 'Hotel El Momito', 3),
(4, 'Subaru impresa model', 50000, 'Subaru', 1),
(5, 'Pasaje clase media a', 500000, 'Buenos Aires', 2),
(6, 'Hotel en Roma, Itali', 120000, 'Hotel Splinter', 3),
(7, 'Toyata Hilux modelo ', 25000, 'Toyota', 1),
(8, 'Ford Ranger modelo 2', 30000, 'Ford', 1),
(9, 'Ford Focus modelo 20', 15000, 'Ford', 1),
(10, 'Jeep Cherokee modelo', 60000, 'Jeep', 1),
(11, 'Jeep Gladiator model', 70000, 'Jeep', 1),
(12, 'Toyota Corolla model', 35000, 'Toyota', 1),
(13, 'Jaguar F Pace modelo', 80000, 'Jaguar', 1),
(14, 'Hummer EV modelo 202', 90000, 'Hummer', 1),
(15, 'RAM Rampage modelo 2', 45000, 'RAM', 1),
(16, 'RAM 2500 modelo 2023', 25000, 'RAM', 1),
(17, 'Hotel en Londres, Re', 200000, 'Hotel Sigmaboy', 3),
(18, 'Hotel Berlín, Aleman', 120000, 'Hotel Platense', 3),
(19, 'Volkswagen Polo Clas', 30000, 'Volkswagen', 1),
(20, 'Volkswagen Taos mode', 450000, 'Volkswagen', 1),
(21, 'Hotel París, Francia', 100000, 'Hotel Sorieketon', 3),
(22, 'Hotel en Ciudad De M', 90000, 'Hotel Frabigol', 3),
(23, 'Hotel en Santiago De', 130000, 'Hotel Ming', 3),
(24, 'Hotel en Santo Domin', 110000, 'Hotel Bordieri', 3),
(25, 'Hotel en Viena, Aust', 150000, 'Hotel Toto', 3),
(26, 'Hotel en Madrid, Esp', 150000, 'Hotel Wigetta', 3),
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
  `contrasenia` varchar(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`idCarrito`),
  ADD KEY `fkIdUsuario` (`fkIdUsuario`),
  ADD KEY `fkIdProducto` (`fkIdProducto`);

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
  ADD KEY `fkIdUsuario` (`fkIdUsuario`),
  ADD KEY `fkIdProducto` (`fkIdProducto`);

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
  MODIFY `idCarrito` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
