DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_ADD_examen`(IN `id_of_session_formation` INT(2), IN `date_to_add` CHAR(10))
BEGIN
	DECLARE DateEndFormation DATE;
   	DECLARE DateBeginFormation DATE;
    SELECT DateDebutFormation 
    into DateBeginFormation					 
    FROM Session_Formation 
    WHERE IdSessionFormation = id_of_session_formation;
    
    SELECT DateFinFormation 
    into DateEndFormation 		
    FROM Session_Formation 
    WHERE IdSessionFormation = id_of_session_formation;
    
        IF ((id_of_session_formation,date_to_add)
        IN (SELECT IdSessionFormation, 								DateSessionExam 
             FROM SessionExamen))
        THEN 
        SIGNAL SQLSTATE '45002' 
        SET MESSAGE_TEXT = "Il ne peut y avoir deux 		examen le même jour pour une même 				formation" ;
    END IF;
    
	IF ((date_to_add<DateEndFormation)
    &&
 	(date_to_add>DateBeginFormation)) THEN
    	INSERT INTO `SessionExamen`( 			`DateSessionExam`, `IDSessionFormation`) 
	VALUES (date_to_add, id_of_session_formation);
    
    
    ELSE 
    	SIGNAL SQLSTATE '45001' 
        SET MESSAGE_TEXT = "La date demandée ne 			correspond pas à la période de la 				session de formation" ;
	END IF; 

        
	
END$$
DELIMITER ;
