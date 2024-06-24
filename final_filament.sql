-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2024 a las 04:22:26
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
-- Base de datos: `final_filament`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `document_verify` tinyint(1) NOT NULL,
  `role` varchar(255) NOT NULL,
  `ratings` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `id_admin`, `name`, `last_name`, `email`, `telephone`, `adress`, `document`, `document_verify`, `role`, `ratings`, `created_at`, `updated_at`, `password`) VALUES
(1, 1, 'Camilo', 'Valencia', 'camilo@gmail.com', '3115414', 'calle 20', '100245', 1, '', 0.00, '2024-06-16 09:45:04', '2024-06-16 09:45:04', '$2y$10$X0XrsIKP8.nM8LVPrueBbOofuCdDM2VNobEUQ9CLuc8BgkyDyyyj2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `document_verify` tinyint(1) NOT NULL,
  `photo_licence` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ratings` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `drivers`
--

INSERT INTO `drivers` (`id`, `id_admin`, `name`, `last_name`, `email`, `telephone`, `adress`, `password`, `document`, `document_verify`, `photo_licence`, `role`, `image`, `ratings`, `created_at`, `updated_at`) VALUES
(1, 1, 'Alejandro', ' Martinez', 'alejo@gmail.com', '123', 'Calle 21', '$2y$10$zfoTgJ4PUwIu6ZuK5Eadn.LzvFwopWKdxhVF2HVevMrqQ7ENRCHFK', '12121', 1, 'NO', '', '', 0.00, '2024-06-16 09:45:55', '2024-06-16 09:45:55'),
(2, 1, 'Alejandro', 'Valencia', 'alejo@gmail.com', '3115414', 'calle 20', '$2y$10$rGD1N56tIQrCzN.wdlFfTekWTpz/hcCaAnCZGgBWBYv7vEes1ws2q', '123', 0, 'drivers/01J140MHWW4T8Z02QBHKA4CRQE.avif', '2', NULL, 0.00, '2024-06-24 07:19:11', '2024-06-24 07:19:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2024_06_24_014619_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_customer` bigint(20) UNSIGNED NOT NULL,
  `carge_type` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `point_initial` varchar(255) NOT NULL,
  `point_finally` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` float NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `packages`
--

INSERT INTO `packages` (`id`, `id_customer`, `carge_type`, `size`, `weight`, `point_initial`, `point_finally`, `description`, `price`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 'Platano', NULL, '15kg', 'La pradera ', 'Corocito', 'Llevar cargamento de platano para supermercado', 120000, 'Entregar al gerente del supermercado PARIS', '2024-06-16 09:53:38', '2024-06-16 09:53:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_customer', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(2, 'view_any_customer', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(3, 'create_customer', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(4, 'update_customer', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(5, 'restore_customer', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(6, 'restore_any_customer', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(7, 'replicate_customer', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(8, 'reorder_customer', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(9, 'delete_customer', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(10, 'delete_any_customer', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(11, 'force_delete_customer', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(12, 'force_delete_any_customer', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(13, 'view_driver', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(14, 'view_any_driver', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(15, 'create_driver', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(16, 'update_driver', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(17, 'restore_driver', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(18, 'restore_any_driver', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(19, 'replicate_driver', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(20, 'reorder_driver', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(21, 'delete_driver', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(22, 'delete_any_driver', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(23, 'force_delete_driver', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(24, 'force_delete_any_driver', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(25, 'view_package', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(26, 'view_any_package', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(27, 'create_package', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(28, 'update_package', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(29, 'restore_package', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(30, 'restore_any_package', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(31, 'replicate_package', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(32, 'reorder_package', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(33, 'delete_package', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(34, 'delete_any_package', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(35, 'force_delete_package', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(36, 'force_delete_any_package', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(37, 'view_rating', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(38, 'view_any_rating', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(39, 'create_rating', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(40, 'update_rating', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(41, 'restore_rating', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(42, 'restore_any_rating', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(43, 'replicate_rating', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(44, 'reorder_rating', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(45, 'delete_rating', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(46, 'delete_any_rating', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(47, 'force_delete_rating', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(48, 'force_delete_any_rating', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(49, 'view_role', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(50, 'view_any_role', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(51, 'create_role', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(52, 'update_role', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(53, 'delete_role', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(54, 'delete_any_role', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(55, 'view_route', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(56, 'view_any_route', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(57, 'create_route', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(58, 'update_route', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(59, 'restore_route', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(60, 'restore_any_route', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(61, 'replicate_route', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(62, 'reorder_route', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(63, 'delete_route', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(64, 'delete_any_route', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(65, 'force_delete_route', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(66, 'force_delete_any_route', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(67, 'view_user', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(68, 'view_any_user', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(69, 'create_user', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(70, 'update_user', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(71, 'restore_user', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(72, 'restore_any_user', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(73, 'replicate_user', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(74, 'reorder_user', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(75, 'delete_user', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(76, 'delete_any_user', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(77, 'force_delete_user', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(78, 'force_delete_any_user', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(79, 'view_vehicle', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(80, 'view_any_vehicle', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(81, 'create_vehicle', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(82, 'update_vehicle', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(83, 'restore_vehicle', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(84, 'restore_any_vehicle', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(85, 'replicate_vehicle', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(86, 'reorder_vehicle', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(87, 'delete_vehicle', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(88, 'delete_any_vehicle', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(89, 'force_delete_vehicle', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35'),
(90, 'force_delete_any_vehicle', 'web', '2024-06-24 07:00:35', '2024-06-24 07:00:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_driver` bigint(20) UNSIGNED NOT NULL,
  `id_customer` bigint(20) UNSIGNED NOT NULL,
  `id_route` bigint(20) UNSIGNED NOT NULL,
  `ratings` double(8,2) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ratings`
--

INSERT INTO `ratings` (`id`, `id_driver`, `id_customer`, `id_route`, `ratings`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 3.00, 'Se entrego el paquete bien', '2024-06-16 09:59:05', '2024-06-16 09:59:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2024-06-24 07:00:34', '2024-06-24 07:00:34'),
(2, 'Driver', 'web', '2024-06-24 07:08:54', '2024-06-24 07:08:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(22, 1),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(55, 2),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(61, 1),
(61, 2),
(62, 1),
(62, 2),
(63, 1),
(63, 2),
(64, 1),
(64, 2),
(65, 1),
(65, 2),
(66, 1),
(66, 2),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(79, 2),
(80, 1),
(80, 2),
(81, 1),
(81, 2),
(82, 1),
(82, 2),
(83, 1),
(83, 2),
(84, 1),
(84, 2),
(85, 1),
(85, 2),
(86, 1),
(86, 2),
(87, 1),
(87, 2),
(88, 1),
(88, 2),
(89, 1),
(89, 2),
(90, 1),
(90, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_driver` bigint(20) UNSIGNED NOT NULL,
  `id_package` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `routes`
--

INSERT INTO `routes` (`id`, `id_driver`, `id_package`, `location`, `comment`, `state`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Cuba-Paris supermercado', 'Entregar al gerente del supermercado PARIS', 'BUSCANDO', '2024-06-16 09:57:37', '2024-06-16 09:57:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$lILMiAtn9cisGewCAZ18QeTaKBBoQlBZqRIngNNkffwQ40mhb6V5y', NULL, '2024-06-24 06:55:21', '2024-06-24 06:55:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_driver` bigint(20) UNSIGNED NOT NULL,
  `vehicle_photo` varchar(255) DEFAULT NULL,
  `capacity` varchar(255) NOT NULL,
  `dimension` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `photo_soat` tinyint(1) DEFAULT NULL,
  `photo_tecnomecanic` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehicles`
--

INSERT INTO `vehicles` (`id`, `id_driver`, `vehicle_photo`, `capacity`, `dimension`, `type`, `photo_soat`, `photo_tecnomecanic`, `created_at`, `updated_at`) VALUES
(1, 1, 'NO', '20 KG', '20-20-25', 'CAMIONETA', 1, 1, '2024-06-16 09:52:25', '2024-06-16 09:52:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_document_unique` (`document`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packages_id_customer_foreign` (`id_customer`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_id_driver_foreign` (`id_driver`),
  ADD KEY `ratings_id_customer_foreign` (`id_customer`),
  ADD KEY `ratings_id_route_foreign` (`id_route`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `routes_id_driver_foreign` (`id_driver`),
  ADD KEY `routes_id_package_foreign` (`id_package`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_id_driver_foreign` (`id_driver`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_id_driver_foreign` FOREIGN KEY (`id_driver`) REFERENCES `drivers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_id_route_foreign` FOREIGN KEY (`id_route`) REFERENCES `routes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `routes_id_driver_foreign` FOREIGN KEY (`id_driver`) REFERENCES `drivers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `routes_id_package_foreign` FOREIGN KEY (`id_package`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_id_driver_foreign` FOREIGN KEY (`id_driver`) REFERENCES `drivers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
