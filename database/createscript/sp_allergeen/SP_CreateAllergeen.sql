DROP PROCEDURE IF EXISTS SP_CreateAllergeen;

DELIMITER $$

CREATE PROCEDURE SP_CreateAllergeen(
    IN p_Naam VARCHAR(50),
    IN p_Omschrijving VARCHAR(255)
)
BEGIN
    INSERT INTO Allergeen (Naam, Omschrijving)
    VALUES (p_Naam, p_Omschrijving);

    SELECT LAST_INSERT_ID() AS new_id;
END$$

DELIMITER ; 