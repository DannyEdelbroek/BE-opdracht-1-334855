USE jamin;

DROP PROCEDURE IF EXISTS sp_GetAllProductsOverview;
DELIMITER $$

CREATE PROCEDURE sp_GetAllProductsOverview(
    IN PageNumber INT,
    IN PageSize INT,
    IN p_startdatum DATE,
    IN p_einddatum DATE
)
BEGIN
    DECLARE offsetRows INT;
    SET offsetRows = (PageNumber - 1) * PageSize;

    SELECT
        l.Id AS LeverancierId,
        l.Naam AS LeverancierNaam,
        l.ContactPersoon,
        p.Naam AS ProductNaam,
        SUM(pp.Aantal) AS TotaalGeleverd,
        GROUP_CONCAT(a.Naam SEPARATOR ', ') AS Specificatie
    FROM ProductPerLeverancier pp
    INNER JOIN Leverancier l ON pp.LeverancierId = l.Id
    INNER JOIN Product p ON pp.ProductId = p.Id
    LEFT JOIN ProductPerAllergeen ppa ON p.Id = ppa.ProductId
    LEFT JOIN Allergeen a ON ppa.AllergeenId = a.Id
    WHERE (p_startdatum IS NULL OR pp.DatumLevering >= p_startdatum)
        AND (p_einddatum IS NULL OR pp.DatumLevering <= p_einddatum)
    GROUP BY l.Naam, l.ContactPersoon, p.Naam
    ORDER BY l.Naam, p.Naam
    LIMIT offsetRows, PageSize;
END $$

DELIMITER ;