
-- JEUX D'ESSAIS (à compléter)

-- Table Formation
-- USE CRMJures
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (1,"Developpeur WEB");
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (2,"Technicien Réseaux Informatique");
INSERT INTO `formation`(`IDFormation`, `Intitule_de_formation`) VALUES (3,"Chaudronnerie");

-- Table SessionExamen

INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (1,'2022-02-16');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (2,'2022-10-12');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (3,'2022-03-26');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (4,'2021-08-19');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (5,'2021-08-13');
INSERT INTO `sessionexamen`(`IDSessionExam`, `DateSessionExam`) VALUES (6,'2022-03-29');

-- Table Formateur

INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (1,'BIN','Damien','F1');
INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (2,'BRAY','Vincent','F2');
INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (3,'GAUTHIER','Rémy','F3');
INSERT INTO `formateur`(`IDFormateur`, `Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (4,'ALBERT','Emile','F4');

-- Table SessionFormation

INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (1,'2021-05-31','2022-02-18',1,1,1);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (2,'2022-01-05','2022-10-14',2,1,1);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (3,'2021-09-17','2022-03-28',3,2,2);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (4,'2020-12-01','2021-08-21',4,3,2);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (5,'2021-01-31','2021-08-15',5,4,3);
INSERT INTO `session_formation`(`IDSessionFormation`, `DateDebutFormation`, `DateFinFormation`, `IDSessionExam`, `IDFormateur`, `IDFormation`) VALUES (6,'2021-08-16','2022-03-31',6,4,3);

