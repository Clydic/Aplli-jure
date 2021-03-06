-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 01 déc. 2021 à 10:05
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
-- Base de données : `crm`
--
CREATE DATABASE IF NOT EXISTS `crm` DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE `crm`;

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `prc_ADD_examen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ADD_examen` (IN `id_of_session_formation` INT(2), IN `date_to_add` CHAR(10))  BEGIN

		DECLARE DateEndFormation DATE;
		DECLARE DateBeginFormation DATE;
	    SELECT DateDebutFormation 
	    into DateBeginFormation					 
	    FROM `Session_Formation`
	    WHERE IdSessionFormation = id_of_session_formation;
	    
	    SELECT DateFinFormation 
	    into DateEndFormation 		
	    FROM `Session_Formation` 
	    WHERE IdSessionFormation = id_of_session_formation;
	    
		IF ((id_of_session_formation,date_to_add)
		IN (SELECT IdSessionFormation, 								DateSessionExam 
		     FROM `SessionExamen` ))
		THEN 
		SIGNAL SQLSTATE '45002' 
		SET MESSAGE_TEXT = "Il ne peut y avoir deux 		examen le même jour pour une même 				formation" ;
	    END IF;
	    
		IF ((date_to_add<DateEndFormation)
	    &&
		(date_to_add>DateBeginFormation)) THEN
    	INSERT INTO `SessionExamen`( 			DateSessionExam, IDSessionFormation) 
	VALUES (date_to_add, id_of_session_formation);
    
    
    ELSE 
    	SIGNAL SQLSTATE '45001' 
        SET MESSAGE_TEXT = "La date demandée ne 			correspond pas à la période de la 				session de foramtion" ;
	END IF; 
END$$

DROP PROCEDURE IF EXISTS `prc_ADD_Formateur`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ADD_Formateur` (`nom` VARCHAR(50), `prenom` VARCHAR(50), `adr1` VARCHAR(50), `adr2` VARCHAR(50), `postal` VARCHAR(50), `ville` VARCHAR(50), `phone` VARCHAR(50), `mail` VARCHAR(50))  BEGIN
		DECLARE idCoor INTEGER DEFAULT 0;
		INSERT INTO `Coordonnees`(`Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (adr1,adr2,postal,ville,phone,mail);
		SELECT MAX(IDCoordonnee) INTO idCoor FROM Coordonnees;
		INSERT INTO `Formateur`(`Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (upper(nom),prenom,idCoor);
END$$

DROP PROCEDURE IF EXISTS `prc_DEL_examen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_DEL_examen` (IN `id_of_examen_to_delete` INT(3))  BEGIN
	IF (id_of_examen_to_delete IN (SELECT IdSessionExam FROM SessionExamen)) THEN 
		DELETE FROM `SessionExamen` WHERE IdSessionExam = id_of_examen_to_delete;
	ELSE
		SIGNAL SQLSTATE '45003' 
        SET MESSAGE_TEXT = "La session d'examen que vous essayez d'effacer n'existe pas" ;
	END IF;
END$$

DROP PROCEDURE IF EXISTS `prc_DEL_Formateur`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_DEL_Formateur` (`id` INT)  BEGIN
	DELETE FROM `Formateur` WHERE IDFormateur = id;
END$$

DROP PROCEDURE IF EXISTS `prc_LST_examen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_LST_examen` ()  BEGIN
		SELECT f.Intitule_de_formation,
        	e.IDSessionExam,
		    s.IDSessionFormation, 
			e.DateSessionExam 
			from `Formation` f
			JOIN  `Session_Formation` s on s.IDFormation = f.IDFormation
			JOIN `SessionExamen` e on e.IDSessionFormation = s.IDSessionFormation
			WHERE e.DateSessionExam >= CURRENT_DATE()
			ORDER BY e.DateSessionExam;
END$$

DROP PROCEDURE IF EXISTS `prc_LST_listeSessionFormation`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_LST_listeSessionFormation` ()  BEGIN
SELECT f.Intitule_de_formation , sf.IDSessionFormation, sf.DateDebutFormation, sf.DateFinFormation 
FROM `Formation` f 
JOIN `Session_formation` sf 
ON sf.IDFormation=f.IDFormation 
WHERE sf.DateFinFormation >= CURRENT_DATE();
END$$

DROP PROCEDURE IF EXISTS `prc_UPD_Formateur`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_UPD_Formateur` (`idForm` INT, `nom` VARCHAR(50), `prenom` VARCHAR(50), `adr1` VARCHAR(50), `adr2` VARCHAR(50), `postal` INT, `ville` VARCHAR(50), `phone` VARCHAR(50), `mail` VARCHAR(50))  BEGIN
	DECLARE idCoor INTEGER DEFAULT 0;
	UPDATE `Formateur` SET `Nom_du_formateur`= nom,`Prenom_du_Formateur`= prenom WHERE IDFormateur = idForm;

	SELECT IDCoordonnee INTO idCoor FROM Formateur WHERE IDFormateur = idForm;
	UPDATE `Coordonnees` SET `Adresse1`= adr1,`Adresse2`= adr2 ,`Code_Postale`= postal ,`Ville`= ville ,`Telephone`= phone ,`Mail`= mail WHERE IDCoordonnee = idCoor;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `connaitre`
--

DROP TABLE IF EXISTS `connaitre`;
CREATE TABLE IF NOT EXISTS `connaitre` (
  `IDTechnologie` int(11) NOT NULL,
  `IDJure` int(11) NOT NULL,
  PRIMARY KEY (`IDTechnologie`,`IDJure`),
  KEY `Connaitre_Jure0_FK` (`IDJure`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `connaitre`
--

INSERT INTO `connaitre` (`IDTechnologie`, `IDJure`) VALUES
(1, 1),
(2, 1),
(3, 1),
(1, 2),
(2, 2),
(1, 3),
(3, 3),
(5, 4),
(13, 4),
(16, 4),
(6, 5),
(10, 5),
(1, 6),
(7, 6),
(15, 6),
(16, 6),
(10, 7),
(11, 7),
(12, 7),
(13, 8),
(14, 8),
(15, 9),
(1, 10),
(9, 10),
(16, 10);

-- --------------------------------------------------------

--
-- Structure de la table `coordonnees`
--

DROP TABLE IF EXISTS `coordonnees`;
CREATE TABLE IF NOT EXISTS `coordonnees` (
  `IDCoordonnee` int(11) NOT NULL AUTO_INCREMENT,
  `Adresse1` varchar(50) COLLATE latin1_bin NOT NULL,
  `Adresse2` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `Code_Postale` int(11) NOT NULL,
  `Ville` varchar(50) COLLATE latin1_bin NOT NULL,
  `Telephone` varchar(10) COLLATE latin1_bin NOT NULL,
  `Mail` varchar(50) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`IDCoordonnee`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `coordonnees`
--

INSERT INTO `coordonnees` (`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES
(1, '21, rue PHP', NULL, 14000, 'Caen', '0611528496', 'bin.damien@afpa.fr'),
(2, '15, rue des frameworks', NULL, 14800, 'Deauville', '0641489575', 'bray.vincent@afpa.fr'),
(3, '7, rue de Girard', NULL, 14123, 'IFS', '0614859753', 'gauthier.remy@afpa.fr'),
(4, '698, boulevard Grégoire Thomas', NULL, 14200, 'Herouville-Saint-Clair', '0612596574', 'albert.emile@afpa.fr'),
(5, '16, rue de Pruvost', NULL, 14120, 'Mondeville', '0658748562', 'traore.gerard@afpa.fr'),
(6, '60, avenue Duval', NULL, 14200, 'Herouville-Saint-Clair', '0654859742', 'labbe.joseph@afpa.fr'),
(7, '6, boulevard de Benoit', NULL, 14000, 'Caen', '0659863215', 'huet.aurelie@afpa.fr'),
(8, '43, chemin Caron', NULL, 14000, 'Caen', '0694758196', 'antoine.philippe@afpa.fr'),
(9, '677, avenue Daniel Moulin', NULL, 14123, 'IFS', '0623985475', 'lauranne.susanne@afpa.fr'),
(10, '55, place William Teixeira', NULL, 14123, 'IFS', '0617485965', 'mary.alex@afpa.fr'),
(11, '39, avenue du Maréchal Juin', NULL, 50000, 'St-Lô', '0238329985', 'MartinMarguerite@sfr.fr'),
(12, '49, avenue du Maréchal de Lattre de Tasigny', NULL, 14000, 'Caen', '0239220984', 'GarciaThérèse@flute.jsp'),
(13, '59, rue des Lacs', NULL, 14200, 'Hérouville-Saint-Clair', '0679631569', 'BruceRiquier@rhyta.com'),
(14, '50 rue des Lacs', NULL, 14200, 'Hérouville-Saint-Clair', '0636987525', 'XavierDenis@armyspy.com'),
(15, '5, Chemin des Bateliers', NULL, 61000, 'Alençon', '0632154785', 'PatriciaCharlebois@dayrep.com'),
(16, '29, rue Ernest Renan', NULL, 50100, 'Cherbourg', '0687412569', 'MainvilleAvent@orange.fr'),
(17, '94, Chemin des Bateliers', NULL, 61000, 'Alençon', '0658741256', 'RosemarieBordeaux@free.fr'),
(18, '16 avenue Marechal Juin', NULL, 50000, 'Saint-Lô', '0625897412', 'ElodieLamothe@sfr.fr'),
(19, '66, Chemin Du Lavarin Sud', NULL, 14000, 'Caen', '0612369854', 'SydneyCourse@gmail.com'),
(20, '50, Chemin Des Bateliers', NULL, 14000, 'Caen', '0698745213', 'SamsonThomas@gmail.com'),
(21, '305, Avenue du Javscript', 'étage 3, porte 8 ', 14000, 'Caen', '0641236952', 'WagnerRené@yahoo.fr'),
(22, '45, Boulevard du Chalumeau', 'Batiment3, porte 2', 14400, 'Bayeux', '0698741236', 'LefevreNath@yahoo.fr'),
(23, '79, rue Léon Dierx', NULL, 14100, 'Lisieux', '0658741236', 'GallerValérie@gmail.com'),
(24, '46, allée du Pinceau', NULL, 14260, 'Bonnemaison', '0666988744', 'LerouxMargaret@red.fr'),
(25, '86, rue du cable', 'Etage 3, port 6', 14710, 'Colombière', '0633358742', 'BergerGrégoire@gmail.com'),
(26, '163, boulevard du Touriste', NULL, 14800, 'Deauville', '0699887744', 'BruneauHonoré@free.fr'),
(27, '63, boulevard du Maréchal Leclerc', NULL, 14000, 'Caen', '0613214598', 'VasseurBenoit@orange.fr'),
(28, '192, allée de la Taule', NULL, 14840, 'Démouville', '0658741238', 'PelletierRemy@yahoo.fr'),
(29, '1, rue du Grand Tableau', NULL, 14730, 'Giberville', '0687489632', 'FabreAdélaide@gmail.com'),
(30, '41, avenue du pot Peinture', 'Batiment 2, étage 8, porte 5', 14100, 'Glos', '0614852369', 'CharrierLouis@free.fr'),
(31, '8,Rue Léopold Sédar-Senghor', NULL, 14460, 'Colombelles', '0650319158', 'Pack.Digital@free.fr'),
(32, '9, rue Raymonde Bail', NULL, 14000, 'CAEN', '0261100520', 'cins@orange.fr'),
(33, '17 rue Victor Hugo', NULL, 14700, 'Falaise', '0231905329', 'contact@inno-reseaux.fr'),
(34, '497 Rue Delamare-Deboutteville ', NULL, 76160, 'SAINT-MARTIN-DU-VIVIER', '0231592828', 'contact@saoc.fr'),
(35, '120 Impasse des Mûriers', NULL, 50110, 'TOURLAVILLE', '0233439146', 'bst-normandie@sfr.fr'),
(36, 'ZI de Montilly', NULL, 14250, 'TILLY-SUR-SEULLES', '0231915501', 'contact@tch-normandie.fr'),
(37, '181 rue de la flammèche', NULL, 76450, 'OURVILLE EN CAUX', '0672145835', 'l-atelier-des-bosses@outlook.fr'),
(38, 'ZA route de Rouen', NULL, 76400, 'TOUSSAINT', '0234022557', 'contact@2mv-car.fr'),
(39, '8 rue du Canal', NULL, 76380, 'Canteleu', '0658942354', 'mace-renault@wanadoo.fr'),
(40, 'route de gace', 'la ferte fresnel', 61550, 'LA FERE EN OUCHE', '0233344450', 'normandie.liftingautomobile@orange.fr'),
(41, 'Le Moulin Foulon', NULL, 50150, 'SOURDEVALE', '0233584588', 'contact@normandietransport.fr'),
(42, 'ZAC EST 18 rue Abo Volo', NULL, 14120, 'MONDEVILLE', '0231358545', 'contact@normandielogistique.fr'),
(43, '5592 AV DE GLATTBACH', NULL, 14760, 'BRETTVILLE-SUR-ODON', '0892976200', 'contact@allaincetp.fr'),
(44, '1 route de Malto', 'RD 147', 14320, 'FEUGUEROLLES BULLY', '0663691343', 'contact@samandco-tp.com'),
(45, ' Rue de l\'Homme de Bois', NULL, 14600, 'HONFLEUR', '0231895400', 'musee.eugeneboudin@wanadoo.fr'),
(46, 'BP 9 - LE PONT SUD', NULL, 61450, 'LA FERRIERE AUX ETANGS', '0233366905', 'voyage.croupis@wanadoo.fr'),
(47, '90 rue de Geole', NULL, 14000, 'CAEN', '0231152879', 'ju.stechezmoi@yahoo.com'),
(48, 'ZA De L\'etoile-Mondevill', NULL, 14120, 'CAEN', '0231354949', 'les3brasseurs14@les3brasseursmondeville.fr'),
(49, 'ZA Rue des Renards ', NULL, 76190, 'SAINTE MARIE DES CHAMPS', '0235562253', 'contact@lsfroid.fr'),
(50, 'Rue de la Grande Epine', NULL, 76800, 'SAINT ETIENNE DU ROUVRAY', '0235728514', 'contact@froidservice-agille.fr');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `IDEntreprise` int(11) NOT NULL AUTO_INCREMENT,
  `NomEntreprise` varchar(50) COLLATE latin1_bin NOT NULL,
  `IDCoordonnee` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDEntreprise`),
  KEY `Entreprise_Coordonnees_FK` (`IDCoordonnee`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`IDEntreprise`, `NomEntreprise`, `IDCoordonnee`) VALUES
(1, 'Pack digital', 31),
(2, 'CINS', 32),
(3, 'Inno réseaux', 33),
(4, 'Socacom', 34),
(5, 'BST-Normandie', 35),
(6, 'TCH', 36),
(7, 'L\'atelier des bosses', 37),
(8, '2MV Cars', 38),
(9, 'Macé', 39),
(10, 'Normandie Lifting Automobiles', 40),
(11, 'Normandie Transport', 41),
(12, 'Normandie Logistique', 42),
(13, 'Alliance TP ', 43),
(14, 'SAM & CO TP SARL ', 44),
(15, 'Le musée d\'Honfleur', 45),
(16, 'SARL VOYAGES COUPRIS', 46),
(17, 'JUS\'TE CHEZ MOI', 47),
(18, 'Les 3 Brasseurs', 48),
(19, 'Lsfroid', 49),
(20, 'Froid servic Lagille', 50);

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

DROP TABLE IF EXISTS `formateur`;
CREATE TABLE IF NOT EXISTS `formateur` (
  `IDFormateur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_du_formateur` varchar(50) COLLATE latin1_bin NOT NULL,
  `Prenom_du_Formateur` varchar(50) COLLATE latin1_bin NOT NULL,
  `IDCoordonnee` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDFormateur`),
  KEY `Formateur_Coordonnees_FK` (`IDCoordonnee`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES
(1, 'BIN', 'Damien', 1),
(2, 'BRAY', 'Vincent', 2),
(3, 'GAUTHIER', 'Rémy', 3),
(4, 'ALBERT', 'Emile', 4),
(5, 'TRAORE', 'Gérard', 5),
(6, 'LABBE', 'Joseph', 6),
(7, 'HUET', 'Aurélie', 7),
(8, 'ANTOINE', 'Philippe', 8),
(9, 'LAROCHE', 'Susanne', 9),
(10, 'MARY', 'Alex', 10);

--
-- Déclencheurs `formateur`
--
DROP TRIGGER IF EXISTS `trig_DEL_FORMATEUR`;
DELIMITER $$
CREATE TRIGGER `trig_DEL_FORMATEUR` AFTER DELETE ON `formateur` FOR EACH ROW BEGIN
	DELETE FROM `Coordonnees` WHERE IDCoordonnee = old.IDCoordonnee;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `IDFormation` int(11) NOT NULL AUTO_INCREMENT,
  `Intitule_de_formation` varchar(50) COLLATE latin1_bin NOT NULL,
  `IDFormateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDFormation`),
  KEY `Formation_Formateur_FK` (`IDFormateur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`IDFormation`, `Intitule_de_formation`, `IDFormateur`) VALUES
(1, 'Developpeur WEB', 1),
(2, 'Technicien Réseaux Informatique', 2),
(3, 'Chaudronnerie', 3),
(4, 'Carrossier Réparateur', 4),
(5, 'Peintre en Carrosserie', 5),
(6, 'Chauffeur-livreur', 6),
(7, 'Chef d\'équipe gros œuvre', 7),
(8, 'Responsable d\'établissement touristique', 8),
(9, 'Serveur en restauration', 9),
(10, 'Technicien froid et climatisation', 10);

-- --------------------------------------------------------

--
-- Structure de la table `habilitation`
--

DROP TABLE IF EXISTS `habilitation`;
CREATE TABLE IF NOT EXISTS `habilitation` (
  `IDHabilitation` int(11) NOT NULL AUTO_INCREMENT,
  `Titre_Habilitation` varchar(50) COLLATE latin1_bin NOT NULL,
  `DateValidation` date NOT NULL,
  `DateExpiration` date NOT NULL,
  `IDFormation` int(11) NOT NULL,
  PRIMARY KEY (`IDHabilitation`),
  KEY `Habilitation_Formation_FK` (`IDFormation`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `habilitation`
--

INSERT INTO `habilitation` (`IDHabilitation`, `Titre_Habilitation`, `DateValidation`, `DateExpiration`, `IDFormation`) VALUES
(1, 'DWWM', '2016-10-28', '2021-10-28', 1),
(2, 'DWWM', '2018-08-08', '2023-08-08', 1),
(3, 'TRI', '2015-02-14', '2020-02-14', 2),
(4, 'TRI', '2020-08-15', '2025-08-15', 2),
(5, 'TFC', '2017-05-09', '2022-05-09', 10),
(6, 'CDR', '2021-03-03', '2026-03-03', 3),
(7, 'CDR', '2017-03-26', '2022-03-26', 3),
(8, 'CaRe', '2020-09-25', '2025-09-25', 4),
(9, 'CaRe', '2017-04-13', '2022-04-13', 4),
(10, 'PeCa', '2019-12-25', '2024-12-25', 5),
(11, 'PeCa', '2014-01-01', '2014-01-01', 5),
(12, 'CHLI', '2014-05-03', '2019-05-03', 6),
(13, 'CHLI', '2021-10-08', '2026-10-08', 6),
(14, 'CEGO', '2021-02-23', '2026-02-23', 7),
(15, 'CEGO', '2018-04-21', '2023-04-21', 7),
(16, 'RETO', '2014-01-06', '2019-01-06', 8),
(17, 'RETO', '2018-04-04', '2023-04-04', 8),
(18, 'SERE', '2018-11-02', '2023-11-02', 9),
(19, 'SERE', '2019-07-14', '2024-07-14', 9),
(20, 'TFC', '2021-11-10', '2026-10-11', 10);

-- --------------------------------------------------------

--
-- Structure de la table `jure`
--

DROP TABLE IF EXISTS `jure`;
CREATE TABLE IF NOT EXISTS `jure` (
  `IDJure` int(11) NOT NULL AUTO_INCREMENT,
  `NomJures` varchar(50) COLLATE latin1_bin NOT NULL,
  `PrenomJures` varchar(50) COLLATE latin1_bin NOT NULL,
  `Visible_sur_Ceres` tinyint(1) NOT NULL,
  `Visible_sur_Valce` tinyint(1) NOT NULL,
  `IDEntreprise` int(11) DEFAULT NULL,
  `IDCoordonnee` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDJure`),
  KEY `Jure_Entreprise_FK` (`IDEntreprise`),
  KEY `Jure_Coordonnees0_FK` (`IDCoordonnee`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `jure`
--

INSERT INTO `jure` (`IDJure`, `NomJures`, `PrenomJures`, `Visible_sur_Ceres`, `Visible_sur_Valce`, `IDEntreprise`, `IDCoordonnee`) VALUES
(1, 'Martin', 'Marguerite', 1, 1, 1, 11),
(2, 'Thérèse', 'Garcia', 1, 1, 2, 12),
(3, 'Riquier', 'Bruce', 1, 1, 3, 13),
(4, 'Denis', 'Xavier', 1, 0, 4, 14),
(5, 'Charlebois', 'Patricia', 1, 0, 5, 15),
(6, 'Mainville', 'Avent', 0, 1, 6, 16),
(7, 'Bordeaux', 'Rosemarie', 0, 1, 7, 17),
(8, 'Lamothe', 'Elodie', 1, 1, 8, 18),
(9, 'Course', 'Sydney', 1, 0, 9, 19),
(10, 'Samson', 'Thomas', 1, 0, 10, 20),
(11, ' Wagner', 'René', 1, 0, 11, 21),
(12, 'Lefevre', 'Nath', 1, 0, 12, 22),
(13, 'Galler', 'Valérie', 0, 1, 13, 23),
(14, 'Leroux', 'Margaret', 1, 1, 14, 24),
(15, 'Berger', 'Grégoire', 0, 0, 15, 25),
(16, 'Bruneau', 'Honoré', 1, 0, 16, 26),
(17, 'Benoit', 'Vasseur', 1, 0, 17, 27),
(18, 'Pelletier', 'Rémy', 1, 0, 18, 28),
(19, 'Fabre', 'Adélaide', 1, 0, 19, 29),
(20, 'Charrier', 'Louis', 1, 1, 20, 30);

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

DROP TABLE IF EXISTS `posseder`;
CREATE TABLE IF NOT EXISTS `posseder` (
  `IDJure` int(11) NOT NULL,
  `IDHabilitation` int(11) NOT NULL,
  PRIMARY KEY (`IDJure`,`IDHabilitation`),
  KEY `Posseder_Habilitation0_FK` (`IDHabilitation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `sessionexamen`
--

DROP TABLE IF EXISTS `sessionexamen`;
CREATE TABLE IF NOT EXISTS `sessionexamen` (
  `IDSessionExam` int(11) NOT NULL AUTO_INCREMENT,
  `DateSessionExam` date NOT NULL,
  `IDSessionFormation` int(11) NOT NULL,
  PRIMARY KEY (`IDSessionExam`),
  KEY `SessionExamen_Session_Formation_FK` (`IDSessionFormation`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `sessionexamen`
--

INSERT INTO `sessionexamen` (`IDSessionExam`, `DateSessionExam`, `IDSessionFormation`) VALUES
(2, '2022-02-16', 1),
(3, '2022-10-12', 2),
(4, '2022-03-26', 3),
(5, '2021-08-19', 4),
(6, '2021-08-13', 5),
(7, '2022-03-29', 6),
(8, '2021-01-16', 7),
(9, '2021-09-13', 8),
(10, '2022-03-29', 9),
(11, '2022-12-18', 10),
(12, '2022-03-29', 11),
(13, '2021-08-14', 12),
(14, '2020-02-16', 13),
(15, '2020-10-29', 14),
(17, '2022-07-16', 16),
(18, '2021-06-08', 17),
(19, '2022-02-28', 18),
(20, '2022-06-22', 19),
(21, '2021-12-23', 16);

-- --------------------------------------------------------

--
-- Structure de la table `session_formation`
--

DROP TABLE IF EXISTS `session_formation`;
CREATE TABLE IF NOT EXISTS `session_formation` (
  `IDSessionFormation` int(11) NOT NULL AUTO_INCREMENT,
  `DateDebutFormation` date NOT NULL,
  `DateFinFormation` date NOT NULL,
  `IDFormateur` int(11) DEFAULT NULL,
  `IDFormation` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDSessionFormation`),
  KEY `Session_Formation_Formateur_FK` (`IDFormateur`),
  KEY `Session_Formation_Formation0_FK` (`IDFormation`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `session_formation`
--

INSERT INTO `session_formation` (`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDFormateur`, `IDFormation`) VALUES
(1, '2021-05-31', '2022-02-18', 1, 1),
(2, '2022-01-05', '2022-10-14', 1, 1),
(3, '2021-09-17', '2022-03-28', 2, 2),
(4, '2020-12-01', '2021-08-21', 2, 2),
(5, '2021-01-31', '2021-08-15', 3, 3),
(6, '2021-08-16', '2022-03-31', 3, 3),
(7, '2020-05-16', '2021-01-18', 4, 4),
(8, '2021-01-25', '2021-09-15', 4, 4),
(9, '2021-08-16', '2022-03-31', 5, 5),
(10, '2022-04-15', '2022-12-20', 5, 5),
(11, '2021-08-16', '2022-03-31', 6, 6),
(12, '2021-02-16', '2021-08-16', 6, 6),
(13, '2019-05-31', '2020-02-18', 7, 7),
(14, '2020-02-20', '2020-10-31', 7, 7),
(15, '2021-04-01', '2021-12-05', 8, 8),
(16, '2021-12-15', '2022-07-18', 8, 8),
(17, '2020-10-16', '2021-06-10', 9, 9),
(18, '2021-06-15', '2022-02-28', 9, 9),
(19, '2022-01-16', '2022-06-24', 10, 10);

-- --------------------------------------------------------

--
-- Structure de la table `superviser`
--

DROP TABLE IF EXISTS `superviser`;
CREATE TABLE IF NOT EXISTS `superviser` (
  `IDSessionExam` int(11) NOT NULL,
  `IDJure` int(11) NOT NULL,
  `Reponse` varchar(50) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`IDSessionExam`,`IDJure`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `technologie`
--

DROP TABLE IF EXISTS `technologie`;
CREATE TABLE IF NOT EXISTS `technologie` (
  `IDTechnologie` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_de_la_Technologie` varchar(50) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`IDTechnologie`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `technologie`
--

INSERT INTO `technologie` (`IDTechnologie`, `Nom_de_la_Technologie`) VALUES
(1, 'PHP'),
(2, 'Javascript'),
(3, 'MySQL'),
(4, 'Fibre optique'),
(5, 'Wifi'),
(6, 'Soudure'),
(7, 'Cuivre'),
(8, 'Inox'),
(9, 'Pastique de Carroserie'),
(10, 'Transporteur de palette'),
(11, 'Grue'),
(12, 'Tracteur-Pelleteus'),
(13, 'Bureautique'),
(14, 'Galetière'),
(15, 'Four industrielle'),
(16, 'Climatisation à l\'Azote');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `IDUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `Identifiant` varchar(50) COLLATE latin1_bin NOT NULL,
  `Mot_de_passe` varchar(50) COLLATE latin1_bin NOT NULL,
  `TypeUtilisateur` varchar(50) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`IDUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IDUtilisateur`, `Identifiant`, `Mot_de_passe`, `TypeUtilisateur`) VALUES
(1, 'IronMan', 'mdp', 'Administrateur'),
(2, 'dBIN', 'mdp', 'Formateur');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `connaitre`
--
ALTER TABLE `connaitre`
  ADD CONSTRAINT `Connaitre_Jure0_FK` FOREIGN KEY (`IDJure`) REFERENCES `jure` (`IDJure`),
  ADD CONSTRAINT `Connaitre_Technologie_FK` FOREIGN KEY (`IDTechnologie`) REFERENCES `technologie` (`IDTechnologie`);

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `Entreprise_Coordonnees_FK` FOREIGN KEY (`IDCoordonnee`) REFERENCES `coordonnees` (`IDCoordonnee`);

--
-- Contraintes pour la table `formateur`
--
ALTER TABLE `formateur`
  ADD CONSTRAINT `Formateur_Coordonnees_FK` FOREIGN KEY (`IDCoordonnee`) REFERENCES `coordonnees` (`IDCoordonnee`);

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `Formation_Formateur_FK` FOREIGN KEY (`IDFormateur`) REFERENCES `formateur` (`IDFormateur`);

--
-- Contraintes pour la table `habilitation`
--
ALTER TABLE `habilitation`
  ADD CONSTRAINT `Habilitation_Formation_FK` FOREIGN KEY (`IDFormation`) REFERENCES `formation` (`IDFormation`);

--
-- Contraintes pour la table `jure`
--
ALTER TABLE `jure`
  ADD CONSTRAINT `Jure_Coordonnees0_FK` FOREIGN KEY (`IDCoordonnee`) REFERENCES `coordonnees` (`IDCoordonnee`),
  ADD CONSTRAINT `Jure_Entreprise_FK` FOREIGN KEY (`IDEntreprise`) REFERENCES `entreprise` (`IDEntreprise`);

--
-- Contraintes pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD CONSTRAINT `Posseder_Habilitation0_FK` FOREIGN KEY (`IDHabilitation`) REFERENCES `habilitation` (`IDHabilitation`),
  ADD CONSTRAINT `Posseder_Jure_FK` FOREIGN KEY (`IDJure`) REFERENCES `jure` (`IDJure`);

--
-- Contraintes pour la table `sessionexamen`
--
ALTER TABLE `sessionexamen`
  ADD CONSTRAINT `SessionExamen_Session_Formation_FK` FOREIGN KEY (`IDSessionFormation`) REFERENCES `session_formation` (`IDSessionFormation`);

--
-- Contraintes pour la table `session_formation`
--
ALTER TABLE `session_formation`
  ADD CONSTRAINT `Session_Formation_Formateur_FK` FOREIGN KEY (`IDFormateur`) REFERENCES `formateur` (`IDFormateur`),
  ADD CONSTRAINT `Session_Formation_Formation0_FK` FOREIGN KEY (`IDFormation`) REFERENCES `formation` (`IDFormation`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
