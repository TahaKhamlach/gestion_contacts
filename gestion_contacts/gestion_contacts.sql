-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 05 mars 2026 à 19:32
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
-- Base de données : `gestion_contacts`
--

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modification` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `date_naissance`, `notes`, `date_creation`, `date_modification`) VALUES
(1, 'Khamlach', 'Taha', 'taha.khamlach@etud.iga.ac.ma', '+212 612-607713', 'Casablanca, Maarif', '2006-03-16', 'Membre du groupe', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(2, 'Sadfi', 'Salma', 'salma.sadfi@etud.iga.ac.ma', '+212 614-382905', 'Rabat, Agdal', '2005-07-12', 'Membre du groupe', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(3, 'Tamai', 'Ahmed', 'tamai.ahmed@etud.iga.ac.ma', '+212 617-905214', 'Fès, Ville Nouvelle', '2006-12-03', 'Membre du groupe', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(4, 'Nabil', 'Abdelhak', 'abdelhak.nabil@etud.iga.ac.ma', '+212 620-448771', 'Marrakech, Guéliz', '2006-01-05', 'Membre du groupe', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(5, 'Amara', 'Zakaria', 'zakaria.amara@etud.iga.ac.ma', '+212 622-193406', 'Tanger, Centre-ville', '2006-09-08', 'Membre du groupe', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(6, 'El Amrani', 'Youssef', 'youssef.elamrani@etud.iga.ac.ma', '+212 611-284903', 'Casablanca, Ain Diab', '2006-01-15', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(7, 'Bennani', 'Sara', 'sara.bennani@etud.iga.ac.ma', '+212 613-770154', 'Rabat, Hay Riad', '2005-04-22', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(8, 'Alaoui', 'Hamza', 'hamza.alaoui@etud.iga.ac.ma', '+212 615-509632', 'Fès, Narjiss', '2006-10-09', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(9, 'Idrissi', 'Aya', 'aya.idrissi@etud.iga.ac.ma', '+212 616-841207', 'Agadir, Talborjt', '2005-06-30', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(10, 'Chafai', 'Mehdi', 'mehdi.chafai@etud.iga.ac.ma', '+212 618-236905', 'Kénitra, Maamora', '2006-08-14', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(11, 'Toumi', 'Nadia', 'nadia.toumi@etud.iga.ac.ma', '+212 619-905773', 'Oujda, Centre', '2005-03-05', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(12, 'Raji', 'Salma', 'salma.raji@etud.iga.ac.ma', '+212 621-770981', 'Essaouira, Médina', '2006-11-12', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(13, 'Lahlou', 'Rim', 'rim.lahlou@etud.iga.ac.ma', '+212 623-184506', 'Casablanca, Bourgogne', '2005-02-20', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(14, 'Berrada', 'Ilyas', 'ilyas.berrada@etud.iga.ac.ma', '+212 624-906318', 'Rabat, Hassan', '2006-09-25', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(15, 'Mouline', 'Hajar', 'hajar.mouline@etud.iga.ac.ma', '+212 625-337119', 'Fès, Saïss', '2005-01-28', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(16, 'Sefrioui', 'Amine', 'amine.sefrioui@etud.iga.ac.ma', '+212 626-518404', 'Marrakech, Targa', '2006-07-03', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(17, 'Ziani', 'Hiba', 'hiba.ziani@etud.iga.ac.ma', '+212 627-902466', 'Tanger, Malabata', '2005-05-16', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(18, 'Khalfi', 'Omar', 'omar.khalfi@etud.iga.ac.ma', '+212 628-641905', 'Tétouan, Wilaya', '2006-12-19', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(19, 'Mansouri', 'Imane', 'imane.mansouri@etud.iga.ac.ma', '+212 629-174280', 'Meknès, Hamria', '2005-04-07', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(20, 'Benjelloun', 'Anas', 'anas.benjelloun@etud.iga.ac.ma', '+212 630-905712', 'Casablanca, Sidi Maarouf', '2006-08-01', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(21, 'Haddad', 'Ikram', 'ikram.haddad@etud.iga.ac.ma', '+212 631-287640', 'Rabat, Souissi', '2005-10-13', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(22, 'Cherkaoui', 'Yassine', 'yassine.cherkaoui@etud.iga.ac.ma', '+212 632-779105', 'Fès, Atlas', '2006-06-26', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(23, 'Bouzidi', 'Meryem', 'meryem.bouzidi@etud.iga.ac.ma', '+212 633-410962', 'Agadir, Dakhla', '2005-03-18', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(24, 'El Fassi', 'Rayan', 'rayan.elfassi@etud.iga.ac.ma', '+212 634-905233', 'Marrakech, Mhamid', '2006-09-09', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14'),
(25, 'Zouhairi', 'Noura', 'noura.zouhairi@etud.iga.ac.ma', '+212 635-288417', 'Tanger, Boubana', '2005-11-23', 'Contact professionnel', '2026-03-05 18:31:14', '2026-03-05 18:31:14');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
