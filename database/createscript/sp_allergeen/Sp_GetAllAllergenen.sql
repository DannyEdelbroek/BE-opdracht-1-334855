DROP PROCEDURE IF EXISTS Sp_GetAllAllergenen;

DELIMITER $$

CREATE PROCEDURE Sp_GetAllAllergenen()
BEGIN
    SELECT    ALGE.ID as id
            , ALGE.Naam
            , ALGE.Omschrijving
    FROM Allergeen ALGE;



END$$

DELIMITER ;