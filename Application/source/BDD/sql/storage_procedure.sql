-------------------------------------------------------------------------------------------------
------------------------------------------PROCEDURE----------------------------------------------
-------------------------------------------------------------------------------------------------


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
create PROCEDURE `prc_ADD_examen`(date_to_add DATE, id_of_session_formation INT(2))

BEGIN
	INSERT INTO `sessionexamen`( `DateSessionExam`, `IDSessionFormation`) 
	VALUES (date_to_add, id_of_session_formation)
END 
DELIMITER ; 



-- ---------------------------- Procedure of Ajout of Formateur --------------------------------
DELIMITER $$
-- We create de procedure which add Formateur and Coordonnees
CREATE PROCEDURE `prc_ADD_Formateur`(nom VARCHAR(50), prenom VARCHAR(50), adr1 VARCHAR(50), adr2 VARCHAR(50), postal VARCHAR(50), ville VARCHAR(50), phone VARCHAR(50), mail VARCHAR(50))

BEGIN
		DECLARE idCoor INTEGER DEFAULT 0;
		INSERT INTO `coordonnees`(`Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (adr1,adr2,postal,ville,phone,mail);
		SELECT MAX(IDCoordonnee) INTO idCoor FROM coordonnees;
		INSERT INTO `formateur`(`Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (upper(nom),prenom,idCoor);
END$$
DELIMITER ;


DELIMITER $$
CREATE PROCEDURE `prc_DEL_Formateur`(id INT)

BEGIN
	DELETE FROM `formateur` WHERE IDFormateur = id;
END$$
DELIMITER ;


-------------------------------------------------------------------------------------------------
-------------------------------------------TRIGGER-----------------------------------------------
-------------------------------------------------------------------------------------------------

DELIMITER $$
CREATE TRIGGER trig_DEL_FORMATEUR
	AFTER DELETE on formateur
	FOR EACH ROW
BEGIN
	DELETE FROM `coordonnees` WHERE IDCoordonnee = old.IDCoordonnee;
END &&
DELIMITER ;
