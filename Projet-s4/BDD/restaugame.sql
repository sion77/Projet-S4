-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le : Mar 13 Mars 2012 à 10:09
-- Version du serveur: 5.5.15
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `restaugame`
--

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE IF NOT EXISTS `employe` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idRestaurant` int(10) NOT NULL,
  `salaire` double NOT NULL,
  `qualitePrestation` int(10) NOT NULL,
  `nbJoursEmbauche` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ferie`
--

CREATE TABLE IF NOT EXISTS `ferie` (
  `jourFerie` int(255) NOT NULL,
  `moisFerie` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ferie`
--

INSERT INTO `ferie` (`jourFerie`, `moisFerie`) VALUES
(1, 1),
(1, 4),
(8, 4),
(14, 7),
(11, 11),
(25, 12),
(1, 11),
(15, 8),
(9, 4),
(17, 5);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE IF NOT EXISTS `ingredient` (
  `idIngredient` int(255) NOT NULL AUTO_INCREMENT,
  `nomIngredient` varchar(255) NOT NULL,
  `idTypeIngredient` int(255) NOT NULL,
  `note` int(11) NOT NULL,
  `prix` double NOT NULL,
  PRIMARY KEY (`idIngredient`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `ingredient`
--

INSERT INTO `ingredient` (`idIngredient`, `nomIngredient`, `idTypeIngredient`, `note`, `prix`) VALUES
(1, 'salade bio', 1, 9, 2),
(2, 'salade discount', 1, 3, 0.9),
(3, 'salade bon marché', 1, 6, 1.2),
(4, 'fromage de chèvre bio', 2, 9, 5.99),
(5, 'fromage de chèvre discount', 2, 3, 1.99),
(6, 'fromage de chèvre bon marché', 2, 6, 3.55),
(7, 'pain discount', 3, 3, 1),
(8, 'pain bio', 3, 9, 4.2),
(9, 'pain bon marché', 3, 6, 3.2),
(10, 'foie gras bio', 4, 9, 29.99),
(11, 'foie gras discount', 4, 3, 5.99),
(12, 'foie gras bon marché', 4, 6, 15.99),
(13, 'semoule bio', 5, 9, 6.3),
(14, 'semoule discount', 5, 3, 1.99),
(15, 'semoule bon marché', 5, 6, 3.5),
(16, 'merguez bio', 6, 9, 7.99),
(17, 'merguez discount', 6, 3, 2.01),
(18, 'merguez bon marché', 6, 6, 3.44),
(19, 'pois chiche bio', 7, 9, 3.99),
(20, 'pois chiche discount', 7, 3, 0.8),
(21, 'pois chiche bon marché', 7, 6, 2.3),
(22, 'fromage bio', 8, 9, 5.99),
(23, 'fromage discount', 8, 3, 1.99),
(24, 'fromage bon marché', 8, 6, 3.55),
(25, 'tomate bio', 9, 9, 2.99),
(26, 'tomate discount', 9, 3, 0.49),
(27, 'tomate bon marchée', 9, 6, 1),
(28, 'oeuf bio', 10, 9, 1),
(29, 'oeuf discount', 10, 3, 0.19),
(30, 'oeuf bon marché', 10, 6, 0.35),
(31, 'creme anglaise bio', 11, 9, 5.6),
(32, 'creme anglaise discount', 11, 3, 0.99),
(33, 'creme anglaise bon marchée', 11, 6, 2.99),
(34, 'chocolat bio', 12, 9, 5.99),
(35, 'chocolat discount', 12, 3, 1.89),
(36, 'chocolat bon marché', 12, 6, 3.2),
(37, 'glace vanille bio', 13, 9, 4.99),
(38, 'glace vanille discount', 13, 3, 0.99),
(39, 'glace vanille bon marchée', 13, 6, 2.99),
(40, 'pomme bio', 14, 9, 1.49),
(41, 'pomme discount', 14, 3, 0.3),
(42, 'pomme bon marchée', 14, 6, 0.5),
(43, 'poire bio', 15, 9, 1.69),
(44, 'poire discount', 15, 3, 0.4),
(45, 'poire bon marchée', 15, 6, 0.6),
(46, 'banane bio', 16, 9, 1),
(50, 'banane discount', 16, 3, 0.99),
(51, 'banane bon marchée', 16, 6, 0.99);

-- --------------------------------------------------------

--
-- Structure de la table `ingredientplat`
--

CREATE TABLE IF NOT EXISTS `ingredientplat` (
  `idTypeIngredient` int(255) NOT NULL,
  `idPlat` int(255) NOT NULL,
  `quantiteIngredient` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ingredientplat`
--

INSERT INTO `ingredientplat` (`idTypeIngredient`, `idPlat`, `quantiteIngredient`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 3),
(4, 2, 1),
(3, 2, 3),
(1, 2, 1),
(5, 3, 1),
(6, 3, 4),
(7, 3, 10),
(8, 4, 2),
(9, 4, 4),
(10, 4, 1),
(11, 5, 1),
(12, 5, 4),
(13, 5, 1),
(14, 6, 5),
(15, 6, 5),
(16, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE IF NOT EXISTS `joueur` (
  `login` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `capital` double NOT NULL,
  `mdp` varchar(15) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `joueur`
--

INSERT INTO `joueur` (`login`, `nom`, `prenom`, `email`, `capital`, `mdp`) VALUES
('allison.fraissines', 'fraissines', 'allison', 'allison.fraissines@gmail.com', 100000, 'lili');

-- --------------------------------------------------------

--
-- Structure de la table `jouractuel`
--

CREATE TABLE IF NOT EXISTS `jouractuel` (
  `jourActuel` int(255) NOT NULL,
  `moisActuel` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(255) NOT NULL,
  `quantite` int(255) NOT NULL,
  `nomMenu` varchar(200) NOT NULL,
  `entree` int(255) NOT NULL,
  `plat` int(255) NOT NULL,
  `dessert` int(255) NOT NULL,
  `prix` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `menurestaurant`
--

CREATE TABLE IF NOT EXISTS `menurestaurant` (
  `idMenu` int(255) NOT NULL,
  `idRestaurant` int(255) NOT NULL,
  PRIMARY KEY (`idMenu`,`idRestaurant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mesingredientplat`
--

CREATE TABLE IF NOT EXISTS `mesingredientplat` (
  `idIngredient` int(255) NOT NULL,
  `idPlat` int(255) NOT NULL,
  `idMenu` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mesplats`
--

CREATE TABLE IF NOT EXISTS `mesplats` (
  `num` int(255) NOT NULL,
  `idPlatRealisable` int(255) NOT NULL,
  `note` double NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `nbclients`
--

CREATE TABLE IF NOT EXISTS `nbclients` (
  `nbClientsTotal` int(255) NOT NULL,
  `nbClientsPauvre` int(255) NOT NULL,
  `nbClientsRiche` int(255) NOT NULL,
  `nbClientsMoyen` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `platrealisable`
--

CREATE TABLE IF NOT EXISTS `platrealisable` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nomPlat` varchar(255) NOT NULL,
  `typePlat` int(255) NOT NULL,
  `lienPhoto` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `platrealisable`
--

INSERT INTO `platrealisable` (`id`, `nomPlat`, `typePlat`, `lienPhoto`) VALUES
(1, 'salade de chevre chaud', 1, '/platRealisable/salade de chevre chaud.jpg'),
(2, 'foie gras', 1, '/platRealisable/foie gras.jpg'),
(3, 'couscous', 2, '/platRealisable/couscous.jpg'),
(4, 'pizza margarita', 2, '/platRealisable/pizza margarita.jpg'),
(5, 'mi-cuit chocolat et sa boule vanille', 3, '/platRealisable/mi-cuit chocolat et sa boule vanille.jpg'),
(6, 'crumble pomme poire banane', 3, '/platRealisable/crumble pomme poire.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `repartition`
--

CREATE TABLE IF NOT EXISTS `repartition` (
  `nbPauvres` int(255) NOT NULL,
  `nbRiches` int(255) NOT NULL,
  `nbMoyens` int(255) NOT NULL,
  `idRestaurant` int(10) NOT NULL,
  PRIMARY KEY (`idRestaurant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `taille` int(10) NOT NULL,
  `publicite` double NOT NULL,
  `decoration` double NOT NULL,
  `loginProprietaire` varchar(20) NOT NULL,
  `nbMaxEmploye` int(255) NOT NULL,
  `noteRestaurant` int(255) NOT NULL,
  `aleatoire` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `restaurant`
--

INSERT INTO `restaurant` (`id`, `nom`, `taille`, `publicite`, `decoration`, `loginProprietaire`, `nbMaxEmploye`, `noteRestaurant`, `aleatoire`) VALUES
(1, 'Aux délices d''Asie', 40, 1000, 1000, 'allison.fraissines', 50, 8, 2);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `idTypeIngredient` int(255) NOT NULL,
  `idIngredient` int(255) NOT NULL,
  `quantite` int(255) NOT NULL,
  `idRestaurant` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock`
--

INSERT INTO `stock` (`idTypeIngredient`, `idIngredient`, `quantite`, `idRestaurant`) VALUES
(1, 2, 3, 1),
(2, 4, 5, 1),
(15, 45, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeingredient`
--

CREATE TABLE IF NOT EXISTS `typeingredient` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `lienPhoto` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `typeingredient`
--

INSERT INTO `typeingredient` (`id`, `nom`, `lienPhoto`) VALUES
(1, 'salade', '/ingredients/salade.jpg'),
(2, 'fromage de chevre', '/ingredients/fromage de chevre.jpg'),
(3, 'pain', '/ingredients/pain.jpg'),
(4, 'foie gras', '/ingredients/fois gras.jpg'),
(5, 'semoule', '/ingredients/semoule.jpg'),
(6, 'merguez', '/ingredients/merguez.jpg'),
(7, 'pois chiche', '/ingredients/pois chiche.jpg'),
(8, 'fromage', '/ingredients/fromage.jpg'),
(9, 'tomate', '/ingredients/tomate.jpg'),
(10, 'oeuf', '/ingredients/oeuf.jpg'),
(11, 'crème anglaise', '/ingredients/crème anglaise.jpg'),
(12, 'chocolat', '/ingredients/chocolat.jpg'),
(13, 'glace vanille', '/ingredients/glace vanille.jpg'),
(14, 'pomme', '/ingredients/pomme.jpg'),
(15, 'poire', '/ingredients/poire.jpg'),
(16, 'banane', '/ingredients/babane.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
