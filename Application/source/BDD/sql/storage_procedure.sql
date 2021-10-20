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
create PROCEDURE `prc_ADD_examen`(date_to_add DATE, id_of_session_foramtion INT(2))

BEGIN
	INSERT INTO `sessionexamen`( `DateSessionExam`, `IDSessionFormation`) 
	VALUES (date_to_add, id_of_session_formation)
END 
DELIMITER ; 