-- SCRIPT DB


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `coagus_movil`
--
CREATE DATABASE IF NOT EXISTS `coagus_movil` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `coagus_movil`;

-- 
-- Usuario Dev para desarrollo
--

CREATE USER 'dev'@'localhost' identified by 'dev';
GRANT ALL PRIVILEGES ON coagus_movil.* TO 'dev'@'localhost';
FLUSH PRIVILEGES;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE `Rol` (
  `Id` int(11) NOT NULL,
  `Rol` varchar(75) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`Id`, `Rol`) VALUES
(1, 'Administrador'),
(2, 'Usuario N1'),
(3, 'Usuario N2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`Id`, `Nombre`, `Usuario`, `Password`, `Rol`) VALUES
(9, 'Super Admin', 'coagus', 'dev123', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Rol`
--
ALTER TABLE `Rol`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `uniq_usuario` (`Usuario`),
  ADD KEY `fk_Usuario_Rol` (`Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Rol`
--
ALTER TABLE `Rol`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `fk_Usuario_Rol` FOREIGN KEY (`Rol`) REFERENCES `Rol` (`Id`);
COMMIT;
