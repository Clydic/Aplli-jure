#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Coordonnées
#------------------------------------------------------------

CREATE TABLE Coordonnees(
        IDCoordonnee Int  Auto_increment  NOT NULL ,
        Adresse1     Varchar (50) NOT NULL ,
        Adresse2     Varchar (50) NOT NULL ,
        Code_Postale Int NOT NULL ,
        Ville        Varchar (50) NOT NULL ,
        Telephone    Int NOT NULL ,
        Mail         Varchar (50) NOT NULL
	,CONSTRAINT Coordonnees_PK PRIMARY KEY (IDCoordonnee)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Formateur
#------------------------------------------------------------

CREATE TABLE Formateur(
        IDFormateur         Int  Auto_increment  NOT NULL ,
        Nom_du_formateur    Varchar (50) NOT NULL ,
        Prenom_du_Formateur Varchar (5) NOT NULL ,
        IDCoordonnee        Int
	,CONSTRAINT Formateur_PK PRIMARY KEY (IDFormateur)

	,CONSTRAINT Formateur_Coordonnees_FK FOREIGN KEY (IDCoordonnee) REFERENCES Coordonnees(IDCoordonnee)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Entreprise
#------------------------------------------------------------

CREATE TABLE Entreprise(
        IDEntreprise  Int  Auto_increment  NOT NULL ,
        NomEntreprise Varchar (50) NOT NULL ,
        IDCoordonnee  Int
	,CONSTRAINT Entreprise_PK PRIMARY KEY (IDEntreprise)

	,CONSTRAINT Entreprise_Coordonnees_FK FOREIGN KEY (IDCoordonnee) REFERENCES Coordonnees(IDCoordonnee)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: SessionExamen
#------------------------------------------------------------

CREATE TABLE SessionExamen(
        IDSessionExam   Int  Auto_increment  NOT NULL ,
        DateSessionExam Date NOT NULL
	,CONSTRAINT SessionExamen_PK PRIMARY KEY (IDSessionExam)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Technologie
#------------------------------------------------------------

CREATE TABLE Technologie(
        IDTechnologie         Int  Auto_increment  NOT NULL ,
        Nom_de_la_Technologie Varchar (50) NOT NULL
	,CONSTRAINT Technologie_PK PRIMARY KEY (IDTechnologie)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        IDUtilisateur Int  Auto_increment  NOT NULL ,
        Identifiant   Varchar (50) NOT NULL ,
        Mot_de_passe  Varchar (50) NOT NULL
	,CONSTRAINT Utilisateur_PK PRIMARY KEY (IDUtilisateur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Formation
#------------------------------------------------------------

CREATE TABLE Formation(
        IDFormation           Int  Auto_increment  NOT NULL ,
        Intitule_de_formation Varchar (50) NOT NULL ,
        IDFormateur           Int
	,CONSTRAINT Formation_PK PRIMARY KEY (IDFormation)

	,CONSTRAINT Formation_Formateur_FK FOREIGN KEY (IDFormateur) REFERENCES Formateur(IDFormateur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Session Formation
#------------------------------------------------------------

CREATE TABLE Session_Formation(
        IDSessionFormation Int  Auto_increment  NOT NULL ,
        DateDebutFormation Date NOT NULL ,
        DateFinFormation   Date NOT NULL ,
        IDSessionExam      Int NOT NULL ,
        IDFormateur        Int ,
        IDFormation        Int
	,CONSTRAINT Session_Formation_PK PRIMARY KEY (IDSessionFormation)

	,CONSTRAINT Session_Formation_SessionExamen_FK FOREIGN KEY (IDSessionExam) REFERENCES SessionExamen(IDSessionExam)
	,CONSTRAINT Session_Formation_Formateur0_FK FOREIGN KEY (IDFormateur) REFERENCES Formateur(IDFormateur)
	,CONSTRAINT Session_Formation_Formation1_FK FOREIGN KEY (IDFormation) REFERENCES Formation(IDFormation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Habilitation
#------------------------------------------------------------

CREATE TABLE Habilitation(
        IDHabilitation     Int  Auto_increment  NOT NULL ,
        Titre_Habilitation Varchar (50) NOT NULL ,
        DateValidation     Date NOT NULL ,
        DateExpiration     Date NOT NULL ,
        IDFormation        Int NOT NULL
	,CONSTRAINT Habilitation_PK PRIMARY KEY (IDHabilitation)

	,CONSTRAINT Habilitation_Formation_FK FOREIGN KEY (IDFormation) REFERENCES Formation(IDFormation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Juré
#------------------------------------------------------------

CREATE TABLE Jure(
        IDJure            Int  Auto_increment  NOT NULL ,
        NomJures          Varchar (50) NOT NULL ,
        PrenomJures       Varchar (50) NOT NULL ,
        Visible_sur_Ceres Bool NOT NULL ,
        Visible_sur_Valce Bool NOT NULL ,
        IDHabilitation    Int ,
        IDEntreprise      Int ,
        IDCoordonnee      Int
	,CONSTRAINT Jure_PK PRIMARY KEY (IDJure)

	,CONSTRAINT Jure_Habilitation_FK FOREIGN KEY (IDHabilitation) REFERENCES Habilitation(IDHabilitation)
	,CONSTRAINT Jure_Entreprise0_FK FOREIGN KEY (IDEntreprise) REFERENCES Entreprise(IDEntreprise)
	,CONSTRAINT Jure_Coordonnees1_FK FOREIGN KEY (IDCoordonnee) REFERENCES Coordonnees(IDCoordonnee)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Connaitre
#------------------------------------------------------------

CREATE TABLE Connaitre(
        IDTechnologie Int NOT NULL ,
        IDJure        Int NOT NULL
	,CONSTRAINT Connaitre_PK PRIMARY KEY (IDTechnologie,IDJure)

	,CONSTRAINT Connaitre_Technologie_FK FOREIGN KEY (IDTechnologie) REFERENCES Technologie(IDTechnologie)
	,CONSTRAINT Connaitre_Jure0_FK FOREIGN KEY (IDJure) REFERENCES Jure(IDJure)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Superviser
#------------------------------------------------------------

CREATE TABLE Superviser(
        IDSessionExam Int NOT NULL ,
        IDJure        Int NOT NULL ,
        Reponse       Varchar (50) NOT NULL
	,CONSTRAINT Superviser_PK PRIMARY KEY (IDSessionExam,IDJure)

	,CONSTRAINT Superviser_SessionExamen_FK FOREIGN KEY (IDSessionExam) REFERENCES SessionExamen(IDSessionExam)
	,CONSTRAINT Superviser_Jure0_FK FOREIGN KEY (IDJure) REFERENCES Jure(IDJure)
)ENGINE=InnoDB;


-- JEUX D'ESSAIS (à compléter)

-- Table Coordonnées

INSERT INTO `coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES ('F1','21, rue PHP',NULL,14000,'Caen',"0611528496","bin.damien@afpa.fr");
INSERT INTO `coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES ('F2','15, rue des framework',NULL,14800,'Deauville','0641489575','bray.vincent@afpa.fr');
INSERT INTO `coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES ('F3','7, rue de Girard',NULL,14123,'IFS','0614859753','gauthier.remy@afpa.fr');
INSERT INTO `coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES ('F4','698, boulevard Grégoire Thomas',NULL,14200,'Herouville-Saint-Clair','0612596574','albert.emile@afpa.fr');
INSERT INTO `coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES ('F5','16, rue de Pruvost',NULL,14120,'Mondeville','0658748562','traore.gerard@afpa.fr');
INSERT INTO `coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES ('F6','60, avenue Duval',NULL,14200,'Herouville-Saint-Clair','0654859742','labbe.joseph@afpa.fr');
INSERT INTO `coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES ('F7','6, boulevard de Benoit',NULL,14000,'Caen','0659863215','huet.aurelie@afpa.fr');
INSERT INTO `coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES ('F8','43, chemin Caron',NULL,14000,'Caen','0694758196','antoine.philippe@afpa.fr');
INSERT INTO `coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES ('F9','677, avenue Daniel Moulin',NULL,14123,'IFS','0623985475','lauranne.susanne@afpa.fr');
INSERT INTO `coordonnees`(`IDCoordonnee`, `Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES ("F10",'55, place William Teixeira',NULL,14123,'IFS','0617485965','mary.alex@afpa.fr');

-- Table Formation
-- USE CRMJures
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (1,"Developpeur WEB");
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (2,"Technicien Réseaux Informatique");
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (3,"Chaudronnerie");
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (4,"Carrossier Réparateur");
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (5,"Peintre en Carrosserie");
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (6,"Chauffeur-livreur");
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (7,"Chef d'équipe gros œuvre");
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (8,"Responsable d'établissement touristique");
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (9,"Serveur en restauration");
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (10,"Technicien froid et climatisation");

-- Table SessionExamen

INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (1,'2022-02-16');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (2,'2022-10-12');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (3,'2022-03-26');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (4,'2021-08-19');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (5,'2021-08-13');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (6,'2022-03-29');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (7,'2021-01-16');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (8,'2021-09-13');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (9,'2022-03-29');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (10,'2022-12-18');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (11,'2022-03-29');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (12,'2021-08-14');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (13,'2020-02-16');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (14,'2020-10-29');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (15,'2021-12-06');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (16,'2022-07-16');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (17,'2021-06-08');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (18,'2022-02-29');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (19,'2022-06-22');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (20,'2022-12-21');


-- Table Formateur

INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (1,'BIN','Damien','F1');
INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (2,'BRAY','Vincent','F2');
INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (3,'GAUTHIER','Rémy','F3');
INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (4,'ALBERT','Emile','F4');
INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (5,'TRAORE','Gérard','F5');
INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (6,'LABBE','Joseph','F6');
INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (7,'HUET','Aurélie','F7');
INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (8,'ANTOINE','Philippe','F8');
INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (9,'LAROCHE','Susanne','F9');
INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (10,'MARY','Alex','F10');


-- Table SessionFormation

INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (1,'2021-05-31','2022-02-18',1,1,1);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (2,'2022-01-05','2022-10-14',2,1,1);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (3,'2021-09-17','2022-03-28',3,2,2);
<<<<<<< HEAD
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (4,'2020-12-01','2021-08-21',4,3,2);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (5,'2021-01-31','2021-08-15',5,4,3);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (6,'2021-08-16','2022-03-31',6,4,3);





=======
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (4,'2020-12-01','2021-08-21',4,2,2);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (5,'2021-01-31','2021-08-15',5,3,3);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (6,'2021-08-16','2022-03-31',6,3,3);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (7,'2020-05-16','2021-01-18',7,4,4);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (8,'2021-01-25','2021-09-15',8,4,4);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (9,'2021-08-16','2022-03-31',9,5,5);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (10,'2022-04-15','2022-12-20',10,5,5);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (11,'2021-08-16','2022-03-31',11,6,6);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (12,'2021-02-16','2021-08-16',12,6,6);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (13,'2019-05-31','2020-02-18',13,7,7);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (14,'2020-02-31','2020-10-31',14,7,7);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (15,'2021-04-01','2021-12-05',15,8,8);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (16,'2021-12-15','2022-07-18',16,8,8);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (17,'2020-10-16','2021-06-10',17,9,9);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (18,'2021-06-15','2022-02-31',18,9,9);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (19,'2022-01-16','2022-06-24',19,10,10);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (20,'2022-06-26','2022-12-23',20,10,10);
>>>>>>> ae36eaa622ecee0dc59d416a55295d3dcefcc0f1

