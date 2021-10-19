DELIMITER $$
CREATE DEFINER=`batman`@`localhost` PROCEDURE `prc_LST_examen`()

BEGIN
		SELECT f.Intitule_de_formation,
		    s.IDSessionFormation, 
			e.DateSessionExam 
			from Formation f
			JOIN Session_Formation s on s.IDFormation = f.IDFormation
			JOIN SessionExamen e on e.IDSessionExam = s.IDSessionExam
			WHERE e.DateSessionExam >= CURRENT_DATE();
			ORDER BY e.DateSessionExam;
END$$
DELIMITER ;
