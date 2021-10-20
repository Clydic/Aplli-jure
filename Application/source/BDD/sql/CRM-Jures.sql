#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Coordonnées
#------------------------------------------------------------

CREATE TABLE Coordonnees(
        IDCoordonnee Int  Auto_increment  NOT NULL ,
        Adresse1     Varchar (50) NOT NULL ,
        Adresse2     Varchar (50) ,
        Code_Postale Int NOT NULL ,
        Ville        Varchar (50) NOT NULL ,
        Telephone    Varchar (10) NOT NULL ,
        Mail         Varchar (50) NOT NULL
	,CONSTRAINT Coordonnees_PK PRIMARY KEY (IDCoordonnee)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Formateur
#------------------------------------------------------------

CREATE TABLE Formateur(
        IDFormateur         Int  Auto_increment  NOT NULL ,
        Nom_du_formateur    Varchar (50) NOT NULL ,
        Prenom_du_Formateur Varchar (50) NOT NULL ,
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
# Table: Juré
#------------------------------------------------------------

CREATE TABLE Jure(
        IDJure            Int  Auto_increment  NOT NULL ,
        NomJures          Varchar (50) NOT NULL ,
        PrenomJures       Varchar (50) NOT NULL ,
        Visible_sur_Ceres Bool NOT NULL ,
        Visible_sur_Valce Bool NOT NULL ,
        IDEntreprise      Int ,
        IDCoordonnee      Int
	,CONSTRAINT Jure_PK PRIMARY KEY (IDJure)

	,CONSTRAINT Jure_Entreprise_FK FOREIGN KEY (IDEntreprise) REFERENCES Entreprise(IDEntreprise)
	,CONSTRAINT Jure_Coordonnees0_FK FOREIGN KEY (IDCoordonnee) REFERENCES Coordonnees(IDCoordonnee)
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
        IDFormateur        Int ,
        IDFormation        Int
	,CONSTRAINT Session_Formation_PK PRIMARY KEY (IDSessionFormation)

	,CONSTRAINT Session_Formation_Formateur_FK FOREIGN KEY (IDFormateur) REFERENCES Formateur(IDFormateur)
	,CONSTRAINT Session_Formation_Formation0_FK FOREIGN KEY (IDFormation) REFERENCES Formation(IDFormation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: SessionExamen
#------------------------------------------------------------

CREATE TABLE SessionExamen(
        IDSessionExam      Int  Auto_increment  NOT NULL ,
        DateSessionExam    Date NOT NULL ,
        IDSessionFormation Int NOT NULL
	,CONSTRAINT SessionExamen_PK PRIMARY KEY (IDSessionExam)

	,CONSTRAINT SessionExamen_Session_Formation_FK FOREIGN KEY (IDSessionFormation) REFERENCES Session_Formation(IDSessionFormation)
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
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE _Utilisateur(
        IDUtilisateur   Int  Auto_increment  NOT NULL ,
        Identifiant     Varchar (50) NOT NULL ,
        Mot_de_passe    Varchar (50) NOT NULL ,
        TypeUtilisateur Varchar (50) NOT NULL
	,CONSTRAINT _Utilisateur_PK PRIMARY KEY (IDUtilisateur)
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
# Table: Posseder
#------------------------------------------------------------

CREATE TABLE Posseder(
        IDJure         Int NOT NULL ,
        IDHabilitation Int NOT NULL
	,CONSTRAINT Posseder_PK PRIMARY KEY (IDJure,IDHabilitation)

	,CONSTRAINT Posseder_Jure_FK FOREIGN KEY (IDJure) REFERENCES Jure(IDJure)
	,CONSTRAINT Posseder_Habilitation0_FK FOREIGN KEY (IDHabilitation) REFERENCES Habilitation(IDHabilitation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Superviser
#------------------------------------------------------------

CREATE TABLE Superviser(
        IDSessionExam Int NOT NULL ,
        IDJure        Int NOT NULL ,
        Reponse       Varchar (50) NOT NULL
	,CONSTRAINT Superviser_PK PRIMARY KEY (IDSessionExam,IDJure)

)ENGINE=InnoDB;
