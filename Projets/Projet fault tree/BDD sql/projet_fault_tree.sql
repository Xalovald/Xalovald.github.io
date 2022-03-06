-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 17 fév. 2022 à 09:05
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_fault_tree`
--

-- --------------------------------------------------------

--
-- Structure de la table `fault`
--

DROP TABLE IF EXISTS `fault`;
CREATE TABLE IF NOT EXISTS `fault` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Libelle` text NOT NULL,
  `debut` int(11) NOT NULL,
  `type` varchar(60) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fault`
--

INSERT INTO `fault` (`id`, `Libelle`, `debut`, `type`) VALUES
(1, 'Ma souris ne fonctionne plus', 1, 'Materiel'),
(2, 'Mon écran ne fonctionne plus', 2, 'Materiel'),
(3, 'Les périphériques de mon pc portable ne fonctionnent pas', 3, 'Materiel'),
(4, 'Mon lecteur de carte vitale/cps/cpe ne fonctionne pas', 4, 'Materiel'),
(5, 'Mon ordinateur démarre mais reste sur un écran noir', 5, 'Materiel'),
(6, 'Mon mot de passe ne marche pas', 6, 'Logiciel'),
(7, 'La dictée sur mon smartphone ne marche pas', 7, 'Logiciel'),
(8, 'Je voudrais avoir accès à un dossier partagé', 8, 'Logiciel'),
(9, 'Je voudrais créer un dossier partagé', 9, 'Logiciel'),
(10, 'Je voudrais du matériel', 10, 'Logiciel'),
(11, 'Ma scannette ne fonctionne pas', 11, 'Materiel');

-- --------------------------------------------------------

--
-- Structure de la table `id_repertoire`
--

DROP TABLE IF EXISTS `id_repertoire`;
CREATE TABLE IF NOT EXISTS `id_repertoire` (
  `id_rep` varchar(60) NOT NULL,
  `id` int(60) NOT NULL AUTO_INCREMENT,
  KEY `INDEX` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `id_repertoire`
--

INSERT INTO `id_repertoire` (`id_rep`, `id`) VALUES
('6s12s12s', 132),
('6s12s12s', 133),
('2s4s21s19s23s', 134),
('2s4s21s19s23s', 135),
('1s1s1s2s3s', 136);

-- --------------------------------------------------------

--
-- Structure de la table `info`
--

DROP TABLE IF EXISTS `info`;
CREATE TABLE IF NOT EXISTS `info` (
  `date` datetime NOT NULL,
  `nom_pc` varchar(30) NOT NULL,
  `version_pc` varchar(100) NOT NULL,
  `path` varchar(60) NOT NULL,
  `id` int(60) NOT NULL AUTO_INCREMENT,
  KEY `INDEX` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `info`
--

INSERT INTO `info` (`date`, `nom_pc`, `version_pc`, `path`, `id`) VALUES
('2022-02-17 09:27:14', 'SERV-DASHBDSI', 'build 9600 (Windows Server 2012 R2 Standard Edition)', '6s12s12s', 134),
('2022-02-17 09:54:14', 'SERV-DASHBDSI', 'build 9600 (Windows Server 2012 R2 Standard Edition)', '6s12s12s', 135),
('2022-02-17 09:57:54', 'SERV-DASHBDSI', 'build 9600 (Windows Server 2012 R2 Standard Edition)', '2s4s21s19s23s', 136),
('2022-02-17 09:58:08', 'SERV-DASHBDSI', 'build 9600 (Windows Server 2012 R2 Standard Edition)', '2s4s21s19s23s', 137),
('2022-02-17 09:58:42', 'SERV-DASHBDSI', 'build 9600 (Windows Server 2012 R2 Standard Edition)', '1s1s1s2s3s', 138);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id_q` int(11) NOT NULL AUTO_INCREMENT,
  `id_pb` int(11) NOT NULL,
  `Libelle` text NOT NULL,
  UNIQUE KEY `id` (`id_q`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id_q`, `id_pb`, `Libelle`) VALUES
(1, 1, 'La lumiere rouge est elle allumée sous la souris ?'),
(2, 0, 'Débrancher et rebrancher la souris'),
(3, 0, 'Le câble est bien branché ?'),
(4, 2, 'La lumière orange est-elle allumée sous l&#39;écran ?'),
(5, 3, 'Débrancher le boitier connecté à votre pc portable'),
(6, 0, 'Redémarrer le boitier (éteindre puis rallumer)'),
(7, 0, 'Rebrancher le boitier'),
(9, 4, 'Débrancher puis rebrancher le lecteur de carte vital (à l&#39;arrière du lecteur)'),
(10, 5, 'Vérifier les branchements de la prise d&#39;alimentation'),
(11, 0, 'Débrancher votre clé USB ou disque dur externe'),
(12, 6, 'Redémarrer l&#39;ordinateur'),
(14, 7, 'Redémarrer le smartphone '),
(15, 8, 'Demander à votre supérieur (cadre) avant de faire quoi que ce soit si vous en avez un (supérieur)'),
(16, 9, 'Demander à votre supérieur (cadre) avant de faire quoi que ce soit si vous en avez un (supérieur)'),
(17, 10, 'Demander à votre supérieur (cadre) avant de faire quoi que ce soit si vous en avez un (supérieur)'),
(18, 11, 'Avez vous fait la procédure de réinitialisation ?'),
(19, 0, 'Vérifier si les cables derrière l&#39;écran sont bien connectés'),
(20, 0, 'Verifier si le cable d&#39;alimentation est bien branché derrière l&#39;écran'),
(22, 0, 'Changer de port usb');

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
CREATE TABLE IF NOT EXISTS `reponses` (
  `id_r` int(11) NOT NULL AUTO_INCREMENT,
  `id_q` int(11) NOT NULL,
  `id_q_suiv` int(11) NOT NULL,
  `id_fin` int(11) DEFAULT NULL,
  `libelle` text,
  UNIQUE KEY `id` (`id_r`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id_r`, `id_q`, `id_q_suiv`, `id_fin`, `libelle`) VALUES
(1, 1, 2, 0, 'Oui'),
(2, 1, 3, 0, 'Non'),
(3, 2, 4, 1, 'Ca fonctionne !'),
(4, 2, 22, 0, 'Ca ne fonctionne pas !'),
(5, 3, 2, 0, 'Oui'),
(6, 5, 6, 0, 'C&#39;est fait'),
(7, 6, 7, 0, 'C&#39;est fait'),
(8, 7, 5, 1, 'Ca fonctionne !'),
(9, 9, 10, 1, 'C&#39;est fait'),
(10, 10, 11, 0, 'C&#39;est fait'),
(11, 11, 12, 0, 'C&#39;est fait'),
(12, 12, 6, 1, 'C&#39;est fait'),
(14, 14, 9, 1, 'C&#39;est fait'),
(15, 15, 6, 1, 'Go !'),
(16, 16, 6, 1, 'Go !'),
(17, 17, 10, 1, 'Go !'),
(18, 18, 5, 1, 'C&#39;est fait'),
(23, 19, 5, 1, 'C&#39;est fait'),
(21, 4, 19, 0, 'Oui'),
(22, 4, 20, 0, 'Non'),
(24, 20, 19, 0, 'C&#39;est fait'),
(25, 3, 2, 0, 'Non');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
