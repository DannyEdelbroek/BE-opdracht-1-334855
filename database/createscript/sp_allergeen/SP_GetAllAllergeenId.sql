DROP PROCEDURE IF EXISTS SP_GetAllAllergeenId;

DELIMITER $$

CREATE PROCEDURE SP_GetAllAllergeenId(
    IN p_id INT
)
BEGIN

    SELECT   Id
            ,Naam
            ,Omschrijving
    FROM Allergeen 
    WHERE ID = p_id;
END$$

DELIMITER ; 