-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 24 mai 2025 à 21:42
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
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`aid`, `login`, `password`) VALUES
(4, 'admina', '$2y$10$.LsEica0iB9Mtju6eccCMOf9PG.TGC1qiS5LQkkXc7iyYgSW7UlKa'),
(5, 'admin', '$2y$10$ClUtqFHe9dCXNqxeIzt3W.g6AdeEpBVZzDBGld.Wt9a93CjUjyvv.');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `icone` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `description`, `date_creation`, `icone`) VALUES
(12, 'Fleurs fraîches', 'Des bouquets colorés et parfumés, soigneusement préparés avec des fleurs fraîches de saison pour chaque occasion spéciale.', '2025-05-17 04:00:48', 'fa-spa'),
(13, ' Fleurs séchées', 'Des créations durables et élégantes avec des fleurs naturelles séchées, parfaites pour une décoration intemporelle et bohème.', '2025-05-17 04:01:46', 'fa-leaf'),
(14, 'Plantes en pot', 'Une sélection de plantes d’intérieur faciles à entretenir, idéales pour ajouter une touche de nature et de verdure à votre espace.', '2025-05-17 04:02:41', 'fa-seedling'),
(15, 'Cadeaux', 'Des idées cadeaux fleuries : bougies, coffrets et cartes personnalisées à offrir pour faire plaisir en toute simplicité.', '2025-05-17 04:03:17', 'fa-gift'),
(16, 'Pots & accessoires', 'Des idées cadeaux fleuries : bougies, coffrets et cartes personnalisées à offrir pour faire plaisir en toute simplicité.', '2025-05-17 04:05:01', 'fa-box-open');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `valide` int(11) NOT NULL DEFAULT 0,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `mode_paiement` varchar(50) NOT NULL DEFAULT 'livraison'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `id_client`, `total`, `valide`, `date_creation`, `mode_paiement`) VALUES
(32, 7, 59, 0, '2025-05-17 05:15:03', 'livraison'),
(33, 9, 27, 1, '2025-05-17 05:43:24', 'livraison'),
(34, 7, 36, 0, '2025-05-20 21:13:41', 'livraison'),
(35, 7, 21, 0, '2025-05-20 21:49:24', 'carte'),
(36, 8, 32, 0, '2025-05-21 04:26:47', 'livraison'),
(37, 43, 48, 0, '2025-05-21 07:32:48', 'carte'),
(40, 43, 21, 0, '2025-05-21 07:39:59', 'carte'),
(42, 43, 21, 0, '2025-05-21 07:50:58', 'livraison'),
(43, 43, 21, 0, '2025-05-21 08:00:35', 'livraison'),
(44, 43, 17, 0, '2025-05-21 08:19:36', 'livraison'),
(45, 43, 17, 0, '2025-05-21 08:25:47', 'livraison'),
(46, 43, 17, 0, '2025-05-21 08:27:16', 'livraison'),
(47, 7, 17, 0, '2025-05-21 08:32:42', 'livraison'),
(48, 7, 40, 0, '2025-05-21 08:33:32', 'carte'),
(49, 44, 57, 1, '2025-05-21 15:11:45', 'carte'),
(50, 7, 48, 0, '2025-05-22 02:04:53', 'livraison'),
(51, 7, 41, 0, '2025-05-22 05:25:13', 'carte'),
(52, 48, 33, 1, '2025-05-23 09:07:51', 'carte'),
(53, 7, 17, 0, '2025-05-23 11:23:50', 'carte');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE `ligne_commande` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `quantite` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`id`, `id_produit`, `id_commande`, `prix`, `quantite`, `total`) VALUES
(22, 14, 32, 21, 2, 42),
(23, 15, 32, 17, 1, 17),
(24, 18, 33, 15, 1, 15),
(25, 20, 33, 12, 1, 12),
(26, 14, 34, 21, 1, 21),
(27, 18, 34, 15, 1, 15),
(28, 14, 35, 21, 1, 21),
(30, 20, 36, 12, 1, 12),
(31, 20, 37, 12, 1, 12),
(32, 22, 37, 36, 1, 36),
(33, 14, 40, 21, 1, 21),
(34, 14, 42, 21, 1, 21),
(35, 14, 43, 21, 1, 21),
(36, 15, 44, 17, 1, 17),
(37, 15, 45, 17, 1, 17),
(38, 15, 46, 17, 1, 17),
(39, 15, 47, 17, 1, 17),
(40, 16, 48, 40, 1, 40),
(41, 14, 49, 21, 1, 21),
(42, 22, 49, 36, 1, 36),
(43, 23, 50, 48, 1, 48),
(44, 15, 51, 17, 1, 17),
(45, 19, 51, 24, 1, 24),
(46, 15, 52, 17, 2, 33),
(47, 15, 53, 17, 1, 17);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `discount` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `libelle`, `prix`, `discount`, `id_categorie`, `date_creation`, `description`, `image`) VALUES
(14, 'Lys blancs', 24, 0, 12, '2025-05-17 00:00:00', 'Élégants lys à longue tige.', '6828009474fe9lys.jpg'),
(15, 'Tulipes colorées', 18, 7, 12, '2025-05-17 00:00:00', 'Mélange de 10 tulipes de saison.', '6828010b074betulip.jpg'),
(16, 'Bouquet séché bohème', 40, 0, 13, '2025-05-17 00:00:00', 'Bouquet de fleurs séchées.', '682805d46222eBouquet-fleurs-sechees.png'),
(18, 'Mini cactus trio', 15, 0, 14, '2025-05-17 00:00:00', '3 petits cactus dans pots assortis.', '6828068b660dbcactus.jpg'),
(19, 'Orchidée blanche', 25, 4, 14, '2025-05-17 00:00:00', 'Orchidée blanche en pot porcelaine', '682806fb90275orchid.jpg'),
(20, 'Arrosoir décoratif en metal avec grand motif gri', 12, 0, 16, '2025-05-17 00:00:00', 'Arrosoirs Décoration de jardin extérieure la jardinière en métal apporte un ajout unique et décoratif à la décoration intérieure ou extérieure de votre maison Arrosoir en métal habilement fabriqué à partir de métal solide et résistant avec une texture en ', '6828086f69970arrosoir-decoratif-en-metal-avec-grand-motif--gris.webp'),
(21, 'Peluche Ours & Rose Éternelle sous Cloche', 80, 23, 15, '2025-05-17 00:00:00', 'Pack Spécial Saint-Valentin : Tendresse éternelle\r\nOffrez un moment magique avec notre duo romantique : un ours en roses symbolisant l’amour tendre, accompagné d’une rose éternelle sous cloche, pour des souvenirs qui durent toujours.', '68280a7f78100oursRose.png'),
(22, 'Boite Rose - Fleurs & chocolat', 40, 9, 15, '2025-05-17 00:00:00', 'Boîte Rose : L\'Élégance des Fleurs Rencontre la Gourmandise du Chocolat.\r\nPoids net : 160g.\r\nOffrez une boîte rose exquise, alliance parfaite de fleurs élégantes et de délicieux chocolats. Un cadeau qui célèbre l\'amour et la douceur en toute occasion.', '68280b6558007boite-rose-fleurs-chocolat.jpg'),
(23, 'Vase en céramique Ambre - Blanc', 70, 31, 16, '2025-05-17 00:00:00', 'Inspiré de nos tasses best-sellers, ce nouveau vase aux courbes chaleureuses sublimera vos fleurs fraîches ou séchées, ou décorera votre intérieur avec douceur.\r\nHauteur 22 cm, diamètre 12 cm.\r\nFabriqué à la main avec amour ❤️', '68280c8f24ff9vase-en-ceramique-ambre-blanc.webp');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `password`, `email`, `phone`, `date_creation`) VALUES
(7, 'minma', '$2y$10$E3LBK9KqaLejOTwasdRNJ.rpc6LnLZ0F0JaPS1i53deZqXJ2mPIOC', 'minma@gmail.com', '0667889934', '2025-05-16'),
(8, 'mery', '$2y$10$VZyUWe5t.qJ18/LlEbTLFuIrIPUQdSu7ZWIqrJpcrEAnaUl08sJJm', 'mery@gmail.com', '0660894412', '2025-05-17'),
(9, 'zahra', '$2y$10$Vutl5Cx6rA4gL0W6jrOqpOsa07uH9/2fp//UBNRoWhSnSswg9GhqO', 'zahra@gmail.com', '0678453425', '2025-05-17'),
(11, 'mohamed', '$2y$10$uItTyt0qf650MyRXJ1iQW.cA1IkWliJl3rdaCM216Xf0FLKwCenpW', 'mohamed@gmail.com', '0667889034', '2025-05-20'),
(37, 'minosh', '$2y$10$mpJVqL6l9QoGYGm23nnHcOVFs0787aMy14m.EZ3rHcQlKaS6HDQtm', 'mino@gmail.com', '43290842304', '2025-05-21'),
(41, 'oscar', '$2y$10$27DV5fbLelI/kTRwFfy05.q3RYYISbh/BpgeQWDyjZgR1/DbADsVS', 'oscar@gmail.com', '0679880934', '2025-05-21'),
(43, 'clove', '$2y$10$phRUEhTAl97DAtjyyctPXunqqpCkNcW7j1BOANcO2pkZibzv/DCV.', 'clove@gmail.com', '0678509211', '2025-05-21'),
(44, 'leo', '$2y$10$RKVIq15Q59l/rUOkircwFO.QVaj4HYELBY0og0Vv2UIdyHJ/RNPDa', 'leo@gmail.com', '0645001286', '2025-05-21'),
(46, 'shiru', '$2y$10$OeD8m3c.w.fVgRVAe8dECOsZmqQdXgpGTDtv29l00FKl7bT2AHAzW', 'shiru@gmail.com', '0680775012', '2025-05-22'),
(48, 'user', '$2y$10$7amwqbxhtBNOxCbhGqQ1z.9ctTwav1PgpVffhKp/4NPYREjuiA90C', 'user@gmail.com', '0645609089', '2025-05-23');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produit` (`id_produit`),
  ADD KEY `id_commande` (`id_commande`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD CONSTRAINT `ligne_commande_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ligne_commande_ibfk_2` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
