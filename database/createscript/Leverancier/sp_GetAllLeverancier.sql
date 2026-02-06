USE jamin;

DROP PROCEDURE IF EXISTS sp_GetAllLeverancier;

DELIMITER $$

CREATE PROCEDURE sp_GetAllLeverancier(
     IN PageNumber INT,
     IN PageSize INT
)
BEGIN
    -- Bereken offset
    DECLARE offsetRows INT;
    SET offsetRows = (PageNumber - 1) * PageSize;

    -- Selecteer de rijen met LIMIT
    SELECT 
        L.Id,
        L.Naam,
        L.ContactPersoon,
        L.LeverancierNummer,
        L.Mobiel
    FROM Leverancier L
    ORDER BY L.Id ASC
    LIMIT offsetRows, PageSize; 
END $$

DELIMITER ;