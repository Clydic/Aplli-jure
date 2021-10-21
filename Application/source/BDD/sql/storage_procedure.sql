-- -----------------------------------------------------------------------------------------------
-- ----------------------------------------PROCEDURE----------------------------------------------
-- -----------------------------------------------------------------------------------------------

-- ---------------------------- Procedure of List Session-Examen --------------------------------
DROP PROCEDURE IF EXISTS `prc_LST_examen`;
DELIMITER $$

-- We create a procedure which list the examen which arrive
CREATE PROCEDURE `prc_LST_examen`()

BEGIN
		SELECT f.Intitule_de_formation,
		    s.IDSessionFormation, 
			e.DateSessionExam 
			from Formation f
			JOIN Session_Formation s on s.IDFormation = f.IDFormation
			JOIN SessionExamen e on e.IDSessionFormation = s.IDSessionFormation
			WHERE e.DateSessionExam >= CURRENT_DATE()
			ORDER BY e.DateSessionExam;
END$$
DELIMITER ;

-- ---------------------------- Procedure of add session examen--------------------------------
DROP PROCEDURE IF EXISTS `prc_ADD_examen`;
DELIMITER $$

-- We create a procedure which add session-examen
CREATE PROCEDURE `prc_ADD_examen`(IN id_of_session_formation INT(2), IN date_to_add CHAR(10))
BEGIN
    DECLARE DateEndFormation DATE;
    DECLARE DateBeginFormation DATE;

    SELECT DateDebutFormation 
    into DateBeginFormation                     
    FROM session_formation 
    WHERE IdSessionFormation = id_of_session_formation;
    
    SELECT DateFinFormation 
    INTO DateEndFormation         
    FROM session_formation 
    WHERE IdSessionFormation = id_of_session_formation;
    
    IF ((id_of_session_formation,date_to_add) IN (SELECT IdSessionExamen,DateSessionExamen FROM SessionExamen)) THEN 
        SIGNAL SQLSTATE '45002' 
        SET MESSAGE_TEXT = "Il ne peut y avoir deux examens le même jour pour une même formation" ;
    END IF;

    IF ((date_to_add<DateEndFormation) && (date_to_add>DateBeginFormation)) THEN
        INSERT INTO SessionExamen(DateSessionExam, IDSessionFormation) 
		VALUES (date_to_add, id_of_session_formation);
    ELSE 
        SIGNAL SQLSTATE '45001' 
        SET MESSAGE_TEXT = "La date demandée ne correspond pas à la période de la session de formation" ;
    END IF; 
END $$ -- call prc_ADD_examen(12,'2003-02-13');
DELIMITER ;


-- ---------------------------- Procedure of Ajout of Formateur --------------------------------
DROP PROCEDURE IF EXISTS `prc_ADD_Formateur`;
DELIMITER $$
-- We create a procedure which add Formateur and Coordonnees
CREATE PROCEDURE `prc_ADD_Formateur`(nom VARCHAR(50), prenom VARCHAR(50), adr1 VARCHAR(50), adr2 VARCHAR(50), postal VARCHAR(50), ville VARCHAR(50), phone VARCHAR(50), mail VARCHAR(50))

BEGIN
		DECLARE idCoor INTEGER DEFAULT 0;
		INSERT INTO `coordonnees`(`Adresse1`, `Adresse2`, `Code_Postale`, `Ville`, `Telephone`, `Mail`) VALUES (adr1,adr2,postal,ville,phone,mail);
		SELECT MAX(IDCoordonnee) INTO idCoor FROM coordonnees;
		INSERT INTO `formateur`(`Nom_du_formateur`, `Prenom_du_Formateur`, `IDCoordonnee`) VALUES (upper(nom),prenom,idCoor);
END$$
DELIMITER ;

-- ---------------------------- Procedure of Delete Formateur --------------------------------
DROP PROCEDURE IF EXISTS `prc_DEL_Formateur`;
DELIMITER $$

-- We create a procedure which delete Formateur and Coordonnees
CREATE PROCEDURE `prc_DEL_Formateur`(id INT)
BEGIN
	DELETE FROM `formateur` WHERE IDFormateur = id;
END$$
DELIMITER ;

-- ---------------------------- Procedure of Update Formateur --------------------------------
DROP PROCEDURE IF EXISTS `prc_UPD_Formateur`;
DELIMITER $$

-- We create a procedure which update Formateur and Coordonnees
CREATE PROCEDURE `prc_UPD_Formateur`(idForm INT, nom VARCHAR(50), prenom VARCHAR(50), adr1 VARCHAR(50), adr2 VARCHAR(50), postal INT, ville VARCHAR(50), phone VARCHAR(50), mail VARCHAR(50))
BEGIN
	DECLARE idCoor INTEGER DEFAULT 0;
	UPDATE `formateur` SET `Nom_du_formateur`= nom,`Prenom_du_Formateur`= prenom WHERE IDFormateur = idForm;

	SELECT IDCoordonnee INTO idCoor FROM Formateur WHERE IDFormateur = idForm;
	UPDATE `coordonnees` SET `Adresse1`= adr1,`Adresse2`= adr2 ,`Code_Postale`= postal ,`Ville`= ville ,`Telephone`= phone ,`Mail`= mail WHERE IDCoordonnee = idCoor;
END$$
DELIMITER ;



-- -----------------------------------------------------------------------------------------------
-- -----------------------------------------TRIGGER-----------------------------------------------
-- -----------------------------------------------------------------------------------------------


-- ---------------------------- Trigger of AFTER DELETE Formateur --------------------------------
DROP TRIGGER IF EXISTS `trig_DEL_FORMATEUR`;
DELIMITER $$
-- We create a trigger which delete Coordonnee after delete Formateur
CREATE TRIGGER `trig_DEL_FORMATEUR`
	AFTER DELETE on formateur
	FOR EACH ROW
BEGIN
	DELETE FROM `coordonnees` WHERE IDCoordonnee = old.IDCoordonnee;
END &&
DELIMITER ;

-- ---------------------------- Trigger of BEFORE INSERT Formation --------------------------------
DROP TRIGGER IF EXISTS `trigVerifExamen`;
DELIMITER $$
-- We create a trigger which check DATE before insert into Formation
CREATE TRIGGER `trigVerifExamen` BEFORE INSERT ON `sessionexamen`
 FOR EACH ROW BEGIN
	DECLARE doublonExam CONDITION FOR SQLSTATE '45000';

    IF (NEW.IdSessionFormation,NEW.DateSessionExam) 
		IN (SELECT DateSessionExam ,IdSessionFormation 
			from sessionexamen ) 
			THEN 
        SIGNAL doublonExam
            SET MESSAGE_TEXT = 'Il ne peut y avoir 2 examens pour une mêm session le même jour', 
			    MYSQL_ERRNO = 2001;
    END IF;

END$$
DELIMITER ;