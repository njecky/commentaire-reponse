-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 17 juin 2021 à 13:25
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `commentaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `ref` varchar(60) NOT NULL,
  `ref_id` int NOT NULL,
  `parent_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `username`, `email`, `content`, `created`, `ref`, `ref_id`, `parent_id`) VALUES
(1, 'Njecky Félix Désiré', 'njeckyf1@gmail.com', 'Mon premier petit commentaire en Programmation Orienté Object ', '2021-05-20 13:59:50', 'post', 1, 0),
(2, 'Xu Zhiwei', 'kotto_immeuble@yahoo.fr', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500', '2021-05-21 10:55:25', 'post', 1, 0),
(3, 'Cédrico', 'tiako@gmail.com', 'Commentaire pour les nulls', '2021-05-24 11:26:26', 'post', 1, 0),
(5, 'Cédrico', 'tiako@gmail.com', 'Tu es sûr de toi que c\'est ton premier commentaire !?', '2021-06-17 10:51:36', 'post', 1, 1),
(6, 'Patric Franc', 'aze@tet.com', 'je ne suis pas d\'accord avec toi !', '2021-06-17 10:53:04', 'post', 1, 3),
(7, 'Monsieur content', 'njecky@gmail.com', 'Pareille pour moi', '2021-06-17 12:55:41', 'post', 1, 3),
(8, 'Axel LeGrand', 'axel@google.com', 'je suis d\'accord avec Cédrico', '2021-06-17 13:14:27', 'post', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `name`, `slug`, `content`) VALUES
(1, 'I second That Emotion', 'Mon-super-slug', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas,Cras fermentum odio eu feugiat. Justo eget magna fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue,Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
