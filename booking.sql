-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : Dim 09 jan. 2022 à 11:33
-- Version du serveur :  5.7.32
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données : `booking`
--

-- --------------------------------------------------------

--
-- Structure de la table `Appartment`
--

CREATE TABLE `Appartment` (
  `id` int(11) NOT NULL,
  `people` int(11) NOT NULL,
  `date_checkin` date NOT NULL,
  `date_checkout` date NOT NULL,
  `hour_checkin` time NOT NULL,
  `hour_checkout` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Appartment`
--

INSERT INTO `Appartment` (`id`, `people`, `date_checkin`, `date_checkout`, `hour_checkin`, `hour_checkout`, `created_at`, `updated_at`, `status`) VALUES
(2, 1, '2021-12-12', '2021-12-13', '12:00:00', '12:00:00', '2021-12-12 21:05:33', '2021-12-12 21:05:33', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Book`
--

CREATE TABLE `Book` (
  `id_user` int(11) NOT NULL,
  `id_appartment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Book`
--

INSERT INTO `Book` (`id_user`, `id_appartment`) VALUES
(13, 2);

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notification` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`id`, `username`, `firstname`, `lastname`, `email`, `notification`, `password`, `admin`) VALUES
(12, 'maxess', 'Maxime', 'Schellenberger', 'maxschell31@gmail.com', 1, '$2y$10$BusSBZuwWvh.tLng0cKOKu73iEFyIWoOSZZgiiPJrkvbGWFtEogzO', 1),
(13, 'test', 'Test', 'Test', 'test@gmail.com', 0, '$2y$10$YX0w4k8el4rL8vZWCt3bH.sU1sUEqohkfK4TXV1WkXk6ouTU1//IC', 0),
(17, 'ytyj', 'Tyjtyj', 'Ytjty', 'jtyjt@gmkegz', 0, '$2y$10$SdKI6lz1Z6dEHPpaytC73.1WE4gFFmXWnjP7cBhKmvSvCS7RtQJPe', 0),
(18, 'a', 'A', 'A', 'a@free.fr', 1, '$2y$10$mFkm42bDX/oion4xFseBJ.AS8WaWifsFaOFTmXsh09JSk826vngW.', 0),
(28, 'zad', 'Zad', 'Zad', 'zad@gmail.com', 0, '$2y$10$Gfd79ylxW3YhycKPjK7gR.e3sK9Z8g4ZRrqoY/YxdsYVvtUOtX7m.', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Appartment`
--
ALTER TABLE `Appartment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Book`
--
ALTER TABLE `Book`
  ADD KEY `Book_fk0` (`id_user`),
  ADD KEY `Book_fk1` (`id_appartment`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Appartment`
--
ALTER TABLE `Appartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Book`
--
ALTER TABLE `Book`
  ADD CONSTRAINT `Book_fk0` FOREIGN KEY (`id_user`) REFERENCES `User` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Book_fk1` FOREIGN KEY (`id_appartment`) REFERENCES `Appartment` (`id`) ON DELETE CASCADE;
