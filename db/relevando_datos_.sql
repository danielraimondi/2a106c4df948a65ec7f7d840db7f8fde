-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2015 a las 11:23:52
-- Versión del servidor: 5.5.43-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `relevando`
--
CREATE DATABASE IF NOT EXISTS `relevando` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `relevando`;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `client_address`, `client_lat`, `client_long`, `priority`, `day`) VALUES
(1, 'Tienda Inglesa', 'Cno. Carlos A. López', -34.808449, -56.159019, 2, 'Monday'),
(8, 'mc donalds', 'por ahi', -34.910427, -56.160393, 2, 'Wednesday'),
(12, 'el piropo', 'garibaldi ', -34.877121, -56.177322, 1, NULL),
(17, 'Burger King', 'Plaza Matriz', -34.907543, -56.204853, 3, 'Tuesday'),
(18, 'Caballero', 'General flores y domingo aramburu', -34.882877, -56.182751, 7, 'Wednesday'),
(19, 'Hipodromo de Maroñas', 'Maroñas', -34.837055, -56.142712, 5, 'Sunday'),
(20, 'Auditorio Nacional Adeal', 'Mercedes', -34.904694, -56.198460, 1, 'Tuesday'),
(21, 'Hospital Español', 'Calle Rocha', -34.875404, -56.181034, 7, 'Thursday'),
(22, 'Gran Parque Central', 'Carlos Anaya', -34.884911, -56.159073, 1, 'Tuesday'),
(23, 'Bosch y Cia', 'Matilde Pacheco de Batlle y Ordoñez', -34.823887, -56.153698, 4, 'Tuesday'),
(24, 'Estadio Abraham Paladino', 'Emilio Romero', -34.873695, -56.234745, 9, 'Thursday'),
(25, 'Millan y Lecocq', 'Av millan', -34.824268, -56.239056, 5, 'Thursday');

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m140209_132017_init', 1447760079),
('m140403_174025_create_account_table', 1447760079),
('m140504_113157_update_tables', 1447760079),
('m140504_130429_create_token_table', 1447760079),
('m140830_171933_fix_ip_field', 1447760079),
('m140830_172703_change_account_table_name', 1447760079),
('m141222_110026_update_ip_field', 1447760079),
('m141222_135246_alter_username_length', 1447760079),
('m150614_103145_update_social_account_table', 1447760079),
('m150623_212711_fix_username_notnull', 1447760079);

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `cat_id`, `prod_pic`) VALUES
(3, 'Coca Cola', 4, ''),
(4, 'Pantalon', 1, 'uploads/4.jpg'),
(5, 'camisa', 1, 'uploads/5.jpg'),
(24, 'Lampara Philip', 6, 'uploads/24.jpg'),
(25, 'Caja de Herramientas', 5, 'uploads/25.jpg'),
(26, 'Body Mist Kosiuko 200Ml', 7, 'uploads/26.jpg'),
(27, 'Colonia Alma de Flores', 7, 'uploads/27.jpg'),
(28, 'Colonia Vorago', 7, 'uploads/28.jpg'),
(29, 'Agua Aquarius Manzana', 4, 'uploads/29.jpg'),
(30, 'Agua Salus Bidon 6LT', 4, 'uploads/30.jpg'),
(31, 'Cable Coaxil c/conector', 2, 'uploads/31.jpg'),
(32, 'Cables Duplic/señal Philips', 2, 'uploads/32.jpg');

--
-- Volcado de datos para la tabla `product_cat`
--

INSERT INTO `product_cat` (`cat_id`, `cat_name`) VALUES
(1, 'Vestimenta'),
(2, 'Accesorios Audio'),
(3, 'Alimentos'),
(4, 'Bebida'),
(5, 'Herramientas'),
(6, 'Iluminación'),
(7, 'Perfumeria');

--
-- Volcado de datos para la tabla `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`) VALUES
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Volcado de datos para la tabla `route`
--

INSERT INTO `route` (`route_date`, `user_id`, `client_id`) VALUES
('2015-12-03', 15, 1),
('2015-12-03', 15, 12),
('2015-12-04', 15, 1),
('2015-12-05', 15, 1),
('2015-12-05', 15, 8),
('2015-12-06', 15, 12),
('2015-12-06', 15, 18),
('2015-12-06', 15, 21),
('2015-12-06', 15, 22),
('2015-12-06', 17, 17),
('2015-12-06', 17, 20);

--
-- Volcado de datos para la tabla `social_account`
--

INSERT INTO `social_account` (`id`, `user_id`, `provider`, `client_id`, `data`, `code`, `created_at`, `email`, `username`) VALUES
(7, NULL, 'google', '114737411275709555496', '{"kind":"plus#person","etag":"\\"MrhFVuKLF7zHXL6gE2l7cEdzuiA\\/bCGOQTEJ29i5UvwfNfSUVz2W9Ek\\"","gender":"male","emails":[{"value":"daniel.raimondi@gmail.com","type":"account"}],"objectType":"person","id":"114737411275709555496","displayName":"Daniel Raimondi","name":{"familyName":"Raimondi","givenName":"Daniel"},"url":"https:\\/\\/plus.google.com\\/114737411275709555496","image":{"url":"https:\\/\\/lh3.googleusercontent.com\\/-XdUIqdMkCWA\\/AAAAAAAAAAI\\/AAAAAAAAAAA\\/4252rscbv5M\\/photo.jpg?sz=50","isDefault":true},"isPlusUser":true,"language":"es_419","circledByCount":14,"verified":false}', 'e945de0d43d33c91455c54c85e5ff7e4', NULL, NULL, NULL);

--
-- Volcado de datos para la tabla `survey`
--

INSERT INTO `survey` (`survey_date`, `client_id`, `user_id`, `prod_id`, `stock`, `order`) VALUES
('2015-12-03', 12, 15, 3, 1, 1),
('2015-12-03', 12, 15, 4, 2, 2),
('2015-12-03', 12, 15, 5, 3, 3),
('2015-12-03', 12, 15, 24, 4, 4),
('2015-12-03', 12, 15, 25, 5, 5),
('2015-12-03', 12, 15, 26, 1, 1),
('2015-12-03', 12, 15, 27, 2, 2),
('2015-12-03', 12, 15, 28, 3, 3),
('2015-12-03', 12, 15, 29, 4, 4),
('2015-12-03', 12, 15, 30, 5, 5),
('2015-12-03', 12, 15, 31, 6, 6),
('2015-12-03', 12, 15, 32, 7, 7),
('2015-12-04', 1, 15, 3, 0, 0),
('2015-12-04', 1, 15, 4, 0, 0),
('2015-12-04', 1, 15, 5, 0, 0),
('2015-12-04', 1, 15, 24, 0, 0),
('2015-12-04', 1, 15, 25, 0, 0),
('2015-12-04', 1, 15, 26, 0, 0),
('2015-12-04', 1, 15, 27, 1, 1),
('2015-12-04', 1, 15, 28, 2, 2),
('2015-12-04', 1, 15, 29, 0, 0),
('2015-12-04', 1, 15, 30, 9, 9),
('2015-12-04', 1, 15, 31, 0, 0),
('2015-12-04', 1, 15, 32, 0, 0),
('2015-12-05', 1, 15, 3, 0, 0),
('2015-12-05', 1, 15, 4, 0, 0),
('2015-12-05', 1, 15, 5, 0, 0),
('2015-12-05', 1, 15, 24, 0, 0),
('2015-12-05', 1, 15, 25, 0, 0),
('2015-12-05', 1, 15, 26, 0, 0),
('2015-12-05', 1, 15, 27, 0, 0),
('2015-12-05', 1, 15, 28, 0, 0),
('2015-12-05', 1, 15, 29, 0, 0),
('2015-12-05', 1, 15, 30, 0, 0),
('2015-12-05', 1, 15, 31, 0, 0),
('2015-12-05', 1, 15, 32, 0, 0),
('2015-12-05', 8, 15, 3, 0, 0),
('2015-12-05', 8, 15, 4, 0, 0),
('2015-12-05', 8, 15, 5, 0, 0),
('2015-12-05', 8, 15, 24, 0, 0),
('2015-12-05', 8, 15, 25, 0, 0),
('2015-12-05', 8, 15, 26, 0, 0),
('2015-12-05', 8, 15, 27, 0, 0),
('2015-12-05', 8, 15, 28, 0, 0),
('2015-12-05', 8, 15, 29, 0, 0),
('2015-12-05', 8, 15, 30, 0, 0),
('2015-12-05', 8, 15, 31, 0, 0),
('2015-12-05', 8, 15, 32, 0, 0);

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `user_lat`, `user_lng`, `user_radius`) VALUES
(14, 'admin', 'benzaiten_@hotmail.com', '$2y$10$WQRwW2AnWsbAENN4VBbiTu6Miv6s0c1cjdTBYSB0FIEKBwfadIbPK', 'Nj7FNJAJEw6saQfQm6M0jwxEl0WNjhr5', 1448799550, NULL, NULL, '10.240.0.28', 1448799518, 1448799518, 0, -34.9012, -56.1864, 2),
(15, 'Daniel', 'Danielraimondi@gmail.com', '$2y$10$eU1NWU.o3tUwngJXEkjag.LIYNHmHUgwZbOCQQifer2.DIzN6Fv8W', 'pOxZuCvQSuf8mocFUONTSqAea6csbH0A', 1448799657, NULL, NULL, '10.240.0.61', 1448799657, 1449054533, 0, -34.88, -56.1723, 2),
(16, 'Gonzalo', 'gonsc7@gmail.com', '$2y$10$eOJ.fKEWofgDXpbcqttPZOMscIR1tfgpsLQyi3iWs49fzPPvkQj/i', 'bEc2Wxejqe7jXTpEqOj3kRV7qdB_c6wv', 1448799770, NULL, NULL, '10.240.0.28', 1448799770, 1448799770, 0, -34.8775, -56.0843, 7),
(17, 'Valentina', 'valentina@gmail.com', '$2y$10$ZzTbcFwn9sPNRcnT3pj4XO62nonhteugwu7p/fCA89./Yko0dqbVm', '7tDz4TRqYvCbvit4C6E03uLOMArhLxtj', 1448799790, NULL, NULL, '10.240.0.68', 1448799790, 1448799790, 0, -34.9072, -56.2067, 1),
(18, 'Marcos', 'marcos@gmail.com', '$2y$10$8B3AQXrQS5YI8rkqkMTVLefLHcWsVp.QU9FuJqG5XijKPi0CNn3w2', 't0PgtX7-5rmK6slzy0tbVKoZ7GFoDuJQ', 1448799810, NULL, NULL, '10.240.0.68', 1448799810, 1448799810, 0, -34.3468, -56.2919, 6),
(19, 'Julia', 'julia@gmail.com', '$2y$10$scTzYHEd6g9rQftJFTfy8./GNWeZ6p19Nw/lLV7lRoa3HYXe/epG6', 'Krob2mxHUJb3Lscr5yzPun2ZkB0hQs2N', 1448799832, NULL, NULL, '10.240.0.68', 1448799832, 1448799832, 0, -34.8675, -56.174, 3),
(20, 'Emiliano', 'Emiliano@gmail.com', '$2y$10$SNsiHopjAUoj1DOJw02deuglMQqhKw1xle2DYmSGAA.qegJ3NMuaK', 'A3OC1KdsEqppUwml7iwgYrinUNiJU_21', 1448799850, NULL, NULL, '10.240.0.40', 1448799850, 1448799850, 0, -34.8338, -56.1456, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
