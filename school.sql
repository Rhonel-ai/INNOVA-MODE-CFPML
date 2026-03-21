-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 17 déc. 2025 à 12:27
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `school`
--

-- --------------------------------------------------------

--
-- Structure de la table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '[]', NULL, '2025-08-28 10:57:33', '2025-08-28 10:57:33'),
(5, 'user', 'User has been deleted', 'App\\Models\\User', 'deleted', 7, 'App\\Models\\User', 1, '{\"old\":{\"id\":7,\"name\":\"akiyemi odebi\",\"username\":\"\",\"email\":\"cvc@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$e1.HNICLE.U9KjPN1VumBunMUtd52wXHztqp30q.XdZYnnPWqEuKy\",\"remember_token\":null,\"created_at\":\"2025-08-10T21:49:42.000000Z\",\"updated_at\":\"2025-08-10T21:49:42.000000Z\",\"upload\":null,\"status\":\"Inactive\",\"phone\":null,\"pays\":null,\"ville\":null,\"region\":null,\"adresse\":null}}', NULL, '2025-08-28 13:12:48', '2025-08-28 13:12:48'),
(6, 'Admin', 'User has been updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"ODEBI\",\"username\":\"Maxime\",\"email\":\"admin@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$DHkMiQNZlxqn\\/DwQiUZLLu2cH4yipHXRxpVfJbHQUIyCfXyv5FJH2\",\"remember_token\":null,\"created_at\":\"2025-07-29T13:55:30.000000Z\",\"updated_at\":\"2025-08-28T14:18:49.000000Z\",\"upload\":\"1830293888.png\",\"status\":\"Inactive\",\"phone\":\"+229 51 92 96 00\",\"pays\":\"us\",\"ville\":\"Cotonou\",\"region\":\"Agla\",\"adresse\":\"ip259\"},\"old\":{\"id\":1,\"name\":\"ODEBI\",\"username\":\"Maxime\",\"email\":\"admin@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$DHkMiQNZlxqn\\/DwQiUZLLu2cH4yipHXRxpVfJbHQUIyCfXyv5FJH2\",\"remember_token\":null,\"created_at\":\"2025-07-29T13:55:30.000000Z\",\"updated_at\":\"2025-08-28T12:02:12.000000Z\",\"upload\":\"1830293888.png\",\"status\":\"Active\",\"phone\":\"+229 51 92 96 00\",\"pays\":\"us\",\"ville\":\"Cotonou\",\"region\":\"Agla\",\"adresse\":\"ip259\"}}', NULL, '2025-08-28 13:18:49', '2025-08-28 13:18:49'),
(7, 'Admin', 'User has been updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"ODEBI\",\"username\":\"Maxime\",\"email\":\"admin@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$DHkMiQNZlxqn\\/DwQiUZLLu2cH4yipHXRxpVfJbHQUIyCfXyv5FJH2\",\"remember_token\":null,\"created_at\":\"2025-07-29T13:55:30.000000Z\",\"updated_at\":\"2025-08-28T14:20:47.000000Z\",\"upload\":\"1830293888.png\",\"status\":\"Active\",\"phone\":\"+229 51 92 96 00\",\"pays\":\"us\",\"ville\":\"Cotonou\",\"region\":\"Agla\",\"adresse\":\"ip259\"},\"old\":{\"id\":1,\"name\":\"ODEBI\",\"username\":\"Maxime\",\"email\":\"admin@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$DHkMiQNZlxqn\\/DwQiUZLLu2cH4yipHXRxpVfJbHQUIyCfXyv5FJH2\",\"remember_token\":null,\"created_at\":\"2025-07-29T13:55:30.000000Z\",\"updated_at\":\"2025-08-28T14:18:49.000000Z\",\"upload\":\"1830293888.png\",\"status\":\"Inactive\",\"phone\":\"+229 51 92 96 00\",\"pays\":\"us\",\"ville\":\"Cotonou\",\"region\":\"Agla\",\"adresse\":\"ip259\"}}', NULL, '2025-08-28 13:20:47', '2025-08-28 13:20:47'),
(8, 'user', 'User has been deleted', 'App\\Models\\User', 'deleted', 5, 'App\\Models\\User', 1, '{\"old\":{\"id\":5,\"name\":\"azerty\",\"username\":\"\",\"email\":\"azerty@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$4nxcHi.90CQ4KpU4JS1O5ODUK6Sj8OW97Pwy8934lK.ZELxke\\/bSS\",\"remember_token\":\"GdsbmgteGMOjvF2uwas9YXdUc7Oq3f2SLwiB2NM3QqnnTN0viSVz4WYmNISj\",\"created_at\":\"2028-01-01T00:03:15.000000Z\",\"updated_at\":\"2026-08-12T22:49:41.000000Z\",\"upload\":null,\"status\":\"Active\",\"phone\":null,\"pays\":null,\"ville\":null,\"region\":null,\"adresse\":null}}', NULL, '2025-08-28 13:21:13', '2025-08-28 13:21:13'),
(9, 'user', 'User has been created', 'App\\Models\\User', 'created', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":8,\"name\":\"Franck\",\"username\":null,\"email\":\"azerty@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$rPaL\\/.IIr6vlhda4dV8H4uOwOG4qNYEsA571Byj1JNhvAJcLzwqF.\",\"remember_token\":null,\"created_at\":\"2025-08-28T14:40:12.000000Z\",\"updated_at\":\"2025-08-28T14:40:12.000000Z\",\"upload\":null,\"status\":\"Inactive\",\"phone\":null,\"pays\":null,\"ville\":null,\"region\":null,\"adresse\":null}}', NULL, '2025-08-28 13:40:12', '2025-08-28 13:40:12'),
(10, 'default', 'Création de Franck', NULL, NULL, NULL, 'App\\Models\\User', 1, '[]', NULL, '2025-08-28 13:40:12', '2025-08-28 13:40:12'),
(11, 'user', 'User has been created', 'App\\Models\\User', 'created', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":9,\"name\":\"J\",\"username\":null,\"email\":\"j@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$9rOPFnGdb43..qOBog6RS.QSLhoxV8IuSdDi76jAEZyCYcn24robu\",\"remember_token\":null,\"created_at\":\"2025-08-28T15:08:17.000000Z\",\"updated_at\":\"2025-08-28T15:08:17.000000Z\",\"upload\":null,\"status\":\"Inactive\",\"phone\":null,\"pays\":null,\"ville\":null,\"region\":null,\"adresse\":null}}', NULL, '2025-08-28 14:08:17', '2025-08-28 14:08:17'),
(12, 'User', 'UserUser has been created', 'App\\Models\\User', 'created', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":10,\"name\":\"D\",\"username\":null,\"email\":\"D@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$LVQrxSjds5TBaeF.JnhAY.jB0seTpvA9i9GMuFmwhqMSb3f5cEfAe\",\"remember_token\":null,\"created_at\":\"2025-08-28T16:12:51.000000Z\",\"updated_at\":\"2025-08-28T16:12:51.000000Z\",\"upload\":null,\"status\":\"Inactive\",\"phone\":null,\"pays\":null,\"ville\":null,\"region\":null,\"adresse\":null}}', NULL, '2025-08-28 15:12:51', '2025-08-28 15:12:51'),
(13, 'User', 'UserUser has been updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"ODEBI\",\"username\":\"Maxime\",\"email\":\"admin@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$DHkMiQNZlxqn\\/DwQiUZLLu2cH4yipHXRxpVfJbHQUIyCfXyv5FJH2\",\"remember_token\":null,\"created_at\":\"2025-07-29T13:55:30.000000Z\",\"updated_at\":\"2025-08-29T22:17:34.000000Z\",\"upload\":\"1830293888.png\",\"status\":\"Active\",\"phone\":\"+229 51 92 96 0\",\"pays\":\"us\",\"ville\":\"Cotonou\",\"region\":\"Agla\",\"adresse\":\"ip259\"},\"old\":{\"id\":1,\"name\":\"ODEBI\",\"username\":\"Maxime\",\"email\":\"admin@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$DHkMiQNZlxqn\\/DwQiUZLLu2cH4yipHXRxpVfJbHQUIyCfXyv5FJH2\",\"remember_token\":null,\"created_at\":\"2025-07-29T13:55:30.000000Z\",\"updated_at\":\"2025-08-28T14:20:47.000000Z\",\"upload\":\"1830293888.png\",\"status\":\"Active\",\"phone\":\"+229 51 92 96 00\",\"pays\":\"us\",\"ville\":\"Cotonou\",\"region\":\"Agla\",\"adresse\":\"ip259\"}}', NULL, '2025-08-29 21:17:34', '2025-08-29 21:17:34'),
(14, 'Menu', 'MenuUser has been created', 'App\\Models\\Menu', 'created', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":8,\"name\":\"Services\",\"slug\":\"services\",\"created_at\":\"2025-08-29T22:19:59.000000Z\",\"updated_at\":\"2025-08-29T22:19:59.000000Z\",\"type\":\"secondaire\",\"position\":2}}', NULL, '2025-08-29 21:19:59', '2025-08-29 21:19:59'),
(15, 'User', 'UserUser has been updated', 'App\\Models\\User', 'updated', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":10,\"name\":\"Daruis\",\"username\":null,\"email\":\"D@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$LVQrxSjds5TBaeF.JnhAY.jB0seTpvA9i9GMuFmwhqMSb3f5cEfAe\",\"remember_token\":null,\"created_at\":\"2025-08-28T16:12:51.000000Z\",\"updated_at\":\"2025-08-30T00:52:38.000000Z\",\"upload\":null,\"status\":\"Inactive\",\"phone\":null,\"pays\":null,\"ville\":null,\"region\":null,\"adresse\":null},\"old\":{\"id\":10,\"name\":\"D\",\"username\":null,\"email\":\"D@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$LVQrxSjds5TBaeF.JnhAY.jB0seTpvA9i9GMuFmwhqMSb3f5cEfAe\",\"remember_token\":null,\"created_at\":\"2025-08-28T16:12:51.000000Z\",\"updated_at\":\"2025-08-28T16:12:51.000000Z\",\"upload\":null,\"status\":\"Inactive\",\"phone\":null,\"pays\":null,\"ville\":null,\"region\":null,\"adresse\":null}}', NULL, '2025-08-29 23:52:38', '2025-08-29 23:52:38'),
(16, 'User', 'UserUser has been updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"ODEBI\",\"username\":\"Maxime\",\"email\":\"admin@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$DHkMiQNZlxqn\\/DwQiUZLLu2cH4yipHXRxpVfJbHQUIyCfXyv5FJH2\",\"remember_token\":null,\"created_at\":\"2025-07-29T13:55:30.000000Z\",\"updated_at\":\"2025-09-01T13:17:39.000000Z\",\"upload\":\"1830293888.png\",\"status\":\"Inactive\",\"phone\":\"+229 51 92 96 0\",\"pays\":\"us\",\"ville\":\"Cotonou\",\"region\":\"Agla\",\"adresse\":\"ip259\"},\"old\":{\"id\":1,\"name\":\"ODEBI\",\"username\":\"Maxime\",\"email\":\"admin@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$DHkMiQNZlxqn\\/DwQiUZLLu2cH4yipHXRxpVfJbHQUIyCfXyv5FJH2\",\"remember_token\":null,\"created_at\":\"2025-07-29T13:55:30.000000Z\",\"updated_at\":\"2025-08-29T22:17:34.000000Z\",\"upload\":\"1830293888.png\",\"status\":\"Active\",\"phone\":\"+229 51 92 96 0\",\"pays\":\"us\",\"ville\":\"Cotonou\",\"region\":\"Agla\",\"adresse\":\"ip259\"}}', NULL, '2025-09-01 12:17:39', '2025-09-01 12:17:39'),
(17, 'User', 'UserUser has been updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"ODEBI\",\"username\":\"Maxime\",\"email\":\"admin@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$DHkMiQNZlxqn\\/DwQiUZLLu2cH4yipHXRxpVfJbHQUIyCfXyv5FJH2\",\"remember_token\":null,\"created_at\":\"2025-07-29T13:55:30.000000Z\",\"updated_at\":\"2025-09-01T13:17:59.000000Z\",\"upload\":\"1830293888.png\",\"status\":\"Active\",\"phone\":\"+229 51 92 96 0\",\"pays\":\"us\",\"ville\":\"Cotonou\",\"region\":\"Agla\",\"adresse\":\"ip259\"},\"old\":{\"id\":1,\"name\":\"ODEBI\",\"username\":\"Maxime\",\"email\":\"admin@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$DHkMiQNZlxqn\\/DwQiUZLLu2cH4yipHXRxpVfJbHQUIyCfXyv5FJH2\",\"remember_token\":null,\"created_at\":\"2025-07-29T13:55:30.000000Z\",\"updated_at\":\"2025-09-01T13:17:39.000000Z\",\"upload\":\"1830293888.png\",\"status\":\"Inactive\",\"phone\":\"+229 51 92 96 0\",\"pays\":\"us\",\"ville\":\"Cotonou\",\"region\":\"Agla\",\"adresse\":\"ip259\"}}', NULL, '2025-09-01 12:17:59', '2025-09-01 12:17:59'),
(18, 'Contrat', 'ContratUser has been created', 'App\\Models\\Contrat', 'created', 1, NULL, NULL, '{\"attributes\":{\"id\":1,\"name\":\"Shay Odonnell\",\"pays\":\"+1 (954) 637-6012\",\"phone\":\"+1 (199) 377-7201\",\"date\":\"1983-09-15\",\"email\":\"qawidicem@mailinator.com\",\"obejetDemande\":\"Nobis temporibus est\",\"created_at\":\"2025-11-12T12:06:24.000000Z\",\"updated_at\":\"2025-11-12T12:06:24.000000Z\"}}', NULL, '2025-11-12 12:06:25', '2025-11-12 12:06:25'),
(19, 'Contrat', 'ContratUser has been created', 'App\\Models\\Contrat', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":2,\"name\":\"Amelia Trevino\",\"pays\":\"+1 (972) 436-4368\",\"phone\":\"+1 (144) 323-1982\",\"date\":\"1993-12-15\",\"email\":\"cyla@mailinator.com\",\"obejetDemande\":\"Et quia exercitation  gueri moi\",\"created_at\":\"2025-11-12T12:16:57.000000Z\",\"updated_at\":\"2025-11-12T12:16:57.000000Z\"}}', NULL, '2025-11-12 12:16:58', '2025-11-12 12:16:58'),
(20, 'Contact', 'ContactUser has been created', 'App\\Models\\Contact', 'created', 1, NULL, NULL, '{\"attributes\":{\"id\":1,\"name\":\"Jeanette Sweeney\",\"email\":\"wewiny@mailinator.com\",\"subject\":\"Obcaecati dolore qua\",\"message\":\"Voluptas magni omnis\",\"created_at\":\"2025-11-19T16:19:53.000000Z\",\"updated_at\":\"2025-11-19T16:19:53.000000Z\"}}', NULL, '2025-11-19 16:19:54', '2025-11-19 16:19:54'),
(21, 'User', 'UserUser has been deleted', 'App\\Models\\User', 'deleted', 9, 'App\\Models\\User', 1, '{\"old\":{\"id\":9,\"name\":\"J\",\"username\":null,\"email\":\"j@gmail.com\",\"email_verified_at\":null,\"password\":\"$2y$12$9rOPFnGdb43..qOBog6RS.QSLhoxV8IuSdDi76jAEZyCYcn24robu\",\"remember_token\":null,\"created_at\":\"2025-08-28T15:08:17.000000Z\",\"updated_at\":\"2025-08-28T15:08:17.000000Z\",\"upload\":null,\"status\":\"Inactive\",\"phone\":null,\"pays\":null,\"ville\":null,\"region\":null,\"adresse\":null}}', NULL, '2025-11-19 16:34:39', '2025-11-19 16:34:39'),
(22, 'Contrat', 'ContratUser has been created', 'App\\Models\\Contrat', 'created', 3, NULL, NULL, '{\"attributes\":{\"id\":3,\"name\":\"Deborah Rowland\",\"pays\":\"Nobis eos similique\",\"phone\":\"+1 (925) 335-6853\",\"date\":\"2002-09-30\",\"email\":\"calyvazys@mailinator.com\",\"obejetDemande\":\"Temporibus et conseq\",\"created_at\":\"2025-11-26T10:14:41.000000Z\",\"updated_at\":\"2025-11-26T10:14:41.000000Z\"}}', NULL, '2025-11-26 10:14:42', '2025-11-26 10:14:42'),
(23, 'Contrat', 'ContratUser has been created', 'App\\Models\\Contrat', 'created', 4, NULL, NULL, '{\"attributes\":{\"id\":4,\"name\":\"Modeste\",\"pays\":\"italie\",\"phone\":\"+22951929600\",\"date\":\"2025-11-23\",\"email\":\"modeste@gmail.com\",\"obejetDemande\":\"je suis a la recherche de largent\",\"created_at\":\"2025-11-29T10:48:31.000000Z\",\"updated_at\":\"2025-11-29T10:48:31.000000Z\"}}', NULL, '2025-11-29 10:48:32', '2025-11-29 10:48:32');

-- --------------------------------------------------------

--
-- Structure de la table `candidates`
--

CREATE TABLE `candidates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `votes` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `candidates`
--

INSERT INTO `candidates` (`id`, `last_name`, `first_name`, `school`, `city`, `birth_date`, `code`, `image`, `votes`, `created_at`, `updated_at`) VALUES
(2, 'ODEBI', 'Maxime', 'Pylones', 'Cotonou', '2025-12-30', '0000001', '1765368750.jpg', 4, '2025-12-10 12:12:30', '2025-12-10 12:12:30'),
(3, 'Foreman', 'Bo', 'Tempore sint maior', 'Deserunt velit in qu', '2001-12-22', '0000003', '1765372624.jpg', 2, '2025-12-10 13:17:05', '2025-12-10 13:17:05'),
(4, 'Ortiz', 'Clarke', 'Incididunt labore ad', 'Ex et expedita est c', '2024-11-04', '0A00004', '1765372874.png', 5, '2025-12-10 13:21:14', '2025-12-10 13:21:14'),
(5, 'Lara', 'Eleanor', 'Cumque est maxime q', 'Saepe dolor nobis co', '1993-06-26', '000005', '1765372959.jpg', 1, '2025-12-10 13:22:39', '2025-12-10 13:22:39'),
(6, 'odebi', 'akiyemi', 'Tempore sint maior', 'Cotonou', '2025-12-31', '000006', '1765963117.jpg', 1, '2025-12-17 09:18:37', '2025-12-17 09:18:37'),
(7, 'franck', 'Eleanor', 'Jamas', 'New York', '2025-12-17', 'SHV007', '1765968478.jpg', 0, '2025-12-17 10:47:58', '2025-12-17 10:47:58');

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

CREATE TABLE `contrats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obejetDemande` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contrats`
--

INSERT INTO `contrats` (`id`, `name`, `pays`, `phone`, `date`, `email`, `obejetDemande`, `created_at`, `updated_at`) VALUES
(1, 'Shay Odonnell', '+1 (954) 637-6012', '+1 (199) 377-7201', '1983-09-15', 'qawidicem@mailinator.com', 'Nobis temporibus est', '2025-11-12 12:06:24', '2025-11-12 12:06:24'),
(2, 'Amelia Trevino', '+1 (972) 436-4368', '+1 (144) 323-1982', '1993-12-15', 'cyla@mailinator.com', 'Et quia exercitation  gueri moi', '2025-11-12 12:16:57', '2025-11-12 12:16:57'),
(3, 'Deborah Rowland', 'Nobis eos similique', '+1 (925) 335-6853', '2002-09-30', 'calyvazys@mailinator.com', 'Temporibus et conseq', '2025-11-26 10:14:41', '2025-11-26 10:14:41'),
(4, 'Modeste', 'italie', '+22951929600', '2025-11-23', 'modeste@gmail.com', 'je suis a la recherche de largent', '2025-11-29 10:48:31', '2025-11-29 10:48:31');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `links`
--

CREATE TABLE `links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `submenu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `links`
--

INSERT INTO `links` (`id`, `submenu_id`, `name`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'gol', 'gol', '2025-08-18 12:58:47', '2025-08-18 19:19:24'),
(2, 1, 'franck', 'franck', '2025-08-18 18:21:14', '2025-08-18 18:21:14'),
(3, 1, 'siii', 'siii', '2025-08-18 19:19:46', '2025-08-18 19:19:46');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('principal','secondaire') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'principal',
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `created_at`, `updated_at`, `type`, `position`) VALUES
(1, 'Accueil', 'accueil', '2025-08-18 12:16:30', '2025-08-24 10:30:40', 'principal', 2),
(2, 'About', 'about', '2025-08-18 18:23:59', '2025-08-24 11:03:48', 'secondaire', 0),
(5, 'Services', 'services', '2025-08-23 11:16:30', '2025-08-24 10:31:23', 'principal', 1),
(6, 'Contact', 'contact', '2025-08-24 11:46:13', '2025-08-24 11:46:13', 'principal', 5),
(7, 'Contact', 'contact', '2025-08-24 11:49:42', '2025-08-24 11:49:42', 'secondaire', 5),
(8, 'Services', 'services', '2025-08-29 21:19:59', '2025-08-29 21:19:59', 'secondaire', 2);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_29_141306_create_permission_tables', 1),
(6, '2025_07_29_141737_create_products_table', 2),
(7, '2014_10_12_100000_create_password_resets_table', 3),
(8, '2025_08_07_054051_add_upload_to_users_table', 4),
(9, '2028_01_01_012644_add_status_to_users_table', 5),
(10, '2027_12_31_220643_add_columns_to_users_table', 6),
(11, '2025_08_18_113613_create_menus_table', 7),
(12, '2025_08_18_113701_create_submenu_table', 7),
(13, '2025_08_18_113727_create_links_table', 8),
(14, '2025_08_23_160341_add_type_and_position_to_menus_table', 9),
(15, '2025_08_28_110356_create_activity_log_table', 10),
(16, '2025_08_28_110357_add_event_column_to_activity_log_table', 10),
(17, '2025_08_28_110358_add_batch_uuid_column_to_activity_log_table', 10),
(18, '2025_08_28_143620_make_username_nullable_in_users_table', 11),
(19, '2025_11_12_114821_create_contrats_table', 12),
(20, '2025_11_12_122730_create_contacts_table', 13),
(21, '2025_11_19_144736_create_newsletter_table', 14),
(22, '2025_12_03_090607_create_workers_table', 15),
(23, '2025_12_09_150558_create_candidates_table', 16),
(24, '2025_12_10_112038_create_candidates_table', 17);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 1),
(7, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 1),
(10, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 1),
(12, 'App\\Models\\User', 1),
(13, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 8),
(9, 'App\\Models\\User', 10);

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `created_at`, `updated_at`) VALUES
(2, 'cnbn@gmail.com', '2025-11-26 08:16:21', '2025-11-26 08:16:21'),
(3, 'ebiakiyemimaxime@gmail.com', '2025-11-29 10:52:13', '2025-11-29 10:52:13');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('cvc@gmail.com', '$2y$12$YEUAQGEcxzRQB8/dOnvIO.wZOZMdVOpihuMGUpHL2XnImrj1ZPJbq', '2025-08-10 21:05:13'),
('odebiakiyemimaxime@gmail.com', '$2y$12$S6QybiPMraH65/C0jpOz.uHVwxLMBEbToHpH6117IG6zfRaQu25Kq', '2025-07-31 01:23:56');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2025-07-29 12:54:15', '2025-07-29 12:54:15'),
(2, 'role-create', 'web', '2025-07-29 12:54:15', '2025-07-29 12:54:15'),
(3, 'role-edit', 'web', '2025-07-29 12:54:15', '2025-07-29 12:54:15'),
(4, 'role-delete', 'web', '2025-07-29 12:54:15', '2025-07-29 12:54:15'),
(5, 'product-list', 'web', '2025-07-29 12:54:15', '2025-07-29 12:54:15'),
(6, 'product-create', 'web', '2025-07-29 12:54:15', '2025-07-29 12:54:15'),
(7, 'product-edit', 'web', '2025-07-29 12:54:16', '2025-07-29 12:54:16'),
(8, 'product-delete', 'web', '2025-07-29 12:54:17', '2025-07-29 12:54:17'),
(10, 'user-list', 'web', '2028-01-01 00:17:01', '2028-01-01 00:17:01'),
(11, 'user-create', 'web', '2028-01-01 00:17:24', '2028-01-01 00:17:24'),
(12, 'user-edit', 'web', '2028-01-01 00:17:42', '2028-01-01 00:17:42'),
(13, 'user-delete', 'web', '2028-01-01 00:17:56', '2028-01-01 00:17:56');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'ODEBI', 'fdbnfdvbfhdv bnbnlwd vcbcxhb hdfv', '2028-01-01 19:07:30', '2028-01-01 19:07:30');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-07-29 12:55:30', '2025-07-29 12:55:30'),
(3, 'Superadmin', 'web', '2025-07-29 15:14:16', '2025-07-29 15:14:16'),
(7, 'secretaire', 'web', '2025-08-10 19:34:08', '2025-08-10 19:34:08'),
(8, 'censeur', 'web', '2025-08-28 14:10:01', '2025-08-28 14:10:01'),
(9, 'suiss', 'web', '2025-08-28 15:00:36', '2025-08-28 15:00:36'),
(10, 'jude', 'web', '2025-09-01 12:27:44', '2025-09-01 12:27:44'),
(11, 'judes', 'web', '2025-09-01 12:29:25', '2025-09-01 12:29:25'),
(12, 'sdsd', 'web', '2025-09-01 12:31:46', '2025-09-01 12:31:46'),
(13, 'sdsdfd', 'web', '2025-09-01 12:38:00', '2025-09-01 12:38:00'),
(14, 'sdsdfdddd', 'web', '2025-09-01 12:38:28', '2025-09-01 12:38:28'),
(15, 'sdsdfddddffr', 'web', '2025-09-01 12:39:02', '2025-09-01 12:39:02'),
(16, 'sqd', 'web', '2025-09-01 12:46:49', '2025-09-01 12:46:49'),
(17, 'ssssss', 'web', '2025-09-01 12:47:52', '2025-09-01 12:47:52');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(1, 7),
(1, 8),
(1, 10),
(1, 11),
(1, 12),
(1, 17),
(2, 1),
(2, 3),
(2, 7),
(2, 8),
(2, 16),
(3, 1),
(3, 7),
(3, 8),
(3, 10),
(3, 11),
(4, 1),
(4, 7),
(4, 10),
(4, 16),
(5, 1),
(5, 8),
(5, 9),
(5, 10),
(5, 12),
(6, 1),
(6, 9),
(6, 11),
(6, 12),
(6, 16),
(7, 1),
(7, 8),
(7, 9),
(7, 12),
(7, 14),
(8, 1),
(8, 9),
(8, 11),
(8, 15),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(13, 13);

-- --------------------------------------------------------

--
-- Structure de la table `submenu`
--

CREATE TABLE `submenu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `submenu`
--

INSERT INTO `submenu` (`id`, `menu_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'mememu', 'mem', '2025-08-18 12:40:28', '2025-08-18 12:40:28'),
(2, 1, 'meday', 'menuday', '2025-08-18 12:41:01', '2025-08-18 12:41:01'),
(3, 5, 'Testimonial', 'testimonial', '2025-08-23 11:17:30', '2025-08-23 11:17:30'),
(4, 5, '404', '404', '2025-08-23 11:17:50', '2025-08-23 11:17:50'),
(5, 7, 'po', 'po', '2025-08-24 11:50:49', '2025-08-24 11:50:49');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `upload` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `upload`, `status`, `phone`, `pays`, `ville`, `region`, `adresse`) VALUES
(1, 'ODEBI', 'Maxime', 'admin@gmail.com', NULL, '$2y$12$DHkMiQNZlxqn/DwQiUZLLu2cH4yipHXRxpVfJbHQUIyCfXyv5FJH2', NULL, '2025-07-29 12:55:30', '2025-09-01 12:17:59', '1830293888.png', 'Active', '+229 51 92 96 0', 'us', 'Cotonou', 'Agla', 'ip259'),
(8, 'Franck', NULL, 'azerty@gmail.com', NULL, '$2y$12$rPaL/.IIr6vlhda4dV8H4uOwOG4qNYEsA571Byj1JNhvAJcLzwqF.', NULL, '2025-08-28 13:40:12', '2025-08-28 13:40:12', NULL, 'Inactive', NULL, NULL, NULL, NULL, NULL),
(10, 'Daruis', NULL, 'D@gmail.com', NULL, '$2y$12$LVQrxSjds5TBaeF.JnhAY.jB0seTpvA9i9GMuFmwhqMSb3f5cEfAe', NULL, '2025-08-28 15:12:51', '2025-08-29 23:52:38', NULL, 'Inactive', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `workers`
--

CREATE TABLE `workers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skills` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_years` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `neighborhood` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Index pour la table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `candidates_code_unique` (`code`);

--
-- Index pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `links_submenu_id_foreign` (`submenu_id`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Index pour la table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submenu_menu_id_foreign` (`menu_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `workers_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `contrats`
--
ALTER TABLE `contrats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `links`
--
ALTER TABLE `links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_submenu_id_foreign` FOREIGN KEY (`submenu_id`) REFERENCES `submenu` (`id`);

--
-- Contraintes pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenu_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
