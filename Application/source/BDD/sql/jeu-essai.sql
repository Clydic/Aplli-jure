-- JEUX D'ESSAIS (à compléter)

-- Table Coordonnées

INSERT INTO `Coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (1,'21, rue PHP',NULL,14000,'Caen',"0611528496","bin.damien@afpa.fr");
INSERT INTO `Coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (2,'15, rue des framework',NULL,14800,'Deauville','0641489575','bray.vincent@afpa.fr');
INSERT INTO `Coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (3,'7, rue de Girard',NULL,14123,'IFS','0614859753','gauthier.remy@afpa.fr');
INSERT INTO `Coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (4,'698, boulevard Grégoire Thomas',NULL,14200,'Herouville-Saint-Clair','0612596574','albert.emile@afpa.fr');
INSERT INTO `Coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (5,'16, rue de Pruvost',NULL,14120,'Mondeville','0658748562','traore.gerard@afpa.fr');
INSERT INTO `Coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (6,'60, avenue Duval',NULL,14200,'Herouville-Saint-Clair','0654859742','labbe.joseph@afpa.fr');
INSERT INTO `Coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (7,'6, boulevard de Benoit',NULL,14000,'Caen','0659863215','huet.aurelie@afpa.fr');
INSERT INTO `Coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (8,'43, chemin Caron',NULL,14000,'Caen','0694758196','antoine.philippe@afpa.fr');
INSERT INTO `Coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (9,'677, avenue Daniel Moulin',NULL,14123,'IFS','0623985475','lauranne.susanne@afpa.fr');
INSERT INTO `Coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (10,'55, place William Teixeira',NULL,14123,'IFS','0617485965','mary.alex@afpa.fr');

-- Table Formation

INSERT INTO `Formation`(`IDFormation`, `Intitule_de_formation`, `IDFormateur`) VALUES (1,"Developpeur WEB",1);
INSERT INTO `Formation`(`IDFormation`, `Intitule_de_formation`, `IDFormateur`) VALUES (2,"Technicien Réseaux Informatique",2);
INSERT INTO `Formation`(`IDFormation`, `Intitule_de_formation`, `IDFormateur`) VALUES (3,"Chaudronnerie",3);
INSERT INTO `Formation`(`IDFormation`, `Intitule_de_formation`, `IDFormateur`) VALUES (4,"Carrossier Réparateur",4);
INSERT INTO `Formation`(`IDFormation`, `Intitule_de_formation`, `IDFormateur`) VALUES (5,"Peintre en Carrosserie",5);
INSERT INTO `Formation`(`IDFormation`, `Intitule_de_formation`, `IDFormateur`) VALUES (6,"Chauffeur-livreur",6);
INSERT INTO `Formation`(`IDFormation`, `Intitule_de_formation`, `IDFormateur`) VALUES (7,"Chef d'équipe gros œuvre",7);
INSERT INTO `Formation`(`IDFormation`, `Intitule_de_formation`, `IDFormateur`) VALUES (8,"Responsable d'établissement touristique",8);
INSERT INTO `Formation`(`IDFormation`, `Intitule_de_formation`, `IDFormateur`) VALUES (9,"Serveur en restauration",9);
INSERT INTO `Formation`(`IDFormation`, `Intitule_de_formation`, `IDFormateur`) VALUES (10,"Technicien froid et climatisation",10);

-- Table SessionExamen

INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (1,'2022-02-16');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (2,'2022-10-12');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (3,'2022-03-26');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (4,'2021-08-19');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (5,'2021-08-13');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (6,'2022-03-29');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (7,'2021-01-16');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (8,'2021-09-13');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (9,'2022-03-29');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (10,'2022-12-18');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (11,'2022-03-29');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (12,'2021-08-14');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (13,'2020-02-16');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (14,'2020-10-29');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (15,'2021-12-06');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (16,'2022-07-16');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (17,'2021-06-08');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (18,'2022-02-29');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (19,'2022-06-22');
INSERT INTO `Sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (20,'2022-12-21');


-- Table Formateur LOL

INSERT INTO `Formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (1,'BIN','Damien','F1');
INSERT INTO `Formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (2,'BRAY','Vincent','F2');
INSERT INTO `Formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (3,'GAUTHIER','Rémy','F3');
INSERT INTO `Formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (4,'ALBERT','Emile','F4');
INSERT INTO `Formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (5,'TRAORE','Gérard','F5');
INSERT INTO `Formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (6,'LABBE','Joseph','F6');
INSERT INTO `Formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (7,'HUET','Aurélie','F7');
INSERT INTO `Formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (8,'ANTOINE','Philippe','F8');
INSERT INTO `Formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (9,'LAROCHE','Susanne','F9');
INSERT INTO `Formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (10,'MARY','Alex','F10');


-- Table SessionFormation

INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (1,'2021-05-31','2022-02-18',1,1,1);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (2,'2022-01-05','2022-10-14',2,1,1);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (3,'2021-09-17','2022-03-28',3,2,2);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (4,'2020-12-01','2021-08-21',4,2,2);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (5,'2021-01-31','2021-08-15',5,3,3);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (6,'2021-08-16','2022-03-31',6,3,3);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (7,'2020-05-16','2021-01-18',7,4,4);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (8,'2021-01-25','2021-09-15',8,4,4);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (9,'2021-08-16','2022-03-31',9,5,5);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (10,'2022-04-15','2022-12-20',10,5,5);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (11,'2021-08-16','2022-03-31',11,6,6);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (12,'2021-02-16','2021-08-16',12,6,6);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (13,'2019-05-31','2020-02-18',13,7,7);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (14,'2020-02-31','2020-10-31',14,7,7);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (15,'2021-04-01','2021-12-05',15,8,8);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (16,'2021-12-15','2022-07-18',16,8,8);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (17,'2020-10-16','2021-06-10',17,9,9);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (18,'2021-06-15','2022-02-31',18,9,9);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (19,'2022-01-16','2022-06-24',19,10,10);
INSERT INTO `Session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (20,'2022-06-26','2022-12-23',20,10,10);

