-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 21 mars 2023 à 17:44
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mediatheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

CREATE TABLE `adherent` (
  `id_adherent` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `adresse` varchar(225) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `CIN` varchar(8) NOT NULL,
  `date_de_naissance` varchar(12) NOT NULL,
  `type` varchar(20) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `date_creation_compte` date NOT NULL DEFAULT current_timestamp(),
  `score` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id_adherent`, `nom`, `prenom`, `adresse`, `email`, `telephone`, `CIN`, `date_de_naissance`, `type`, `user_name`, `password`, `date_creation_compte`, `score`) VALUES
(1, 'Bakali', 'jihan', 'hay ibn batouta', 'jihan-bakali@gmail.com', '0610320964', 'K571645', '01/01/2000', 'Etudiant', 'Bakalijihan', 'jihanBAKALI123@', '2021-02-18', '1'),
(2, 'Samadi', 'Ayoub', 'bransse', 'ayoub.samadi@gmail.com', '0610728954', 'K571324', '04/01/1990', 'Employé', 'Ayoubsamadi', 'samadiayoub90.@', '2022-08-28', '1'),
(3, 'Krimane', 'Touria', 'bassatin', 'kriman-touria@gamil.com', '0615778956', 'K231469', '04/01/1981', 'Femme au foyer', 'Touriakriman81', 'TouriaKRIMAN123', '2022-05-19', 'v');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE `emprunt` (
  `id_emprunt` int(11) NOT NULL,
  `date_emprunt` date NOT NULL,
  `date_retour` date NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_gerant_emprunt` int(11) NOT NULL,
  `id_gerant_retour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id_emprunt`, `date_emprunt`, `date_retour`, `id_reservation`, `id_gerant_emprunt`, `id_gerant_retour`) VALUES
(1, '2023-03-21', '2023-03-22', 1, 1, 2),
(2, '2023-03-31', '2023-04-01', 2, 2, 2),
(4, '2023-03-15', '2023-03-16', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `gerant`
--

CREATE TABLE `gerant` (
  `id_gerant` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gerant`
--

INSERT INTO `gerant` (`id_gerant`, `user_name`, `password`) VALUES
(1, 'Saed', 'saedBAHAJIN@'),
(2, 'Hanae', '1234HANAEfr');

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

CREATE TABLE `ouvrage` (
  `id_ouvrage` int(11) NOT NULL,
  `titre` varchar(30) NOT NULL,
  `nom_auteur` varchar(30) NOT NULL,
  `image` varchar(225) NOT NULL,
  `etat` varchar(225) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date_edition` date NOT NULL,
  `date_achat` date NOT NULL,
  `nombre_pages` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ouvrage`
--

INSERT INTO `ouvrage` (`id_ouvrage`, `titre`, `nom_auteur`, `image`, `etat`, `type`, `date_edition`, `date_achat`, `nombre_pages`) VALUES
(1, 'Antigone', 'Jean Anouilh ', 'antigone.jpg', 'bonne etat', '	Théâtre', '1944-02-04', '2000-10-05', '128'),
(2, 'le dernier jour d un condamné', 'Victor Hugo', 'victor.jpg', 'bonne etat', 'roman', '1829-02-15', '2010-12-27', '160'),
(4, 'le bossu de notre dame', 'Victor Hugo', 'bossu.jpg', 'bonne etat', 'DVD', '1996-03-05', '2018-09-22', ''),
(6, 'Harry potter', 'J.K.Rowling', 'Harry.jpg', 'bonne etat', ' cassettes vidéo', '1997-06-26', '2000-11-01', ''),
(7, 'Maroc', 'Milan Presse', 'maroc.jpg', 'bonne etat', 'revue', '2011-09-25', '2015-07-12', '20'),
(8, 'Raiponce', 'Frères Grimm', 'raiponce.jpg', 'bonne etat', 'DVD', '2010-12-06', '2012-06-28', ''),
(9, 'cuisine', 'Rachida', 'cuisine.jpg', 'déchirer', 'revue', '2014-07-25', '2018-06-15', '23');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `date_reservation` date NOT NULL,
  `id_adherent` int(11) NOT NULL,
  `id_ouvrage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `date_reservation`, `id_adherent`, `id_ouvrage`) VALUES
(1, '2023-03-09', 1, 2),
(2, '0000-00-00', 2, 4),
(3, '2023-03-21', 2, 8);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`id_adherent`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`id_emprunt`),
  ADD KEY `id_reservation` (`id_reservation`),
  ADD KEY `id_gerant_emprunt` (`id_gerant_emprunt`),
  ADD KEY `id_gerant_retour` (`id_gerant_retour`);

--
-- Index pour la table `gerant`
--
ALTER TABLE `gerant`
  ADD PRIMARY KEY (`id_gerant`);

--
-- Index pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD PRIMARY KEY (`id_ouvrage`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_adherent` (`id_adherent`),
  ADD KEY `id_ouvrage` (`id_ouvrage`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adherent`
--
ALTER TABLE `adherent`
  MODIFY `id_adherent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `id_emprunt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `gerant`
--
ALTER TABLE `gerant`
  MODIFY `id_gerant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  MODIFY `id_ouvrage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id_reservation`),
  ADD CONSTRAINT `emprunt_ibfk_2` FOREIGN KEY (`id_gerant_emprunt`) REFERENCES `gerant` (`id_gerant`),
  ADD CONSTRAINT `emprunt_ibfk_3` FOREIGN KEY (`id_gerant_retour`) REFERENCES `gerant` (`id_gerant`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_adherent`) REFERENCES `adherent` (`id_adherent`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_ouvrage`) REFERENCES `ouvrage` (`id_ouvrage`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
