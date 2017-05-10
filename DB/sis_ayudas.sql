-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.14 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para sis_ayudas
CREATE DATABASE IF NOT EXISTS `sis_ayudas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */;
USE `sis_ayudas`;

-- Volcando estructura para tabla sis_ayudas.centros
CREATE TABLE IF NOT EXISTS `centros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_municipio` int(10) unsigned DEFAULT NULL,
  `id_parroquia` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `centros_nombre_unique` (`nombre`),
  KEY `centros_id_municipio_foreign` (`id_municipio`),
  KEY `centros_id_parroquia_foreign` (`id_parroquia`),
  CONSTRAINT `centros_id_municipio_foreign` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `centros_id_parroquia_foreign` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.claves_desbloqueo
CREATE TABLE IF NOT EXISTS `claves_desbloqueo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.discapacidades
CREATE TABLE IF NOT EXISTS `discapacidades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `discapacidad` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.eventos
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  `fecha` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT 'S/F',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.firmantes
CREATE TABLE IF NOT EXISTS `firmantes` (
  `cedula` varchar(8) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.municipios
CREATE TABLE IF NOT EXISTS `municipios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `municipios_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.parroquias
CREATE TABLE IF NOT EXISTS `parroquias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_municipio` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `parroquias_id_municipio_foreign` (`id_municipio`),
  CONSTRAINT `parroquias_id_municipio_foreign` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.solicitanteinst
CREATE TABLE IF NOT EXISTS `solicitanteinst` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_reg` enum('J','G') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'J',
  `codigo_rif` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `responsable` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `re_nac` enum('V','E') COLLATE utf8_unicode_ci NOT NULL,
  `re_cedula` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'S/D',
  `id_municipio` int(10) unsigned DEFAULT NULL,
  `id_parroquia` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `solicitanteinst_codigo_rif_unique` (`codigo_rif`),
  KEY `solicitanteinst_id_municipio_foreign` (`id_municipio`),
  KEY `solicitanteinst_id_parroquia_foreign` (`id_parroquia`),
  CONSTRAINT `solicitanteinst_id_municipio_foreign` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `solicitanteinst_id_parroquia_foreign` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.solicitanteinst_solicitud
CREATE TABLE IF NOT EXISTS `solicitanteinst_solicitud` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `solicitanteinst_id` int(10) unsigned NOT NULL,
  `solicitud_id` int(10) unsigned DEFAULT NULL,
  `detalle` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'DESCONOCIDA',
  `id_evento` int(10) unsigned NOT NULL,
  `estatus` enum('APROBADA','PENDIENTE','NEGADA','ENTREGADA') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `fecha_pro` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'NO PROCESADA',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `solicitanteinst_solicitud_solicitanteinst_id_foreign` (`solicitanteinst_id`),
  KEY `solicitanteinst_solicitud_solicitud_id_foreign` (`solicitud_id`),
  KEY `FK_solicitanteinst_solicitud_eventos` (`id_evento`),
  CONSTRAINT `FK_solicitanteinst_solicitud_eventos` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`),
  CONSTRAINT `solicitanteinst_solicitud_solicitanteinst_id_foreign` FOREIGN KEY (`solicitanteinst_id`) REFERENCES `solicitanteinst` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `solicitanteinst_solicitud_solicitud_id_foreign` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.solicitantenocne_solicitud
CREATE TABLE IF NOT EXISTS `solicitantenocne_solicitud` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `solicitantenocne_id` int(10) unsigned DEFAULT NULL,
  `solicitud_id` int(10) unsigned DEFAULT NULL,
  `detalle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_evento` int(10) unsigned NOT NULL,
  `estatus` enum('APROBADA','PENDIENTE','NEGADA','ENTREGADA') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `fecha_pro` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO PROCESADA',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `solicitantenocne_solicitud_id_solicitante_foreign` (`solicitantenocne_id`),
  KEY `solicitantenocne_solicitud_id_solicitud_foreign` (`solicitud_id`),
  KEY `FK_solicitantenocne_solicitud_eventos` (`id_evento`),
  CONSTRAINT `FK_solicitantenocne_solicitud_eventos` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`),
  CONSTRAINT `solicitantenocne_solicitud_id_solicitante_foreign` FOREIGN KEY (`solicitantenocne_id`) REFERENCES `solicitantes_no_cne` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `solicitantenocne_solicitud_id_solicitud_foreign` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.solicitantes
CREATE TABLE IF NOT EXISTS `solicitantes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nacionalidad` enum('v','e') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'v',
  `cedula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `genero` enum('M','F') COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_municipio` int(10) unsigned DEFAULT NULL,
  `id_parroquia` int(10) unsigned DEFAULT NULL,
  `id_centro` int(10) unsigned DEFAULT '0',
  `id_discapacidad` int(10) unsigned DEFAULT NULL,
  `discap_detalle` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'DESCONOCIDO',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `solicitantes_cedula_unique` (`cedula`),
  KEY `solicitantes_id_municipio_foreign` (`id_municipio`),
  KEY `solicitantes_id_parroquia_foreign` (`id_parroquia`),
  KEY `solicitantes_id_centro_foreign` (`id_centro`),
  KEY `FK_solicitantes_discapacidades` (`id_discapacidad`),
  CONSTRAINT `FK_solicitantes_discapacidades` FOREIGN KEY (`id_discapacidad`) REFERENCES `discapacidades` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `solicitantes_id_centro_foreign` FOREIGN KEY (`id_centro`) REFERENCES `centros` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `solicitantes_id_municipio_foreign` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `solicitantes_id_parroquia_foreign` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.solicitantes_no_cne
CREATE TABLE IF NOT EXISTS `solicitantes_no_cne` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nacionalidad` enum('v','e') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'v',
  `cedula` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `nombres` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `genero` enum('M','F') COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_municipio` int(10) unsigned DEFAULT NULL,
  `id_parroquia` int(10) unsigned DEFAULT NULL,
  `id_discapacidad` int(10) unsigned DEFAULT NULL,
  `discap_detalle` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `solicitantes_no_cne_cedula_unique` (`cedula`),
  KEY `solicitantes_no_cne_id_municipio_foreign` (`id_municipio`),
  KEY `solicitantes_no_cne_id_parroquia_foreign` (`id_parroquia`),
  KEY `FK_solicitantes_no_cne_discapacidades` (`id_discapacidad`),
  CONSTRAINT `FK_solicitantes_no_cne_discapacidades` FOREIGN KEY (`id_discapacidad`) REFERENCES `discapacidades` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `solicitantes_no_cne_id_municipio_foreign` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `solicitantes_no_cne_id_parroquia_foreign` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.solicitante_solicitud
CREATE TABLE IF NOT EXISTS `solicitante_solicitud` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `solicitante_id` int(10) unsigned NOT NULL,
  `solicitud_id` int(10) unsigned DEFAULT NULL,
  `detalle` text COLLATE utf8_unicode_ci,
  `fecha` varchar(11) COLLATE utf8_unicode_ci DEFAULT 'DESCONOCIDA',
  `id_evento` int(10) unsigned NOT NULL,
  `estatus` enum('APROBADA','PENDIENTE','NEGADA','ENTREGADA') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `fecha_pro` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO PROCESADA',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `solicitante_solicitud_id_solicitante_foreign` (`solicitante_id`),
  KEY `solicitante_solicitud_id_solicitud_foreign` (`solicitud_id`),
  KEY `FK_solicitante_solicitud_eventos` (`id_evento`),
  CONSTRAINT `FK_solicitante_solicitud_eventos` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`),
  CONSTRAINT `solicitante_solicitud_id_solicitante_foreign` FOREIGN KEY (`solicitante_id`) REFERENCES `solicitantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `solicitante_solicitud_id_solicitud_foreign` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.solicitudes
CREATE TABLE IF NOT EXISTS `solicitudes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intervalo` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sis_ayudas.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('admin','instituto') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'instituto',
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'sin_foto.png',
  `estatus` enum('activo','inactivo') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'inactivo',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_cedula_unique` (`cedula`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
