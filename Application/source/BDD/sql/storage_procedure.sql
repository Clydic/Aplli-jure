-- ---------------------------- Procedure of Session of Examen --------------------------------
DELIMITER $$
-- We create de procedure which list the examen which arrive
CREATE PROCEDURE `prc_LST_examen`()

BEGIN
		SELECT f.Intitule_de_formation,
		    s.IDSessionFormation, 
			e.DateSessionExam 
			from Formation f
			JOIN Session_Formation s on s.IDFormation = f.IDFormation
			JOIN SessionExamen e on e.IDSessionExam = s.IDSessionExam
			WHERE e.DateSessionExam >= CURRENT_DATE()
			ORDER BY e.DateSessionExam;
END$$
DELIMITER ;


 
-- ---------------------------- Procedure of add session examen--------------------------------
DELIMITER $$ 

-- We create de procedure which list the examen which arrive
create PROCEDURE `prc_ADD_examen`(date_to_add VARCHAR(10), id_of_session_formation INT(2))

BEGIN
	INSERT INTO `sessionexamen`( `DateSessionExam`, `IDSessionFormation`) 
	VALUES (date_to_add, id_of_session_formation)
END 
DELIMITER ; 



-- ---------------------------- Procedure of Ajout of Formateur --------------------------------
DELIMITER $$
-- We create de procedure which list the examen which arrive
CREATE PROCEDURE `prc_ADD_Formateur`(nom VARCHAR(50), prenom VARCHAR(50), adr1 VARCHAR(50), adr2 VARCHAR(50), postal VARCHAR(50), ville VARCHAR(50), phone VARCHAR(50), mail VARCHAR(50))

BEGIN
		DECLARE idCoor INTEGER DEFAULT 0;
		INSERT INTO `coordonnees`(`Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (adr1,adr2,postal,ville,phone,mail);
		SELECT MAX(IDCoordonnee) INTO idCoor FROM coordonnees;
		INSERT INTO `formateur`(`Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (nom,prenom,idCoor);
END$$
DELIMITER ;

-- call prc_ADD_examen(12,'2003-02-13');

