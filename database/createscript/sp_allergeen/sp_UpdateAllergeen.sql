DROP PROCEDURE IF EXISTS sp_UpdateAllergeen;

DELIMITER $$

CREATE PROCEDURE sp_UpdateAllergeen(
     IN p_id INT
    ,IN p_name VARCHAR(50)
    ,IN p_description VARCHAR(255)
 )
BEGIN
    UPDATE sp_UpdateAllergeen
    SET Naam = p_name,
        Omschrijving = p_description,
        DatumGewijzigd = SYSDATE(6)
    WHERE Id = p_id;
    
    SELECT ROW_COUNT() AS affected;
END$$

DELIMITER;