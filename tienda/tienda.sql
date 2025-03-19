-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2023 a las 01:20:45
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
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_usuarios`
--

CREATE TABLE `carrito_usuarios` (
  `id` int(11) NOT NULL,
  `id_sesion` varchar(256) NOT NULL,
  `totalproducto` decimal(10,2) NOT NULL,
  `fecha` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecarritousuario`
--

CREATE TABLE `detallecarritousuario` (
  `id` int(11) NOT NULL,
  `idCarrito_FK` int(11) NOT NULL,
  `idProducto_fk` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `fecha_registro` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallecarritousuario`
--

INSERT INTO `detallecarritousuario` (`id`, `idCarrito_FK`, `idProducto_fk`, `precio`, `cantidad`, `subtotal`, `fecha_registro`) VALUES
(1, 5, 1, 220.00, 1, 220.00, '2023-12-09'),
(2, 6, 6, 30.00, 4, 120.00, '2023-12-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(100) NOT NULL DEFAULT '',
  `precio` decimal(11,2) NOT NULL DEFAULT 0.00,
  `cantidad` int(11) DEFAULT 0,
  `imagen` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio`, `cantidad`, `imagen`) VALUES
(1, 'Cannabis KING', 'Bob Marley', 220.00, 96, 'images/product1.jpg'),
(3, 'Palo azul', 'Presentación de 100 gramos', 30.00, 5, 'images/product3.jpg'),
(4, 'Agua de Rosas', 'Con acido hialurico', 90.00, 10, 'images/product4.jpg'),
(5, 'Estreñimiento', 'Gliser', 90.00, 8, 'images/product5.jpg'),
(6, 'Bacaomax', 'Extracto de hígado de bacalao', 30.00, 4, 'images/product6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL DEFAULT '',
  `contrasena` varchar(100) NOT NULL DEFAULT '',
  `rol` enum('AD','US') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasena`, `rol`) VALUES
(1, 'admin', 'root', 'AD'),
(2, 'guest', 'root', 'US');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito_usuarios`
--
ALTER TABLE `carrito_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallecarritousuario`
--
ALTER TABLE `detallecarritousuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito_usuarios`
--
ALTER TABLE `carrito_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detallecarritousuario`
--
ALTER TABLE `detallecarritousuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
