-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 09 nov. 2024 à 11:07
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_articles`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `contenu`, `date_creation`) VALUES
(1, 'titre 1', 'contenu 1\r\nnouv ligne', '2024-10-02 17:25:00'),
(2, 'titre 2', 'contenu 2', '2024-10-02 17:27:00'),
(4, 'titre 3', 'contenu 3', '2024-10-07 09:43:00'),
(5, 'titre 4', 'contenu 4', '2024-10-07 09:44:00'),
(6, 'titre 5', 'contenu 5', '2024-10-07 16:10:00'),
(7, 'titre 6', 'contenu 6', '2024-10-07 16:15:00'),
(8, 'titre 7', 'contenu 7', '2024-10-07 16:17:00'),
(9, 'titre 8', 'contenu 8', '2024-10-07 16:27:00'),
(10, 'titre 9', 'contenu 9', '2024-10-07 16:32:00'),
(11, 'titre 10', 'contenu 10\r\nalervu\r\naler\r\nencore du texte', '2024-10-07 16:36:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
