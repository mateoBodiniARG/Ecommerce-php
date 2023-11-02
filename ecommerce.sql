-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2023 a las 04:22:24
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
-- Base de datos: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `usuario`, `contrasena`) VALUES
(1, 'admin', 'contrasena123'),
(2, 'mateo', '123'),
(4, 'prueba 2', '12345'),
(5, 'prueba 2', 'asd'),
(6, 'a', 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`) VALUES
(1, 'HyperX'),
(2, 'Lenovo'),
(4, 'Samsung');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_inventario`
--

CREATE TABLE `movimientos_inventario` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos_inventario`
--

INSERT INTO `movimientos_inventario` (`id`, `id_producto`, `cantidad`, `motivo`, `descripcion`, `fecha_registro`) VALUES
(1, 9, 10, 'aumentar', 'Se han comprado 10 unidades', '2023-10-24 02:40:29'),
(2, 11, 50, 'aumentar', 'Se han adquirido 50 nuevas unidades', '2023-10-25 01:44:10'),
(3, 18, 30, 'aumentar', 'Se han adquirido 30 nuevas unidades', '2023-11-02 01:32:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `estado` enum('disponible','no disponible') NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `cantidad_vendida` int(11) DEFAULT 0,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `imagen`, `stock`, `estado`, `activo`, `cantidad_vendida`, `id_marca`) VALUES
(1, 'HyperX Cirro Buds Pro', 110.00, 'https://firebasestorage.googleapis.com/v0/b/techvibes-d125a.appspot.com/o/buds.png?alt=media&token=69326c83-160c-4401-993d-d00c3396f540&_gl=1*80nyce*_ga*MjAzMDQwNzQwLjE2OTY5NjUzMTM3MC41Ni4wLjA.', 97, 'no disponible', 1, 9, 1),
(2, 'Hyperx Alloy Origins', 30.00, 'https://hyperx.com/cdn/shop/files/hyperx_alloy_origins_us_1_top_down_900x.jpg?v=1688318371', 0, 'no disponible', 1, 0, 1),
(3, 'Notebook Lenovo V15 Gen 2', 670.00, 'https://firebasestorage.googleapis.com/v0/b/techvibes-d125a.appspot.com/o/677172-MLA48635279078_122021-F.jpg?alt=media&token=46b01072-541d-498f-8bb3-a623f36df35b&_gl=1*1y8psof*_ga*MjAzMDQwNzQwLjE2OTY1MzAzNzM.*_ga_CW55HF8NVT*MTY5NzA1OTMzOS4zLjEuMTY5NzA1OTQ', 554, 'disponible', 1, 6, 2),
(4, 'Hyperx quadcast S', 280.00, 'https://firebasestorage.googleapis.com/v0/b/techvibes-d125a.appspot.com/o/microphone.png?alt=media&token=b085df44-d251-4b1b-8bfd-615fe0c6f69f&_gl=1*1t6keyq*_ga*MjAzMDQwNzQwLjE2OTY1MzAzNzM.*_ga_CW55HF8NVT*MTY5NzQ4NTUxMC41LjEuMTY5NzQ4NTk0NS42MC4wLjA.', 0, 'disponible', 0, 0, 1),
(9, 'Auriculares hyperx', 180.00, 'https://firebasestorage.googleapis.com/v0/b/techvibes-d125a.appspot.com/o/auris.png?alt=media&token=93635679-698f-4e1d-8a41-88e740719212&_gl=1*1h756ws*_ga*MjAzMDQwNzQwLjE2OTY1MzAzNzM.*_ga_CW55HF8NVT*MTY5NzQ5MjM3OS42LjEuMTY5NzQ5MjM5Ni40My4wLjA.', 10, 'disponible', 1, 0, 1),
(10, 'Mouse hyperx', 100.00, 'https://firebasestorage.googleapis.com/v0/b/techvibes-d125a.appspot.com/o/mouse.png?alt=media&token=2e821b49-defd-4b09-b486-c2c7115a6298&_gl=1*15iphxt*_ga*MjAzMDQwNzQwLjE2OTY1MzAzNzM.*_ga_CW55HF8NVT*MTY5NzUwMjQ2OS43LjEuMTY5NzUwMjQ4OS40MC4wLjA.', 10, 'disponible', 1, 0, 1),
(11, 'HyperX Vision S | Webcam', 110.00, 'https://firebasestorage.googleapis.com/v0/b/techvibes-d125a.appspot.com/o/HyperX%20Vision%20S%20%20Webcam.png?alt=media&token=3c9fe7a5-1ad9-4a50-ad58-3ba65980382d&_gl=1*1qsgsj9*_ga*MjAzMDQwNzQwLjE2OTY1MzAzNzM.*_ga_CW55HF8NVT*MTY5NzY4MDIyNC44LjEuMTY5NzY4MD', 129, 'no disponible', 0, 0, 1),
(18, 'Monitor samsung', 190.00, 'https://firebasestorage.googleapis.com/v0/b/techvibes-d125a.appspot.com/o/monitorSamsung.png?alt=media&token=a8f3a1eb-e2be-4e3c-9568-5864117f491e&_gl=1*1kvr967*_ga*MjAzMDQwNzQwLjE2OTY1MzAzNzM.*_ga_CW55HF8NVT*MTY5ODE5NzI2NC45LjEuMTY5ODE5ODM4MC4xOS4wLjA.', 36, 'disponible', 1, 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticketmotivo`
--

CREATE TABLE `ticketmotivo` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `motivo` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ticketmotivo`
--

INSERT INTO `ticketmotivo` (`id`, `id_producto`, `motivo`, `fecha_creacion`) VALUES
(1, 1, 'He modificado este producto, porque hay stock y ya esta disponible ', '2023-10-15 20:27:01'),
(2, 3, 'Se ha aumentado el stock de 10 a 20 de este producto', '2023-10-16 00:05:31'),
(3, 2, 'Nuevamente stock del producto, se ha cambiado el estado de \"no disponible\" a \"disponible\"', '2023-10-16 21:04:34'),
(4, 9, 'Nuevamente stock del producto, se ha cambiado el estado de \"no disponible\" a \"disponible\"', '2023-10-16 21:41:29'),
(5, 4, 'Nuevamente stock del producto, se ha cambiado el estado de \"no disponible\" a \"disponible\"', '2023-10-16 21:42:13'),
(6, 10, 'Nuevamente stock del producto, se ha cambiado el estado de \"no disponible\" a \"disponible\"', '2023-10-17 00:29:14'),
(7, 2, 'No hay stock de este producto', '2023-10-17 00:29:32'),
(8, 4, 'No hay stock de este producto', '2023-10-17 20:08:39'),
(9, 9, 'Estaba mal escrito el nombre del producto', '2023-10-17 20:24:02'),
(10, 1, 'Se ha aumentado el stock', '2023-10-19 02:42:56'),
(11, 18, 'Ha pasado de inactivo a activo', '2023-11-02 01:30:59'),
(12, 11, 'Se ha modificado el precio', '2023-11-02 01:55:11'),
(13, 1, 'Prueba', '2023-11-02 02:06:48'),
(14, 1, 'Estaba mal escrito el nombre del producto', '2023-11-02 02:07:09'),
(15, 11, 'Se ha modificado el precio', '2023-11-02 02:07:52'),
(16, 1, 'Se ha modificado el precio', '2023-11-02 02:08:18'),
(17, 4, 'No hay stock de este producto', '2023-11-02 02:25:47'),
(18, 2, 'No hay stock de este producto', '2023-11-02 02:26:41'),
(19, 2, 'No hay stock de este producto', '2023-11-02 02:27:40');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_marca` (`id_marca`);

--
-- Indices de la tabla `ticketmotivo`
--
ALTER TABLE `ticketmotivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `ticketmotivo`
--
ALTER TABLE `ticketmotivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_marca` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`);

--
-- Filtros para la tabla `ticketmotivo`
--
ALTER TABLE `ticketmotivo`
  ADD CONSTRAINT `ticketmotivo_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
