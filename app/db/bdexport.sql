-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2024 a las 22:48:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comanda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id` int(5) NOT NULL,
  `estado` int(60) NOT NULL,
  `codigo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa_estado`
--

CREATE TABLE `mesa_estado` (
  `id` int(1) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesa_estado`
--

INSERT INTO `mesa_estado` (`id`, `nombre`) VALUES
(1, 'con cliente esperando'),
(2, 'con cliente comiendo'),
(3, 'con cliente pagando'),
(4, 'cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `codigo` int(11) NOT NULL,
  `id_mozo` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `tiempo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(5) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `tipo` varchar(60) NOT NULL,
  `precio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `tipo`, `precio`) VALUES
(1, 'vino blanco', 'bebida', 860),
(2, 'vino tinto', 'bebida', 30),
(3, 'vino tinto', 'bebida', 748),
(4, 'milenesa', 'comida', 742),
(5, 'milenesa', 'comida', 296),
(6, 'gaseosa', 'bebida', 69),
(7, 'cerveza negra', 'bebida', 167),
(8, 'cerveza roja', 'bebida', 256),
(9, 'cerveza roja', 'bebida', 126),
(10, 'vino blanco', 'bebida', 779),
(11, 'milenesa', 'comida', 151),
(12, 'cerveza rubia', 'bebida', 256),
(13, 'fideos', 'comida', 947),
(14, 'gaseosa', 'bebida', 964),
(15, 'cerveza roja', 'bebida', 862),
(16, 'milenesa', 'comida', 233),
(17, 'milenesa', 'comida', 547),
(18, 'vino blanco', 'bebida', 950),
(19, 'milenesa', 'comida', 470),
(20, 'vino blanco', 'bebida', 489),
(21, 'vino tinto', 'bebida', 290),
(22, 'cerveza rubia', 'bebida', 22),
(23, 'cerveza negra', 'bebida', 813),
(24, 'gaseosa', 'bebida', 454),
(25, 'fideos', 'comida', 398),
(26, 'fideos', 'comida', 266),
(27, 'milenesa', 'comida', 383),
(28, 'vino blanco', 'bebida', 137),
(29, 'vino blanco', 'bebida', 999),
(30, 'cerveza negra', 'bebida', 29),
(31, 'milenesa', 'comida', 136),
(32, 'cerveza negra', 'bebida', 358),
(33, 'vino tinto', 'bebida', 855),
(34, 'vino tinto', 'bebida', 329),
(35, 'cerveza roja', 'bebida', 901),
(36, 'milenesa', 'comida', 936),
(37, 'fideos', 'comida', 26),
(38, 'gaseosa', 'bebida', 601),
(39, 'cerveza rubia', 'bebida', 163),
(40, 'fideos', 'comida', 740),
(41, 'fideos', 'comida', 336),
(42, 'cerveza negra', 'bebida', 908),
(43, 'milenesa', 'comida', 572),
(44, 'cerveza rubia', 'bebida', 966),
(45, 'fideos', 'comida', 372),
(46, 'fideos', 'comida', 447),
(47, 'cerveza negra', 'bebida', 759),
(48, 'fideos', 'comida', 314),
(49, 'fideos', 'comida', 365),
(50, 'vino tinto', 'bebida', 658),
(51, 'cerveza rubia', 'bebida', 356),
(52, 'fideos', 'comida', 921),
(53, 'cerveza negra', 'bebida', 529),
(54, 'vino tinto', 'bebida', 521),
(55, 'gaseosa', 'bebida', 588),
(56, 'vino blanco', 'bebida', 369),
(57, 'vino blanco', 'bebida', 729),
(58, 'gaseosa', 'bebida', 648),
(59, 'vino tinto', 'bebida', 261),
(60, 'cerveza negra', 'bebida', 367),
(61, 'gaseosa', 'bebida', 726),
(62, 'cerveza rubia', 'bebida', 236),
(63, 'cerveza rubia', 'bebida', 600),
(64, 'gaseosa', 'bebida', 293),
(65, 'cerveza roja', 'bebida', 438),
(66, 'cerveza negra', 'bebida', 378),
(67, 'gaseosa', 'bebida', 415),
(68, 'vino blanco', 'bebida', 869),
(69, 'cerveza roja', 'bebida', 58),
(70, 'vino tinto', 'bebida', 77),
(71, 'cerveza negra', 'bebida', 453),
(72, 'milenesa', 'comida', 870),
(73, 'cerveza negra', 'bebida', 962),
(74, 'vino blanco', 'bebida', 939),
(75, 'cerveza rubia', 'bebida', 252),
(76, 'cerveza roja', 'bebida', 164),
(77, 'milenesa', 'comida', 807),
(78, 'vino tinto', 'bebida', 592),
(79, 'milenesa', 'comida', 397),
(80, 'cerveza rubia', 'bebida', 376),
(81, 'vino tinto', 'bebida', 616),
(82, 'gaseosa', 'bebida', 476),
(83, 'cerveza rubia', 'bebida', 452),
(84, 'cerveza negra', 'bebida', 939),
(85, 'fideos', 'comida', 317),
(86, 'gaseosa', 'bebida', 731),
(87, 'vino tinto', 'bebida', 635),
(88, 'fideos', 'comida', 472),
(89, 'vino blanco', 'bebida', 969),
(90, 'vino tinto', 'bebida', 399),
(91, 'cerveza roja', 'bebida', 903),
(92, 'cerveza negra', 'bebida', 559),
(93, 'vino tinto', 'bebida', 423),
(94, 'cerveza negra', 'bebida', 821),
(95, 'cerveza negra', 'bebida', 10),
(96, 'milenesa', 'comida', 111),
(97, 'vino blanco', 'bebida', 633),
(98, 'vino blanco', 'bebida', 805),
(99, 'gaseosa', 'bebida', 332),
(100, 'cerveza rubia', 'bebida', 634),
(101, 'fideos con queso', 'comida', 1500),
(102, 'fideos con queso', 'comida', 1500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comida`
--

CREATE TABLE `tipo_comida` (
  `id` int(1) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `nombre`) VALUES
(1, 'Bartender'),
(2, 'Cocinero'),
(3, 'Cervecero'),
(4, 'Socio'),
(5, 'Cliente'),
(6, 'Mozo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(5) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `tipo` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estado` (`estado`);

--
-- Indices de la tabla `mesa_estado`
--
ALTER TABLE `mesa_estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_id_mozo` (`id_mozo`),
  ADD KEY `fk_id_prod` (`id_prod`),
  ADD KEY `fk_id_mesa` (`id_mesa`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_comida`
--
ALTER TABLE `tipo_comida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo` (`tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mesa_estado`
--
ALTER TABLE `mesa_estado`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`estado`) REFERENCES `mesa_estado` (`id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_id_mesa` FOREIGN KEY (`id_mesa`) REFERENCES `mesa` (`id`),
  ADD CONSTRAINT `fk_id_mozo` FOREIGN KEY (`id_mozo`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `fk_id_prod` FOREIGN KEY (`id_prod`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
