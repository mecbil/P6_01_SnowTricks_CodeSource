-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 22 fév. 2022 à 21:32
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : snowtricks
--

-- --------------------------------------------------------

--
-- Structure de la table categories
--

DROP TABLE IF EXISTS categories;
CREATE TABLE IF NOT EXISTS categories
(
  id int(11) NOT NULL AUTO_INCREMENT,
  label varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table categories
--

INSERT INTO categories (id, label) VALUES
(1, Les grabs),
(2, Les rotations),
(3, Les flips),
(4, Les rotations désaxées),
(5, Les slides),
(6, Les one foot tricks),
(7, Old school);

-- --------------------------------------------------------

--
-- Structure de la table comments
--

DROP TABLE IF EXISTS comments;
CREATE TABLE IF NOT EXISTS comments
(
  id int(11) NOT NULL AUTO_INCREMENT,
  users_id int(11) NOT NULL,
  tricks_id int(11) NOT NULL,
  content longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  author varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at datetime NOT NULL,
  modify_at datetime NOT NULL,
  PRIMARY KEY (id),
  KEY IDX_5F9E962A67B3B43D (users_id),
  KEY IDX_5F9E962A3B153154 (tricks_id)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table comments
--

INSERT INTO comments (id, users_id, tricks_id, content, author, created_at, modify_at) VALUES
(1, 7, 3, Trop belle l\image, mecbil, 2022-01-17 10:00:17, 2022-01-17 10:00:17),
(2, 7, 3, Les petit oiseaux, mecbil, 2022-01-29 10:16:55, 2022-01-29 10:16:55),
(3, 4, 3, Un comment de Marck, mecbil, 2022-01-29 10:33:03, 2022-01-29 10:33:03),
(4, 7, 9, comment 1, mecbil, 2022-02-02 09:42:27, 2022-02-02 09:42:27),
(5, 4, 3, Un autre commentaire de marck, mecbil, 2022-02-07 10:49:25, 2022-02-07 10:49:25),
(6, 4, 3, comment 5, mecbil, 2022-02-07 11:15:10, 2022-02-07 11:15:10),
(7, 4, 3, com 6, mecbil, 2022-02-07 11:16:46, 2022-02-07 11:16:46),
(8, 7, 9, Comment 2, mecbil, 2022-02-10 18:12:49, 2022-02-10 18:12:49),
(11, 7, 3, Comment 7, mecbil, 2022-02-10 22:57:31, 2022-02-10 22:57:31),
(12, 7, 3, Comment 8, mecbil, 2022-02-10 22:57:43, 2022-02-10 22:57:43),
(13, 7, 3, comment 9, mecbil, 2022-02-10 22:57:54, 2022-02-10 22:57:54),
(14, 7, 4, com 1, mecbil, 2022-02-11 08:21:54, 2022-02-11 08:21:54),
(15, 7, 4, Com 2, mecbil, 2022-02-11 08:22:16, 2022-02-11 08:22:16),
(16, 7, 4, Com 3, mecbil, 2022-02-11 08:22:30, 2022-02-11 08:22:30),
(17, 7, 4, Com 4, mecbil, 2022-02-11 08:22:48, 2022-02-11 08:22:48),
(18, 7, 4, Com 5, mecbil, 2022-02-11 08:23:01, 2022-02-11 08:23:01),
(19, 7, 1, Commentaire teste, mecbil, 2022-02-14 07:47:05, 2022-02-14 07:47:05),
(20, 7, 1, Comment teste 2, mecbil, 2022-02-14 20:50:33, 2022-02-14 20:50:33);

-- --------------------------------------------------------

--
-- Structure de la table doctrine_migration_versions
--

DROP TABLE IF EXISTS doctrine_migration_versions;
CREATE TABLE IF NOT EXISTS doctrine_migration_versions
(
  version varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  executed_at datetime DEFAULT NULL,
  execution_time int(11) DEFAULT NULL,
  PRIMARY KEY (version)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table doctrine_migration_versions
--

INSERT INTO doctrine_migration_versions (version, executed_at, execution_time) VALUES
(DoctrineMigrations\\Version20211220123835, NULL, NULL),
(DoctrineMigrations\\Version20211221145442, 2021-12-21 14:54:53, 134),
(DoctrineMigrations\\Version20211228105947, 2021-12-28 11:00:03, 381),
(DoctrineMigrations\\Version20211228165935, 2021-12-28 16:59:46, 147),
(DoctrineMigrations\\Version20211228170505, 2021-12-28 17:05:15, 122),
(DoctrineMigrations\\Version20211228172206, 2021-12-28 17:22:18, 178);

-- --------------------------------------------------------

--
-- Structure de la table pictures
--

DROP TABLE IF EXISTS pictures;
CREATE TABLE IF NOT EXISTS pictures
(
  id int(11) NOT NULL AUTO_INCREMENT,
  tricks_id int(11) NOT NULL,
  label varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  link varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  KEY IDX_8F7C2FC03B153154 (tricks_id)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table pictures
--

INSERT INTO pictures (id, tricks_id, label, link) VALUES
(1, 2, Image 1, 720.jpg),
(6, 3, Image 6, rodeo.jpg),
(10, 2, image 12, 1080.jpg),
(11, 2, Image 3, backflip-2.jpg),
(12, 4, Image 1, 1080.jpg),
(14, 9, Image 1, backflip.jpg),
(16, 1, Image 1, 1080.jpg),
(18, 1, Image 2, c0b199d73b_120515_lexique-snowboard.jpg),
(22, 3, Image 18, 1080-1.jpg),
(33, 1, Image 3, backflip.jpg),
(34, 6, Image 1, c0b199d73b_120515_lexique-snowboard.jpg);

-- --------------------------------------------------------

--
-- Structure de la table reset_password_request
--

DROP TABLE IF EXISTS reset_password_request;
CREATE TABLE IF NOT EXISTS reset_password_request
(
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  selector varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  hashed_token varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  requested_at datetime NOT NULL COMMENT (DC2Type:datetime_immutable),
  expires_at datetime NOT NULL COMMENT (DC2Type:datetime_immutable),
  PRIMARY KEY (id),
  KEY IDX_7CE748AA76ED395 (user_id)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table reset_password_request
--

INSERT INTO reset_password_request (id, user_id, selector, hashed_token, requested_at, expires_at) VALUES
(1, 4, WmJ0jB9e4vE8DT4LNjcp, 2mF1kV0+7zt73VlYdDnI0+hEX57CCbapRt+tr6edx4g=, 2021-12-22 09:21:30, 2021-12-22 10:21:30);

-- --------------------------------------------------------

--
-- Structure de la table tricks
--

DROP TABLE IF EXISTS tricks;
CREATE TABLE IF NOT EXISTS tricks
(
  id int(11) NOT NULL AUTO_INCREMENT,
  users_id int(11) NOT NULL,
  categories_id int(11) NOT NULL,
  title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  author varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  content longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at datetime NOT NULL,
  modify_at datetime NOT NULL,
  fitured_img longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  KEY IDX_E1D902C167B3B43D (users_id),
  KEY IDX_E1D902C1A21214B7 (categories_id)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table tricks
--

INSERT INTO tricks (id, users_id, categories_id, title, author, content, created_at, modify_at, fitured_img) VALUES
(1, 7, 1, Mute, mecbil, Saisie de la carre frontside (face avant ) de la planche entre les deux pieds avec la main avant, 2022-01-06 10:18:20, 2022-01-06 10:18:20, 720-1.jpg),
(2, 4, 1, Melancholie, mecbil, Saisie de la carre backside (arrière ) de la planche, entre les deux pieds, avec la main avant., 2022-01-06 10:30:18, 2022-02-01 15:01:38, backflip-1.jpg),
(3, 7, 1, Indy, mecbil, Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière, 2022-01-08 18:52:09, 2022-01-08 18:52:09, mute .jpeg),
(4, 7, 1, Stalefish, mecbil, Saisie de la carre backside de la planche entre les deux pieds avec la main arrière, 2022-01-08 19:02:37, 2022-01-08 19:02:37, c0b199d73b_120515_lexique-snowboard.jpg),
(5, 7, 1, Tail Grab, mecbil, Saisie de la partie arrière de la planche, avec la main arrière, 2022-01-08 19:23:16, 2022-01-27 18:26:25, sad-1.jpg),
(6, 4, 1, Nose Grab, mecbil, Saisie de la partie avant de la planche, avec la main avant, 2022-01-08 19:30:33, 2022-02-16 16:25:22, nose-grab-2.jpg),
(7, 7, 1, Japan air, mecbil, Saisie de l\avant de la planche, avec la main avant, du côté de la carre frontside, 2022-01-09 10:15:17, 2022-01-27 18:31:00, mute .jpeg),
(8, 7, 1, Seat belt, mecbil, Saisie du carre frontside à l\arrière avec la main avant, 2022-01-10 09:41:59, 2022-01-10 09:41:59, Seat belt.jpg),
(9, 7, 3, Back flip, mecbil, Rotations en arrière et se confondent souvent avec certaines rotations horizontales désaxées., 2022-02-01 21:03:08, 2022-02-17 16:58:23, backflip-1.jpg),
(11, 7, 1, teste a suprim 3, mecbil, dqsd qsdqsdq qsdqdqd qdqdqd, 2022-02-03 11:50:47, 2022-02-03 11:50:48, stalefish.jpg),
(13, 7, 2, teste a suprim 5, mecbil, les petis, 2022-02-03 11:51:52, 2022-02-03 11:51:52, 1080-1.jpg),
(15, 7, 2, les oiseaux, mecbil, lkjdfqs fjlqjlkqflkj qfqlkfqljk, 2022-02-03 11:53:10, 2022-02-03 11:53:10, backflip.jpg),
(17, 7, 1, teste a suprim 78, mecbil, gfgfrdrfv, 2022-02-03 11:54:36, 2022-02-03 11:54:36, backflip.jpg),
(18, 7, 1, Style Week supp, mecbil, Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant, 2022-02-14 08:40:19, 2022-02-17 16:53:47, tailslide.jpg),
(20, 7, 1, dsfsd sdfsdf, mecbil, cwxcwxc qfqfq, 2022-02-14 09:16:20, 2022-02-14 09:16:20, rodeo.jpg),
(21, 7, 1, Japan air 2, mecbil, sdfsdf sdfsdfsdf dfsdfsdf sdfsdfsdfsdf sfsfd, 2022-02-15 08:24:20, 2022-02-15 08:24:20, rodeo-1.jpg),
(22, 7, 1, Tail Grab2, mecbil, les oiseaux très deux fois grt rtrgt trt, 2022-02-17 16:37:12, 2022-02-17 16:39:46, stalefish-2.jpg);

-- --------------------------------------------------------

--
-- Structure de la table users
--

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users
(
  id int(11) NOT NULL AUTO_INCREMENT,
  lastname varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  nickname varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  email varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  roles json NOT NULL,
  password varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  is_verified tinyint(1) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY UNIQ_1483A5E9E7927C74 (email)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table users
--

INSERT INTO users (id, lastname, nickname, email, roles, password, is_verified) VALUES
(4, Dubois, marck, coucou@moi.fr, [\"ROLE_USER\"], $2y$13$ukyweQB4WA0T/0HNvQTF2OvzCnSMFzSlaCiOjtgZqGcSGPksz50Im, 1),
(7, Mecili, mecbil, contact@snowtricks.org, [\"ROLE_ADMIN\"], $2y$13$krulME0mnpHnLnHYGGageOhuE8JvC7P5Cm/KEelzBRUE442fZSt1q, 1);

-- --------------------------------------------------------

--
-- Structure de la table vids
--

DROP TABLE IF EXISTS vids;
CREATE TABLE IF NOT EXISTS vids
(
  id int(11) NOT NULL AUTO_INCREMENT,
  tricks_id int(11) NOT NULL,
  label varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  link varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  KEY IDX_E08B5ED63B153154 (tricks_id)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table vids
--

INSERT INTO vids (id, tricks_id, label, link) VALUES
(2, 3, Video 2, https://www.youtube.com/embed/51sQRIK-TEI),
(4, 3, Video 4, https://www.youtube.com/embed/CA5bURVJ5zk),
(7, 3, trriioiozierzr, https://www.youtube.com/embed/6yA3XqjTh_w),
(8, 4, Video 1, https://www.youtube.com/embed/aPhYdeitDtA),
(10, 9, Video 1, https://www.youtube.com/embed/6yA3XqjTh_w),
(12, 17, Trop belle, https://www.youtube.com/embed/51sQRIK-TEI),
(26, 1, Video 1, https://www.youtube.com/embed/6yA3XqjTh_w),
(27, 1, Video 2, https://www.youtube.com/embed/CA5bURVJ5zk),
(28, 1, suppr, https://www.youtube.com/embed/51sQRIK-TEI);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table comments
--
ALTER TABLE comments
  ADD CONSTRAINT FK_5F9E962A3B153154 FOREIGN KEY (tricks_id) REFERENCES tricks (id),
  ADD CONSTRAINT FK_5F9E962A67B3B43D FOREIGN KEY (users_id) REFERENCES users (id);

--
-- Contraintes pour la table pictures
--
ALTER TABLE pictures
  ADD CONSTRAINT FK_8F7C2FC03B153154 FOREIGN KEY (tricks_id) REFERENCES tricks (id) ON DELETE CASCADE;

--
-- Contraintes pour la table reset_password_request
--
ALTER TABLE reset_password_request
  ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id);

--
-- Contraintes pour la table tricks
--
ALTER TABLE tricks
  ADD CONSTRAINT FK_E1D902C167B3B43D FOREIGN KEY (users_id) REFERENCES users (id),
  ADD CONSTRAINT FK_E1D902C1A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id);

--
-- Contraintes pour la table vids
--
ALTER TABLE vids
  ADD CONSTRAINT FK_E08B5ED63B153154 FOREIGN KEY (tricks_id) REFERENCES tricks (id) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
